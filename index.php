<?php
if(!isset($_SESSION)){
    session_start();
}

if(!isset($_SESSION['user'])){
    header('Location: /registration.php');
}

?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="styles/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="styles/main.css">
    <title>Task list</title>
</head>
<body>
<?php
    include_once('IncludesComponent/header.php');
?>

<div class="container">
    <form action="" method="post" class="form col-8">
        <div class="d-flex">
            <input class="input-text form-control" placeholder="Enter text..." name="text" type="text">
            <button class="btn btn-outline-primary col-2 mx-2" type="submit" name="action" value="add_task">Add task</button>
        </div>

        <div class="new-task-buttons mt-3 align-content-center">
            <button class="btn btn-outline-success" type="submit" name="action" value="ready_all">Ready all</button>
            <button class="btn btn-outline-danger" type="submit" name="action" value="remove_all">Remove all</button>
        </div>
        <h2 class="mt-3">Tasks:</h2>
        <div class="card mt-4" style="border: 1px solid green">
            <input type='hidden' name='id_task' value=".$key.">
            <div class="card-body">
                <p class="card-text">Task text</p>
                <button class='btn btn-outline-success' name='action' value='ready_task'>Ready</button>
                <button class='btn btn-outline-warning' name='action' value='unready_task' hidden>Unready</button>
                <button class='btn btn-outline-danger' name='action' value='delete_task'>Delete</button>
            </div>
        </div>
        <div class="card mt-4" style="border: 1px solid red">
            <input type='hidden' name='id_task' value=".$key.">
            <div class="card-body">
                <p class="card-text">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                <button class='btn btn-outline-success' name='action' value='ready_task'>Ready</button>
                <button class='btn btn-outline-warning' name='action' value='unready_task' hidden>Unready</button>
                <button class='btn btn-outline-danger' name='action' value='delete_task'>Delete</button>
            </div>
        </div>
    </form>
</div>
</body>
</body>
</html>