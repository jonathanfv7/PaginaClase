<?php
require_once "../include.php";

$origen=$_POST["origen"];


    $database = Conexion::getInstance();
    $database->openConnection(unserialize(MYSQL_CONFIG));
    $sql = "SELECT distinct nombre, idOrigen FROM estaciones, trenes where idEstacion = idOrigen and nombre like '".$origen."%'";
        //"select DISTINCT idOrigen from trenes where  idOrigen like '". $origen."%'";
    $pdo=$database->getPdo();
    $query = $pdo->query($sql);
    $resultado = $query ? $query->fetchAll() : false;
    $database->closeConnection();


$xml="";
header('Content-Type: text/xml');
$xml .= "<origenes>";
    foreach ($resultado as $dato) {
        $xml .="<origen>" . $dato["nombre"] . "</origen>";
         }
$xml .="</origenes>";
echo $xml;

