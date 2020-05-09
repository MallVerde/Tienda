<?php
	if(isset($_SESSION['id_cliente'])){
		header ("Location:?p=principal");
	}
?>

<div class="centrar_login">
            <form method="post" action="modulos/validaciones/validar_sesion.php">
                <label><h1>Iniciar Sesión</h1></label>
                <label><h5>¿Nuevo en este sitio? <a href="?p=registro">Registrate</a> </h5> </label>
                <div class="form-group">
				<input type="text" autocomplete="off" class="form-control" placeholder="Email" name="email"/>
				</div>

				<div class="form-group">
				<input type="password" class="form-control" placeholder="Contraseña" name="password"/>
				</div>

                <div class="form-group">
                <button class="btn btn-submit" name="enviar" type="submit">Iniciar Sesión</button>
                </div>
        </form>
</div>
