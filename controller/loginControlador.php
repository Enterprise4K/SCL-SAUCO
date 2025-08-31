<?php

if ($peticionAjax) {
    require_once "../models/loginModelo.php";
} else {
    require_once "./models/loginModelo.php";
}

class loginControlador extends loginModelo
{
    /* --------------------     controlador para iniciar session -------------------------*/
    public function iniciar_sesion_controlador()
    {
        $usuario = mainModel::limpiar_cadena($_POST['usuario_log']);
        $clave = mainModel::limpiar_cadena($_POST['clave_log']);

        // Comprobar campos vacios
        if ($usuario == "" || $clave == "") {
            echo '<script>
                Swal.fire({
                    title: "Ocurrió un error inesperado",
                    text: "Los campos no pueden estar vacíos",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
            </script>';
            exit();
        }

        // VERIFICAR LA INTEGRIDAD DE LOS DATOS

        // Verificar el formato del usuario
        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $usuario)) {
            echo '<script>
                Swal.fire({
                    title: "Ocurrió un error inesperado",
                    text: "El usuario no coincide con el formato solicitado",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
            </script>';
            exit();
        }
        // Verificar el formato de la clave
        if (mainModel::verificar_datos("[a-zA-Z0-9$@.-]{7,100}", $clave)) {
            echo '<script>
                    Swal.fire({
                        title: "Ocurrió un error inesperado",
                        text: "La clave no coincide con el formato solicitado",
                        icon: "error",
                        confirmButtonText: "Aceptar",
                    });
            </script>';
            exit();
        }

        $clave = mainModel::encryption($clave);

        $datosLogin = [
            "Usuario" => $usuario,
            "Clave" => $clave
        ];

        $datosCuenta = loginModelo::iniciar_sesion_modelo($datosLogin);
        //array de datos de la cuenta 

        if ($datosCuenta->rowCount() == 1) {
            // iniciar session
            $row = $datosCuenta->fetch();

            session_start(['name' => 'SCL']);

            $_SESSION['id_scl'] = $row['Cuenta_Id'];
            $_SESSION['nombre_scl'] = $row['Cuenta_Nombre'];
            $_SESSION['apellido_scl'] = $row['Cuenta_Apellido'];
            $_SESSION['usuario_scl'] = $row['Cuenta_Usuario'];
            $_SESSION['privilegio_scl'] = $row['Cuenta_Privilegio'];
            $_SESSION['token_scl'] = md5(uniqid(mt_rand(), true));

            // // verifircar si se logro iniciar session con las variables de session
            // if ($_SESSION['nombre_scl'] &&  $_SESSION['apellido_scl'] && $_SESSION['usuario_scl'] && $_SESSION['privilegio_scl'] && $_SESSION['token_scl']) {
            //     echo '<script>
            //      console.log("Session iniciada correctamente");
            //      console.log("Usuario: ' . $_SESSION['usuario_scl'] . '");
            //      console.log("Privilegio: ' . $_SESSION['privilegio_scl'] . '");
            //     </script>';
            //     exit();
            // } else {
            //     echo '<script>
            //      console.log("Session iniciada no correctamente");
            //     </script>';
            //     exit();
            // }
            // Redireccionar a la página de inicio
            if (headers_sent()) {
                echo "<script>
                    window.location.href = '" . SERVERURL . "home/' </script>";
            } else {
                return header("Location: " . SERVERURL . "home/");
            }
        } else {
            echo '<script>
                Swal.fire({
                    title: "Ocurrió un error inesperado",
                    text: "EL usuario o la clave son incorrectos",
                    icon: "error",
                    confirmButtonText: "Aceptar",
                });
            </script>';
            exit();
        }
    } /* --------------------     fin controlador -------------------------*/

    /* --------------------     controlador para forzar el cierre de sesion -------------------------*/
    public function forzar_cierre_sesion_controlador()
    {
        session_unset();
        session_destroy();
        if (headers_sent()) {
            echo "<script>
                window.location.href = '" . SERVERURL . "login/' </script>";
        } else {
            return header("Location: " . SERVERURL . "login/");
        }
    } /* --------------------     fin controlador -------------------------*/


    /* --------------------     controlador para cerrar session-------------------------*/
    public function cerrar_session_controlador()
    {
        session_start(['name' => 'SCL']);
        $token = mainModel::decryption($_POST['token']);
        $usuario = mainModel::decryption($_POST['usuario']);

        if ($token == $_SESSION['token_scl'] && $usuario == $_SESSION['usuario_scl']) {
            session_unset();
            session_destroy();
            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL . "login/"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se ha podido cerrar la sesión",
                "Icono" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    } // fin controlador
}
