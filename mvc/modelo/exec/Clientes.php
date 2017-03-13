<?php

class Clientes{
    public static function crear(){
        $database = Conexion::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $param=[
            ":dni"=>$_SESSION["Login"]["dni"],
            ":nombre"=>$_SESSION["Login"]["nombre"],
            ":apellido1"=>$_SESSION["Login"]["apellido1"],
            ":apellido2"=>$_SESSION["Login"]["apellido2"],
            ":email"=>$_SESSION["Login"]["email"],
            ":telefono"=>$_SESSION["Login"]["telefono"],
            ":pass"=>$_SESSION["Login"]["pass"],
        ];
        $sql="insert into clientes (dni,nombre,apellido1,apellido2,email,telefono,pass) values (:dni,:nombre,:apellido1,:apellido2,:email,:telefono,:pass)";
        $pdo=$database->getPdo();
        $query = $pdo->prepare($sql);
        $query->execute($param);
        $resultado = $query ? $query->rowCount(): false;
        $database->closeConnection();
        return $resultado;
    }

    public static function retornarDatos($dni){
        $database = Conexion::getInstance();
        $database->openConnection(unserialize(MYSQL_CONFIG));
        $param=[
            ":dni"=>$dni,
        ];
        $sql="select * from clientes where dni=:dni";
        $pdo=$database->getPdo();
        $query = $pdo->prepare($sql);
        $query->execute($param);
        $datos = $query ? $query->fetchAll(PDO::FETCH_ASSOC) : false;
        $database->closeConnection();
        return $datos;


    }
}