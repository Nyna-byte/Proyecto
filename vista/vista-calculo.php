<?php

if(isset($TCtotal)&&$TCtotal!==0){
    $operarios=calcOperarios($cantidad,$TCtotal,$tiempo); //El tc entre 100 porque son centésimas de minuto
    $equilibrado=calcEquilibrado($TCtotal,$operarios);
    ?> 	<p>Número de operiarios: <?php echo $operarios; ?></p>
		<br/>
		<p>Base de equilibrado: <?php echo $equilibrado; ?></p>
<?php
}
else{  ?>
		<p>No se han introducido tiempos</p>
<?php
}
	
?>
<a href="../">Volver</a>