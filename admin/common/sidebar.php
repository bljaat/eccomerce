<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="<?php echo SITE_URL ?>admin/pages/dashboard.php" class="brand-link">
        <img src="<?php echo ADMIN_ASSET ?>dist/img/credit\footer.webp" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
    </a>
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?php echo ADMIN_ASSET ?>dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">

                    <?php
                    $select = "SELECT * FROM users WHERE `id`='" . $_SESSION['user']['id'] . "'";
                    $data = mysqli_query($conn, $select);
                    $row  = mysqli_fetch_assoc($data);
                    ?>
                    <h3><?php echo $row['full_name'] ?></h3>


                </a>

                </a>
            </div>
        </div>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            User Modul
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/user/userlist.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>User List</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/user/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>

                                <p>Add user</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/pages/logout.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>

                                <p>logout</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/Category/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/Category/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Sub Category
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/subCategory/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Sub Category</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/subCategory/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Sub Category</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            Brand
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/brands/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Brand list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/brands/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add brand</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Product
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/product/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>product list</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/product/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add product</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Aterbute
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/attribute/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Aterbute</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/attribute/add.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Add Aterbute</p>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-columns"></i>
                        <p>
                            Banner
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="<?php echo SITE_URL ?>admin/banner/index.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Banner</p>
                            </a>
                        </li>
                        
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</aside>


<div class="content-wrapper">




    <style>
        .img-circle {
            border-radius: 0%;
        }

        .elevation-3 {
            box-shadow: 0 0px 0px rgba(0, 0, 0, 0), 0 0px 0px rgba(0, 0, 0, 0) !important;
        }
    </style>