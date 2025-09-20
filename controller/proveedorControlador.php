<?php

if ($peticionAjax) {
    require_once "../models/proveedorModelo.php";
} else {
    require_once "./models/proveedorModelo.php";
}

class proveedorControlador extends proveedorModelo
{

    // controlador para agregar proveedor
    public function agregar_proveedor_controlador()
    {

        // obtener datos del formulario
        $ruc = mainModel::limpiar_cadena($_POST['proveedor_ruc_reg']);
        $razonSocial = mainModel::limpiar_cadena($_POST['proveedor_razon_social_reg']);
        $direccion = mainModel::limpiar_cadena($_POST['proveedor_direccion_reg']);
        $contacto = mainModel::limpiar_cadena($_POST['proveedor_contacto_reg']);
        $telefono = mainModel::limpiar_cadena($_POST['proveedor_telefono_reg']);

        // comprobar los campos vacios

        if ($ruc == "" || $razonSocial == "" || $direccion == "" || $contacto == "" || $telefono == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // verificar la integridad de los datos 
        if (mainModel::verificar_datos("[0-9-]{11,20}", $ruc)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Ruc no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,100}", $razonSocial)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La Razon Social no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La Direccion del proveedor no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,100}", $contacto)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Nombre del Contacto no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9()\+]{8,20}", $telefono)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Telefono no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        // verificación de valores unicos

        // comprobar Ruc del Proveedor 
        $check_ruc = mainModel::ejecutar_consulta_simple("SELECT Proveedor_RUC FROM proveedor WHERE Proveedor_RUC = '$ruc'");

        if ($check_ruc->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "el Ruc del proveedor ingresado ya se encuentra registrado en el sistema.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_proveedor_reg = [
            "Ruc" => $ruc,
            "RazonSocial" => $razonSocial,
            "Direccion" => $direccion,
            "Contacto" => $contacto,
            "Telefono" => $telefono
        ];

        $agregar_proveedor = proveedorModelo::agregar_proveedor_modelo($datos_proveedor_reg);

