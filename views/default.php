<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?= Config::SITE_NAME ?></title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-expand-sm bg-dark navbar-dark">
    <!-- Brand/logo -->
    <a class="navbar-brand" href="#">MVC ORM</a>

    <!-- Links -->
    <ul class="navbar-nav">
        <li class="nav-item"><a class="nav-link" href="<?= HOME_URL ?>">Home</a></li>
        <li class="nav-item"><a class="nav-link" href="<?php url('/users/register') ?>">Register</a></li>
    </ul>
</nav>

<div class="container">
    <div style="margin: 20px;">
        <!--content key get from App class by layoutObject-->
        <?= $data['content'] ?>
    </div>
</div>

</body>
</html>