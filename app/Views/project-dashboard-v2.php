<?= $this->include('partials/main') ?>

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <link href="<?= base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css">
    <style>
        /* CSS untuk menentukan latar belakang div */
        .background-div {
            background-image: url('assets/images/helm.jpg');
            background-size: cover;
            background-position: center;
            /* background-color: '#4aa3ff'; */
            /* opacity: 0.8; */
            /* z-index: -100 */
        }

        .galon {
            border-radius: 20px;
            box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);
            /* height: 200px; */
            background-color: #ffffff;
        }

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

        /* CSS untuk hover */
        .selectable:hover {
            background-color: rgba(255, 255, 240, 0.9);
            ;
            /* Warna biru muda */
            border-color: #2c3e50;
            /* Warna biru tua */
            cursor: pointer;
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
                <!--Modal Add Document-->
                <div class="modal fade" id="modal_add_project_milestone" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-sm modal-dialog-centered">
                        <form action="#" method="POST">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="col-md-12">
                                        <label class="form-label">Actual/Forecast Date</label>
                                        <div class="input-group" id="ifr_date">
                                            <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifr_date" data-provide="datepicker" name="plan_ifr" id="plan_ifr" />
                                            <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-success" id="btn-simpan-doc" title="Add Data" data-object="Project_detail_engineering/add/doc_engineering">Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->
                <small class="form-label">CUT OFF WEEK: </small>
                <!-- <div class="col-md-4">
                    <div class="input-group mb-4" id="datepicker1" style="border-radius: 10px;">
                        <input type="text" class="form-control rounded-start" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#datepicker1" data-provide="datepicker" name="cut_off_filter" id="cut_off_filter" style="border-radius: 15px 0 0 15px !important;" />
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_add_project_milestone" style="border-top-right-radius: 15px; border-bottom-right-radius: 15px;">
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
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal_add_project_milestone">
                            Filter
                        </button>
                    </div>
                </div>
                <div class="row mb-5">
                    <div class="col-xl-12">
                        <div class="row mb-3">
                            <div class="row col-md-4">
                                <div class="col-md-4">
                                    <div class="galon d-flex align-items-center" style="border: 10px solid #fff;height: 200px; background: linear-gradient(to top, var(--bs-success) 0%, 
                                        var(--bs-success) <?= $data_page->overal_plan ?>%, #ffffff 0%, #ffffff 100%);">
                                        <div style="background-color:white;padding: 10px;border-radius: 20px;">
                                            <h3 class="mb-0 text-center"><?= $data_page->overal_plan ?>%</h3>
                                            <h5 class="card-title text-truncate font-size-14 mb-2 text-center">Plan</h5>
                                            <div style="display: flex; justify-content: center; align-items: center;">
                                                <i class="fas fa-ruler-combined" style="font-size: 3rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="galon d-flex align-items-center" style="border: 10px solid #fff;height: 200px; background: linear-gradient(to top, var(--bs-warning) 0%, 
                                    var(--bs-warning) <?= $data_page->overal_actual ?>%, #ffffff 0%, #ffffff 100%);">
                                        <div style="background-color:white;padding: 10px;border-radius: 20px;">
                                            <h3 class="mb-0 text-center"><?= $data_page->overal_actual ?>%</h3>
                                            <h5 class="card-title text-truncate font-size-14 mb-2 text-center">Actual</h5>
                                            <div style="display: flex; justify-content: center; align-items: center;">
                                                <i class="fas fa-glasses" style="font-size: 3rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="galon d-flex align-items-center" style="border: 10px solid #fff;height: 200px; background: linear-gradient(to top, var(--bs-danger) 0%, 
                                    var(--bs-danger) <?= $data_page->overal_variance ?>%, #ffffff 0%, #ffffff 100%);">
                                        <div style="background-color:white;padding: 10px;border-radius: 20px;">
                                            <h3 class="mb-0 text-center">-<?= $data_page->overal_variance ?>%</h3>
                                            <h5 class="card-title text-truncate font-size-14 mb-2 text-center">Variance</h5>
                                            <div style="display: flex; justify-content: center; align-items: center;">
                                                <i class="far fa-chart-bar" style="font-size: 3rem;"></i>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="galon" style="padding: 15px;padding-top: 10px">
                                    <div class="text-center">
                                        <span> Progress Tracking</span>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="selectable" id="Detail-Engineering" style="border: 1px solid #E0E0E0; border-radius: 8px;">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div id="radial_chart_1" class="apex-charts m-0 p-0"></div>
                                                    </div>
                                                    <div class="col-5" style="padding-left:0;text-align: left;display:flex;flex-direction:column;justify-content: center;">
                                                        <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                            <div class="dot" style="background-color: rgba(86, 100, 210, 0.85);"></div>
                                                            <small><strong>Plan <?= number_format(floatval($progressChartDataEngineering['percent_plan'][0]->cum_progress_plan), 2) ?>%</strong></small>

                                                        </div>
                                                        <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                            <div class="dot" style="background-color: #fcb92c;"></div>
                                                            <small><strong>Actual <?= number_format(floatval($progressChartDataEngineering['percent_actual'][0]->cum_progress_actual), 2) ?>%</strong></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="background-color:antiquewhite" class="text-center">
                                                    <strong><small style="padding-left: 5px;">Detail Engineering</small></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="selectable" id="Detail-Procurement" style="border: 1px solid #E0E0E0; border-radius: 8px;">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div id="radial_chart_2" class="apex-charts m-0 p-0"></div>
                                                    </div>
                                                    <div class="col-5" style="padding-left:0;text-align: left;display:flex;flex-direction:column;justify-content: center;">
                                                        <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                            <div class="dot" style="background-color: rgba(86, 100, 210, 0.85);"></div>
                                                            <small><strong>Plan <?= number_format(floatval($data_page->chart_pt_procurement_plan), 2) ?>%</strong></small>
                                                            
                                                        </div>
                                                        <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                            <div class="dot" style="background-color: #fcb92c;"></div>
                                                            <small><strong>Actual <?= number_format(floatval($data_page->chart_pt_procurement_actual), 2) ?>%</strong></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="background-color:antiquewhite" class="text-center">
                                                    <strong><small style="padding-left: 5px;">Detail Procurement</small></strong>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="selectable" id="Detail-Construction" style="border: 1px solid #E0E0E0; border-radius: 8px;">
                                                <div class="row">
                                                    <div class="col-7">
                                                        <div id="radial_chart_3" class="apex-charts m-0 p-0"></div>
                                                    </div>
                                                    <div class="col-5" style="padding-left:0;text-align: left;display:flex;flex-direction:column;justify-content: center;">
                                                        <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                            <div class="dot" style="background-color: rgba(86, 100, 210, 0.85);"></div>
                                                            <small><strong>Plan <?= number_format(floatval($data_page->chart_pt_procurement_plan), 2) ?>%</strong></small>
                                                        </div>
                                                        <div style="display: flex; justify-content: flex-start; align-items: center;">
                                                            <div class="dot" style="background-color: #fcb92c;"></div>
                                                            <small><strong>Actual <?= number_format(floatval($data_page->chart_pt_procurement_actual), 2) ?>%</strong></small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div style="background-color:antiquewhite" class="text-center">
                                                    <strong><small style="padding-left: 5px;">Detail Construction</small></strong>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-8">
                        <!-- end row -->
                        <div class="row" id="overal_progress_elem">
                            <div class="col-lg-12">
                                <div class="card" style="background-color:#B0E0E6; background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.5));border-radius: 35px">
                                    <div class="card-body" style="color:#ffffff">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="text-center" style="background-color: #3f8bd9; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                                    <h4 class="card-title mb-0" style="color:#ffffff">Overall Progress by Week</h4>
                                                </div>
                                                <!-- <h4 class="card-title mb-1">Overall Progress by Week fuad</h4> -->
                                            </div>
                                            <div class="col-sm-6 d-flex justify-content-end">
                                                <a href="project-show-over-prog-month" class="btn btn-sm btn-warning mb-3">
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
                                        <h4 class="card-title mb-1">Overall Progress by Week</h4>
                                        <a href="project-show-over-prog-month" class="btn btn-sm btn-info mb-3">
                                            Show Detail
                                        </a>
                                        <div id="line_chart_datalabel" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-6" style="padding-right: 4px;">
                                <div class="card background-divs" style="background-color: rgba(135, 206, 250, 0.9);background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.5));border-radius: 35px 0 0 35px">
                                    <div class="card-body">
                                        <div class="text-center" style="background-color: #3f8bd9; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                            <h4 class="card-title mb-0" style="color:#ffffff">Manpower by Week</h4>
                                        </div>
                                        <div id="chart_man_power_stacked" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                            <div class="col-lg-6" style="padding-left: 4px;">
                                <div class="card background-divs" style="background-color: rgba(135, 206, 250, 0.9);background-image: linear-gradient(to bottom, rgba(255, 255, 255, 0), rgba(255, 255, 255, 0.5));border-radius: 0 35px 35px 0;">
                                    <div class="card-body">
                                        <div class="text-center" style="background-color: #3f8bd9; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                            <h4 class="card-title mb-0" style="color:#ffffff">Manhour by Week</h4>
                                        </div>
                                        <div id="chart_man_hour" class="apex-charts" dir="ltr"></div>
                                    </div>
                                </div><!--end card-->
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-3" style="padding-right: 5px;">
                                <div class="galon" style="padding: 15px;padding-top: 10px;height: 100%;border-radius: 35px 0 0 35px">
                                    <div class="text-center mb-2">
                                        <div class="text-center mt-2" style="background-color: antiquewhite; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;">
                                            <i class="fas fa-funnel-dollar" style="font-size:3rem"></i>
                                            <strong class="mb-0" style="font-weight: 5000;">EVM</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div style="padding: 5px;padding-top:0%" class="col-md-6">
                                            <div class=" text-center" style="background-color:rgba(255, 255, 240, 0.9);border: 1px solid #E0E0E0; border-radius: 20px;line-height:55px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                                                <h6 class="mt-2 card-title" style="font-weight:5000">CPI</h6>
                                                <span style="font-size: 3rem;">1</span>
                                            </div>
                                        </div>
                                        <div style="padding: 5px;padding-top:0%" class="col-md-6">
                                            <div class=" text-center" style="background-color:rgba(255, 255, 240, 0.9);border: 1px solid #E0E0E0; border-radius: 20px;line-height:55px;font-family:'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif">
                                                <h6 class="mt-2 card-title" style="font-weight:5000">SPI</h6>
                                                <span style="font-size: 3rem;">-1</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" style="padding-right: 5px;padding-left: 5px">
                                <div class="galon" style="padding: 15px;padding-top: 10px;height: 100%;border-radius: 5px;background-color: rgba(255, 255, 240, 0.9)">
                                    <div class="row">
                                        <div class="col-md-6" style="padding: 10px">
                                            <div style="display: flex;align-items: center">
                                                <i class="fas fa-briefcase-medical" style="font-size: 3rem;"></i>
                                                <div style="margin-left: 5px;display: flex; flex-direction:column;justify-content:bottom; font-size: 1.5rem;line-height:1">
                                                    <strong>HSE</strong>
                                                    <strong>Peformance</strong>
                                                </div>
                                            </div>
                                            <div class="text-center mt-2" style="background-color: rgba(255, 255, 224, 0.9); display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px;border: 1px solid #E0E0E0; border-radius: 20px;font-size:4rem">
                                                <!-- <h4 class="card-title mb-0" style="color:#ffffff">Overall Progress by Week</h4> -->
                                                <strong style="font-size: 2rem;color:#fcb92c">4.022.020</strong>
                                            </div>
                                            <div class="mt-2">
                                                <strong style="font-size: 1rem;line-height:normal">Cumulative Safe Manhours</strong>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6" style="display: flex;flex-direction:column;border-right:#2c3e50 solid"><span>Man Hours This Month</span><strong>40.460</strong></div>
                                                <div class="col-md-6" style="display: flex;flex-direction:column"><span>UAUC Ratio</span><strong>40.460</strong></div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="table-responsives">
                                                <table id="datatable" class="table nowrap table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">FAR</td>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">MTC</td>
                                                            <td>1</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">MC</td>
                                                            <td>2</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">FAC</td>
                                                            <td>5</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">PD</td>
                                                            <td>3</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">Major LOPC</td>
                                                            <td>5</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">Near Miss</td>
                                                            <td>10</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">fuadi</div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3" style="padding-left: 5px;">
                                <div class="galon" style="padding: 15px;padding-top: 10px;height: 100%;border-radius: 0 35px 35px 0;background-color: rgba(255, 255, 224, 0.9);">
                                    <div class="mb-4" style="display: flex;align-items: center">
                                        <i class="mdi mdi-traffic-cone" style="font-size: 3rem;"></i>
                                        <div style="margin-left: 5px;display: flex; flex-direction:column;justify-content:bottom; font-size: 1.5rem;line-height:1">
                                            <strong>Risk</strong>
                                            <strong>Peformance</strong>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="table-responsives">
                                                <table id="datatable" class="table nowrap table-sm" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                    <tbody>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">Total Risk</td>
                                                            <td>31</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">Closed</td>
                                                            <td>23</td>
                                                        </tr>
                                                        <tr>
                                                            <td style="background-color: antiquewhite">Open</td>
                                                            <td>8</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-md-6 text-center">
                                            <strong style="font-size: 2rem;color:#fcb92c">0</strong><br>
                                            <strong>Overdue Action Item</strong>
                                        </div>
                                        <!-- <div class="col-md-4">fuadi</div> -->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-xl-12">
                                <div class="galon" style="background-color:#90E0EF;border: 1px solid #00B4D8;">
                                    <div class="row" style="padding: 20px;padding-bottom:0">
                                        <div class="col-6">
                                            <h4>Schedule Analysis Biak</h4>
                                        </div>
                                        <div class="col-6" style="display: flex;justify-content: flex-end;font-size:2rem;color:#0096C7">
                                            <i class="fas fa-paperclip"></i>
                                        </div>
                                        <span>Schedule Update cut off 7 Juni 2024<span>
                                                <div class="table-responsive">
                                                    <table id="datatable" class="table nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                        <thead style="background-color: #00B4D8">
                                                            <tr>
                                                                <th style="text-align: left;">Milestone</th>
                                                                <th>Baseline</th>
                                                                <th>Forecast</th>
                                                                <th>Delay</th>

                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td style="text-align: left;">Operational Acceptance</td>
                                                                <td nowrap>27 Juni 25</td>
                                                                <td>20 Sept 25</td>
                                                                <td>-85 Hari</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                    </div>
                                    <div style="padding: 20px">
                                        <span style="font-weight: 700;">Schedule Analysis</span>
                                        <p>
                                            Berdasarkan schedule update di ketahui bahwa keterlambatan disebabkan oleh lambatnya persetujuan dokumen engineering sipil yg berhubungan dengan jetty yg disebabkan oleh Technical Query yg belum di jawab oleh Klien sehingga berdampak pada lambatnya pekerjaan Pilling Jetty Offshore, dan struktur.
                                            Untuk saat ini, longest path yg menyebabkan keterlambatan proyek adalah pekerjaan struktur jetty sampai pemasangan pipa; dan penambahan pekerjaan seperti dredging dan preboring.
                                        </p>
                                        <span style="font-weight: 700;">Resiko pada schedule:</span>
                                        <ul>
                                            <li>
                                                Schedule quality masih di pertanyakan terutama dengan adanya 180 open ended activity, dan 132 out of sequence yg disebabkan successor activity berjalan sebelum predecessor activity selesai. Disarankan error di perbaiki terutama untuk open ended dan out of sequence untuk mendapatkan schedule yg lebih akurat
                                            </li>
                                            <li>
                                                Resiko berikutnya terdapat pada durasi konstruksi yg terasa terlalu pendek, namun kami tidak memiliki quatity dan duration basis sehingga perlu Analisa produktifitas lebih lanjut
                                            </li>
                                            <li>
                                                Perlunya segera di finalisasi antara engineering PP dengan klien sehingga semua quantity, spec dan datasheet terselesaikan untuk dapat lebih lanjut ke tahap procurement
                                            </li>
                                        </ul>
                                        <strong style="font-weight: 700;">Mitigasi :</strong>
                                        <ul>
                                            <li>
                                                Diketahui bahwa adanya CO yg berhubungan dengan pekerjaan dredging yg mempengaruhi critical path, sehingga notifikasi dan indikasi sudah harus diberikan kepada klien atas dampak terhadap keterlambatan proyek. Dalam CO harus ada indikasi schedule impact dan harus di setujui oleh klien. Keterlambatan proyek ini bisa di absorb dengan aplikasi EOT yang disetujui nantinya. </li>
                                            <li>
                                                Untuk akselarasi konstruksi, saat ini di asumsikan menggunakan 2 pilling machine secara bersamaan, di sarankan untuk menambah pilling machine untuk menambah akselarasi. </li>
                                            <li>
                                                Pekerjaan pipa, diharapkan ada beberapa pipa yg bisa di buat secara fab shop sehingga mengurangi rendahnya produktifitas selama pekerjaan di lapangan </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="cards mb-4">
                            <div class="card-bodys text-center" style="background-color: rgba(255, 255, 224, 0.9); padding: 10px;border-radius: 35px 35px 0 0;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);">
                                <div class="text-center mb-2" style="background-color: antiquewhite; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                    <i class="fas fa-hard-hat"></i>
                                    <h4 class="card-title mb-0">Project Milestone</h4>
                                </div>
                                <div class="table-responsive">
                                    <table id="datatable" class="table nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead style="background-color: antiquewhite">
                                            <tr>
                                                <th style="text-align: left;">Title</th>
                                                <th>BL Date</th>
                                                <th>Actual/Forecast Date</th>
                                                <th>Variance</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td style="text-align: left;">Contract Effective Date</td>
                                                <td nowrap>28 Dec 23</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_add_project_milestone"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">Kick Off Meeting</td>
                                                <td nowrap>18 Jan 24</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_add_project_milestone"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">Mechanical Completion</td>
                                                <td nowrap>9 Jun 25</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_add_project_milestone"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">Commisioning</td>
                                                <td nowrap>27 Jun 25</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_add_project_milestone"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left;">Operation Acceptance</td>
                                                <td nowrap>27 Jun 25</td>
                                                <td></td>
                                                <td></td>
                                                <td>
                                                    <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_add_project_milestone"><i class="fas fa-edit"></i></button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-12">
                            <div class="cards">
                                <div class="card-bodys text-center" style="background-color: rgba(255, 255, 240, 0.9); padding: 10px;border-radius: 35px 35px 0 0;box-shadow: 0px 0px 5px 0px rgba(0, 0, 0, 0.1);">
                                    <div class="text-center mb-2" style="background-color: antiquewhite; display: inline-flex; align-items: center; flex-direction:column; padding: 5px 15px; border-radius: 20px;font-size:4rem">
                                        <i class="fas fa-building"></i>
                                        <h4 class="card-title mb-0">Procurement</h4>
                                    </div>
                                    <div class="table-responsive">
                                        <table id="datatable" class="table nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead style="background-color: antiquewhite">
                                                <tr>
                                                    <th style="text-align: left;">Title</th>
                                                    <th>BL Date</th>
                                                    <th>Actual/Forecast Date</th>
                                                    <th>Variance</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td style="text-align: left;">Ready Mix Material-K430</td>
                                                    <td nowrap>20-04-2024</td>
                                                    <td nowrap>20-04-2024</td>
                                                    <td>Waiting</td>
                                                    <td>
                                                        <button class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#modal_add_project_milestone"><i class="fas fa-edit"></i></button>
                                                    </td>
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
<script src="<?= base_url('assets/libs/select2/js/select2.min.js') ?>"></script>
<script>
    console.log(<?= json_encode(sess('active_user_id')) ?>, 'activeUserId');
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
                hollow: {
                    size: '20%',
                },
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
                    margin: 15,
                }
            }
        },
        series: [<?= number_format(floatval($progressChartDataEngineering['percent_plan'][0]->cum_progress_plan), 2) ?>, <?= number_format(floatval($progressChartDataEngineering['percent_actual'][0]->cum_progress_actual), 2) ?>],
        labels: ['Plan', 'Actual'],
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
                hollow: {
                    size: '20%',
                },
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
        series: [<?= $data_page->chart_pt_procurement_plan ?>, <?= $data_page->chart_pt_procurement_actual ?>],
        labels: ['Plan', 'Actual'],
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

    //  Radial chart 3
    var options_3 = {
        chart: {
            height: 150,
            type: 'radialBar',
            margin: 0
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    size: '20%',
                },
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
        series: [<?= $data_page->chart_pt_procurement_plan ?>, <?= $data_page->chart_pt_procurement_actual ?>],
        labels: ['Plan', 'Actual'],
        colors: ['#5664d2', '#fcb92c'],
        legend: {
            offsetY: 5
        }

    }
    var chart_3 = new ApexCharts(
        document.querySelector("#radial_chart_3"),
        options_3
    );
    chart_3.render();

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
        series: [{
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
        // yaxis: {
        //     title: {
        //         text: 'Points',
        //     },
        // },
        yaxis: [{
                title: {
                    text: "SCurve Prcent"
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
                        return y.toFixed(0) + " points";
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
        series: [{
            name: 'Plan',
            data: [46, 57, 59, 54, 62, 58, 64, 60, 66, 100, 60, 70]
        }, {
            name: 'Actual',
            data: [74, 83, 102, 97, 86, 106, 93, 114, 94, 80, 40, 20]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
        },
        // colors: ['#fcb92c', "#4aa3ff", '#5664d2', '#1cbb8c'],
        colors: ['#FFFF66', '#FFA500'],
        plotOptions: {
            bar: {
                horizontal: false,
                dataLabels: {
                    total: {
                        enabled: true,
                        offsetX: 0,
                        style: {
                            fontSize: '13px',
                            fontWeight: 900,
                        }
                    }
                },
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            labels: {
                formatter: function(val) {
                    return val
                }
            }
        },
        yaxis: {
            title: {
                text: undefined
            },
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + "People"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        },

    }
    var chart_man_hour = new ApexCharts(
        document.querySelector("#chart_man_hour"),
        options_man_power
    );
    chart_man_hour.render();

    var options = {
        series: [{
            name: 'Plan',
            data: [46, 57, 59, 54, 62, 58, 64, 60, 66, 100, 60, 70]
        }, {
            name: 'Actual',
            data: [74, 83, 102, 97, 86, 106, 93, 114, 94, 80, 40, 20]
        }],
        chart: {
            type: 'bar',
            height: 350,
            stacked: true,
        },

        plotOptions: {
            bar: {
                horizontal: false,
                dataLabels: {
                    total: {
                        enabled: true,
                        offsetX: 0,
                        style: {
                            fontSize: '13px',
                            fontWeight: 900,
                        }
                    }
                },
            },
        },
        stroke: {
            width: 1,
            colors: ['#fff']
        },
        xaxis: {
            categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            labels: {
                formatter: function(val) {
                    return val
                }
            }
        },
        yaxis: {
            title: {
                text: undefined
            },
        },
        tooltip: {
            y: {
                formatter: function(val) {
                    return val + "People"
                }
            }
        },
        fill: {
            opacity: 1
        },
        legend: {
            position: 'top',
            horizontalAlign: 'left',
            offsetX: 40
        },

    };

    var chart = new ApexCharts(document.querySelector("#chart_man_power_stacked"), options);
    chart.render();

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: 'Pilih opsi',
            maximumSelectionLength: 2 // contoh konfigurasi tambahan
        });
        $("#Detail-Engineering").click(function() {
            window.location.href = "engineering-dashboard"; // Ganti "halaman_tujuan.html" dengan URL halaman tujuan yang diinginkan
        });
        $("#Detail-Procurement").click(function() {
            window.location.href = "procurement-dashboard"; // Ganti "halaman_tujuan.html" dengan URL halaman tujuan yang diinginkan
        });
        $("#Detail-Construction").click(function() {
            window.location.href = "construction-dashboard"; // Ganti "halaman_tujuan.html" dengan URL halaman tujuan yang diinginkan
        });
    });
</script>