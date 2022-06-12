<?php

require_once('../ddbb/ddbb.php');

require_once('../modelo/modelo-crear.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$prenda=$_POST['nombre'];
	// Datos a guardar en la bbdd
	$arrDes=$_POST['descripcion'];
	$arrMaq=$_POST['maquina'];
	$arrRPM=$_POST['revoluciones'];
	$arrPPC=$_POST['ppc'];
	$arrTC=$_POST['TC'];
	$arrObs=$_POST['observaciones'];
	
	//Crear tabla e insertar datos
	crearTablaPrenda($conn,$prenda);
	for($i=0;$i<count($arrDes);$i++) {
		altaPasoPrenda($conn,$prenda,($i+1),$arrDes[$i],$arrMaq[$i],$arrRPM[$i],$arrPPC[$i],$arrTC[$i],$arrObs[$i]);
	}
	require_once('../vista/vista-crear.php');
} else {
	header('../index.html');
}




?>