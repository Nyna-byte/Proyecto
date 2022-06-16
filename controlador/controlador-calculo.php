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
$listadoPrendas=obtenerPrendas($conn);


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
	$faseCompletada=[];
	$calcEquilibrado=(float)number_format($equilibrado, 5);
	foreach($prenda as $paso ){
		array_push($maquinas, $paso['maquina']);
		array_push($tcs, (int)$paso['tc']);
		array_push($nfases, (int)$paso['n_fase']);
		array_push($faseCompletada, false);
	}

	$arrOperarios=[];
	for($i=0; $i<$operarios; $i++){
		$operario=array();
		$tcOperario=0;
		do {
			$maquinaOperario=null;
			for($j=0; $j<sizeof($nfases); $j++){
				if(!$faseCompletada[$j]){
					if($maquinaOperario===null){
						$resto=$tcs[$j]-($calcEquilibrado-$tcOperario);
						if((float)bcdiv($resto, '1', 4)==0){
							$tcOperario=$calcEquilibrado;
							$operario[$j]=$tcs[$j];
							$maquinaOperario=$maquinas[$j];
							$faseCompletada[$j]=true;
						}
						else if($resto<0){
							$tcOperario+=$tcs[$j];
							$operario[$j]=$tcs[$j];
							$maquinaOperario=$maquinas[$j];
							$faseCompletada[$j]=true;
						}
						else{
							$operario[$j]=$tcs[$j]-$resto;
							$tcs[$j]=$resto;
							$maquinaOperario=$maquinas[$j];
							$tcOperario=$calcEquilibrado;
						}
					}
					else if($tcOperario+$tcs[$j]<=$calcEquilibrado && $maquinaOperario===$maquinas[$j]){
						$tcOperario+=$tcs[$j];
						$operario[$j]=$tcs[$j];
						$faseCompletada[$j]=true;
					}
					else if($tcOperario+$tcs[$j]>$calcEquilibrado && $maquinaOperario===$maquinas[$j] && $tcOperario<$calcEquilibrado){
						$resto=$tcs[$j]-($calcEquilibrado-$tcOperario);
						$operario[$j]=$tcs[$j]-$resto;
						$tcs[$j]=$resto;
						$tcOperario=$calcEquilibrado;
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
		foreach ($operario as $fase => $tiempo) {
			$datosFase=obtenerFase($conn, $nombre, $fase+1);
			$datosFase[0]['tc']=$tiempo;
			array_push($fasesOperario, $datosFase);
		}
		array_push($arrFases, $fasesOperario);
	}
	return $arrFases;
}

require_once('../vista/vista-calculo.php');

?>