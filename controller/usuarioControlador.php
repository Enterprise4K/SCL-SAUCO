<?php

if ($peticionAjax) {
    require_once "../models/usuarioModelo.php";
} else {
    require_once "./models/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
    // controladores para agregar usuario

    public function agregar_usuario_controlador()
    {
        // datos del usuario
        $dni = mainModel::limpiar_cadena($_POST['usuario_DNI_reg']);
        $nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_reg']);
        $apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_reg']);
        $telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_reg']);
        $direccion = mainModel::limpiar_cadena($_POST['usuario_direccion_reg']);

        // datos de la cuenta 
        $usuario = mainModel::limpiar_cadena($_POST['usuario_name_reg']);
        $email = mainModel::limpiar_cadena($_POST['usuario_email_reg']);
        $clave1 = mainModel::limpiar_cadena($_POST['usuario_clave1_reg']);
        $clave2 = mainModel::limpiar_cadena($_POST['usuario_clave2_reg']);

        // nivel de privilegios para acceder al sistema
        $privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_reg']);

        // comprobar los  campos vacios 

        if ($dni == "" || $nombre == "" || $apellido == "" || $usuario == "" || $email == "" || $clave1 == "" || $clave2 == "") {

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

        if (mainModel::verificar_datos("[0-9-]{8,20}", $dni)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Dni no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El NOMBRE no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}", $apellido)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El APELLIDO no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9()\+]{8,20}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El TELEFONO no coincide con el formato solicitado",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($direccion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El DIRECCION no coincide con el formato solicitado",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El NOMBRE DE USUARIO no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        // verificacion de las contraseñas 
        if (mainModel::verificar_datos("[a-zA-Z0-9@.$\-]{7,100}", $clave1) || mainModel::verificar_datos("[a-zA-Z0-9@.$\-]{7,100}", $clave2)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Las CLAVES  no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // verification de valores únicos 
        // ---------------------------------------
        // mediante estas comprobaciones se verificara que no se registren datos duplicados 

        // comprobar DNI mediante una consulta a la base de datos 

        $check_dni = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Dni FROM cuenta WHERE Cuenta_Dni='$dni'");

        // si existen mas de un registro, se mandara un alerta 
        if ($check_dni->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "el DNI ingresado ya se encuentra registrado en el sistema.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // comprobar el usuario mediante una consulta a la base de datos 

        $check_user = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Usuario FROM cuenta WHERE Cuenta_Usuario='$usuario'");

        // si existen mas de un registro, se mandara un alerta 
        if ($check_user->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "el USUARIO ingresado ya se encuentra registrado en el sistema.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // comprobar email

        if ($email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $check_email = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Email FROM cuenta WHERE Cuenta_Email='$email'");

                // si existen mas de un registro, se mandara un alerta 
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "el CORREO ingresado ya se encuentra registrado en el sistema.",
                        "Icono" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Ha ingresado un correo no valido.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        // verificar que las contraseñas coincidan
        if ($clave1 !== $clave2) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Las contraseñas no coinciden.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $clave = mainModel::encryption($clave1);
        }

        // comprobar el privilegio del usuario

        if ($privilegio < 1 || $privilegio > 4) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Privilegio seleccionado no es valido.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        $datos_usuario_reg = [
            "DNI" => $dni,
            "Nombre" => $nombre,
            "Apellido" => $apellido,
            "Telefono" => $telefono,
            "Direccion" => $direccion,
            "Usuario" => $usuario,
            "Email" => $email,
            "Clave" => $clave,
            "Estado" => "Activo",
            "Privilegio" => $privilegio
        ];

        $agregar_usuario = usuarioModelo::agregar_usuario_modelo($datos_usuario_reg);
        if ($agregar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario registrado",
                "Texto" => "Los datos del usuario han sido registrados con éxito.",
                "Icono" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se ha podido registrar el usuario, por favor intente nuevamente.",
                "Icono" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }   // fin del controlador agregar usuario

    // controlador para paginar usuarios
    public function paginador_usuario_controlador($pagina, $registros, $privilegio, $id, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $id = mainModel::limpiar_cadena($id);

        $url = mainModel::limpiar_cadena($url);

        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM cuenta WHERE ((Cuenta_id != '$id' AND Cuenta_id != 1) AND (Cuenta_Dni LIKE '%$busqueda%' OR Cuenta_Nombre LIKE '%$busqueda%' OR Cuenta_Apellido LIKE '%$busqueda%' OR Cuenta_Email LIKE '%$busqueda%' OR Cuenta_Usuario LIKE '%$busqueda%') ) ORDER BY Cuenta_id ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM cuenta WHERE Cuenta_id != '$id' AND Cuenta_id != 1 ORDER BY Cuenta_id ASC LIMIT $inicio, $registros";
        }

        $conexion = mainModel::conectar();

        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();

        $total = $conexion->query("SELECT FOUND_ROWS()");
        $total = (int) $total->fetchColumn();

        $Npaginas = ceil($total / $registros);

        $tabla .= ' <div class="table-responsive">
                    <table id="basic-datatable"  class="table dt-responsive nowrap w-100">
                    <thead class="table-light">
                     <tr>
                         <th>#</th>
                         <th>Dni</th>
                         <th>Nombre</th>
                         <th>Apellido </th>
                         <th>Teléfono</th>
                         <th>Usuario</th>
                         <th>Email</th>
                         <th>Actualizar</th>
                         <th>Eliminar</th>
                     </tr>
                 </thead>
                 <tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr>
                            <td>' . $contador . '</td>
                            <td>' . $rows['Cuenta_Dni'] . '</td>
                            <td>' . $rows['Cuenta_Nombre'] . '</td>
                            <td>' . $rows['Cuenta_Apellido'] . '</td>
                            <td>' . $rows['Cuenta_Telefono'] . '</td>
                            <td>' . $rows['Cuenta_Usuario'] . '</td>
                            <td>' . $rows['Cuenta_Email'] . '</td>
                            <td class="table-action">
                                <a href="' . SERVERURL . 'usuario-actualizar/' . mainModel::encryption($rows['Proveedor_ID']) . '/" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                            </td>
                            <td>
                                <form class="FormularioAjax" action="' . SERVERURL . 'ajax/usuarioAjax.php" method="POST" data-form="delete" autocomplete="off">
                                    <input type="hidden" name="proveedor_id_del" value="' . mainModel::encryption($rows['Proveedor_ID']) . '">
                                    <button type="submit" class="btn action-icon">
                                        <i class="mdi mdi-delete"></i>
                                    </button>                      
                                </form>
                            </td>
                        </tr>';

                $contador++;
            }
            $reg_final = $contador - 1;
        } else {
            # cuando no hay registro o se modifico la url 
            if ($total >= 1) {
                $tabla .= '<tr><td colspan="9" ><a class="btn btn-raised btn-primary btn-sm" href="' . $url . '" >Haga click para recargar la pagina</a></td></tr>';
            } else {
                $tabla .= '<tr><td colspan="9" >No hay registros en el sistema</td></tr>';
            }
        }
        $tabla .= ' </tbody>
                    </table>
                    </div>';

        if ($total >= 1 && $pagina <= $Npaginas) {
            $tabla .= '<p class="text-end">Mostrando usuarios ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        } else {
            $tabla .= '<p class="text-end">Mostrando usuarios 0 al 0 de un total de ' . $total . '</p>';
        }
        return $tabla;
    }
    // fin del controlador paginador usuario

    // controlador para eliminar usuarios
    public function eliminar_usuario_controlador()
    {

        // recibiendo el id del usuario 
        $id = mainModel::decryption($_POST['usuario_id_del']);
        $id = mainModel::limpiar_cadena($id);

        // comprobar el usuario
        if ($id == 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No podemos eliminar el usuario principal del sistema.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // comprobar el usuario en la base de datos 
        $check_usuario = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Id FROM cuenta WHERE Cuenta_Id = '$id'");

        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El usuario '$id'que esta por eliminar no existe en el sistema.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        //comprobar el privilegio 

        session_start(['name' => 'SCL']);

        if ($_SESSION['privilegio_scl'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No tienes los permisos necesarios para realizar esta operación, debido a que no cumples con el privilegio otorgado.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_usuario = usuarioModelo::eliminar_usuario_modelo($id);

        if ($eliminar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario Eliminado",
                "Texto" => "El Usuario fue eliminado del sistema exitosamente.",
                "Icono" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No le logro eliminar el usuario, por favor volver a intentar nuevamente para realizar la acción.",
                "Icono" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }
    // fin del controlador eliminar usuario

    // controlador para seleccionar los datos del usuario

    public function datos_usuario_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return usuarioModelo::datos_usuario_modelo($tipo, $id);
    } // fin controlador de seleccion de datos

    // controlador para actualizar usuario
    public function actualizar_usuario_controlador()
    {
        // recibiendo el id 
        $id = mainModel::decryption($_POST['usuario_id_up']);
        $id = mainModel::limpiar_cadena($id);

        // comprobar el usuario en la base de datos
        $check_user = mainModel::ejecutar_consulta_simple("SELECT * FROM cuenta WHERE Cuenta_Id = '$id'");
        if ($check_user->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se logro encontrar el usuario en el sistema, por favor volver a ingresar un usuario registrado.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_user->fetch();
        }

        $dni = mainModel::limpiar_cadena($_POST['usuario_DNI_up']);
        $nombre = mainModel::limpiar_cadena($_POST['usuario_nombre_up']);
        $apellido = mainModel::limpiar_cadena($_POST['usuario_apellido_up']);
        $telefono = mainModel::limpiar_cadena($_POST['usuario_telefono_up']);
        $direccion = mainModel::limpiar_cadena($_POST['usuario_direccion_up']);

        $usuario = mainModel::limpiar_cadena($_POST['usuario_name_up']);
        $email = mainModel::limpiar_cadena($_POST['usuario_email_up']);

        if (isset($_POST['usuario_estado_up'])) {
            $estado = mainModel::limpiar_cadena($_POST['usuario_estado_up']);
        } else {
            $estado = $campos['Cuenta_Estado'];
        }

        if (isset($_POST['usuario_estado_up'])) {
            $privilegio = mainModel::limpiar_cadena($_POST['usuario_privilegio_up']);
        } else {
            $privilegio = $campos['Cuenta_Privilegio'];
        }

        $admin_usuario = mainModel::limpiar_cadena($_POST['usuario_admin']);

        $admin_clave = mainModel::limpiar_cadena($_POST['clave_admin']);


        $tipo_cuenta = mainModel::limpiar_cadena($_POST['tipo_cuenta']);

        // comprobar campos vacios 

        if ($dni == "" || $nombre == "" || $apellido == "" || $usuario == "" || $email == "" || $admin_usuario == "" || $admin_clave == "") {

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

        if (mainModel::verificar_datos("[0-9-]{8,20}", $dni)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Dni no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}", $nombre)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El NOMBRE no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}", $apellido)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El APELLIDO no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if ($telefono != "") {
            if (mainModel::verificar_datos("[0-9()\+]{8,20}", $telefono)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El TELEFONO no coincide con el formato solicitado",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        if ($direccion != "") {
            if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "El DIRECCION no coincide con el formato solicitado",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El NOMBRE DE USUARIO no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if (mainModel::verificar_datos("[a-zA-Z0-9]{1,35}", $admin_usuario)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Tu NOMBRE DE USUARIO no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-Z0-9@.$\-]{7,100}", $admin_clave)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "Tu CLAVE no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $admin_clave = mainModel::encryption($admin_clave);

        if ($privilegio < 1 || $privilegio > 4) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El privilegio no corresponde a un valor valido.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        if ($estado != "Activo" &&  $estado != "Deshabilitado") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Estado no corresponde a un valor valido o es un formato incorrecto.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // verification de valores únicos 
        // ---------------------------------------
        // mediante estas comprobaciones se verificara que no se registren datos duplicados 

        // comprobar DNI mediante una consulta a la base de datos 
        if ($dni != $campos['Cuenta_Dni']) {
            # code...
            $check_dni = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Dni FROM cuenta WHERE Cuenta_Dni='$dni'");

            // si existen mas de un registro, se mandara un alerta 
            if ($check_dni->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "el DNI ingresado ya se encuentra registrado en el sistema.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }


        // comprobar el usuario mediante una consulta a la base de datos 
        if ($usuario != $campos['Cuenta_Usuario']) {
            # code...
            $check_user = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Usuario FROM cuenta WHERE Cuenta_Usuario='$usuario'");

            // si existen mas de un registro, se mandara un alerta 
            if ($check_user->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "el USUARIO ingresado ya se encuentra registrado en el sistema.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        //compribar el email

        if ($email != $campos['Cuenta_Email'] &&  $email != "") {
            if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                # code...
                $check_email = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Email FROM cuenta WHERE Cuenta_Email='$email'");

                // si existen mas de un registro, se mandara un alerta
                if ($check_email->rowCount() > 0) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "el Email ingresado ya se encuentra registrado en el sistema.",
                        "Icono" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
            } else {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Ha ingresado un correo no valido.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }

        // comprobando claves

        if ($_POST['usuario_clave1_nueva'] != "" ||  $_POST['usuario_clave2_nueva'] != "") {
            if ($_POST['usuario_clave1_nueva'] != $_POST['usuario_clave2_nueva']) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "Las nuevas claves no son iguales.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            } else {
                if (mainModel::verificar_datos("[a-zA-Z0-9@.$\-]{7,100}", $_POST['usuario_clave1_nueva']) || mainModel::verificar_datos("[a-zA-Z0-9@.$\-]{7,100}", $_POST['usuario_clave1_nueva'])) {
                    $alerta = [
                        "Alerta" => "simple",
                        "Titulo" => "Ocurrió un error inesperado",
                        "Texto" => "Las nuevas claves no coinciden con el formato solicitado.",
                        "Icono" => "error"
                    ];
                    echo json_encode($alerta);
                    exit();
                }
                $clave = mainModel::encryption($_POST['usuario_clave1_nueva']);
            }
        } else {
            $clave = $campos['Cuenta_Clave'];
        }

        // comprobar las credenciales para actualizar datos
        if ($tipo_cuenta == "Propia") {
            $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Usuario FROM cuenta WHERE Cuenta_Usuario='$admin_usuario' AND cuenta_Clave='$admin_clave' AND Cuenta_Id='$id'");
        } else {
            session_start(['name' => 'SCL']);
            if ($_SESSION['privilegio_scl'] != 1) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "No tienes los permisos necesarios para realizar la operación.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
            $check_cuenta = mainModel::ejecutar_consulta_simple("SELECT Cuenta_Usuario  FROM cuenta WHERE Cuenta_Usuario='$admin_usuario' AND cuenta_Clave='$admin_clave'");
        }

        if ($check_cuenta->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Usuario y la clave del administrador no son validos.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // Preparando datos para enviar al modelo de usuario actualizar

        $datos_usuario_up = [
            "DNI" => $dni,
            "Nombre" => $nombre,
            "Apellido" => $apellido,
            "Direccion" => $direccion,
            "Telefono" => $telefono,
            "Email" => $email,
            "Usuario" => $usuario,
            "Clave" => $clave,
            "Estado" => $estado,
            "Privilegio" => $privilegio,
            "ID" => $id
        ];

        $actualizar_usuario = usuarioModelo::actualizar_usuario_modelo($datos_usuario_up);
        if ($actualizar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario registrado",
                "Texto" => "Los datos del usuario han sido actualizados con éxito.",
                "Icono" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se ha podido actualizar el usuario, por favor intente nuevamente.",
                "Icono" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    } // fin controlador de actualizar de datos
}
