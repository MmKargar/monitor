<!-- ============================================================== -->
<!-- footer -->
<!-- ============================================================== -->
<footer class="footer"> Solar Monitoring@<?= date('Y', time()) ?> </footer>
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
<script src="<?= PUBLIC_PATH ?>assets/plugins/toast-master/js/jquery.toast.js"></script>
<script src="<?= PUBLIC_PATH ?>assets/plugins/sweetalert/sweetalert.min.js"></script>

<!-- mycharts  -->

<!-- ============================================================== -->
<!-- charts -->

<!-- chart.js -->

<script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

<script>
    var day_data = <?= $data['dataset'] ?>;
    var day_labels = <?= $data['labels'] ?>;
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',

        // The data for our dataset
        data: {
            labels: day_labels,
            datasets: [{
                label: 'Average Voltage',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: day_data
            }]
        },

        // Configuration options go here
        options: {}
    });
    // day chart functions


    function addData(chart, data , labels = null ) {
        if(labels){
            chart.data.labels = labels;
        }
        chart.data.datasets.forEach((dataset) => {
            dataset.data = data;
        });
        chart.update();
    }

    function removeData(chart) {
        chart.data.labels.pop();
        chart.data.datasets.forEach((dataset) => {
            dataset.data.pop();
        });
        chart.update();
    }

    function next_day() {
        var day = {
            'day': document.getElementById("day-date").value,
            'action': 'next',
        };
        $.ajax({
            type: "POST",
            url: "<?= PUBLIC_PATH ?>" + 'chart/get_day',
            data: day,
            success: function(data) {
                document.getElementById("day-date").value = data.tommorow;
                addData(chart, data.data);
            },
            dataType: 'json'
        });

    }

    function pre_day() {
        var day = {
            'day': document.getElementById("day-date").value,
            'action': 'pre',
        };
        $.ajax({
            type: "POST",
            url: "<?= PUBLIC_PATH ?>" + 'chart/get_day',
            data: day,
            success: function(data) {
                document.getElementById("day-date").value = data.pre;
                addData(chart, data.data);
            },
            dataType: 'json'
        });
    }

    $("#day-date").keypress(function(event) {
        if (event.which == 13) {
            var day = {
                'day': document.getElementById("day-date").value,
                'action': 'enter',
            };
            $.ajax({
                type: "POST",
                url: "<?= PUBLIC_PATH ?>" + 'chart/get_day',
                data: day,
                success: function(data) {
                    // document.getElementById("day-date").value = data.tommorow;
                    addData(chart, data.data);
                },
                dataType: 'json'
            });
        }
    });

    // month chart
    var month_data = <?= $data['month_data'] ?>;
    var month_labels = <?= $data['month_labels'] ?>;
    var ctx = document.getElementById('myChart1').getContext('2d');
    var month_chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',
        // The data for our dataset
        data: {
            labels: month_labels,
            datasets: [{
                label: 'Average Power',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: month_data
            }]
        },

        // Configuration options go here
        options: {}
    });

    function next_month() {
        var m_data = {
            'month-date': document.getElementById("month-date").value,
            'month-year-date': document.getElementById("month-year-date").value,
            'action': 'next',
        };

        $.ajax({
            type: "POST",
            url: "<?= PUBLIC_PATH ?>" + 'chart/get_month',
            data: m_data,
            success: function(data) {
                document.getElementById("month-date").value = data.month_date;
                document.getElementById("month-year-date").value = data.month_year_date;
                addData(month_chart, data.data);
            },
            dataType: 'json'
        });
    }

    function pre_month() {
        var m_data = {
            'month-date': document.getElementById("month-date").value,
            'month-year-date': document.getElementById("month-year-date").value,
            'action': 'pre',
        };

        $.ajax({
            type: "POST",
            url: "<?= PUBLIC_PATH ?>" + 'chart/get_month',
            data: m_data,
            success: function(data) {
                document.getElementById("month-date").value = data.month_date;
                console.log(data.month_date);

                document.getElementById("month-year-date").value = data.month_year_date;
                addData(month_chart, data.data);
            },
            dataType: 'json'
        });
    }

    function month_change() {
        var m_data = {
            'month-date': document.getElementById("month-date").value,
            'month-year-date': document.getElementById("month-year-date").value,
            'action': 'change',
        };

        $.ajax({
            type: "POST",
            url: "<?= PUBLIC_PATH ?>" + 'chart/get_month',
            data: m_data,
            success: function(data) {
                addData(month_chart, data.data);
            },
            dataType: 'json'
        });
    }
    // END MONTH CHART
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////

    // YEAR CHART
    var year_labels = <?= $data['year_labels'] ?>;
    var year_data = <?= $data['year_data'] ?>;
    var ctx = document.getElementById('myChart2').getContext('2d');
    var year_chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: year_labels,
            datasets: [{
                label: 'Total Yield',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: year_data
            }]
        },

        // Configuration options go here
        options: {}
    });


    function next_year() {
        var m_data = {
            'year-date': document.getElementById("year-date").value,
            'action': 'next',
        };

        $.ajax({
            type: "POST",
            url: "<?= PUBLIC_PATH ?>" + 'chart/get_year',
            data: m_data,
            success: function(data) {
                document.getElementById("year-date").value = data.year_date;
                addData(year_chart, data.data , data.labels );
            },
            dataType: 'json'
        });
    }

    function pre_year() {
        var m_data = {
            'year-date': document.getElementById("year-date").value,
            'action': 'pre',
        };

        $.ajax({
            type: "POST",
            url: "<?= PUBLIC_PATH ?>" + 'chart/get_year',
            data: m_data,
            success: function(data) {
                document.getElementById("year-date").value = data.year_date;
                addData(year_chart, data.data , data.labels );
            },
            dataType: 'json'
        });
    }

    function change_year() {
        var m_data = {
            'year-date': document.getElementById("year-date").value,
            'action': 'change',
        };

        $.ajax({
            type: "POST",
            url: "<?= PUBLIC_PATH ?>" + 'chart/get_year',
            data: m_data,
            success: function(data) {
                addData(year_chart, data.data , data.labels );
            },
            dataType: 'json'
        });
    }

    // END YEAR CHART
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////

    // TOTAL Average Voltage CHART
    var ctx = document.getElementById('myChart3').getContext('2d');
    var chart3 = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: <?= $data['total_labels'] ?>,
            datasets: [{
                label: 'Average Voltage',
                backgroundColor: 'rgb(255, 99, 132)',
                borderColor: 'rgb(255, 99, 132)',
                data: <?= $data['total_data'] ?>
            }]
        },

        // Configuration options go here
        options: {}
    });
    //  END Average Voltage CHART
    /////////////////////////////////////////////////////////////////////////////
    /////////////////////////////////////////////////////////////////////////////
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
                value: average_power,
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

    // total power
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
                value: total_power,
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

    // total yield
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
                value: total_yield,
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

<script>
    function logout() {
        document.getElementById("logout").submit();
    }
</script>
</body>

</html>