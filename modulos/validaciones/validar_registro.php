<?php
	require("../../configs/funciones.php");
	$email=$_POST['email'];
	$password= $_POST['password'];
	$cpassword=$_POST['cpassword'];


	$checkemail=mysqli_query($mysqli,"SELECT * FROM clientes WHERE email='$email'");
	$check_mail=mysqli_num_rows($checkemail);
		if($password==$cpassword){
			if($check_mail>0){
				echo ' <script language="javascript">alert("Atencion, ya existe el mail designado para un usuario, verifique sus datos");</script> ';
				echo "<script>location.href='../../?p=registro'</script>";
			}else{
				
				mysqli_query($mysqli,"INSERT INTO clientes(`id`,`username`,`email`,`password`,`nombre`,`rol`) VALUES('','Cliente','$email','$password','','2')");
				echo ' <script language="javascript">alert("Usuario registrado con éxito");</script> ';
				echo "<script>location.href='../../?p=login'</script>";
			}
			
		}else{
			echo 'Las contraseñas son incorrectas';
			echo "<script>location.href='../../?p=registro'</script>";
		}	
?>