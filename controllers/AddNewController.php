<?php

include_once ROOT . '/models/User.php';

class AddNewController
{

    public function actionIndex()
    {

        $data = $_POST;

        if (isset($_POST['do_post'])) {
            $errors = '';
            $errors = User::addNew($data);
        }

        $title = 'Добавление новости';

        $content_view = 'news/addNew.php';

        require_once(ROOT . '/views/base.php');

        return true;

    }

}