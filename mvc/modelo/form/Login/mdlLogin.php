<?php
class mdlLogin extends Singleton {
    const PAGE = 'Login';
    public function onGestionPagina() {
        if (getGet('pagina') != self::PAGE) return;
        if(isset($_SESSION["sesion"])){
            if(getGet("o")=="cerrar"){
                Session::closeSession();
                redirectTo("index.php?pagina=Inicio");
            }
            redirectTo("index.php?pagina=Cliente");
        }
        if(getPost('Registro')){
            $val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
            $toValidate = ($_POST);
            $rules = array(
                'nombre' => 'required|alpha_space',
                'apellido1' => 'required|alpha_space',
                'apellido2' => 'required|alpha_space',
                'email' => 'required|correo',
                'telefono' => 'required|numerico',
                'dni' => 'required|alphanum_space',
                'pass' => 'required',
            );
            $val->addRules($rules);
            $val->run($toValidate);
            if (!is_null(getPost("Registro"))) {
                if ($val->isValid()) {
// Guardamos los datos en session
                    $_SESSION[self::PAGE] = $val->getOks();
                    $_SESSION[self::PAGE]["pass"]=encodePassword($_SESSION[self::PAGE]["pass"]);
                    $respuesta = Clientes::crear();
                    if ($respuesta){
                        $_SESSION["sesion"]=true;
                        $datos=Clientes::retornarDatos($_POST["dni"]);
                        $_SESSION[self::PAGE]=$datos[0];
                        redirectTo("index.php?pagina=Compra");
                    }else{
                        echo "ERROR";
                    }
                }}


            }elseif(getPost('Login')) {
            $val = Validacion::getInstance();
// Validamos los elementos que hay en $_POST
            $toValidate = ($_POST);
            $rules = array(
                'dni' => 'required',
                'pass' => 'required',
            );
            $val->addRules($rules);
            $val->run($toValidate);
            if (!is_null(getPost("Login"))) {
                if ($val->isValid()) {
                    $datos=Clientes::retornarDatos($_POST["dni"]);
                    if(password_verify($_POST["pass"],$datos[0]["pass"])){
                        $_SESSION["sesion"]=true;
                        $_SESSION[self::PAGE]=$datos[0];
                        redirectTo("index.php?pagina=Compra");
                    }else{

                    }
                }
            }
        }

    }
    public function onCargarVista($path) {
        if (getGet('pagina') != self::PAGE) return;
        ob_start();
        include $path;
        $vista = ob_get_contents();
        ob_end_clean();
        echo LoginParser::loadContent($vista);
    }
}