<?php
    // obtenemos el objeto de vistas modelos
    require_once "./models/viewsModels.php";


    class viewsControllers extends viewsModels
    {
        
        /* ------   Controlado obtener plantilla ----*/
        public function obtener_plantilla_controlador()
        {
            return require_once "./views/plantilla.php";
        }
        
        /* ------   Controlado obtener vistas ----*/
        public function obtener_vistas_controlador()
        {
            if (isset($_GET['views'])) 
            {
                $ruta=explode("/",$_GET['views']);
                $repuesta=viewsModels::obtener_vistas_modelo($ruta[0]);
            } else 
            {
                $repuesta="login";
            }
            return $repuesta;
        }
    }