<?php

$peticionAjax = true;

require_once "../config/APP.php";

// re-direcciona al login cuando intente ingresar a las carpetas ajax
if (isset($_POST['proveedor_ruc_reg']) || isset($_POST['proveedpr_id_del'])) {

    // instancia al controlador
    require_once "../controller/proveedorControlador.php";
    $ins_proveedor = new proveedorControlador();

    // agregar proveedor
    if (isset($_POST['proveedor_ruc_reg']) || isset($_POST['proveedor_razon_social_reg'])) {
        echo $ins_proveedor->agregar_proveedor_controlador();
    }

    // eliminar proveedor
    if (isset($_POST['proveedpr_id_del'])) {
        echo $ins_proveedor->eliminar_proveedor_controlador();
    }

    // actualizar proveedor
    if (isset($_POST['proveedor_id_up'])){
        echo $ins_proveedor ->actualizar_provedor_controlador();

    }
} else {
    session_start(['name' => 'SCL']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}
