<?php

return array(

    // admin panel
    'admin/users/delete/([0-9]+)' => 'adminUsers/delete/$1',
    'admin/users/page-([0-9]+)' => 'adminUsers/index/$1',
    'admin/users' => 'adminUsers/index',

    'admin/categorie/update/([0-9]+)' => 'adminCategorie/update/$1',
    'admin/categorie/delete/([0-9]+)' => 'adminCategorie/delete/$1',
    'admin/categorie/create' => 'adminCategorie/create',
    'admin/categorie' => 'adminCategorie/index',

    'admin/livestream/page-([0-9]+)' => 'adminLivestream/index/$1',
    'admin/livestream/delete/([0-9]+)' => 'adminLivestream/delete/$1',
    'admin/livestream/update/([0-9]+)' => 'adminLivestream/update/$1',
    'admin/livestream/create' => 'adminLivestream/create',
    'admin/livestream' => 'adminLivestream/index',

    'admin/article/page-([0-9]+)' => 'adminArticle/index/$1',
    'admin/article/delete/([0-9]+)' => 'adminArticle/delete/$1',
    'admin/article/update/([0-9]+)' => 'adminArticle/update/$1',
    'admin/article/create' => 'adminArticle/create',
    'admin/article' => 'adminArticle/index',
    'admin' => 'admin/index',

    // Пользователь:
    'user/register' => 'user/register',
    'user/login' => 'user/login',
    'user/logout' => 'user/logout',
    'cabinet/edit' => 'cabinet/edit',
    'cabinet' => 'cabinet/index',

    // articles
    'articles/([0-9]+)/page-([0-9]+)' => 'article/index/$1/$2', // List articles by category
    'articles' => 'article/index', // all articles

    // livestream
    'livestream/page-([0-9]+)' => 'livestream/index/$1', // all articles
    'livestream/([0-9]+)' => 'livestream/view/$1', // List articles by category
    'livestream' => 'livestream/index', // all articles


    'article/comment/([0-9]+)' => 'article/comment/$1', // article by id add comment
    'article/([0-9]+)' => 'article/view/$1', // article by id

    'email' => 'site/email',
    '403' => 'site/accessDenied',
    '404' => 'site/notFound',
    'live' => 'site/live',
    'contact' => 'site/contact',
    'about' => 'site/about',
    'index.php' => 'site/index', // actionIndex in SiteController
    '' => 'site/index', // actionIndex in SiteController
);
