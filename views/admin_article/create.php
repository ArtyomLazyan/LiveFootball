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
                            Create Articles
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
                                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label for="video_iframe">Video Iframe</label>
                                    <input type="text" name="video_iframe" class="form-control" id="video_iframe" placeholder="Enter title">
                                </div>
                                <div class="form-group">
                                    <label for="picture">Article Picture</label>
                                    <input type="file" name="image" id="picture" >
                                    <p class="help-block">Choose picture for article.</p>
                                </div>
                                <div class="form-group">
                                    <label>Select Category</label>
                                    <select class="form-control" name="category_id">
                                        <?php for ($i = 0; $i < count($categoryList); $i++) { ?>
                                            <option value="<?=$i+1; ?>"><?=$categoryList[$i]["title"]; ?></option>
                                        <?php } ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Visibility</label>
                                    <select class="form-control" name="visibility">
                                        <option selected>public</option>
                                        <option>private</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Article text</label>
                                    <textarea class="form-control" name="text" rows="3" placeholder="Enter ..."></textarea>
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" name="create_article" class="btn btn-primary">Add Article</button>
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
