<?php

$peticionAjax = true;

require_once "../config/APP.php";

// re-direcciona al login cuando intente ingresar a las carpetas ajax
if (isset($_POST['empresa_nombre_reg']) || isset($_POST['empresa_id_up'])) {

    // instancia al controlador
    require_once "../controller/empresaControlador.php";
    $ins_empresa = new empresaControlador();

    // agregar empresa
    if (isset($_POST['empresa_nombre_reg'])) {
        echo $ins_empresa->agregar_empresa_controlador();
    }
    // actualizar empresa
    if (isset($_POST['empresa_id_up'])) {
        echo $ins_empresa->actualizar_empresa_controlador();
    }
} else {
    session_start(['name' => 'SCL']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}
