<?php require ROOT . "/views/layouts/header.php"; ?>
<section id="mainContent">
    <!-- Guest Modal-->
    <?php if (($livestream["visibility"] == "private") && User::isGuest()) : ?>
    <!--MESSAGE MODAL-->
    <div id="guest_modal" class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog">
        <div id="guest_message_modal" class="modal-content">
            <div class="modal-header">
                <a href="/"><h4 class="modal-title" id="gridSystemModalLabel">Գլխավոր էջ</h4></a>
            </div>
            <div id="message-content" class="modal-body clearfix">
                <h3 class="text-center">You need to register or log In</h3>
                <ul class="nav navbar-nav nav-modal">
                    <li><a class="cd-signin my-profile" href="#0"><i class="fa fa-lock"></i> Մուտք</a></li>
                    <li><a class="cd-signup my-profile" href="#0"><i class="fa fa-user"></i> Գրանցվել</a></li>
                </ul>
            </div>
        </div>
    </div>
    <!--END MESSAGE MODAL-->
</section>
    </div>
<?php else: ?>
    <div class="content_bottom">
        <div class="col-lg-8 col-md-8">
            <div class="content_bottom_left">
                <div class="single_page_area">
                    <ol class="breadcrumb">
                        <li><a href="/livestream">ՈՒղիղ հեռարձակում</a></li>
                        <li class="active">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                            <?=$livestream["title"]; ?></li>
                    </ol>
                    <h2 class="post_titile">
                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                        <?=$livestream["title"]; ?></h2>
                    <div class="single_page_content">
                        <div class="post_commentbox">
                            <span class="views pull-right">Դիտումներ <?=$livestream["views"];?></span>
                        </div>
                        <div class="img-center">
                            <?=$livestream["html"]; ?>
                        </div>
                        <?php
                         if (isset($livestream["description"]))
                            echo $livestream["description"];
                        ?>
                    </div>
                </div>
            </div>
            <div class="share_post">
                <a class="facebook" target="blank" href="https://www.facebook.com/sharer/sharer.php?u=http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>"><i class="fa fa-facebook"></i>Facebook</a>
                <a class="twitter" target="blank" href="http://www.twitter.com/intent/tweet?url=http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>&text=<?=$article['title']; ?>"><i class="fa fa-twitter"></i>Twitter</a>
                <a class="googleplus" target="blank" href="https://plus.google.com/share?hl=en-US&url=http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>"><i class="fa fa-google-plus"></i>Google+</a>
                <a class="linkedin" href="https://vk.com/share.php?url=http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" target="blank"><i class="fa fa-vk"  aria-hidden="true"></i>Vkontakte</a>
                <a class="odnoklassniki" href="https://connect.ok.ru/dk?st.cmd=WidgetSharePreview&st.shareUrl=http://<?php echo $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; ?>" target="blank"><i><img src="/includes/img/odno.svg" alt=""></i>Odnoklassniki</a>
            </div>
            <div class="similar_post">
                <h2>Similar Post You May Like <i class="fa fa-thumbs-o-up"></i></h2>
                <ul class="small_catg similar_nav wow fadeInDown animated">
                    <?php foreach ($latestLiveStream as $similarPost) : ?>
                        <li>
                            <div class="media wow fadeInDown animated" style="visibility: visible; animation-name: fadeInDown;"> <a class="media-left related-img" href="/article/<?=$similarPost["id"]; ?>">
                                    <img src="/includes/img/livestream.jpg" alt="<?=$similarPost["title"]; ?>" title="<?=$similarPost["title"]; ?>"></a>
                                <div class="media-body">
                                    <h4 class="media-heading"><a href="/article/<?=$similarPost["id"]; ?>"><?=$similarPost["title"]; ?></a></h4>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>

            <!-- Comments -->
            <div id="disqus_thread"></div>

        </div>
        <?php include ROOT . "/views/layouts/sidebar.php"?>
    </div>
    </section>
    </div>
<?php endif; ?>
<?php require ROOT . "/views/layouts/footer.php"; ?>
