<?php

require_once('../ddbb/ddbb.php');

require_once('../modelo/modelo-crear.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$prenda=$_POST['nombre'];
	// Datos a guardar en la bbdd
	$arrDes=$_POST['descripcion'];
	$arrMaq=$_POST['maquina'];
	$arrRPM=$_POST['revoluciones'];
	$arrPPC=$_POST['ppc'];
	$arrTC=$_POST['TC'];
	$arrObs=$_POST['observaciones'];
	
	
	//Comprobar si ya existe una prenda con ese nombre
	$count = comprobarNombre($conn,$prenda);

	if($count[0]['count(*)'] > 0){
		echo "Ya existe una prenda con ese nombre. <br>";
	}
	else{
		//Insertar datos
		for($i=0;$i<count($arrDes);$i++) {
			altaPasoPrenda($conn,$prenda,($i+1),$arrDes[$i],$arrMaq[$i],$arrRPM[$i],$arrPPC[$i],$arrTC[$i],$arrObs[$i]);
		}
	}
	
	require_once('../vista/vista-crear.php');
} else {
	header('../index.html');
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


?>