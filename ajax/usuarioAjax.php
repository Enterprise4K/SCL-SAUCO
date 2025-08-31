<?php

$peticionAjax = true;

require_once "../config/APP.php";

// re-direcciona al login cuando intente ingresar a las carpetas ajax
if (isset($_POST['usuario_DNI_reg']) ||  isset($_POST['usuario_id_del']) || isset($_POST['usuario_id_up'])) {

    // instancia al controlador
    require_once "../controller/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();

    // agregar un usuario 
    if (isset($_POST['usuario_DNI_reg']) && isset($_POST['usuario_nombre_reg'])) {
        echo $ins_usuario->agregar_usuario_controlador();
    }

    // eliminar un usuario 
    if (isset($_POST['usuario_id_del'])) {
        echo $ins_usuario->eliminar_usuario_controlador();
    }

    //actualizar datos
    if (isset($_POST['usuario_id_up'])) {
        echo $ins_usuario->actualizar_usuario_controlador();
    }
} else {
    session_start(['name' => 'SCL']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}
