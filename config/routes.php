<?php

return array(

    'news/([0-9]+)' => 'news/view/$1',
    'news' => 'news/index',
    'login' => 'login/index',
    'registration' => 'registration/index',
    'logout' => 'logout/index',
    'add-new' => 'addNew/index',
    'user/([0-9]+)' => 'user/showProfile/$1',
    'edit/([0-9]+)' => 'news/edit/$1'

);