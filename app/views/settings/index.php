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
            <h3 class="text-themecolor">Settings</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)"></a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item active">Settings</li>
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
    <div class="container-fluid" id="app">

        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card card-body">
                    <?php include_once "../app/views/layouts/controller_validation.php";  ?>
                    <form action="<?= PUBLIC_PATH ?>enviroment/store"  method="post" >
                        <div class="form-row">
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Time Delay From Database (In Second) :</label>
                                    <input type="text" class="form-control" name="time_delay" value=" <?= $data['settings']->time_delay ?>" >
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6">
                                <div class="form-group">
                                    <label>Refresh Rate (In Second):</label>
                                    <input type="text" class="form-control" name="refresh_rate" value="<?= $data['settings']->refresh_rate ?>" >
                                </div>
                            </div>
                            <button class="btn btn-md btn-primary">Sumbit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->

    <script src="<?= PUBLIC_PATH ?>js/dashboard.js"></script>
    <?php
    include_once '../app/views/layouts/footer.php';
    ?>