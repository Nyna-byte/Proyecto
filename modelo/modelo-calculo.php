<?php 
function obtenerPrenda($conn,$nombre) {
	try {
		$sql="select * from fases where nombre_prenda = '$nombre' ";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
		$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(PDOException $e) {
		return "No hay prenda</br>";
	}
}
function obtenerPrendas($conn) {
	try {
		$sql="select distinct nombre_prenda from fases";
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
		$sql="select * from fases where n_fase = '$n_fase' and nombre_prenda = '$nombre'";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
		$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(PDOException $e) {
		return "No hay fase</br>";
	}
}
?>