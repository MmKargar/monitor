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
            <div class="card card-body">
                <?php include_once '../app/views/layouts/controller_validation.php' ?>
                <div class="row ">
                    <div class="col-md-12 col-lg-12 ">
                        <div class="row" style="margin-bottom:30px;">
                            <div class="col-md-6 col-lg-6 col-xs-6">
                                <h3 class="box-title m-b-0 ">Users</h3>
                            </div>
                            <div class="col-md-6 col-lg-6 col-xs-6 text-right">
                                <a href="<?= PUBLIC_PATH ?>person/create" class="btn btn-sm btn-success">Create</a>
                            </div>
                        </div>
                        <div style="overflow-x:scroll">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col">Id</th>
                                        <th scope="col">Avatar</th>
                                        <th scope="col">FirstName</th>
                                        <th scope="col">LastName</th>
                                        <th scope="col">UserName</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Created At</th>
                                        <th scope="col">Updated At</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($data['users'] as $user) {

                                        ?>
                                        <tr>
                                            <td><?= $user->id ?></td>
                                            <td>
                                                <img src="<?= PUBLIC_PATH ?>storage/<?= ($user->avatar) ? $user->avatar : 'users/avatar.jpg'  ?>" width="40" alt="">
                                            </td>
                                            <td><?= $user->first_name ?></td>
                                            <td><?= $user->last_name ?></td>
                                            <td><?= $user->user_name ?></td>
                                            <td><?= $user->email ?></td>
                                            <td><?= $user->created_at ?></td>
                                            <td><?= $user->updated_at ?></td>
                                            <td class="text-nowrap">
                                                <a href="<?= PUBLIC_PATH ?>/person/edit/<?= $user->id ?>" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                                <a style="cursor:pointer"  onclick="remove(<?= $user->id ?>)" data-toggle="tooltip" data-original-title="Remove"> <i class="fa fa-close text-danger"></i></a>
                                            </td>
                                        </tr>
                                    <?php
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- logs table -->
                        <!-- <table class="table">
                            <thead>
                                <tr>
                                    <th scope="col">id</th>
                                    <th scope="col">log time</th>
                                    <th scope="col">global irradiation</th>
                                    <th scope="col">wind speed</th>
                                    <th scope="col">pv temp</th>
                                    <th scope="col">ambient temp</th>
                                    <th scope="col">total power</th>
                                    <th scope="col">average power</th>
                                    <th scope="col">average voltage</th>
                                    <th scope="col">total yield</th>
                                    <th scope="col">messages</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>Mark</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>Otto</td>
                                    <td>@mdo</td>
                                    <td class="text-nowrap">
                                        <a href="#" data-toggle="tooltip" data-original-title="Edit"> <i class="fa fa-pencil text-inverse m-r-10"></i> </a>
                                        <a href="#" data-toggle="tooltip" data-original-title="Close"> <i class="fa fa-close text-danger"></i> </a>
                                    </td>
                                </tr>
                            </tbody>
                        </table> -->
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
                'id' : id
            }
            $.ajax({
                type: "POST",
                url: "<?= PUBLIC_PATH ?>person/destroy"  ,
                data: mydata,
                success: function(){
                    swal("Deleted!", "Your User has been Removed.", "success");
                    location.reload();
                },
                dataType: 'json'
            });
        });
    }
</script>