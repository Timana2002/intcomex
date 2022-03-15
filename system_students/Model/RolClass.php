<?php

class Rol{

    public $con;

    public function __construct()
    {
        try {
            $this->con = conection::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function OptionRole()
    {
        try{

            $query = "SELECT * FROM rol";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);

        }
        catch(Exception $e){
            die($e->getMessage());
        }
    }
}