<?php

class News
{
	
	public static function getNewsItemById($id){
		
		$id = intval($id);
		
		if ($id) {

		$db = Db::getConnection();

		$result = $db->query('SELECT * FROM news WHERE id=' . $id);

		$db -> query('UPDATE news SET views = views + 1 WHERE id=' . $id);

		$result -> setFetchMode(PDO::FETCH_ASSOC);
		
		$newsItem = $result -> fetch();
		
		return $newsItem;
		
		}
		
	}

    public static function getCommentsById($id){

        $id = intval($id);

        if ($id) {

            $db = Db::getConnection();

            $com = $db -> query('SELECT * FROM comments WHERE new_id=' . $id);

            $com -> setFetchMode(PDO::FETCH_ASSOC);

            $i = 0;

            while ($row = $com -> fetch()) {

                $likes = $db -> query('SELECT * from likes WHERE likes.id_comment=' . $row['id']);
                $likeCount = $likes->rowCount();

                $result = $db -> query("SELECT id, avatar FROM users WHERE login='". $row['author'] ."'");

                $result -> setFetchMode(PDO::FETCH_ASSOC);
                $res = $result -> fetch();

                $comments[$i]['id'] = $row['id'];
                $comments[$i]['author'] = $row['author'];
                $comments[$i]['text'] = $row['text'];
                $comments[$i]['pubdate'] = $row['pubdate'];
                $comments[$i]['new_id'] = $row['new_id'];
                $comments[$i]['likes'] = $likeCount;
                $comments[$i]['author_image'] = $res['avatar'];
                $comments[$i]['author_id'] = $res['id'];

                $i++;

            }

            if (!empty($comments)) {
                return $comments;
            } else return null;

        }

    }

   	public static function getNewsList(){
		
		$db = Db::getConnection();

		$newsList = array();
		
		$result = $db -> query('SELECT * FROM news ORDER BY id DESC');



		$result -> setFetchMode(PDO::FETCH_ASSOC);
		
		$i = 0;
		
		while ($row = $result -> fetch()) {

            $comments = $db -> query('SELECT * FROM comments WHERE new_id=' . $row['id']);
            $count = $comments->rowCount();

            $userId = $db -> query("SELECT id FROM users WHERE login='" . $row['author'] . "'");
            $userId -> setFetchMode(PDO::FETCH_ASSOC);
            $userId = $userId -> fetch();
			
			$newsList[$i]['id'] = $row['id'];
			$newsList[$i]['author'] = $row['author'];
			$newsList[$i]['author_id'] = $userId['id'];
			$newsList[$i]['image'] = $row['image'];
			$newsList[$i]['title'] = $row['title'];
			$newsList[$i]['content'] = $row['content'];
            $newsList[$i]['creation_date'] = $row['creation_date'];
			$newsList[$i]['views'] = $row['views'];
            $newsList[$i]['comments'] = $count;
			$i++;
			
		}
		
		return $newsList;
		
	}

    public static function edit($id, $data){

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

            $db -> query("UPDATE news SET image='" . basename($_FILES['image']['name']) . "',title='".$data['title']."',content='".$data['content']."' WHERE id=" . $id);
            return '<div class="alert alert-success">'."Новость успешно отредактирована".'</div>';

        } else {

            return '<div class="alert alert-danger">'.$errors[0].'</div>';

        }

    }


	
	
	
}