<?php
if(isset($_SESSION["sesion"])){
    echo "Hola, ".$_SESSION["Login"]["nombre"]." - <a href='index.php?pagina=Cliente'>Ver compras procesadas</a> -
     <a href='index.php?pagina=Login&o=cerrar'>cerrar sesión</a>";
}else{
    echo "<a href='index.php?pagina=Login'>Iniciar sesion</a>";
}