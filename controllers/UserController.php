<?php

include_once ROOT . '/models/User.php';

class UserController
{

    public function actionShowProfile($params)
    {

        if ($params[0]) {

            $userinfo = User::getInfo($params[0]);

            $title = $userinfo['login'];
            $content_view = 'user/profile.php';
            require_once(ROOT . '/views/base.php');

        }

    }

}