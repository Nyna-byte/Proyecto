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
function altaPasoPrenda($conn,$nombre,$fase,$desc,$maq,$rpm,$ppc,$tc,$obs) {
	$punt=puntajeMaq($maq);
	try {
		$sql = "INSERT INTO fases (nombre_prenda,n_fase,descripcion_fase,maquina,puntada,rpm,ppc,tc,observaciones) VALUES ('$nombre','$fase','$desc','$maq','$punt','$rpm','$ppc','$tc','$obs')";
		$conn->exec($sql);
		echo "Fase añadida con exito<br>";
	} catch(PDOException $e){
		var_dump($e);
		echo "No se puede añadir la fase <br>";
	}
}

function comprobarNombre($conn,$nombre){
	try {
		$sql="select count(*) from fases where nombre_prenda = '$nombre'";
		$gsent=$conn->prepare($sql);
		$gsent->execute();
		$resultado = $gsent->fetchAll(PDO::FETCH_ASSOC);
		return $resultado;
	}catch(PDOException $e) {
		return "Error en la consulta '$e' </br>";
	}
	
}
?>