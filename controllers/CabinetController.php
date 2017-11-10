<?php

/**
 * Контроллер CabinetController
 * Кабинет пользователя
 */
class CabinetController
{

    /**
     * Action для страницы "Кабинет пользователя"
     */
    public function actionIndex()
    {
        $categoryList = Category::getCategoriesList();
        $latestArticles = Article::getLatestArticles(4);
        $topReadableArticles = Article::topReadableArticles(4);
        $comments = Article::getLatestComments();

        // Получаем идентификатор пользователя из сессии
        $userId = User::checkLogged();
        // Получаем информацию о пользователе из БД
        $user = User::getUserById($userId);

        $title = "Cabinet - ArmProgramming";
        $description = "Բոլոր հոդվածները ";

        // Подключаем вид
        require_once(ROOT . '/views/cabinet/index.php');
        return true;
    }

}
