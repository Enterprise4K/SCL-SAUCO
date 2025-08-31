<?php 

    require_once "./config/APP.php";
    require_once "./controller/viewsControllers.php";

    $plantilla = new viewsControllers();
    $plantilla->obtener_plantilla_controlador();