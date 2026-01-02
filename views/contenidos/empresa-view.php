<div class="container-fluid">
    <!-- titulo -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Datos de la empresa </h4>
            </div>
        </div>
    </div>
    <!-- fin titulo -->
    <?php
    require_once "./controller/empresaControlador.php";
    $ins_empresa = new empresaControlador();

    $datos_empresa = $ins_empresa->datos_empresa_controlador();

    if ($datos_empresa->rowCount() == 0) {
    ?>
        <!-- formulario para registrar empresa -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Registrar Empresa</h4>
                        <p class="text-muted font-14">La empresa del Sistema aun no esta registrado, use el formulario para registrar a su empresa </p>
                        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/empresaAjax.php" method="POST" data-form="save" autocomplete="off">

                            <div class="mb-3">
                                <label for="empresa_nombre" class="form-label">Razón Social: </label>
                                <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{1,70}" name="empresa_nombre_reg" class=" form-control" id="empresa_nombre" placeholder="empresa sac" maxlength="70">
                            </div>
                            <div class="row g-2">
                                <div class="mb-3 col-md-6">
                                    <label for="empresa_email" class="form-label">Email</label>
                                    <input type="email" name="empresa_email_reg" class="form-control" id="empresa_email" placeholder="Email" maxlength="70">
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label class="form-label" for="empresa_telefono">Teléfono</label>
                                    <input type="text" class="form-control" pattern="[0-9()+]{8,20}" name="empresa_telefono_reg" id="empresa_telefono" maxlength="9" data-toggle="input-mask">
                                    <!-- <span class="font-13 text-muted">e.g "(+51) 000-000-000"</span> -->
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="empresa_direccion" class="form-label"> Direccion</label>
                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" name="empresa_direccion_reg" class="form-control" id="empresa_direccion" maxlength="190" placeholder="1234 Main St">
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <?php
    } elseif ($datos_empresa->rowCount() == 1 && $_SESSION['privilegio_scl'] == 1 || $_SESSION['privilegio_scl'] == 2) {
        $campos = $datos_empresa->fetch();
    ?>
        <!-- MEJORAR LA VIZUALIZACION DEL CARD DE LA empresa para la actualización de la empresa minuto 11:38 -->
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-body">

                        <!-- imagen de la empresa -->
                        <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-lg img-thumbnail"
                            alt="profile-image">

                        <h4 class="mb-0 mt-2"><?php echo $campos['empresa_nombre']; ?></h4>
                        <br>
                        <!-- formulario de perfil de empresa modal -->

                        <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="standard-modalLabel">Modal Heading</h4>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                    </div>
                                    <div class="modal-body">
                                        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/empresaAjax.php" method="POST" data-form="update" autocomplete="off">
                                            <input type="hidden" name="empresa_id_up" value="<?php echo $campos['empresa_Id']; ?>">
                                            <div class="mb-3">
                                                <label for="empresa_nombre" class="form-label">Razón Social: </label>
                                                <input type="text" pattern="[a-zA-z0-9áéíóúÁÉÍÓÚñÑ. ]{1,70}" name="empresa_nombre_up" class=" form-control" id="empresa_nombre" placeholder="empresa sac" maxlength="70" value="<?php echo $campos['empresa_nombre']; ?>">
                                            </div>
                                            <div class="row g-2">
                                                <div class="mb-3 col-md-6">
                                                    <label for="empresa_email" class="form-label">Email</label>
                                                    <input type="email" name="empresa_email_up" class="form-control" id="empresa_email" placeholder="Email" maxlength="70" value="<?php echo $campos['empresa_email']; ?>">
                                                </div>
                                                <div class="mb-3 col-md-6">
                                                    <label class="form-label" for="empresa_telefono">Teléfono</label>
                                                    <input type="text" class="form-control" pattern="[0-9()+]{8,20}" name="empresa_telefono_reg" id="empresa_telefono" maxlength="20" data-toggle="input-mask" data-mask-format="(+51) 000-000-000" value="<?php echo $campos['empresa_telefono']; ?>">
                                                    <span class="font-13 text-muted">e.g "(+51) 000-000-000"</span>
                                                </div>
                                            </div>

                                            <div class="mb-3">
                                                <label for="empresa_direccion" class="form-label"> Direccion</label>
                                                <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" name="empresa_direccion_reg" class="form-control" id="empresa_direccion" maxlength="190" placeholder="1234 Main St" value="<?php echo $campos['empresa_direccion']; ?>">
                                            </div>
                                            <button type="submit" class="btn btn-primary">Guardar</button>

                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div><!-- /.modal-content -->
                            </div><!-- /.modal-dialog -->
                        </div><!-- /.modal -->

                        <!-- formulario de perfil de empresa fin modal -->

                        <button type="button" class="btn btn-success btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#standard-modal">Actualizar</button>

                        <div class="text-start mt-3">
                            <p class="text-muted mb-2 font-13"><strong>Teléfono :</strong>
                                <span class="ms-2"><?php echo $campos['empresa_telefono']; ?></span>
                            </p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 "><?php echo $campos['empresa_email']; ?></span></p>

                            <p class="text-muted mb-1 font-13"><strong>Dirección :</strong> <span class="ms-2"><?php echo $campos['empresa_direccion']; ?></span></p>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col-->
        </div>
    <?php } else { ?>
        <!-- error cuando no encuentra a la empresa o error en el modelo o controlador-->
    <?php } ?>
</div>