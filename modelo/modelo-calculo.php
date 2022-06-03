<?php 
function calcOperarios($cantidad, $TCtotal, $tiempo) {
	$operarios=round(($cantidad*($TCtotal/100))/$tiempo);
	if($operarios==0) {
		$operarios=1;
	}
	return $operarios;
	//El tc entre 100 porque son centésimas de minuto
}
function calcEquilibrado($TCtotal, $operarios) {
	return (($TCtotal/100)/$operarios)*100;
}
function calcTC($arrTC) {
	$TCtotal=0;
	for($i=0; $i<sizeof($arrTC); $i++){
		$TCtotal+=$arrTC[$i];
	}
	return $TCtotal;
}
?>
