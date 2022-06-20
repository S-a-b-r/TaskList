<?php
session_start();
require_once('DataBase.php');
require_once('../config.php');

class Application
{
    private $db;
    public function __construct()
    {
        $this->db = new DataBase(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    }

    public function login($params){
        $login = $params['login'];
        $password = $params['password'];
        if(!empty($login) && !empty($password)){ //Валидация логина и пароля
            $user = $this->db->getUserByLogin($login);
            if($user){ //Проверка на существование такого пользователя в Базе данных
                if($this->db->authorizationUser($login, $this->encryptPassword($password))){ //Попытка авторизоваться
                    $_SESSION['error'] = null;
                    $_SESSION['user'] = $login;
                    $this->redirect('/index.php');
                };
                $_SESSION['error'] = "Неверно введен пароль";
                $this->redirect('/index.php');
            }
            else{
                $this->db->registrationUser($login, $this->encryptPassword($password)); //Регистрация нового пользователя, если такой логин еще не используется
                $_SESSION['user'] = $login;
                $this->redirect('/index.php');
            }

        }else{
            $_SESSION['error'] = 'Ошибка авторизации';
            $this->redirect('/index.php');
        }
    }

    public function logout(){
        $_SESSION['user'] = null;
        $this->redirect('/index.php');
    }

    private function encryptPassword($password){
        return md5($password . PASSWORD_KEY);
    }

    private function redirect($path){
        header('Location: '.$path);
        exit();
    }



}