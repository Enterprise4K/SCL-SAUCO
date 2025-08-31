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

            <h4 class="header-title"><i class="dripicons-calendar"></i> Orden de Compra Detalle</h4>
                <p class="text-muted font-14">Ordenes de Compra.</p>                        
        </div>
        
    </div>
</div>
<div class="row">
    <!-- card de visualizar orden de compra -->
    <div class="col-sm-12">
        <div class="card">
            <div class="card-body">
                <!-- Orden de compra visualizador -->
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
                        <button type="submit" class="btn btn-primary">Actualizar Compra</button> 
                    </div>
                    <!-- REGISTROS DE ORDENES DE COMPRA  -->- 
                </form>
                <!-- Fin orden de compra-->
            </div>
        </div>
    </div>
    <!-- card orden de compra fin-->
    <!-- card de visualizar orden de compra 2 pdf-->
    <div class="col-sm-12>
        <div class="card">
            <!-- PDF Orden de Compra -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title"><i class="dripicons-calendar"></i> Orden de Compra Detalle</h4>
                    <a download="OC_2024_Perulux" href="assets/Document/oc/oc.pdf" class="btn btn-success">Descargar <i class="mdi mdi-download ms-1"></i></a>              
                </div>
                <iframe src="https://docs.google.com/gview?embedded=true&url=https://www.mindef.gob.pe/informacion/transparencia/ordenes/OC%200603-2017.pdf" frameborder="0" width="100%" height="600"></iframe>
            </div>

            <!-- PDF Factura emitida -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title"><i class="dripicons-calendar"></i> Factura Detalle</h4>
                    <a download="OC_2024_Perulux" href="assets/Document/oc/oc.pdf" class="btn btn-success">Descargar <i class="mdi mdi-download ms-1"></i></a>              
                </div>
                <iframe src="https://docs.google.com/gview?embedded=true&url=https://www.mindef.gob.pe/informacion/transparencia/ordenes/OC%200603-2017.pdf" frameborder="0" width="100%" height="600"></iframe>
            </div>

            <!-- PDF Guía de Remisión -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title"><i class="dripicons-calendar"></i> Guia de Remision Detalle</h4>
                    <a download="OC_2024_Perulux" href="assets/Document/oc/oc.pdf" class="btn btn-success">Descargar <i class="mdi mdi-download ms-1"></i></a>              
                </div>
                <iframe src="https://docs.google.com/gview?embedded=true&url=https://www.mindef.gob.pe/informacion/transparencia/ordenes/OC%200603-2017.pdf" frameborder="0" width="100%" height="600"></iframe>
            </div>
            <!-- fin pdf guía de remisión -->

            <!-- pdf bancos comprobantes de pago -->
            <div class="card-body">
                <div class="d-flex justify-content-between align-items-center mb-2">
                    <h4 class="header-title"><i class="dripicons-calendar"></i> Bancos Detalle</h4>
                    <!-- boton de descarga -->
                    <a download="OC_2024_Perulux" href="assets/Document/oc/oc.pdf" class="btn btn-success">Descargar <i class="mdi mdi-download ms-1"></i></a>              
                </div>
                <iframe src="https://docs.google.com/gview?embedded=true&url=https://www.mindef.gob.pe/informacion/transparencia/ordenes/OC%200603-2017.pdf" frameborder="0" width="100%" height="600"></iframe>
            </div>
            <!-- fin pdf comprobantes de pago -->
        </div>
    </div>

<!-- Contenido -->
</div>
<!-- container -->
