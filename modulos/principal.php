<div class="publicitario">
    <div class="imagen_publicitaria">
        <div class="texto_publicidad">
            <p>
                <h1>Compra en</h1>
                <h1>anaqueles</h1>
                <h1>metálicos garcía</h1>
            </p>                    
        </div>
    </div>
</div>

<h3>Ultimos Productos Agregados</h3>
<?php
$q = $mysqli->query("SELECT * FROM productos WHERE oferta = 0 ORDER BY id DESC LIMIT 4");

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
		<div class="producto">
			<div><img class="img_producto" src="productos/<?=$r['imagen']?>"/></div>
			<br>
            <div class="name_producto"><?=$r['name']?></div>
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
			
			<a href="?p=ver_producto&id=<?=$r['id']?>"><button class="btn btn-warning pull-right" style="border-radius:0px 4px 4px 0px"><i class="fa fa-shopping-cart"></i></button></a>
		</div>
	<?php
}
?>


<?php
	$q = $mysqli->query("SELECT * FROM productos WHERE oferta>0 ORDER BY id DESC LIMIT 4");

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
	<h3 style="clear: left">Ultimas Ofertas Agregadas</h3>
		<div class="producto">
			<div class="contenedor_img"><img class="img_producto" src="productos/<?=$r['imagen']?>"/></div>
			<br>
			<div class="name_producto"><?=$r['name']?></div>

			<del><?=$r['price']?> <?=$divisa?></del> <span class="precio"> <?=$preciototal?> <?=$divisa?> </span>
			<a href="?p=ver_producto&id=<?=$r['id']?>"><button class="btn btn-warning pull-right" style="border-radius:0px 4px 4px 0px"><i class="fa fa-shopping-cart"></i></button></a>
			&nbsp; &nbsp;
		</div>
	<?php
}
?>