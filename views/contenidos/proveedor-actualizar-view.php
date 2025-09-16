<?php
if ($_SESSION['privilegio_scl'] < 1 || $_SESSION['privilegio_scl'] > 2) {
    echo $ic->forzar_cierre_sesion_controlador();
    exit();
}
?>
<div class="container-fluid">
    <!-- contenedor par el titulo del modulo -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="header-title">Actualización de Proveedores</h4>
                <p class="text-muted font-14"> Nódulo de Actualización de proveedores</p>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row mb-2">
                        <?php
                        require_once "./controller/proveedorControlador.php";
                        $inst_proveedor = new proveedorControlador();

                        $datos_proveedor = $inst_proveedor->datos_proveedor_controlador("Unico", $pagina[1]);
                        if ($datos_proveedor->rowCount() == 1) {

                            $campos = $datos_proveedor->fetch();
                        ?>
                            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/proveedorAjax.php" method="POST" data-form="update">
                                <input type="hidden" name="proveedor_id_up" value="<?php echo $pagina[1]; ?>">
                                <h5 class=" mt-0">Información Proveedor</h5>
                                </i>
                                <div class="mb-3">
                                    <label class="form-label">RUC</label>
                                    <input type="text" pattern="[0-9-]{11,20}" maxlength="11" class="form-control" name="proveedor_ruc_up" placeholder="Ruc" autocomplete="off" value="<?php echo $campos["Proveedor_RUC"]; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" ">Razon Social</label>
                                                        <input type=" text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,100}" maxlength="100" class="form-control" name="proveedor_razon_social_up" placeholder="Razon Social" autocomplete="off" value="<?php echo $campos["Proveedor_RazonSocial"]; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Direccion</label>
                                    <input type="text" pattern="[a-zA-Z0-9áéíóúÁÉÍÓÚñÑ().,#\- ]{1,190}" maxlength="190" class="form-control" name="proveedor_direccion_up" placeholder="Dirección" autocomplete="off" value="<?php echo $campos["Proveedor_Direccion"]; ?>">

                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nombre del Contacto</label>
                                    <input type="text" pattern="[a-zA-ZáéíóúÁÉÍÓÚñÑ ]{4,100}" maxlength="190" class="form-control" name="proveedor_contacto_up" placeholder="Contacto" autocomplete="off" value="<?php echo $campos["Proveedor_Contacto"]; ?>">
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Teléfono</label>
                                    <input type="text" pattern="[0-9()\+]{8,20}" maxlength="20" class="form-control" name="proveedor_telefono_up" placeholder="Teléfono" autocomplete="off" value="<?php echo $campos["Proveedor_Telefono"]; ?>">

                                </div>

                                <!-- SELECCIONAR NIVEL DE PRIVILEGIOS DEL SISTEMA -->

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
</div>