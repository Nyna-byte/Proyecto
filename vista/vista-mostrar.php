<link rel="stylesheet" href="../css/style.css">
<br/>
<p> Elige una prenda para mostrar su contenido:</p>
<br/>
<form id="formulario" name="formulario" method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>" >
	<select name="table">
	<?php
		foreach($tablas as $tabla) {
			?> 
				<option value="<?php echo $tabla['Tables_in_prendas']; ?>">
				<?php echo $tabla['Tables_in_prendas']; ?>
				</option>
			<?php 
		}
	?>
	</select>
	<br/><br/>
	<div>
		<input type="submit" value="Consultar" name="consultarPrenda">
	</div>
	<br/>
</form>
<?php
if(isset($prenda)){
    ?> 	
	
		<p>Nombre prenda: <?php echo $prenda;  ?></p>
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
				<?php foreach($verPrenda as $paso ) { ?>
				<tr>
					<td class="fase"><?php echo $paso['n_fase']; ?></td>
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
}

$conn=null;
?>