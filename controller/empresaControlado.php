<?php

if ($peticionAjax) {
    require_once "../models/empresaModelo.php";
} else {
    require_once "./models/empresaModelo.php";
}

class empresaControlador extends empresaModelo
{

    // controlador datos de la empresa
    public function datos_empresa_controlador()
    {
        return empresaModelo::datos_empresa_modelo();
    }
}
