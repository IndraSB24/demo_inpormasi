<?= $this->include('partials/main') ?>

<head>
    <?= $title_meta ?>
    <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://kendo.cdn.telerik.com/2022.3.913/styles/kendo.default-ocean-blue.min.css" />
    <script src="https://kendo.cdn.telerik.com/2022.3.913/js/jquery.min.js"></script>
    <script src="https://kendo.cdn.telerik.com/2022.3.913/js/kendo.all.min.js"></script>
    <link href="<?= base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css">

    <?= $this->include('partials/head-css') ?>
    <style>
        .dot {
            width: 10px;
            height: 10px;
            background-color: black;
            border-radius: 50%;
            /* Make it round */
            display: inline-block;
            margin: 5px;
            /* Adjust spacing */
        }

        .galon {
            border-radius: 20px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);
            /* height: 200px; */
            background-color: #ffffff;
        }

        .selectable:hover {
            background-color: #7390A4 !important;
            color: #fff !important;
            cursor: pointer;
        }

        #total_doc {
            font-weight: 700;
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
                <?= $page_title ?>
                <small class="form-label">CUT OFF WEEK: </small>
                <!-- <div class="col-md-4">
                    <div class="input-group mb-4" id="datepicker1" style="border-radius: 10px;">
                        <input type="text" class="form-control rounded-start" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#datepicker1" data-provide="datepicker" name="cut_off_filter" id="cut_off_filter" style="border-radius: 15px 0 0 15px !important;" />
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-add-document" style="border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
                        <i class="far fa-calendar"></i>  Filter
                        </button>

                    </div>
                </div> -->
                <div class="col-md-4 row mb-3">
                    <div class="col-6">
                        <select class="form-control select2">
                            <option>Select</option>
                            <option value="EL">Week 1</option>
                            <option value="FA">Week 2</option>
                            <option value="FI">Week 3</option>
                        </select>
                    </div>
                    <div class="col-6" style="padding-left: 0;">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-add-document">
                            Filter
                        </button>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 pb-0">
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
                    <div class="col-lg-6 pb-0">
                        <div class="galon" style="padding: 15px;padding-top: 10px;height:100%;border: 1px solid #B5838D;">
                            <div class="text-center">
                                <div class="text-center mb-3" style="background-color: #B5838D; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                    <h4 class="card-title mb-0" style="color:#ffffff"><i class="far fa-eye"></i> Status Progress</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div id="Detail-Engineering" style="border: 1px solid #E0E0E0; border-radius: 8px;background-color:#F5CAC3;height: 100%">
                                        <div class="text-center mt-3">
                                            <div class="text-center mb-2" style="background-color: #F7EDE2; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:3rem">
                                                <i class="fas fa-hourglass-half"></i>
                                                <h4 class="card-title mb-0">Percentage Progress</h4>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-7 mb-2">
                                                <!-- <div id="radial_chart_1" class="apex-charts m-0 p-0"></div> -->
                                                <div id="percent_chart" class="apex-charts"></div>
                                            </div>
                                            <div class="col-5" style="padding-left:0;text-align: left;display:flex;flex-direction:column;justify-content: center;">
                                                <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                    <div class="dot" style="background-color: #FFB703"></div>
                                                    <small><strong id="complete">-</strong></small>

                                                </div>
                                                <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                    <div class="dot" style="background-color: #219EBC"></div>
                                                    <small><strong id="waiting">-</strong></small>
                                                </div>
                                                <!-- <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                    <div class="dot" style="background-color: #9B5DE5"></div>
                                                    <small><strong id="plan">-</strong></small>

                                                </div>
                                                <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                    <div class="dot" style="background-color: #6A994E"></div>
                                                    <small><strong id="actual">-</strong></small>
                                                </div> -->
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div id="Detail-Procurement" style="border: 1px solid #E0E0E0; border-radius: 8px;background-color:#F4F0BE">
                                        <div class="text-center mt-3">
                                            <div class="text-center mb-2" style="background-color: #EDE580; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:3rem">
                                                <i class="fas fa-file-alt"></i>
                                                <h4 class="card-title mb-0">Document Progress</h4>
                                            </div>
                                        </div>
                                        <div class="row" style="padding: 10px;">
                                            <!-- <div class="col-7 mb-2">
                                                <div id="document_chart" class="apex-charts"></div>
                                            </div>
                                            <div class="col-5" style="padding-left:0;text-align: left;display:flex;flex-direction:column;justify-content: center;">
                                                <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                    <div class="dot" style="background-color: #E9C46A"></div>
                                                    <small><strong id="complete_doc">-</strong></small>
                                                </div>
                                                <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                    <div class="dot" style="background-color: #2A9D8F;"></div>
                                                    <small><strong id="waiting_doc">-</strong></small>
                                                </div>
                                                <div class="mt-1" style="display: flex; justify-content: flex-start; align-items: center;">
                                                    <div class="dot" style="background-color: #F4F0BE;"></div>
                                                    <small><h5 id="total_doc" style="font-size: 0.7rem;">-</h5></small>
                                                </div>
                                            </div> -->
                                            <div class="col-md-4">
                                                <div class="galon d-flex align-items-center" style="border: 10px solid #fff;height: 200px; background: linear-gradient(to top, var(--bs-success) 0%, 
                                                    var(--bs-success) <?= ($docProgress['ifa_actual'] / $docProgress['ifa_plan'] * 100) ?>%, #ffffff 0%, #ffffff 100%);">
                                                    <div style="background-color:white;padding: 10px;border-radius: 20px;">
                                                        <span style="font-size: 11px;" class="mb-0 text-center"><?= $docProgress['ifa_actual'] ?> / <?= $docProgress['ifa_plan'] ?> </span>
                                                        <h6 class="card-title text-truncate mb-2 text-center" style="font-size: 10px;font-weight:700">IFA</h6>
                                                        <!-- <div style="display: flex; justify-content: center; align-items: center;">
                                                            <i class="fas fa-ruler-combined" style="font-size: 1rem;"></i>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="galon d-flex align-items-center" style="border: 10px solid #fff;height: 200px; background: linear-gradient(to top, var(--bs-warning) 0%, 
                                                    var(--bs-warning) <?= ($docProgress['ifc_actual'] / $docProgress['ifc_plan'] * 100) ?>%, #ffffff 0%, #ffffff 100%);">
                                                    <div style="background-color:white;padding: 10px;border-radius: 20px;">
                                                        <span style="font-size: 11px;" class="mb-0 text-center"><?= $docProgress['ifc_actual'] ?> / <?= $docProgress['ifc_plan'] ?> </span>
                                                        <h6 class="card-title text-truncate mb-2 text-center" style="font-size: 10px;font-weight:700">IFC</h6>
                                                        <!-- <div style="display: flex; justify-content: center; align-items: center;">
                                                            <i class="fas fa-glasses" style="font-size: 1rem;"></i>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="galon d-flex align-items-center" style="border: 10px solid #fff;height: 200px; background: linear-gradient(to top, var(--bs-danger) 0%, 
                                                    var(--bs-danger) <?= ($docProgress['asbuild_actual'] / $docProgress['asbuild_plan'] * 100) ?>%, #ffffff 0%, #ffffff 100%);">
                                                    <div style="background-color:white;padding: 5px;border-radius: 20px;">
                                                        <span style="font-size: 11px;" class="mb-0 text-center"><?= $docProgress['asbuild_actual'] ?> / <?= $docProgress['asbuild_plan'] ?> </span>
                                                        <h6 class="card-title text-truncate mb-2 text-center" style="font-size: 10px;font-weight:700">ASBUILD</h6>
                                                        <!-- <div style="display: flex; justify-content: center; align-items: center;">
                                                            <i class="far fa-chart-bar" style="font-size: 1rem;"></i>
                                                        </div> -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-6"></div>
                                            <div class="col-6">
                                                <!-- Div Induk -->
                                                <div class="text-center selectable" style="border-top-left-radius: 25px;background-color:#EDE580; padding: 7px; display: flex; justify-content: flex-end;" onclick="window.location.href = 'engineering-doc-list/1';">
                                                    <!-- Div Anak -->
                                                    <strong><span style="padding-right: 5px;"><i class="fas fa-info-circle"></i> Click for Detail</span></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- <div class="col-md-6">
                                            <div style="border: 1px solid #E0E0E0; border-radius: 8px;">
                                                <div id="radial_chart_2" class="apex-charts m-0 p-0"></div>
                                                <div style="background-color:antiquewhite" class="text-center">
                                                    <strong><small style="padding-left: 5px;">Detail Procurement</small></strong>
                                                </div>
                                            </div>
                                        </div> -->
                            </div>
                        </div>
                    </div>
                    <!-- <div class="col-md-12 mt-2 pt-0">
                        <div class="card bg-info text-white mt-1">
                            <div class="card-body">
                                <h4 class="card-title mb-1 text-white">Analysis</h4>
                                Isinya analisis
                            </div>
                        </div>
                    </div> -->
                    <!-- <div class="col-lg-12" style="padding-left: 4px;">
                        <div class="card background-divs" style="background-color: rgba(135, 206, 250, 0.9);background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.5));border-radius: 0 35px 35px 0;">
                            <div class="card-body">
                                <div class="text-center" style="background-color: #3f8bd9; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                    <h4 class="card-title mb-0" style="color:#ffffff">Manhour By Month</h4>
                                </div>
                                <div id="chart_man_hour" class="apex-charts" dir="ltr"></div>
                            </div>
                        </div>
                    </div> -->
                    <div class="col-lg-6 pb-0 mt-4">
                        <div class="card" style="height:100%;background-color:#FFFFFC;border-radius: 20px;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);border: 1px solid #ADC178;">
                            <div class="card-body">
                                <div class="text-center" style="background-color: #ADC178; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                    <h4 class="card-title mb-0" style="color:#ffffff"><i class="fas fa-chart-bar"></i> Manhour By Week</h4>
                                </div>
                                <div id="chart_man_hour" class="apex-chartss" dir="ltr"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 pb-0 mt-4">
                        <div class="cards galon" style="padding: 15px;padding-top: 15px;border: 1px solid #FDF0D5;">
                            <div class="card-body">
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns"></div>
                                    <font size="2">
                                        <table id="datatable" class="table table-bordered" style="border: 0px;">
                                            <thead>
                                                <tr>
                                                    <th class="text-center" style="background-color: #b0cbf7;" rowspan="2">NO</th>
                                                    <th rowspan="2" style="background-color: #b0cbf7;">DESCRIPTION</th>
                                                    <th class="text-center" colspan="3" style="background-color:#fad8a2">CUMM LAST WEEK (W<?= $progressByDicipline['lastWeek'] ?>)</th>
                                                    <th class="text-center" colspan="3" style="background-color:#9dc9ae">THIS WEEK (W<?= $progressByDicipline['currentWeek'] ?>)</th>
                                                    <th class="text-center" style="background-color:#CDB4DB" colspan="3">CUMM UP TO THIS WEEK (W<?= $progressByDicipline['currentWeek'] ?>)</th>
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
                                                    $counter = 0;
                                                    // Iterate over the array
                                                    foreach ($progressByDicipline['data'] as $key => $value) {
                                                        $counter += 1;
                                                        echo '
                                                            <tr>
                                                                <td class="text-center" style="background-color: #b0cbf7;">
                                                                    '. $counter .'
                                                                </td>
                                                                <td style="background-color: #b0cbf7;">
                                                                    '. $key .'
                                                                </td>
                                                                <td class="text-center" style="background-color: #FFEBCD;">
                                                                    '. angka(2, $value['cumPlanLastWeek']) .'%
                                                                </td>
                                                                <td class="text-center" style="background-color: #FFEBCD;">
                                                                    '. angka(2, $value['cumActualLastWeek']) .'%
                                                                </td>
                                                                <td class="text-center" style="background-color: #FFEBCD;">
                                                                    '. angka(2, (float) $value['cumActualLastWeek'] - (float) $value['cumPlanLastWeek']) .'%
                                                                </td>
                                                                <td class="text-center" style="background-color: #d3f5b0;">
                                                                    '. angka(2, $value['cumPlanCurrentWeek']) .'%
                                                                </td>
                                                                <td class="text-center" style="background-color: #d3f5b0;">
                                                                    '. angka(2, $value['cumActualCurrentWeek']) .'%
                                                                </td>
                                                                <td class="text-center" style="background-color: #d3f5b0;">
                                                                    '. angka(2, (float) $value['cumActualCurrentWeek'] - (float) $value['cumPlanCurrentWeek']) .'%
                                                                </td>
                                                                <td class="text-center" style="background-color: #FFAFCC;">
                                                                    '. angka(2, $value['cumPlan']) .'%
                                                                </td>
                                                                <td class="text-center" style="background-color: #FFAFCC;">
                                                                    '. angka(2, $value['cumActual']) .'%
                                                                </td>
                                                                <td class="text-center" style="background-color: #FFAFCC;">
                                                                    '. angka(2, (float) $value['cumActual'] - (float) $value['cumPlan']) .'%
                                                                </td>
                                                            </tr>
                                                        ';
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
                                    </font>
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-md-12 mt-4 pt-0">
                        <div class="galon" style="background-color:#90E0EF;border: 1px solid #00B4D8;">
                            <div class="row" style="padding: 20px;padding-bottom:0">
                                <div class="col-6">
                                    <h4>Analysis (Coming soon)</h4>
                                </div>
                                <div class="col-6" style="display: flex;justify-content: flex-end;font-size:2rem;color:#0096C7">
                                    <i class="fas fa-paperclip"></i>
                                </div>
                            </div>
                            <div style="padding: 20px">
                                Analisis terkait progress engineering akan ditampilkan disini.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-12 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-add-document">
                            Add Document
                        </button>
                    </div>
                </div>
                <div class="row d-none">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="row mb-3">
                                    <div class="col-4">
                                        <label class="form-label">CUT OFF DATE: </label>
                                        <div class="input-group" id="datepicker1">
                                            <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#datepicker1" data-provide="datepicker" name="cut_off_filter" id="cut_off_filter" />
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <label class="form-label text-white">CUT OFF DATE: </label>
                                        <div>
                                            <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-add-document">
                                                Filter
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <div style="overflow-x:auto;">
                                    <font size="2">
                                        <table class="table table-striped table-bordered dt-responsive">
                                            <thead>
                                                <tr>
                                                    <th rowspan="3">WBS CODE</th>
                                                    <th rowspan="3">DOCUMENT NUMBER</th>
                                                    <th rowspan="3">DESCRIPTION</th>
                                                    <th rowspan="3">WEIGHT FACTOR</th>
                                                    <th colspan="4" class="text-center">PLAN</th>
                                                    <th colspan="4" class="text-center">ACTUAL</th>
                                                    <th rowspan="3" class="text-center">STATUS</th>
                                                    <th rowspan="3" class="text-center">ACTION</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">IFR</th>
                                                    <th class="text-center">IFA</th>
                                                    <th class="text-center">IFC</th>
                                                    <th class="text-center">CUMMULATIVE</th>
                                                    <th class="text-center">IFR</th>
                                                    <th class="text-center">IFA</th>
                                                    <th class="text-center">IFC</th>
                                                    <th class="text-center">CUMMULATIVE</th>
                                                </tr>
                                                <tr>
                                                    <th class="text-center">50%</th>
                                                    <th class="text-center">40%</th>
                                                    <th class="text-center">10%</th>
                                                    <th class="text-center">100%</th>
                                                    <th class="text-center">50%</th>
                                                    <th class="text-center">40%</th>
                                                    <th class="text-center">10%</th>
                                                    <th class="text-center">100%</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                <?php
                                                $week = 0;
                                                $weekPlan = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                                $weekActual = [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0];
                                                $weekDates = [
                                                    '15-6-2023',
                                                    '22-6-2023',
                                                    '29-6-2023',
                                                    '6-7-2023',
                                                    '13-7-2023',
                                                    '20-7-2023',
                                                    '27-7-2023',
                                                    '3-8-2023',
                                                    '10-8-2023',
                                                    '17-8-2023',
                                                    '24-8-2023',
                                                    '31-9-2023'
                                                ];
                                                $WF_IFR = 0.5;
                                                $WF_IFA = 0.4;
                                                $WF_IFC = 0.1;

                                                foreach ($list_doc_engineering as $row) :
                                                    for ($i = 0; $i < count($weekDates); $i++) {
                                                        $date = world_date($row->plan_ifr);
                                                        $targetDate = world_date($weekDates[$i]);

                                                        if ($date <= $targetDate) {
                                                            $weekPlan[$i] += $WF_IFR * $row->weight_factor;
                                                            break; // Exit the loop
                                                        }
                                                    }

                                                    for ($i = 0; $i < count($weekDates); $i++) {
                                                        $date = world_date($row->plan_ifa);
                                                        $targetDate = world_date($weekDates[$i]);

                                                        if ($date <= $targetDate) {
                                                            $weekPlan[$i] += $WF_IFA * $row->weight_factor;
                                                            break; // Exit the loop
                                                        }
                                                    }

                                                    for ($i = 0; $i < count($weekDates); $i++) {
                                                        $date = world_date($row->plan_ifc);
                                                        $targetDate = world_date($weekDates[$i]);

                                                        if ($date <= $targetDate) {
                                                            $weekPlan[$i] += $WF_IFC * $row->weight_factor;
                                                            break; // Exit the loop
                                                        }
                                                    }

                                                    // set plan cumulative
                                                    $plan_cumulative = 0;
                                                    if (world_date($row->plan_ifr) <= date_now()) {
                                                        $plan_cumulative += $WF_IFR * $row->weight_factor;
                                                    }
                                                    if (world_date($row->plan_ifa) <= date_now()) {
                                                        $plan_cumulative += $WF_IFA * $row->weight_factor;
                                                    }
                                                    if (world_date($row->plan_ifc) <= date_now()) {
                                                        $plan_cumulative += $WF_IFC * $row->weight_factor;
                                                    }

                                                    // set actual cumulative
                                                    $actual_cumulative = 0;
                                                    if ($row->actual_ifr) {
                                                        $actual_cumulative += $WF_IFR * $row->weight_factor;

                                                        for ($i = 0; $i < count($weekDates); $i++) {
                                                            $date = world_date($row->actual_ifr);
                                                            $targetDate = world_date($weekDates[$i]);

                                                            if ($date <= $targetDate) {
                                                                $weekActual[$i] += $WF_IFR * $row->weight_factor;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    if ($row->actual_ifa) {
                                                        $actual_cumulative += $WF_IFA * $row->weight_factor;

                                                        for ($i = 0; $i < count($weekDates); $i++) {
                                                            $date = world_date($row->actual_ifa);
                                                            $targetDate = world_date($weekDates[$i]);

                                                            if ($date <= $targetDate) {
                                                                $weekActual[$i] += $WF_IFA * $row->weight_factor;
                                                                break;
                                                            }
                                                        }
                                                    }
                                                    if ($row->actual_ifc) {
                                                        $actual_cumulative += $WF_IFC * $row->weight_factor;

                                                        for ($i = 0; $i < count($weekDates); $i++) {
                                                            $date = world_date($row->actual_ifc);
                                                            $targetDate = world_date($weekDates[$i]);

                                                            if ($date <= $targetDate) {
                                                                $weekActual[$i] += $WF_IFC * $row->weight_factor;
                                                                break; // Exit the loop
                                                            }
                                                        }
                                                    }

                                                    // set variance status
                                                    if ($actual_cumulative == $plan_cumulative) {
                                                        $status = '<span class="badge bg-success p-2 w-xs">ON TRACK</span>';
                                                    } else if ($actual_cumulative > $plan_cumulative) {
                                                        $status = '<span class="badge bg-info p-2 w-xs">AHEAD</span>';
                                                    } else {
                                                        $status = '<span class="badge bg-danger p-2 w-xs">LATE</span>';
                                                    }


                                                    $linkFile = base_url('upload/doc_engineering/' . $row->file);
                                                    $file_version = $row->file_version ? $row->file_version : 'nothing';
                                                    // set actual IFR status
                                                    if ($row->actual_ifr) {
                                                        $actual_ifr = tgl_indo($row->actual_ifr) .
                                                            '
                                                            <br>
                                                                Issued V ' . $row->file_version . '
                                                            <br>
                                                                <a href="#" class="badge bg-success mt-1 p-2 w-xs" id="btn-check-approved" 
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-link_file = "' . $linkFile . '"
                                                                    data-step = "IFR"
                                                                    data-version = "' . $file_version . '"
                                                                >
                                                                    &nbsp;DETAIL&nbsp;
                                                                </a>
                                                            ';
                                                    } else {
                                                        $actual_ifr = '
                                                                no date yet
                                                            <br>
                                                                no file yet
                                                            <br>
                                                                <a href="#" class="badge bg-warning mt-1 p-2 w-xs" id="btn-upload-file" 
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-path = "Project_detail_engineering/update/upload_file"
                                                                    data-step = "IFC"
                                                                    data-version = "' . $file_version . '"
                                                                >
                                                                    &nbsp;UP FILE&nbsp;
                                                                </a>
                                                            ';
                                                    }

                                                    // set actual IFA status
                                                    if ($row->actual_ifa) {
                                                        $actual_ifa = tgl_indo($row->actual_ifa) .
                                                            '
                                                            <br>
                                                                Approved V ' . $row->file_version . '
                                                            <br>
                                                                <a href="#" class="badge bg-success mt-1 p-2 w-xs" id="btn-check-approval" 
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-link_file = "' . $linkFile . '"
                                                                    data-step = "IFA"
                                                                    data-version = "' . $row->file_version . '"
                                                                >
                                                                    &nbsp;DETAIL&nbsp;
                                                                </a>
                                                            ';
                                                    } else if ($row->actual_ifr) {
                                                        $actual_ifa = tgl_indo($row->actual_ifr) .
                                                            '
                                                            <br>
                                                                Issued V ' . $row->file_version . '
                                                            <br>
                                                                <a href="#" class="badge bg-info mt-1 p-2 w-xs" id="btn-approval" 
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-link_file = "' . $linkFile . '"
                                                                    data-step = "IFA"
                                                                    data-version = "' . $file_version . '"
                                                                >
                                                                    &nbsp;DETAIL&nbsp;
                                                                </a>
                                                            ';
                                                    } else {
                                                        $actual_ifa = '
                                                                no date yet
                                                            <br>
                                                                no file yet
                                                            <br>
                                                                <a href="javascript:waitingSwal();" class="badge bg-warning mt-1 p-2 w-xs" >
                                                                    &nbsp;WAITING&nbsp;
                                                                </a>
                                                            ';
                                                    }

                                                    // set actual IFC status
                                                    if ($row->actual_ifc_file) {
                                                        $actual_ifc = tgl_indo($row->actual_ifc) .
                                                            '
                                                            <br>
                                                                Appproved V ' . $row->file_version . '
                                                            <br>
                                                                <a href="#" class="badge bg-success mt-1 p-2 w-xs" id="btn-check-approval" 
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-link_file = "' . $linkFile . '"
                                                                    data-step = "IFC"
                                                                    data-version = "' . $row->file_version . '"
                                                                >
                                                                    &nbsp;DETAIL&nbsp;
                                                                </a>
                                                            ';
                                                    } else if ($row->actual_ifa) {
                                                        $actual_ifc = tgl_indo($row->actual_ifa) .
                                                            '
                                                            <br>
                                                                Issued V ' . $row->file_version . '
                                                            <br>
                                                                <a href="#" class="badge bg-info mt-1 p-2 w-xs" id="btn-approval" 
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-link_file = "' . $linkFile . '"
                                                                    data-step = "IFC"
                                                                    data-version = "' . $file_version . '"
                                                                >
                                                                    &nbsp;DETAIL&nbsp;
                                                                </a>
                                                            ';
                                                    } else {
                                                        $actual_ifc = '
                                                                no date yet
                                                            <br>
                                                                no file yet
                                                            <br>
                                                                <a href="javascript:waitingSwal();" class="badge bg-warning mt-1 p-2 w-xs" >
                                                                    &nbsp;WAITING&nbsp;
                                                                </a>
                                                            ';
                                                    }
                                                ?>
                                                    <tr>
                                                        <td nowrap><?= $row->level_code ?></td>
                                                        <td class="text-center" nowrap> - </td>
                                                        <td><?= $row->description ?></td>
                                                        <td class="text-center"><?= $row->weight_factor ?>%</td>
                                                        <td class="text-center" nowrap><?= tgl_indo($row->plan_ifr) ?></td>
                                                        <td class="text-center" nowrap><?= tgl_indo($row->plan_ifa) ?></td>
                                                        <td class="text-center" nowrap><?= tgl_indo($row->plan_ifc) ?></td>
                                                        <td class="text-center"><?= $plan_cumulative ?>%</td>
                                                        <td class="text-center" nowrap><?= $actual_ifr ?></td>
                                                        <td class="text-center" nowrap><?= $actual_ifa ?></td>
                                                        <td class="text-center" nowrap><?= $actual_ifc ?></td>
                                                        <td class="text-center"><?= $actual_cumulative ?>%</td>
                                                        <td class="text-center">
                                                            <a href="document-timeline/<?= $row->id ?>">
                                                                <?= $status ?>
                                                            </a>
                                                        </td>
                                                        <td class="text-center" nowrap>
                                                            <a href="#" id="btn-edit-doc" data-bs-toggle="modal" data-bs-target="#modal-edit" data-id="<?= $row->id ?>" data-level_code="<?= $row->level_code ?>" data-description="<?= $row->description ?>" data-weight_factor="<?= $row->weight_factor ?>" data-plan_ifr="<?= tgl_indo($row->plan_ifr) ?>" data-plan_ifa="<?= tgl_indo($row->plan_ifa) ?>" data-plan_ifc="<?= tgl_indo($row->plan_ifc) ?>">
                                                                <i class="ri-pencil-fill text-info font-size-20"></i>
                                                            </a>
                                                            &nbsp;
                                                            <a href="#" id="btn-hapus-doc" data-id="<?= $row->id ?>" data-object="Project_detail_engineering/delete">
                                                                <i class="ri-delete-bin-6-fill text-danger font-size-20"></i>
                                                            </a>
                                                        </td>
                                                    </tr>
                                                <?php endforeach; ?>
                                                <?php
                                                for ($i_cum_plan = 1; $i_cum_plan < count($weekPlan); $i_cum_plan++) {
                                                    $weekPlan[$i_cum_plan] += $weekPlan[$i_cum_plan - 1];
                                                }
                                                for ($i_cum_act = 1; $i_cum_act < count($weekActual); $i_cum_act++) {
                                                    $weekActual[$i_cum_act] += $weekActual[$i_cum_act - 1];
                                                }
                                                for ($week_counter = 0; $week_counter < count($weekPlan); $week_counter++) {
                                                    echo '
                                                            <input type="hidden" id="week_plan_' . $week_counter . '" value="' . $weekPlan[$week_counter] . '" />
                                                            <input type="hidden" id="week_actual_' . $week_counter . '" value="' . $weekActual[$week_counter] . '" />
                                                        ';
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </font>
                                </div>
                            </div>

                        </div>
                    </div> <!-- end col -->
                </div> <!-- end row -->

            </div> <!-- container-fluid -->
        </div>
        <!-- End Page-content -->

        <?= $this->include('partials/footer') ?>
    </div>
    <!-- end main content-->
    <script>
        function createChart() {
            console.log(Object.entries(<?= json_encode($data_chart_man_hour) ?>), 'fuadi data_chart_man_hour');
            const data_chart_man_hour = Object.entries(<?= json_encode($data_chart_man_hour) ?>)
            console.log(data_chart_man_hour, 'data awal');

            let label = []
            let datas = []
            let civilPlan = []
            let electricalPlan = []
            let instrumentPlan = []
            let mechanicalPlan = []
            let pipingPlan = []
            let processPlan = []
            let civilActual = []
            let electricalActual = []
            let instrumentActual = []
            let mechanicalActual = []
            let pipingActual = []
            let processActual = []
            data_chart_man_hour.map((data) => {
                label.push(data[0])
                let dt = data[1]

                // plan
                civilPlan.push(dt.plan.man_hour_per_discipline.civil)
                electricalPlan.push(dt.plan.man_hour_per_discipline.electrical)
                instrumentPlan.push(dt.plan.man_hour_per_discipline.instrument)
                mechanicalPlan.push(dt.plan.man_hour_per_discipline.mechanical)
                pipingPlan.push(dt.plan.man_hour_per_discipline.piping)
                processPlan.push(dt.plan.man_hour_per_discipline.process)

                // actual
                civilActual.push(dt.actual.man_hour_per_discipline.civil)
                electricalActual.push(dt.actual.man_hour_per_discipline.electrical)
                instrumentActual.push(dt.actual.man_hour_per_discipline.instrument)
                mechanicalActual.push(dt.actual.man_hour_per_discipline.mechanical)
                pipingActual.push(dt.actual.man_hour_per_discipline.piping)
                processActual.push(dt.actual.man_hour_per_discipline.process)
            })
            datas.push({
                name: "civilActual",
                stack: 'plan',
                data: civilActual
            }, {
                name: "electricalPlan",
                stack: 'plan',
                data: electricalPlan
            }, {
                name: "instrumentPlan",
                stack: 'plan',
                data: instrumentPlan
            }, {
                name: "mechanicalPlan",
                stack: 'plan',
                data: mechanicalPlan
            }, {
                name: "pipingPlan",
                stack: 'plan',
                data: pipingPlan
            }, {
                name: "processPlan",
                stack: 'plan',
                data: processPlan
            }, {
                name: "civilActual",
                stack: 'actual',
                data: civilActual
            }, {
                name: "electricalActual",
                stack: 'actual',
                data: electricalActual
            }, {
                name: "instrumentActual",
                stack: 'actual',
                data: instrumentActual
            }, {
                name: "mechanicalActual",
                stack: 'actual',
                data: mechanicalActual
            }, {
                name: "pipingActual",
                stack: 'actual',
                data: pipingActual
            }, {
                name: "processActual",
                stack: 'actual',
                data: processActual
            }, )
            console.log(datas, 'fuadi all');

            $("#chart_man_hour").kendoChart({
                // title: {
                //     text: "Practice Versoon"
                // },
                legend: {
                    visible: false
                },
                seriesDefaults: {
                    type: "column"
                },
                // series: [{
                //         name: "Auto",
                //         stack: "minggu 1",
                //         data: [10, 20, 30, 40], // plan
                //     }, {
                //         name: "Silver Medals",
                //         stack: "minggu 1",
                //         data: [30, 40], // actual
                //     }, {
                //         name: "Silver Medals",
                //         stack: "minggu 2",
                //         data: [1, 2],
                //     },
                //     {
                //         name: "Silver Medals",
                //         stack: "minggu 2",
                //         data: [3, 4],
                //     }
                // ],
                series: datas,
                valueAxis: {
                    line: {
                        visible: false
                    }

                },
                categoryAxis: {
                    // categories: ['minggu 1', 'Minggu 2'],
                    categories: label,
                    majorGridLines: {
                        visible: false
                    }
                },
                tooltip: {
                    visible: true,
                    template: "#= series.name #: #= value #"
                }
            });
        }

        $(document).ready(createChart());
        $(document).bind("kendo:skinChange", createChart);
    </script>
</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>
</body>

</html>

<script src="assets/libs/jquery-knob/jquery.knob.min.js"></script>
<script src="assets/js/pages/jquery-knob.init.js"></script>
<script src="<?= base_url('assets/libs/select2/js/select2.min.js') ?>"></script>

<script>
    // chart
    // ===========================================================================================
    let cum_percent_counter = 0;
    let total_done_doc_counter = 0;
    let total_doc_counter = parseInt(<?= $total_doc ?>);

    console.log('scurve data');
    console.log(<?= json_encode($scurveData) ?>);
    console.log('progress chart data');
    console.log(<?= json_encode($progressChartData) ?>);
    console.log('doc progress');
    console.log(<?= json_encode($docProgress) ?>);
    console.log(<?= json_encode($manHourPerWeek) ?>, 'man hour by week');
    console.log(<?= json_encode($progressByDicipline) ?>, 'progressByDicipline');

    //  Scurve mdr
    let weekList = [],
        dataPlan = [],
        dataActual = [],
        cek = document.getElementById("week_plan_0").value;

    weeklist = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12];

    for (var i = 0; i < weeklist.length; i++) {
        dataPlan.push(document.getElementById("week_plan_" + i).value);
    }

    dataActual.push(document.getElementById("week_actual_0").value);
    for (var i = 1; i < weeklist.length; i++) {
        if (document.getElementById("week_actual_" + i).value != document.getElementById("week_actual_" + (i - 1)).value) {
            dataActual.push(document.getElementById("week_actual_" + i).value);
        }
    }

    let data_doc = <?= json_encode($list_doc_engineering) ?>

    var options_scurve_mdr = {
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
        colors: ['#5664d2', '#1cbb8c'],
        dataLabels: {
            enabled: false,
        },
        stroke: {
            width: [3, 3],
            curve: 'straight'
        },
        series: [{
                name: "Plan",
                data: dataPlan
            },
            {
                name: "Actual",
                data: dataActual
            }
        ],
        // title: {
        //     text: 'SCurve Project',
        //     align: 'left'
        // },
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
            categories: weekList,
            title: {
                text: 'Weeks'
            }
        },
        yaxis: {
            title: {
                text: 'Progress in percent'
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
        document.querySelector("#scurve_mdr_1"),
        options_scurve_mdr
    );
    chart.render();

    // Structural chart
    var options_structural = {
        chart: {
            height: 150,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        fontSize: '15px',
                        show: true,
                        offsetY: 4
                    },
                    total: {
                        show: false,
                    },
                    margin: 15,
                    color: "#5664d2"
                }
            }
        },
        series: [44],
        labels: ['Done'],
        colors: ['#5664d2'],
    };
    var chart_structural = new ApexCharts(
        document.querySelector("#structural_chart"),
        options_structural
    );
    chart_structural.render();

    // mechanical chart
    var options_mechanical = {
        chart: {
            height: 150,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        fontSize: '15px',
                        show: true,
                        offsetY: 4
                    },
                    total: {
                        show: false,
                    },
                    margin: 15,
                    color: "#5664d2"
                }
            }
        },
        series: [44],
        labels: ['Done'],
        colors: ['#5664d2'],
    };
    var chart_mechanical = new ApexCharts(
        document.querySelector("#mechanical_chart"),
        options_mechanical
    );
    chart_mechanical.render();

    // electrical chart
    var options_electrical = {
        chart: {
            height: 150,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        fontSize: '15px',
                        show: true,
                        offsetY: 4
                    },
                    total: {
                        show: false,
                    },
                    margin: 15,
                    color: "#5664d2"
                }
            }
        },
        series: [44],
        labels: ['Done'],
        colors: ['#5664d2'],
    };
    var chart_electrical = new ApexCharts(
        document.querySelector("#electrical_chart"),
        options_electrical
    );
    chart_electrical.render();

    // equipment chart
    var options_equipment = {
        chart: {
            height: 150,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                dataLabels: {
                    name: {
                        show: false,
                    },
                    value: {
                        fontSize: '15px',
                        show: true,
                        offsetY: 4
                    },
                    total: {
                        show: false,
                    },
                    margin: 15,
                    color: "#5664d2"
                }
            }
        },
        series: [44],
        labels: ['Done'],
        colors: ['#5664d2'],
    };
    var chart_equipment = new ApexCharts(
        document.querySelector("#equipment_chart"),
        options_equipment
    );
    chart_equipment.render();

    // Mixed chart ========================================================================================================
    const startDate = new Date('<?= json_encode($data_date_range[0]->min_date_range) ?>');
    let endDate = new Date('<?= json_encode($data_date_range[0]->max_date_range) ?>');
    const labels_mixed_chart1 = [];
    const data_weight_factor_plan = <?= json_encode($data_weight_factor_plan) ?>;

    data_weight_factor_plan.forEach(function(list) {
        // Get the month name in short format (e.g., 'Jan', 'Feb', etc.)
        const monthName = new Date(Date.parse(`${list.month} 1, ${list.year}`)).toLocaleString('default', {
            month: 'short'
        });

        // Construct label in the desired format (e.g., 'MMM YYYY' for abbreviated month name and year)
        const label = `${monthName} ${list.year}`;
        labels_mixed_chart1.push(label);
    });

    const data_weight_factor = <?= json_encode($data_weight_factor) ?>;
    const actual_mixed_chart = [];
    data_weight_factor.forEach(function(list) {
        actual_mixed_chart.push(list.weight_factor);
        total_done_doc_counter += 1;
    });

    const cum_actual_mixed_chart = [];
    let sum = 0;
    actual_mixed_chart.forEach(function(value) {
        sum += parseFloat(value);
        cum_actual_mixed_chart.push(sum);
        cum_percent_counter = sum;
    });

    const plan_mixed_chart = [];
    data_weight_factor_plan.forEach(function(list) {
        plan_mixed_chart.push(list.weight_factor_sum);
    });

    const cum_plan_mixed_chart = [];
    let sum_plan = 0;
    plan_mixed_chart.forEach(function(value) {
        sum_plan += parseFloat(value);
        cum_plan_mixed_chart.push(sum_plan);
    });

    console.log({
        data_weight_factor_plan,
        actual_mixed_chart,
        cum_actual_mixed_chart,
        plan_mixed_chart,
        cum_plan_mixed_chart
    }, 'fuadi data  ')

    const scurveData = <?= json_encode($scurveData) ?>;
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
    var optionsMixed = {
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
    var chartMixed = new ApexCharts(
        document.querySelector("#scurve_mdr"),
        optionsMixed
    );
    chartMixed.render();

    // Percent chart ================================================================================================
    // var options_percent = {
    //     chart: {
    //         height: 200,
    //         type: 'donut',
    //     },
    //     series: [cum_percent_counter, 100 - cum_percent_counter],
    //     labels: ["Complete", "Waiting"],
    //     colors: ["#FFB703", "#219EBC"],
    //     legend: {
    //         show: false,
    //         position: 'bottom',
    //         horizontalAlign: 'center',
    //         verticalAlign: 'middle',
    //         floating: false,
    //         fontSize: '14px',
    //         offsetX: 0,
    //         offsetY: 5
    //     },
    //     responsive: [{
    //         breakpoint: 600,
    //         options: {
    //             chart: {
    //                 height: 100
    //             },
    //             legend: {
    //                 show: false
    //             },
    //         }
    //     }]
    // }
    const progressChartData = <?= json_encode($progressChartData) ?>;
    console.log(progressChartData, 'fuadi progressChartData');

    var options_percent = {
        chart: {
            height: 250,
            type: 'radialBar',
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '20%',
                },
                dataLabels: {
                    name: {
                        fontSize: '14',
                    },
                    value: {
                        fontSize: '14px',
                    },
                    total: {
                        show: false,
                        label: 'Total',
                        formatter: function(w) {
                            return 249
                        }
                    },
                    // margin: 15,
                }
            }
        },
        series: [parseFloat(progressChartData.percent_plan[0].cum_progress_plan).toFixed(2), parseFloat(progressChartData.percent_actual[0].cum_progress_actual).toFixed(2)],
        labels: ['Plan', 'Actual'],
        colors: ["#FFB703", "#219EBC"],
        legend: {
            offsetY: 5
        }

    }
    var chart_percent = new ApexCharts(
        document.querySelector("#percent_chart"),
        options_percent
    );
    chart_percent.render();

    // Document chart ==============================================================================================
    // var options_document = {
    //     chart: {
    //         height: 200,
    //         type: 'donut',
    //     },
    //     series: [total_done_doc_counter, total_doc_counter - total_done_doc_counter],
    //     labels: ["Complete Document", "Waiting Document"],
    //     colors: ["#E9C46A", "#2A9D8F"],
    //     legend: {
    //         show: false,
    //         position: 'bottom',
    //         horizontalAlign: 'center',
    //         verticalAlign: 'middle',
    //         floating: false,
    //         fontSize: '14px',
    //         offsetX: 0,
    //         offsetY: 5
    //     },
    //     responsive: [{
    //         breakpoint: 600,
    //         options: {
    //             chart: {
    //                 height: 100
    //             },
    //             legend: {
    //                 show: false
    //             },
    //         }
    //     }]
    // }
    const max = progressChartData.doc_total

    function valueToPercent(value) {
        return (value * 100) / max
    }

    // var options_document = {
    //     chart: {
    //         height: 250,
    //         type: 'radialBar',
    //         max: 200,
    //     },
    //     plotOptions: {
    //         radialBar: {
    //             hollow: {
    //                 size: '20%',
    //             },
    //             hover: {
    //                 enabled: false, // Menonaktifkan hover
    //             },
    //             dataLabels: {
    //                 name: {
    //                     fontSize: '14',
    //                 },
    //                 value: {
    //                     show: false,
    //                     fontSize: '14px',
    //                     formatter: function(val) {
    //                         return val + ' Document'; // Return value as string without percentage symbol
    //                     },
    //                 },
    //                 total: {
    //                     show: false,
    //                     label: 'Total',
    //                     formatter: function(w) {
    //                         return progressChartData.doc_total
    //                     }
    //                 },
    //                 // margin: 15,
    //             }
    //         }
    //     },
    //     series: [valueToPercent(progressChartData.doc_plan[0].total_plan_doc), valueToPercent(progressChartData.doc_actual[0].total_actual_doc)],
    //     labels: ["Plan", "Actual"],
    //     colors: ["#E9C46A", "#2A9D8F"],
    //     legend: {
    //         offsetY: 5
    //     }

    // }
    // var chart_document = new ApexCharts(
    //     document.querySelector("#document_chart"),
    //     options_document
    // );
    // chart_document.render();

    const data_chart_man_hour = <?= json_encode($data_chart_man_hour) ?>

    let dicipline_name = []
    let man_hour_actual = []
    let man_hour_plan = []
    // data_chart_man_hour.map((dt) => {
    //     dicipline_name.push(dt.dicipline_name);
    //     man_hour_actual.push(dt.man_hour_actual);
    //     man_hour_plan.push(dt.man_hour_plan);
    // })

    // var options_man_power = {
    //     series: [{
    //         name: 'Plan',
    //         data: man_hour_plan
    //     }, {
    //         name: 'Actual',
    //         data: man_hour_actual
    //     }],
    //     chart: {
    //         type: 'bar',
    //         height: 350,
    //         stacked: true,
    //     },
    //     colors: ['#CAFFBF', "#9BF6FF"],
    //     // colors: ['#FFFF66', '#FFA500'],
    //     plotOptions: {
    //         bar: {
    //             horizontal: false,
    //             dataLabels: {
    //                 total: {
    //                     enabled: true,
    //                     offsetX: 0,
    //                     style: {
    //                         fontSize: '13px',
    //                         fontWeight: 900,
    //                     }
    //                 }
    //             },
    //         },
    //     },
    //     stroke: {
    //         width: 1,
    //         colors: ['#fff']
    //     },
    //     xaxis: {
    //         categories: dicipline_name,
    //         labels: {
    //             formatter: function(val) {
    //                 return val
    //             }
    //         }
    //     },
    //     yaxis: {
    //         title: {
    //             text: undefined
    //         },
    //     },
    //     tooltip: {
    //         y: {
    //             formatter: function(val) {
    //                 return val + "People"
    //             }
    //         }
    //     },
    //     fill: {
    //         opacity: 1
    //     },
    //     legend: {
    //         position: 'top',
    //         horizontalAlign: 'left',
    //         offsetX: 40
    //     },

    // }
    // var options = {
    //     series: [{
    //             name: 'Q1 Budget',
    //             group: 'budget',
    //             data: [44000, 55000, 41000, 67000, 22000]
    //         },
    //         {
    //             name: 'Q1 Actual',
    //             group: 'actual',
    //             data: [48000, 50000, 40000, 65000, 25000]
    //         },
    //         {
    //             name: 'Q2 Budget',
    //             group: 'budget',
    //             data: [13000, 36000, 20000, 8000, 13000]
    //         },
    //         {
    //             name: 'Q2 Actual',
    //             group: 'actual',
    //             data: [20000, 40000, 25000, 10000, 12000]
    //         }
    //     ],
    //     chart: {
    //         type: 'bar',
    //         height: 350,
    //         stacked: true,
    //     },
    //     stroke: {
    //         width: 1,
    //         colors: ['#fff']
    //     },
    //     dataLabels: {
    //         formatter: (val) => {
    //             return val / 1000 + 'K'
    //         }
    //     },
    //     plotOptions: {
    //         bar: {
    //             horizontal: true
    //         }
    //     },
    //     xaxis: {
    //         categories: [
    //             'Online advertising',
    //             'Sales Training',
    //             'Print advertising',
    //             'Catalogs',
    //             'Meetings'
    //         ],
    //         labels: {
    //             formatter: (val) => {
    //                 return val / 1000 + 'K'
    //             }
    //         }
    //     },
    //     fill: {
    //         opacity: 1,
    //     },
    //     colors: ['#80c7fd', '#008FFB', '#80f1cb', '#00E396'],
    //     legend: {
    //         position: 'top',
    //         horizontalAlign: 'left'
    //     }
    // };

    // var chart = new ApexCharts(document.querySelector("#chart_man_hour"), options);
    // chart.render();
    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Pilih opsi',
            maximumSelectionLength: 2 // contoh konfigurasi tambahan
        });
        // cum_percent_counter, 100 - cum_percent_counter
        // total_done_doc_counter, total_doc_counter - total_done_doc_counter
        $('#complete').html(`Plan: ${parseFloat(progressChartData.percent_plan[0].cum_progress_plan).toFixed(2)}%`)
        $('#waiting').html(`Actual: ${parseFloat(progressChartData.percent_actual[0].cum_progress_actual).toFixed(2)}%`)
        // $('#complete_doc').html(`Plan: ${progressChartData.doc_plan[0].total_plan_doc}`)
        // $('#waiting_doc').html(`Actual: ${(progressChartData.doc_actual[0].total_actual_doc)}`)
        // $('#total_doc').html(`Total Doc: ${progressChartData.doc_total}`)
        // $('#complete').html(`Plan: 5%`)
        // $('#waiting').html(`Actual: 72%`)
    });
</script>
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>
