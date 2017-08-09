<?php

include_once ROOT . '/models/User.php';

class LogoutController
{

    public function actionIndex()
    {

        User::doLogout();

    }

}