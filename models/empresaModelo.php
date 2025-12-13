<?php

require_once "mainModel.php";

class empresaModelo extends mainModel
{

    // Modelo datos de la empresa
    protected static function datos_empresa_modelo()
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM empresa");
        $sql->execute();
        return $sql;
    }

    // modelo para agregar empresa
    protected static function agregar_empresa_modelo($datos)
    {
        // ejecutar consulta para agregar

        $sql = mainModel::conectar()->prepare("INSERT INTO empresa (empresa_nombre, empresa_email, empresa_telefono, empresa_direccion)VALUES(:nombre , :email , :telefono , :direccion)");

        $sql->bindParam(":nombre", $datos['nombre']);
        $sql->bindParam(":email", $datos['email']);
        $sql->bindParam(":telefono", $datos['telefono']);
        $sql->bindParam(":direccion", $datos['direccion']);

        $sql->execute();

        return $sql;
    }
}
