<?php
class InicioParser {
    public static function loadContent($vista) {
        $vista = self::_pasoSiguiente($vista);
        return $vista;
    }
    private static function _pasoSiguiente($vista) {
        foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
            $str = '';
            switch ($tag) {
                case 'mensaje':
// Si existe $_SESSION['edicion'] es que el ID introducido a través del formulario existeif (isset($_SESSION['edicion']))

                    break;
            }

            $vista = str_replace('{{' . $tag . '}}', $str, $vista);

        }
        return $vista;
    }
}