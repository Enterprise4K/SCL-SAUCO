<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="header-title">Control de Proveedores</h4>
                <p class="text-muted font-14">Modulo control de Proveedores.</p>
            </div>
        </div>
    </div>
    <!--contenedor registrar nuevo proveedor -->
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <div class="col-xl-8">
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#standard-modal">Registrar Proveedor</button>
                            <div id="standard-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="standard-modalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title" id="standard-modalLabel">Registrar Proveedor</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>
                                        <div class="modal-body">
                                            <!-- formulario para registro de usuarios -->
                                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/proveedorAjax.php" method="POST" data-form="save">
                                                <i class="dripicons-article text-muted" style="font-size: 24px;">
                                                    <h5 class="mt-0">Información Proveedor</h5>
                                                </i>
                                                <div class="mb-3">
                                                    <label class="form-label">RUC</label>
                                                    <input type="text" pattern="[0-9-]{11,20}" maxlength="11" class="form-control" name="proveedor_ruc_reg" placeholder="Ruc" autocomplete="off">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label" ">Razon Social</label>
                                                        <input type=" text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,100}" maxlength="100" class="form-control" name="proveedor_razon_social_reg" placeholder="Razon Social" autocomplete="off">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Direccion</label>
                                                    <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" maxlength="190" class="form-control" name="proveedor_direccion_reg" placeholder="Dirección" value="" autocomplete="off">

                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Nombre del Contacto</label>
                                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,100}" maxlength="190" class="form-control" name="proveedor_contacto_reg" placeholder="Contacto" value="" autocomplete="off">
                                                </div>
                                                <div class="mb-3">
                                                    <label class="form-label">Teléfono</label>
                                                    <input type="text" pattern="[0-9()\+]{8,20}" maxlength="20" class="form-control" name="proveedor_telefono_reg" placeholder="Teléfono" value="" autocomplete="off">

                                                </div>

                                                <!-- SELECCIONAR NIVEL DE PRIVILEGIOS DEL SISTEMA -->

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
                                <a href="<?php echo SERVERURL; ?>proveedor-busqueda/" class="btn btn-primary">Busqueda personalida Proveedor</a>
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
    <!-- fin de contenedor de registrar nuevo usuario -->

    <!-- contenedor de la tabla de proveedores -->
    <!-- Contenedor de tabla -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">

                        <?php

                        require_once "./controller/proveedorControlador.php";

                        $inst_proveedor = new proveedorControlador();

                        echo $inst_proveedor->paginador_proveedor_controlador($pagina[1], 15, $_SESSION['privilegio_scl'], $pagina[0], "");
                        ?>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- fin contenedor de tabla -->
    <!-- fin de contenedor de la tabla de usuarios -->
</div>