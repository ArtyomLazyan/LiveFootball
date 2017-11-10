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
                        Livestream
                        <small>control</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-edit"></i> Livestream
                        </li>
                    </ol>
                </div>
            </div>

            <a href="/admin/livestream/create" class="pull-right">
                <button class="btn btn-primary">Add Livestream</button>
            </a>
            <br><br>

            <div class="row">
                <div class="col-lg-12">
                    <table class="table table-hover">
                        <table class="table table-hover">
                            <tbody>
                            <tr>
                                <th>ID</th>
                                <th>Title</th>
                                <th>Views</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php foreach ($livestream as $live) : ?>
                                <tr>
                                    <td><?= $live["id"]; ?></td>
                                    <td><a href="/livestream/<?= $live["id"]; ?>"
                                           target="_blank"><?= $live["title"]; ?></a></td>
                                    <td><?= $live["views"]; ?></td>
                                    <td>
                                        <a href="/admin/livestream/update/<?= $live['id']; ?>" title="Редактировать"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                    <td>
                                        <a href="/admin/livestream/delete/<?= $live['id']; ?>" title="Удалить"><i
                                                    class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                        <div class="pagination_area pull-right">
                            <nav>
                                <?php echo $pagination->get(); ?>
                            </nav>
                        </div>
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

