<?php
require_once "../include.php";

$dni = $_POST["dni"];


$database = Conexion::getInstance();
$database->openConnection(unserialize(MYSQL_CONFIG));
$param=[
    ":dni"=>$dni,
];
$sql="select * from clientes where dni=:dni";
$pdo=$database->getPdo();
$query = $pdo->prepare($sql);
$query->execute($param);
$datos = $query ? $query->rowCount(): false;
$database->closeConnection();
if($datos==1){
    $cliente=true;
}else{
    $cliente=false;
}


$objeto_json = new stdClass();
$objeto_json->ExisteDNI=$cliente;

echo json_encode($objeto_json);
