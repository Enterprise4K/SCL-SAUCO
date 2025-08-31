<?php

class viewsModels
{

    /* --------------- Modelo obtener vistas ---------------------*/
    protected static function obtener_vistas_modelo($vista)
    {
        $listaBlanca = ["home", "oc-year", "oc-mes", "oc-semana", "oc-detalle", "oc-list", "usuarios", "usuario-actualizar", "usuario-busqueda", "proveedor", "proveedor-actualizar", "proveedor-busqueda"];
        // ver si la vista obtenida por el controlador esta en la lista blanca para visualizar
        if (in_array($vista, $listaBlanca)) {
            if (is_file("./views/contenidos/" . $vista . "-view.php")) {
                $contenido = "./views/contenidos/" . $vista . "-view.php";
            } else {
                $contenido = "404";
            }
        } elseif ($vista == "login" || $vista == "index") // ver si en la vista obtenida trae el login o el index para mostrar el contenido
        {
            $contenido = "login";
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}
