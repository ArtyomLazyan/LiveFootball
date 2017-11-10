<?php

    class AdminUsersController extends AdminBase
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
            $pageName = "Users";

            $users = User::getUsersList($page, 15);
            $total = User::getTotalUsers();
            // Создаем объект Pagination - постраничная навигация
            $pagination = new Pagination($total, $page, 15, 'page-');

            require_once ROOT . "/views/admin_users/index.php";
            return true;
        }

        /**
         * Action для страницы "Удалить товар"
         */
        public function actionDelete($id)
        {
            // Проверка доступа
            self::checkAdmin();

            User::deleteUserById($id);

            header("Location: /admin/users/page-1");

            return true;
        }
    }