<?php

class Billetes{
    public static function crear(){
        $database = Conexion::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $param=[
            ":localizador"=>$_SESSION["Compra"]["localizador"],
            ":dni"=>$_SESSION["Login"]["dni"],
            ":idtren"=>$_SESSION["Compra"]["idTren"],
            ":fecha"=>$_SESSION["Compra"]["fecha"],
        ];
        $sql="insert into billetes (localizador,dni,idtren,fecha) values (:localizador,:dni,:idtren,:fecha)";
        $pdo=$database->getPdo();
        $query = $pdo->prepare($sql);
        $query->execute($param);
        $resultado = $query ? $query->rowCount(): false;
        $database->closeConnection();
        return $resultado;
    }
    public static function ConsultaCompras($dni){
        $database = Conexion::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $param=[
            ":dni"=>$dni,
        ];
        $sql="select * from billetes where dni=:dni";
        $pdo=$database->getPdo();
        $query = $pdo->prepare($sql);
        $query->execute($param);
        $datos = $query ? $query->fetchAll(PDO::FETCH_ASSOC) : false;
        $database->closeConnection();
        return $datos;
    }
}