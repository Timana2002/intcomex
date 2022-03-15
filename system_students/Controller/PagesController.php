<?php

include_once('Model/PagesClass.php');
include_once('Model/RolClass.php');
include_once('Model/SubjectClass.php');
include_once('Model/SubjectStudentClass.php');

class UsersController{

    public $model;
    public $mod_rol;
    public $mod_sub;
    public $mod_subst;

    public function __construct()
    {
        $this->model = new Users();
        $this->mod_rol = new Rol();
        $this->mod_sub = new Subject();
        $this->mod_subst = new SubStudent();
    }

    public function index()
    {
        include_once('View/home.php');
    }

    public function home()
    {
        include_once('View/Home/index.php');
    }

    public function admin()
    {
        include_once('View/Home/registerusers.php');
    }

    public function subject()
    {
        include_once('View/Subject/index.php');
    }

    public function values()
    {
        include_once('View/Subject/registervalues.php');
    }

    public function saveuser()
    {
        $data = new Users();
        $data->token_user = $data->GenerateToken();
        $data->first_name = $_POST['names'];
        $data->second_name = $_POST['secondnames'];
        $data->name_user = $_POST['username'];
        $data->password = $data->HashPassword($_POST['password']);
        $data->fk_rol = $_POST['rol'];

        $this->model->InsertUsers($data);

        header("Location: ?c=admin");
    }

    public function savesubject()
    {
        $data = new Subject();
        $data->description_subject = $_POST['asignatura'];
        $data->fk_user_teacher = $_POST['users'];

        $this->mod_sub->InsertSubject($data);

        header("Location: ?c=subject");

    }

    public function savesubjectstudent()
    {
        $data = new SubStudent();
        $data->fk_user_student = $_POST['student'];
        $data->fk_subject_st = $_POST['subj'];
        $data->date = date("Y-m-d H:i:s");

        $this->mod_subst->InsertSubjectStudent($data);
        header("Location: ?c=subject");
        
    }

    public function saveratings()
    {
        $data = new Subject();
        $data->fk_subject = $_POST['subject'];
        $data->fk_user_student = $_POST['student'];
        $data->rating = $_POST['values'];

        $this->mod_sub->InsertSubjectValues($data);
        header("Location: ?c=values");
    }

    public function session()
    {

        session_start();

        $session = new Users();

        $user = $session->user = $_POST['user'];
        $password = $session->pass = $_POST['password'];

        $sec = $session->Login($user);

        $pass = $sec->password;

        $validepass = password_verify($password, $pass);

        $id = $sec->id_user;
        $rol = $sec->fk_rol;

        if($validepass){

            $_SESSION['id_user_S'] = $id;
            $_SESSION['fk_rol_S'] = $rol;

            header("Location:?c=home");
        }
        else
        {
            header("Location: ../system_students");
        }
    }

    public function CloseSesion()
    {
        session_start();
        session_destroy();
        header("Location: ../system_students");
    }

}