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
                        Articles
                        <small>control</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li class="active">
                            <i class="fa fa-edit"></i> Articles
                        </li>
                    </ol>
                </div>
            </div>

            <a href="/admin/article/create" class="pull-right">
                <button class="btn btn-primary">Add Article</button>
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
                                <th>Date</th>
                                <th>Category</th>
                                <th>Views</th>
                                <th>Edit</th>
                                <th>Delete</th>
                            </tr>
                            <?php foreach ($articlesList as $articles) : ?>
                                <tr>
                                    <td><?= $articles["id"]; ?></td>
                                    <td><a href="/article/<?= $articles["id"]; ?>"
                                           target="_blank"><?= $articles["title"]; ?></a></td>
                                    <td><?= $articles["pubdate"]; ?></td>
                                    <td>
                                        <span class="label label-success"><?php $cat = Category::checkCategoryForMatches($categoryList, $articles["category_id"]);
                                            echo $cat["title"]; ?></span></td>
                                    <td><?= $articles["views"]; ?></td>
                                    <td>
                                        <a href="/admin/article/update/<?= $articles['id']; ?>" title="Редактировать"><i
                                                    class="fa fa-pencil-square-o"></i></a>
                                    </td>
                                    <td>
                                        <a href="/admin/article/delete/<?= $articles['id']; ?>" title="Удалить"><i
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

