<?php

class conexion{
   
    const user='root';
    const pass='lucas123';
    const db='plantas-db';
    const servidor='34.31.142.80';

    public function conectardb(){
        $conectar = new mysqli(self::servidor, self::user,self::pass,self::db);
        if($conectar->connect_errno){
            die("Error en la coneccion".$conectar->connect_error);
        }
        return $conectar;
    }   
}

?>