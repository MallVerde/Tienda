<?php

if (isset($agregar) && isset($cant)) {
	check_user("productos");
	$idp = clear($agregar);
	$cant = clear($cant);
	$id_cliente = clear($_SESSION['id_cliente']);

	$v = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");

	if (mysqli_num_rows($v) > 0) {

		$q = $mysqli->query("UPDATE carro SET cant = cant + $cant WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
	} else {

		$q = $mysqli->query("INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");
	}
	$messages[] = "Su producto se ha ingresado al carrito de compras";
}
?>

<?php
if (isset($messages)) {
?>
	<div class="alert alert-success" role="alert">
		<button type="button" class="close" data-dismiss="alert">&times;</button>
		<strong>¡Bien hecho!</strong>
		<?php
		foreach ($messages as $message) {
			echo $message;
		}
		?>
	</div>
<?php
}
?>


<div id="loader" class="text-center"> <span><img src="img/ajax-loader.gif"></span></div>
<div class="outer_div"></div><!-- Datos ajax Final -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

<script type="text/javascript">
		$(document).ready(function() {
		load(1);
	});

	function load(page) {
		var parametros = {
			"action": "ajax",
			"page": page
		};
		$.ajax({
			url: 'ajax/banner_ajax.php',
			data: parametros,
			beforeSend: function(objeto) {
				$("#loader").html("<img src='img/ajax-loader.gif'>");
			},
			success: function(data) {
				$(".outer_div").html(data).fadeIn('slow');
				$("#loader").html("");
			}
		})
	}
</script>

