<?= $this->include('partials/main') ?>

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <style>
        /* CSS untuk menentukan latar belakang div */
        .background-div {
            background-image: url('assets/images/93826.jpg');
            background-size: cover;
            background-position: center;
            /* background-color: '#4aa3ff'; */
            /* opacity: 0.8; */
            /* z-index: -100 */
        }

        .background-div-b {
            /* background-image: url('assets/images/93826.jpg'); */
            background-image: url('assets/images/123.jpg');
            background-size: cover;
            background-position: center;
            /* background-color: '#4aa3ff'; */
            /* opacity: 0.8; */
            /* z-index: -100 */
        }
    </style>
</head>

<?= $this->include('partials/body') ?>

<!-- Begin page -->
<div id="layout-wrapper">

    <?= $this->include('partials/menu') ?>

    <!-- ============================================================== -->
    <!-- Start right Content here -->
    <!-- ============================================================== -->
    <div class="main-content">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->
                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-xl-2">
                                <!--<div class="card" style="height: 90%;">-->
                                <!--    <div class="card-body d-flex align-items-center">-->
                                <!--        <div class="flex-1 overflow-hidden">-->
                                <!--            <p class="text-truncate font-size-14 mb-2">Actual</p>-->
                                <!--            <h2 class="mb-0 text-warning text-center">85%</h2>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="card" style="height: 90%; background: linear-gradient(to top, var(--bs-success) 0%, 
                                    var(--bs-success) <?= $data_page->overal_plan ?>%, #ffffff 0%, #ffffff 100%);">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="card-title text-truncate font-size-14 mb-2">Plan</h5>
                                            <h2 class="mb-0 text-dark text-center"><?= $data_page->overal_plan ?>%</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <!--<div class="card" style="height: 90%;">-->
                                <!--    <div class="card-body">-->
                                <!--        <div class="d-flex">-->
                                <!--            <div class="flex-1 overflow-hidden">-->
                                <!--                <p class="text-truncate font-size-14 mb-2">Plan</p>-->
                                <!--                <h2 class="mb-0 text-success">90%</h2>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="card" style="height: 90%; background: linear-gradient(to top, var(--bs-warning) 0%, 
                                    var(--bs-warning) <?= $data_page->overal_actual ?>%, #ffffff 0%, #ffffff 100%);">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="card-title text-truncate font-size-14 mb-2">Actual</h5>
                                            <h2 class="mb-0 text-dark text-center"><?= $data_page->overal_actual ?>%</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-2">
                                <!--<div class="card" style="height: 90%;">-->
                                <!--    <div class="card-body">-->
                                <!--        <div class="d-flex">-->
                                <!--            <div class="flex-1 overflow-hidden">-->
                                <!--                <p class="text-truncate font-size-14 mb-2">Variance</p>-->
                                <!--                <h2 class="mb-0 text-danger">-5%</h2>-->
                                <!--            </div>-->
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                                <div class="card" style="height: 90%; background: linear-gradient(to top, var(--bs-danger) 0%, 
                                    var(--bs-danger) <?= $data_page->overal_plan ?>%, #ffffff 0%, #ffffff 100%);">
                                    <div class="card-body d-flex align-items-center">
                                        <div class="flex-1 overflow-hidden">
                                            <h5 class="card-title text-truncate font-size-14 mb-2">Varience</h5>
                                            <h2 class="mb-0 text-dark text-center"><?= $data_page->overal_variance ?>%</h2>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-6">
                                <div class="card" style="height: 90%;background-color:#17a2b8; overflow: hidden;">
                                    <div class="card-body">
                                        <p class="text-truncate font-size-14 mb-2" style="color: #ffffff;"><i class="fas fa-plane-departure"></i> <strong>Progress Tracking</strong></p>
                                        <div class="row">
                                            <div class="col-sm-6 text-center" style="padding: 10px;">
                                                <div style="border: 2px solid #ffffff; border-radius: 8px;">
                                                    <div id="radial_chart_1" class="apex-charts m-0 p-0"></div>
                                                    <a href="engineering-dashboard" class="btn btn-sm btn-warning mb-3">
                                                        Detail Engineering
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 text-center" style="padding: 10px">
                                                <div style="border: 2px solid #ffffff; border-radius: 8px;">
                                                    <div id="radial_chart_2" class="apex-charts m-0 p-0"></div>
                                                    <a href="procurement-dashboard" class="btn btn-sm btn-warning mb-3">
                                                        Detail Procurement
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                        <!-- end row -->
                        <div class="row" id="overal_progress_elem">
                            <div class="col-lg-12">
                                <div class="card" style="background-color:antiquewhite">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <h4 class="card-title mb-1">Overall Progress by Month</h4>
                                            </div>
                                            <div class="col-sm-6 d-flex justify-content-end">
                                                <a href="project-show-over-prog-month" class="btn btn-sm btn-info mb-3">
                                                    Show Detail
                                                </a>
                                            </div>
                                        </div>
                                        <div id="mixed_chart_1" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                        <div class="row d-none" id="overal_progress_elem">
                            <div class="col-lg-12">
                                <div class="card ">
                                    <div class="card-body">
                                        <h4 class="card-title mb-1">Overall Progress by Month</h4>
                                        <a href="project-show-over-prog-month" class="btn btn-sm btn-info mb-3">
                                            Show Detail
                                        </a>
                                        <div id="line_chart_datalabel" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="card background-div">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Manpower By Month</h4>
                                        <div id="chart_man_power" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="card">
                            <div class="card-body">
                                <h4 class="card-title mb-4">Project Milestone</h4>
                                <div class="table-responsive">
                                    <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Material/Equipment</th>
                                                <th>ETA</th>
                                                <th>ROS</th>
                                                <th>Current Status</th>
                                                <th>-</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>IA</td>
                                                <td>10/03/2023</td>
                                                <td>10/03/2023</td>
                                                <td>On Time</td>
                                            </tr>
                                            <tr>
                                                <td>LLI</td>
                                                <td>10/03/2023</td>
                                                <td>10/03/2023</td>
                                                <td>On Time</td>
                                            </tr>
                                            <tr>
                                                <td>MC</td>
                                                <td>10/03/2023</td>
                                                <td>10/03/2023</td>
                                                <td>On Time</td>
                                            </tr>
                                            <tr>
                                                <td>RFSU</td>
                                                <td>10/03/2023</td>
                                                <td>10/03/2023</td>
                                                <td>On Time</td>
                                            </tr>
                                            <tr>
                                                <td>CSI BOG</td>
                                                <td>10/03/2023</td>
                                                <td>10/03/2023</td>
                                                <td>On Time</td>
                                            </tr>
                                            <tr>
                                                <td>CSI Ethelyne</td>
                                                <td>10/03/2023</td>
                                                <td>10/03/2023</td>
                                                <td>On Time</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title mb-4">Procurement</h4>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>BL Project Duration</th>
                                                    <th>Duration % Complete</th>
                                                    <th>Actual Duration</th>
                                                    <th>BL Project Start</th>
                                                    <th>BL Project Finish</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Cable Pulling</td>
                                                    <td>100</td>
                                                    <td>150</td>
                                                    <td>50</td>
                                                </tr>
                                                <tr>
                                                    <td>Pilling</td>
                                                    <td>75</td>
                                                    <td>70</td>
                                                    <td>5</td>
                                                </tr>
                                                <tr>
                                                    <td>Welding</td>
                                                    <td>20</td>
                                                    <td>21</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>Barbender</td>
                                                    <td>12</td>
                                                    <td>21</td>
                                                    <td>9</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="row d-none" id="progress_tracking_elem_old">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4>Progress Tracking</h4>
                                        <a href="engineering-doc-list" class="btn btn-sm btn-info mb-3">
                                            Detail Engineering
                                        </a>
                                        <a href="procurement-doc-list" class="btn btn-sm btn-info mb-3">
                                            Detail Procurement
                                        </a>
                                        <div id="chart_progress_tracking" class="apex-charts"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                    </div>

                    <div class="row d-none">
                        <div class="col-lg-12">
                            <div class="card">
                                <div class="card-body">

                                    <h4 class="card-title mb-4">Productivity</h4>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead class="table-light">
                                                <tr>
                                                    <th>Title</th>
                                                    <th>Plan Quantity</th>
                                                    <th>Actual Quantity</th>
                                                    <th>Variance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td>Cable Pulling</td>
                                                    <td>100</td>
                                                    <td>150</td>
                                                    <td>50</td>
                                                </tr>
                                                <tr>
                                                    <td>Pilling</td>
                                                    <td>75</td>
                                                    <td>70</td>
                                                    <td>5</td>
                                                </tr>
                                                <tr>
                                                    <td>Welding</td>
                                                    <td>20</td>
                                                    <td>21</td>
                                                    <td>1</td>
                                                </tr>
                                                <tr>
                                                    <td>Barbender</td>
                                                    <td>12</td>
                                                    <td>21</td>
                                                    <td>9</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>
        <!-- End Page-content -->

        <?= $this->include('partials/footer') ?>

    </div>
    <!-- end main content-->

