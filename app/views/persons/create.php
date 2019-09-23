<?php
include_once '../app/views/layouts/header.php';
include_once '../app/views/layouts/sidebar.php';

?>



<!-- ============================================================== -->
<!-- Page wrapper  -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->
    <div class="row page-titles">
        <div class="col-md-5 align-self-center">
            <h3 class="text-themecolor">Users</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)"></a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item active">Users</li>
                <li class="breadcrumb-item active">Create</li>
            </ol>
        </div>
        <!-- <div>
            <button class="right-side-toggle waves-effect waves-light btn-inverse btn btn-circle btn-sm pull-right m-l-10"><i class="ti-settings text-white"></i></button>
        </div> -->
    </div>
    <!-- ============================================================== -->
    <!-- End Bread crumb and right sidebar toggle -->
    <!-- ============================================================== -->


<!-- ============================================================== -->
<!-- Container fluid  -->
<!-- ============================================================== -->
<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <!-- Row -->
    <div class="row">
        <div class="col-md-12 col-lg-12 col-xlg-12">
            <div class="card card-body">
                <?php include_once '../app/views/layouts/controller_validation.php' ?>
                <div class="row ">
                    <div class="col-md-12 col-lg-12 ">
                        <div class="row" style="margin-bottom:30px;">
                            <div class="col-md-6 col-lg-6 col-xs-6">
                                <h3 class="box-title m-b-0 ">Create User</h3>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6 text-right">
                                <a href="<?= PUBLIC_PATH ?>person/index" class="btn btn-warning  btn-sm">Back</a>
                            </div>
                        </div>
                        <form action="<?= PUBLIC_PATH ?>person/store" method="post" enctype="multipart/form-data">
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" required name="first_name" value="<?php echo isset($_POST["first_name"]) ? $_POST["first_name"] : ''; ?>" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" required  name="last_name" value="<?php echo isset($_POST["last_name"]) ? $_POST["last_name"] : ''; ?>" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>User Name</label>
                                            <input type="text" class="form-control" required  name="user_name" value="<?php echo isset($_POST["user_name"]) ? $_POST["user_name"] : ''; ?>" placeholder="User Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control" required  name="password" value="<?php echo isset($_POST["password"]) ? $_POST["password"] : ''; ?>"  placeholder="Password">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" required  name="email" value="<?php echo isset($_POST["email"]) ? $_POST["email"] : ''; ?>" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="card" style="width: 18rem;">
                                        <img src="<?= PUBLIC_PATH ?>assets/images/users/5.jpg" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <input type="file" name="avatar" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-md btn-primary">Store</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Page Content -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Container fluid  -->
<!-- ============================================================== -->

<?php
include_once '../app/views/layouts/footer.php';
include_once '../app/views/layouts/errors.php';
?>