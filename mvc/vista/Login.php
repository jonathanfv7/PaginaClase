<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
</head>
<link rel="stylesheet" href="css/master.css">
<link rel="stylesheet" href="css/rejilla.css">
<body>
    <header></header>
    {{errores}}
    <section class="centrar_horizontal">
        <h2>Registro</h2>
    <form class="col-12, col-m-12" method="post" action="index.php?pagina=Login" oninput="comprobar_rellenos()" onsubmit="return validar()">
        <input class="col-12, col-m-12" placeholder="Nombre" type="text" name="nombre" required pattern="^[A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+[A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]{1,44}$">
        <input class="col-12, col-m-6" placeholder="Primer apellido" type="text" name="apellido1" required pattern="^[A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+[A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]{1,44}$">
        <input class="col-12, col-m-6" placeholder="Segundo apellido" type="text" name="apellido2" required pattern="^[A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ]+[A-Za-zÀÁÂÃÄÅÇÈÉÊËÌÍÎÏÒÓÔÕÖÙÚÛÜÝàáâãäåçèéêëìíîïðòóôõöùúûüýÿ ]{1,44}$">
        <input class="col-12, col-m-6" placeholder="Correo electrínico" type="email" name="email" required>
        <input class="col-12, col-m-6" placeholder="Teléfono" type="tel" name="telefono" required pattern="^[0-9]{9}$">
        <input class="col-12, col-m-4" id="dni" placeholder="DNI" type="text" name="dni" required pattern="^[0-9]{8}[A-Za-z]$" onblur="validaDNI()">
        <input class="col-12, col-m-4" placeholder="Contraseña" type="password" name="pass" required pattern="^[\D\d]{6,12}$">
        <input class="col-12, col-m-4" placeholder="Repetir contraseña" type="password" name="passr" required pattern="^[\D\d]{6,12}$" onblur="validaPass()">
        <input class="col-12, col-m-12, boton" id="btn_registro" type="submit" value="Registro" name="Registro" disabled>
    </form>
        <h2>Iniciar sesión</h2>
    <form class="col-12, col-m-6" method="post" action="index.php?pagina=Login">
        <input class="col-12, col-m-12" placeholder="DNI" type="text" name="dni" required pattern="^[0-9]{8}[A-Za-z]$">
        <input class="col-12, col-m-12" placeholder="Contraseña" type="password" name="pass" required pattern="^[\D\d]{6,12}$">
        <input class="col-12, col-m-12, boton" type="submit" value="Iniciar sesión" name="Login">

    </form>
    </section>
    <script src="js/Registro.js"></script>
</body>
</html>
<?php
/*$barcode = new \Picqer\Barcode\BarcodeGeneratorPNG();
echo '<img class="col-12, col-m-6" src="data:image/png;base64,' . base64_encode($barcode->getBarcode('MAD-VAR-1-Jonathan', $barcode::TYPE_CODE_39)) . '">';*/