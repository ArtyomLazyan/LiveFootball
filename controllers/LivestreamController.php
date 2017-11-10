<?php
class LivestreamController
{
    public function actionIndex($page = 1)
    {
        $categoryList = Category::getCategoriesList();
        $latestArticles = Article::getLatestArticles(4);
        //$topReadableArticles = Article::getArticlesListByCategory(4);

        $total = Livestream::getTotalLivestream();

        $livestream = Livestream::getLivestreamList($page, 6);

        // Создаем объект Pagination - постраничная навигация
        $pagination = new Pagination($total, $page, Livestream::SHOW_BY_DEFAULT, 'page-');

        $title = "Football LiveStream";
        $description = "Բոլոր հոդվածները";

        require_once ROOT . "/views/livestream/index.php";
        return true;

    }

    public function actionView($livestreamId)
    {
        $livestreamId = (int)$livestreamId;
        $categoryList = Category::getCategoriesList();
        $livestream = Livestream::getLivestreamById($livestreamId);
        $latestLiveStream = Livestream::getLatestLivestream(3);


        $latestArticles = Article::getLatestArticles(4);
        $topReadableArticles = Article::topReadableArticles(4);

        $comments = Article::getLatestComments();

        Livestream::viewsIncrement($livestream["id"]);


        $title = $livestream["title"];
        $description = "LiveFootball" . $livestream["title"];

        require_once ROOT . "/views/livestream/view.php";
        return true;
    }
}
