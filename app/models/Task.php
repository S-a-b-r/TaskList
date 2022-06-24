<?php

require_once('Model.php');


class Task extends Model
{
    public static function getAll(int $user_id): array
    {
        $db = parent::init();
        $sql = "SELECT * FROM `tasks` WHERE user_id = ?";
        $statement = $db->prepare($sql);
        $statement->execute([$user_id]);
        return $statement->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function create(int $user_id, string $description): bool
    {
        $db = parent::init();
        $sql = "INSERT INTO `tasks` (user_id, description, created_at) VALUES (?, ?, NOW())";
        $statement = $db->prepare($sql);
        $statement->execute([$user_id, $description]);
        return true;
    }

    public static function remove(int $task_id, int $user_id): bool
    {
        $db = parent::init();
        $sql = "DELETE FROM `tasks` WHERE id = ? AND user_id = ?";
        $statement = $db->prepare($sql);
        $statement->execute([$task_id, $user_id]);
        return true;
    }

    public static function removeAll(int $user_id): bool
    {
        $db = parent::init();
        $sql = "DELETE FROM `tasks` WHERE user_id = ?";
        $statement = $db->prepare($sql);
        $statement->execute([$user_id]);
        return true;
    }

    public static function readyAll(int $user_id): bool
    {
        $db = parent::init();
        $sql = "UPDATE `tasks` SET status = 1 where user_id = ?";
        $statement = $db->prepare($sql);
        $statement->execute([$user_id]);
        return true;
    }

    public static function changeStatus(int $task_id, int $user_id, int $status): bool
    {
        $db = parent::init();
        $sql = "UPDATE `tasks` SET status = ? WHERE id = ? AND user_id = ?";
        $statement = $db->prepare($sql);
        $statement->execute([$status, $task_id, $user_id]);
        return true;
    }

}