<?php
class ResultadosParser {
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
                    for ($i=0;$i<count($_SESSION["Resultados"]["Resultado"]);$i++) {
                        $str .= '<article class="lista_trenes">
                    <div class="resultado_lista_trenes">
                        {{idTren'.$i.'}}
                        {{origen'.$i.'}}
                        {{destino'.$i.'}}
                        {{precio'.$i.'}} €
                        <a href="index.php?pagina=Compra&idTren={{idTren'.$i.'}}">COMPRAR - {{precio'.$i.'}} €</a>
                    </div>
                </article>';
                    }
                    break;
            }


            $vista = str_replace('{{' . $tag . '}}', $str, $vista);

        }

        foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
            $str = '';
            $i=0;
            foreach($_SESSION["Resultados"]["Resultado"] as $dato) {
                switch ($tag) {
                    case 'idTren'.$i.'':
                        $str = "Número tren: ".$dato["idTren"];
                        break;
                    case 'origen'.$i.'':
                        $str = "Origen: ".$_GET["o"];
                        break;
                    case 'destino'.$i.'':
                        $str = "Destino: ".$_GET["d"];
                        break;
                    case 'precio'.$i.'':
                        $str = "Precio ".$dato["precio"];
                        break;
                }
                $i++;
            }

            $vista = str_replace('{{' . $tag . '}}', $str, $vista);

        }
        return $vista;
    }
}