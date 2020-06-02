<?php
		include ("../configs/config.php");
		include("../configs/funciones.php");
		$id = $_SESSION['id_cliente'];
	if (empty($_POST['nombre'])) {
           $errors[] = "El nombre está vacio";
        }else if (empty($_POST['apellido'])) {
           $errors[] = "apellido está vacío";
        } else if (empty($_POST['email'])) {
           $errors[] = "email está vacío";
        } else if (empty($_POST['telefono'])) {
           $errors[] = "telefono esta vacío";
        } else if (
			!empty($_POST['nombre']) &&
			!empty($_POST['apellido']) &&
			!empty($_POST['email']) &&
			!empty($_POST['telefono']) 
		){
		/* Connect To Database*/
		
		// escaping, additionally removing everything that could be (html/javascript-) code
		$nombre=mysqli_real_escape_string($mysqli,(strip_tags($_POST["nombre"],ENT_QUOTES)));
		$apellido=mysqli_real_escape_string($mysqli,(strip_tags($_POST["apellido"],ENT_QUOTES)));
		$email=mysqli_real_escape_string($mysqli,(strip_tags($_POST["email"],ENT_QUOTES)));
		$telefono=mysqli_real_escape_string($mysqli,(strip_tags($_POST["telefono"],ENT_QUOTES)));
	
		$sql="UPDATE clientes SET nombre='".$nombre."', apellido='".$apellido."', email='".$email."', telefono='$telefono' WHERE id='$id'";
		$query_update = mysqli_query($mysqli,$sql);
			if ($query_update){
				$messages[] = "Sus datos han sido actualizados satisfactoriamente.";
			} else{
				$errors []= "Lo siento algo ha salido mal intentelo nuevamente.".mysqli_error($mysqli);
			}
		} else {
			$errors []= "Error desconocido.";
		}
		
		if (isset($errors)){
			
			?>
			<div class="alert alert-danger" role="alert">
				<button type="button" class="close" data-dismiss="alert">&times;</button>
					<strong>Error!</strong> 
					<?php
						foreach ($errors as $error) {
								echo $error;
							}
						?>
			</div>
			<?php
			}
			if (isset($messages)){
				
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