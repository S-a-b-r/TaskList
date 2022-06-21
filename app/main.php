<?php
    //error_reporting(E_ALL & ~E_NOTICE);
    require_once('Application.php');

    function router($params){
        $action = $params['action'];
        if($action){
            $app = new Application();
            switch ($action){
                //users
                case 'login': $app->login($params); break;
                case 'logout': $app->logout(); break;

                //tasks
                case 'add_task': $app->addTask($params); break;
                case 'remove_all': $app->removeAllTasks(); break;
                case 'ready_all': $app->readyAllTasks(); break;
                case 'ready_task': $app->readyTask($params); break;
                case 'unready_task': $app->unreadyTask($params); break;
                case 'delete_task': $app->removeTask($params); break;
            }
        }
        echo 'Ошибка роутинга';
    }

    router($_POST);


