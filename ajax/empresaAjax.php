<?php

$peticionAjax = true;

require_once "../config/APP.php";

// re-direcciona al login cuando intente ingresar a las carpetas ajax
if (true) {

    // instancia al controlador
    require_once "../controller/empresaControlador.php";
    $ins_empresa = new empresaControlador();
} else {
    session_start(['name' => 'SCL']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}
