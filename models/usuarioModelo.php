<?php

require_once "mainModel.php";

class usuarioModelo extends mainModel
{

    // modelo para agregar usuario

    protected static function agregar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("INSERT INTO cuenta(Cuenta_Dni,Cuenta_Nombre,Cuenta_Apellido,Cuenta_Telefono,Cuenta_Direccion,Cuenta_Email,Cuenta_Usuario,Cuenta_Clave,Cuenta_Estado,Cuenta_Privilegio,Cuenta_Foto) VALUES(:DNI,:Nombre,:Apellido,:Telefono,:Direccion,:Email,:Usuario,:Clave,:Estado,:Privilegio,:Foto)");

        // mediante los marcadores seran seleccionados por el formulario
        $sql->bindParam(":DNI", $datos['DNI']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Apellido", $datos['Apellido']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->bindParam(":Email", $datos['Email']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Privilegio", $datos['Privilegio']);
        $sql->bindParam(":Foto", $datos['Foto']);
        $sql->execute();

        return $sql;
    }

    // modelo para eliminar usuario
    protected static function eliminar_usuario_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM cuenta WHERE Cuenta_Id=:ID");
        $sql->bindParam(":ID", $id);
        $sql->execute();
        return $sql;
    }

    // modelo para seleccionar los datos del usuario

    protected static function datos_usuario_modelo($tipo, $id)
    {

        // tipo de seleccion se deberá mostrar

        if ($tipo == "Unico") {
            $sql = mainModel::conectar()->prepare("SELECT * FROM cuenta WHERE Cuenta_Id = :ID");
            $sql->bindParam(":ID", $id);
        } else if ($tipo == "Conteo") {
            $sql = mainModel::conectar()->prepare("SELECT Cuenta_Id FROM cuenta WHERE Cuenta_Id !='1'");
        }

        $sql->execute();
        return $sql;
    }

    // modelo para actualizar usuario

    protected static function actualizar_usuario_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("UPDATE cuenta SET Cuenta_Dni = :DNI , Cuenta_Nombre = :Nombre , Cuenta_Apellido = :Apellido , Cuenta_Telefono = :Telefono , Cuenta_Direccion = :Direccion , Cuenta_Email = :Email , Cuenta_Usuario = :Usuario , Cuenta_Clave = :Clave , Cuenta_Estado = :Estado , Cuenta_Privilegio = :Privilegio WHERE Cuenta_Id = :ID");

        $sql->bindParam(":DNI", $datos['DNI']);
        $sql->bindParam(":Nombre", $datos['Nombre']);
        $sql->bindParam(":Apellido", $datos['Apellido']);
        $sql->bindParam(":Telefono", $datos['Telefono']);
        $sql->bindParam(":Direccion", $datos['Direccion']);
        $sql->bindParam(":Email", $datos['Email']);
        $sql->bindParam(":Usuario", $datos['Usuario']);
        $sql->bindParam(":Clave", $datos['Clave']);
        $sql->bindParam(":Estado", $datos['Estado']);
        $sql->bindParam(":Privilegio", $datos['Privilegio']);
        $sql->bindParam(":ID", $datos['ID']);
        $sql->execute();

        return $sql;
    }
}
