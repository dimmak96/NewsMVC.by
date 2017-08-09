<h2 style="text-align:center;"><?php echo $userinfo['login']; ?></h2>
<div>
    <div class="profile-image" style="float:left;width:50%;"><img
                src="../../template/images/<?php echo $userinfo['avatar'] ?>" style="width:100%;"></img></div>
    <div class="text-information" style="width:50%;float:right;padding-left:5%">
        <p>Новостей опубликовано: <?php echo $userinfo['publishedNews']; ?> </p>
        <p>Лайков поставлено: <?php echo $userinfo['leavedLikes']; ?> </p>
        <p>Комментариев оставлено: <?php echo $userinfo['leavedComments']; ?> </p>
        <p>Дата регистрации: <?php echo $userinfo['registration_date'] ?></p>
    </div>
</div>
