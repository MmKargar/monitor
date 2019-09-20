<?php
    include_once '../app/views/layouts/header.php';
    include_once '../app/views/layouts/sidebar.php';

?>
    <!-- ============================================================== -->
    <!-- Container fluid  -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <!-- Row -->
        <div class="row">
            <div class="col-md-6 col-lg-6 col-xlg-4">
                <div class="card card-body">
                    <div class="row ">
                        <div class="col-md-12 col-lg-12 ">
                            <h3 class="box-title m-b-0 ">Messages</h3>
                            <address>
                                795 Folsom Ave, Suite 600 San Francisco, CADGE 94107
                            </address>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-6 col-xlg-4">
                <div class="card card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-12 ">
                            <h3 class="box-title m-b-0">Main Device Id</h3>
                            <div class="input-group">
                                <input type="text" class="form-control" value="192.168.1.241">

                                <div class="input-group-prepend">
                                    <button class="btn btn-success" type="button">Open All</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- content heading -->
        <div class="row text-center">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center text-center">
                            <div id="averagepower-chart" style="width:100%; height:190px"></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <!-- <div class=""><img src="<?= PUBLIC_PATH ?>assets/images/average_power.png" width="85" alt=""></div> -->
                            <div class="m-l-10 align-self-center text-center">
                                <h5 class="text-muted m-b-0">Average Power</h5>
                                <h3 class="m-b-0">22.905</h3>
                                <h6 class="text-muted m-b-0">KW</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center">
                            <div class=""><img src="<?= PUBLIC_PATH ?>assets/images/total_current.png" width="190" height="190" alt=""></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center text-center">
                            <div class="m-l-10 align-self-center justify-content-center">
                                <h5 class="text-muted m-b-0">Average Voltage</h5>
                                <h3 class="m-b-0">397.355</h3>
                                <h6 class="text-muted m-b-0">V</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->

            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center text-center">
                            <div id="totalpower-chart" style="width:100%; height:190px"></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <!-- <div class=""><img src="<?= PUBLIC_PATH ?>assets/images/total_power.png" width="85" alt=""></div> -->
                            <div class="m-l-10 align-self-center text-center">
                                <h5 class="text-muted m-b-0" style="text-align:center !important">Total Power</h5>
                                <h3 class="m-b-0" style="text-align:center !important">4870.44</h3>
                                <h6 class="text-muted m-b-0" style="text-align:center !important">A</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center text-center">
                            <div class="div" id="totalyield-chart" style="width:100%; height:190px;text-align: center !important;"></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <!-- <div class=""><img src="<?= PUBLIC_PATH ?>assets/images/total_yield.png" width="85" alt=""></div> -->
                            <div class="m-l-10 align-self-center text-center">
                                <h5 class="text-muted m-b-0">Total Yield</h5>
                                <h3 class="m-b-0">1744961</h3>
                                <h6 class="text-muted m-b-0">KWH</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>
        <div class="row">
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center text-center">
                            <div><img src="<?= PUBLIC_PATH ?>assets/images/global_irradiation.png" width="190" height="190" alt=""></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="m-l-10 align-self-center text-center">
                                <h5 class="text-muted m-b-0">Global Irradiation</h5>
                                <h3 class="m-b-0">347</h3>
                                <h6 class="text-muted m-b-0">W/m2</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center">
                            <div class=""><img src="<?= PUBLIC_PATH ?>assets/images/ambient_temp.png" width="190" height="190" alt=""></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center text-center">
                            <div class="m-l-10 align-self-center justify-content-center">
                                <h5 class="text-muted m-b-0">Ambient Temp</h5>
                                <h3 class="m-b-0">23.2</h3>
                                <h6 class="text-muted m-b-0">Celcius Degrees</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center">
                            <div class=""><img src="<?= PUBLIC_PATH ?>assets/images/celcius _degrees.png" width="190" height="190" alt=""></div>

                        </div>
                        <div class="d-flex flex-row justify-content-center">
                            <div class="m-l-10 align-self-center text-center justify-content-center">
                                <h5 class="text-muted m-b-0">PV Temp</h5>
                                <h3 class="m-b-0">30.7</h3>
                                <h6 class="text-muted m-b-0">Celcius Degrees</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->

            <!-- Column -->
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex flex-row justify-content-center">
                            <div class=""><img src="<?= PUBLIC_PATH ?>assets/images/wind_speed.png" width="190" height="190" alt=""></div>
                        </div>
                        <div class="d-flex flex-row justify-content-center text-center">
                            <div class="m-l-10 align-self-center justify-content-center">
                                <h5 class="text-muted m-b-0">Wind Speed</h5>
                                <h3 class="m-b-0">1</h3>
                                <h6 class="text-muted m-b-0">m/s</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Column -->
        </div>

        <!-- chart here -->
        <div class="row">
            <div class="col-lg-12 col-md-12">
                <div class="card">
                    <div class="card-body" style="padding: 0">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs customtab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#home" role="tab"> <span class="">Day</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#profile" role="tab"> <span class="">Month</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#messages" role="tab"> <span class="">Year</span></a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#messages4" role="tab"> <span class="">Total</span></a>
                            </li>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabcontent-border">
                            <div class="tab-pane active" id="home" role="tabpanel">
                                <canvas id="myChart"></canvas>
                                <div class="row d-flex flex-row justify-content-center">
                                    <button class="btn btn-xs btn-success" style="border-radius:5xp 0 0 5px"><i class="mdi mdi-skip-backward" style="font-size:1.5em"></i></button>
                                    <div>
                                        <input type="text" class="form-control text-center" value="4/6/2018" style="max-width: 100px">
                                    </div>
                                    <button class="btn btn-xs btn-success" style="border-radius:0 5px 5px 0"><i class="mdi mdi-skip-forward" style="font-size:1.5em"></i></button>
                                </div>
                            </div>
                            <div class="tab-pane  p-20" id="profile" role="tabpanel">
                                <canvas id="myChart1"></canvas>
                                <div class="row d-flex flex-row justify-content-center">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row justify-content-center">
                                            <button class="btn btn-xs btn-success" style="border-radius:5xp 0 0 5px"><i class="mdi mdi-skip-backward" style="font-size:1.5em"></i></button>
                                            <div>
                                                <select name="month" id="" class="form-control"> 
                                                        <option value="2019">January</option>
                                                        <option value="2018">February</option>
                                                        <option value="2017">March</option>
                                                        <option selected value="2016">April</option>
                                                        <option value="2016">May</option>
                                                        <option value="2016">June</option>
                                                        <option value="2016">July</option>
                                                        <option value="2016">August</option>
                                                        <option value="2016">September</option>
                                                        <option value="2016">October</option>
                                                        <option value="2016">November</option>
                                                        <option value="2016">December</option>
                                                    </select>
                                            </div>
                                            <div>
                                                <select name="year" id="" class="form-control"> 
                                                        <option value="2019">2019</option>
                                                        <option value="2018">2018</option>
                                                        <option value="2017">2017</option>
                                                        <option value="2016">2016</option>
                                                    </select>
                                            </div>

                                            <button class="btn btn-xs btn-success" style="border-radius:0 5px 5px 0"><i class="mdi mdi-skip-forward" style="font-size:1.5em"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="messages" role="tabpanel">
                                <canvas id="myChart2"></canvas>
                                <div class="row d-flex flex-row justify-content-center">
                                    <div class="col-lg-12 col-md-12">
                                        <div class="row justify-content-center">
                                            <button class="btn btn-xs btn-success" style="border-radius:5xp 0 0 5px"><i class="mdi mdi-skip-backward" style="font-size:1.5em"></i></button>
                                            <div>
                                                <select name="year" id="" class="form-control"> 
                                                    <option value="2019">2019</option>
                                                    <option value="2018">2018</option>
                                                    <option value="2017">2017</option>
                                                    <option value="2016">2016</option>
                                                </select>
                                            </div>
                                            <button class="btn btn-xs btn-success" style="border-radius:0 5px 5px 0"><i class="mdi mdi-skip-forward" style="font-size:1.5em"></i></button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane p-20" id="messages4" role="tabpanel">
                                <canvas id="myChart3"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- End Right sidebar -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Container fluid  -->
    <!-- ============================================================== -->
    
<?php
    include_once '../app/views/layouts/footer.php';
?>