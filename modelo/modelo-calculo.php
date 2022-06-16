<?php 
function obtenerPrenda($conn,$nombre) {
	try {
		$sql="select * from $nombre ";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
		$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
		#$sql=$conn->prepare("select * from $nombre ");
		#$sql -> execute();
		#$sql -> setFetchMode(PDO::FETCH_ASSOC);
		#return $sql;
	}catch(PDOException $e) {
		return "No hay prenda</br>";
	}
}
function obtenerTablas($conn) {
	try {
		$sql="show tables from prendas";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
		$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(PDOException $e) {
		return "No hay prendas</br>";
	}
}
function obtenerFase($conn,$nombre,$n_fase) {
	try {
		$sql="select * from $nombre where n_fase like $n_fase";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
		$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(PDOException $e) {
		return "No hay fase</br>";
	}
}
?>