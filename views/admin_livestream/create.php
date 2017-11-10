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
                        Update <small>Livestream</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin/livestream"><i class="fa fa-edit"></i> LiveStream</a>
                        </li>
                        <li class="active">
                            Update LiveStream
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
                        <form role="form" action="" method="post">
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="title">Livestream Title</label>
                                    <input type="text" name="title" class="form-control" id="title">
                                </div>

                                <div class="form-group">
                                    <label>Visibility</label>
                                    <select class="form-control" name="visibility">
                                        <option selected>public</option>
                                        <option>private</option>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label>Video Iframe</label>
                                    <textarea class="form-control" name="html" rows="3" ></textarea>
                                </div>

                                <div class="form-group">
                                    <label>Livestream Description</label>
                                    <textarea class="form-control" name="description" rows="3"></textarea>
                                </div>

                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" name="create_livestream" class="btn btn-primary">Update Article</button>
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
