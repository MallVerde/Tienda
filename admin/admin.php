<?php
    include "../configs/config.php";
    include "../configs/funciones.php";

	if (@!$_SESSION['user']) {
		
	}elseif ($_SESSION['rol']==2) {
		header("Location:../?p=principal");
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
    <link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Manrope&display=swap" rel="stylesheet">
    <title>Anaqueles García</title>

    <link rel="stylesheet" href="../fontawesome/css/all.css"/>
    <script type="text/javascript" src="../fontawesome/js/all.js"></script>
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
                    </ul>
                </div>

                <div class="navegacion">
                    <?php
                        if(isset($_SESSION['id_cliente'])){
                    ?>
                        <ul class="menu">
                            <li><a class="" href="#">Bienvenido <strong><?php echo $_SESSION['user']?></a></strong> 
                                    <ul class="submenu">
                                        <li><a class="" href="?p=salir">Cerrar Sesión</a></li>
                                    </ul>
                                </li>
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
                        include "modulos/".$p.".php";
                    }
                    else{
                        echo"<i>No se ha encontrado el modulo <b>".$p."</b><a href='../'> Regresar</a></i>";
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
            </div>    
        </footer>
    </div>
</body>
</html>