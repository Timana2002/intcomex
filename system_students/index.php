<?php

include_once('Controller/PagesController.php');
include_once('DataBase/Conection.php');

$users = new UsersController();

if(!isset($_REQUEST['c'])){
    $users->index();
}
else
{
    $action = $_REQUEST['c'];
    call_user_func(array($users,$action));
}
