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
                        Category <small>Update</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li>
                            <a href="/admin/categorie"><i class="fa fa-table"></i> Categorie</a>
                        </li>
                        <li class="active">
                            Update Categorie
                        </li>
                    </ol>
                </div>
            </div>
            <!-- /.row -->

            <div class="row">
                <div class="col-lg-12">
                    <div class="alert alert-info alert-dismissable">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                        <i class="fa fa-info-circle"></i>  <strong>Like SB Admin?</strong> Try out <a href="http://startbootstrap.com/template-overviews/sb-admin-2" class="alert-link">SB Admin 2</a> for additional features!
                    </div>
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
                                    <label for="title">Category Title</label>
                                    <input type="text" name="title" class="form-control" id="title" value="<?php $cat = Category::checkCategoryForMatches($categoryList, $id); echo $cat['title'];?>">
                                </div>
                                <!-- /.box-body -->
                                <div class="box-footer">
                                    <button type="submit" name="update_categorie" class="btn btn-primary">Update Category</button>
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

