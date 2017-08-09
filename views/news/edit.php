<h3>Редактирование новости</h3>
<?php if ($errors != '') echo $errors; ?>
<form enctype="multipart/form-data" method="POST" action="/edit/<?php echo $id; ?>">

    <div class="form-group">
        <label for="exampleInputFile">Картинка</label>
        <input type="file" id="exampleInputFile_edit" name='image'>
    </div>
    <div class="form-group">
        <label for="title1">Заголовок:</label><br>
        <input type="text" class="form-control" name="title" id="title1_edit" placeholder="Название новости"
               value="<?php echo $newsItem['title'] ?>"/>
    </div>
    <div class="form-group">
        <label for="content">Текст новости:</label><br>
        <textarea class="form-control" rows="6" name="content" id="content_edit"
                  placeholder="Текст новости"><?php echo $newsItem['content']; ?></textarea>
    </div>

    <button type="submit" name="do_post" class="btn btn-primary">Сохранить</button>

</form>