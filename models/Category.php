<?php
    class Category
    {
        public static function getCategoriesList()
        {
            $db = Db::getConnection();
            $sql = "SELECT * FROM categories ORDER BY id";
            $result = $db->query($sql);
            $categoryList = $result->fetchAll();

            return $categoryList;
        }

        public static function checkCategoryForMatches($categoryList, $articleCategoryId)
        {
            foreach($categoryList as $category)
            {
                if ($category["id"] == $articleCategoryId)
                {
                    $cat = $category;
                    return $cat;
                }
            }
            return false;
        }

        /**
         * Удаляет товар с указанным id
         * @param integer $id <p>id товара</p>
         * @return boolean <p>Результат выполнения метода</p>
         */
        public static function deleteCategorieById($id)
        {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            $sql = 'DELETE FROM categories WHERE id = :id';

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            return $result->execute();
        }

        public static function createCategory($title)
        {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            $sql = "INSERT INTO categories (title) VALUES (:title)";

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':title', $title, PDO::PARAM_STR);

            if ($result->execute()) {
                // Если запрос выполенен успешно, возвращаем id добавленной записи
                return $db->lastInsertId();
            }
            // Иначе возвращаем 0
            return 0;
        }

        public static function updateCategorieById($id, $title)
        {
            // Соединение с БД
            $db = Db::getConnection();

            // Текст запроса к БД
            $sql = "UPDATE categories SET title = :title WHERE id = :id";

            // Получение и возврат результатов. Используется подготовленный запрос
            $result = $db->prepare($sql);
            $result->bindParam(':id', $id, PDO::PARAM_INT);
            $result->bindParam(':title', $title, PDO::PARAM_STR);

            return $result->execute();
        }
    }