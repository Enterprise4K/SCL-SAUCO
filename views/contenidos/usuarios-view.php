    <?php
    if ($_SESSION['privilegio_scl'] != 1) {
        echo $ic->forzar_cierre_sesion_controlador();
        exit();
    }
    ?>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="header-title">Control de Usuarios</h4>
                    <p class="text-muted font-14">
                        Modulo de control de usuarios.Uso admin.
                    </p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">
                            <div class="col-xl-8">
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">Registrar Usuario</button>
                                <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h4 class="modal-title" id="standard-modalLabel">Registrar Usuario</h4>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- formulario para registro de usuarios -->
                                                <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/usuarioAjax.php" method="POST" data-form="save">
                                                    <i class="dripicons-article text-muted" style="font-size: 24px;">
                                                        <h5 class="mt-0">Información Personal</h5>
                                                    </i>
                                                    <div class="mb-3">
                                                        <label class="form-label">DNI</label>
                                                        <input type="text" pattern="[0-9-]{8,20}" maxlength="8" class="form-control" name="usuario_DNI_reg" placeholder="DNI">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" ">Nombre</label>
                                                        <input type=" text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" maxlength="35" class="form-control" name="usuario_nombre_reg" placeholder="Nombre">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Apellido</label>
                                                        <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,35}" maxlength="35" class="form-control" name="usuario_apellido_reg" placeholder="apellido" value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Teléfono</label>
                                                        <input type="text" pattern="[0-9()\+]{8,20}" maxlength="20" class="form-control" name="usuario_telefono_reg" placeholder="Teléfono" value="">

                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Direccion</label>
                                                        <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" maxlength="190" class="form-control" name="usuario_direccion_reg" placeholder="Dirección" value="">

                                                    </div>
                                                    <!-- SE  AGREGARA LDS DATOS PARA EL USUSARIO PARA SU INICIO DE SESSION -->
                                                    <i class="mdi mdi-account-lock-open" style="font-size: 24px;">
                                                        <h5 class="mt-0">Información de la Cuenta</h5>
                                                    </i>
                                                    <div class="mb-3">
                                                        <label class="form-label">Usuario</label>
                                                        <div class="input-group">
                                                            <span class="input-group-text" id="inputGroupPrepend">@</span>
                                                            <input type="text" pattern="[a-zA-Z0-9]{1,35}" class="form-control" name="usuario_name_reg" placeholder=Usuario"
                                                                aria-describedby="inputGroupPrepend">
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">EMail</label>
                                                        <input type="email" class="form-control" placeholder="Email" name="usuario_email_reg" value="">
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Contraseña</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" class="form-control" name="usuario_clave1_reg" pattern="[a-zA-Z0-9@.$\-]{7,100}" maxlength="100" placeholder="Enter your password">
                                                            <div class="input-group-text" data-password="false">
                                                                <span class="password-eye"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Repetir Contraseña</label>
                                                        <div class="input-group input-group-merge">
                                                            <input type="password" class="form-control" name="usuario_clave2_reg" pattern="[a-zA-Z0-9@.$\-]{7,100}" maxlength="100" placeholder="Enter your password">
                                                            <div class="input-group-text" data-password="false">
                                                                <span class="password-eye"></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- SELECCIONAR NIVEL DE PRIVILEGIOS DEL SISTEMA -->
                                                    <i class="dripicons-lock text-muted" style="font-size: 24px;">
                                                        <h5 class="mt-0">Nivel de privilegios</h5>
                                                    </i>
                                                    <div class="mb-3">
                                                        <label for="password" class="form-label"><span class="badge bg-primary">Control Total</span> Permisos para registrar, actualizar y eliminar.</label>
                                                        <label for="password" class="form-label"><span class="badge bg-secondary">Edición</span> Permisos para registrar, actualizar.</label>
                                                        <label for="password" class="form-label"><span class="badge bg-danger">Registrar</span> Permisos para registrar.</label>
                                                        <label for="password" class="form-label"><span class="badge bg-info">Visualizar</span> Permisos para visualizar.</label>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-select" class="form-label">Input Select</label>
                                                        <select class="form-select" id="example-select" name="usuario_privilegio_reg">
                                                            <option value=""> -- Seleccionar Opción -- </option>
                                                            <option value="1">Nivel 1 - Control Total</option>
                                                            <option value="2">Nivel 2 - Edición</option>
                                                            <option value="3">Nivel 3 - Registrar</option>
                                                            <option value="4">Nivel 4 - Visualizar</option>
                                                        </select>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <div class="mb-3">
                                                            <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>

                                        </div><!-- /.modal-content -->
                                    </div><!-- /.modal-dialog -->
                                </div><!-- /.modal -->
                            </div>
                            <div class="col-xl-4">
                                <div class="text-xl-end mt-xl-0 mt-2">
                                    <a href="<?php echo SERVERURL; ?>usuario-busqueda/" class="btn btn-primary">Busqueda personalida</a>
                                </div>

                                <!-- programar tipo de busqueda por filtro-->
                                <!--   <div class="col-auto">
                                        <div class="d-flex align-items-center">
                                            <label for="status-select" class="me-2">Status</label>
                                            <select class="form-select" id="status-select">
                                                <option selected>Choose...</option>
                                                <option value="1">Paid</option>
                                                <option value="2">Awaiting Authorization</option>
                                                <option value="3">Payment failed</option>
                                                <option value="4">Cash On Delivery</option>
                                                <option value="5">Fulfilled</option>
                                                <option value="6">Unfulfilled</option>
                                            </select>
                                        </div>
                                    </div>-->

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Contenedor de tabla -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row mb-2">

                            <?php

                            require_once "./controller/usuarioControlador.php";

                            $inst_usuario = new usuarioControlador();

                            echo $inst_usuario->paginador_usuario_controlador($pagina[1], 15, $_SESSION['privilegio_scl'], $_SESSION['id_scl'], $pagina[0], "");
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin contenedor de tabla -->
    </div>

    <!-- DISEÑAR MODULO DE USUARIO , REGISTRAR, LISTAR , ACTUALIZAR USUARIOS -->