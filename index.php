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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>    
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
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
    </div>
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
</body>
</html>
