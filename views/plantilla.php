<?php session_start(['name' => 'SCL']);; ?>
<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8" />
    <title><?php echo COMPANY; ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="<?php echo SERVERURL; ?>views/assets/images/favicon.ico">

    <!-- link para los estilos  css -->
    <?php include "./views/inc/Link.php"; ?>

</head>

<body class="loading" data-layout-color="light" data-leftbar-theme="dark" data-layout-mode="fluid" data-rightbar-onstart="true">

    <?php

    $peticionAjax = false;
    require_once "./controller/viewsControllers.php";
    $IV = new viewsControllers();

    $vistas = $IV->obtener_vistas_controlador();
    // mostramos las vistas si estas son login el usuario podra vizualizar las vistas de login para iniciar session
    if ($vistas == "login" || $vistas == "404") {
        require_once "./views/contenidos/" . $vistas . "-view.php";
    } else {

        $pagina = explode("/", $_GET['views']);

        require_once "./controller/loginControlador.php";

        $ic = new loginControlador();
        // verificamos si el usuario ha iniciado session
        // --------------------------------------------------------------------------------------------------------------------------
        // NO TOCAR SINO QUIERES PERDER 5 HORAS DE TU VIDA BUSCANDO EL ERROR O VIENDO COMO FUNCIONA, QUE LOS DIOSES ESTEN CONTIGO1..
        if (!isset($_SESSION['usuario_scl']) || !isset($_SESSION['token_scl'])) {
            // si no ha iniciado session redireccionamos al login
            echo $ic->forzar_cierre_sesion_controlador();
            echo '<script>
            console.log("No ha iniciado session");
            </script>';
            exit();
        }
    ?>

        <div class="wrapper">
            <!-- ========== barra lateral ========== -->
            <?php include "./views/inc/NavLateral.php"; ?>
            <!-- barra lateral End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">
                    <!-- Topbar Start -->
                    <?php

                    include "./views/inc/NavBar.php";

                    include $vistas;

                    ?>
                    <!-- end Topbar -->

                    <!-- contenido -->
                    <!-- contenido -->

                </div>
                <!-- content -->

                <?php include "./views/inc/Footer.php"; ?>

            </div>

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- barra de configuración pagina -->
        <?php include "./views/inc/ConfigWeb.php"; ?>
        <!-- barra de configuración pagina -->

        <!-- barra de carga -->
        <!-- <div class="rightbar-overlay"></div> -->
        <!-- /End-bar -->

        <!-- links para javaScript -->
    <?php
        include "./views/inc/LogOut.php";
        // cerramos condicional para mostrar el contenido
    }
    //links de los script en javascript
    include "./views/inc/Script.php"; ?>
</body>

</html>