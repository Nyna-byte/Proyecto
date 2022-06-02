<?php



require_once('../modelo/modelo-calculo.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){
	$cantidad=$_POST['cantidad'];
	$arrTC=$_POST['TC'];
	$tiempo=$_POST['tiempo']; 
	$TCtotal=0;
	$TCtotal=calcTC($arrTC);
}

require_once('../vista/vista-calculo.php');


?>