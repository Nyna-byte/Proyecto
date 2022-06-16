<?php 

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
function borrarPrenda($conn, $nombre){
	try {
		$sql=$conn->prepare("drop table $nombre ");
		$sql -> execute();
		return "Prenda borrada con éxito</br>";
	}catch(PDOException $e) {
		return "No hay prenda</br>";
	}
}

?>