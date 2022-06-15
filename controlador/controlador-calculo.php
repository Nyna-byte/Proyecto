<?php

require_once('../ddbb/ddbb.php');

require_once('../modelo/modelo-calculo.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["mostrarPrenda"])){
		$nombre=$_POST['table'];
		$prenda=obtenerPrenda($conn,$nombre);
	}else if(isset($_POST["calcularPrenda"])) {
		$nombre=$_POST['table'];
		$prenda=obtenerPrenda($conn,$nombre);
		$cantidad=$_POST['cantidad'];
		$tiempo=$_POST['tiempo'];
		// Datos sacados de la base de datos
		$TCtotal=0;
		foreach($prenda as $valor) {
			$TCtotal+=$valor['tc'];
		}
		$prenda=obtenerPrenda($conn,$nombre);

		$operarios=calcOperarios($cantidad,$TCtotal,$tiempo);
		$equilibrado=calcEquilibrado($TCtotal,$operarios);
		$arrOperarios=calcTablaEquilibrado($operarios, $equilibrado, $prenda);
		$equilibradoOperarios=datosTablaEquilibrado($arrOperarios, $nombre, $conn);
	}
}
$tablas=obtenerTablas($conn);


function calcOperarios($cantidad, $TCtotal, $tiempo) {
	return round(($cantidad*($TCtotal/100))/$tiempo);
	//El tc entre 100 porque son centésimas de minuto
}
function calcEquilibrado($TCtotal, $operarios) {
	return (($TCtotal/100)/$operarios)*100;
}
function calcTC($arrTC) {
	$TCtotal=0;
	for($i=0; $i<sizeof($arrTC); $i++){
		$TCtotal+=$arrTC[$i];
	}
	return $TCtotal;
}
function puntajeMaq($maquina) {
	switch($maquina) {
		case "Plana":
			return "301";
			break;
		case "OW":
			return "504";
			break;
		case "OWPS":
			return "511";
			break;
		case "Cadeneta":
			return "111";
			break;
		case "Zig-zag":
			return "304";
			break;
		case "Bajos":
			return "103";
			break;
		default:
			return "-";
			break;
	}
}
function calcTablaEquilibrado($operarios, $equilibrado, $prenda){
	$maquinas=[];
	$tcs=[];
	$nfases=[];
	$calcEquilibrado=(float)number_format($equilibrado, 7);
	foreach($prenda as $paso ){
		array_push($maquinas, $paso['maquina']);
		array_push($tcs, (int)$paso['tc']);
		array_push($nfases, (int)$paso['n_fase']);
	}

	$arrOperarios=[];
	for($i=0; $i<$operarios; $i++){
		$operario=array();
		$tcOperario=0;
		do {
			$tcOperario=0;
			$maquinaOperario=null;
			for($j=0; $j<sizeof($nfases); $j++){
				$fase=$nfases[$j]-1;
				if($maquinaOperario===null && $tcOperario===0){
					$resto=$tcs[$fase]-($calcEquilibrado-$tcOperario);
					if((float)bcdiv($resto, '1', 6)==0){
						$tcOperario=$calcEquilibrado;
						array_push($operario, $fase);
						$maquinaOperario=$maquinas[$fase];
						array_splice($nfases, $j, 1);
					}
					else if($resto<0){
						$tcOperario+=$tcs[$fase];
						array_push($operario, $fase);
						$maquinaOperario=$maquinas[$fase];
						array_splice($nfases, $j, 1);
					}
					else{
						$tcs[$fase]=$resto;
						array_push($operario, $fase);
						$maquinaOperario=$maquinas[$fase];
						$tcOperario=$calcEquilibrado;
					}
				}
				else if($tcOperario+$tcs[$fase]<=$calcEquilibrado && $maquinaOperario===$maquinas[$fase]){
					$tcOperario+=$tcs[$fase];
					array_push($operario, $fase);
					array_splice($nfases, $j, 1);
				}
				else if($tcOperario+$tcs[$fase]>$calcEquilibrado && $maquinaOperario===$maquinas[$fase]){
					$resto=$tcs[$fase]-($calcEquilibrado-$tcOperario);
					$tcs[$fase]=$resto;
					$tcOperario=$calcEquilibrado;
					array_push($operario, $fase);
				}
			}
			// Así se da prioridad a que un empleado esté en una sola máquina
            // Si tras recorrer el array de fases entero no tiene suficiente TC entonces toma parte de la primera fase que haya
			if($maquinaOperario===null || $tcOperario<$calcEquilibrado){
				for($j=0; $j<sizeof($nfases); $j++){
					$fase=$nfases[$j]-1;
					$resto=$tcs[$fase]-($calcEquilibrado-$tcOperario);
					if($resto<=0){
						$tcOperario+=$tcs[$fase];
						array_push($operario, $fase);
						array_splice($nfases, $j, 1);
					}
					else{
						$tcs[$fase]=$resto;
						array_push($operario, $fase);
					}
				}
			}

		} while ($tcOperario<$calcEquilibrado);

		array_push($arrOperarios, $operario);
	}
	return $arrOperarios;
}
function datosTablaEquilibrado($arrOperarios, $nombre, $conn){
	$arrFases=[];
	foreach ($arrOperarios as $operario) {
		$fasesOperario=[];
		foreach ($operario as $fase) {
			$datosFase=obtenerFase($conn, $nombre, $fase+1);
			array_push($fasesOperario, $datosFase);
		}
		array_push($arrFases, $fasesOperario);
	}
	return $arrFases;
}

require_once('../vista/vista-calculo.php');

?>