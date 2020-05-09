<?php
    include "configs/config.php";
    include "configs/funciones.php";

	if (@!$_SESSION['user']) {
		
	}elseif ($_SESSION['rol']==1) {
		header("Location:admin/admin.php");
    }
    
    if (!isset($p)){
        $p= "principal";
    }
    else{
      $p = $p;   
    }
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css?v=<?php echo time();?>">
    <link rel="stylesheet" href="bootstrap/css/bootstrap.css">
    <link rel="stylesheet" href="fontawesome/css/all.css">
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <script type="text/javascript" src="fontawesome/js/all.js"></script>
    <script type="text/javascript" src="js/jquery.js"></script>
    <script type="text/javascript" src="js/app.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <title>Anaqueles García</title>
</head>
<body>
    <div class="contenedor_principal">
        <header>
            <div class="titulo_cabecera">
                <h3>Anaqueles metálicos garcia</h3>        
            </div>
        </header>
        <nav>
            <div class="barra">
                <div class="menu_left">
                    <ul>
                        <li><a href="?p=principal">Inicio</a></li>
                        <li><a href="?p=productos">Productos</a></li>   
                    </ul>
                </div>

                <div class="navegacion">
                    <?php
                        if(isset($_SESSION['id_cliente'])){
                    ?>
                        <ul class="menu">
                            <li><a class="" href="#"><?=nombre_cliente($_SESSION['id_cliente'])?></a>
                                    <ul class="submenu">
                                        <li><a href="?p=perfil">ver perfil</a></li>
                                        <li><a class="" href="?p=salir">Salir</a></li>
                                    </ul>
                                </li>
                            <li><a href="?p=carrito">Carrito</a></li>
                        </ul>
                    <?php
                    }else{
                        ?>
    
                        <ul>
                            <li><a href="?p=login">Iniciar sesión</a></li>
                            <li><a href="?p=registro">Registrate</a></li>
                        </ul>
                        <?php
                    }
                    ?>            
                </div>    
            </div>
        </nav>
        <!--
        </div> -->
        <section>
            <div class="cuerpo">
                <?php
                    if(file_exists("modulos/".$p.".php")){
                        include"modulos/".$p.".php";
                    }
                    else{
                        echo"<i>No se ha encontrado el modulo <b>".$p."</b><a href='./'> Regresar</a></i>";
                    }
                ?>
            </div>
        </section>
        <footer>
            <div class="contenido_pie">
                <div class="pie_left">
                    <h4>
                        Anaqueles Metálicos García &copy; <?=date("Y")?>
                    </h4>
                </div>
                <div class="pie_right">
                    <h4>
                        Redes sociales
                    </h4>
                    <a href="https://www.facebook.com/"><img src="img/icono_F.png" alt=""></a>
                </div>
            </div>    
        </footer>
    </div>
</body>
</html>
<script type="text/javascript">
	function minimizer(){
		var minimized = $("#minimized").val();

		if(minimized == 0){
			//mostrar
			$(".carritot").css("bottom","350px");
			$(".carritob").css("bottom","0px");
			$("#minimized").val('1');
		}else{
			//minimizar

			$(".carritot").css("bottom","0px");
			$(".carritob").css("bottom","-350px");
			$("#minimized").val('0');
		}
	}
</script>