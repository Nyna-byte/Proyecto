<?php

if(isset($TCtotal)&&$TCtotal!==0){
    $operarios=calcOperarios($cantidad,$TCtotal,$tiempo); //El tc entre 100 porque son centésimas de minuto
    $equilibrado=calcEquilibrado($TCtotal,$operarios);
    ?> 	
	<link rel="stylesheet" href="../css/style.css">
		<p>Nombre prenda: <?php echo $prenda;  ?></p>
		<br/>
		<p>Número de operiarios: <?php echo $operarios;  ?></p>
		<br/>
		<p>Base de equilibrado: <span id="base"><?php echo $equilibrado; ?></span></p>
		<br/>
		<p>Cantidad de máquinas:</p>
		<div id="listamaquinas"></div>
		<table id="table">
			<thead>
				<tr>
					<td>Nº fase</td>
					<td>Descripción fase</td>
					<td>Tipo máquina</td>
					<td>Puntaje</td>
					<td>R.P.M.</td>
					<td>PPC</td>
					<td>TC</td>
					<td>Observaciones</td>
				</tr>
			</thead>
			<tbody>
				<?php for($i=0;$i<count($arrDes);$i++) { ?>
				<tr>
					<td class="descripcion"><?php echo $arrDes[$i]; ?></td>
					<td class="maquina"><?php echo $arrMaq[$i]; ?></td>
					<td class="puntaje"><?php echo puntajeMaq($arrMaq[$i]); ?></td>
					<td class="rpm"><?php echo $arrRPM[$i]; ?></td>
					<td class="ppc"><?php echo $arrPPC[$i]; ?></td>
					<td class="tc"><?php echo $arrTC[$i]; ?></td>
					<td class="observaciones"><?php echo $arrObs[$i]; ?></td>
				</tr>
				<?php } ?>
			</tbody>
		</table>
		<br/>
		<?php 
			/*foreach($mostrarPasos as $paso) {
				 var_dump($paso);?> 
				
				<?php
			}*/
		?>
<?php
}
else{  ?>
		<p>No se han introducido tiempos</p>
		<br/>
<?php
}
	
?>
<a href="../">Volver</a>

<?php
$conn=null;
?>

<script src="../js/calculomaquinas.js"></script>