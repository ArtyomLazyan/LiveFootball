<?php
    class SiteController {
        public function actionIndex()
        {
            $categoryList = Category::getCategoriesList();
            $latestArticles = Article::getLatestArticles(4);
            $topReadableArticles = Article::topReadableArticles(4);
            $comments = Article::getLatestComments();

            /* Articles by Category for main page (1 - articles_id, 2 - limit); */
            $category1 = Article::getArticlesListByCategory(1, 2);
            $category2 = Article::getArticlesListByCategory(2, 2);
            $category3 = Article::getArticlesListByCategory(3, 4);
            $category4 = Article::getArticlesListByCategory(4, 3);
            $category5 = Article::getArticlesListByCategory(5, 3);
            $category6 = Article::getArticlesListByCategory(6, 4);
            $category7 = Article::getArticlesListByCategory(7, 4);

            // description for seo
            $title = "Ֆուտբոլային հանդիպումներ. ուղիղ եթեր ֊ LiveFootball";
            $description = "Դիտեք ֆուտբոլ ուղիղ եթերում ֊ LiveFootball";

            require_once ROOT . "/views/site/index.php";
            return true;
        }

        public function actionAbout()
        {
            $categoryList = Category::getCategoriesList();
            $latestArticles = Article::getLatestArticles(4);
            $topReadableArticles = Article::topReadableArticles(4);
            $comments = Article::getLatestComments();

            $title = "Մեր մասին ֊ LiveFootball";
            $description = "Մեր մասին ֊ LiveFootball";

            require_once ROOT . "/views/site/about.php";
            return true;
        }

        public function actionLive()
        {
            $categoryList = Category::getCategoriesList();
            $latestArticles = Article::getLatestArticles(4);
            $topReadableArticles = Article::topReadableArticles(4);
            $comments = Article::getLatestComments();

            $title = "Ֆուտբոլային հաշիվներ օնլայն ֊ LiveFootball";
            $description = "Դիտեք Ֆուտբոլային հաշիվներ օնլայն ֊ LiveFootball";

            require_once ROOT . "/views/site/live.php";
            return true;
        }

        public function actionLivestream()
        {
            $categoryList = Category::getCategoriesList();
            $latestArticles = Article::getLatestArticles(4);
            $topReadableArticles = Article::topReadableArticles(4);
            $comments = Article::getLatestComments();

            $title = "Ֆուտբոլային հանդիպումներ. ուղիղ եթեր ֊ LiveFootball";
            $description = "Դիտեք ֆուտբոլ ուղիղ եթերում ֊ LiveFootball";

            require_once ROOT . "/views/site/livestream.php";
            return true;
        }

        public function actionContact()
        {
            $categoryList = Category::getCategoriesList();

            $title = "Հետադարձ կապ ֊ LiveFootball";
            $description = "Հետադարձ կապ ֊ LiveFootball";

            require_once ROOT . "/views/site/contact.php";
            return true;
        }

        public function actionNotFound()
        {
            $categoryList = Category::getCategoriesList();

            $title = "404 Page Not Found";
            $description = "Այդպիսի էջ գոյություն չունի";

            require_once ROOT . "/views/404/404.php";
            return true;
        }

        public function actionAccessDenied()
        {
            $categoryList = Category::getCategoriesList();

            $title = "403 AccessDe";
            $description = "Այդպիսի էջ գոյություն չունի";

            require_once ROOT . "/views/403/403.php";
            return true;
        }

        public function actionEmail()
        {

            //Script Foreach
            $c = true;

            $project_name = trim($_POST["project_name"]);
            $admin_email = trim($_POST["admin_email"]);
            $form_subject = trim($_POST["form_subject"]);
            $message = false;

            foreach ($_POST as $key => $value)
            {
                if ($value != "" && $key != "project_name" && $key != "admin_email" && $key != "form_subject")
                {
                            $message .= "
                    " . (($c = !$c) ? '<tr>' : '<tr style="background-color: #f8f8f8;">') . "
                        <td style='padding: 10px; border: #e9e9e9 1px solid;'><b>$key</b></td>
                        <td style='padding: 10px; border: #e9e9e9 1px solid;'>$value</td>
                    </tr>
                    ";
                }
            }

            $message = "<table style='width: 100%;'>$message</table>";

            function adopt($text)
            {
                return '=?UTF-8?B?' . Base64_encode($text) . '?=';
            }

            $headers = "MIME-Version: 1.0" . PHP_EOL .
                "Content-Type: text/html; charset=utf-8" . PHP_EOL .
                'From: ' . adopt($project_name) . ' <' . $admin_email . '>' . PHP_EOL .
                'Reply-To: ' . $admin_email . '' . PHP_EOL;

            mail($admin_email, adopt($form_subject), $message, $headers);

            return true;
        }
    }
