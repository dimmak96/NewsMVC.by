<div class="content">
    <h2>Список всех новостей</h2>

    <?php foreach ($newsList as $newItem): ?>
        <div class="col-md-4">
            <div>
                Автор: <em><strong><a href="/user/<?php echo $newItem['author_id']; ?>"
                                      class="new-author"><?php echo $newItem['author']; ?></a></strong></em>
                <?php if ($_SESSION['logged_user']['login'] == $newItem['author']) { ?>
                    <a href="/edit/<?php echo $newItem['id']; ?>" style="margin-left:37%;"
                       id="edit-new<?php echo $newItem['id']; ?>">Редактировать</a>
                <?php } ?>
            </div>
            <div class="title">
                <div>
                    <a href="/news/<?php echo $newItem['id']; ?>"><img
                                src="../../template/images/<?php echo $newItem['image']; ?>"
                                style="width:100%;height:200px;"/></a>
                </div>
                <div><h3><a href="/news/<?php echo $newItem['id']; ?>"><?php echo $newItem['title']; ?></a></h3></div>

            </div>
            <div><?php echo $newItem['content']; ?></div>
            <div><?php echo $newItem['creation_date']; ?></div>
            <div>
                <div>
                    <div style=" width:100%; height:1px; clear:both;"></div>
                    <div style="float:left;width:33%">
                        <img src="../../template/images/Kommentarii-WordPress-kak-imi-operirovat.png"
                             style="width:15%;"></img>:<?php echo $newItem['comments']; ?>
                    </div>
                    <div style="float:right;width:33%;text-align:right;"><img
                                src="../../template/images/eye-2387853_960_720.png"
                                style="width:20%;"></img>:<?php echo $newItem['views']; ?></div>
                    <div style=" width:100%; height:1px; clear:both;"></div>
                </div>
            </div>
            <?php echo "<br/>" ?>
        </div>
    <?php endforeach; ?>

</div>
