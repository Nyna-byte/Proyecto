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
function obtenerFase($conn,$nombre,$n_fase) {
	try {
		$sql=$conn->prepare("select * from $nombre where n_fase like $n_fase");
		$sql -> execute();
		$sql -> setFetchMode(PDO::FETCH_ASSOC);
		return $sql;
	}catch(PDOException $e) {
		return "No hay fase</br>";
	}
}
?>