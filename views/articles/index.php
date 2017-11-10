<?php require ROOT . "/views/layouts/header.php" ?>
<section id="mainContent">
<div class="content_bottom">
  <div class="col-lg-8 col-md-8">
    <div class="content_bottom_left">
      <div class="single_category wow fadeInDown">
        <div class="archive_style_1">
          <div style="margin-top:15px;">
          </div>
          <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text">Все записи</span> </h2>
          <?php foreach ($articles as $catList) : ?>
              <div class="business_category_left wow fadeInDown">
                <ul class="fashion_catgnav">
                  <li>
                    <div class="catgimg2_container"> <a href="/article/<?=$catList["id"]; ?>">
                        <img alt="<?=$catList["title"]; ?>" title="<?=$catList["title"]; ?>" src="<?php echo Article::getImage($catList["id"]); ?>"></a> </div>
                    <h2 class="catg_titile"><a href="/article/<?=$catList["id"]; ?>"><?=$catList["title"]; ?></a></h2>
                    <div class="comments_box">
                        <span class="meta_date"><?=$catList["pubdate"]; ?></span>
                        <span class="meta_comment"><a href="/article/<?=$catList["id"]; ?>">0 Comments</a></span>
                        <span class="meta_more"><a  href="/article/<?=$catList["id"]; ?>">Read More...</a></span>
                    </div>
                    <p style='float:left'><?php echo substr($catList["text"], 0, 100); ?></p>
                  </li>
                </ul>
              </div>
          <?php endforeach; ?>
      </div>
      </div>
    </div>
    <div class="pagination_area">
      <nav>
        <?php echo $pagination->get(); ?>
      </nav>
    </div>
  </div>

    <div class="col-lg-4 col-md-4">
        <?php Article::showLeagueTable($categoryId); ?>
    </div>

</div>
</section>
</div>
<?php require ROOT . "/views/layouts/footer.php" ?>
