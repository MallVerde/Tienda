<?php

?>

<h1><i class="fa fa-shopping-cart"></i> Mis Pedidos</h1>
<br><br>

<table class="table table-striped">
	<tr>
		<th>Nombre Del Cliente</th>
		<th>Tipo de pago</th>
		<th>Fecha de Pago</th>
		<th>Fecha estimada de envio</th>
		<th>Fecha estimada de llegada</th>
		<th>Método de entrega</th>
		<th>Monto de pago</th>
	</tr>
<?php
$id_cliente = clear($_SESSION['id_cliente']);

$q = $mysqli->query("SELECT * FROM envios NATURAL JOIN pagos where id_cliente = '$id_cliente'");


while($r = mysqli_fetch_array($q)){
		$q2 = $mysqli->query("SELECT * FROM envios WHERE id_cliente = '".$r['id_cliente']."'");
		$r2 = mysqli_fetch_array($q2);	
		$q3 = $mysqli->query("SELECT * FROM clientes WHERE id = '".$r['id_cliente']."'");
		$r3 = mysqli_fetch_array($q3);	
		$q4 = $mysqli->query("SELECT * FROM paqintern WHERE ID_Envio = '".$r['ID_Envio']."'");
		$r4 = mysqli_fetch_array($q4);	
	?>
	<?php if($r3['id']==$r2['id_cliente'])
	echo"
		<tr>
			<td>$r3[nombre] $r3[apellido]</td>
			<td>$r[Tipo_pago] de $r[Tipo_tarjeta]</td>
			<td>$r[fecha_pago]</td>
			<td>$r4[Fecha_envio]</td>
			<td>$r4[Fecha_llegada]</td>
			<td>$r[Metodo_Entrega]</td>
			<td>$$r[Monto_pago]</td>	
		</tr>
		";
	?>
	<?php
}
?>
</table>

<script type="text/javascript">
	function modificar(idc){
		var new_cant = prompt("¿Cual es la nueva cantidad?");

		if(new_cant>0){
			window.location="?p=carrito&id="+idc+"&modificar="+new_cant;
		}
	}
</script>