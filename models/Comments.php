<?php
/**
 * Created by PhpStorm.
 * User: ACER
 * Date: 09.08.2017
 * Time: 3:13
 */

class Comments
{

    public static function addLike($commentId)
    {

        $db = Db::getConnection();

        $error = '';

        $result = $db->query("SELECT count(*) FROM likes WHERE id_user=" . $_SESSION['logged_user']['id'] . " AND id_comment =" . $commentId);

        $res = $result->fetch();


        if ($res[0] > 0) {

            $db->query("DELETE FROM likes where id_user=" . $_SESSION['logged_user']['id']);

            return '0';


        } else {

            $db->query("INSERT INTO likes (id_user, id_comment) VALUES (" . $_SESSION['logged_user']['id'] . ", " . "$commentId)");

        }
        if ($error != '') {

            return $error;

        } else {

            return '1';


        }

    }

    public static function delete($commentId)
    {

        $db = Db::getConnection();

        $db->query("DELETE FROM comments WHERE id=" . $commentId);

        return '1';

    }

    public static function edit($commentId, $newComment)
    {

        $db = Db::getConnection();

        $db->query("UPDATE comments SET text = '" . $newComment . "' WHERE id=" . $commentId);

        return '1';

    }

}