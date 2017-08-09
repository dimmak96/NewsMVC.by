<div class="content">
    <p class="views"><?php echo $newsItem['views'] + 1; ?> просмотров</p>
    <div style="margin-top:10px;">
        <p style="text-align:center;">
            <img src="../../template/images/<?php echo $newsItem['image']; ?>" style="width:50%;"/>
        </p>
    </div>
    <div>
        <?php echo '<h3 style="text-align:center;">' . $newsItem['title'] . "</h3>" ?>
    </div>
    <div>
        <?php echo $newsItem['content']; ?>
    </div>
    <div class="warning-message"></div>
    <div style="margin-top:10px;">


    </div>
    <?php if (!isset($_SESSION['logged_user'])) { ?>
        <div class="alert alert-warning">
            <strong>Внимание!</strong> Чтобы оставить комментарий, лайкать их, вам нужно <a
                    href="/login">авторизоваться</a>.
        </div>
    <?php }
    if ($errors != '') echo $errors; ?>
    <div style="background-color:#6c7684;margin-top:20px;margin-bottom:10px">

        <p style="text-align:left;float: left;padding-top:10px;padding-left:10px;">Комментарии:</p>
        <?php if (isset($_SESSION['logged_user'])) { ?>
            <a style="color:#333333;float: right;padding-top: 10px;" href="#add-comment-form"><p
                        class="add-comment-link"
                        onclick="document.getElementById('add-comment-form').style.display='block';">Добавить
                    свой</p></a>
        <?php }
        if (empty($comments)) {
            echo '<p style="padding-top:40px;padding-bottom:10px;"><em>Нет комментариев</em></p>';
        }else { ?>

        <div class="comments" style="padding-top:40px;">

            <?php foreach (array_reverse($comments) as $comment): ?>
                <div class="comment" id="<?= $comment['id'] ?>" style="height:100%;">
                    <div style=" width:100%; height:1px; clear:both;"></div>
                    <div style="float:left;width:80%">


                        <p>
                            <a href="/user/<?php echo $comment['author_id']; ?>"><img class="user-image-comment"
                                                                                      src="../../template/images/<?php echo $comment['author_image']; ?>"
                                                                                      style="width:5%;"/></a>
                            <?php echo "  <em><b><a class=comment-author href=/user/" . $comment['author_id'] . ">" . $comment['author'] . "</a></b></em> " . '<span style="font-size:10px;">' . $comment['pubdate'] . "</span>:"; ?>

                        </p>
                        <p id="comment-text<?= $comment['id'] ?>"><?php echo $comment['text']; ?></p>
                        ❤ <span id="like<?= $comment['id'] ?>"><?php echo $comment['likes']; ?></span>


                    </div>
                    <?php if (isset($_SESSION['logged_user'])) { ?>
                        <div style="float:right;">
                            <p class="icons" style="display:none;padding-right:10px;">
                                <button class="icon like">&#10084;</button>
                                <?php if ($_SESSION['logged_user']['login'] == $comment['author']) { ?>
                                    <button class="icon remove">&#10006;</button>
                                    <button class="icon edit">&#9998;</button>
                                <?php } ?>
                            </p>

                        </div>
                    <?php } ?>
                    <div style=" width:100%; height:1px; clear:both;"></div>
                    <br>
                </div>
            <?php endforeach; ?>


        </div>


    </div>


<?php

}

?>

    <div id="add-comment-form">
        <form method="POST" action="/news/<?php echo $newsItem['id']; ?>" id="<?php echo $newsItem['id']; ?>">

            <h5 style="text-align:center;padding-top:10px;">Добавить комментарий</h5>
            <br/>
            <div class="form-group">
                <textarea class="form-control" autofocus name="text" rows="2" style="width:50%;margin-left:25%"
                          placeholder="Комментарий"></textarea>

            </div>

            <br/>
            <p style="text-align:center;padding-bottom:10px;">
                <button type="submit" name="do_post" class="btn btn-primary">Добавить комментарий</button>
            </p>

        </form>
    </div>

</div>
