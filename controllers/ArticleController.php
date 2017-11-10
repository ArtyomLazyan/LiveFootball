<?php
    class ArticleController
    {
        public function actionIndex($categoryId = 0, $page = 1)
        {
            $categoryList = Category::getCategoriesList();
            $latestArticles = Article::getLatestArticles(4);
            //$topReadableArticles = Article::getArticlesListByCategory(4);
            $comments = Article::getLatestComments();

            $total = Article::getTotalArticlesInCategory($categoryId);

            $articles = Article::getArticlesListByCategory($categoryId, 6, $page);

            // Создаем объект Pagination - постраничная навигация
            $pagination = new Pagination($total, $page, Article::SHOW_BY_DEFAULT, 'page-');

            // for meta description and title
            $cat = Category::checkCategoryForMatches($categoryList, $categoryId);
            $title = "{$cat['title']} - ArmProgramming";
            $description = "Բոլոր հոդվածները {$cat['title']}";

            require_once ROOT . "/views/articles/index.php";
            return true;

        }

        public function actionView($articleId)
        {
            $articleId = (int)$articleId;
            $categoryList = Category::getCategoriesList();
            $article = Article::getArticleById($articleId);
            $nextArticle = Article::getArticleById($articleId + 1);
            $previosArticle = Article::getArticleById($articleId - 1);
            $latestArticles = Article::getLatestArticles(4);
            $topReadableArticles = Article::topReadableArticles(4);
            $articlesListByCategory = Article::getArticlesListByCategory($article["category_id"], 3);
            $comments = Article::getLatestComments();

            Article::viewsIncrement($article["id"]);


            $title = $article["title"];
            $description = substr($article["text"], 0, 100);

            require_once ROOT . "/views/articles/view.php";
            return true;
        }

        public function actionComment($articleId)
        {
            $error = array();
            $db = Db::getConnection();

            /* ***** Validate name ***** */
            if (!isset($_POST["name"]) || strlen($_POST["name"]) <= 2)
            {
                $error[] = "Имя не должно быть короче 2 символов!";
            }

            /* ***** Validate email ***** */
            if (!filter_var($_POST["email"], FILTER_VALIDATE_EMAIL))
            {
                $error[] = "Неправильный емаил!";
            }

            /* ***** Validate text ***** */
            if (strlen($_POST["text"]) == 0)
            {
                $error[] = "Текст не должно быть пустым!";
            }

            /* ***** If error list is empty then add comment  ***** */
            if (empty($error))
            {
                $name = htmlspecialchars($_POST["name"]);
                $email = htmlspecialchars($_POST["email"]);
                $text = htmlspecialchars($_POST["text"]);
                $articleId = (int)$articleId;

                $sql = "INSERT INTO comments (name, email, text, articles_id) VALUES (:name, :email, :text, :articles_id)";
                $result = $db->prepare($sql);
                $result->bindParam(":name", $name, PDO::PARAM_STR);
                $result->bindParam(":email", $email, PDO::PARAM_STR);
                $result->bindParam(":text", $text, PDO::PARAM_STR);
                $result->bindParam(":articles_id", $articleId, PDO::PARAM_INT);

                if ($result->execute())
                {
                    echo "Coommenttt added";
                }
                else {
                    echo "<span style='color: red;'>Ошибка добавления комента</span><br>";
                }
            }
            else {
                $size = count($error);
                for ($i = 0; $i < $size; $i++)
                    echo "<span style='color: red;'>". array_shift($error) . "</span><br>";
            }

            return true;
        }


    }
