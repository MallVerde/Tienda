<?php
    $q = $mysqli->query("SELECT * FROM productos where id =$id");
?>

<?php
while ($r = mysqli_fetch_array($q)) {
    $preciototal = 0;
    if ($r['oferta'] > 0) {
        if (strlen($r['oferta']) == 1) {
            $desc = "0.0" . $r['oferta'];
        } else {
            $desc = "0." . $r['oferta'];
        }
        $preciototal = $r['price'] - ($r['price'] * $desc);
    } else {
        $preciototal = $r['price'];
    }
?>
    <div class="cont_vistaproducto">
        <div class="producto_izquierda">
            <img class="" src="productos/<?= $r['imagen'] ?>" />
        </div>

        <div class="producto_derecha">
            <h1 class="name_producto"><?= $r['name'] ?></h1>
            <hr style="border: 1px solid;">
            <div class="opciones_compra">
                <div>
                    <?php
                    if ($r['oferta'] > 0) {
                    ?>
                        <br>
                        <del style="font-size: 20px;"><?= $r['price'] ?> <?= $divisa ?></del> <span style="font-size: 20px;" class="precio"> <?= $preciototal ?> <?= $divisa ?> </span>
                    <?php
                    } else {
                    ?>
                        <span style="font-size:20px;" class="precio"><br><?= $r['price'] ?> <?= $divisa ?></span>
                    <?php
                    }
                    ?>
                </div>  
            
                <div>
                    <h4 style="float: right;">Cantidad</h4>
                    <br>
                    <br>
                    <br>
                    <input type="number" id="cant<?=$r['id']?>" name="cant" class="cant pull-right" value="1" min="1" pattern="^[0-9]+" />
                </div>

                <button class="btn btn-warning pull-right" onclick="agregar_carro('<?=$r['id']?>');"><i class="fa fa-shopping-cart"></i></button>
            </div>
        </div>
    </div>
<?php
}
?>

<script type="text/javascript">
    function agregar_carro(idp) {
        cant = $("#cant" + idp).val();
        if (cant.length > 0) {
            window.location = "?p=productos&agregar=" + idp + "&cant=" + cant;
        }
    };
</script>