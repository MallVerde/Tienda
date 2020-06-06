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
    <div class="titulo_envio">
        <h3>1. Envío</h3>
    </div>
    <div id="caja_envio">
        <div id="formulario_envio">
            <form action="">
                <table style="width: 100%;">
                    <tr>
                        <td><br> Nombre</td>
                        <td><br><input type="text" name="nombre"></td>
                    </tr>

                    <tr>
                        <td><br>Apellido</td>
                        <td><br><input type="text" name="apellido"></td>
                    </tr>
                    <tr>
                        <td><br>Dirección</td>
                        <td><br><input type="text" name="direccion"></td>
                    </tr>
                    <tr>
                        <td><br>Código postal</td>
                        <td><br><input type="text" name="codigo_postal"></td>
                    </tr>
                    <tr>
                        <td><br>Localidad</td>
                        <td><br><input type="text" name="localidad"></td>
                    </tr>
                    <tr>
                        <td><br>Provincia o territorio</td>
                        <td>
                            <br>
                            <select name="provincia">
                                <option value="">Selecciona una provincia</option>
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
                        <td><br><input type="text" name="telefono"> </td>
                    </tr>
                    <tr>
                        <td><br>Correo eléctronico</td>
                        <td><br><input type="text" name="email"></td>
                    </tr>
                </table>
                <br>
                Método de entrega <br><br>
                <input type="radio" value="Venta" name="movimiento" checked> <b>Estándar </b>$<?= $costo_envio ?>
                <br>
                <br>
                <input type="submit" value="Guardar información" name="guardar_envio">
                </form>
        </div>
        <div class="boton_seguir">
            <table style="width: 100%;">
                <td><a href="javascript:void(0);" onclick="ocultarEnvio();"><button>Continuar a facturación</button></a></td>
            </table>
        </div>
    </div>
    <br>
    <div class="titulo_facturacion">
        <h3>2. Facturación</h3>
    </div>
    <div id="caja_facturacion">
        <div id="formulario_facturacion">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur vel consectetur cumque dolorum modi, sapiente delectus ea sed. Minus nostrum perspiciatis quia doloribus rem ratione! Id earum in obcaecati fugit!
            </p>
        </div>
        <div class="boton_seguir">
            <table style="width: 100%;">
                <tr>
                    <td><a href="javascript:void(0);" onclick="mostrarEnvio();"><button style="float: left;">Regresar a envio</button></a></td>
                    <td><a href="javascript:void(0);" onclick="ocultarFacturacion();"><button>Continuar a pago</button></a></td>
                </tr>
            </table>
        </div>
    </div>
    <br>
    <div class="titulo_pago">
        <h3>3. Pago</h3>
    </div>
    <div id="caja_pago">
        <div id="metodo_pago">
            <table style="width: 40%;">
                <tr>
                    <td><input name="modo_pago" type="radio" value="VALUE" id="" onclick="ocultarPaypal()" checked>Tarjeta de crédito o débito</td>
                    <td><input name="modo_pago" type="radio" value="VALUE" id="" onclick="ocultarDebito();">Paypal</td>
                </tr>
            </table>
        </div>

        <div id="acepto_condiciones_pago">
            <p>
                Si haces clic en “Pagar”, confirmas que leíste, entendiste y aceptaste nuestros <a href="https://www.eshopworld.com/terms-and-conditions-of-sale-es/">Términos y condiciones de venta</a>. Comprendo que mi pedido no se puede modificar una vez realizado.
            </p>
        </div>
        <div id="tarjeta_debito">
            <input type="text" placeholder="Nombre" style="width: 100%;">
            <select name="" id="">
                <option value="Crédito">Crédito</option>
                <option value="Débito">Débito</option>
            </select>

            <input type="text" placeholder="Número de tarjeta" style="width: 100%;">
            <table style="width: 100%;">
                <tr>
                    <td><input type="text" placeholder="CSC" style="width: 100%;"></td>
                    <td><input type="text" placeholder="MM/AA" style="width: 100%;"></td>
                </tr>
            </table>
            <button style="width: 100%;">Pagar $<?= $total ?></button>
        </div>
        <div class="boton_seguir">
            <table style="width: 100%;">
                <tr>
                    <td><a href="javascript:void(0);" onclick="ocultarPago();"><button style="float: left;">Regresar a facturación</button></a></td>
                </tr>
            </table>
        </div>
    </div>
</div>
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
<script type="text/javascript">
    function ocultarEnvio() {
        document.getElementById('caja_envio').style.display = 'none';
        document.getElementById('caja_facturacion').style.display = 'block';
    }

    function mostrarEnvio() {
        document.getElementById('caja_envio').style.display = 'block';
        document.getElementById('caja_facturacion').style.display = 'none';
    }

    function ocultarFacturacion() {
        document.getElementById('caja_facturacion').style.display = 'none';
        document.getElementById('caja_pago').style.display = 'block';
    }

    function ocultarPago() {
        document.getElementById('caja_pago').style.display = 'none';
        document.getElementById('caja_facturacion').style.display = 'block';
    }

    function ocultarDebito() {
        document.getElementById('tarjeta_debito').style.display = 'none';
        document.getElementById('acepto_condiciones_pago').style.display = 'none';
        document.getElementById('id1').prop('checked', false).checkboxradio("refresh");
    }

    function ocultarPaypal() {
        document.getElementById('tarjeta_debito').style.display = 'block';
        document.getElementById('acepto_condiciones_pago').style.display = 'block';
    }
</script>