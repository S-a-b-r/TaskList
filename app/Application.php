<?php

session_start();
require_once('DataBase.php');
require_once('../config.php');

class Application
{
    //Статусы для задач
    const UNREADY_STATUS = 0;
    const READY_STATUS = 1;

    private $db;

    public function __construct()
    {
        $this->db = new DataBase(DB_HOST,DB_NAME,DB_USER,DB_PASSWORD);
    }

    /////////////////////
    //////users//////////
    /////////////////////

    //Функция авторизации/регистрации
    public function login(array $params)
    {
        $login = $params['login'];
        $password = $params['password'];
        if(!empty($login) && !empty($password)){ //Валидация логина и пароля(чтобы не были пустыми)
            $user = $this->db->getUserByLogin($login);
            if(!empty($user)){ //Проверка на существование такого пользователя в Базе данных
                if(!empty($this->db->authorizationUser($login, $this->encryptPassword($password)))){ //Попытка авторизоваться
                    $_SESSION['error'] = null;
                    $_SESSION['user'] = $login;
                    $_SESSION['user_id'] = $user['id'];
                }
                else{
                    $_SESSION['error'] = "Неверно введен пароль";
                }
            }
            else{
                //Регистрация нового пользователя, если такой логин еще не используется
                $_SESSION['user_id'] = $this->db->registrationUser($login, $this->encryptPassword($password));
                $_SESSION['user'] = $login;
                $_SESSION['error'] = null;
            }
        }
        else{
            $_SESSION['error'] = 'Ошибка авторизации';
        }
        $this->redirect('/index.php');
    }

    public function logout()
    {
        $_SESSION['user'] = null;
        $_SESSION['user_id'] = null;
        $this->redirect('/index.php');
    }


    /////////////////////
    //////tasks//////////
    /////////////////////

    //Получение всех заданий авторизованного пользователя
    public function getTasks()
    {
        if(!empty($_SESSION['user_id'])){
            $_SESSION['tasks'] = $this->db->getTasks($_SESSION['user_id']);
        }
    }

    public function addTask(array $params)
    {
        if(!empty($params['description'])){
            $this->db->addTask($_SESSION['user_id'], $params['description']);
            $this->redirect('/index.php');
        }
        echo('Ошибка добавления задания');
    }

    public function removeTask(array $params)
    {
        if(!empty($params['task_id'])){
            $this->db->removeTask($params['task_id']);
            $this->redirect('/index.php');
        }
        echo('Ошибка удаления задания');
    }

    public function removeAllTasks()
    {
        $this->db->removeAllTasks($_SESSION['user_id']);
        $this->redirect('/index.php');
    }

    public function readyAllTasks()
    {
        $this->db->readyAllTasks($_SESSION['user_id']);
        $this->redirect('/index.php');
    }

    public function readyTask(array $params)
    {
        if(!empty($params['task_id'])){
            $this->db->changeStatusTask($params['task_id'], self::READY_STATUS);
            $this->redirect('/index.php');
        }
        echo('Ошибка выполнения задания');
    }

    public function unreadyTask(array $params)
    {
        if(!empty($params['task_id'])){
            $this->db->changeStatusTask($params['task_id'], self::UNREADY_STATUS);
            $this->redirect('/index.php');
        }
        echo('Ошибка выполнения задания');
    }


    /////////////////////////////
    ///Вспомогательные функции///
    /////////////////////////////


    //Функция для шифрования пароля в БД
    private function encryptPassword(string $password): string
    {
        return md5($password . PASSWORD_KEY);
    }

    //Нормальный редирект
    private function redirect(string $path)
    {
        $this->getTasks();//какой-то костыль
        header('Location: '.$path);
        exit();
    }



}