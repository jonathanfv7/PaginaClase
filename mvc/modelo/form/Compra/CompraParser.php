<?php
class CompraParser {
    public static function loadContent($vista) {
        $vista = self::_pasoSiguiente($vista);
        return $vista;
    }
    private static function _pasoSiguiente($vista) {
        foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
            $str = '';
            switch ($tag) {
                case 'dni':
                    $str = $_SESSION["Login"]["dni"];
                    break;
                case 'nombre':
                    $str = $_SESSION["Login"]["nombre"];
                    break;
                case 'apellidos':
                    $str = $_SESSION["Login"]["apellido1"]." ".$_SESSION["Login"]["apellido2"];
                    break;
                case 'email':
                    $str = $_SESSION["Login"]["email"];
                    break;
                case 'telefono':
                    $str = $_SESSION["Login"]["telefono"];
                    break;
                case 'idtren':
                    $str = $_SESSION["Compra"]["idTren"];
                    $_SESSION["Compra"]["idTren"]=null;
                    break;
                case 'origen':
                    $str = $_SESSION["Resultados"]["Origen"];
                    break;
                case 'destino':
                    $str = $_SESSION["Resultados"]["Destino"];
                    break;
                case 'importe':
                    $str = $_SESSION["Compra"]["Tren"][0]["precio"];
                    break;
                case 'codigo':
                    $str = $_SESSION["Compra"]["codigo"];
                    break;
                case 'localizador':
                    $str = $_SESSION["Compra"]["localizador"];
                    break;
            }

            $vista = str_replace('{{' . $tag . '}}', $str, $vista);

        }

        return $vista;
    }
}