<?php
class mdlResultados extends Singleton {
    const PAGE = 'Resultados';
    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE) return;
        if(!isset($_GET["o"]) || !isset($_GET["d"])){
            redirectTo("index.php?pagina=Inicio");
        }
        $_SESSION[self::PAGE]["Resultado"]=Trenes::buscarTrenes($_GET["o"],$_GET["d"]);
        $_SESSION[self::PAGE]["Origen"]=$_GET["o"];
        $_SESSION[self::PAGE]["Destino"]=$_GET["d"];

    }
    public function onCargarVista($path) {
        if (getGet('pagina') != self::PAGE) return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo ResultadosParser::loadContent($vista);
    }
}