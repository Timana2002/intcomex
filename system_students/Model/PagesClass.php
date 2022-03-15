<?php

class Users{

    public $con;

    public $token_user;
    public $first_name;
    public $second_name;
    public $name_user;
    public $password;
    public $fk_rol;

    public $user;
    public $pass;


    public function __construct()
    {
        try {
            $this->con = conection::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
        
    }

    public function GenerateToken()
    {
        try {
            $gen = md5(uniqid(mt_rand(), false));	
		    return $gen;
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function HashPassword($password)
    {
        try {
            $hash = password_hash($password, PASSWORD_DEFAULT);
		    return $hash;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function InsertUsers(Users $data)
    {
        try {

            $query = "INSERT INTO users (token_user, first_name, second_name, name_user, password, fk_rol) VALUES (?,?,?,?,?,?)";
            $this->con->prepare($query)->execute(array($data->token_user, 
                                                        $data->first_name, 
                                                        $data->second_name, 
                                                        $data->name_user,
                                                        $data->password, 
                                                        $data->fk_rol));
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SearchUsers()
    {
        try {
            $query = "SELECT * FROM users INNER jOIN rol ON users.fk_rol = rol.id_rol";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }

    }

    public function Login($user)
    {
        try {
            $query = "SELECT id_user, fk_rol, password FROM users WHERE name_user = ? LIMIT 1";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(1, $user, PDO::PARAM_STR, 50);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_OBJ);           
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }    

}