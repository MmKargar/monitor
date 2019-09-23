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
                <li class="breadcrumb-item active">Update</li>
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
                                <h3 class="box-title m-b-0 ">Update User</h3>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6 text-right">
                                <a href="<?= PUBLIC_PATH ?>person/index" class="btn btn-warning  btn-sm">Back</a>
                            </div>
                        </div>
                        <form action="<?= PUBLIC_PATH ?>person/update" method="post" enctype="multipart/form-data" autocomplete="off" >
                            <input type="hidden" autocomplete="off">
                            <?php  $user = $data['user'] ;?>
                            <div class="row">
                                <div class="col-lg-8 col-md-8 col-xs-12">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <input type="hidden" value="<?= $user->id ?>"  name="id">
                                            <label>First Name</label>
                                            <input type="text" class="form-control" required name="first_name" value="<?= $user->first_name ?>" placeholder="First Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Last Name</label>
                                            <input type="text" class="form-control" required  name="last_name" value="<?= $user->last_name ?>" placeholder="Last Name">
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>User Name</label>
                                            <input type="text" class="form-control" required  name="user_name" disabled value="<?= $user->user_name ?>" placeholder="User Name">
                                        </div>
                                        <div class="form-group col-md-6">
                                            <label>Password</label>
                                            <input type="password" class="form-control"   name="password" value=""  autocomplete="off"  placeholder="">
                                            <small > if you don't  want to change the password , leave it blank.</small>
                                        </div>
                                    </div>
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
                                            <label>Email</label>
                                            <input type="email" class="form-control" required  name="email" value="<?= $user->email ?>" placeholder="Email">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-4 col-md-4 col-xs-12">
                                    <div class="card" style="width: 18rem;">
                                        <?php  
                                            $src = PUBLIC_PATH.'assets/images/users/5.jpg';
                                            ($user->avatar) ? $src = PUBLIC_PATH.'storage/'.$user->avatar : '';
                                        ?>
                                        <img src="<?= $src ?>" class="card-img-top" alt="...">
                                        <div class="card-body">
                                            <input type="file" name="avatar" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <button class="btn btn-md btn-primary">Update</button>
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