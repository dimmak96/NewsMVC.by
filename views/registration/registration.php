<h3>Регистрация</h3>
<?php if ($errors != '') echo $errors; ?>
<form enctype="multipart/form-data" action="/registration" method="POST">
    <div class="form-group">
        <label for="login">Логин</label>
        <input type="text" class="form-control" id="login" name="login" value="<?php echo $_POST['login']?>"  placeholder="Логин..."/>
    </div>
    <div class="form-group">
        <label for="userAvatar">Аватар</label>
        <input type="file" id="userAvatar" name='avatar'>
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" value="<?php echo $_POST['email']?>"  placeholder="Email..."/>
    </div>
    <div class="form-group">
        <label for="password">Пароль</label>
        <input type="password" class="form-control" id="password" name="password" value="<?php echo $_POST['password']?>"  placeholder="Пароль..."/>
    </div>
    <div class="form-group">
        <label for="password_2">Введите пароль еще раз</label>
        <input type="password" class="form-control" id="password_2" name="password_2" value="<?php echo $_POST['password_2']?>"  placeholder="Пароль..."/>
    </div>
    <div>
        <button type="submit" name="do_registration" class="btn btn-primary">Зарегестрироваться</button>
    </div>
</form>

