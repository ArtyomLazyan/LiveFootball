<?php
class AdminLivestreamController extends AdminBase
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
        $pageName = "Livestream";

        $livestream = Livestream::getLivestreamList($page, 15);
        $categoryList = Category::getCategoriesList();

        $total = Livestream::getTotalLivestream();

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, 15, 'page-');

        require_once ROOT . "/views/admin_livestream/index.php";
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

        if (isset($_POST["create_livestream"])) {

            $options = array();
            // Если форма отправлена
            // Получаем данные из формы
            $options['title'] = $_POST['title'];
            $options['html'] = $_POST['html'];
            $options['description'] = $_POST['description'];
            $options['visibility'] = $_POST['visibility'];

            // Если ошибок нет
            // Добавляем новый товар
            $id = Livestream::createLivestream($options);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/livestream");
        }

        require_once ROOT . "/views/admin_livestream/create.php";
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
        $livestream = Livestream::getLivestreamById($id);

        if (isset($_POST["update_livestream"])) {

            $options = array();
            // Если форма отправлена
            // Получаем данные из формы
            $options['title'] = $_POST['title'];
            $options['html'] = $_POST['html'];
            $options['description'] = $_POST['description'];
            $options['visibility'] = $_POST['visibility'];

            // Если запись добавлена
            Livestream::updateLivestreamById($id, $options);

            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/livestream");
        }

        require_once ROOT . "/views/admin_livestream/update.php";
        return true;
    }
    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        Livestream::deleteLivestreamById($id);
        header("Location: /admin/livestream");

        return true;
    }
}