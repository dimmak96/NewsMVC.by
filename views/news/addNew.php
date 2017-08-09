<h3>Добавление новости</h3>
<?php if ($errors != '') echo $errors; ?>
<form enctype="multipart/form-data" method="POST" action="/add-new">

    <div class="form-group">
        <label for="exampleInputFile">Картинка</label>
        <input type="file" id="exampleInputFile" name='image'>
    </div>
    <div class="form-group">
        <label for="title1">Заголовок:</label><br>
        <input type="text" class="form-control" name="title" id="title1" placeholder="Название новости"
               value="<?php echo $_POST['title']; ?>"/>
    </div>
    <div class="form-group">
        <label for="content">Текст новости:</label><br>
        <textarea class="form-control" rows="6" name="content" id="content"
                  placeholder="Текст новости"><?php echo $_POST['content']; ?></textarea>
    </div>

    <button type="submit" name="do_post" class="btn btn-primary">Добавить</button>

</form>