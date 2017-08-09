<div class="col-md-4"></div>
<div class="col-md-4">
    <h3 style="text-align: center">Вход</h3>
    <?php if ($errors != '') echo $errors;?>
    <form action="/login" method="POST">
        <div class="form-group">
            <label for="login">Логин:</label>
            <input type="text" class="form-control" id="login" name="login" value="<?php echo $_POST['login']?>" placeholder="Логин..."/>
        </div>
        <div class="form-group">
            <label for="password">Пароль:</label>
            <input type="password" class="form-control" id="password" name="password" value="<?php echo $_POST['password']?>" placeholder="Пароль..."/>
        </div>
        <div>
            <button type="submit" name="do_login" class="btn btn-primary btn-block">Войти</button>
        </div>
    </form>
</div>
<div class="col-md-4"></div>
