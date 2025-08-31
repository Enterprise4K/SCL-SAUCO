<!-- Start Content-->
<div class="container-fluid">

    <!-- titulo -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <div class="page-title-right">
                    <form class="d-flex">
                        <div class="input-group">
                            <input type="text" class="form-control form-control-light" id="dash-daterange">
                            <span class="input-group-text bg-primary border-primary text-white">
                                <i class="mdi mdi-calendar-range font-13"></i>
                            </span>
                        </div>
                        <a href="javascript: void(0);" class="btn btn-primary ms-2">
                            <i class="mdi mdi-autorenew"></i>
                        </a>
                        <a href="javascript: void(0);" class="btn btn-primary ms-1">
                            <i class="mdi mdi-filter-variant"></i>
                        </a>
                    </form>
                </div>
                <h4 class="page-title">Dashboard</h4>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card widget-inline">
                <div class="card-body p-0">
                    <div class="row g-0">
                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0">
                                <div class="card-body text-center">
                                    <a href="<?php echo SERVERURL; ?>oc-year/"><i class="dripicons-article text-muted" style="font-size: 24px;"></i></a>
                                    <h3><span>29</span></h3>
                                    <p class="font-18 mb-0">Ordenes de Compra</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-6 col-lg-3">
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <a href="<?php echo SERVERURL; ?>os-year/"><i class="dripicons-article text-muted" style="font-size: 24px;"></i></a>
                                    <h3><span>715</span></h3>
                                    <p class="font-18 mb-0">Ordenes de Servicio</p>
                                </div>
                            </div>
                        </div>
                        <?php

                        if ($_SESSION['privilegio_scl'] == 1) {
                            require_once "./controller/usuarioControlador.php";

                            $inst_usuario = new usuarioControlador();

                            $total_usuarios = $inst_usuario->datos_usuario_controlador("Conteo", 0);

                        ?>
                            <div class="col-sm-6 col-lg-3">
                                <div class="card shadow-none m-0 border-start">
                                    <div class="card-body text-center">
                                        <a href="<?php echo SERVERURL; ?>usuarios/"><i class="dripicons-user-group text-muted" style="font-size: 24px;"></i></a>
                                        <h3><span><?php echo $total_usuarios->rowCount(); ?></span></h3>
                                        <p class="font-18 mb-0">Usuarios</p>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                        <!-- future synthwave -->
                        <div class="col-sm-6 col-lg-3">
                            <?php
                            require_once "./controller/proveedorControlador.php";
                            $inst_Proveedor = new proveedorControlador();

                            $total_proveedores = $inst_Proveedor->datos_proveedor_controlador("Conteo", 0);

                            ?>
                            <div class="card shadow-none m-0 border-start">
                                <div class="card-body text-center">
                                    <a href="<?php echo SERVERURL; ?>proveedor/"><i class="dripicons-user-id text-muted" style="font-size: 24px;"></i></a>
                                    <h3><?php echo $total_proveedores->rowCount(); ?></h3>
                                    <p class="text-muted font-15 mb-0">Proveedores</p>
                                </div>
                            </div>
                        </div>

                    </div> <!-- end row -->
                </div>
            </div> <!-- end card-box-->
        </div> <!-- end col-->
    </div>

    <div class="row">
        <div style="text-align:center;padding:1em 0;">
            <h3><a style="text-decoration:none;" href="https://www.zeitverschiebung.net/es/timezone/america--lima"><span style="color:gray;">Hora actual en</span><br />Perú/Trujillo</a></h3> <iframe src="https://www.zeitverschiebung.net/clock-widget-iframe-v2?language=es&size=medium&timezone=America%2FLima" width="100%" height="115" frameborder="0" seamless></iframe>
        </div>

    </div>
    <!-- end row-->
</div>
<!-- content -->