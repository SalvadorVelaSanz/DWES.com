<?php
namespace Ejercicio4\Utils;

use Exception;

class Autocarga {
    private const string DIRECTORIO_BASE = "/Ejercicios_BBDD";

    public static function registro_autocarga(): void {
        try {
            spl_autoload_register( self::class . "::autocarga");
        }
        catch( Exception $e ) {
            echo $e->getMessage();
            exit($e->getCode());
        }
    }

    public static function autocarga(string $clase): void {
        $clase = str_replace("\\", "/", $clase);
        $directorio = $_SERVER['DOCUMENT_ROOT'] . self::DIRECTORIO_BASE;
        $ruta = $directorio . "/$clase.php";
    

        if (file_exists($ruta)) {
            require_once($ruta);
        } else {
            throw new Exception("El archivo con la definición de $clase no existe. Ruta buscada: $ruta", 1);
        }
    }
    
}
?>