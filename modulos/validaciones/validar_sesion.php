<?php
	session_start();	
	require("../../configs/funciones.php");
	$email=$_POST['email'];
	$pass=$_POST['password'];

	//la variable  $mysqli viene de connect_db que lo traigo con el require("connect_db.php");
	$sql2=mysqli_query($mysqli,"SELECT * FROM admins WHERE email='$email'");
	if($f2=mysqli_fetch_assoc($sql2)){
		if($pass==$f2['pasadmin']){
			$_SESSION['id_cliente']=$f2['id_admin'];
			$_SESSION['user']=$f2['username'];
			$_SESSION['rol']=$f2['rol'];

			echo '<script>alert("BIENVENIDO ADMINISTRADOR")</script> ';
			echo "<script>location.href='../../admin/admin.php'</scrsipt>";
		}
	}

	$sql=mysqli_query($mysqli,"SELECT * FROM clientes WHERE email='$email'");
	if($f=mysqli_fetch_assoc($sql)){
		if($pass==$f['password']){
			$_SESSION['id_cliente']=$f['id'];
			$_SESSION['user']=$f['username'];
			$_SESSION['rol']=$f['rol'];

			header("Location:../../?p=principal");
		}else{
			echo '<script>alert("CONTRASEÑA INCORRECTA")</script> ';
		
			echo "<script>location.href='../../?p=login'</script>";
		}
	}else{
		
		echo '<script>alert("ESTE USUARIO NO EXISTE, PORFAVOR REGISTRESE SUS DATOS CORRECTAMENTE")</script> ';
		echo "<script>location.href='../../?p=login'</script>";
	}
?>
	