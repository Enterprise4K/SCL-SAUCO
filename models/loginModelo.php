<?php

require_once "mainModel.php";

class loginModelo extends mainModel
{
    /* --------------------     modelo para iniciar session -------------------------*/
    protected static function iniciar_sesion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT * FROM cuenta WHERE cuenta_Usuario=:Usuario AND Cuenta_Clave=:Clave AND Cuenta_Estado='Activo'");
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->execute();
        return $sql;
    }
}
