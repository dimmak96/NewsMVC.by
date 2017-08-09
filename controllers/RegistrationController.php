<?php

include_once ROOT . '/models/User.php';

class RegistrationController
{

    public function actionIndex()
    {

        $data = $_POST;

        if (isset($_POST['do_registration'])) {
            $errors = '';
            $errors = User::doRegistration($data);
        }

        $title = 'Регистрация';

        $content_view = 'registration/registration.php';

        require_once(ROOT . '/views/base.php');

        return true;

    }

}