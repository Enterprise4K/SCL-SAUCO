<?php

if ($peticionAjax) {
    require_once "../models/empresaModelo.php";
} else {
    require_once "./models/empresaModelo.php";
}

class empresaControlador extends empresaModelo
{

    // controlador datos de la empresa
    public function datos_empresa_controlador()
    {
        return empresaModelo::datos_empresa_modelo();
    }

    // controlador sgregar empresa 
    public function agregar_empresa_controlador()
    {

        // datos de la empresa
        $nombre = mainModel::limpiar_cadena(($_POST['empresa_nombre_reg']));
        $email = mainModel::limpiar_cadena(($_POST['empresa_email_reg']));
        $telefono = mainModel::limpiar_cadena(($_POST['empresa_telefono_reg']));
        $direccion = mainModel::limpiar_cadena(($_POST['empresa_direccion_reg']));

        // comprobar campos vacios
        if ($nombre == "" || $email == "" || $telefono == "" || $direccion == "") {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // verificando integridad de los datos

        if (mainModel::verificar_datos("a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{1,70}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Nombre de la empresa no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9()+]{8,20}", $telefono)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Teléfono de la empresa no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La Dirección de la empresa no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // validation de correo 

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Ha ingresado un correo invalido, por favor volver a reintentar.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    }
}
