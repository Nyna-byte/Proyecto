<?php
	require_once('vista-header.php');
?>
	<link rel="stylesheet" href="../css/style.css">
	<div>
		<br/>
		<p>Nombre prenda: <?php echo $prenda;  ?></p>
		<br/>
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
	<a href="../">Volver</a>
	</div>
<?php
$conn=null;
?>
<script src="../js/calculomaquinas.js"></script>