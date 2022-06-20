<?php
    error_reporting(E_ALL & ~E_NOTICE);
    require_once('Application.php');

    if($_GET){
        router($_GET);
    } elseif($_POST){
        router($_POST);
    } else{
        return false;
    }

    function router($params){
        $action = $params['action'];
        if($action){
            $app = new Application();
            switch ($action){
                //users
                case 'login': $app->login($params); break;
                case 'logout': return $app->logout();

                //tasks
                case 'add_task': return $app->addTask($params);
                case 'remove_all': return $app->removeAll();
                case 'ready_all': return $app->readyAll();
                case 'ready_task': return $app->readyTask($params);
                case 'unready_task': return $app->unreadyTask($params);
                case 'delete_task': return $app->deleteTask($params);
            }
        }
        return false;
    }

