<?php

include_once ROOT . '/models/News.php';
include_once ROOT . '/models/User.php';
include_once ROOT . '/models/Comments.php';

class NewsController
{

    public function actionIndex()
    {

        $newsList = array();
        $newsList = News::getNewsList();

        $title = 'Новости';
        $content_view = 'news/index.php';
        require_once(ROOT . '/views/base.php');
        return true;

    }

    public function actionView($params)
    {

        $data = $_POST;

        if (isset($data['commentIdForDelete'])) {

            echo Comments::delete($data['commentIdForDelete']);
            die();
        }

        if (isset($data['commentId'])) {
            echo Comments::addLike($data['commentId']);
            die();
        }

        if (isset($data['commentIdForEdit'])) {

            echo Comments::edit($data['commentIdForEdit'], $data['new_comment']);
            die();
        }


        if (isset($data['do_post'])) {
            $errors = '';
            $errors = User::addComment($data, $params[0]);
        }

        if ($params[0]) {

            $newsItem = News::getNewsItemById($params[0]);
            $comments = News::getCommentsById($params[0]);


            $title = $newsItem['title'];
            $content_view = 'news/new.php';
            require_once(ROOT . '/views/base.php');

        }

        return true;

    }

    public function actionEdit($params)
    {
        $id = $params[0];

        $data = $_POST;

        if ($id) {

            $newsItem = News::getNewsItemById($id);
            if (isset($_POST['do_post'])) {
                $errors = '';
                $errors = News::edit($id, $data);;
            }


            $title = 'Редактирование новости';
            $content_view = 'news/edit.php';
            require_once(ROOT . '/views/base.php');

        }


    }


}