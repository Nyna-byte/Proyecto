<?php 
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
function obtenerPrenda($conn,$nombre) {
	try {
		$sql=$conn->prepare("select * from $nombre ");
		$sql -> execute();
		$sql -> setFetchMode(PDO::FETCH_ASSOC);
		return $sql;
	}catch(PDOException $e) {
		return "No hay prenda</br>";
	}
}
function obtenerTablas($conn) {
	try {
		$sql=$conn->prepare("show tables from prendas");
		$sql -> execute();
		$sql -> setFetchMode(PDO::FETCH_ASSOC);
		return $sql;
	}catch(PDOException $e) {
		return "No hay prendas</br>";
	}
}
?>