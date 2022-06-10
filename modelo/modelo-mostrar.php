<?php 

function calcTC($arrTC) {
	$TCtotal=0;
	for($i=0; $i<sizeof($arrTC); $i++){
		$TCtotal+=$arrTC[$i];
	}
	return $TCtotal;
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
		return "No hay prenda</br>";
	}
}

?>