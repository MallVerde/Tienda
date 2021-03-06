<?php
    $id = $_SESSION['id_cliente'];

    if (isset($_SESSION['id_cliente'])) {
    } else {
        header("Location:?p=principal");
    }
    $query_empresa = mysqli_query($mysqli, "SELECT * FROM clientes WHERE id =$id");
    $row = mysqli_fetch_array($query_empresa);
?>

<div class="perfil">
    <form method="post" id="perfil">
        <div class="datos_imagen">
            <div class="foto_perfil" align="center">
                <div id="load_img">
                    <img id="imagen_perfil" class="img-responsive" src="<?php echo $row['logo_url']; ?>" alt="imagen_perfil">
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <input class='filestyle' data-buttonText="Buscar" type="file" name="imagefile" id="imagefile" onchange="upload_image();">
                        </div>
                    </div>
                </div>
            </div>
            <div class="pedido_perfil">
                <ul>
                    <li><a href="?p=mis_pedidos">Mis pedidos</a></li>
                </ul>
            </div>
        </div>
        <div class="datos_perfil">
            <h2 style="margin: -5px;">Mi Cuenta</h2>
            <h4>Mira y edita tu información personal acontinuación:</h4>
            <hr>

            <div class="formulario_perfil">
                <p><b>Cuenta de email:</b></p>
                <p><?php echo $row['email'] ?></p>
                <table class="tabla_perfil" cellpadding="0" cellspacing="0">
                    <tr>
                        <td class='col-md-3'>
                            Nombre: <br>
                            <input type="text" placeholder="por ej. Jose" name="nombre" value="<?php echo $row['nombre'] ?>"  autocomplete="off">
                        </td>
                        <td>
                            Apellido: <br>
                            <input type="text" placeholder="por ej. Perez" name="apellido" value="<?php echo $row['apellido'] ?>"   autocomplete="off">
                        </td>
                    </tr>
                    <tr>
                        <td class='col-md-3'>
                            Email de contácto: <br>
                            <input type="text" placeholder="por ej. contacto@gmail.com" name="email" value="<?php echo $row['email'] ?>"   autocomplete="off">
                        </td>
                        <td>
                            Télefono: <br>
                            <input type="text" placeholder="por ej. 2741035519" name="telefono" value="<?php echo $row['telefono'] ?>"   autocomplete="off">
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-sm btn-success"><i class="glyphicon glyphicon-refresh"></i> Actualizar información</button>
            </div>
        </div>
    </form>
</div>
<div class='col-md-14' id="resultados_ajax"></div><!-- Carga los datos ajax -->
<script type="text/javascript" src="js/bootstrap-filestyle.js"> </script>
<script>
    $("#perfil").submit(function(event) {
        $('.guardar_datos').attr("disabled", true);

        var parametros = $(this).serialize();
        $.ajax({
            type: "POST",
            url: "ajax/editar_perfil.php",
            data: parametros,
            beforeSend: function(objeto) {
                $("#resultados_ajax").html("Mensaje: Cargando...");
            },
            success: function(datos) {
                $("#resultados_ajax").html(datos);
                $('.guardar_datos').attr("disabled", false);
            }
        });
        event.preventDefault();
    })
</script>

<script>
    function upload_image() {
        var inputFileImage = document.getElementById("imagefile");
        var file = inputFileImage.files[0];
        if ((typeof file === "object") && (file !== null)) {
            $("#load_img").text('Cargando...');
            var data = new FormData();
            data.append('imagefile', file);

            $.ajax({
                url: "ajax/imagen_ajax.php", // Url to which the request is send
                type: "POST", // Type of request to be send, called as method
                data: data, // Data sent to server, a set of key/value pairs (i.e. form fields and values)
                contentType: false, // The content type used when sending data to the server.
                cache: false, // To unable request pages to be cached
                processData: false, // To send DOMDocument or non processed data file it is set to false
                success: function(data) // A function to be called if request succeeds
                {
                    $("#load_img").html(data);
                }
            });
        }
    }
</script>
<br>