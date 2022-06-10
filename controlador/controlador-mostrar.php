<?php

require_once('../ddbb/ddbb.php');

require_once('../modelo/modelo-mostrar.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	if(isset($_POST["consultarPrenda"])){
		$prenda=$_POST["table"];
		$verPrenda=obtenerPrenda($conn,$prenda);
	}
}
$tablas=obtenerTablas($conn);
require_once('../vista/vista-mostrar.php');


?>