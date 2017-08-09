<?php

include_once ROOT . '/models/User.php';

class LoginController
{

    public function actionIndex()
    {

        $data = $_POST;

        if (isset($_POST['do_login'])) {
            $errors = '';
            $errors = User::doLogin($data);
        }


        $title = 'Вход';

        $content_view = 'login/login.php';

        require_once(ROOT . '/views/base.php');

        return true;

    }

}