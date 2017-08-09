<!DOCTYPE html>
<html>
<head>
    <title><?=$title?></title>
    <meta charset="utf-8"/>
    <link rel="stylesheet" href="../../template/css/bootstrap.min.css" type="text/css"/>
    <link rel="stylesheet" href="../../template/css/styles.css" type="text/css"/>
    <script type="text/javascript" src="../../template/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="../../template/js/bootstrap.min.js"></script>

    <script type="text/javascript" src="../../template/js/script.js"></script>
</head>
<body style="background: url(../../template/images/_mg_1583_22_36dr.jpg) no-repeat">

<div class="container">
    <div class="header">
        <div class="navigation">
            <ul>

                <li><a href="/news">Все Новости</a></li><!--/index.php?url=all-news !-->
                <?php if(isset($_SESSION['logged_user'])) {?>
                    <li><a href="/add-new">Добавить новость</a></li><!--/index.php?url=add-new !-->

                <?php }?>
            </ul>
            <?php if(isset($_SESSION['logged_user'])) {?>
                <ul style="padding-left:75%;">
                    <li style="padding-top:25px;padding-right:7px"><?php echo $_SESSION['logged_user']['login']?></li>
                    <li style="padding-top:25px;display:none;" id="id_user"><?php echo $_SESSION['logged_user']['id']?></li>
                    <li><a href="/user/<?php echo $_SESSION['logged_user']['id'] ?>">Личный кабинет</a></li>
                    <li style="margin-left:10px;"><a href="/logout">Выйти</a></li>
                </ul>

            <?php }else{ ?>
                <ul style="padding-left:80%;">
                    <li><a href="/login">Вход</a></li>
                    <li><a href="/registration">Регистрация</a></li>

                </ul>
            <?php } ?>
        </div>
    </div>
    <?php
        include $content_view;
        die();
    ?>
</div>