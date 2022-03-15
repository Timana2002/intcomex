<?php

class SubStudent{

    public $con;

    public $fk_user_student;
    public $fk_subject;
    public $date;


    public function __construct()
    {
        try {
            $this->con = conection::connect();
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function InsertSubjectStudent(SubStudent $data)
    {
        try {

            $query = "INSERT INTO subject_student (fk_user_student, fk_subject_st, date) VALUES (?,?,?)";
            $this->con->prepare($query)->execute(array($data->fk_user_student, $data->fk_subject_st, $data->date));
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function SearchSubjectStudent()
    {
        try {
            $query = "SELECT * FROM subject_student AS a INNER JOIN users ON users.id_user = a.fk_user_student
            INNER JOIN subjects ON subjects.id_subject = a.fk_subject_st";
            $stmt = $this->con->prepare($query);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_OBJ);
            
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

}