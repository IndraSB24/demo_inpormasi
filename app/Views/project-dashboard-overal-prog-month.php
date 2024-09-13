<?= $this->include('partials/main') ?>

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <style>
        .galon {
            border-radius: 20px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);
            /* height: 200px; */
            background-color: #ffffff;
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
                    <div class="col-xl-12">
                        <div class="row mb-4">
                            <div class="col-lg-12 mb-4">
                                <div class="cards galon">
                                    <div class="card-body">
                                        <div class="table-rep-plugin">
                                            <div class="table-responsive mb-0" data-pattern="priority-columns"></div>
                                            <font size="2">
                                                <table id="datatable" class="table table-bordered" style="border: 0px;">
                                                    <thead>
                                                        <tr>
                                                            <th class="text-center" style="background-color: #b0cbf7;" rowspan="2">NO</th>
                                                            <th rowspan="2" style="background-color: #b0cbf7;">DESCRIPTION</th>
                                                            <th rowspan="2" style="background-color: #b0cbf7;">WF</th>
                                                            <th class="text-center" colspan="3" style="background-color:#fad8a2">CUMM LAST WEEK (W<?= $progressWeek['engineering']['lastWeek'] ?>)</th>
                                                            <th class="text-center" colspan="3" style="background-color:#9dc9ae">THIS WEEK (W<?= $progressWeek['engineering']['currentWeek'] ?>)</th>
                                                            <th class="text-center" style="background-color:#CDB4DB" colspan="3">CUMM UP TO THIS WEEK (W<?= $progressWeek['engineering']['currentWeek'] ?>)</th>
                                                        </tr>
                                                        <tr>
                                                            <th class="text-center" style="background-color:blanchedalmond">PLAN</th>
                                                            <th class="text-center" style="background-color:blanchedalmond">ACTUAL</th>
                                                            <th class="text-center" style="background-color:blanchedalmond">VAR</th>
                                                            <th class="text-center" style="background-color:#d3f5b0">PLAN</th>
                                                            <th class="text-center" style="background-color:#d3f5b0">ACTUAL</th>
                                                            <th class="text-center" style="background-color:#d3f5b0">VAR</th>
                                                            <th class="text-center" style="background-color:#FFAFCC">PLAN</th>
                                                            <th class="text-center" style="background-color:#FFAFCC">ACTUAL</th>
                                                            <th class="text-center" style="background-color:#FFAFCC">VAR</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        $engeeneringList = [
                                                            "cumPlan" => 0,
                                                            "cumActual" => 0,
                                                            "cumPlanCurrentWeek" => 0,
                                                            "cumActualCurrentWeek" => 0,
                                                            "cumPlanLastWeek" => 0,
                                                            "cumActualLastWeek" => 0
                                                        ];
                                                        $procurementList = [
                                                            "cumPlan" => 0,
                                                            "cumActual" => 0,
                                                            "cumPlanCurrentWeek" => 0,
                                                            "cumActualCurrentWeek" => 0,
                                                            "cumPlanLastWeek" => 0,
                                                            "cumActualLastWeek" => 0
                                                        ];
                                                        $constructionList = [
                                                            "cumPlan" => 0, // plan_current_week
                                                            "cumActual" => 0, //  actual_cum_till_current_week - actual_cum_till_last_week
                                                            "cumPlanCurrentWeek" => 0, // plan_cum_till_current_week
                                                            "cumActualCurrentWeek" => 0, // actual_cum_till_current_week
                                                            "cumPlanLastWeek" => 0, // plan_cum_till_last_week
                                                            "cumActualLastWeek" => 0 // actual_cum_till_last_week
                                                        ];

                                                        foreach ($progressWeek['engineering']['data'] as $row) {
                                                            foreach ($engeeneringList as $key => &$sum) {
                                                                if (isset($row[$key])) {
                                                                    $sum += $row[$key];
                                                                }
                                                            }
                                                        }
                                                        foreach ($progressWeek['procurement']['data'] as $row) {
                                                            foreach ($procurementList as $key => &$sum) {
                                                                if (isset($row[$key])) {
                                                                    $sum += $row[$key];
                                                                }
                                                            }
                                                        }
                                                        // foreach ($progressWeek['construction'] as $row) {

                                                        // }
                                                        foreach ($progressWeek['construction'] as $item) {
                                                            $constructionList["cumPlan"] += $item->plan_current_week;
                                                            $constructionList["cumPlanCurrentWeek"] += $item->plan_cum_till_current_week;
                                                            $constructionList["cumActualCurrentWeek"] += $item->actual_cum_till_current_week;
                                                            $constructionList["cumPlanLastWeek"] += $item->plan_cum_till_last_week;
                                                            $constructionList["cumActualLastWeek"] += $item->actual_cum_till_last_week;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td style="background-color: #b0cbf7;">1</td>
                                                            <td style="background-color: #b0cbf7;">Project Management</td>
                                                            <td style="background-color: #b0cbf7;"></td>
                                                            <td style="background-color: #FFEBCD;">100%</td>
                                                            <td style="background-color: #FFEBCD;">100%</td>
                                                            <td style="background-color: #FFEBCD;">0%</td>
                                                            <td style="background-color: #d3f5b0;">100%</td>
                                                            <td style="background-color: #d3f5b0;">100%</td>
                                                            <td style="background-color: #d3f5b0;">0%</td>
                                                            <td style="background-color: #FFAFCC;">100%</td>
                                                            <td style="background-color: #FFAFCC;">100%</td>
                                                            <td style="background-color: #FFAFCC;">0%</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #b0cbf7;">2</td>
                                                            <td style="background-color: #b0cbf7;">Engineering</td>
                                                            <td style="background-color: #b0cbf7;"></td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($engeeneringList['cumPlanLastWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($engeeneringList['cumActualLastWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($engeeneringList['cumActualLastWeek'], 2) - number_format($engeeneringList['cumPlanLastWeek'], 2)  ?>%</td>

                                                            <td style="background-color: #d3f5b0;"><?= number_format($engeeneringList['cumPlan'], 2)  ?>%</td>
                                                            <td style="background-color: #d3f5b0;"><?= number_format($engeeneringList['cumActual'], 2)  ?>%</td>
                                                            <td style="background-color: #d3f5b0;"><?= number_format($engeeneringList['cumActual'], 2) - number_format($engeeneringList['cumPlan'], 2)  ?>%</td>
                                                            
                                                            <td style="background-color: #FFAFCC;"><?= number_format($engeeneringList['cumPlanCurrentWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFAFCC;"><?= number_format($engeeneringList['cumActualCurrentWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFAFCC;"><?= number_format($engeeneringList['cumActualCurrentWeek'], 2) - number_format($engeeneringList['cumPlanCurrentWeek'], 2)  ?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #b0cbf7;">3</td>
                                                            <td style="background-color: #b0cbf7;">Procurement</td>
                                                            <td style="background-color: #b0cbf7;"></td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($procurementList['cumPlanLastWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($procurementList['cumActualLastWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($procurementList['cumActualLastWeek'], 2) - number_format($procurementList['cumPlanLastWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #d3f5b0;"><?= number_format($procurementList['cumPlan'], 2)  ?>%</td>
                                                            <td style="background-color: #d3f5b0;"><?= number_format($procurementList['cumActual'], 2)  ?>%</td>
                                                            <td style="background-color: #d3f5b0;"><?= number_format($procurementList['cumActual'], 2) - number_format($procurementList['cumPlan'], 2)  ?>%</td>
                                                            <td style="background-color: #FFAFCC;"><?= number_format($procurementList['cumPlanCurrentWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFAFCC;"><?= number_format($procurementList['cumActualCurrentWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFAFCC;"><?= number_format($procurementList['cumActualCurrentWeek'], 2) - number_format($procurementList['cumPlanCurrentWeek'], 2)  ?>%</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: #b0cbf7;">4</td>
                                                            <td style="background-color: #b0cbf7;">Construction</td>
                                                            <td style="background-color: #b0cbf7;"></td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($constructionList['cumPlanLastWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($constructionList['cumActualLastWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFEBCD;"><?= number_format($constructionList['cumActualLastWeek'], 2) - number_format($constructionList['cumPlanLastWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #d3f5b0;"><?= number_format($constructionList['cumPlan'], 2)  ?>%</td>
                                                            <td style="background-color: #d3f5b0;"><?= number_format($constructionList['cumActual'], 2)  ?>%</td>
                                                            <td style="background-color: #d3f5b0;"><?= number_format($constructionList['cumActual'], 2) - number_format($constructionList['cumPlan'], 2)  ?>%</td>
                                                            <td style="background-color: #FFAFCC;"><?= number_format($constructionList['cumPlanCurrentWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFAFCC;"><?= number_format($constructionList['cumActualCurrentWeek'], 2)  ?>%</td>
                                                            <td style="background-color: #FFAFCC;"><?= number_format($constructionList['cumActualCurrentWeek'], 2) - number_format($constructionList['cumPlanCurrentWeek'], 2)  ?>%</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </font>
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <div class="card" style="height:100%;background-color:#D0F4DE;border-radius: 20px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);border: 1px solid #ADC178;">
                                    <div class="card-body">
                                        <div class="text-center" style="background-color: #ADC178; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                            <h4 class="card-title mb-0" style="color:#ffffff"><i class="fas fa-chart-bar"></i> Engineering S Curve</h4>
                                        </div>
                                        <!--chart-->
                                        <div id="scurve_mdr" class="apex-charts"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 mb-4">
                                <div class="card" style="height:100%;background-color:#B0E0E6;border-radius: 20px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);border: 1px solid #3f8bd9;">
                                    <div class="card-body">
                                        <div class="text-center" style="background-color: #3f8bd9; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                            <h4 class="card-title mb-0" style="color:#ffffff"><i class="fas fa-chart-bar"></i> Procurement S Curve</h4>
                                        </div>
                                        <!--chart-->
                                        <div id="scurve_proc" class="apex-charts"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="card" style="height:100%;background-color:#facdde;border-radius: 20px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);border: 1px solid #f25c93;">
                                    <div class="card-body">
                                        <div class="text-center" style="background-color: #f25c93; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                            <h4 class="card-title mb-0" style="color:#ffffff"><i class="fas fa-chart-bar"></i> Construction S Curve</h4>
                                        </div>
                                        <!--chart-->
                                        <div id="scurve_construction" class="apex-charts"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="row">
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">SCurve Procurement</h4>
                                        <div id="scurve-procurement" class="apex-charts" dir="ltr"></div>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Progress</th>
                                                        <th>Jan</th>
                                                        <th>Feb</th>
                                                        <th>Mar</th>
                                                        <th>Apr</th>
                                                        <th>May</th>
                                                        <th>Jun</th>
                                                        <th>Jul</th>
                                                        <th>Aug</th>
                                                        <th>Sep</th>
                                                        <th>Oct</th>
                                                        <th>Nov</th>
                                                        <th>Dec</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Early</td>
                                                        <td>0</td>
                                                        <td>4</td>
                                                        <td>20</td>
                                                        <td>30</td>
                                                        <td>40</td>
                                                        <td>50</td>
                                                        <td>70</td>
                                                        <td>85</td>
                                                        <td>97</td>
                                                        <td>100</td>
                                                        <td>100</td>
                                                        <td>100</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Median</td>
                                                        <td>0</td>
                                                        <td>4</td>
                                                        <td>10</td>
                                                        <td>18</td>
                                                        <td>22</td>
                                                        <td>30</td>
                                                        <td>42</td>
                                                        <td>55</td>
                                                        <td>72</td>
                                                        <td>91</td>
                                                        <td>97</td>
                                                        <td>100</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Actual</td>
                                                        <td>0</td>
                                                        <td>4</td>
                                                        <td>20</td>
                                                        <td>30</td>
                                                        <td>40</td>
                                                        <td>50</td>
                                                        <td>70</td>
                                                        <td>85</td>
                                                        <td>97</td>
                                                        <td>100</td>
                                                        <td>100</td>
                                                        <td>100</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Late</td>
                                                        <td>0</td>
                                                        <td>4</td>
                                                        <td>20</td>
                                                        <td>30</td>
                                                        <td>40</td>
                                                        <td>50</td>
                                                        <td>70</td>
                                                        <td>85</td>
                                                        <td>97</td>
                                                        <td>100</td>
                                                        <td>100</td>
                                                        <td>100</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div> -->
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

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- apexcharts init -->
<script src="assets/js/pages/apexcharts.init.js"></script>

<!-- jquery.vectormap map -->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="assets/js/pages/dashboard.init.js"></script>

<!-- App js -->
<script src="assets/js/app.js"></script>

</body>

</html>

<script>
    // chart scurve engineering
    // var options = {
    //     chart: {
    //         height: 380,
    //         type: 'line',
    //         zoom: {
    //             enabled: false
    //         },
    //         toolbar: {
    //             show: false
    //         }
    //     },
    //     colors: ['#5664d2', '#1cbb8c', '#000000', '#dc1818'],
    //     dataLabels: {
    //         enabled: false,
    //     },
    //     stroke: {
    //         width: [3, 3, 3, 3],
    //         curve: 'straight'
    //     },
    //     series: [{
    //         name: "Early",
    //         data: [0, 4, 20, 30, 40, 50, 70, 85, 97, 100, 100, 100]
    //     },
    //     {
    //         name: "Median",
    //         data: [0, 4, 10, 18, 23, 30, 42, 55, 73, 91, 97, 100]
    //     },
    //     {
    //         name: "Actual",
    //         data: [0, 4, 10, 20, 29, 35, 50]
    //     },
    //     {
    //         name: "Late",
    //         data: [0, 4, 5, 6, 8, 10, 15, 28, 55, 83, 97, 100]
    //     }],
    //     title: {
    //         text: 'SCurve Engineering',
    //         align: 'left'
    //     },
    //     grid: {
    //         row: {
    //             colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
    //             opacity: 0.2
    //         },
    //         borderColor: '#f1f1f1'
    //     },
    //     markers: {
    //         style: 'inverted',
    //         size: 6
    //     },
    //     xaxis: {
    //         categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
    //         title: {
    //             text: 'Month'
    //         }
    //     },
    //     yaxis: {
    //         title: {
    //             text: 'Progress Plan'
    //         },
    //         min: 0,
    //         max: 100
    //     },
    //     legend: {
    //         position: 'top',
    //         horizontalAlign: 'right',
    //         floating: true,
    //         offsetY: -25,
    //         offsetX: -5
    //     },
    //     responsive: [{
    //         breakpoint: 600,
    //         options: {
    //             chart: {
    //                 toolbar: {
    //                     show: false
    //                 }
    //             },
    //             legend: {
    //                 show: false
    //             },
    //         }
    //     }]
    // }
    // var chart = new ApexCharts(
    //     document.querySelector("#scurve-engineering"),
    //     options
    // );
    // chart.render();
    // Mixed chart ========================================================================================================
    const scurveDataEngineering = <?= json_encode($scurveDataEngineering) ?>;
    const labelsEngineering = [];
    const plansEngineering = [];
    const actualsEngineering = [];
    const actualCumEngineering = [];
    const planCumEngineering = [];
    for (let i = 0; i < scurveDataEngineering.dataPlan.length; i++) {
        labelsEngineering.push(`Week ${scurveDataEngineering.dataPlan[i].week_number}`);
        plansEngineering.push(scurveDataEngineering.dataPlan[i].cum_plan_wf);
        actualsEngineering.push(scurveDataEngineering.dataActual[i].cum_actual_wf);
        actualCumEngineering.push(scurveDataEngineering.dataActualCum[i]);
        planCumEngineering.push(scurveDataEngineering.dataPlanCum[i]);
    }
    var optionsMixed = {
        chart: {
            height: 300,
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
        series: [{
                name: 'Plan',
                type: 'column',
                data: plansEngineering
            },
            {
                name: 'Actual',
                type: 'column',
                data: actualsEngineering
            },
            {
                name: 'Cum Plan',
                type: 'line',
                data: planCumEngineering
            },
            {
                name: 'Cum Actual',
                type: 'line',
                data: actualCumEngineering
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
        labels: labelsEngineering,
        markers: {
            size: 4
        },
        xaxis: {
            type: 'month'
        },
        yaxis: {
            title: {
                text: 'Percent (%)',
            },
            labels: {
                formatter: function(value) {
                    return Math.round(value); // Round the value to the nearest integer
                }
            }
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(2) + " %";
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
        document.querySelector("#scurve_mdr"),
        optionsMixed
    );
    chartMixed.render();


    const scurveDataProcurement = <?= json_encode($scurveDataProcurement) ?>;
    const labelsProcurement = [];
    const plansProcurement = [];
    const actualsProcurement = [];
    const actualCumProcurement = [];
    const planCumProcurement = [];
    for (let i = 0; i < scurveDataProcurement.dataPlan.length; i++) {
        labelsProcurement.push(`Week ${scurveDataProcurement.dataPlan[i].week_number}`);
        plansProcurement.push(scurveDataProcurement.dataPlan[i].cum_plan_wf);
        actualsProcurement.push(scurveDataProcurement.dataActual[i].cum_actual_wf);
        actualCumProcurement.push(scurveDataProcurement.dataActualCum[i]);
        planCumProcurement.push(scurveDataProcurement.dataPlanCum[i]);
    }
    var optionsMixedProc = {
        chart: {
            height: 300,
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
        series: [{
                name: 'Plan',
                type: 'column',
                data: plansProcurement
            },
            {
                name: 'Actual',
                type: 'column',
                data: actualsProcurement
            },
            {
                name: 'Cum Plan',
                type: 'line',
                data: planCumProcurement
            },
            {
                name: 'Cum Actual',
                type: 'line',
                data: actualCumProcurement
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
        labels: labelsProcurement,
        markers: {
            size: 4
        },
        xaxis: {
            type: 'month'
        },
        yaxis: {
            title: {
                text: 'Percent (%)',
            },
            labels: {
                formatter: function(value) {
                    return Math.round(value); // Round the value to the nearest integer
                }
            }
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(2) + " %";
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
        document.querySelector("#scurve_proc"),
        optionsMixedProc
    );
    chartMixed.render();


    // chart scurve procurement
    var options = {
        chart: {
            height: 380,
            type: 'line',
            zoom: {
                enabled: false
            },
            toolbar: {
                show: false
            }
        },
        colors: ['#5664d2', '#1cbb8c', '#000000', '#dc1818'],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: [3, 3, 3, 3],
            curve: 'straight'
        },
        series: [{
                name: "Early",
                data: [0, 4, 20, 30, 40, 50, 70, 85, 97, 100, 100, 100]
            },
            {
                name: "Median",
                data: [0, 4, 10, 18, 23, 30, 42, 55, 73, 91, 97, 100]
            },
            {
                name: "Actual",
                data: [0, 4, 10, 20, 29, 35, 50]
            },
            {
                name: "Late",
                data: [0, 4, 5, 6, 8, 10, 15, 28, 55, 83, 97, 100]
            }
        ],
        title: {
            text: 'SCurve Procurement',
            align: 'left'
        },
        grid: {
            row: {
                colors: ['transparent', 'transparent'], // takes an array which will be repeated on columns
                opacity: 0.2
            },
            borderColor: '#f1f1f1'
        },
        markers: {
            style: 'inverted',
            size: 6
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            title: {
                text: 'Month'
            }
        },
        yaxis: {
            title: {
                text: 'Progress Plan'
            },
            min: 0,
            max: 100
        },
        legend: {
            position: 'top',
            horizontalAlign: 'right',
            floating: true,
            offsetY: -25,
            offsetX: -5
        },
        responsive: [{
            breakpoint: 600,
            options: {
                chart: {
                    toolbar: {
                        show: false
                    }
                },
                legend: {
                    show: false
                },
            }
        }]
    }
    var chart = new ApexCharts(
        document.querySelector("#scurve-procurement"),
        options
    );
    chart.render();

    const scurveData = <?= json_encode($scurveDataConstruction) ?>;
    const labels = [];
    const plans = [];
    const actuals = [];
    const actualCum = [];
    const planCum = [];
    for (let i = 0; i < scurveData.dataPlan.length; i++) {
        labels.push(`W ${scurveData.dataPlan[i].week_number}`);
        plans.push(scurveData.dataPlan[i].cum_plan_wf);
        actuals.push(scurveData.dataActual[i].cum_actual_wf);
        actualCum.push(scurveData.dataActualCum[i]);
        planCum.push(scurveData.dataPlanCum[i]);
    }

    var options_scurve_construction = {
        chart: {
            height: 250,
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
        series: [{
                name: 'Plan',
                type: 'column',
                data: plans
            },
            {
                name: 'Actual',
                type: 'column',
                data: actuals
            },
            {
                name: 'Cum Plan',
                type: 'line',
                data: planCum
            },
            {
                name: 'Cum Actual',
                type: 'line',
                data: actualCum
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
        labels: labels,
        markers: {
            size: 4
        },
        xaxis: {
            type: 'month',
            labels: {
                rotate: -90, // Rotate labels to vertical
                style: {
                    fontSize: '12px',
                    colors: []
                }
            }
        },
        yaxis: {
            title: {
                text: 'Percent (%)',
            },
            labels: {
                formatter: function(value) {
                    return Math.round(value); // Round the value to the nearest integer
                }
            }
        },
        tooltip: {
            shared: true,
            intersect: false,
            y: {
                formatter: function(y) {
                    if (typeof y !== "undefined") {
                        return y.toFixed(2) + " %";
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
    var chart = new ApexCharts(
        document.querySelector("#scurve_construction"),
        options_scurve_construction
    );
    chart.render();
</script>