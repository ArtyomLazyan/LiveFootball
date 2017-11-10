<?php
    class Article
    {
        const SHOW_BY_DEFAULT = 6;

        /**
         * return array latest Articles
         */
        public static function getLatestArticles($limit = self::SHOW_BY_DEFAULT)
        {
            $db = Db::getConnection();

            $sql = "SELECT * FROM articles ORDER BY id DESC LIMIT :limit";
            $result = $db->prepare($sql);
            $result->bindParam(":limit", $limit, PDO::PARAM_INT);
            $result->execute();
            $latestArticles = $result->fetchAll();

            return $latestArticles;
        }

        public static function getArticlesListByCategory($categoryId, $limit = self::SHOW_BY_DEFAULT, $page = 1)
        {
            // Смещение (для запроса)
            $offset = ($page - 1) * $limit;

            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            $sql = "SELECT * FROM articles WHERE category_id = :category_id ORDER BY id DESC LIMIT :limit OFFSET :offset";

            // Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':category_id', $categoryId, PDO::PARAM_INT);
            $result->bindParam(':limit', $limit, PDO::PARAM_INT);
            $result->bindParam(':offset', $offset, PDO::PARAM_INT);

            // Выполнение коменды
            $result->execute();
            $articlesByCategory = $result->fetchAll();

            // if articles exists then return else 404 page
            if ($articlesByCategory)
            {
                return $articlesByCategory;
            }
            else {
                header("Location: /404");
                return false;
            }
        }

        public static function getTotalArticlesInCategory($categoryId = 0)
        {
            $db = Db::getConnection();

            $sql = "SELECT count(id) AS count FROM articles WHERE category_id = :category_id";
            $result = $db->prepare($sql);
            $result->bindParam(":category_id", $categoryId, PDO::PARAM_INT);
            $result->execute();

            $row = $result->fetch();
            return $row["count"];
        }

        public static function getArticleById($id)
        {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            $sql = 'SELECT * FROM articles WHERE id = :id';

            // Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);

            // Указываем, что хотим получить данные в виде массива
            $result->setFetchMode(PDO::FETCH_ASSOC);

            // Выполнение коменды
            $result->execute();
            $article = $result->fetch();

            // if article exists then return $article else 404 page
            if ($article)
            {
                return $article;
            }
            else
            {
                header("Location: /404");
                return false;
            }

        }

        public static function topReadableArticles($limit = self::SHOW_BY_DEFAULT)
        {
            $db = Db::getConnection();
            $sql = "SELECT * FROM articles ORDER BY views DESC LIMIT :limit";
            $result = $db->prepare($sql);
            $result->bindParam(":limit", $limit, PDO::PARAM_INT);
            $result->execute();
            $topReadableArticles = $result->fetchAll();

            return $topReadableArticles;
        }

        public static function topRatesArticles($limit = self::SHOW_BY_DEFAULT)
        {
            $db = Db::getConnection();
            $sql = "SELECT * FROM articles ORDER BY rate DESC LIMIT :limit";
            $result = $db->prepare($sql);
            $result->bindParam(":limit", $limit, PDO::PARAM_INT);
            $result->execute();
            $topRatesArticles = $result->fetchAll();

            return $topRatesArticles;
        }

        public static function getCommentsByArticleId($articleId, $limit = self::SHOW_BY_DEFAULT)
        {
            $db = Db::getConnection();
            $sql = "SELECT * FROM comments WHERE articles_id = :articleId ORDER BY id DESC LIMIT :limit";
            $result = $db->prepare($sql);
            $result->bindParam(":articleId", $articleId, PDO::PARAM_INT);
            $result->bindParam(":limit", $limit, PDO::PARAM_INT);
            $result->execute();
            $comments = $result->fetchAll();

            return $comments;
        }

        public static function getLatestComments($limit = self::SHOW_BY_DEFAULT)
        {
            $db = Db::getConnection();
            $sql = "SELECT * FROM comments ORDER BY id DESC LIMIT :limit";
            $result = $db->prepare($sql);
            $result->bindParam(":limit", $limit, PDO::PARAM_INT);
            $result->execute();
            $comments = $result->fetchAll();

            return $comments;
        }
    }
