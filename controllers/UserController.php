<?php

/**
 * Контроллер UserController
 */
class UserController
{
    /**
     * Action для страницы "Регистрация"
     */

    public function actionRegister()
    {
        // Если форма отправлена
        // Получаем данные из формы
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $confirm_password = htmlspecialchars($_POST['confirm_password']);
        $recaptcha_response = $_POST["g-recaptcha-response"];

        // Флаг ошибок
        $errors = false;

        $data = false;

        // Валидация полей
        if (!User::verifyRecaptcha($recaptcha_response)) {
            $errors[] = 'Пожалуйста пройдите проверку если вы не робот!';
        }
        if (!User::checkName($name)) {
            $errors[] = 'Имя не должно быть короче 2-х символов';
        }
        if (!User::checkEmail($email)) {
            $errors[] = 'Неправильный email';
        }
        if (!User::checkPassword($password)) {
            $errors[] = 'Пароль не должен быть короче 6-ти символов';
        }
        if (!User::confirmPassword($password, $confirm_password)) {
            $errors[] = 'Пароли не совподают';
        }
        if (User::checkEmailExists($email)) {
            $errors[] = 'Такой email уже используется';
        }

        if ($errors === false) {
            // Если ошибок нет
            // Регистрируем пользователя
            $userId = User::register($name, $email, $password);
            User::auth($userId);
            $data["success"] = true;
            $data["message"] = "You are registered!";

        } else {
            $data["success"] = false;
            $data["errors"] = $errors;
        }

        echo json_encode($data);
        return true;
    }

    /**
     * Action для страницы "Вход на сайт"
     */
    public function actionLogin()
    {
        // Получаем данные из формы
        $email = htmlspecialchars($_POST['email']);
        $password = htmlspecialchars($_POST['password']);
        $remember = $_POST['remember'];

        // Флаг ошибок
        $errors = false;
        // array to pass back data
        $data = false;

        // Валидация полей
        if (!User::checkEmail($email)) {
            $errors[] = 'Неправильный email';
        }
        if (!User::checkPassword($password)) {
            $errors[] = 'Пароль не должен быть короче 6-ти символов';
        }

        if ($errors != false)
        {
            $data["success"] = false;
            $data["errors"] = $errors;
        }
        else
        {
            // Проверяем существует ли пользователь
            $userId = User::checkUserData($email, $password);

            if ($userId == false) {
                // Если данные неправильные - показываем ошибку
                $errors[] = 'Неправильные данные для входа на сайт';
                $data["success"] = false;
                $data["errors"] = $errors;
            }
            else {
                // Если данные правильные, запоминаем пользователя (сессия)
                User::auth($userId, $remember);
                $data["success"] = true;
                $data["message"] = "Success!";
            }
        }

        echo json_encode($data);
        return true;
    }

    /**
     * Удаляем данные о пользователе из сессии
     */
    public function actionLogout()
    {
        if (isset($_COOKIE["user"]))
        {
            setcookie("user", 1, time() - 1, "/");
        }
        // Удаляем информацию о пользователе из сессии
        unset($_SESSION["user"]);

        // Перенаправляем пользователя на главную страницу
        header("Location: /");
        return true;
    }

}
