<ul class="nav navbar-nav side-nav">
    <li <?php if (isset($pageName) && $pageName == "Dashboard") { echo "class = 'active'"; } ?>>
        <a href="/admin"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
    </li>
    <li <?php if (isset($pageName) && $pageName == "Users") { echo "class = 'active'"; } ?>>
        <a href="/admin/users/page-1"><i class="fa fa-fw fa-user"></i> Users</a>
    </li>
    <li <?php if (isset($pageName) && $pageName == "Categorie") { echo "class = 'active'"; } ?>>
        <a href="/admin/categorie"><i class="fa fa-fw fa-table"></i> Categories</a>
    </li>
    <li <?php if (isset($pageName) && $pageName == "Articles") { echo "class = 'active'"; } ?>>
        <a href="/admin/article/page-1"><i class="fa fa-fw fa-edit"></i> Article</a>
    </li>
    <li <?php if (isset($pageName) && $pageName == "Livestream") { echo "class = 'active'"; } ?>>
        <a href="/admin/livestream/page-1"><i class="fa fa-fw fa-edit"></i> LiveStream</a>
    </li>
    <li>
        <a href="charts.html"><i class="fa fa-fw fa-bar-chart-o"></i> Charts</a>
    </li>
    <li>
        <a href="tables.html"><i class="fa fa-fw fa-table"></i> Tables</a>
    </li>
    <li>
        <a href="forms.html"><i class="fa fa-fw fa-edit"></i> Forms</a>
    </li>
    <li>
        <a href="bootstrap-elements.html"><i class="fa fa-fw fa-desktop"></i> Bootstrap Elements</a>
    </li>
    <li>
        <a href="bootstrap-grid.html"><i class="fa fa-fw fa-wrench"></i> Bootstrap Grid</a>
    </li>
    <li>
        <a href="javascript:;" data-toggle="collapse" data-target="#demo"><i class="fa fa-fw fa-arrows-v"></i> Dropdown <i class="fa fa-fw fa-caret-down"></i></a>
        <ul id="demo" class="collapse">
            <li>
                <a href="#">Dropdown Item</a>
            </li>
            <li>
                <a href="#">Dropdown Item</a>
            </li>
        </ul>
    </li>
    <li>
        <a href="blank-page.html"><i class="fa fa-fw fa-file"></i> Blank Page</a>
    </li>
    <li>
        <a href="index-rtl.html"><i class="fa fa-fw fa-dashboard"></i> RTL Dashboard</a>
    </li>
</ul>