<?php

include_once ROOT . '/models/User.php';

class CommentsController
{

    public function actionAddComment($params)
    {

        $data = $_POST;

        if (isset($_POST['do_post'])) {
            $errors = '';
            $newsItem = News::getNewsItemById($params[0]);
            $errors = User::addComment($data, $newsItem['id']);
        }

    }

}