<?php

require_once('Model.php');

class User extends Model
{

    public static function getByLogin(string $login)
    {
        $db = parent::init();
        $sql = "SELECT * FROM `users` WHERE login=?";
        $statement = $db->prepare($sql);
        $statement->execute([$login]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function authorization(string $login, string $password)
    {
        $db = parent::init();
        $sql = "SELECT * FROM `users` WHERE login=? AND password=?";
        $statement = $db->prepare($sql);
        $statement->execute([$login, $password]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public static function registration(string $login, string $password): int
    {
        $db = parent::init();
        $sql = "INSERT INTO `users` (login, password, created_at) VALUES (?, ?, NOW())";
        $statement = $db->prepare($sql);
        $statement->execute([$login, $password]);
        return $db->lastInsertId();
    }

    //Функция для шифрования пароля в БД
    public static function encryptPassword(string $password): string
    {
        return md5($password.PASSWORD_KEY);
    }
}