</div>
<!-- END layout-wrapper -->

<?= $this->include('partials/right-sidebar') ?>

<?= $this->include('partials/vendor-scripts') ?>

</body>

</html>

<script>
    console.log(<?= json_encode($sess('active_user_id')) ?>, 'activeUserId');
    // chart progress tracking
    var options_prog_chart = {
        chart: {
            height: 250,
            type: 'bar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: true,
                columnWidth: '45%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Plan',
            data: [80, 70]
        }, {
            name: 'Actual',
            data: [60, 60]
        }],
        colors: ['#1cbb8c', '#fcb92c'],
        xaxis: {
            categories: ['Engineering', 'Procurement'],
        },
        yaxis: {
            title: {
                text: ''
            }
        },
        grid: {
            borderColor: '#f1f1f1',
            padding: {
                bottom: 10
            }
        },
        fill: {
            opacity: 1

        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + "%"
                }
            }
        },
        legend: {
            offsetY: 7
        }
    }
    var prog_chart = new ApexCharts(
        document.querySelector("#chart_progress_tracking"),
        options_prog_chart
    );
    prog_chart.render();

    //  Radial chart 1
    var options = {
        chart: {
            height: 150,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '10px',
                    },
                    value: {
                        fontSize: '8px',
                    },
                    total: {
                        show: false,
                        label: 'Total',
                        formatter: function(w) {
                            return 249
                        }
                    },
                    margin: 15
                }
            }
        },
        series: [<?= $data_page->chart_pt_engineering_actual ?>, <?= $data_page->chart_pt_engineering_plan ?>],
        labels: ['Actual', 'Plan'],
        colors: ['#5664d2', '#fcb92c'],
        legend: {
            offsetY: 5
        }

    }
    var chart = new ApexCharts(
        document.querySelector("#radial_chart_1"),
        options
    );
    chart.render();

    //  Radial chart 2
    var options_1 = {
        chart: {
            height: 150,
            type: 'radialBar',
            margin: 0
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        fontSize: '10px',
                    },
                    value: {
                        fontSize: '8px',
                    },
                    total: {
                        show: false,
                        label: 'Total',
                        formatter: function(w) {
                            return 249
                        }
                    },
                    margin: 0
                }
            }
        },
        series: [<?= $data_page->chart_pt_procurement_actual ?>, <?= $data_page->chart_pt_procurement_plan ?>],
        labels: ['Actual', 'Plan'],
        colors: ['#5664d2', '#fcb92c'],
        legend: {
            offsetY: 5
        }

    }
    var chart_1 = new ApexCharts(
        document.querySelector("#radial_chart_2"),
        options_1
    );
    chart_1.render();

    // Mixed chart
    var optionsMixed = {
        chart: {
            height: 200,
            type: 'line',
            stacked: false,
            toolbar: {
                show: false
            }
        },
        stroke: {
            width: [0, 0, 4, 4],
            curve: 'straight'
        },
        plotOptions: {
            bar: {
                columnWidth: '50%'
            }
        },
        colors: ['#fcb92c', "#4aa3ff", '#5664d2', '#1cbb8c'],
        series: [
            {
                name: 'Plan',
                type: 'column',
                data: [0, 10, 15, 10, 5, 8, 6, 14, 7, 5, 8, 2]
            },
            {
                name: 'Actual',
                type: 'column',
                data: [0, 10, 15, 10, 5, 3, 5, 17, 5, 5, 5, 3]
            },
            {
                name: 'Cum Plan',
                type: 'line',
                data: [0, 10, 25, 35, 40, 48, 54, 68, 75, 80, 88, 90]
            },
            {
                name: 'Cum Actual',
                type: 'line',
                data: [0, 10, 20, 30, 40, 43, 48, 65, 70, 75, 80]
            }
        ],
        fill: {
            opacity: [0.85, 0.85, 1, 1],
            gradient: {
                inverseColors: false,
                shade: 'light',
                type: "vertical",
                opacityFrom: 0.85,
                opacityTo: 0.55,
                stops: [0, 100, 100, 100]
            }
        },
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        markers: {
            size: 4
        },
        xaxis: {
            type: 'month'
        },
        yaxis: [
            {
            title: {
                text: "SCurve Percent"
            },
            },
            {
            opposite: true,
            title: {
                text: "Bar Percent"
            }
            }
        ],
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(0) + " percent";
                    }
                    return y;

                }
            }
        },
        grid: {
            borderColor: '#f1f1f1',
            padding: {
                bottom: 10
            }
        },
        legend: {
            offsetY: 7
        }
    }
    var chartMixed = new ApexCharts(
        document.querySelector("#mixed_chart_1"),
        optionsMixed
    );
    chartMixed.render();

    // column chart

    var options_man_power = {
        chart: {
            height: 200,
            type: 'bar',
            toolbar: {
                show: false,
            }
        },
        plotOptions: {
            bar: {
                horizontal: false,
                columnWidth: '60%',
                endingShape: 'rounded'
            },
        },
        dataLabels: {
            enabled: false
        },
        stroke: {
            show: true,
            width: 2,
            colors: ['transparent']
        },
        series: [{
            name: 'Plan',
            data: [46, 57, 59, 54, 62, 58, 64, 60, 66, 100, 60, 70]
        }, {
            name: 'Actual',
            data: [74, 83, 102, 97, 86, 106, 93, 114, 94, 80, 40, 20]
        }],
        colors: ['#5664d2', '#1cbb8c', '#fcb92c'],
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            title: {
                text: 'Month'
            }
        },
        yaxis: {
            title: {
                text: 'Manpower (people)'
            }
        },
        grid: {
            borderColor: '#f1f1f1',
            padding: {
                bottom: 10
            }
        },
        fill: {
            opacity: 1

        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + " people"
                }
            }
        },
        legend: {
            offsetY: 7
        }
    }

    var chart_man_power = new ApexCharts(
        document.querySelector("#chart_man_power"),
        options_man_power
    );
    chart_man_power.render();
</script>
