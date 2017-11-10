<?php require ROOT . "/views/layouts/header.php" ?>
<section id="mainContent">
    <div class="content_bottom">
        <div class="col-lg-12 col-md-12">
            <div class="content_bottom_left">
                <div class="single_category wow fadeInDown">
                    <div class="archive_style_1">
                        <div class="archive_style_1">
                            <h2> <span class="bold_line"><span></span></span> <span class="solid_line"></span> <span class="title_text" href="#">Ուղիղ Հեռարձակումներ</span> </h2>

                            <?php foreach ($livestream as $liveList) : ?>
                                <div class="business_category_left">
                                    <ul class="small_catg wow fadeInDown">
                                        <li>
                                            <div class="media wow fadeInDown"> <a class="media-left" href="/livestream/<?=$liveList["id"]; ?>"><img src="/includes/img/livestream.jpg" alt="LiveFootball" class="live_img"></a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"><a href="/livestream/<?=$liveList["id"]; ?>">
                                                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                                                            <?=$liveList["title"]; ?> <span class="live">ՈՒղիղ</span> </a></h4>
                                                    <div class="comments_box"><span class="meta_comment"><a href="/article/<?=$liveList["id"]; ?>">0 Comments</a></span> </div>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="pagination_area">
                <nav>
                    <?php echo $pagination->get(); ?>
                </nav>
            </div>
        </div>
    </div>
</section>
</div>
<?php require ROOT . "/views/layouts/footer.php" ?>
