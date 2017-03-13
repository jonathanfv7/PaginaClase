<?php
class mdlInicio extends Singleton {
    const PAGE = 'Inicio';
    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE) return;
        //Prueba de conexion con la bbdd
        $database = Conexion::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $database->closeConnection();
    }
    public function onCargarVista($path) {
        if (getGet('pagina') != self::PAGE) return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo InicioParser::loadContent($vista);
    }
}