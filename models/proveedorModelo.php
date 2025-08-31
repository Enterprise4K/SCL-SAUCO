<?php

require_once "mainModel.php";

class proveedorModelo extends mainModel
{

    // modelo para agregar proveedor
    protected static function agregar_proveedor_modelo($datos)
    {

        // ejecutar consulta
        $sql = mainModel::conectar()->prepare("INSERT INTO proveedor(Proveedor_RUC,Proveedor_RazonSocial,Proveedor_Direccion,Proveedor_Contacto,Proveedor_Telefono) VALUES(:Ruc, :RazonSocial,:Direccion , :Contacto , :Telefono)");
        $sql->bindParam(":Ruc", $datos['Ruc']);
        $sql->bindParam(":RazonSocial", $datos['RazonSocial']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->bindParam(":Contacto", $datos['Contacto']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->execute();

        return $sql;
    } // fin de modelo agregar proveedor

    // modelo para eliminar proveedor
    protected static function eliminar_proveedor_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM proveedor WHERE Proveedor_ID=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    } //fin de modelo eliminar proveedor 

    // Modelo para selecionar datos del proveedor
    protected static function datos_proveedor_modelo($tipo, $id)
    {
        if ($tipo == "Unico") {
            $sql = mainModel::conectar()->prepare("SELECT * FROM proveedor WHERE Proveedor_ID=:ID");
            $sql->bindParam(":ID", $id);
        } else if ($tipo == "Conteo") {
            $sql = mainModel::conectar()->prepare("SELECT Proveedor_ID FROM proveedor");
        }
        $sql->execute();
        return $sql;
    }
}
