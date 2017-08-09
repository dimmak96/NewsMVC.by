jQuery('document').ready(function () {


    jQuery('.like').on('click', function (e) {

        var commentId = this.parentNode.parentNode.parentNode.id;

        $.ajax(
            {
                "url": "",
                "method": "POST",
                "data": {
                    "commentId": commentId
                },
                "success": function (response) {
                    var likesCount = $('#like' + commentId).text();
                    if (response == 1) {
                        $('#like' + commentId).text(parseInt(likesCount) + 1);
                    } else if (response == 0) {
                        $('#like' + commentId).text(parseInt(likesCount) - 1);
                    }
                }
            }
        );
    });
    var canpress = true;
    jQuery('.remove').on('click', function (e) {

        canpress = true;
        var commentIdForDelete = this.parentNode.parentNode.parentNode.id;
        $.ajax(
            {
                "url": "",
                "method": "POST",
                "data": {
                    "commentIdForDelete": commentIdForDelete
                },
                "success": function (response) {
                    if (response == 1) {

                        $('#' + commentIdForDelete).remove();
                    }
                }
            }
        );
    });

    jQuery('.edit').on('click', function (e) {
        if (canpress) {
            canpress = false;

            var commentIdForEdit = this.parentNode.parentNode.parentNode.id;
            var comment_text = jQuery('#comment-text' + commentIdForEdit);
            var old_comment = comment_text[0].innerHTML;
            jQuery('#comment-text' + commentIdForEdit).html('<input type="text" id="new-comment-input' + commentIdForEdit + '" class="form-control" autofocus value="' + comment_text[0].innerHTML + '"/><br><button class="btn btn-default btn-xs" id="cancel-comment-edition' + commentIdForEdit + '">Отмена</button>&ensp;<button class="btn btn-primary btn-xs" id="comment-save' + commentIdForEdit + '">Сохранить</button>');

            jQuery('#cancel-comment-edition' + commentIdForEdit).on('click', function (e) {
                canpress = true;

                jQuery('#comment-text' + commentIdForEdit).text(old_comment);

            });


            jQuery('#comment-save' + commentIdForEdit).on('click', function (e) {
                canpress = true;
                var new_comment = jQuery('#new-comment-input' + commentIdForEdit).val();

                $.ajax(
                    {
                        "url": "",
                        "method": "POST",
                        "data": {
                            "commentIdForEdit": commentIdForEdit,
                            "new_comment": new_comment
                        },
                        "success": function (response) {
                            if (parseInt(response) === 1) {

                                jQuery('#comment-text' + commentIdForEdit).text(new_comment);
                            }
                        }
                    }
                );
            });
        }

    });

});