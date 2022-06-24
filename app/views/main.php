<?php
if(!isset($_SESSION)){
    session_start();
}
?>
<!doctype html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" type="text/css" href="../../css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../../css/main.css">
    <title>Task list</title>
</head>
<body>
<header class="d-flex flex-wrap justify-content-center py-3 mb-4 border-bottom">
    <a href="/" class="d-flex align-items-center mb-3 mb-md-0 me-md-auto text-dark text-decoration-none">
        <svg class="bi me-2" width="40" height="32"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-4">
            Task list (
            <?php echo htmlspecialchars($_SESSION['user'])?>
            )
        </span>
    </a>

    <?php if(isset($_SESSION['user'])){ ?>
        <ul class="nav nav-pills">
            <form action="/users/logout" method="post">
                <li class="nav-item"><button type="submit" class="btn btn-outline-dark mx-4" name="action" value="logout">Выход</button></li>
            </form>
        </ul>
    <?php } ?>
</header>

<div class="container">
    <form action="/tasks" method="post" class="form col-8">
        <div class="d-flex">
            <input class="input-text form-control" placeholder="Enter text..." name="description" type="text">
            <button class="btn btn-outline-primary col-2 mx-2" type="submit" name="action" value="create">Add task</button>
        </div>

        <div class="new-task-buttons mt-3 align-content-center">
            <button class="btn btn-outline-success" type="submit" name="action" value="ready_all">Ready all</button>
            <button class="btn btn-outline-danger" type="submit" name="action" value="remove_all">Remove all</button>
        </div>
    </form>

    <h2 class="mt-3">Tasks:</h2>
    <?php
    foreach($params['tasks'] as $task){
        ?>
        <form action="/tasks" method="post">
            <div class="card mt-4" style="border: 1px solid <?php echo $task['status']==1?'green':'red'?>">
                <input type='hidden' name='task_id' value="<?php echo $task['id']?>">
                <div class="card-body">
                    <p class="card-text"><?php echo htmlspecialchars($task['description'])?></p>
                    <button class='btn btn-outline-success' name='action' value='ready' <?php echo $task['status']==1?'hidden':''?> >Ready</button>
                    <button class='btn btn-outline-warning' name='action' value='unready' <?php echo $task['status']==0?'hidden':'' ?>>Unready</button>
                    <button class='btn btn-outline-danger' name='action' value='remove'>Delete</button>
                </div>
            </div>
        </form>

        <?php
    }
    ?>
</div>
</body>
</html>