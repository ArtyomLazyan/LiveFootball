<?php require ROOT . "/views/layouts/header.php"; ?>
<section id="mainContent">
    <div class="content_top">
      <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="latest_slider">
            <div class="slick_slider">
              <?php foreach($latestArticles as $latest) : ?>
                <div class="single_iteam"><img src="<?php echo Article::getImage($latest["id"]); ?>" alt="<?=$latest["title"]; ?>" title="<?=$latest["title"]; ?>">
                  <h2><a class="slider_tittle" href="/article/<?=$latest["id"]; ?>"><?=$latest["title"]; ?></a></h2>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-12">
          <div class="content_top_right">
            <ul class="featured_nav wow fadeInDown">
                <?php foreach ($topReadableArticles as $topArticles) : ?>
                  <li><img src="<?php echo Article::getImage($topArticles["id"]); ?>" alt="<?=$topArticles["title"]; ?>" title="<?=$topArticles["title"]; ?>">
                    <div class="title_caption"><a href="/article/<?=$topArticles["id"]; ?>"><?=$topArticles["title"]; ?></a></div>
                  </li>
                <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="content_middle">
      <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="content_middle_leftbar">
          <div class="single_category wow fadeInDown">
            <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <a href="/articles/1" class="title_text"><?php $cat = Category::checkCategoryForMatches($categoryList, 1); echo $cat["title"];?></a> </h2>
            <ul class="catg1_nav">
                <?php foreach ($category1 as $articleBycategory) : ?>
                  <li>
                    <div class="catgimg_container"> <a href="/article/<?=$articleBycategory["id"]; ?>" class="catg1_img"><img alt="<?=$articleBycategory["title"]; ?>" src="<?php echo Article::getImage($articleBycategory["id"]); ?>" title="<?=$articleBycategory["title"]; ?>"></a></div>
                    <h3 class="post_titile"><a href="/article/<?=$articleBycategory["id"]; ?>"><?=$articleBycategory["title"]; ?></a></h3>
                  </li>
                <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
      <div class="col-lg-6 col-md-6 col-sm-6">
        <div class="content_middle_middle">
          <div class="slick_slider2">
             <?php foreach ($category7 as $topArticles) : ?>
                <div class="single_featured_slide"> <a href="/article/<?=$topArticles["id"]; ?>">
                    <img src="<?php echo Article::getImage($topArticles["id"]); ?>" alt="<?=$topArticles["title"]; ?>" title="<?=$topArticles["title"]; ?>"></a>
                  <h2><a href="/article/<?=$topArticles["id"]; ?>"><?=$topArticles["title"]; ?></a></h2>
                  <p><?php echo substr($topArticles["text"], 0, 150); ?></p>
                </div>
            <?php endforeach; ?>

          </div>
        </div>
      </div>
      <div class="col-lg-3 col-md-3 col-sm-3">
        <div class="content_middle_rightbar">
          <div class="single_category wow fadeInDown">
            <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <a href="/articles/2" class="title_text"><?php $cat = Category::checkCategoryForMatches($categoryList, 2); echo $cat["title"];?></a> </h2>
            <ul class="catg1_nav">
                <?php foreach ($category2 as $articleBycategory) : ?>
                  <li>
                    <div class="catgimg_container"> <a href="/article/<?=$articleBycategory["id"]; ?>" class="catg1_img"><img alt="<?=$articleBycategory["title"]; ?>" src="<?php echo Article::getImage($articleBycategory["id"]); ?>" title="<?=$articleBycategory["title"]; ?>"></a></div>
                    <h3 class="post_titile"><a href="/article/<?=$articleBycategory["id"]; ?>"><?=$articleBycategory["title"]; ?></a></h3>
                  </li>
                <?php endforeach; ?>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <div class="content_bottom">
      <div class="col-lg-8 col-md-8">
        <div class="content_bottom_left">
          <div class="single_category wow fadeInDown">
            <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <a class="title_text" href="/articles/3"><?php $cat = Category::checkCategoryForMatches($categoryList, 3); echo $cat["title"];?></a> </h2>
            <div class="business_category_left wow fadeInDown">
              <ul class="fashion_catgnav clearfix">
                <li>
                  <div class="catgimg2_container"> <a href="/article/<?=$category3[0]["id"]; ?>">
                      <img alt="<?=$category3[0]["title"]; ?>" src="<?php echo Article::getImage($category3[0]["id"]); ?>" title="<?=$category3[0]["title"]; ?>"></a></div>
                  <h2 class="catg_titile"><a href="/article/<?=$category3[0]["id"]; ?>"><?=$category3[0]["title"]; ?></a></h2>
                  <div class="comments_box"> <span class="meta_date"><?=$category3[0]["pubdate"]; ?></span> <span class="meta_comment"><a href="/article/<?=$category3[0]["id"]; ?>#disqus_thread">0 Comments</a></span> <span class="meta_more"><a href="/article/<?=$category3[0]["id"]; ?>">Read More...</a></span> </div>
                  <p class="pull-left"><?php echo substr($category3[0]["text"], 0, 150); ?>......</p>
                </li>
              </ul>
            </div>
            <div class="business_category_right wow fadeInDown">
              <ul class="small_catg">
                  <?php for ($i = 1; $i < count($category3); $i++) : ?>
                    <li>
                      <div class="media wow fadeInDown"> <a class="media-left" href="/article/<?=$category3[$i]["id"]; ?>">
                          <img src="<?php echo Article::getImage($category3[$i]["id"]); ?>" alt="<?=$category3[$i]["title"]; ?>" title="<?=$category3[$i]["title"]; ?>">
                      </a>
                        <div class="media-body">
                          <h4 class="media-heading"><a href="/article/<?=$category3[$i]["id"]; ?>"><?=$category3[$i]["title"]; ?></a></h4>
                          <div class="comments_box"> <span class="meta_date"><?=$category3[$i]["pubdate"]; ?></span> <span class="meta_comment"><a href="/article/<?=$category3[$i]["id"]; ?>#disqus_thread">0 Comments</a></span> </div>
                        </div>
                      </div>
                    </li>
                  <?php endfor; ?>
              </ul>
            </div>
          </div>
          <div class="games_fashion_area">
            <div class="games_category">
              <div class="single_category">
                <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <a class="title_text" href="/articles/4"><?php $cat = Category::checkCategoryForMatches($categoryList, 4); echo $cat["title"];?></a> </h2>
                <ul class="fashion_catgnav wow fadeInDown clearfix">
                    <li>
                      <div class="catgimg2_container"> <a href="/article/<?=$category4[0]["id"]; ?>">
                          <img alt="<?=$category4[0]["title"]; ?>" src="<?php echo Article::getImage($category4[0]["id"]); ?>" title="<?=$category4[0]["title"]; ?>">
                        </a>
                      </div>
                      <h2 class="catg_titile"><a href="/article/<?=$category4[0]["id"]; ?>"><?=$category4[0]["title"]; ?></a></h2>
                      <div class="comments_box"> <span class="meta_date"><?=$category4[0]["pubdate"]; ?></span> <span class="meta_comment"><a href="/article/<?=$category4[0]["id"]; ?>#disqus_thread">0 Comments</a></span> <span class="meta_more"><a  href="/article/<?=$category4[0]["id"]; ?>">Read More...</a></span> </div>
                      <p class="pull-left"><?php echo substr($category4[0]["text"], 0, 150); ?>......</p>
                    </li>
                </ul>
                <ul class="small_catg wow fadeInDown">
                    <?php for ($i = 1; $i < count($category4); $i++) : ?>
                      <li>
                        <div class="media wow fadeInDown"> <a class="media-left" href="/article/<?=$category4[$i]["id"]; ?>">
                            <img src="<?php echo Article::getImage($category4[$i]["id"]); ?>" alt="<?=$category4[$i]["title"]; ?>" title="<?=$category4[$i]["title"]; ?>"></a>
                          <div class="media-body">
                            <h4 class="media-heading"><a href="/article/<?=$category4[$i]["id"]; ?>"><?=$category4[$i]["title"]; ?></a></h4>
                            <div class="comments_box"> <span class="meta_date"><?=$category4[$i]["pubdate"]; ?></span> <span class="meta_comment"><a href="/article/<?=$category3[$i]["id"]; ?>#disqus_thread">0 Comments</a></span> </div>
                          </div>
                        </div>
                      </li>
                    <?php endfor; ?>
                </ul>
              </div>
            </div>
            <div class="fashion_category">
              <div class="single_category">
                <div class="single_category wow fadeInDown">
                  <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <a class="title_text" href="/articles/5"><?php $cat = Category::checkCategoryForMatches($categoryList, 5); echo $cat["title"];?></a> </h2>
                  <ul class="fashion_catgnav wow fadeInDown clearfix">
                      <li>
                        <div class="catgimg2_container"> <a href="/article/<?=$category5[0]["id"]; ?>">
                            <img alt="<?=$category5[0]["title"]; ?>" src="<?php echo Article::getImage($category5[0]["id"]); ?>" title="<?=$category5[0]["title"]; ?>"></a> </div>
                        <h2 class="catg_titile"><a href="/article/<?=$category5[0]["id"]; ?>"><?=$category5[0]["title"]; ?></a></h2>
                        <div class="comments_box"> <span class="meta_date"><?=$category5[0]["pubdate"]; ?></span> <span class="meta_comment"><a href="/article/<?=$category5[0]["id"]; ?>#disqus_thread">0 Comments</a></span> <span class="meta_more"><a  href="/article/<?=$category5[0]["id"]; ?>">Read More...</a></span> </div>
                        <p class="pull-left"><?php echo substr($category5[0]["text"], 0, 150); ?>......</p>
                      </li>
                  </ul>
                  <ul class="small_catg wow fadeInDown">
                      <?php for ($i = 1; $i < count($category5); $i++) : ?>
                        <li>
                          <div class="media wow fadeInDown"> <a class="media-left" href="/article/<?=$category5[$i]["id"]; ?>">
                              <img src="<?php echo Article::getImage($category5[$i]["id"]); ?>" alt="<?=$category5[$i]["title"]; ?>" title="<?=$category5[$i]["title"]; ?>"></a>
                            <div class="media-body">
                              <h4 class="media-heading"><a href="/article/<?=$category5[$i]["id"]; ?>"><?=$category5[$i]["title"]; ?></a></h4>
                              <div class="comments_box"> <span class="meta_date"><?=$category5[$i]["pubdate"]; ?></span> <span class="meta_comment"><a href="/article/<?=$category5[$i]["id"]; ?>#disqus_thread">0 Comments</a></span> </div>
                            </div>
                          </div>
                        </li>
                      <?php endfor; ?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <div class="technology_catrarea">
            <div class="single_category">
              <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <a class="title_text" href="/articles/6"><?php $cat = Category::checkCategoryForMatches($categoryList, 6); echo $cat["title"];?></a> </h2>
              <div class="business_category_left">
                <ul class="fashion_catgnav wow fadeInDown clearfix">
                    <li>
                      <div class="catgimg2_container"> <a href="/article/<?=$category6[0]["id"]; ?>">
                          <img alt="<?=$category6[0]["title"]; ?>" src="<?php echo Article::getImage($category6[0]["id"]); ?>" title="<?=$category6[0]["title"]; ?>"></a> </div>
                      <h2 class="catg_titile"><a href="/article/<?=$category6[0]["id"]; ?>"><?=$category6[0]["title"]; ?></a></h2>
                      <div class="comments_box"> <span class="meta_date"><?=$category6[0]["pubdate"]; ?></span> <span class="meta_comment"><a href="/article/<?=$category6[0]["id"]; ?>#disqus_thread">0 Comments</a></span> <span class="meta_more"><a  href="/article/<?=$category6[0]["id"]; ?>">Read More...</a></span> </div>
                      <p class="pull-left"><?php echo substr($category6[0]["text"], 0, 150); ?>......</p>
                    </li>
                </ul>
              </div>
              <div class="business_category_right">
                <ul class="small_catg wow fadeInDown">
                    <?php for ($i = 1; $i < count($category6); $i++) : ?>
                      <li>
                        <div class="media wow fadeInDown"> <a class="media-left" href="/article/<?=$category6[$i]["id"]; ?>">
                            <img src="<?php echo Article::getImage($category6[$i]["id"]); ?>" alt="<?=$category6[$i]["title"]; ?>" title="<?=$category6[$i]["title"]; ?>"></a>
                          <div class="media-body">
                            <h4 class="media-heading"><a href="/article/<?=$category6[$i]["id"]; ?>"><?=$category6[$i]["title"]; ?></a></h4>
                            <div class="comments_box"> <span class="meta_date"><?=$category6[$i]["pubdate"]; ?></span> <span class="meta_comment"><a href="/article/<?=$category6[$i]["id"]; ?>#disqus_thread">0 Comments</a></span> </div>
                          </div>
                        </div>
                      </li>
                    <?php endfor; ?>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </div>
      <?php require ROOT . "/views/layouts/sidebar.php"; ?>
    </div>
  </section>
</div>
<?php require ROOT . "/views/layouts/footer.php"; ?>
