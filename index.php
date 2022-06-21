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
    <form action="app/main.php" method="post" class="form col-8">
        <div class="d-flex">
            <input class="input-text form-control" placeholder="Enter text..." name="description" type="text">
            <button class="btn btn-outline-primary col-2 mx-2" type="submit" name="action" value="add_task">Add task</button>
        </div>

        <div class="new-task-buttons mt-3 align-content-center">
            <button class="btn btn-outline-success" type="submit" name="action" value="ready_all">Ready all</button>
            <button class="btn btn-outline-danger" type="submit" name="action" value="remove_all">Remove all</button>
        </div>
    </form>

    <h2 class="mt-3">Tasks:</h2>
    <?php
        foreach($_SESSION['tasks'] as $task){
    ?>
    <form action="app/main.php" method="post">
        <div class="card mt-4" style="border: 1px solid <?php echo $task['status']==1?'green':'red'?>">
            <input type='hidden' name='task_id' value="<?php echo $task['id']?>">
            <div class="card-body">
                <p class="card-text"><?php echo htmlspecialchars($task['description'])?></p>
                <button class='btn btn-outline-success' name='action' value='ready_task' <?php echo $task['status']==1?'hidden':''?> >Ready</button>
                <button class='btn btn-outline-warning' name='action' value='unready_task' <?php echo $task['status']==0?'hidden':'' ?>>Unready</button>
                <button class='btn btn-outline-danger' name='action' value='delete_task'>Delete</button>
            </div>
        </div>
    </form>

    <?php
        }
    ?>
</div>
</body>
</html>