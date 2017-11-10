<?php

class Livestream
{
    const SHOW_BY_DEFAULT = 6;

    /**
     * return array latest Livestream
     */
    public static function getLatestLivestream($limit = self::SHOW_BY_DEFAULT)
    {
        $db = Db::getConnection();

        $sql = "SELECT * FROM livestream ORDER BY id DESC LIMIT :limit";
        $result = $db->prepare($sql);
        $result->bindParam(":limit", $limit, PDO::PARAM_INT);
        $result->execute();
        $latestLivestream = $result->fetchAll();

        return $latestLivestream;
    }

    public static function getLivestreamList($page = 1, $limit = self::SHOW_BY_DEFAULT)
    {
        // Смещение (для запроса)
        $offset = ($page - 1) * $limit;

        if ($offset < 0) {
            header("Location: /404");
            return false;
        }

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "SELECT * FROM livestream ORDER BY id DESC LIMIT :limit OFFSET :offset";

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();
        $latestLivestream = $result->fetchAll();

        // if articles exists then return else 404 page
        if ($latestLivestream) {
            return $latestLivestream;
        } else {

            header("Location: /404");
            return false;
        }
    }

    public static function getTotalLivestream()
    {
        $db = Db::getConnection();

        $sql = "SELECT count(id) AS count FROM livestream";
        $result = $db->prepare($sql);
        $result->execute();

        $row = $result->fetch();
        return $row["count"];
    }

    public static function getLivestreamById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'SELECT * FROM livestream WHERE id = :id';

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);

        // Указываем, что хотим получить данные в виде массива
        $result->setFetchMode(PDO::FETCH_ASSOC);

        // Выполнение коменды
        $result->execute();
        $livestream = $result->fetch();

        // if article exists then return else 404 page
        if ($livestream) {
            return $livestream;
        }
    }

    public static function topReadableLivestream($limit = self::SHOW_BY_DEFAULT)
    {
        $db = Db::getConnection();
        $sql = "SELECT * FROM livestream ORDER BY views DESC LIMIT :limit";
        $result = $db->prepare($sql);
        $result->bindParam(":limit", $limit, PDO::PARAM_INT);
        $result->execute();
        $topReadableLivestream = $result->fetchAll();

        return $topReadableLivestream;
    }

    public static function deleteLivestreamById($id)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM livestream WHERE id = :id';

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        return $result->execute();
    }


    /**
     * Добавляет новый товар
     * @param array $options <p>Массив с информацией о товаре</p>
     * @return integer <p>id добавленной в таблицу записи</p>
     */
    public static function createLivestream($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "INSERT INTO livestream (title, html, description) VALUES (:title, :html, :description)";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':html', $options['html'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    public static function updateLivestreamById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "UPDATE livestream SET title = :title, html = :html, description = :description WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':html', $options['html'], PDO::PARAM_STR);
        $result->bindParam(':description', $options['description'], PDO::PARAM_STR);

        return $result->execute();
    }

    public static function viewsIncrement($livestream_id)
    {
        $db = Db::getConnection();

        $sql = "UPDATE livestream SET views = views + 1 WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(":id", $livestream_id, PDO::PARAM_INT);

        return $result->execute();

    }
}
