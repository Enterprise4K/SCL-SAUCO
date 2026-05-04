<?php
require_once "./models/mainModel.php";

class ordenCompraModelo extends mainModel
{

    protected static function datos_ordenCompra_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM ordenCompra");
        $sql->execute();

        return $sql;
    }
    // modelo para agregar orden de compra 

    protected static function agregar_ordenCompra_modelo($datos)
    {

        $sql = mainModel::conectar()->prepare("INSERT INTO  ordenCompra (Compra_Codigo,Compra_Serie, Compra_Correlativo, Compra_FechaEmision, Compra_year, Compra_mes, Compra_Semana, Compra_CondicionPago, Compra_FechaVencimiento, Compra_FechaCompra, Compra_Estado, Proveedor_ID, Compra_Descripcion, Compra_TipoCosto, Compra_Inafecto, Compra_Subtotal, Compra_Igv, Compra_Total, Compra_Percepcion, Compra_Detraccion, Compra_OrdenPdf, Compra_BancoPdf, Compra_factura,Compra_Guia ) VALUES ( :codigo, :serie, : correlativo, :fechaEmision, :Yearr, :mes, :semana, :condicionPago, :fechaVencimiento, :fechaCompra, :estado, :proveedorId , :descripcion, :tipoCosto, :inafecto, :subtotal, :igv, :total, :percepcion, :detraccion, :ordenpdf, :bancopdf, :factura, :guia)");

        $sql->bindParam(":codigo", $datos['codigo']);
        $sql->bindParam(":serie", $datos['serie']);
        $sql->bindParam(":correlativo", $datos['correlativo']);
        $sql->bindParam(":fechaEmision", $datos['fechaEmision']);
        $sql->bindParam(":Yearr", $datos['Yearr']);
        $sql->bindParam(":mes", $datos['mes']);
        $sql->bindParam(":semana", $datos['semana']);
        $sql->bindParam(":condicionPago", $datos['condicionPago']);
        $sql->bindParam(":fechaVencimiento", $datos['fechaVencimiento']);
        $sql->bindParam(":fechaCompra", $datos['fechaCompra']);
        $sql->bindParam(":estado", $datos['estado']);
        $sql->bindParam(":proveedorId", $datos['proveedorId']);
        $sql->bindParam(":descripcion", $datos['descripcion']);
        $sql->bindParam(":tipoCosto", $datos['tipoCosto']);
        $sql->bindParam(":inafecto", $datos['Inafecto']);
        $sql->bindParam(":subtotal", $datos['subtotal']);
        $sql->bindParam(":igv", $datos['igv']);
        $sql->bindParam(":total", $datos['total']);
        $sql->bindParam(":percepcion", $datos['percepcion']);
        $sql->bindParam(":detraccion", $datos['detraccion']);
        $sql->bindParam(":ordenpdf", $datos['ordenpdf']);
        $sql->bindParam(":bancopdf", $datos['bancopdf']);
        $sql->bindParam(":factura", $datos['factura']);
        $sql->bindParam(":guia", $datos['guia']);
        $sql->execute();

        return $sql;
    }
}
