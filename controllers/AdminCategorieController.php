<?php

class AdminCategorieController extends AdminBase
{

    public function actionIndex()
    {
        self::checkAdmin();

        if (isset($_COOKIE["user"]))
            $userId = $_COOKIE["user"];
        else
            $userId = $_SESSION["user"];

        // Получаем информацию о текущем пользователе
        $user = User::getUserById($userId);

        // name for side-nav active class
        $pageName = "Categorie";

        $categoryList = Category::getCategoriesList();


        require_once ROOT . "/views/admin_categorie/index.php";
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

        if (isset($_POST["create_categorie"])) {

            // Получаем данные из формы
            $title = $_POST['title'];

            $id = Category::createCategory($title);
            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/categorie");
        }
        require_once ROOT . "/views/admin_categorie/create.php";
        return true;
    }

    /**
     * Action для страницы "Удалить товар"
     */
    public function actionDelete($id)
    {
        // Проверка доступа
        self::checkAdmin();

        Category::deleteCategorieById($id);

        header("Location: /admin/categorie");

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

        if (isset($_POST["update_categorie"])) {

            // Если форма отправлена
            // Получаем данные из формы
            $title = $_POST['title'];

            Category::updateCategorieById($id, $title);


            // Перенаправляем пользователя на страницу управлениями товарами
            header("Location: /admin/categorie");
        }

        require_once ROOT . "/views/admin_categorie/update.php";
        return true;
    }


}
