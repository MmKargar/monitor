
    <!-- ============================================================== -->
    <!-- footer -->
    <!-- ============================================================== -->
    <footer class="footer"> Solar Monitoring@<?= date('Y' , time()) ?> </footer>
    <!-- ============================================================== -->
    <!-- End footer -->
    <!-- ============================================================== -->
</div>
<!-- ============================================================== -->
<!-- End Page wrapper  -->
<!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- End Wrapper -->
    <!-- ============================================================== -->
    <!-- ============================================================== -->
    <!-- All Jquery -->
    <!-- ============================================================== -->
    <script src="<?= PUBLIC_PATH ?>assets/plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap tether Core JavaScript -->
    <script src="<?= PUBLIC_PATH ?>assets/plugins/bootstrap/js/popper.min.js"></script>
    <script src="<?= PUBLIC_PATH ?>assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <!-- slimscrollbar scrollbar JavaScript -->
    <script src="<?= PUBLIC_PATH ?>js/jquery.slimscroll.js"></script>
    <!--Wave Effects -->
    <script src="<?= PUBLIC_PATH ?>js/waves.js"></script>
    <!--Menu sidebar -->
    <script src="<?= PUBLIC_PATH ?>js/sidebarmenu.js"></script>
    <!--stickey kit -->
    <script src="<?= PUBLIC_PATH ?>assets/plugins/sticky-kit-master/dist/sticky-kit.min.js"></script>
    <!--Custom JavaScript -->
    <script src="<?= PUBLIC_PATH ?>js/custom.min.js"></script>
    <!-- ============================================================== -->
    <!-- This page plugins -->
    <script src="<?= PUBLIC_PATH ?>js/dashboard1.js"></script>
    <!-- ============================================================== -->
    <!--sparkline JavaScript -->
    <script src="<?= PUBLIC_PATH ?>assets/plugins/sparkline/jquery.sparkline.min.js"></script>
    <!--morris JavaScript -->
    <script src="<?= PUBLIC_PATH ?>assets/plugins/raphael/raphael-min.js"></script>
    <script src="<?= PUBLIC_PATH ?>assets/plugins/morrisjs/morris.min.js"></script>

    <!-- ============================================================== -->
    <!-- charts -->
    <!-- <script src="<?= PUBLIC_PATH ?>assets/plugins/echarts/echarts-all.js"></script>
    <script src="<?= PUBLIC_PATH ?>assets/plugins/echarts/echarts-init.js"></script> -->
    <!-- ============================================================== -->
    <!-- Style switcher -->
    <!-- ============================================================== -->
    <!-- <script src="<?= PUBLIC_PATH ?>assets/plugins/styleswitcher/jQuery.style.switcher.js"></script> -->

    <!-- chart.js -->

    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var chart = new Chart(ctx, {
            // The type of chart we want to create
            type: 'line',

            // The data for our dataset
            data: {
                labels: ['1:00 AM',
                    '1:00 AM',
                    '2:00 AM',
                    '3:00 AM',
                    '4:00 AM',
                    '5:00 AM',
                    '6:00 AM',
                    '7:00 AM',
                    '8:00 AM',
                    '9:00 AM',
                    '10:00 AM',
                    '11:00 AM',
                    '12:00 PM',
                    '1:00 PM',
                    '2:00 PM',
                    '3:00 PM',
                    '4:00 PM',
                    '5:00 PM',
                    '6:00 PM',
                    '7:00 PM',
                    '8:00 PM',
                    '9:00 PM',
                    '10:00 PM',
                    '11:00 PM',
                    '12:00 AM',
                ],
                datasets: [{
                    label: 'Average Voltage',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        0,
                        20,
                        20,
                        200,
                        300,
                        1000,
                        580,
                        2000,
                        1000,
                        1500,
                        300,
                        20,
                        0,
                    ]
                }]
            },

            // Configuration options go here
            options: {}
        });

        // chart 1
        var ctx = document.getElementById('myChart1').getContext('2d');
        var chart1 = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',
            // The data for our dataset
            data: {
                labels: [
                    '4/1/18',
                    '4/2/18',
                    '4/3/18',
                    '4/4/18',
                    '4/5/18',
                    '4/6/18',
                    '4/7/18',
                    '4/8/18',
                    '4/9/18',
                    '4/10/18',
                    '4/11/18',
                    '4/12/18',
                    '4/13/18',
                    '4/14/18',
                    '4/15/18',
                    '4/16/18',
                    '4/17/18',
                    '4/18/18',
                    '4/19/18',
                    '4/20/18',
                    '4/21/18',
                    '4/22/18',
                    '4/23/18',
                    '4/24/18',
                    '4/25/18',
                    '4/26/18',
                    '4/27/18',
                    '4/28/18',
                    '4/29/18',
                    '4/30/18',

                ],
                datasets: [{
                    label: 'Average Power',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [
                        13,
                        5,
                        8,
                        10,
                        10,
                        18,
                        10,
                        17,
                        10,
                        5,
                        10,
                        15,
                        10,
                        7,
                        10,
                        3,
                        12,
                        13,
                        10,
                        8,
                        10,
                        12,
                        10,
                        5,
                        2,
                        9,
                        10,
                        2,
                        13,
                        15,
                    ]
                }]
            },

            // Configuration options go here
            options: {}
        });
        // end chart1

        // chart 2
        var ctx = document.getElementById('myChart2').getContext('2d');
        var chart2 = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ['Jan 19', 'Feb 19', 'Mar 19', 'Apr 19', 'May 19', 'Jun 19', 'Jul 19', 'Aug 19', 'Sep 19', 'Oct 19', 'Nov 19', 'Dec 19'],
                datasets: [{
                    label: 'Total Yield',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [150, 50, 80, 0, 0, 0, 0, 0, 0, 0, 0, 0]
                }]
            },

            // Configuration options go here
            options: {}
        });
        // end chart2 

        // chart 3
        var ctx = document.getElementById('myChart3').getContext('2d');
        var chart3 = new Chart(ctx, {
            // The type of chart we want to create
            type: 'bar',

            // The data for our dataset
            data: {
                labels: ['2018', '2019'],
                datasets: [{
                    label: 'Average Voltage',
                    backgroundColor: 'rgb(255, 99, 132)',
                    borderColor: 'rgb(255, 99, 132)',
                    data: [3000, 250]
                }]
            },

            // Configuration options go here
            options: {}
        });
        // end chart 3
    </script>

    <!-- gauge chart scripts -->
    <script src="<?= PUBLIC_PATH ?>assets/plugins/echarts/echarts-all.js"></script>
    <script>
        // average power
        var averagepower = echarts.init(document.getElementById('averagepower-chart'));

        // specify chart configuration item and data
        option = {
            tooltip: {
                formatter: "{a} <br/>{b} : {c}%"
            },
            toolbox: {
                show: false,
                feature: {
                    restore: {
                        show: true
                    },
                    saveAsImage: {
                        show: true
                    }
                }
            },

            series: [{
                // name: 'Average Power',
                type: 'gauge',
                detail: {
                    formatter: '{value}%'
                },
                data: [{
                    value: 90,
                    // name: 'Average Power'
                }],
                axisLine: { // 坐标轴线
                    lineStyle: { // 属性lineStyle控制线条样式
                        color: [
                            [0.1, '#f62d51'],
                            [0.3, '#009efb'],
                            [1, '#55ce63']
                        ],
                        width: 8,
                        height: 2
                    }
                },
                axisTick: { // 坐标轴小标记
                    splitNumber: 10, // 每份split细分多少段
                    length: 12, // 属性length控制线长
                    lineStyle: { // 属性lineStyle控制线条样式
                        color: 'auto'
                    }
                },
                axisLabel: { // 坐标轴文本标签，详见axis.axisLabel
                    textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                        color: 'auto'
                    }
                },
                splitLine: { // 分隔线
                    show: true, // 默认显示，属性show控制显示与否
                    length: 15, // 属性length控制线长
                    lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                        color: 'white'
                    }
                },

            }]
        };

        // use configuration item and data specified to show chart
        averagepower.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    averagepower.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });


        // total power

        // average power
        var totalpower = echarts.init(document.getElementById('totalpower-chart'));

        // specify chart configuration item and data
        option = {
            tooltip: {
                formatter: "{a} <br/>{b} : {c}%"
            },
            toolbox: {
                show: false,
                feature: {
                    restore: {
                        show: true
                    },
                    saveAsImage: {
                        show: true
                    }
                }
            },

            series: [{
                // name: 'Total Power',
                type: 'gauge',
                detail: {
                    formatter: '{value}%'
                },
                data: [{
                    value: 50,
                    // name: 'Total Power'
                }],
                axisLine: { // 坐标轴线
                    lineStyle: { // 属性lineStyle控制线条样式
                        color: [
                            [0.1, '#f62d51'],
                            [0.3, '#009efb'],
                            [1, '#55ce63']
                        ],
                        width: 8,
                        height: 2
                    }
                },
                axisTick: { // 坐标轴小标记
                    splitNumber: 10, // 每份split细分多少段
                    length: 12, // 属性length控制线长
                    lineStyle: { // 属性lineStyle控制线条样式
                        color: 'auto'
                    },
                },
                axisLabel: { // 坐标轴文本标签，详见axis.axisLabel
                    textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                        color: 'auto'
                    }
                },
                splitLine: { // 分隔线
                    show: true, // 默认显示，属性show控制显示与否
                    length: 15, // 属性length控制线长
                    lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                        color: 'white'
                    }
                },

            }]
        };

        // use configuration item and data specified to show chart
        totalpower.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    totalpower.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });


        // total yield

        // average power
        var totalyield = echarts.init(document.getElementById('totalyield-chart'));

        // specify chart configuration item and data
        option = {
            tooltip: {
                formatter: "{a} <br/>{b} : {c}%"
            },
            toolbox: {
                show: false,
                feature: {
                    restore: {
                        show: true
                    },
                    saveAsImage: {
                        show: true
                    }
                }
            },

            series: [{
                // name: 'Total Yield',
                type: 'gauge',
                splitNumber: 10,
                detail: {
                    formatter: '{value}%'
                },
                data: [{
                    value: 30,
                    // name: 'Total Yield'
                }],
                axisLine: { // 坐标轴线
                    lineStyle: { // 属性lineStyle控制线条样式
                        color: [
                            [0.1, '#f62d51'],
                            [0.3, '#009efb'],
                            [1, '#55ce63']
                        ],
                        width: 8,
                        height: 2
                    }
                },
                axisTick: { // 坐标轴小标记
                    splitNumber: 10, // 每份split细分多少段
                    length: 12, // 属性length控制线长
                    lineStyle: { // 属性lineStyle控制线条样式
                        color: 'auto'
                    }
                },
                axisLabel: { // 坐标轴文本标签，详见axis.axisLabel
                    textStyle: { // 其余属性默认使用全局文本样式，详见TEXTSTYLE
                        color: 'auto'
                    }
                },
                splitLine: { // 分隔线
                    show: true, // 默认显示，属性show控制显示与否
                    length: 15, // 属性length控制线长
                    lineStyle: { // 属性lineStyle（详见lineStyle）控制线条样式
                        color: 'white'
                    }
                },
            }]
        };

        // use configuration item and data specified to show chart
        totalyield.setOption(option, true), $(function() {
            function resize() {
                setTimeout(function() {
                    totalyield.resize()
                }, 100)
            }
            $(window).on("resize", resize), $(".sidebartoggler").on("click", resize)
        });
    </script>
</body>

</html>