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
function crearTablaPrenda($conn,$nombre) {
	try {
		$sql = "CREATE TABLE ".$nombre." (n_fase int(3) PRIMARY KEY, descripcion_fase varchar(20) not null, maquina varchar(20) not null, puntada varchar(20), rpm varchar(10), ppc varchar(10), tc varchar(10) not null, observaciones varchar(80)) ENGINE=InnoDB";
		$conn->exec($sql);
		echo "Prenda añadida con exito<br>";
	}catch(PDOException $e) {
		echo "No se puede añadir la prenda<br>";
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
function altaPasoPrenda($conn,$nombre,$fase,$desc,$maq,$rpm,$ppc,$tc,$obs) {
	$punt=puntajeMaq($maq);
	try {
		$sql = "INSERT INTO ".$nombre." (n_fase,descripcion_fase,maquina,puntada,rpm,ppc,tc,observaciones) VALUES ('$fase','$desc','$maq','$punt','$rpm','$ppc','$tc','$obs')";
		$conn->exec($sql);
		echo "Fase añadida con exito<br>";
	} catch(PDOException $e){
		echo "No se puede añadir la fase <br>";
	}
}
?>