<?php

if ($peticionAjax) {
    require_once "../models/ordenCompraModelo.php";
} else {
    require_once "./models/ordenCompraModelo.php";
}

class ordenCompraControlador extends ordenCompraModelo
{

    public function agregar_ordenCompra_controlador() {}
}
