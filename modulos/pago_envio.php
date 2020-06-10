<?php
if (isset($_SESSION['id_cliente'])) {
} else {
    header("Location:?p=principal");
}

$monto_total;
$costo_envio = 200;
$total = $costo_envio + $monto_total;

$id_cliente = $_SESSION['id_cliente'];
$query_cliente = mysqli_query($mysqli, "SELECT * FROM clientes WHERE id =$id_cliente");
$row = mysqli_fetch_array($query_cliente);


$query_envios = mysqli_query($mysqli, "SELECT * FROM envios ORDER BY ID_Envio DESC LIMIT 1;");
$envios = mysqli_fetch_array($query_envios);
$ID_Envio = $envios['ID_Envio'] + 1;



$query_pagos = mysqli_query($mysqli, "SELECT * FROM pagos ORDER BY ID_Envio DESC LIMIT 1;");
$id_pagos = mysqli_fetch_array($query_pagos);
$ID_pago = $id_pagos['ID_pago'] + 1;



if (isset($pagar)) {
    $nombre = $_POST['nombre'];
    $apellido = $_POST['apellido'];
    $direccion = $_POST['direccion'];
    $codigo_postal = $_POST['codigo_postal'];
    $estado = clear($estado);
    $email = $_POST['email'];
    $localidad = $_POST['localidad'];
    $telefono = $_POST['telefono'];
    $nombre_tarjeta = clear($nombre_tarjeta);
    $tipo_tarjeta = clear($tipo_tarjeta);
    $factura = clear($factura);

    $fechaPago = date('Y/m/d', time());

    $fechaEnvio = date('Y/m/d', time());
    $fechaEnvio = str_replace('/', '-', $fechaEnvio);
    $fechaEnvio = date('Y-m-d', strtotime($fechaEnvio . ' + 1 days'));

    $fechaLlegada = date('Y/m/d', time());
    $fechaLlegada = str_replace('/', '-', $fechaLlegada);
    $fechaLlegada = date('Y-m-d', strtotime($fechaLlegada . ' + 4 days'));

    if ($factura == '1') {
        $mysqli->query("INSERT INTO facturacion (ID_pago,Fecha) 
        VALUES ('$ID_pago',NULL)");

        $mysqli->query("INSERT INTO envios (Nombre,Apellido,Direccion,Cod_Postal,Estado, Localidad, Telefono,Email,Metodo_Entrega,id_cliente) 
        VALUES ('$nombre','$apellido','$direccion','$codigo_postal','$estado','$localidad','$telefono','$email','Estándar','$id_cliente')");
        $Tipo_pago = 'Tarjeta';

        $mysqli->query("INSERT INTO pagos (ID_Envio,dueno_tarjeta,Tipo_tarjeta,Tipo_pago, Monto_pago,fecha_pago) 
        VALUES ('$ID_Envio','$nombre_tarjeta','$tipo_tarjeta','$Tipo_pago','$total','$fechaPago')");

        $mysqli->query("INSERT INTO paqintern (ID_Envio,Fecha_envio,Fecha_llegada) 
        VALUES ('$ID_Envio','$fechaEnvio','$fechaLlegada')");

        $carro = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");

        while ($rcarro = mysqli_fetch_array($carro)) {

            $total_monto = $rcarro['monto'] * $rcarro['cant'];

            $mysqli->query("INSERT INTO productos_compra (id_pago,id_producto,cantidad,monto,monto_total) VALUES ('$ID_pago','" . $rcarro['id_producto'] . "','" . $rcarro['cant'] . "','$rcarro[monto]','$total_monto')");
        }

        $mysqli->query("DELETE FROM carro WHERE id_cliente = '$id_cliente'");
        redir("?p=carrito");
    } else {
        $mysqli->query("INSERT INTO envios (Nombre,Apellido,Direccion,Cod_Postal,Estado, Localidad, Telefono,Email,Metodo_Entrega,id_cliente) 
        VALUES ('$nombre','$apellido','$direccion','$codigo_postal','$estado','$localidad','$telefono','$email','Estándar','$id_cliente')");
        $Tipo_pago = 'Tarjeta';

        $mysqli->query("INSERT INTO pagos (ID_Envio,dueno_tarjeta,Tipo_tarjeta,Tipo_pago, Monto_pago,fecha_pago) 
        VALUES ('$ID_Envio','$nombre_tarjeta','$tipo_tarjeta','$Tipo_pago','$total','$fechaPago'");

        $mysqli->query("INSERT INTO paqintern (ID_Envio,Fecha_envio,Fecha_llegada) 
        VALUES ('$ID_Envio','$fechaEnvio','$fechaLlegada')");

        $carro = $mysqli->query("SELECT * FROM carro WHERE id_cliente = '$id_cliente'");

        while ($rcarro = mysqli_fetch_array($carro)) {

            $total_monto = $rcarro['monto'] * $rcarro['cant'];

            $mysqli->query("INSERT INTO productos_compra (id_pago,id_producto,cantidad,monto,monto_total) VALUES ('$ID_pago','" . $rcarro['id_producto'] . "','" . $rcarro['cant'] . "','$rcarro[monto]','$total_monto')");
        }


        $mysqli->query("DELETE FROM carro WHERE id_cliente = '$id_cliente'");
        redir("?p=carrito");
    }
}
?>

<style type="text/css">
    #metodo_envio,
    #triste {
        display: none;
    }
</style>
<div class="alerta_covid">
    <h3>Debido a la situación sanitaria COVID-19, la opción de Recoger en Tienda no está disponible temporalmente</h3>
</div>
<div class="padre_pago">
    <form action="" method="post">
        <div class="titulo_envio">
            <h3>1. Envío</h3>
        </div>
        <div id="caja_envio">
            <div id="formulario_envio">
                <table style="width: 100%;">
                    <tr>
                        <td><br> Nombre</td>
                        <td><br><input type="text" name="nombre" autocomplete="off" required></td>
                    </tr>

                    <tr>
                        <td><br>Apellido</td>
                        <td><br><input type="text" name="apellido" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td><br>Dirección</td>
                        <td><br><input type="text" name="direccion" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td><br>Código postal</td>
                        <td><br><input type="text" name="codigo_postal" autocomplete="off" required maxlength="5"></td>
                    </tr>
                    <tr>
                        <td><br>Localidad</td>
                        <td><br><input type="text" name="localidad" autocomplete="off" required></td>
                    </tr>
                    <tr>
                        <td><br>Estado</td>
                        <td>
                            <br>
                            <select name="estado" required>
                                <option value="">Selecciona un estado</option>
                                <option value="Aguas Calientes">Aguas Calientes</option>
                                <option value="Baja California">Baja California</option>
                                <option value="Baja California Sur">Baja California Sur</option>
                                <option value="Campeche">Campeche</option>
                                <option value="Coahuila">Coahuila</option>
                                <option value="Colima">Colima</option>
                                <option value="Chiapas">Chiapas</option>
                                <option value="Chihuahua">Chihuahua</option>
                                <option value="Durango">Durango</option>
                                <option value="Guanajuato">Guanajuato</option>
                                <option value="Gerrero<">Gerrero</option>
                                <option value="Hidalgo">Hidalgo</option>
                                <option value="Jalisco">Jalisco</option>
                                <option value="México">México</option>
                                <option value="Michoacán">Michoacán</option>
                                <option value="Morelos">Morelos</option>
                                <option value="Nayarit">Nayarit</option>
                                <option value="Nuevo León">Nuevo León</option>
                                <option value="Oaxaca">Oaxaca</option>
                                <option value="Puebla">Puebla</option>
                                <option value="Querétaro">Querétaro</option>
                                <option value="Quintana Roo">Quintana Roo</option>
                                <option value="San Luis Potosí">San Luis Potosí</option>
                                <option value="Sinaloa">Sinaloa</option>
                                <option value="Sonora">Sonora</option>
                                <option value="Tabasco">Tabasco</option>
                                <option value="Tamaulipas">Tamaulipas</option>
                                <option value="Tlaxcala">Tlaxcala</option>
                                <option value="Veracruz">Veracruz</option>
                                <option value="Yucatán">Yucatán</option>
                                <option value="Zacatecas">Zacatecas</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td><br>País/Región</td>
                        <td><br><b>México</b></td>
                    </tr>
                    <tr>
                        <td><br>Télefono de envio</td>
                        <td><br><input type="text" name="telefono" autocomplete="off" required maxlength="10" onkeypress="return soloNumeros(event);" id="tel"> </td>
                    </tr>
                    <tr>
                        <td><br>Correo eléctronico</td>
                        <td><br><input type="email" name="email" autocomplete="off" required></td>
                    </tr>
                </table>
                <br>
                Método de entrega <br><br>
                <input type="radio" value="Venta" name="movimiento" checked> <b>Estándar </b>$<?= $costo_envio ?>
            </div>
            <div class="boton_seguir">
                <table style="width: 100%;">
                    <td><a href="javascript:void(0);" onclick="ocultarEnvio();"><button>Continuar a pago</button></a></td>
                </table>
            </div>
        </div>
        <br>
        <div class="titulo_pago">
            <h3>2. Pago</h3>
        </div>
        <div id="caja_pago">
            <div id="metodo_pago">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <h4>Tarjeta de crédito o débito</h4>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <h4>Factura</h4>
                        </td>
                        <td>
                            <select name="factura" id="" style="width: 100%;">
                                <option value="1">Si Realizar factura</option>
                                <option value="0">No Realizar factura</option>
                            </select>
                        </td>
                    </tr>
                </table>
            </div>

            <div id="acepto_condiciones_pago">
                <p style="text-align: justify;">
                    Si haces clic en “Pagar”, confirmas que leíste, entendiste y aceptaste nuestros <a href="https://www.eshopworld.com/terms-and-conditions-of-sale-es/">Términos y condiciones de venta</a>. Comprendo que mi pedido no se puede modificar una vez realizado.
                </p>
            </div>
            <div id="tarjeta_debito">
                <input type="text" name="nombre_tarjeta" autocomplete="off" required style="width: 100%;">
                <select name="tipo_tarjeta" id="" required>
                    <option value="Crédito">Crédito</option>
                    <option value="Débito">Débito</option>
                </select>

                <input type="text" placeholder="Número de tarjeta" style="width: 100%;" required autocomplete="off" maxlength="19">
                <table style="width: 100%;">
                    <tr>
                        <td>
                            <input style="width:100%; display:inline-block" class="form-control" type="text" maxlength="2" autocomplete="off" id="mes" name="mes" required onkeypress="return soloNumeros(event);">
                        </td>
                        <td>
                            <input style="width:100%; display:inline-block" class="form-control" type="text" maxlength="2" autocomplete="off" id="año" name="año" required onkeypress="return soloNumeros(event);">
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-success" name="pagar" style="width: 100%;">Pagar $<?= $total ?></button>
            </div>
            <div class="boton_seguir">
                <table style="width: 100%;">
                    <tr>
                        <td><a href="javascript:void(0);" onclick="ocultarPago();"><button style="float: left;">Regresar a envio</button></a></td>
                    </tr>
                </table>
            </div>
        </div>
    </form>
</div>


<!--------Aquí empieza el aside-------->

<div class="datos_envio_pago">
    <h3>Resumen</h3>
    <div>
        <table style="width: 100%;">
            <tr>
                <td>
                    <h5>SUBTOTAL</h5>
                </td>
                <td>$<?= $monto_total ?></td>
            </tr>
            <tr>
                <td>
                    <h5>COSTO DE ENVIO Y MANEJO</h5>
                </td>
                <td>$<?= $costo_envio ?></td>
            </tr>
            <tr>
                <td>
                    <h4>TOTAL</h4>
                </td>
                <td style="color: #fa5400;">$<?= $total ?></td>
            </tr>
        </table>
    </div>
</div>
<!----------Aquí termina el aside-------->
<script src="js/solonumeros.js"></script>

<script type="text/javascript">
    function ocultarEnvio() {
        document.getElementById('caja_envio').style.display = 'none';
        document.getElementById('caja_pago').style.display = 'block';
    }

    function ocultarPago() {
        document.getElementById('caja_envio').style.display = 'block';
        document.getElementById('caja_pago').style.display = 'none';
    }
</script>