<?php

class AdminArticleController extends AdminBase
{

    public function actionIndex($page = 1)
    {
        self::checkAdmin();

        if (isset($_COOKIE["user"]))
            $userId = $_COOKIE["user"];
        else
            $userId = $_SESSION["user"];

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        // name for side-nav active class
        $pageName = "Articles";

        $articlesList = Article::getArticlesList($page, 15);
        $categoryList = Category::getCategoriesList();

        $total = Article::getTotalArticles();

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, 15, 'page-');

        require_once ROOT . "/views/admin_article/index.php";
        return true;
    }

    public function actionCreate()
    {
        // Проверка доступа
        self::checkAdmin();

        if (isset($_COOKIE["user"]))
            $userId = $_COOKIE["user"];
        else
            $userId = $_SESSION["user"];

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        $categoryList = Category::getCategoriesList();

        if (isset($_POST["create_article"])) {

            $options = array();
            // Если форма отправлена
            // Получаем данные из формы
            $options['title'] = $_POST['title'];
            $options['text'] = $_POST['text'];
            $options['category_id'] = $_POST['category_id'];
            $options['video_iframe'] = $_POST['video_iframe'];
            $options['visibility'] = $_POST['visibility'];

                // Если ошибок нет
                // Добавляем новый товар
                $id = Article::createArticle($options);

                // Если запись добавлена
                if ($id) {
                    // Проверим, загружалось ли через форму изображение
                    if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                        // Если загружалось, переместим его в нужную папке, дадим новое имя
                        move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/upload/post_images/" . $id . ".jpg");
                    }
                }
                // Перенаправляем пользователя на страницу управлениями товарами
                header("Location: /admin/article");
            }

        require_once ROOT . "/views/admin_article/create.php";
        return true;
    }

    public function actionUpdate($id)
    {
        // Проверка доступа
        self::checkAdmin();

        if (isset($_COOKIE["user"]))
            $userId = $_COOKIE["user"];
        else
            $userId = $_SESSION["user"];

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        $categoryList = Category::getCategoriesList();
        $article = Article::getArticleById($id);

        if (isset($_POST["update_article"])) {

            $options = array();
            // Если форма отправлена
            // Получаем данные из формы
            $options['title'] = $_POST['title'];
            $options['text'] = $_POST['text'];
            $options['video_iframe'] = $_POST['video_iframe'];
            $options['category_id'] = $_POST['category_id'];
            $options['visibility'] = $_POST['visibility'];

            // Если запись добавлена
            if (Article::updateArticleById($id, $options)) {
                // Проверим, загружалось ли через форму изображение
                if (is_uploaded_file($_FILES["image"]["tmp_name"])) {
                    $image_name = Article::getImage($id);
                    unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $image_name);
                    // Если загружалось, переместим его в нужную папке, дадим новое имя
                    move_uploaded_file($_FILES["image"]["tmp_name"], ROOT . "/upload/post_images/" . $id . ".jpg");
                }
            }
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/article");
        }

        require_once ROOT . "/views/admin_article/update.php";
        return true;
    }
    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        Article::deleteArticleById($id);
        header("Location: /admin/article");

        return true;
    }


}
