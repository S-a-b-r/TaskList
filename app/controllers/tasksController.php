<?php

require_once('app/models/Task.php');
require_once('app/views/View.php');

if ($method == 'GET') {
    switch ($action) {
        case '':
            return getTask();
    }
    return new View('error', ['message' => 'Страница не найдена']);
}

if ($method == 'POST') {
    switch ($_POST['action']) {
        case 'create':
            return create($_REQUEST['description']);
        case 'remove_all':
            return removeAll();
        case 'ready_all':
            return readyAll();
        case 'ready':
            return ready($_REQUEST['task_id']);
        case 'unready':
            return unready($_REQUEST['task_id']);
        case 'remove':
            return remove($_REQUEST['task_id']);
    }
    return new View('error', ['message' => 'Страница не найдена']);
}

function getTask()
{
    if (!empty($_SESSION['user_id'])) {
        $tasks = Task::getAll($_SESSION['user_id']);
        return new View('main', ['tasks' => $tasks]);
    }
    return new View('registration');
}

function create($desc)
{
    if (!empty($desc) && strlen($desc) < 200) {
        var_dump($desc);
        Task::create($_SESSION['user_id'], $desc);
        return redirect('/tasks');
    }
    return new View('error', ['message' => 'Длина задания должна быть больше 0 и меньше 200 символов']);
}

function removeAll()
{
    Task::removeAll($_SESSION['user_id']);
    return redirect('/tasks');
}

function readyAll()
{
    Task::readyAll($_SESSION['user_id']);
    return redirect('/tasks');
}

function ready($task_id)
{
    if (!empty($task_id)) {
        Task::changeStatus($task_id, $_SESSION['user_id'], READY_STATUS);
        return redirect('/tasks');
    }
    return new View('error', ['message' => 'Мы не нашли такую задачу']);
}

function unready($task_id)
{
    if (!empty($task_id)) {
        Task::changeStatus($task_id, $_SESSION['user_id'], UNREADY_STATUS);
        return redirect('/tasks');
    }
    return new View('error', ['message' => 'Мы не нашли такую задачу']);
}

function remove($task_id)
{
    if (!empty($task_id)) {
        Task::remove($task_id, $_SESSION['user_id']);
        return redirect('/tasks');
    }
    return new View('error', ['message' => 'Мы не нашли такую задачу']);
}