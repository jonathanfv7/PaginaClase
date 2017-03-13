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

    <div>
        <p>DNI: {{dni}}</p>
        <p>Nombre: {{nombre}}</p>
        <p>Apellidos: {{apellidos}}</p>
        <p>Correo electronico: {{email}}</p>
        <p>Telefono: {{telefono}}</p>

    <h3>Su billete ha sido comprado correctamente</h3>

    <h2>Datos de la compra</h2>

        <p>Numero de tren: {{idtren}}</p>
        <p>Origen: {{origen}}</p>
        <p>Destino: {{destino}}</p>
        <p>Importe: {{importe}}</p>

        <h4>Localizador: {{localizador}}</h4>
        <div>{{codigo}}<div>
                <p>Con este Localizador puede validar directamente su viaje u obtener el billete detallado en las maquinas situadas en las estaciones</p>
            <a href="index.php?pagina=Cliente">Todos los billetes comprados</a>
                <button onclick="window.print()">Imprimir</button>
    </div>
</body>
</html>
<?php