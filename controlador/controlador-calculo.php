<?php

$cantidad=$_POST['cantidad'];
$arrTC=$_POST['TC'];
$tiempo=$_POST['tiempo']; 
$TCtotal=0;

require_once 'modelo-calculo.php';

$TCtotal=calcTC($arrTC);

include_once 'vista-calculo.php';

?>