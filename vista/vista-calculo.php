<?php
	require_once('vista-header.php');
?>
<link rel="stylesheet" href="../css/style.css">
<div>
	<br/>
	<?php
	if(isset($TCtotal)&&$TCtotal!=0&&$tiempo!=0&&$cantidad!=0){
		
	} else{ 
	?>
			
	<form id="formulario" name="formulario" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" >
		<br/>
		<label for="cantidad">Cantidad a producir</label>
		<input type="text" name="cantidad" id="cantidad" name="cantidad" value="0" required><br><br>
		<label for="tiempoTrabajo">Minutos por día de trabajo</label>
		<input type="text" name="tiempo" id="tiempo" name="tiempo" value="0" required><br><br>
		<label> Elige la prenda sobre la que calcular:</label>
		<select name="table">
		<?php
			foreach($tablas as $tabla) {
				?> 
					<option value="<?php echo $tabla['Tables_in_prendas']; ?>">
					<?php echo $tabla['Tables_in_prendas']; ?>
					</option>
				<?php 
			} ?>
		
		</select>
		<br/><br/>
		<div>
			<input type="submit" value="Mostrar prenda" name="mostrarPrenda">
			<input type="submit" value="Calcular prenda" name="calcularPrenda">
		</div>
		<br/>
	</form>
			
	<?php } ?>
	<?php
	if(isset($_POST["calcularPrenda"])&&$tiempo!=0&&$cantidad!=0) { 
		$operarios=calcOperarios($cantidad,$TCtotal,$tiempo); //El tc entre 100 porque son centésimas de minuto
		$equilibrado=calcEquilibrado($TCtotal,$operarios);
	?>
	<p>Nombre prenda: <?php echo $nombre;  ?></p>
	<p>Número de operiarios: <?php echo $operarios;  ?></p>
	<p>Base de equilibrado: <span id="base"><?php echo $equilibrado; ?></span></p>
	<p>Cantidad de máquinas:</p>
	<div id="listamaquinas"></div>
	<table id="table">
	<thead>
		<tr>
			<td>Nº fase</td>
			<td>Descripción fase</td>
			<td>Tipo máquina</td>
			<td>Puntada</td>
			<td>R.P.M.</td>
			<td>PPC</td>
			<td>TC</td>
			<td>Observaciones</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($prenda as $paso ) { ?>
		<tr>
			<td class="descripcion"><?php echo $paso['descripcion_fase']; ?></td>
			<td class="maquina"><?php echo $paso['maquina']; ?></td>
			<td class="puntada"><?php echo $paso['puntada']; ?></td>
			<td class="rpm"><?php echo $paso['rpm']; ?></td>
			<td class="ppc"><?php echo $paso['ppc']; ?></td>
			<td class="tc"><?php echo $paso['tc']; ?></td>
			<td class="observaciones"><?php echo $paso['observaciones']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
	</table>
	<br/> 
	<?php 
	} else if(isset($_POST["mostrarPrenda"])) {
	?>
	<p>Se muestra la siguiente prenda <?php echo $nombre;?>: </p>
	<table id="table">
	<thead>
		<tr>
			<td>Nº fase</td>
			<td>Descripción fase</td>
			<td>Tipo máquina</td>
			<td>Puntada</td>
			<td>R.P.M.</td>
			<td>PPC</td>
			<td>TC</td>
			<td>Observaciones</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($prenda as $paso ) { ?>
		<tr>
			<td class="descripcion"><?php echo $paso['descripcion_fase']; ?></td>
			<td class="maquina"><?php echo $paso['maquina']; ?></td>
			<td class="puntada"><?php echo $paso['puntada']; ?></td>
			<td class="rpm"><?php echo $paso['rpm']; ?></td>
			<td class="ppc"><?php echo $paso['ppc']; ?></td>
			<td class="tc"><?php echo $paso['tc']; ?></td>
			<td class="observaciones"><?php echo $paso['observaciones']; ?></td>
		</tr>
		<?php } ?>
	</tbody>
	</table>
	<br/> 
	<?php } ?>
	<a href="../">Volver</a>
</div>
<?php
$conn=null;
?>
<script src="../js/calculomaquinas.js"></script>