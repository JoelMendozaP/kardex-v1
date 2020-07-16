<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title>Sistema de Registros</title>

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="icon" href="vistas/img/plantilla/iconos.jpg">

   <!--=====================================
  PLUGINS DE CSS
  ======================================-->

  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="vistas/bower_components/bootstrap/dist/css/bootstrap.min.css">


  <!-- Font Awesome -->
  <link rel="stylesheet" href="vistas/bower_components/font-awesome/css/font-awesome.min.css">

  <!-- Ionicons -->
  <link rel="stylesheet" href="vistas/bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->
  <link rel="stylesheet" href="vistas/dist/css/AdminLTE.css">
  <!-- Styles  only -->
  

  <link rel="stylesheet" href="vistas/dist/css/stilos.css">
<link rel="stylesheet" href="vistas/dist/stilosfondo.css"> 
<!-- Styles select 2 -->

<link rel="stylesheet" href="vistas/bower_components/select2/dist/css/select2.min.css">


  
  <!-- AdminLTE Skins -->
  <link rel="stylesheet" href="vistas/dist/css/skins/_all-skins.min.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- DataTables -->
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <link rel="stylesheet" href="vistas/bower_components/datatables.net-bs/css/responsive.bootstrap.min.css">


  <!--=====================================
  PLUGINS DE JAVASCRIPT
  ======================================-->

  <!-- jQuery 3 -->
  <script src="vistas/bower_components/jquery/dist/jquery.min.js"></script>
   
  <!-- Bootstrap 3.3.7 -->
  <script src="vistas/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

  <!-- FastClick -->
  <script src="vistas/bower_components/fastclick/lib/fastclick.js"></script>
  
  <!-- AdminLTE App -->
  <script src="vistas/dist/js/adminlte.min.js"></script>
<!-- DataTables -->
<script src="vistas/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/dataTables.responsive.min.js"></script>
<script src="vistas/bower_components/datatables.net-bs/js/responsive.bootstrap.min.js"></script> 


<!-- SweetAlert 2 -->
<script src="vistas/plugins/sweetalert2/sweetalert2.all.js"></script>
<!-- Styles select 2 -->
<script src="vistas/bower_components/select2/dist/js/select2.min.js"></script>




</head>

<!--=====================================
CUERPO DOCUMENTO
======================================-->

<body class="hold-transition  sidebar-collapse sidebar-mini login-page skin-purple" >
<!-- onload="startTime()" -->
  <?php

  if(isset($_SESSION["iniciarSesion"]) && $_SESSION["iniciarSesion"] == "ok"){
   echo '<div class="wrapper">';
    /*=============================================
    CABEZOTE
    =============================================*/
    include "modulos/cabezote.php";
    /*=============================================
    MENU
    =============================================*/
   
		include "modulos/menu.php";
		//include "modulos/inicio.php";
	
    /*=============================================
    CONTENIDO
    =============================================*/
    if(isset($_GET["ruta"])){

      if($_GET["ruta"] == "inicio" ||

         ($_GET["ruta"] == "usuarios" && $_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador")||
         ($_GET["ruta"] == "materia" && (($_SESSION["esta_materias"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador")))||
         ($_GET["ruta"] == "estudiantes" && (($_SESSION["esta_estudiante"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "plandeestudios" && (($_SESSION["esta_plan_estudio"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "inscribir" && (($_SESSION["esta_materias"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "boleta" && (($_SESSION["esta_estudiante"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "reporte" && (($_SESSION["esta_estudiante"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "corespinterna" && (($_SESSION["esta_correspondencia"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "corespexterna" && (($_SESSION["esta_correspondencia"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "cartapdf" && (($_SESSION["esta_correspondencia"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "admacces" &&  ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador")) ||
         ($_GET["ruta"] == "listadeplandeestudio" && (($_SESSION["esta_plan_estudio"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "listaplan" && (($_SESSION["esta_plan_estudio"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "galeria" && (($_SESSION["esta_estudiante"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "historialcartainterna" && (($_SESSION["esta_correspondencia"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador"))) ||
         ($_GET["ruta"] == "historialcartaexterna" && (($_SESSION["esta_correspondencia"] == 1) || ($_SESSION["esta_superu"] == 1 && $_SESSION["perfil"] == "Administrador")))||
         $_GET["ruta"] == "salir"){
        include "modulos/".$_GET["ruta"].".php";
      }else{
        include "modulos/404.php";
      }
    }else{
      include "modulos/inicio.php";
    }
    /*=============================================
    FOOTER
    =============================================*/
    include "modulos/footer.php";
    echo '</div>';
  }else{
    include "modulos/login.php";
  }
  ?>

 



<script src="vistas/js/plantilla.js"></script>
<script src="vistas/js/usuarios.js"></script>
<script src="vistas/js/materia.js"></script>
<script src="vistas/js/estudiante.js"></script>
<script src="vistas/js/boleta.js"></script>
<script src="vistas/js/carta.js"></script>
<script src="vistas/js/cartainterna.js"></script>
<script src="vistas/js/plandeestudio.js"></script>



</body>
</html>
