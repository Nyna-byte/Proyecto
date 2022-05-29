<?php

$cantidad=$_POST['cantidad'];
$arrTC=$_POST['TC'];
$tiempo=$_POST['tiempo']; 

$TCtotal=0;
for($i=0; $i<sizeof($arrTC); $i++){
    $TCtotal+=$arrTC[$i];
}
if($TCtotal!==0){
    $operarios=($cantidad*($TCtotal/100))/$tiempo; //El tc entre 100 porque son centésimas de minuto
    $equilibrado=(($TCtotal/100)/$operarios)*100;
    echo "Número de operiarios: $operarios";
    echo "Base de equilibrado: $equilibrado";
}
else{
    echo "No se han introducido tiempos";
}

?>