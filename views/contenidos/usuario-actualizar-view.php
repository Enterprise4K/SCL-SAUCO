<?php
if ($ic->encryption($_SESSION['id_scl']) != $pagina[1]) {
    if ($_SESSION['privilegio_scl'] != 1) {
        echo $ic->forzar_cierre_sesion_controlador();
        exit();
    }
}

?>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Usuarios</h4>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <!-- titulo -->
                    <h4 class="header-title">Actualizar Usuario : </h4>
                    <p class="text-muted font-14">
                        Modulo de control de actualización de usuarios..
                    </p>
                    <div class="page-title-right">
                        <?php
                        require_once "./controller/usuarioControlador.php";

                        $ins_usuario = new usuarioControlador();

                        $datos_usuario = $ins_usuario->datos_usuario_controlador("Unico", $pagina[1]);

                        if ($datos_usuario->rowCount() == 1) {
                            // convertimos los datos en un array para distribuir mejor en el formulario
                            $campos = $datos_usuario->fetch();

                        ?>
                            <!-- formulario para mostrar los datos para actualizar -->
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="update">
                                <input type="hidden" name="usuario_id_up" value="<?php echo $pagina[1]; ?>">
                                <i class=" dripicons-article text-muted" style="font-size: 24px;">
                                    <h5 class="mt-0">Información Personal</h5>
                                </i>
                                <div class="row">
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">DNI</label>
                                        <input type="text" pattern="[0-9-]{8,20}" maxlength="8" class="form-control" name="usuario_DNI_up" placeholder="DNI" value="<?php echo $campos['Cuenta_Dni']; ?>">
                                    </div>
                                    <div class=" col-md-3 mb-3">
                                        <label class="form-label" ">Nombre</label>
                                                <input type=" text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" maxlength="35" class="form-control" name="usuario_nombre_up" placeholder="Nombre" value="<?php echo $campos['Cuenta_Nombre']; ?>">
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Apellido</label>
                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" maxlength="35" class="form-control" name="usuario_apellido_up" placeholder="apellido" value="<?php echo $campos['Cuenta_Apellido']; ?>">
                                    </div>

                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Teléfono</label>
                                        <input type="text" pattern="[0-9()\+]{8,20}" maxlength="20" class="form-control" name="usuario_telefono_up" placeholder="Teléfono" value="<?php echo $campos['Cuenta_Telefono']; ?>">

                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Direccion</label>
                                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" maxlength="190" class="form-control" name="usuario_direccion_up" placeholder="Dirección" value="<?php echo $campos['Cuenta_Direccion']; ?>">

                                    </div>

                                </div>
                                <div class="row">
                                    <!-- SE  AGREGARA LDS DATOS PARA EL USUSARIO PARA SU INICIO DE SESSION -->
                                    <i class="mdi mdi-account-lock-open" style="font-size: 24px;">
                                        <h5 class="mt-0">Información de la Cuenta</h5>
                                    </i>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Usuario</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="usuario_name_up" placeholder=Usuario"
                                                aria-describedby="inputGroupPrepend" value="<?php echo $campos['Cuenta_Usuario']; ?>">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class=" form-label">EMail</label>
                                        <input type="email" class="form-control" placeholder="Email" name="usuario_email_up" value="<?php echo $campos['Cuenta_Email']; ?>">
                                    </div>

                                    <?php if ($_SESSION['privilegio_scl'] == 1 && $campos['Cuenta_Id'] != 1) { ?>
                                        <div class="col-md-3 mb-3">
                                            <label class="form-label">Estado de la cuenta &nbsp; <?php if ($campos['Cuenta_Estado'] == "Activo") {
                                                                                                        echo '<span class="badge badge badge-success-lighten">Activa</span>';
                                                                                                    } else {
                                                                                                        echo '<span class="badge badge badge-danger-lighten">Deshabilitado</span>';
                                                                                                    } ?> </label>

                                            <select class="form-select mb-3" name="usuario_estado_up" id="">
                                                <option value="Activo" <?php if ($campos['Cuenta_Estado'] == "Activo") {
                                                                            echo 'selected=""';
                                                                        } ?>>Activa</option>
                                                <option value="Deshabilitado" <?php if ($campos['Cuenta_Estado'] == "Deshabilitado") {
                                                                                    echo 'selected=""';
                                                                                } ?>>Deshabilitada</option>
                                            </select>
                                        </div>
                                    <?php } ?>

                                    <br>
                                    <i class="mdi mdi-form-textbox-password" style="font-size: 24px;">
                                        <h5 class="mt-0">Nueva Contraseña</h5>
                                        <p class="text-muted font-14"> Para Actualizar la contraseña de esta cuenta ingrese una nueva contraseña. En caso que no desee actualizar debe de dejar vacios los campos de la contraseña</p>
                                    </i>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Contraseña</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" name="usuario_clave1_nueva" pattern="[a-zA-Z0-9@.$\-]{7,100}" maxlength="100" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Repetir Contraseña</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" name="usuario_clave2_nueva" pattern="[a-zA-Z0-9@.$\-]{7,100}" maxlength="100" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                                <?php if ($_SESSION['privilegio_scl'] == 1 && $campos['Cuenta_Id'] != 1) { ?>
                                    <!-- SELECCIONAR NIVEL DE PRIVILEGIOS DEL SISTEMA -->
                                    <i class="dripicons-lock text-muted" style="font-size: 24px;">
                                        <h5 class="mt-0">Nivel de privilegios</h5>
                                    </i>
                                    <div class="mb-3">
                                        <label for="password" class="form-label"><span class="badge bg-primary">Control Total</span> Permisos para registrar, actualizar y eliminar.</label><br>
                                        <label for="password" class="form-label"><span class="badge bg-secondary">Edición</span> Permisos para registrar, actualizar.</label><br>
                                        <label for="password" class="form-label"><span class="badge bg-danger">Registrar</span> Permisos para registrar.</label><br>
                                        <label for="password" class="form-label"><span class="badge bg-info">Visualizar</span> Permisos para visualizar.</label><br>
                                    </div>
                                    <div class="mb-3">
                                        <label for="example-select" class="form-label">Input Select</label>
                                        <select class="form-select" id="example-select" name="usuario_privilegio_up">

                                            <option value="1" <?php if ($campos['Cuenta_Privilegio'] == 1) {
                                                                    echo 'selected=""';
                                                                } ?>>Nivel 1 - Control Total</option>
                                            <option value="2" <?php if ($campos['Cuenta_Privilegio'] == 2) {
                                                                    echo 'selected=""';
                                                                } ?>>Nivel 2 - Edición</option>
                                            <option value="3" <?php if ($campos['Cuenta_Privilegio'] == 3) {
                                                                    echo 'selected=""';
                                                                } ?>>Nivel 3 - Registrar</option>
                                            <option value="4" <?php if ($campos['Cuenta_Privilegio'] == 4) {
                                                                    echo 'selected=""';
                                                                } ?>>Nivel 4 - Visualizar</option>

                                        </select>
                                    </div>
                                    <!-- FIN DE SECCIÓN DE PRIVILEGIO -->
                                <?php } ?>

                                <!-- credenciales para actualizar usuario actualizado -->

                                <div class="row">
                                    <br>
                                    <i class="mdi mdi-form-textbox-password" style="font-size: 24px;">
                                        <h5 class="mt-0">Validación</h5>
                                        <p class="text-muted font-14">Para poder guardar los en esta cuenta debe de ingresar su nombre de usuario y credenciales para realizar la acción</p>
                                    </i>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Usuario</label>
                                        <div class="input-group">
                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                            <input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="usuario_admin" placeholder="Usuario"
                                                aria-describedby="inputGroupPrepend" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-3 mb-3">
                                        <label class="form-label">Contraseña</label>
                                        <div class="input-group input-group-merge">
                                            <input type="password" class="form-control" name="clave_admin" pattern="[a-zA-Z0-9@.$\-]{7,100}" maxlength="100" placeholder="Enter your password">
                                            <div class="input-group-text" data-password="false">
                                                <span class="password-eye"></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- fin de credenciales -->

                                <?php if ($ic->encryption($_SESSION['id_scl']) != $pagina[1]) { ?>
                                    <input type="hidden" name="tipo_cuenta" value="Impropia">
                                <?php  } else { ?>
                                    <input type="hidden" name="tipo_cuenta" value="Propia">
                                <?php } ?>

                                <div class="modal-footer">
                                    <div class="mb-3">
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </div>
                            </form>

                        <?php } else { ?>
                            <!-- mensaje de error cuando no se seleccione datos en la base de datos  -->

                            <div class="col-lg-4">
                                <div class="card text-white bg-danger overflow-hidden">
                                    <div class="card-body">
                                        <div class="toll-free-box text-center">
                                            <h4> <i class="mdi mdi-headset"></i> Need help ? Just contact us</h4>
                                        </div>
                                    </div> <!-- end card-body-->
                                </div>
                            </div> <!-- end col-->
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>