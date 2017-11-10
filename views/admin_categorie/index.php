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
                        Categories <small>Control</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-table"></i> Categories
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

            <a href="/admin/categorie/create" class="pull-right">
                <button class="btn btn-primary">Add Categorie</button>
            </a>
            <br><br>

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-hover">
                        <tbody>
                        <tr>
                            <th>ID</th>
                            <th>Title</th>
                        </tr>
                        <?php foreach( $categoryList as $categorie ) : ?>
                            <tr>
                                <td><?=$categorie["id"]; ?></td>
                                <td><a href="/articles/<?=$categorie["id"]; ?>" target="_blank"><?=$categorie["title"]; ?></a></td>
                                <td>
                                    <a href="/admin/categorie/update/<?=$categorie['id']; ?>" title="Редактировать"><i class="fa fa-pencil-square-o"></i></a>
                                </td>
                                <td>
                                    <a href="/admin/categorie/delete/<?=$categorie['id']; ?>" title="Удалить"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody></table>
                </div>
            </div>
            <!-- /.row -->


        </div>
        <!-- /.container-fluid -->

    </div>
    <!-- /#page-wrapper -->

</div>
<!-- /#wrapper -->
<?php require ROOT . "/views/layouts/admin_foooter.php"; ?>
