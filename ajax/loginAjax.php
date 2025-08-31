<?php

$peticionAjax = true;

require_once "../config/APP.php";

// re-direcciona al login cuando intente ingresar a las carpetas ajax
if (isset($_POST['token']) && isset($_POST['usuario'])) {

    require_once "../controller/loginControlador.php";
    $ic_user = new loginControlador();

    echo $ic_user->cerrar_session_controlador();
} else {
    session_start(['name' => 'SCL']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}
