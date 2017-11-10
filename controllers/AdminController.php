<?php

    class AdminController extends AdminBase
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
            $pageName = "Dashboard";

            require_once ROOT . "/views/admin/starter.php";
            return true;
        }
    }
