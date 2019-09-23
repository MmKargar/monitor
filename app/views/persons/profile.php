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
            <h3 class="text-themecolor">Profile</h3>
        </div>
        <div class="col-md-7 align-self-center">
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="javascript:void(0)"></a>
                </li>
                <li class="breadcrumb-item active">Dashboard</li>
                <li class="breadcrumb-item active">Profile</li>

                </li>
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
                <div class="col-lg-12 col-xlg-12 col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <center class="m-t-30"> <img src="<?= PUBLIC_PATH ?>storage/<?= $data['user']->avatar ?>" class="img-circle" width="150">
                                <h4 class="card-title m-t-10"><?= $data['user']->user_name ?></h4>
                                <h6 class="card-subtitle"><?= $_SESSION['fullname'] ?></h6>                          
                            </center>
                        </div>
                        <div>
                            <hr>
                        </div>
                        <div class="card-body"> <small class="text-muted">Email address </small>
                            <h6><?=  $data['user']->email ?></h6> 
                            <!-- <small class="text-muted p-t-30 db">Phone</small> -->
                            <!-- <h6>+91 654 784 547</h6> <small class="text-muted p-t-30 db">Address</small> -->
                            <!-- <h6>71 Pilgrim Avenue Chevy Chase, MD 20815</h6> -->
                            <!-- <small class="text-muted p-t-30 db">Social Profile</small> -->
                            <!-- <br> -->
                            <!-- <button class="btn btn-circle btn-secondary"><i class="fa fa-facebook"></i></button> -->
                            <!-- <button class="btn btn-circle btn-secondary"><i class="fa fa-twitter"></i></button> -->
                            <!-- <button class="btn btn-circle btn-secondary"><i class="fa fa-youtube"></i></button> -->
                            <br>
                            <form action="<?=  PUBLIC_PATH ?>person/edit/<?= $_SESSION['user_id'] ?>">
                                <button  class="btn btn-md btn-primary" >Edit</button>
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
    ?>


    <script>
        //Warning Message
        function remove(id) {
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this User!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, Remove It!",
                closeOnConfirm: false
            }, function() {
                var mydata = {
                    'id': id
                }
                $.ajax({
                    type: "POST",
                    url: "<?= PUBLIC_PATH ?>person/destroy",
                    data: mydata,
                    success: function() {
                        swal("Deleted!", "Your User has been Removed.", "success");
                        location.reload();
                    },
                    dataType: 'json'
                });
            });
        }
    </script>