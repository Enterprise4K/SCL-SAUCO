<?php
session_start(['name' => 'SCL']);
require_once "../config/APP.php";

// agregar isset cuando se poceda hacer un filtro especial para las ordenes de compra
if (isset($_POST['busqueda_inicial']) || isset($_POST['eliminar_busqueda']) || isset($_POST['correlativo_compra']) || isset($_POST['fecha_emision']) || isset($_POST['fecha_vencimiento']) || isset($_POST['compra_estado'])) {
    // agregarmos cada modulo con su respectiva url para obtener los datos 
    $data_url = [
        "usuario" => "usuario-busqueda",
        "proveedor" => "proveedor-busqueda"
    ];

    if (isset($_POST['modulo'])) {

        // obtener el modulo para el tipo de url
        $modulo = $_POST['modulo'];
        if (!isset($data_url[$modulo])) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se pudo realizar la busqueda debido a un error inesperado.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
    } else {
        $alerta = [
            "Alerta" => "simple",
            "Titulo" => "Ocurrió un error inesperado",
            "Texto" => "No se pudo realizar la búsqueda debido a un error de configuración.",
            "Icono" => "error"
        ];
        echo json_encode($alerta);
        exit();
    }

    if ($modulo == "ordenCompra") {

        // crear variables para guarda que datos se necesitaran para el filtro de búsqueda
        $correlativo = "numero_correlativo_" . $modulo;
        $fecha_emision = "fecha_emision_" . $modulo;
        $fecha_vencimiento = "fecha_vencimiento_" . $modulo;
        $compra_estado = "compra_estado_" . $modulo;

        // iniciar busqueda

        if (isset($_POST['correlativo_compra']) || isset($_POST['fecha_emision']) || isset($_POST['fecha_vencimiento']) || isset($_POST['compra_estado'])) {

            if ($_POST['correlativo_compra'] == "" || $_POST['fecha_emision'] == "" || $_POST['fecha_vencimiento'] == "" || $_POST['compra_estado'] == "") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Por favor ingrese los datos del filtro para poder seleccionar de manera precisa.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            // variables de session

            $_SESSION[$correlativo] = $_POST['correlativo_compra'];
            $_SESSION[$fecha_emision] = $_POST['fecha_emision'];
            $_SESSION[$fecha_vencimiento] = $_POST['fecha_vencimiento'];
            $_SESSION[$compra_estado] = $_POST['compra_estado'];
        }

        //eliminar búsqueda 

        if (isset($_POST['eliminar_busqueda'])) {
            unset($_SESSION[$correlativo]);
            unset($_SESSION[$fecha_emision]);
            unset($_SESSION[$fecha_vencimiento]);
            unset($_SESSION[$compra_estado]);
        }
    } else {

        $name_var = "busqueda_" . $modulo;

        // iniciar búsqueda 
        if (isset($_POST['busqueda_inicial'])) {
            if ($_POST['busqueda_inicial'] == "") {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Por favor introduce un termino de búsqueda para empezar.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }

            $_SESSION[$name_var] = $_POST['busqueda_inicial'];
        }

        // eliminar búsqueda
        if (isset($_POST['eliminar_busqueda'])) {
            unset($_SESSION[$name_var]);
        }


        // redireccionar 

        // definir la url capturando el modulo
        $url = $data_url[$modulo];

        $alerta = [
            "Alerta" => "redireccionar",
            "URL" => SERVERURL . $url . "/"
        ];

        echo json_encode($alerta);
    }
} else {
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}
