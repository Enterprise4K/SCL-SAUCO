<?php

if ($peticionAjax) {
    require_once "../config/SERVER.php";
} else {
    require_once "./config/SERVER.php";
}
class mainModel
{
    // función conectar base de datos
    protected static function conectar()
    {
        $conexion = new PDO(SGBD, USER, PASS);
        $conexion->exec("SET CHARACTER SET utf8");
        return $conexion;
    }

    // Funcion ejecutar consultas simples
    protected static function ejecutar_consulta_simple($consulta)
    {
        $sql = self::conectar()->prepare($consulta);
        $sql->execute();
        return $sql;
    }
    // funcion para encriptar cadenas 
    public function encryption($string)
    {
        $output = FALSE;
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_encrypt($string, METHOD, $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    // funcion para descriptor cadenas 
    protected function decryption($string)
    {
        $key = hash('sha256', SECRET_KEY);
        $iv = substr(hash('sha256', SECRET_IV), 0, 16);
        $output = openssl_decrypt(base64_decode($string), METHOD, $key, 0, $iv);
        return $output;
    }

    // función para generar códigos aleatorios
    protected static function generar_codigo_aleatorios($letra, $longitud, $numero)
    {
        for ($i = 0; $i <= $longitud; $i++) {
            $aleatorio = rand(0.9);
            $letra -= $aleatorio;
        }
        return $letra . "-" . $numero;
    }

    // funcion para limpiar cadenas

    protected static function limpiar_cadena($cadena)
    {
        $cadena = trim($cadena);
        $cadena = stripcslashes($cadena);
        $cadena = str_ireplace("<script>", "", $cadena);
        $cadena = str_ireplace("</script>", "", $cadena);
        $cadena = str_ireplace("<script src>", "", $cadena);
        $cadena = str_ireplace("<script type=>", "", $cadena);
        $cadena = str_ireplace("SELECT * FROM", "", $cadena);
        $cadena = str_ireplace("DELETE * FROM", "", $cadena);
        $cadena = str_ireplace("INSERT INTO", "", $cadena);
        $cadena = str_ireplace("DROP TABLE", "", $cadena);
        $cadena = str_ireplace("DROP DATABASE", "", $cadena);
        $cadena = str_ireplace("TRUNCATE TABLE", "", $cadena);
        $cadena = str_ireplace("SHOW TABLES", "", $cadena);
        $cadena = str_ireplace("SHOW DATABASES", "", $cadena);
        $cadena = str_ireplace("<?php", "", $cadena);
        $cadena = str_ireplace("?>", "", $cadena);
        $cadena = str_ireplace("--", "", $cadena);
        $cadena = str_ireplace("<", "", $cadena);
        $cadena = str_ireplace(">", "", $cadena);
        $cadena = str_ireplace("[", "", $cadena);
        $cadena = str_ireplace("]", "", $cadena);
        $cadena = str_ireplace("^", "", $cadena);
        $cadena = str_ireplace("==", "", $cadena);
        $cadena = str_ireplace(";", "", $cadena);
        $cadena = str_ireplace("::", "", $cadena);
        $cadena = trim($cadena);
        $cadena = stripcslashes($cadena);
        return $cadena;
    }

    // función verificar datos
    protected static function verificar_datos($filtro, $cadena)
    {
        if (preg_match("/^" . $filtro . "$/", $cadena)) {
            return false;
        } else {
            return true;
        }
    }

    // función verificar fechas 
    protected static function verificar_fechas($fecha)
    {
        $valores = explode('-', $fecha);

        if (count($valores) == 3 && checkdate($valores[1], $valores[2], $valores[0])) {
            return false;
        } else {
            return true;
        }
    }

    // función de paginador de tablas
    protected static function paginador_tablas($pagina, $Npaginas, $url, $botones)
    {
        //diseñamos la paginacion reutilizando con esta funcion en las tablas que se desea agregar
        $tabla = '<ul class="pagination pagination-rounded mb-0 justify-content-center">
                    <li class="page-item">';

        //boton de anterior e ir a la primera pagina       
        if ($pagina == 1) {
            $tabla .= '<li class="page-item">
                            <a class="page-link"  aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>';
        } else {
            $tabla .= '<li class="page-item">
                            <a class="page-link" href="' . $url . '1/" aria-label="Previous">
                                <span aria-hidden="true">&laquo;</span>
                            </a>
                        </li>
                        <li class="page-item">
                        <a class="page-link" href="' . $url . ($pagina - 1) . '/" aria-label="Previous">
                            Anterior
                        </a>
                        </li>';
        }

        // botones del medio

        $ci = 0;

        for ($i = $pagina; $i <= $Npaginas; $i++) {

            if ($ci >= $botones) {
                break;
            }

            if ($pagina == $i) {
                $tabla .= ' <li class="page-item active"><a class="page-link" href="' . $url . $i . '/">' . $i . '</a></li>';
            } else {
                $tabla .= ' <li class="page-item "><a class="page-link" href="' . $url . $i . '/">' . $i . '</a></li>';
            }
            $ci++;
        }

        // boton de siguiente

        if ($pagina == $Npaginas) {
            $tabla .= '<li class="page-item">
                        <a class="page-link"  aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>';
        } else {
            $tabla .= '<li class="page-item">
                        <a class="page-link" href="' . $url . ($pagina + 1) . '/" aria-label="Previous">
                            Siguiente
                        </a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="' . $url . $Npaginas . '/" aria-label="Previous">
                                <span aria-hidden="true">&raquo;</span>
                            </a>
                        </li>';
        }

        $tabla .= ' </ul></nav>';

        return $tabla;
    }
}
