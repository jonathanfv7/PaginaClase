<?php
class mdlCompra extends Singleton {
    const PAGE = 'Compra';
    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE) return;
        if(isset($_SESSION["Compra"]["idTren"]) || isset($_GET["idTren"])){

        }else{
            redirectTo("index.php?pagina=Cliente");
        }
        if(!isset($_SESSION[self::PAGE]["idTren"])){
            $_SESSION[self::PAGE]["idTren"]=$_GET["idTren"];
        }else if(isset($_GET["idTren"])){
            if($_SESSION[self::PAGE]["idTren"]!=$_GET["idTren"]){
                $_SESSION[self::PAGE]["idTren"]=$_GET["idTren"];
            }
        }
        if(!isset($_SESSION["sesion"])){
            redirectTo("index.php?pagina=Login");
        }
        $generator=new \Picqer\Barcode\BarcodeGeneratorPNG();
        $_SESSION["Compra"]["fecha"]=date("d-m-Y / H:i:s");
        $_SESSION[self::PAGE]["localizador"]=$_SESSION["Login"]["dni"].$_SESSION["Compra"]["fecha"].$_SESSION["Compra"]["idTren"];

        $_SESSION[self::PAGE]["Tren"]=Trenes::ConsultaId( $_SESSION[self::PAGE]["idTren"]);

        $resultado=Billetes::crear();
        if(!$resultado){
            echo "ERROR";
            return;
        }

        $_SESSION[self::PAGE]["codigo"]='<img src="data:image/png;base64,' . base64_encode($generator->getBarcode($_SESSION[self::PAGE]["localizador"], $generator::TYPE_CODE_128)) . '">';


    }
    public function onCargarVista($path) {
        if (getGet('pagina') != self::PAGE) return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo CompraParser::loadContent($vista);
    }
}