<?php

require_once('../ddbb/ddbb.php');

require_once('../modelo/modelo-calculo.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$cantidad=$_POST['cantidad'];
	$tiempo=$_POST['tiempo'];
	$prenda=$_POST['nombre'];
	// Datos a guardar en la bbdd
	$arrDes=$_POST['descripcion'];
	$arrMaq=$_POST['maquina'];
	$arrRPM=$_POST['revoluciones'];
	$arrPPC=$_POST['ppc'];
	$arrTC=$_POST['TC'];
	$arrObs=$_POST['observaciones'];
	
	$TCtotal=0;
	$TCtotal=calcTC($arrTC);
	//Crear tabla e insertar datos
	crearTablaPrenda($conn,$prenda);
	for($i=0;$i<count($arrDes);$i++) {
		altaPasoPrenda($conn,$prenda,($i+1),$arrDes[$i],$arrMaq[$i],$arrRPM[$i],$arrPPC[$i],$arrTC[$i],$arrObs[$i]);
	}
	//$verPrenda=obtenerPrenda($prenda);
}

require_once('../vista/vista-calculo.php');


?>