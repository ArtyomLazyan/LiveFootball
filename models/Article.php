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
        if ($articlesByCategory) {
            return $articlesByCategory;
        } else {
            header("Location: /404");
            return false;
        }
    }

    public static function getArticlesList($page = 1, $limit = self::SHOW_BY_DEFAULT)
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
        $sql = "SELECT * FROM articles ORDER BY id DESC LIMIT :limit OFFSET :offset";

        // Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':limit', $limit, PDO::PARAM_INT);
        $result->bindParam(':offset', $offset, PDO::PARAM_INT);

        // Выполнение коменды
        $result->execute();
        $articlesList = $result->fetchAll();

        // if articles exists then return else 404 page
        if ($articlesList) {
            return $articlesList;
        } else {

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

    public static function getTotalArticles()
    {
        $db = Db::getConnection();

        $sql = "SELECT count(id) AS count FROM articles";
        $result = $db->prepare($sql);
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

        // if article exists then return else 404 page
        if ($article) {
            return $article;
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

    /**
     * Удаляет товар с указанным id
     * @param integer $id <p>id товара</p>
     * @return boolean <p>Результат выполнения метода</p>
     */
    public static function deleteArticleById($id)
    {

        $image_name = Article::getImage($id);
        unlink($_SERVER['DOCUMENT_ROOT'] . "/" . $image_name);

        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = 'DELETE FROM articles WHERE id = :id';

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
    public static function createArticle($options)
    {
        // Соединение с БД
        $db = Db::getConnection();

        // Текст запроса к БД
        $sql = "INSERT INTO articles (title, text, video_iframe, category_id, visibility) VALUES (:title, :text, :video_iframe, :category_id, :visibility)";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':text', $options['text'], PDO::PARAM_STR);
        $result->bindParam(':video_iframe', $options['video_iframe'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':visibility', $options['visibility'], PDO::PARAM_STR);

        if ($result->execute()) {
            // Если запрос выполенен успешно, возвращаем id добавленной записи
            return $db->lastInsertId();
        }
        // Иначе возвращаем 0
        return 0;
    }

    public static function updateArticleById($id, $options)
    {
        // Соединение с БД
        $db = Db::getConnection();
        
        // Текст запроса к БД
        $sql = "UPDATE articles SET title = :title, text = :text, video_iframe = :video_iframe, category_id = :category_id, visibility = :visibility WHERE id = :id";

        // Получение и возврат результатов. Используется подготовленный запрос
        $result = $db->prepare($sql);
        $result->bindParam(':id', $id, PDO::PARAM_INT);
        $result->bindParam(':title', $options['title'], PDO::PARAM_STR);
        $result->bindParam(':text', $options['text'], PDO::PARAM_STR);
        $result->bindParam(':video_iframe', $options['video_iframe'], PDO::PARAM_STR);
        $result->bindParam(':category_id', $options['category_id'], PDO::PARAM_INT);
        $result->bindParam(':visibility', $options['visibility'], PDO::PARAM_STR);


        return $result->execute();
    }

    /**
     * Возвращает путь к изображению
     * @param integer $id
     * @return string <p>Путь к изображению</p>
     */
    public static function getImage($id)
    {
        // Название изображения-пустышки
        $noImage = 'no-image.png';

        // Путь к папке с товарами
        $path = '/upload/post_images/';

        // Путь к изображению товара
        $pathToProductImage = $path . $id . '.jpg';

        if (file_exists($_SERVER['DOCUMENT_ROOT'] . $pathToProductImage)) {
            // Если изображение для товара существует
            // Возвращаем путь изображения товара
            return $pathToProductImage;
        }

        // Возвращаем путь изображения-пустышки
        return $path . $noImage;
    }

    public static function viewsIncrement($article_id)
    {
        $db = Db::getConnection();

        $sql = "UPDATE articles SET views = views + 1 WHERE id = :id";
        $result = $db->prepare($sql);
        $result->bindParam(":id", $article_id, PDO::PARAM_INT);

        return $result->execute();

    }

    public static function showLeagueTable($categoryId = 0)
    {
        if ($categoryId == 1) {
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="570" src="https://www.fctables.com/spain/liga-bbva/iframe/?type=table&lang_id=2&country=201&template=43&team=179755&timezone=Asia/Yerevan&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="360" src="https://www.fctables.com/spain/liga-bbva/iframe=/?type=top-scorers&lang_id=2&country=201&template=43&team=179755&timezone=Asia/Yerevan&time=24&limit=10&ppo=1&pte=1&pgo=1&pma=1&pas=1&ppe=1&width=360&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>
';
        }
        else if ($categoryId == 2)
        {
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="570" src="https://www.fctables.com/england/premier-league/iframe/?type=table&lang_id=2&country=67&template=10&timezone=Asia/Yerevan&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=550&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="360" src="https://www.fctables.com/england/premier-league/iframe=/?type=top-scorers&lang_id=2&country=67&template=10&team=&timezone=Asia/Yerevan&time=24&limit=10&ppo=1&pte=1&pgo=1&pma=1&pas=1&ppe=1&width=360&height=320&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
        }
        else if ($categoryId == 3)
        {
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="530" src="https://www.fctables.com/germany/1-bundesliga/iframe/?type=table&lang_id=2&country=83&template=16&team=&timezone=Asia/Yerevan&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="360" src="https://www.fctables.com/germany/1-bundesliga/iframe=/?type=top-scorers&lang_id=2&country=83&template=16&team=&timezone=Asia/Yerevan&time=24&limit=10&ppo=1&pte=1&pgo=1&pma=1&pas=1&ppe=1&width=360&height=320&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
        }
        else if ($categoryId == 4)
        {
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="560" src="https://www.fctables.com/france/ligue-1/iframe/?type=table&lang_id=2&country=77&template=15&timezone=Asia/Yerevan&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="360" src="https://www.fctables.com/france/ligue-1/iframe=/?type=top-scorers&lang_id=2&country=77&template=15&team=&timezone=Asia/Yerevan&time=24&limit=10&ppo=1&pte=1&pgo=1&pma=1&pas=1&ppe=1&width=360&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
        }
        else if ($categoryId == 5)
        {
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="560" src="https://www.fctables.com/italy/serie-a/iframe/?type=table&lang_id=2&country=108&template=17&team=&timezone=Asia/Yerevan&time=24&po=1&ma=1&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="360" src="https://www.fctables.com/italy/serie-a/iframe=/?type=top-scorers&lang_id=2&country=108&template=17&team=&timezone=Asia/Yerevan&time=24&limit=10&ppo=1&pte=1&pgo=1&pma=1&pas=1&ppe=1&width=360&height=700&font=Verdana&fs=12&lh=22&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=FFFFFF&thc=000000&bc=dddddd&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27AE60&hfc=FFFFFF"></iframe>';
        }
        else if ($categoryId == 6)
        {
            echo '<iframe src="http://www.tablesleague.com/iframe?width=360&height=160&font_name=Tahoma&position=1&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=0&form=0&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=27ae60&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=1&league=l_248&team=&timezone=4&language=2&team_flags=1" width="360" height=160 frameborder="0" scrolling="no"></iframe>';
            echo '<iframe src="http://www.tablesleague.com/iframe?width=360&height=160&font_name=Tahoma&position=1&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=0&form=0&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=27ae60&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=1&league=l_247&team=&timezone=4&language=2&team_flags=1" width="360" height=160 frameborder="0" scrolling="no"></iframe>';
            echo '<iframe src="http://www.tablesleague.com/iframe?width=360&height=160&font_name=Tahoma&position=1&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=0&form=0&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=27ae60&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=1&league=l_249&team=&timezone=4&language=2&team_flags=1" width="360" height=160 frameborder="0" scrolling="no"></iframe>';
            echo '<iframe src="http://www.tablesleague.com/iframe?width=360&height=160&font_name=Tahoma&position=1&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=0&form=0&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=27ae60&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=1&league=l_250&team=&timezone=4&language=2&team_flags=1" width="360" height=160 frameborder="0" scrolling="no"></iframe>';
            echo '<iframe src="http://www.tablesleague.com/iframe?width=360&height=160&font_name=Tahoma&position=1&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=0&form=0&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=27ae60&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=1&league=l_251&team=&timezone=4&language=2&team_flags=1" width="360" height=160 frameborder="0" scrolling="no"></iframe>';
            echo '<iframe src="http://www.tablesleague.com/iframe?width=360&height=160&font_name=Tahoma&position=1&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=0&form=0&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=27ae60&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=1&league=l_252&team=&timezone=4&language=2&team_flags=1" width="360" height=160 frameborder="0" scrolling="no"></iframe>';
            echo '<iframe src="http://www.tablesleague.com/iframe?width=360&height=160&font_name=Tahoma&position=1&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=0&form=0&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=27ae60&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=1&league=l_253&team=&timezone=4&language=2&team_flags=1" width="360" height=160 frameborder="0" scrolling="no"></iframe>';
            echo '<iframe src="http://www.tablesleague.com/iframe?width=360&height=160&font_name=Tahoma&position=1&font_size=12&team_link=0&link_color=404040&games=1&wins=1&draws=1&lost=1&goals=1&goals_against=1&gd=1&points=1&next=0&form=0&font_size=12&font_color=000000&bg_color=FFFFFF&header_font_color=FFFFFF&header_bg_color=27ae60&bg_col=1fb9e4&font_color_col=FFFFFF&highlight=e3e3e3&hover=fff6bf&league_header=1&league=l_254&team=&timezone=4&language=2&team_flags=1" width="360" height=160 frameborder="0" scrolling="no"></iframe>';
            echo '<iframe frameborder="0"  scrolling="no" width="360" height="250" src="https://www.fctables.com/championsleague/iframe=/?type=top-scorers&lang_id=2&country=5&timezone=Asia/Yerevan&time=24&limit=10&ppo=1&pte=1&pgo=1&pma=1&pas=1&ppe=1&width=360&height=250&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae5f&hfc=f2e9f2"></iframe>';
        }
        else if ($categoryId == 10)
        {
            echo '<p>Group A</p><iframe frameborder="0"  scrolling="no" width="360" height="140" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5821&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=140&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&scfs=22&scfc=333333&scb=1&sclg=1&teamls=80&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
            echo '<p>Group B</p><iframe frameborder="0"  scrolling="no" width="360" height="140" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5822&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=140&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
            echo '<p>Group C</p><iframe frameborder="0"  scrolling="no" width="360" height="140" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5823&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=140&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
            echo '<p>Group D</p><iframe frameborder="0"  scrolling="no" width="360" height="140" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5824&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=140&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
            echo '<p>Group E</p><iframe frameborder="0"  scrolling="no" width="360" height="140" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5825&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=140&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
            echo '<p>Group F</p><iframe frameborder="0"  scrolling="no" width="360" height="140" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5826&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=140&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
            echo '<p>Group G</p><iframe frameborder="0"  scrolling="no" width="360" height="140" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5827&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=140&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
            echo '<p>Group H</p><iframe frameborder="0"  scrolling="no" width="360" height="140" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5828&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=140&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
            echo '<p>Group I</p><iframe frameborder="0"  scrolling="no" width="360" height="160" src="https://www.fctables.com/worldcupqualificationeu/iframe/?type=table&lang_id=2&country=689&stage=5829&timezone=Asia/Yerevan&time=24&po=0&ma=0&wi=1&dr=1&los=1&gf=1&ga=1&gd=1&pts=1&ng=0&form=0&width=360&height=160&font=Tahoma&fs=12&lh=14&bg=FFFFFF&fc=333333&logo=1&tlink=0&ths=1&thb=1&thba=ede4ed&thc=000000&bc=0a0a0a&hob=f5f5f5&hobc=ebe7e7&lc=333333&sh=1&hfb=1&hbc=27ae60&hfc=f2e9f2"></iframe>';
        }
    }


}
