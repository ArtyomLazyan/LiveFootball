<?php require ROOT . "/views/layouts/admin_header.php"; ?>
<div id="wrapper">

    <!-- navbar -->
    <?php include ROOT . "/views/layouts/admin_navbar.php"; ?>
    <div id="page-wrapper">

        <div class="container-fluid">

            <!-- Page Heading -->
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">
                        Create <small>categorie</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin/article"><i class="fa fa-edit"></i> Articles</a>
                        </li>
                        <li class="active">
                            Update Articles
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-xs-6">
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">Fill in the fields</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="" method="post" enctype="multipart/form-data">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Article Title</label>
                                    <input type="text" name="title" class="form-control" id="title" value="<?=$article["title"]; ?>">
                                </div>

                                <div class="form-group">
                                    <label for="picture">Article Picture</label>
                                    <br>
                                    <img src="<?php echo Article::getImage($article["id"]); ?>" width="200" alt="" />
                                    <input type="file" name="image" id="picture" placeholder="" value="<?php echo $article['id'] . '.jpg'; ?>">
                                    <p class="help-block">Choose picture for article.</p>
                                </div>
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select class="form-control" name="category_id">
                                        <?php for ($i = 0; $i < count($categoryList); $i++) { ?>
                                            <option value="<?=$i+1; ?>"
                                                <?php if (($i + 1) == $article["category_id"])
                                                    echo 'selected = "selected"';
                                                ?>><?=$categoryList[$i]["title"]; ?>
                                            </option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Visibility</label>
                                    <select class="form-control" name="visibility">
                                        <?php if ($article["visibility"] == "public") : ?>
                                            <option selected>public</option>
                                            <option>private</option>
                                        <?php else : ?>
                                            <option selected>private</option>
                                            <option>public</option>
                                        <?php endif; ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Video Iframe</label>
                                    <textarea class="form-control" name="video_iframe" rows="3" ><?=$article["video_iframe"]; ?></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Article text</label>
                                    <textarea class="form-control" name="text" rows="3"><?=$article["text"]; ?></textarea>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" name="update_article" class="btn btn-primary">Update Article</button>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- /.box -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php require ROOT . "/views/layouts/admin_foooter.php"; ?>
