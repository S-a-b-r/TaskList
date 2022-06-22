<?php session_start(); ?>
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
<div class="px-4 py-5 my-5 text-center">
    <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">Авторизуйтесь, чтобы составить свой task list</p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
            <form class="p-4 p-md-5 border rounded-3 bg-light" action="app/main.php" method="POST">
                <div class="form-floating mb-3">
                    <input type="text" class="form-control" id="floatingInput" placeholder="login" name="login">
                    <label for="floatingInput">Login</label>
                </div>
                <div class="form-floating mb-3">
                    <input type="password" class="form-control" id="floatingPassword" placeholder="Password" name="password">
                    <label for="floatingPassword">Password</label>
                </div>
                <button class="w-100 btn btn-lg btn-primary" type="submit" value="login" name="action">Авторизоваться</button>
            </form>
        </div>
        <?php
        if(isset($_SESSION['error'])){ ?>
            <div class="alert alert-danger mt-3" role="alert">
                <?php  echo $_SESSION['error']?>
            </div>
            <?php
        }
        ?>
    </div>
</div>

</body>
</html>