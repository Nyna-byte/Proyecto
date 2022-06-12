<?php

require_once('../ddbb/ddbb.php');

require_once('../modelo/modelo-calculo.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["mostrarPrenda"])){
		$nombre=$_POST['table'];
		$prenda=obtenerPrenda($conn,$nombre);
	}else if(isset($_POST["calcularPrenda"])) {
		$nombre=$_POST['table'];
		$prenda=obtenerPrenda($conn,$nombre);
		$cantidad=$_POST['cantidad'];
		$tiempo=$_POST['tiempo'];
		// Datos sacados de la base de datos
		$TCtotal=0;
		foreach($prenda as $valor) {
			$TCtotal+=$valor['tc'];
		}
		$prenda=obtenerPrenda($conn,$nombre);
	}
}
$tablas=obtenerTablas($conn);

require_once('../vista/vista-calculo.php');


?>