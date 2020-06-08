<?php
check_admin();
?>
<br>
<div>
	<a href="?p=agregar_producto">
		<button class="btn btn-primary"> <i class="fa fa-plus-circle"></i> Agregar producto</button>
	</a>
</div>

<h1>Pagos de los clientes</h1>
<table class="table table-striped">
	<tr>
		<th>Nombre del cliente</th>
		<th>Fecha de pago</th>
		<th>Tipo de pago</th>
		<th>Monto de pago</th>
	</tr>

	<?php
	$s = $mysqli->query("SELECT * FROM pagos");
	while ($r = mysqli_fetch_array($s)) {
	?>
		<tr>
			<td><?=$r['dueno_tarjeta'] ?></td>
			<td><?=$r['fecha_pago']?></td>
			<td><?=$r['Tipo_pago']?> de <?=$r['Tipo_tarjeta']?></td>
			<td><?=$r['Monto_pago'] ?></td>
		</tr>
	<?php
	}
	?>
</table>