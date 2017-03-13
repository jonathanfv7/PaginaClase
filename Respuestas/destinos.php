<?php
require_once "../include.php";

$response=$_POST["datos"];
$doc= new DOMDocument();
$doc->loadXML($response);

$origen_nodo = $doc->getElementsByTagName("origen");
$origen = $origen_nodo->item(0)->nodeValue;
$destino_nodo = $doc->getElementsByTagName("destino");
$destino = $destino_nodo->item(0)->nodeValue;



$database = Conexion::getInstance();
$database->openConnection(unserialize(MYSQL_CONFIG));
$sql="select distinct idOrigen from trenes, estaciones where nombre = '".$origen."' and idOrigen = idEstacion";
$pdo=$database->getPdo();
$query = $pdo->query($sql);
$resultado = $query ? $query->fetchAll() : false;


$id_Origen=$resultado[0]["idOrigen"];


$sql2="SELECT distinct nombre FROM estaciones, trenes where idEstacion = idDestino and idOrigen = '".$id_Origen."' and nombre like '".$destino."%'";
$query2 = $pdo->query($sql2);
$resultado2 = $query2 ? $query2->fetchAll() : false;
$database->closeConnection();

$xml="";
header('Content-Type: text/xml');
$xml .= "<destinos>";
    foreach ($resultado2 as $dato) {
        $xml .="<destino>" . $dato["nombre"] . "</destino>";
         }
$xml .="</destinos>";
echo $xml;