        if ($agregar_proveedor  == true) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario registrado",
                "Texto" => "Los datos del proveedor han sido registrados con éxito.",
                "Icono" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se ha podido registrar el proveedor, por favor intente nuevamente.",
                "Icono" => "error"
            ];
        }
        echo json_encode($alerta);
    } // fin del controlador agregar usuario

    // controlador para paginar proveedor
    public function paginador_proveedor_controlador($pagina, $registros, $privilegio, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $registros = mainModel::limpiar_cadena($registros);
        $privilegio = mainModel::limpiar_cadena($privilegio);

        $url = mainModel::limpiar_cadena($url);

        $url = SERVERURL . $url . "/";

        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";

        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $registros) - $registros) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM proveedor WHERE ((Proveedor_Ruc LIKE '%$busqueda%' OR Proveedor_RazonSocial LIKE '%$busqueda%' OR Proveedor_Contacto LIKE '%$busqueda%' OR Proveedor_Direccion LIKE '%$busqueda%' ) ) ORDER BY Proveedor_RazonSocial ASC LIMIT $inicio, $registros";
        } else {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM proveedor  ORDER BY Proveedor_RazonSocial ASC LIMIT $inicio, $registros";
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
                         <th>Ruc</th>
                         <th>Razón Social</th>
                         <th>Dirección</th>
                         <th>Contacto</th>
                         <th>Telefono</th>';
        if ($privilegio == 1 || $privilegio == 2) {
            $tabla .= '  <th>Actualizar</th>';
        }
        if ($privilegio == 1) {
            $tabla .= '  <th>Eliminar</th>';
        }

        $tabla .= '  </tr>
                 </thead>
                 <tbody>';
        if ($total >= 1 && $pagina <= $Npaginas) {
            $contador = $inicio + 1;
            $reg_inicio = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '<tr>
                            <td>' . $contador . '</td>
                            <td>' . $rows['Proveedor_RUC'] . '</td>
                            <td>' . $rows['Proveedor_RazonSocial'] . '</td>
                            <td><button type="button" class="btn btn-info" data-bs-toggle="popover" data-bs-trigger="hover" title="' . $rows['Proveedor_RazonSocial'] . '" data-bs-content="' . $rows['Proveedor_Direccion'] . '">
							<i class="dripicons-location"></i>
						</button></td>
                            <td>' . $rows['Proveedor_Contacto'] . '</td>
                            <td>' . $rows['Proveedor_Telefono'] . '</td>';
                if ($privilegio == 1 || $privilegio == 2) {
                    $tabla .= ' <td class="table-action">
                                <a href="' . SERVERURL . 'proveedor-actualizar/' . mainModel::encryption($rows['Proveedor_ID']) . '/" class="action-icon"> <i class="mdi mdi-pencil"></i></a>
                            </td>';
                }
                if ($privilegio == 1) {
                    $tabla .= '      <td>
                                <form class="FormularioAjax" action="' . SERVERURL . 'ajax/proveedorAjax.php" method="POST" data-form="delete" autocomplete="off">
                                    <input type="hidden" name="proveedpr_id_del" value="' . mainModel::encryption($rows['Proveedor_ID']) . '">
                                    <button type="submit" class="btn action-icon">
                                        <i class="mdi mdi-delete"></i>
                                    </button>                      
                                </form>
                            </td>';
                }
                $tabla .= '   </tr>';

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
            $tabla .= '<p class="text-end">Mostrando Proveedores ' . $reg_inicio . ' al ' . $reg_final . ' de un total de ' . $total . '</p>';
            $tabla .= mainModel::paginador_tablas($pagina, $Npaginas, $url, 7);
        } else {
            $tabla .= '<p class="text-end">Mostrando usuarios 0 al 0 de un total de ' . $total . '</p>';
        }
        return $tabla;
    } // fin del controlador paginador usuario

    // controlador de eliminar proveedor
    public function eliminar_proveedor_controlador()
    {
        // recuperar el id del proveedor
        $id = mainModel::decryption($_POST['proveedpr_id_del']);
        $id = mainModel::limpiar_cadena($id);

        // comprobar el proveedor en la base de datos
        $check_proveedor = mainModel::ejecutar_consulta_simple("SELECT Proveedor_ID FROM proveedor WHERE Proveedor_ID = '$id'");

        if ($check_proveedor->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se encontró el proveedor en el sistema.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // comprobar ordenes de compra
        // si el proveedor esta registrado en ordenes de compra, no se podrá eliminar por tener ya conexiones con esa orden de compra.

        $check_ordenCompra = mainModel::ejecutar_consulta_simple("SELECT Proveedor_ID FROM ordencompra WHERE Proveedor_ID='$id' LIMIT 1");

        if ($check_ordenCompra->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se puede eliminar este proveedor del sistema porque tiene ordenes de compras asociados.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // comprobar los privilegios
        session_start(['name' => 'SCL']);
        if ($_SESSION['privilegio_scl'] != 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No tienes los permisos necesarios para realizar esta operación.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $eliminar_proveedor = proveedorModelo::eliminar_proveedor_modelo($id);

        if ($eliminar_proveedor->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Proveedor Eliminado",
                "Texto" => "El Proveedor ha sido eliminado del sistema correctamente.",
                "Icono" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se puedo eliminar al proveedor, por favor intente nuevamente.",
                "Icono" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }
    // fin del controlador eliminar usuario
    // controlador para selecciona los datos del proveedor
    public function datos_proveedor_controlador($tipo, $id)
    {
        $tipo = mainModel::limpiar_cadena($tipo);

        $id = mainModel::decryption($id);
        $id = mainModel::limpiar_cadena($id);

        return proveedorModelo::datos_proveedor_modelo($tipo, $id);
    }
    // fin controlador seleccion de datos proveedor
    //
    // controlador para actualizar los datos del proveedor

    public function actualizar_proveedor_controlador()
    {
        // recupera el id del proveedor 
        $id = mainModel::decryption($_POST['proveedor_id_up']);
        $id = mainModel::limpiar_cadena($id);

        // comprobar al proveedor existe la base de datos 
        $check_proveedor = mainModel::ejecutar_consulta_simple("SELECT * FROM proveedor WHERE Proveedor_ID = '$id'");

        if ($check_proveedor->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No hemos encontrado al proveedor en el sistema.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        } else {
            $campos = $check_proveedor->fetch();
        }

        // registrar datos para su actualizacion

        $ruc = mainModel::limpiar_cadena($_POST['proveedor_ruc_up']);
        $razonSocial = mainModel::limpiar_cadena($_POST['proveedor_razon_social_up']);
        $direccion = mainModel::limpiar_cadena($_POST['proveedor_direccion_up']);
        $contacto = mainModel::limpiar_cadena($_POST['proveedor_contacto_up']);
        $telefono = mainModel::limpiar_cadena($_POST['proveedor_telefono_up']);

        if ($ruc == "" || $razonSocial == "" || $direccion == "" || $contacto == "" || $telefono == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No has llenado todos los campos que son obligatorios",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        // verificar la integridad de los datos 
        if (mainModel::verificar_datos("[0-9]{11}", $ruc)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Ruc no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,100}", $razonSocial)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La Razon Social no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}", $direccion)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "La Direccion del proveedor no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,100}", $contacto)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Nombre del Contacto no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        if (mainModel::verificar_datos("[0-9()\+]{8,20}", $telefono)) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "El Telefono no coincide con el formato solicitado",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }
        // verificación de valores unicos

        // comprobar Ruc del Proveedor 
        if ($ruc != $campos['Proveedor_RUC']) {
            $check_ruc = mainModel::ejecutar_consulta_simple("SELECT Proveedor_RUC FROM proveedor WHERE Proveedor_RUC = '$ruc'");

            if ($check_ruc->rowCount() > 0) {
                $alerta = [
                    "Alerta" => "simple",
                    "Titulo" => "Ocurrió un error inesperado",
                    "Texto" => "el Ruc del proveedor ingresado ya se encuentra registrado en el sistema.",
                    "Icono" => "error"
                ];
                echo json_encode($alerta);
                exit();
            }
        }
        //comprobar privilegios 
        session_start(['name' => 'SCL']);

        if ($_SESSION['privilegio_scl'] < 1 || $_SESSION['privilegio_scl'] > 2) {

            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "el usuario no tiene los privilegios necesarios para realizar esta acción.",
                "Icono" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $datos_proveedor_up = [

            "Ruc" => $ruc,
            "Razon" => $razonSocial,
            "Direccion" => $direccion,
            "Contacto" => $contacto,
            "Telefono" => $telefono,
            "Id" => $id
        ];

        // corregir error de la actualizacion del proveedor  
        if (proveedorModelo::actualizar_proveedor_modelo($datos_proveedor_up)) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Proveedor Actualizado",
                "Texto" => "Los datos del cliente han sido actualizados",
                "Icono" => "success"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrió un error inesperado",
                "Texto" => "No se pudo actualizar el proveedor",
                "Icono" => "error"
            ];
        }
        echo json_encode($alerta);
    }
}
    //fin controlador actualizar datos del proveedor 
