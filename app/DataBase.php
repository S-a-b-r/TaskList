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

    public function getUserByLogin(string $login)
    {
        $sql = "SELECT * FROM `users` WHERE login=?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$login]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function authorizationUser(string $login, string $password)
    {
        $sql = "SELECT * FROM `users` WHERE login=? AND password=?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$login, $password]);
        return $statement->fetch(PDO::FETCH_ASSOC);
    }

    public function registrationUser(string $login, string $password): int
    {
        $sql = "INSERT INTO `users` (login, password, created_at) VALUES (?, ?, NOW())";
        $statement = $this->db->prepare($sql);
        $statement->execute([$login, $password]);
        return $this->db->lastInsertId();
    }

    public function getTasks(int $user_id): array
    {
        $sql = "SELECT * FROM `tasks` WHERE user_id = ?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$user_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addTask(int $user_id, string $description): bool
    {
        $sql = "INSERT INTO `tasks` (user_id, description, created_at) VALUES (?, ?, NOW())";
        $statement = $this->db->prepare($sql);
        $statement->execute([$user_id, $description]);
        return true;
    }

    public function removeTask(int $task_id, int $user_id): bool
    {
        $sql = "DELETE FROM `tasks` WHERE id = ? AND user_id = ?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$task_id, $user_id]);
        return true;
    }

    public function removeAllTasks(int $user_id): bool
    {
        $sql = "DELETE FROM `tasks` WHERE user_id = ?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$user_id]);
        return true;
    }

    public function readyAllTasks(int $user_id): bool
    {
        $sql = "UPDATE `tasks` SET status = 1 where user_id = ?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$user_id]);
        return true;
    }

    public function changeStatusTask(int $task_id, int $user_id, int $status): bool
    {
        $sql = "UPDATE `tasks` SET status = ? WHERE id = ? AND user_id = ?";
        $statement = $this->db->prepare($sql);
        $statement->execute([$status, $task_id, $user_id]);
        return true;
    }

}