<?php

require_once('app/views/View.php');
require_once('app/models/User.php');

if ($method == 'GET') {
    return new View('error', ['message' => 'Страница не найдена']);
}

if ($method == 'POST') {
    switch ($_POST['action']) {
        case 'login':
            return login($_POST);
        case 'logout':
            return logout();
    }
    return new View('error', ['message' => 'Страница не найдена']);
}

function login($params)
{
    $login = $params['login'];
    $password = $params['password'];
    if (!empty($login) && !empty($password)) { //Валидация логина и пароля(чтобы не были пустыми)
        $user = User::getByLogin($login);
        if (!empty($user)) { //Проверка на существование такого пользователя в Базе данных
            if (!empty(User::authorization($login, User::encryptPassword($password)))) { //Попытка авторизоваться
                //успешная авторизация
                $_SESSION['user'] = $login;
                $_SESSION['user_id'] = $user['id'];
            } else {
                //неверный пароль
                return new View('error', ['message' => 'Неправильно указан пароль, повторите попытку']);
            }
        } else {
            //Регистрация нового пользователя, если такой логин еще не используется
            $_SESSION['user_id'] = User::registration($login, User::encryptPassword($password));
            $_SESSION['user'] = $login;
        }
    } else {
        //Не указан логин/пароль
        return new View('error', ['message' => 'Пожалуйста, заполните поля логина и пароля']);
    }
    //Успешная авторизация
    return redirect('/tasks');
}

function logout()
{
    $_SESSION['user'] = null;
    $_SESSION['user_id'] = null;
    return new View('registration');
}
