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
    require_once "./controller/empresaControlado.php";
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
                        <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/empresaAjax.php" method="POST" data-form="save">
                            <input type="hidden" name="proveedor_id_up" value="<?php echo $pagina[1]; ?>">
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
                                    <input type="text" class="form-control" pattern="[0-9()+]{8,20}" name="empresa_telefono_reg" id="empresa_telefono" maxlength="20" data-toggle="input-mask" data-mask-format="(+51) 000-000-000">
                                    <span class="font-13 text-muted">e.g "(+51) 000-000-000"</span>
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
        <!-- MEJORAR LA VIZUALIZACION DEL CARD DE LA empreaa para la actualizacion de la empresa minuto 11:38 -->
        <div class="row">
            <div class="col-12">
                <div class="card text-center">
                    <div class="card-body">
                        <!-- <img src="assets/images/users/avatar-1.jpg" class="rounded-circle avatar-lg img-thumbnail"
                        alt="profile-image"> -->

                        <h4 class="mb-0 mt-2">El Sauco Comedores y Hospedaje SAC</h4>
                        <br>

                        <button type="button" class="btn btn-success btn-sm mb-2">Actualizar</button>
                        <button type="button" class="btn btn-danger btn-sm mb-2">Message</button>

                        <div class="text-start mt-3">
                            <!-- <h4 class="font-13 text-uppercase">About Me :</h4>
                        <p class="text-muted font-13 mb-3">
                            Hi I'm Johnathn Deo,has been the industry's standard dummy text ever since the
                            1500s, when an unknown printer took a galley of type.
                        </p> -->
                            <p class="text-muted mb-2 font-13"><strong>Contacto :</strong> <span class="ms-2">Geneva
                                    D. McKnight</span></p>

                            <p class="text-muted mb-2 font-13"><strong>Teléfono :</strong>
                                < class="ms-2">(123)
                                    123 1234</ span>
                            </p>

                            <p class="text-muted mb-2 font-13"><strong>Email :</strong> <span class="ms-2 ">user@email.domain</span></p>

                            <p class="text-muted mb-1 font-13"><strong>Dirección :</strong> <span class="ms-2">USA</span></p>
                        </div>
                    </div> <!-- end card-body -->
                </div> <!-- end card -->
            </div> <!-- end col-->
        </div>
    <?php } else { ?>
        <!-- erro -->
    <?php } ?>
</div>