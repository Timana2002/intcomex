<?php

class conection{
    
    public static function connect(){
        $pdo = new PDO("mysql: host=localhost; dbname=systemstudents","root","");
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $pdo;
    }

}