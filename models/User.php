<?php
/**
 * Created by PhpStorm.
 * User: ACER
 * Date: 08.08.2017
 * Time: 1:54
 */

class User
{

    public static function doLogin($data)
    {

        $db = Db::getConnection();
        $errors=array();
        $query = 'SELECT * FROM users WHERE login="' . $data['login'] . '"';
        $result = $db->query($query, PDO::FETCH_ASSOC);
        if ($row = $result -> fetch()) {

            if (password_verify($data['password'], $row['password'])) {

                $_SESSION['logged_user']=$row;

                header('Location: http://newsmvc.by/news');

            } else {

                $errors[]  ="Не верно введен пароль";

            }

        } else {

            $errors[] = "Пользователь с такие логином не найден";

        }

        if (!empty($errors)) {

            return '<div class="alert alert-danger">'.$errors[0].'</div>';

        }

    }

    public static function doRegistration($data)
    {

        $db = Db::getConnection();

        $errors=array();

        if($_FILES["avatar"]["size"] > 1024*3*1024)
        {
            $errors[]="Размер файла превышает три мегабайта";
        }
        // Проверяем загружен ли файл
        if(is_uploaded_file($_FILES["avatar"]["tmp_name"]))
        {
            // Если файл загружен успешно, перемещаем его
            // из временной директории в конечную
            move_uploaded_file($_FILES["avatar"]["tmp_name"], ROOT . "/template/images/".basename($_FILES["avatar"]["name"]));
        } else {
            $errors[]="Ошибка загрузки файла";

        }
        if(trim($data['login'])==''){
            $errors[]="Введите логин";
        }
        if(trim($data['email'])==''){
            $errors[]="Введите email";
        }
        if($data['password']==''){
            $errors[]="Введите пароль";
        }
        if($data['password_2']!=$data['password']){
            $errors[]="Повторный пароль введен не верно";
        }

        $query = 'SELECT login FROM users WHERE login="' . $data['login'] . '"';
        $result = $db->query($query, PDO::FETCH_ASSOC);

        if ($row = $result -> fetch()) {

            $errors[]="Пользователь с такие логином уже существует";

        }

        $query = 'SELECT email FROM users WHERE email="' . $data['email'] . '"';
        $result = $db->query($query, PDO::FETCH_ASSOC);

        if ($row = $result -> fetch()) {

            $errors[]="Пользователь с таким email уже существует";

        }

        if (empty($errors)) {

            $db -> query("INSERT INTO users (login, avatar, email, password, registration_date) VALUES ('" . $data['login']."' , '".basename($_FILES["avatar"]["name"])."' , '".$data['email']."' , '".password_hash($data['password'],PASSWORD_DEFAULT)."', NOW())");
            return '<div class="alert alert-success">'."Вы успешно зарегестрировались".'</div>';

        } else {

            return '<div class="alert alert-danger">'.$errors[0].'</div>';

        }

    }

    public static function doLogout()
    {

        unset($_SESSION['logged_user']);
        header('Location: http://newsmvc.by/news');

    }

    public static function addComment($data, $new_id)
    {

        $db = Db::getConnection();

        $errors=array();

        if ($_POST['text'] == '') {

            $errors[] = "Добавьте текст комментария";

        }

        if (empty($errors)) {
            $db -> query("INSERT INTO comments (author, text, pubdate, new_id) VALUES ('" . $_SESSION['logged_user']['login'] . "','" . $data['text'] . "',NOW(),'" . $new_id . "')");


        } else {
            return '<div class="alert alert-danger">' . $errors['0'] . '</div>';
        }

    }

    public static function addNew($data)
    {

        $db = Db::getConnection();

        $errors=array();

        if($_FILES["image"]["size"] > 1024*3*1024)
        {
            $errors[]="Размер файла превышает три мегабайта";
        }
        // Проверяем загружен ли файл
        if(is_uploaded_file($_FILES["image"]["tmp_name"]))
        {
            // Если файл загружен успешно, перемещаем его
            // из временной директории в конечную
            move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/template/images/".basename($_FILES["image"]["name"]));
        } else {
            $errors[]="Ошибка загрузки файла";

        }

        if(trim($_POST['content'])==''){

            $errors[]="Введите текст новости";

        }
        if(trim($_POST['title'])==''){

            $errors[]="Введите заголовок";

        }

        if (empty($errors)) {

            $db -> query("INSERT INTO news (creation_date,author,image,title, content) VALUES (NOW(),'".$_SESSION['logged_user']['login']."','".basename($_FILES["image"]["name"])."','".$data['title']."','".$data['content']."')");
            return '<div class="alert alert-success">'."Новость успешно добавлена".'</div>';

        } else {

            return '<div class="alert alert-danger">'.$errors[0].'</div>';

        }

    }

    public static function getInfo($id)
    {

        $db = Db::getConnection();

        $query1 = 'SELECT * FROM users WHERE id=' . $id;
        $result1 = $db->query($query1, PDO::FETCH_ASSOC);
        $info = $result1 -> fetch();

        $query2 = "SELECT COUNT(*) AS publishedNews FROM news WHERE author='" . $info['login'] . "'";
        $result2 = $db->query($query2, PDO::FETCH_ASSOC);
        $publishedNews = $result2 -> fetch();
        $publishedNews = $publishedNews['publishedNews'];

        $query3 = "SELECT COUNT(*) AS leavedLikes FROM likes WHERE id_user=".$id;
        $result3 = $db->query($query3, PDO::FETCH_ASSOC);
        $leavedLikes = $result3 -> fetch();
        $leavedLikes = $leavedLikes['leavedLikes'];

        $query4 = "SELECT COUNT(*) AS leavedComments FROM comments WHERE author='" . $info['login'] . "'";
        $result4 = $db->query($query4, PDO::FETCH_ASSOC);
        $leavedComments = $result4 -> fetch();
        $leavedComments = $leavedComments['leavedComments'];

        $userInfo['login'] = $info['login'];
        $userInfo['avatar'] = $info['avatar'];
        $userInfo['publishedNews'] = $publishedNews;
        $userInfo['leavedLikes'] = $leavedLikes;
        $userInfo['leavedComments'] = $leavedComments;
        $userInfo['registration_date'] = $info['registration_date'];



        return $userInfo;

    }

}