<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="page-title">Busqueda de Usuarios</h4>
            </div>
        </div>
    </div>

    <?php
    if (!isset($_SESSION['busqueda_proveedor']) && empty($_SESSION['busqueda_proveedor'])) {

    ?>
        <!-- contenedor de formulario para buscar usuario -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <form class="form-neon FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="default" autocomplete="off">
                            <!-- input para enviar el tipo de modulo se envía los datos de búsqueda de usuarios -->
                            <input type="hidden" name="modulo" value="proveedor">
                            <div class="container-fluid">
                                <div class="row justify-content-md-center">
                                    <div class="col-12 col-md-6">
                                        <div class="form-group">
                                            <label for="inputSearch" class="bmd-label-floating">¿Qué usuario estas buscando?</label>
                                            <input type="text" class="form-control" name="busqueda_inicial" id="inputSearch" maxlength="30">
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <p class="text-center" style="margin-top: 40px;">
                                            <button type="submit" class="btn btn-raised btn-info"><i class="uil-search"></i> &nbsp;Buscar</button>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin contenedor para buscar usuario -->
    <?php } else { ?>
        <!-- contenedor para eliminar búsqueda -->
        <div class="container-fluid">
            <form class="FormularioAjax" action="<?php echo SERVERURL; ?>ajax/buscadorAjax.php" method="POST" data-form="search" autocomplete="off">
                <input type="hidden" name="modulo" value="proveedor">
                <input type="hidden" name="eliminar_busqueda" value="eliminar">
                <div class="container-fluid">
                    <div class="row justify-content-md-center">
                        <div class="col-12 col-md-6">
                            <p class="text-center" style="font-size: 20px;">
                                Resultados de la busqueda <strong><?php echo $_SESSION['busqueda_proveedor']; ?></strong>
                            </p>
                        </div>
                        <div class="col-12">
                            <p class="text-center" style="margin-top: 20px;">
                                <button type="submit" class="btn btn-raised btn-danger"><i class=" uil-trash"></i> &nbsp; ELIMINAR BÚSQUEDA</button>
                            </p>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <!-- fin contendedor para mostrar búsqueda -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-body">
                        <?php

                        require_once "./controller/proveedorControlador.php";

                        $inst_proveedor = new proveedorControlador();

                        echo $inst_proveedor->paginador_proveedor_controlador($pagina[1], 15, $_SESSION['privilegio_scl'], $pagina[0], $_SESSION['busqueda_proveedor']);
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- fin contenedor para mostrar búsqueda -->
    <?php } ?>