<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="css/master.css">
    <link rel="stylesheet" href="css/rejilla.css">
</head>
<body>
<header></header>
<?php include_once "menu.php";?>
<nav></nav>
<article class="">
<div class="centrar">
<form action="index.php" method="get">
    <input type="hidden" name="pagina" value="Resultados">
    <input class="mayus" type="search" placeholder="ORIGEN" id="origen" onfocus="Origenes()" oninput="Origenes()" name="o" autocomplete="off">
    <input class="mayus" type="search"  placeholder="DESTINO" id="destino" onfocus="OrigenDestino()" oninput="OrigenDestino()" disabled name="d" autocomplete="off">
    <input class="boton" type="submit" id="buscar" value="Buscar" disabled>

</form>
</div>
    <div class="centrar">
        <div class="prediccion" id="origenes"><ul></ul></div>
        <div class="prediccion" id="destinos"><ul></ul></div>
    </div>
</article>
<script src="js/Inicio.js">

</script>
</body>
</html>
