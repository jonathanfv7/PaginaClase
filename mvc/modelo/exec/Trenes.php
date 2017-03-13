<?php

class Trenes{
public static function buscarTrenes($origen,$destino){
    $database = Conexion::getInstance();
    $database->openConnection(unserialize(MYSQL_CONFIG));
    $sql="select * from trenes where idOrigen = '".substr($origen,0,3)."' and idDestino ='".substr($destino,0,3)."'";
    $pdo=$database->getPdo();
    $query = $pdo->query($sql);
    $resultado = $query ? $query->fetchAll() : false;
    return $resultado;
    }

    public static function ConsultaId($id){
        $database = Conexion::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $param=[
            ":idTren"=>$id,
        ];
        $sql="select * from trenes where idTren=:idTren";
        $pdo=$database->getPdo();
        $query = $pdo->prepare($sql);
        $query->execute($param);
        $datos = $query ? $query->fetchAll(PDO::FETCH_ASSOC) : false;
        $database->closeConnection();
        return $datos;
    }
}