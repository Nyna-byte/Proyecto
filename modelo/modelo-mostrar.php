<?php 

function obtenerPrenda($conn,$nombre) {
	try {
		$sql="select * from fases where nombre_prenda = '$nombre'";
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
function borrarPrenda($conn, $nombre){
	try {
		$sql=$conn->prepare("DELETE FROM fases WHERE nombre_prenda = '$nombre'");
		$sql -> execute();
		return "Prenda borrada con éxito</br>";
	}catch(PDOException $e) {
		return "No hay prenda</br>";
	}
}

?>