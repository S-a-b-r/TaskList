<?php
class DataBase
{
    private $db;
    function __construct($host, $name, $user, $password) {
        try {
            $this->db = new PDO('mysql:host='.$host.';dbname='.$name, $user, $password);
        } catch (PDOException $e) {
            print "Ошибка!: " . $e->getMessage();
            die();
        }
    }

    function __destruct() {
        $this->db = null;
    }

    public function getUserByLogin($login) {
        $sql = "SELECT * FROM `users` WHERE login=?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$login]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function authorizationUser($login, $password){
        $sql = "SELECT * FROM `users` WHERE login=? AND password=?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$login, $password]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function registrationUser($login, $password){
        $sql = "INSERT INTO `users` (login, password, created_at) VALUES (?, ?, NOW())";
        $statement = $this->db->prepare($sql);
        $statement->execute([$login, $password]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

}