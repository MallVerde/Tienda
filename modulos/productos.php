<?php
	if(isset($agregar) && isset($cant)){
		$idp = clear($agregar);
		$cant = clear($cant);
		
		$id_cliente = clear($_SESSION['id_cliente']);

		$v = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");

		if(mysqli_num_rows($v)>0){
			$q = $mysqli->query("UPDATE carro SET cant = cant + $cant WHERE id_cliente = '$id_cliente' AND id_producto = '$idp'");
		}
		else{
			$q = $mysqli->query("INSERT INTO carro (id_cliente,id_producto,cant) VALUES ($id_cliente,$idp,$cant)");
		}
		alert("Se ha agregado al carro de compras",1,'productos');
	}

	if(isset($busq)){
		$q = $mysqli->query("SELECT * FROM productos WHERE name like '%$busq%'");
	}elseif(isset($busq)){
		$q = $mysqli->query("SELECT * FROM productos WHERE name like '%$busq%'");
	}elseif(!isset($busq)){
		$q = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
	}else{
		$q = $mysqli->query("SELECT * FROM productos ORDER BY id DESC");
	}
?>
	<div class="buscar">
		<form method="post" action="" class="">
			<div class="row">
				<div class="col-md-11">
					<div class="form-group">
						<input type="text" class="form-control" name="busq" placeholder="Buscar..."/>
					</div>
				</div>
				<div class="col-md-1">
					<button type="submit" class="btn btn-prmiary" name="buscar">Buscar</button>
				</div>
			</div>
		</form>
	</div>
	
<?php
while($r=mysqli_fetch_array($q)){
	$preciototal = 0;
			if($r['oferta']>0){
				if(strlen($r['oferta'])==1){
					$desc = "0.0".$r['oferta'];
				}else{
					$desc = "0.".$r['oferta'];
				}

				$preciototal = $r['price'] -($r['price'] * $desc);
			}else{
				$preciototal = $r['price'];
			}
	?>
		<div class="productos">
			<div class="producto">
				<div class="contenedor_img"><img class="img_producto" src="productos/<?=$r['imagen']?>"/></div>
				<div class="name_producto">
					<?=$r['name']?>
				</div>
				<?php
				if($r['oferta']>0){
					?>
					<del><?=$r['price']?> <?=$divisa?></del> <span class="precio"> <?=$preciototal?> <?=$divisa?> </span>
					<?php
				}else{
					?>
					<span class="precio"><br><?=$r['price']?> <?=$divisa?></span>
					<?php
				}
				?>
				<button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>
			</div>
		</div>
	<?php
}
?>

<script type="text/javascript">
	
	function agregar_carro(idp){
		var cant = prompt("¿Que cantidad desea agregar?",1);

		if(cant.length>0){
			window.location="?p=productos&agregar="+idp+"&cant="+cant;
		}
	}

</script>