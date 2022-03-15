<?php

class Subject{

    public $con;

    public $description_subject;
    public $fk_user_teacher;

    public $fk_subject;
    public $fk_user_student;
    public $rating;
  

    public function __construct()
    {
        try {
            $this->con = conection::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function InsertSubject(Subject $data)
    {
        try {

            $query = "INSERT INTO subjects (description_subject, fk_user_teacher) VALUES (?,?)";
            $this->con->prepare($query)->execute(array($data->description_subject, 
                                                        $data->fk_user_teacher));
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }    

    public function OptionUsersTeacher()
    {
        try {
            $query = "SELECT * FROM users INNER jOIN rol ON users.fk_rol = rol.id_rol WHERE fk_rol = 3";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SearchTeachers()
    {
        try {
            $query = "SELECT * FROM subjects INNER JOIN users ON subjects.fk_user_teacher = users.id_user";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }    

    public function OptionUserStudent()
    {
        try {
            $query = "SELECT * FROM users INNER jOIN rol ON users.fk_rol = rol.id_rol WHERE fk_rol = 2";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }   

    public function OptionSubject()
    {
        try {
            $query = "SELECT * FROM subjects";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function OptionSubjectTeacher($id)
    {
        try {
            $query = "SELECT * FROM subjects WHERE fk_user_teacher  = ?";            
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function InsertSubjectValues(Subject $data)
    {
        try {

            $query = "INSERT INTO ratings (fk_subject_id, fk_user_student, rating_assign) VALUES (?,?,?)";
            $this->con->prepare($query)->execute(array($data->fk_subject, 
                                                        $data->fk_user_student,
                                                        $data->rating));
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SearchRatingsSubject()
    {
        try {
            $query = "SELECT * FROM ratings INNER JOIN users ON ratings.fk_user_student = users.id_user";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function ValueStudent($id)
    {
        try {
            $query = "SELECT * FROM ratings INNER JOIN subjects ON ratings.fk_subject_id = subjects.id_subject WHERE fk_user_student = ?";
            $stmt = $this->con->prepare($query);
            $stmt->bindParam(1, $id, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ); 
        
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


}