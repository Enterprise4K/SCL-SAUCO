<!-- Start Content-->
<div class="container-fluid">

<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <h4 class="page-title">Ordenes de Compra - Marzo - Semana 10 </h4>
        </div>
    </div>
</div>
<!-- end page title -->
<!-- Contenido -->

<div class="col_xl_6">
    <div class="card">
        <div class="card-body">
            <h4 class="header-title"><i class="dripicons-calendar"></i> Orden de Compra</h4>
            <p class="text-muted font-14">Ordenes de Compra Registradas.</p>                        
        </div>
    </div>
</div>
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-2">
                    <!-- BUSCADOR Y FILTROS -->
                    <div class="col-xl-8">
                        <form class="row gy-2 gx-2 align-items-center justify-content-xl-start justify-content-between">
                            <div class="col-auto">
                                <label for="inputPassword2" class="visually-hidden">Buscar</label>
                                <input type="search" class="form-control" id="inputPassword2" placeholder="Buscar...">
                            </div>
                            <div class="col-auto">
                                <div class="d-flex align-items-center">
                                    <label for="status-select" class="me-2">Estado</label>
                                    <select class="form-select" id="status-select">
                                        <option selected>Elegir...</option>
                                        <option value="1">Pagado</option>
                                        <option value="2">En Espera de Autorización</option>
                                        <option value="3">Pago fallido</option>
                                        <option value="4">Anulado</option>
                                        <option value="5">Emitido</option>
                                        <option value="6">Completo</option>
                                    </select>
                                </div>
                            </div>
                        </form>                            
                    </div>
                    <!-- AGREGAR NUEVA ORDEN DE COMPRA -->
                    <div class="col-xl-4">
                        <div class="text-xl-end mt-xl-0 mt-2">
                            
                            <button type="button" class="btn btn-primary mb-2 me-2" data-bs-toggle="modal" data-bs-target="#success-header-modal">Resgistrar Orden de Cpmpra</button>
                            <button type="button" class="btn btn-light mb-2">Export</button>
                            <div id="success-header-modal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                    <div class="modal-content">
                                        <div class="modal-header modal-colored-header bg-success">
                                            <h4 class="modal-title" id="success-header-modalLabel">Registrar Orden de Compra</h4>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-hidden="true"></button>
                                        </div>    
                                        <div class="modal-body">
                                            
                                            <!-- FORMULARIO DE REGISTROS DE ORDENES DE COMPRA -->
                                            <form class="ps-3 pe-3" action="#">
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Serie</label>
                                                        <input type="text" class="form-control" name="Compra_Serie" maxlength="4" required>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Correlativo</label>
                                                        <input type="text" class="form-control" name="Compra_Correlativo" maxlength="10" required>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Fecha de Emisión</label>
                                                        <input type="date" class="form-control" name="Compra_FechaEmision" required>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <label class="form-label">Fecha de Vencimiento</label>
                                                        <input type="date" class="form-control" name="Compra_FechaVencimiento" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-select" class="form-label">Proveedores</label>
                                                        <select class="form-select" id="example-select">
                                                            <option value="">Seleccionar...</option>
                                                            <option>Comercial Perulux</option>
                                                            <option>Lumacza</option>
                                                            <option>Mallquis</option>
                                                            <option>Distribuidora Mercurio</option>
                                                            <option>Marpier</option>
                                                        </select>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Descripción</label>
                                                        <textarea class="form-control" name="Compra_Detalle" rows="2" required></textarea>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label for="example-select" class="form-label">Tipo de Cssto</label>
                                                        <select class="form-select" id="example-select">
                                                            <option value="">Seleccionar...</option>
                                                            <option>Costo Variable - CV</option>
                                                            <option>Costo Fijo - CF</option>
                                                            <option>Gasto Administrativo</option>
                                                            <option>Refacturable</option>
                                                        </select>
                                                    </div>                                                                        
                                                    <div class="col-md-3 mb-3">
                                                        <input type="checkbox" class="form-check-input" id="customCheckcolor1" checked>
                                                        <label class="form-check-label" for="customCheckcolor1">Inafecto</label>
                                                    </div>
                                                    <br><label class="form-label"></label>
                                                    <!-- Calculo de precio total de la orden de compra -->
                                                    <div class="col-md-4 mb-4">
                                                        <label class="form-label">Subtotal</label>
                                                        <input type="number" step="0.01" class="form-control" name="Compra_Subtotal" required>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <label class="form-label">IGV</label>
                                                        <input type="number" step="0.01" class="form-control" name="Compra_Total" required>
                                                    </div>
                                                    <div class="col-md-4 mb-4">
                                                        <label class="form-label">Total</label>
                                                        <input type="number" step="0.01" class="form-control" name="Compra_Total" required>
                                                    </div>
                                                    <!-- seleccionar si la orden de compra existe percepción  o detracción -->
                                                    <div class="col-md-5 mb-3">
                                                        <label class="form-label">Percepción</label>
                                                        <input type="number" step="0.01" class="form-control" name="Compra_Percepcion" required>
                                                    </div>
                                                    <div class="col-md-5 mb-3">
                                                        <label class="form-label">Detracción</label>
                                                        <input type="number" step="0.01" class="form-control" name="Compra_Detraccion" required>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label">Estado</label>
                                                        <select class="form-select" name="Compra_Estado" required>
                                                            <option value="">Selecciona...</option>
                                                            <option value="1">Pagado</option>
                                                            <option value="0">Pendiente</option>
                                                            <option value="">Anulado</option>
                                                        </select>
                                                    </div>
                                                    <!-- ORDEN DE COMPRA  -->
                                                    <div class="mb-3">
                                                        <Label class="form-label">Subir Orden de compra (Archivo PDF).</Label>
                                                        <!-- subir archivo pdf  -->
                                                        <div class="input-group mb-3">
                                                            <input type="file" class="form-control" id="inputGroupFile01">
                                                        </div>
                                                        <!-- fin subir archivo pdf -->
                                                    </div>
                                                    <!-- FIN BANCOS -->
                                                    <!-- BANCOS  -->
                                                    <div class="mb-3">
                                                        <Label class="form-label">Subir Documento de Pago (Archivo PDF).</Label>
                                                        <!-- subir archivo pdf  -->
                                                        <div class="input-group mb-3">
                                                            <input type="file" class="form-control" id="inputGroupFile01">
                                                        </div>
                                                        <!-- fin subir archivo pdf -->
                                                    </div>
                                                    <!-- FIN BANCOS -->

                                                    <!-- BORDEN DE COMPRA PDF  -->
                                                    <div class="mb-3">
                                                        <Label class="form-label">Subir Factura (Archivo PDF).</Label>
                                                        <!-- subir archivo pdf  -->
                                                        <div class="input-group mb-3">
                                                            <input type="file" class="form-control" id="inputGroupFile01">
                                                        </div>
                                                        <!-- fin subir archivo pdf -->
                                                    </div>
                                                    <!-- FIN ORDEN DE COMPRA  -->

                                                    <!-- FACTURA   -->
                                                    <div class="mb-3">
                                                        <Label class="form-label">Subir Guía de Remisión (Archivo PDF).</Label>
                                                        <!-- subir archivo pdf  -->
                                                        <div class="input-group mb-3">
                                                            <input type="file" class="form-control" id="inputGroupFile01">
                                                        </div>
                                                        <!-- fin subir archivo pdf -->
                                                    </div>
                                                    <!-- FIN BANCOS -->
                                                    <button type="submit" class="btn btn-primary">Registrar Compra</button> 
                                                </div>
                                                <!-- REGISTROS DE ORDENES DE COMPRA  -->- 
                                            </form>
                                            <!-- Formulario de registro de ordenes de compra -->
                                        </div>
                                    </div><!-- /.modal-content -->
                                </div><!-- /.modal-dialog -->
                            </div><!-- /.modal -->
                           
                        </div>
                        
                    </div><!-- end col-->
                </div>
                
                <div class="table-responsive">
                    <table class="table table-centered table-nowrap mb-0">
                        <thead class="table-light">
                            <tr>
                                <th>Serie</th>
                                <th>Correlativo</th>
                                <th>Proveedor</th>
                                <th>Estado</th>
                                <th>Fecha de Emisión</th>
                                <th>Fecha de Vencimiento</th>
                                <th>Sub Total</th>
                                <th>Igv</th>
                                <th>Total</th>
                                <th style="width: 125px;">Accion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <!-- cuerpo de la tabla de ordenes de compra -->
                            <tr>
                                <td>001</td>
                                <td><a href="<?php echo SERVERURL; ?>oc-detalle/" class="text-body fw-bold">2475</a></td>
                                <td>Distribuidora Mercurio</td>
                                <td>
                                    <h4><span class="badge badge-success-lighten"><i class="mdi mdi-bitcoin"></i> Pagado</span></h4>
                                </td>
                                <td>12/03/2025</td>
                                <td>12/04/2025</td>                                                        
                                <td>1200.00</td>
                                <td>216.00</td>
                                <td>1416.00</td>
                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <tr>
                                <td>001</td>
                                <td><a href="ordenCompraDetalle.html" class="text-body fw-bold">2476</a></td>
                                <td>Comercial Perulux</td>
                                <td>
                                    <h4><span class="badge badge-success-lighten"><i class="mdi mdi-bitcoin"></i> Pagado</span></h4>
                                </td>
                                <td>12/03/2025</td>
                                <td>12/04/2025</td>                                                        
                                <td>1200.00</td>
                                <td>216.00</td>
                                <td>1416.00</td>
                                <td>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-square-edit-outline"></i></a>
                                    <a href="javascript:void(0);" class="action-icon"> <i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                            <!-- fin tabla de orden compra -->  
                        </tbody>
                    </table>
                </div>
                <nav>
                <ul class="pagination pagination-rounded mb-0 justify-content-center">
                    <li class="page-item">
                        <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                    <li class="page-item active"><a class="page-link" href="javascript: void(0);">3</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="javascript: void(0);" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                </ul>
            </nav>
            </div> <!-- end card-body-->
        </div> <!-- end card-->
    </div> <!-- end col -->
</div>

<!-- Contenido -->
</div>
<!-- container -->
