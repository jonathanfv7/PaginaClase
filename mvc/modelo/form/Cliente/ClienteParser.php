<?php
class ClienteParser {
    public static function loadContent($vista) {
        $vista = self::_pasoSiguiente($vista);
        return $vista;
    }
    private static function _pasoSiguiente($vista) {
        foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
            $generator=new \Picqer\Barcode\BarcodeGeneratorPNG();
            $str = '';
            switch ($tag) {
                case 'resultado':
// Si existe $_SESSION['edicion'] es que el ID introducido a través del formulario existeif (isset($_SESSION['edicion']))
                    if(count($_SESSION["Cliente"]["compras"])==0){
                        $str .= "<h3>Aun no ha comprado ningun billete</h3>";
                    }
                    for ($i=0;$i<count($_SESSION["Cliente"]["compras"]);$i++) {
                        $str .= '<article class="lista_trenes">
                    <div class="resultado_lista_trenes">
                        {{fecha'.$i.'}}
                        {{idTren'.$i.'}}
                        {{origen'.$i.'}}
                        {{destino'.$i.'}}
                        {{precio'.$i.'}} €
                        {{localizador'.$i.'}}
                    </div>
                </article>';
                    }
                    break;
                    break;
            }

            $vista = str_replace('{{' . $tag . '}}', $str, $vista);

        }
        foreach (getTagsVista($vista) as $tag) {
// sustituimos en el formulario los tags por el contenido de los elementos del formulario
            $str = '';
            $i=0;
            foreach($_SESSION["Cliente"]["compras"] as $dato) {
                $tren=Trenes::ConsultaId($dato["idtren"]);
                switch ($tag) {
                    case 'idTren'.$i.'':
                        $str = "Id tren: ".$dato["idtren"];
                        break;
                    case 'fecha'.$i.'':
                        $str = "Fecha / Hora compra: ".$dato["fecha"];
                        break;
                    case 'localizador'.$i.'':
                        $str = '<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($dato["localizador"], $generator::TYPE_CODE_128)) . '">';
                        break;
                    case 'origen'.$i.'':
                        $str = "Origen: ".$tren[0]["idOrigen"];
                        break;
                    case 'destino'.$i.'':
                        $str = "Destino: ".$tren[0]["idDestino"];
                        break;
                    case 'precio'.$i.'':
                        $str = "Importe: ".$tren[0]["precio"];
                        break;
                }
                $i++;
            }

            $vista = str_replace('{{' . $tag . '}}', $str, $vista);

        }
        return $vista;
    }
}