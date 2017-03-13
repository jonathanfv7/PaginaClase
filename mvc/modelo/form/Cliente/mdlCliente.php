<?php
class mdlCliente extends Singleton {
    const PAGE = 'Cliente';
    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE) return;
        if(!isset($_SESSION["sesion"])){
            redirectTo("index.php?pagina=Login");
        }
        $_SESSION[self::PAGE]["compras"]=Billetes::ConsultaCompras($_SESSION["Login"]["dni"]);
    }
    public function onCargarVista($path) {
        if (getGet('pagina') != self::PAGE) return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo ClienteParser::loadContent($vista);
    }
}