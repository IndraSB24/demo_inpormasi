<?= $this->include('partials/main') ?>

<head>
    <link href="<?= base_url('assets/libs/select2/css/select2.min.css') ?>" rel="stylesheet" type="text/css">

    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <style>
        td:nth-child(2) {
            position: sticky;
            left: 0;
            z-index: 1;
        }

        /* td:nth-child(7) {
            position: sticky;
            left: 13em;
            z-index: 1;
        } */
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
                <div class="row">
                    <div class="col-12 mb-3">
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-add-progress">
                            Add Progress
                        </button>
                        <a href="<?= base_url('construction-dashboard') ?>" class="btn btn-warning waves-effect waves-light">
                            Construction Dashboard
                        </a>
                        <a href="<?= base_url('measurement_basis_list') ?>" class="btn btn-success waves-effect waves-light">
                            Measurement Basis
                        </a>
                    </div>
                </div>
                <div class="row">
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
                                <!-- <div style="overflow-x:auto;"> -->
                                <font size="2">
                                    <table id="scroll-vertical-datatable" class="table table-bordered nowrap">
                                        <thead style="border-top-width: 4px">
                                            <tr>
                                                <th rowspan="3" style="background-color: #b0cbf7;">NO</th>
                                                <!-- <th rowspan="3" style="background-color: #b0cbf7;">DOCUMENT NUMBER</th> -->
                                                <th rowspan="3" style="background-color: #D6CCC2;position: sticky;left: 0;z-index: 1;">DESCRIPTION</th>
                                                <th rowspan="3" style="width: 0px;background-color: #D6CCC2">QUANTITY</th>
                                                <th rowspan="3" style="width: 0px;background-color: #D6CCC2">UNIT</th>
                                                <th rowspan="1" colspan="2" style="width: 0px;background-color:#CF8BA9" class="desc text-center">HARGA SATUAN</th>
                                                <th colspan="2" class="desc text-center" style="background-color:#FF8FAB">TOTAL HARGA</th>
                                                <th rowspan="3" style="background-color: #b0cbf7">TOTAL AMOUNT</th>
                                                <th rowspan="3" style="background-color: #b0cbf7">WF</th>
                                                <th rowspan="1" colspan="10" class="text-center" style="background-color:#9dc9ae">PROGRESS (%)</th>
                                                <th rowspan="2" colspan="3" class="text-center" style="background-color:#EDE580">BASELINE SCHEDULE</th>
                                                <th rowspan="3" class="text-center" style="background-color: #b0cbf7">
                                                    ACTION
                                                </th>
                                            </tr>
                                            <tr>
                                                <th rowspan="2" class="text-center" style="background-color:#DCB6D5">MATERIAL (IDR)</th>
                                                <th rowspan="2" class="text-center" style="background-color:#DCB6D5">JASA (IDR)</th>
                                                <th rowspan="2" class="text-center" style="background-color:#FFC2D1">MATERIAL (IDR)</th>
                                                <th rowspan="2" class="text-center" style="background-color:#FFC2D1">JASA (IDR)</th>
                                                <th colspan="3" class="text-center" style="background-color:#C5EDAC">PLAN</th>
                                                <th colspan="3" class="text-center" style="background-color:#57CC99">ACTUAL</th>
                                                <th colspan="3" class="text-center" style="background-color:#80ED99">VARIANCE</th>
                                                <th rowspan="2" class="text-center" style="background-color:#90BE6D">REMAINING (%)</th>
                                            </tr>
                                            <tr>
                                                <th style="background-color:#C5EDAC">Last Week Cummulative Progress</th>
                                                <th style="background-color:#C5EDAC">This Week</th>
                                                <th style="background-color:#C5EDAC">Cummulative up to This Week</th>
                                                <th style="background-color:#57CC99">Last Week Cummulative Progress</th>
                                                <th style="background-color:#57CC99">This Week</th>
                                                <th style="background-color:#57CC99">Cummulative up to This Week</th>
                                                <th style="background-color:#80ED99">Last Week Cummulative Progress</th>
                                                <th style="background-color:#80ED99">This Week</th>
                                                <th style="background-color:#80ED99">Cummulative up to This Week</th>
                                                <th class="text-center" style="background-color:#EDE580">START</th>
                                                <th class="text-center" style="background-color:#EDE580">FINISH</th>
                                                <th class="text-center" style="background-color:#EDE580">DURATION</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            <?php foreach ($list_doc as $index => $item) :
                                                $update = "
                                                    <a href='#' id='btn-edit-doc' data-detail='" . json_encode($item) . "'>
                                                        <i class='fas fa-bars text-info font-size-20'></i>
                                                    </a>
                                                "

                                            ?>
                                                <tr>
                                                    <td class="text-center" style="background-color:#d2e5f7"> <?= $index + 1 ?> </td>
                                                    <!-- <td class="text-center" style="background-color:#d2e5f7"> <?= $item->document_number ?> </td> -->
                                                    <td style="background-color:#faf1e3; white-space: normal;word-wrap: break-word;max-width: 450px;">
                                                        <?= $item->level_1 ? 'Level 1: ' .  $item->level_1 : '' ?> <br>
                                                        <?= $item->level_2 ? 'Level 2: ' .  $item->level_2 : '' ?> <br>
                                                        <?= $item->level_3 ? 'Level 3: ' .  $item->level_3 : '' ?> <br>
                                                        <?= $item->level_4 ? 'Level 4: ' .  $item->level_4 : '' ?> <br>
                                                        <?= $item->level_5 ? 'Level 5: ' .  $item->level_5 : '' ?>
                                                    </td>
                                                    <td class="text-center" style="background-color:#faf1e3"> <?= $item->quantity ?> </td>
                                                    <td class="text-center" style="background-color:#faf1e3"> <?= $item->unit ?> </td>
                                                    <td class="text-center" style="background-color:#F4CAE0"> <?= $item->harga_satuan_material ?> </td>
                                                    <td class="text-center" style="background-color:#F4CAE0"> <?= $item->harga_satuan_jasa ?> </td>
                                                    <td class="text-center" style="background-color:#FFE5EC"> <?= $item->total_harga_material ?> </td>
                                                    <td class="text-center" style="background-color:#FFE5EC"> <?= $item->total_harga_jasa ?> </td>
                                                    <td class="text-center" style="background-color:#d2e5f7"> <?= $item->total_amount ?> </td>
                                                    <td class="text-center" style="background-color:#d2e5f7"> <?= $item->wf ?> </td>
                                                    <td class="text-center" style="background-color:#DBFEB8"> <?= $item->plan_cum_till_last_week ?>% </td>
                                                    <td class="text-center" style="background-color:#DBFEB8"> <?= $item->plan_current_week ?>% </td>
                                                    <td class="text-center" style="background-color:#DBFEB8"> <?= $item->plan_cum_till_current_week ?>% </td>
                                                    <td class="text-center" style="background-color:#C7F9CC"> <?= angka(2, $item->actual_cum_till_last_week) ?>% </td>
                                                    <td class="text-center" style="background-color:#C7F9CC"> <?= angka(2, ($item->actual_cum_till_current_week - $item->actual_cum_till_last_week)) ?>% </td>
                                                    <td class="text-center" style="background-color:#C7F9CC"> <?= angka(2, $item->actual_cum_till_current_week) ?>% </td>
                                                    <td class="text-center" style="background-color:#D9FFF5"> <?= angka(2, $item->actual_cum_till_last_week - (float)$item->plan_cum_till_last_week) ?>% </td>
                                                    <td class="text-center" style="background-color:#DBFEB8"> <?= angka(2, ($item->actual_cum_till_current_week - $item->actual_cum_till_last_week) - (float)$item->plan_current_week) ?>% </td>
                                                    <td class="text-center" style="background-color:#DBFEB8"> <?= angka(2, $item->actual_cum_till_current_week - (float)$item->plan_cum_till_current_week) ?>% </td>
                                                    <td class="text-center" style="background-color:#A1E5AB"> - </td>
                                                    <td class="text-center" style="background-color:#faf5b6"> <?= $item->baseline_schedule_start ?> </td>
                                                    <td class="text-center" style="background-color:#faf5b6"> <?= $item->baseline_schedule_finish ?> </td>
                                                    <td class="text-center" style="background-color:#faf5b6"> <?= $item->baseline_schedule_duration ?> </td>
                                                    <td class="text-center" nowrap style="background-color: #d2e5f7"><?= $update ?></td>

                                                </tr>
                                            <?php endforeach; ?>
                                        </tbody>
                                    </table>
                                </font>
                                <!-- </div> -->
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

</div>
<!-- END layout-wrapper -->

<!-- Right Sidebar -->
<?= $this->include('partials/right-sidebar') ?>

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>
</body>

<!--Modal Add progress-->
<div class="modal fade" id="modal-add-progress" role="dialog" aria-labelledby="myLargeModalLabel2" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-lg" id="app2">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel2">Add Progress</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>ACTIVITY:</label>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">DISCIPLINE</small>
                                <!-- <input type="text" class="form-control" name="discipline2" id="discipline2" disabled /> -->
                                <select class="form-control select2" name="discipline2" id="discipline2" v-model="discipline2">
                                    <option>-- Pilih Opsi -- </option>
                                    <option v-for="option in listDiscipline2" :value="option">{{ option }}</option>
                                </select>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">SUB-DISCIPLINE</small>
                                <!-- <input type="text" class="form-control" name="subDiscipline2" id="subDiscipline2" disabled /> -->
                                <select class="form-control select2" name="subDiscipline2" id="subDiscipline2">
                                    <option>-- Pilih Opsi -- </option>
                                    <option v-for="option in listSubDiscipline2" :value="JSON.stringify(option)">{{ option.level_2 }}</option>
                                </select>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">ACTIVITY</small>
                                <!-- <input type="text" class="form-control" name="activity2" id="activity2" disabled /> -->
                                <select class="form-control select2" name="activity2" id="activity2">
                                    <option>-- Pilih Opsi -- </option>
                                    <option v-for="option in listActivity2" :value="JSON.stringify(option)">{{ option.level_3 }}</option>
                                </select>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">SUB ACTIVITY</small>
                                <!-- <input type="text" class="form-control" name="subActivity2" id="subActivity2" disabled /> -->
                                <select class="form-control select2" name="subActivity2" id="subActivity2">
                                    <option>-- Pilih Opsi -- </option>
                                    <option v-for="option in listSubActivity2" :value="JSON.stringify(option)">{{ option.level_4 }}</option>
                                </select>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">DETAIL SUB ACTIVITY</small>
                                <!-- <input type="text" class="form-control" name="detailSubActivity2" id="detailSubActivity2" disabled /> -->
                                <select class="form-control select2" name="detailSubActivity2" id="detailSubActivity2">
                                    <option>-- Pilih Opsi -- </option>
                                    <option v-for="option in listDetailSubActivity2" :value="JSON.stringify(option)">{{ option.level_5 }}</option>
                                </select>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">WEIGHT FACTOR</small>
                                <input type="text" class="form-control" name="weightfactor2" id="weightfactor2" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME/UNIT</small>
                                <input type="text" class="form-control" name="volume2" id="volume2" disabled />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>ACTUAL WORK:</label>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 1</small>
                                    <input type="text" class="form-control" name="activityStep1_2" id="activityStep1_2" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep1Wf_2" id="activityStep1Wf_2" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 2</small>
                                    <input type="text" class="form-control" name="activityStep2_2" id="activityStep2_2" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep2Wf_2" id="activityStep2Wf_2" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 3</small>
                                    <input type="text" class="form-control" name="activityStep3_2" id="activityStep3_2" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep3Wf_2" id="activityStep3Wf_2" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 4</small>
                                    <input type="text" class="form-control" name="activityStep4_2" id="activityStep4_2" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep4Wf_2" id="activityStep4Wf_2" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 5</small>
                                    <input type="text" class="form-control" name="activityStep5_2" id="activityStep5_2" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep5Wf_2" id="activityStep5Wf_2" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 6</small>
                                    <input type="text" class="form-control" name="activityStep6_2" id="activityStep6_2" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep6Wf_2" id="activityStep6Wf_2" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>DATA ACTUAL:</label>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 1 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep1_2">-</span></small>
                                <!-- <input type="number" class="form-control" name="volumeStep1_2" id="volumeStep1_2" /> -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep1_2" id="volumeStep1_2" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename1_2">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 2 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep2_2">-</span></small>
                                <!-- <input type="number" class="form-control" name="volumeStep2_2" id="volumeStep2_2" /> -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep2_2" id="volumeStep2_2" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename2_2">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 3 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep3_2">-</span></small>
                                <!-- <input type="number" class="form-control" name="volumeStep3_2" id="volumeStep3_2" /> -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep3_2" id="volumeStep3_2" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename3_2">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 4 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep4_2">-</span></small>
                                <!-- <input type="number" class="form-control" name="volumeStep4_2" id="volumeStep4_2" /> -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep4_2" id="volumeStep4_2" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename4_2">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 5 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep5_2">-</span></small>
                                <!-- <input type="number" class="form-control" name="volumeStep5_2" id="volumeStep5_2" /> -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep5_2" id="volumeStep5_2" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename5_2">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 6 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep6_2">-</span></small>
                                <!-- <input type="number" class="form-control" name="volumeStep6_2" id="volumeStep6_2" /> -->
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep6_2" id="volumeStep6_2" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename6_2">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>PERCENTAGE:</label>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 1</small>
                                <input type="text" class="form-control text-center" name="progressStep1_2" id="progressStep1_2" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 2</small>
                                <input type="text" class="form-control text-center" name="progressStep2_2" id="progressStep2_2" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 3</small>
                                <input type="text" class="form-control text-center" name="progressStep3_2" id="progressStep3_2" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 4</small>
                                <input type="text" class="form-control text-center" name="progressStep4_2" id="progressStep4_2" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 5</small>
                                <input type="text" class="form-control text-center" name="progressStep5_2" id="progressStep5_2" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 6</small>
                                <input type="text" class="form-control text-center" name="progressStep6_2" id="progressStep6_2" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <label>SUMMARY:</label>
                        <div class="col-md-3">
                            <div class="mb-2 col-md-12">
                                <small class="form-label">Progress Individual</small>
                                <input type="text" class="form-control" name="progressIndividual_2" v-model="progressIndividual_2" id="progressIndividual_2" disabled />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2 col-md-12">
                                <small class="form-label">Accumulative Previous</small>
                                <input type="text" class="form-control" name="accumulativePrevious_2" id="accumulativePrevious_2" disabled />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2 col-md-12">
                                <small class="form-label">Accumulative Todate</small>
                                <input type="text" class="form-control" name="accumulativeTodate_2" v-model="accumulativeTodate_2" id="accumulativeTodate_2" disabled />
                            </div>
                        </div>
                        <div class="col-md-3" style="display: none;">
                            <div class="mb-2 col-md-12">
                                <small class="form-label">Incrimental Input</small>
                                <input type="text" class="form-control" name="incrimentalInput_2" v-model="incrimentalInput_2" id="incrimentalInput_2" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footers" style="display: flex;justify-content: center">
                        <input type="hidden" id="id_construction2" />
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="button" style="margin-left: 10px" class="btn btn-success" id="btn-update2" title="Edit Document" data-object="Project_detail_construction/addProgress">Save</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Modal Edit Document-->
<div class="modal fade" id="modal-edit-document" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-fullscreen modal-lg" id="app">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Update Construction</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <label>ACTIVITY:</label>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">DISCIPLINE</small>
                                <input type="text" class="form-control" name="discipline" id="discipline" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">SUB-DISCIPLINE</small>
                                <input type="text" class="form-control" name="subDiscipline" id="subDiscipline" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">ACTIVITY</small>
                                <input type="text" class="form-control" name="activity" id="activity" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">SUB ACTIVITY</small>
                                <input type="text" class="form-control" name="subActivity" id="subActivity" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">DETAIL SUB ACTIVITY</small>
                                <input type="text" class="form-control" name="detailSubActivity" id="detailSubActivity" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">WEIGHT FACTOR</small>
                                <input type="text" class="form-control" name="weightfactor" id="weightfactor" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME/UNIT</small>
                                <input type="text" class="form-control" name="volume" id="volume" disabled />
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>ACTUAL WORK:</label>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 1</small>
                                    <input type="text" class="form-control" name="activityStep1" id="activityStep1" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep1Wf" id="activityStep1Wf" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 2</small>
                                    <input type="text" class="form-control" name="activityStep2" id="activityStep2" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep2Wf" id="activityStep2Wf" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 3</small>
                                    <input type="text" class="form-control" name="activityStep3" id="activityStep3" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep3Wf" id="activityStep3Wf" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 4</small>
                                    <input type="text" class="form-control" name="activityStep4" id="activityStep4" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep4Wf" id="activityStep4Wf" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 5</small>
                                    <input type="text" class="form-control" name="activityStep5" id="activityStep5" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep5Wf" id="activityStep5Wf" disabled />
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-8">
                                    <small class="form-label">ACTIVITY STEP - 6</small>
                                    <input type="text" class="form-control" name="activityStep6" id="activityStep6" disabled />
                                </div>
                                <div class="col-md-4">
                                    <small class="form-label">WF</small>
                                    <input type="text" class="form-control" name="activityStep6Wf" id="activityStep6Wf" disabled />
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label>DATA ACTUAL:</label>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 1 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep1">-</span></small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep1" id="volumeStep1" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename1">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 2 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep2">-</span></small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep2" id="volumeStep2" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename2">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 3 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep3">-</span></small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep3" id="volumeStep3" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename3">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 4 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep4">-</span></small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep4" id="volumeStep4" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename4">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 5 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep5">-</span></small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep5" id="volumeStep5" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename5">
                                    </div>
                                </div>
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">VOLUME STEP - 6 &nbsp; <span class="text-warning">Progressed: </span><span class="text-warning progressVolumeStep6">-</span></small>
                                <div class="row">
                                    <div class="col-md-4">
                                        <input type="number" class="form-control" name="volumeStep6" id="volumeStep6" />
                                    </div>
                                    <div class="col-md-8">
                                        <input type="file" class="form-control" id="evidence_filename6">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2">
                            <label>PERCENTAGE:</label>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 1</small>
                                <input type="text" class="form-control text-center" name="progressStep1" id="progressStep1" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 2</small>
                                <input type="text" class="form-control text-center" name="progressStep2" id="progressStep2" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 3</small>
                                <input type="text" class="form-control text-center" name="progressStep3" id="progressStep3" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 4</small>
                                <input type="text" class="form-control text-center" name="progressStep4" id="progressStep4" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 5</small>
                                <input type="text" class="form-control text-center" name="progressStep5" id="progressStep5" disabled />
                            </div>
                            <div class="mb-2 col-md-12">
                                <small class="form-label">PROGRESS STEP - 6</small>
                                <input type="text" class="form-control text-center" name="progressStep6" id="progressStep6" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="row mt-3 mb-3">
                        <label>SUMMARY:</label>
                        <div class="col-md-3">
                            <div class="mb-2 col-md-12">
                                <small class="form-label">Progress Individual</small>
                                <input type="text" class="form-control" name="progressIndividual" v-model="progressIndividual" id="progressIndividual" disabled />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2 col-md-12">
                                <small class="form-label">Accumulative Previous</small>
                                <input type="text" class="form-control" name="accumulativePrevious" id="accumulativePrevious" disabled />
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-2 col-md-12">
                                <small class="form-label">Accumulative Todate</small>
                                <input type="text" class="form-control" name="accumulativeTodate" v-model="accumulativeTodate" id="accumulativeTodate" disabled />
                            </div>
                        </div>
                        <div class="col-md-3" style="display: none;">
                            <div class="mb-2 col-md-12">
                                <small class="form-label">Incrimental Input</small>
                                <input type="text" class="form-control" name="incrimentalInput" v-model="incrimentalInput" id="incrimentalInput" disabled />
                            </div>
                        </div>
                    </div>
                    <div class="modal-footers" style="display: flex;justify-content: center">
                        <input type="hidden" id="id_construction" />
                        <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                        <button type="button" style="margin-left: 10px" class="btn btn-success" id="btn-update" title="Edit Document" data-object="Project_detail_construction/addProgress">Save</button>
                    </div>
                </div>
        </form>
    </div>
</div>

<!--Modal Add IFR Document-->
<div class="modal fade" id="modal-up-ifr" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST" id="form-modal-up-ifr">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Upload RFQ Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Document Description</label>
                            <input type="text" class="form-control" name="doc_desc_ifr" id="doc_desc_ifr" readonly />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">RFQ File</label>
                            <input type="text" class="form-control" name="file_ifr" id="file_ifr" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_doc_ifr" />
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-file" title="ifr" data-object="Project_detail_procurement/update/actual_ifr_file" data-file_desc="ifr">
                        Upload
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Modal Add IFA Document-->
<div class="modal fade" id="modal-up-ifa" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST" id="form-modal-up-ifa">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Upload TBE Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Document Description</label>
                            <input type="text" class="form-control" name="doc_desc_ifa" id="doc_desc_ifa" readonly />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">TBE File</label>
                            <input type="text" class="form-control" name="file_ifa" id="file_ifa" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_doc_ifa" />
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-file" title="ifa" data-object="Project_detail_procurement/update/actual_ifa_file" data-file_desc="ifa">
                        Upload
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Modal Add IFC Document-->
<div class="modal fade" id="modal-up-ifc" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST" id="form-modal-up-ifc">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Upload PO Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Document Description</label>
                            <input type="text" class="form-control" name="doc_desc_ifc" id="doc_desc_ifc" readonly />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">PO File</label>
                            <input type="text" class="form-control" name="file_ifc" id="file_ifc" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_doc_ifc" />
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-file" title="ifc" data-object="Project_detail_procurement/update/actual_ifc_file" data-file_desc="ifc">
                        Upload
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Modal Upload All File-->
<div id="modal-upload-file" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST" id="form-modal-upload-file" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Upload <span class="upload_step"></span> File</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Document Description</label>
                            <input type="text" class="form-control" name="upload_doc_desc" id="upload_doc_desc" readonly />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <!-- <div class="row mb-4">
                            <div class="col-md-12">
                                <label for="actual_man_hour" class="form-label">Actual Man Hour</label>
                                <input type="number" class="form-control" name="actual_man_hour" id="actual_man_hour" />
                            </div>
                        </div> -->
                        <div>
                            <label for="upload_uploaded_file" id="upload_btn_choose_file" class="btn btn-info">Choose File</label>
                            <input name="upload_uploaded_file" id="upload_uploaded_file" type="file" multiple="multiple" style="display: none;" />
                            &nbsp;<span id="upload_file_name">No File Choosen</span>
                        </div>
                        <!-- <div class="col-md-4 mt-4">
                            <label class="form-label">Backdate</label>
                            <div class="input-group" id="backdate1">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#backdate1" data-provide="datepicker" name="backdate" id="backdate" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div> -->
                        <!-- <div class="row mb-4">
                            <div class="col-md-12">
                                <label class="form-label">Please input your Man-Hour</label></label>
                                <input type="number" class="form-control" name="upload_man_hour" id="upload_man_hour"/>
                            </div>
                        </div> -->
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="upload_id_doc" />
                        <button type="button" class="btn btn-success" id="upload_btn_up" data-path="#" data-step="#" data-version="#" data-doc_name="#" data-doc_code="#">
                            Upload
                        </button>
                    </div>
                </div>
        </form>
    </div>
</div>

</html>
<script src="<?= base_url('assets/libs/select2/js/select2.min.js') ?>"></script>

<script>
    console.log(<?= json_encode($list_doc) ?>, 'LIST DOC');

    $(document).ready(function() {
        $('#update_btn_choose_file').click(function(e) {
            e.preventDefault(); // Prevent default behavior
            $('#upload_uploaded_file').trigger('click');
        });

        $('#upload_uploaded_file').change(function() {
            var fileInput = $(this);
            var fileName = fileInput.val().split('\\').pop();
            $('#upload_file_name').text("File Choosen: " + fileName);
        });
    });

    // upload file
    $(document).on('click', '#btn-upload-file', function() {
        // Set data from button to Form Approval
        $('.upload_step').text($(this).data('step'));
        $('#upload_doc_desc').val($(this).data('doc_desc'));
        $('#upload_id_doc').val($(this).data('id'));
        $("#upload_btn_up").data("path", $(this).data('path'));
        $("#upload_btn_up").data("step", $(this).data('step'));
        $("#upload_btn_up").data("actual_man_hour", $(this).data('actual_man_hour'));
        $("#upload_btn_up").data("version", $(this).data('version'));
        $("#upload_btn_up").data("doc_name", $(this).data('doc_name'));
        $("#upload_btn_up").data("doc_code", $(this).data('doc_code'));
        $('#upload_file_name').text("No File Choosen");

        // Call Modal Approval
        $('#modal-upload-file').modal('show');
    })

    $(document).on('click', '#upload_btn_up', function() {
        const path = $(this).data('path');
        const fileDesc = $(this).data('step');
        const version = $(this).data('version');
        let id_doc, swalTitle;
        var timerInterval, i, file;
        var formData = new FormData();

        id_doc = document.getElementById("upload_id_doc").value;
        i = $('#upload_uploaded_file'),
            file = i[0].files[0];
        formData.append('file', file);
        formData.append('id_doc', id_doc);
        formData.append('doc_name', $(this).data('doc_name'));
        formData.append('doc_step', fileDesc);
        // formData.append('version', version);
        // formData.append('backdate', $('#backdate').val());
        // formData.append('doc_code', $(this).data('doc_code'));
        // formData.append('man_hour_actual', $('#actual_man_hour').val());

        swalTitle = 'Upload File ' + fileDesc;
        console.log(file);

        Swal.fire({
            title: swalTitle,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('Project_detail_procurement/up_file') ?>",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    beforeSend: () => {
                        Swal.fire({
                            title: "Loading",
                            text: "Please wait...",
                            icon: "info",
                            buttons: false,
                            closeOnClickOutside: false,
                            closeOnEsc: false,
                            showConfirmButton: false
                        });
                    },
                    success: () => {
                        Swal.fire({
                            title: 'Diupload!',
                            icon: 'success',
                            text: 'File Berhasil Diupload.',
                            buttons: false,
                            timer: 1000,
                            confirmButtonColor: "#5664d2",
                            onBeforeOpen: function() {
                                //Swal.showLoading()
                                timerInterval = setInterval(function() {
                                    Swal.getContent().querySelector('strong')
                                        .textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            onClose: function() {
                                location.reload()
                            }
                        })
                    },
                    error: err => console.log(err),
                });
            }
        })
    })

    // btn simpan document
    // ==========================================================================================================================================================================
    $(document).on('click', '#btn-simpan-doc', function() {
        const objek = $(this).data('object')
        const level_code = document.getElementById("level_code").value;
        const level_code_2 = document.getElementById("level_code_2").value;
        const level_code_3 = document.getElementById("level_code_3").value;
        const level_code_4 = document.getElementById("level_code_4").value;
        const level_code_5 = document.getElementById("level_code_5").value;
        const group = document.getElementById("group").value;
        const quantity = document.getElementById("quantity").value;
        const unit = document.getElementById("unit").value;
        // const description = document.getElementById("description").value;
        const weight_factor = document.getElementById("weight_factor").value;
        // const plan_ifr = document.getElementById("plan_ifr").value;
        // const plan_ifa = document.getElementById("plan_ifa").value;
        // const plan_ifc = document.getElementById("plan_ifc").value;
        const plan_po = document.getElementById("plan_po").value;
        const plan_fat = document.getElementById("plan_fat").value;
        const plan_rfs = document.getElementById("plan_rfs").value;
        const plan_onsite = document.getElementById("plan_onsite").value;
        const plan_install = document.getElementById("plan_install").value;
        const plan_comm = document.getElementById("plan_comm").value;
        var timerInterval;
        Swal.fire({
            title: 'Tambah Dokumen?',
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: objek,
                    method: 'POST',
                    dataType: "JSON",
                    data: {
                        level_code: level_code,
                        // description: description,
                        weight_factor: weight_factor,
                        // plan_ifr: plan_ifr,
                        // plan_ifa: plan_ifa,
                        // plan_ifc: plan_ifc
                        level_code_2: level_code_2,
                        level_code_3: level_code_3,
                        level_code_4: level_code_4,
                        level_code_5: level_code_5,
                        group: group,
                        quantity: quantity,
                        unit: unit,
                        plan_po: plan_po,
                        plan_fat: plan_fat,
                        plan_rfs: plan_rfs,
                        plan_onsite: plan_onsite,
                        plan_install: plan_install,
                        plan_comm: plan_com,
                    }
                });
                Swal.fire({
                    title: 'Disimpan!',
                    icon: 'success',
                    text: 'Data berhasil disimpan.',
                    timer: 1000,
                    confirmButtonColor: "#5664d2",
                    onBeforeOpen: function() {
                        //Swal.showLoading()
                        timerInterval = setInterval(function() {
                            Swal.getContent().querySelector('strong')
                                .textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: function() {
                        location.reload()
                    }
                })
            }
        })
    })

    // btn delete document
    // ==========================================================================================================================================================================
    $(document).on('click', '#btn-hapus-doc', function() {
        const id = $(this).data('id')
        const objek = $(this).data('object')
        var timerInterval;
        Swal.fire({
            title: 'Hapus Document?',
            icon: 'error',
            text: 'Document yang sudah dihapus tidak dapat dikembalikan lagi!',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: objek + '/' + id,
                    method: 'POST',
                    dataType: "JSON",
                    data: {
                        id_project: id
                    },
                    success: () => {
                        Swal.fire({
                            title: 'Dihapus!',
                            icon: 'success',
                            text: 'Document berhasil dihapus.',
                            timer: 1000,
                            confirmButtonColor: "#5664d2",
                            onBeforeOpen: function() {
                                //Swal.showLoading()
                                timerInterval = setInterval(function() {
                                    Swal.getContent().querySelector('strong')
                                        .textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            onClose: function() {
                                location.reload()
                            }
                        })
                    }
                });
            }
        })
    })

    // $(document).on('input', '#volumeStep1', () => {
    //     let val = $('#volumeStep1').val()
    //     const progress = $('.progressVolumeStep1').text()
    //     const qty = $('#volume').val()
    //     const total = qty ? qty.split(' ')[0].trim() : 0
    //     const wf = $('#activityStep1Wf').val()

    //     if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //         $('#volumeStep1').val(parseFloat(total) - parseFloat(progress))
    //     }

    //     if (parseFloat(val) > 0) {
    //         if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //             val = parseFloat(total) - parseFloat(progress)
    //         }
    //         const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
    //         $('#progressStep1').val(livePercent.toFixed(2) + '%')
    //     } else {
    //         $('#progressStep1').val('')
    //     }
    // })
    // $(document).on('input', '#volumeStep2', () => {
    //     let val = $('#volumeStep2').val()
    //     const progress = $('.progressVolumeStep2').text()
    //     const qty = $('#volume').val();
    //     const total = qty ? qty.split(' ')[0].trim() : 0
    //     const wf = $('#activityStep2Wf').val()
    //     if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //         $('#volumeStep2').val(parseFloat(total) - parseFloat(progress))
    //     }
    //     console.log(val)
    //     if (parseFloat(val) > 0) {
    //         if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //             val = parseFloat(total) - parseFloat(progress)
    //         }
    //         const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
    //         $('#progressStep2').val(livePercent.toFixed(2) + '%')
    //     } else {
    //         $('#progressStep2').val('')
    //     }
    // })
    // $(document).on('input', '#volumeStep3', () => {
    //     let val = $('#volumeStep3').val()
    //     const progress = $('.progressVolumeStep3').text()
    //     const qty = $('#volume').val();
    //     const total = qty ? qty.split(' ')[0].trim() : 0
    //     const wf = $('#activityStep3Wf').val()
    //     if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //         $('#volumeStep3').val(parseFloat(total) - parseFloat(progress))
    //     }

    //     if (parseFloat(val) > 0) {
    //         if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //             val = parseFloat(total) - parseFloat(progress)
    //         }
    //         const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
    //         $('#progressStep3').val(livePercent.toFixed(2) + '%')
    //     } else {
    //         $('#progressStep3').val('')
    //     }
    // })
    // $(document).on('input', '#volumeStep4', () => {
    //     let val = $('#volumeStep4').val()
    //     const progress = $('.progressVolumeStep4').val()
    //     const qty = $('#volume').val();
    //     const wf = $('#activityStep4Wf').val()
    //     const total = qty ? qty.split(' ')[0].trim() : 0
    //     if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //         $('#volumeStep4').val(parseFloat(total) - parseFloat(progress))
    //     }

    //     if (parseFloat(val) > 0) {
    //         if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //             val = parseFloat(total) - parseFloat(progress)
    //         }
    //         const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
    //         $('#progressStep4').val(livePercent.toFixed(2) + '%')
    //     } else {
    //         $('#progressStep4').val('')
    //     }
    // })
    // $(document).on('input', '#volumeStep5', () => {
    //     let val = $('#volumeStep5').val()
    //     const progress = $('.progressVolumeStep5').text()
    //     const qty = $('#volume').val();
    //     const total = qty ? qty.split(' ')[0].trim() : 0
    //     const wf = $('#activityStep5Wf').val()

    //     if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //         $('#volumeStep5').val(parseFloat(total) - parseFloat(progress))
    //     }

    //     if (parseFloat(val) > 0) {
    //         if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //             val = parseFloat(total) - parseFloat(progress)
    //         }
    //         const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
    //         $('#progressStep5').val(livePercent.toFixed(2) + '%')
    //     } else {
    //         $('#progressStep5').val('')
    //     }
    // })
    // $(document).on('input', '#volumeStep6', () => {
    //     let val = $('#volumeStep6').val()
    //     const progress = $('.progressVolumeStep6').text()
    //     const qty = $('#volume').val();
    //     const total = qty ? qty.split(' ')[0].trim() : 0
    //     const wf = $('#activityStep6Wf').val()

    //     if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //         $('#volumeStep6').val(parseFloat(total) - parseFloat(progress))
    //     }

    //     if (parseFloat(val) > 0) {
    //         if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
    //             val = parseFloat(total) - parseFloat(progress)
    //         }
    //         const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
    //         $('#progressStep6').val(livePercent.toFixed(2) + '%')
    //     } else {
    //         $('#progressStep6').val('')
    //     }
    // })

    // update document detail
    // ==========================================================================================================================================================================    
    // get Edit document
    $(document).on('click', '#btn-edit-doc', function() {
        console.log('fuadi');
        const data = $(this).data('detail')
        console.log(data);
        $('#id_construction').val(data.id);
        $('#discipline').val(data.level_1);
        $('#subDiscipline').val(data.level_2);
        $('#activity').val(data.level_3);
        $('#subActivity').val(data.level_4);
        $('#detailSubActivity').val(data.level_5);
        $('#weightfactor').val(`${data.wf}%`);
        $('#volume').val(`${data.quantity} ${data.unit}`);

        $('#volumeStep1').val(null);
        $('#volumeStep2').val(null);
        $('#volumeStep3').val(null);
        $('#volumeStep4').val(null);
        $('#volumeStep5').val(null);
        $('#volumeStep6').val(null);

        $('.progressVolumeStep1').html(data.step_1_actual_volume ? parseFloat(data.step_1_actual_volume).toFixed(2) : '');
        $('.progressVolumeStep2').html(data.step_2_actual_volume ? parseFloat(data.step_2_actual_volume).toFixed(2) : '');
        $('.progressVolumeStep3').html(data.step_3_actual_volume ? parseFloat(data.step_3_actual_volume).toFixed(2) : '');
        $('.progressVolumeStep4').html(data.step_4_actual_volume ? parseFloat(data.step_4_actual_volume).toFixed(2) : '');
        $('.progressVolumeStep5').html(data.step_5_actual_volume ? parseFloat(data.step_5_actual_volume).toFixed(2) : '');
        $('.progressVolumeStep6').html(data.step_6_actual_volume ? parseFloat(data.step_6_actual_volume).toFixed(2) : '');

        $('#volumeStep1').prop('disabled', !data.step_1_name || data.quantity === data.step_1_actual_volume);
        $('#volumeStep2').prop('disabled', !data.step_2_name || data.quantity === data.step_2_actual_volume);
        $('#volumeStep3').prop('disabled', !data.step_3_name || data.quantity === data.step_3_actual_volume);
        $('#volumeStep4').prop('disabled', !data.step_4_name || data.quantity === data.step_4_actual_volume);
        $('#volumeStep5').prop('disabled', !data.step_5_name || data.quantity === data.step_5_actual_volume);
        $('#volumeStep6').prop('disabled', !data.step_6_name || data.quantity === data.step_6_actual_volume);

        $('#evidence_filename1').prop('disabled', !data.step_1_name || data.quantity === data.step_1_actual_volume);
        $('#evidence_filename2').prop('disabled', !data.step_2_name || data.quantity === data.step_2_actual_volume);
        $('#evidence_filename3').prop('disabled', !data.step_3_name || data.quantity === data.step_3_actual_volume);
        $('#evidence_filename4').prop('disabled', !data.step_4_name || data.quantity === data.step_4_actual_volume);
        $('#evidence_filename5').prop('disabled', !data.step_5_name || data.quantity === data.step_5_actual_volume);
        $('#evidence_filename6').prop('disabled', !data.step_6_name || data.quantity === data.step_6_actual_volume);

        $('#activityStep1').val(data.step_1_name);
        $('#activityStep2').val(data.step_2_name);
        $('#activityStep3').val(data.step_3_name);
        $('#activityStep4').val(data.step_4_name);
        $('#activityStep5').val(data.step_5_name);
        $('#activityStep6').val(data.step_6_name);

        $('#activityStep1Wf').val(data.step_1_wf ? `${data.step_1_wf}%` : '');
        $('#activityStep2Wf').val(data.step_2_wf ? `${data.step_2_wf}%` : '');
        $('#activityStep3Wf').val(data.step_3_wf ? `${data.step_3_wf}%` : '');
        $('#activityStep4Wf').val(data.step_4_wf ? `${data.step_4_wf}%` : '');
        $('#activityStep5Wf').val(data.step_5_wf ? `${data.step_5_wf}%` : '');
        $('#activityStep6Wf').val(data.step_6_wf ? `${data.step_6_wf}%` : '');

        // $('#progressStep1').val(data);
        // $('#progressStep2').val(data);
        // $('#progressStep3').val(data);
        // $('#progressStep4').val(data);
        // $('#progressStep5').val(data);
        // $('#progressStep6').val(data);

        // $('#progressIndividual').val(data);
        // $('#accumulativePrevious').val(data);
        // $('#accumulativeTodate').val(data);
        // $('#incrimentalInput').val(data);

        const accumulativePrevious = ((parseFloat(data.step_1_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_1_wf || 0)) +
            ((parseFloat(data.step_2_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_2_wf || 0)) +
            ((parseFloat(data.step_3_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_3_wf || 0)) +
            ((parseFloat(data.step_4_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_4_wf || 0)) +
            ((parseFloat(data.step_5_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_5_wf || 0)) +
            ((parseFloat(data.step_6_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_6_wf || 0));
        $('#accumulativePrevious').val(`${accumulativePrevious}%`);
        $('#modal-edit-document').modal('show');
    })

    $(document).on('click', '#btn-update', function() {
        const volume = parseFloat($('#volume').val());

        const base = '<?= base_url() ?>'
        const link = `${base}/${$(this).data('object')}`

        const id_construction = document.getElementById("id_construction").value;
        const volumeStep1 = $('#volumeStep1').val();
        const volumeStep2 = $('#volumeStep2').val();
        const volumeStep3 = $('#volumeStep3').val();
        const volumeStep4 = $('#volumeStep4').val();
        const volumeStep5 = $('#volumeStep5').val();
        const volumeStep6 = $('#volumeStep6').val();

        const progressData = [];
        var formData = new FormData();
        formData.append('id_construction', id_construction);
        if (volumeStep1) {
            formData.append('step[]', '1');
            formData.append('actual_volume[]', volumeStep1);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep1) / volume) * parseFloat($('#activityStep1Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename1')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep2) {
            formData.append('step[]', '2');
            formData.append('actual_volume[]', volumeStep2);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep2) / volume) * parseFloat($('#activityStep2Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename2')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep3) {
            formData.append('step[]', '3');
            formData.append('actual_volume[]', volumeStep3);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep3) / volume) * parseFloat($('#activityStep3Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename3')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep4) {
            formData.append('step[]', '4');
            formData.append('actual_volume[]', volumeStep4);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep4) / volume) * parseFloat($('#activityStep4Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename4')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep5) {
            formData.append('step[]', '5');
            formData.append('actual_volume[]', volumeStep5);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep5) / volume) * parseFloat($('#activityStep5Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename5')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep6) {
            formData.append('step[]', '6');
            formData.append('actual_volume[]', volumeStep6);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep6) / volume) * parseFloat($('#activityStep6Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename6')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        var timerInterval;
        Swal.fire({
            title: 'Update Progress?',
            icon: 'info',
            text: 'Patikan Data yang Diketik Sudah Sesuai!',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: link,
                    method: 'POST',
                    // dataType: "JSON",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: () => {
                        Swal.fire({
                            title: 'Diupdate!',
                            icon: 'success',
                            text: 'Document Berhasil Diupdate.',
                            timer: 1000,
                            confirmButtonColor: "#5664d2",
                            onBeforeOpen: function() {
                                //Swal.showLoading()
                                timerInterval = setInterval(function() {
                                    Swal.getContent().querySelector('strong')
                                        .textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            onClose: function() {
                                location.reload()
                            }
                        })
                    }
                });
            }
        })
    })
    $(document).on('click', '#btn-update2', function() {
        const volume = parseFloat($('#volume2').val());

        const base = '<?= base_url() ?>'
        const link = `${base}/${$(this).data('object')}`

        const id_construction = document.getElementById("id_construction2").value;
        const volumeStep1 = $('#volumeStep1_2').val();
        const volumeStep2 = $('#volumeStep2_2').val();
        const volumeStep3 = $('#volumeStep3_2').val();
        const volumeStep4 = $('#volumeStep4_2').val();
        const volumeStep5 = $('#volumeStep5_2').val();
        const volumeStep6 = $('#volumeStep6_2').val();

        const progressData = [];
        var formData = new FormData();
        formData.append('id_construction', id_construction);
        if (volumeStep1) {
            formData.append('step[]', '1');
            formData.append('actual_volume[]', volumeStep1);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep1) / volume) * parseFloat($('#activityStep1Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename1')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep2) {
            formData.append('step[]', '2');
            formData.append('actual_volume[]', volumeStep2);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep2) / volume) * parseFloat($('#activityStep2Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename2')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep3) {
            formData.append('step[]', '3');
            formData.append('actual_volume[]', volumeStep3);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep3) / volume) * parseFloat($('#activityStep3Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename3')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep4) {
            formData.append('step[]', '4');
            formData.append('actual_volume[]', volumeStep4);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep4) / volume) * parseFloat($('#activityStep4Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename4')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep5) {
            formData.append('step[]', '5');
            formData.append('actual_volume[]', volumeStep5);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep5) / volume) * parseFloat($('#activityStep5Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename5')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }
        if (volumeStep6) {
            formData.append('step[]', '6');
            formData.append('actual_volume[]', volumeStep6);
            formData.append('actual_percent_per_construction[]', (parseFloat(volumeStep6) / volume) * parseFloat($('#activityStep6Wf').val()));
            formData.append('evidence_filename[]', $('#evidence_filename6')[0].files[0] || new Blob([], {
                type: 'text/plain'
            }));
        }

        var timerInterval;
        Swal.fire({
            title: 'Update Progress?',
            icon: 'info',
            text: 'Patikan Data yang Diketik Sudah Sesuai!',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: link,
                    method: 'POST',
                    // dataType: "JSON",
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: () => {
                        Swal.fire({
                            title: 'Diupdate!',
                            icon: 'success',
                            text: 'Document Berhasil Diupdate.',
                            timer: 1000,
                            confirmButtonColor: "#5664d2",
                            onBeforeOpen: function() {
                                //Swal.showLoading()
                                timerInterval = setInterval(function() {
                                    Swal.getContent().querySelector('strong')
                                        .textContent = Swal.getTimerLeft()
                                }, 100)
                            },
                            onClose: function() {
                                location.reload()
                            }
                        })
                    }
                });
            }
        })
    })

    // upload file
    // ==========================================================================================================================================================================    
    // get Edit IFR
    $(document).on('click', '#btn-up-ifr-file', function() {
        // get data from button edit
        const id = $(this).data('id');
        const description = $(this).data('doc_desc');

        // Set data to Form Edit
        $('#doc_desc_ifr').val(description);
        $('#id_doc_ifr').val(id);

        // Call Modal Edit
        $('#modal-up-ifr').modal('show');
    })

    // get Edit IFA
    $(document).on('click', '#btn-up-ifa-file', function() {
        // get data from button edit
        const id = $(this).data('id');
        const description = $(this).data('doc_desc');

        // Set data to Form Edit
        $('#doc_desc_ifa').val(description);
        $('#id_doc_ifa').val(id);

        // Call Modal Edit
        $('#modal-up-ifa').modal('show');
    })

    // get Edit IFC
    $(document).on('click', '#btn-up-ifc-file', function() {
        // get data from button edit
        const id = $(this).data('id');
        const description = $(this).data('doc_desc');

        // Set data to Form Edit
        $('#doc_desc_ifc').val(description);
        $('#id_doc_ifc').val(id);

        // Call Modal Edit
        $('#modal-up-ifc').modal('show');
    })

    // save file
    $(document).on('click', '#btn-simpan-file', function() {
        const objek = $(this).data('object')
        const fileDesc = $(this).data('file_desc');
        let id_doc, file, swalTitle;
        var timerInterval;

        switch (fileDesc) {
            case 'ifr':
                swalTitle = 'Upload File RFQ';
                id_doc = document.getElementById("id_doc_ifr").value
                file = document.getElementById("file_ifr").value;
                break;
            case 'ifa':
                swalTitle = 'Upload File TBE';
                id_doc = document.getElementById("id_doc_ifa").value
                file = document.getElementById("file_ifa").value;
                break;
            case 'ifc':
                swalTitle = 'Upload File PO';
                id_doc = document.getElementById("id_doc_ifc").value
                file = document.getElementById("file_ifc").value;
                break;
        }

        Swal.fire({
            title: swalTitle,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: objek + '/' + id_doc,
                    method: 'POST',
                    dataType: "JSON",
                    data: {
                        file: file
                    }
                });
                Swal.fire({
                    title: 'Diupload!',
                    icon: 'success',
                    text: 'File Berhasil Diupload.',
                    timer: 1000,
                    confirmButtonColor: "#5664d2",
                    onBeforeOpen: function() {
                        //Swal.showLoading()
                        timerInterval = setInterval(function() {
                            Swal.getContent().querySelector('strong')
                                .textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: function() {
                        location.reload()
                    }
                })
            }
        })
    })

    function waitingSwal() {
        Swal.fire({
            title: 'Nothing You Can Do Here!',
            icon: 'warning',
            text: 'The progress is not here yet',
            timer: 5000,
            confirmButtonColor: "#5664d2",
        })
    }

    var app = new Vue({
        el: '#app',
        data: {
            accumulativeTodate: '',
            progressIndividual: '',
            incrimentalInput: '',
        },
        methods: {
            convertPercentageStringToFloat(percentageString) {
                let numericString = percentageString.replace('%', '');
                let numericFloat = parseFloat(numericString);
                return numericFloat;
            },
            updateAccumulativeTodate: function() {
                const qty = $('#volume').val();
                const volume = qty ? qty.split(' ')[0].trim() : 0
                const value = ((parseFloat($('#volumeStep1').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep1Wf').val() || '0%')) +
                    ((parseFloat($('#volumeStep2').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep2Wf').val() || '0%')) +
                    ((parseFloat($('#volumeStep3').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep3Wf').val() || '0%')) +
                    ((parseFloat($('#volumeStep4').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep4Wf').val() || '0%')) +
                    ((parseFloat($('#volumeStep5').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep5Wf').val() || '0%')) +
                    ((parseFloat($('#volumeStep6').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep6Wf').val() || '0%'));
                this.accumulativeTodate = `${value.toFixed(2)}%`;
                this.progressIndividual = `${(this.convertPercentageStringToFloat($('#accumulativePrevious').val() || '0%') + value).toFixed(2)}%`;
                this.incrimentalInput = `${value.toFixed(2) - this.convertPercentageStringToFloat($('#accumulativePrevious').val() || '0%')}`;
            },
        },
        mounted: function() {
            console.log('Vue instance has been mounted!');
            $('#modal-edit-document').on('hidden.bs.modal', (e) => {
                this.accumulativeTodate = '';
                this.progressIndividual = '';
                this.incrimentalInput = '';
                $('#accumulativeTodate').val('')
                $('#progressIndividual').val('')
                $('#incrimentalInput').val('')
                $('#accumulativePrevious').val('')

                $('#id_construction').val('');
                $('#weightfactor').val('');
                $('#volume').val('');

                $('#volumeStep1').val(null);
                $('#volumeStep2').val(null);
                $('#volumeStep3').val(null);
                $('#volumeStep4').val(null);
                $('#volumeStep5').val(null);
                $('#volumeStep6').val(null);

                $('.progressVolumeStep1').html('');
                $('.progressVolumeStep2').html('');
                $('.progressVolumeStep3').html('');
                $('.progressVolumeStep4').html('');
                $('.progressVolumeStep5').html('');
                $('.progressVolumeStep6').html('');

                $('#volumeStep1').prop('disabled', false);
                $('#volumeStep2').prop('disabled', false);
                $('#volumeStep3').prop('disabled', false);
                $('#volumeStep4').prop('disabled', false);
                $('#volumeStep5').prop('disabled', false);
                $('#volumeStep6').prop('disabled', false);

                $('#evidence_filename1').prop('disabled', false);
                $('#evidence_filename2').prop('disabled', false);
                $('#evidence_filename3').prop('disabled', false);
                $('#evidence_filename4').prop('disabled', false);
                $('#evidence_filename5').prop('disabled', false);
                $('#evidence_filename6').prop('disabled', false);

                $('#activityStep1').val('');
                $('#activityStep2').val('');
                $('#activityStep3').val('');
                $('#activityStep4').val('');
                $('#activityStep5').val('');
                $('#activityStep6').val('');

                $('#activityStep1Wf').val('');
                $('#activityStep2Wf').val('');
                $('#activityStep3Wf').val('');
                $('#activityStep4Wf').val('');
                $('#activityStep5Wf').val('');
                $('#activityStep6Wf').val('');

                $('#accumulativePrevious').val('');
            });
            $(document).on('input', '#volumeStep1', () => {
                let val = $('#volumeStep1').val()
                const progress = $('.progressVolumeStep1').text()
                const qty = $('#volume').val()
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep1Wf').val()

                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep1').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep1').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep1').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep2', () => {
                let val = $('#volumeStep2').val()
                const progress = $('.progressVolumeStep2').text()
                const qty = $('#volume').val();
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep2Wf').val()
                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep2').val(parseFloat(total) - parseFloat(progress))
                }
                console.log(val)
                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep2').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep2').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep3', () => {
                let val = $('#volumeStep3').val()
                const progress = $('.progressVolumeStep3').text()
                const qty = $('#volume').val();
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep3Wf').val()
                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep3').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep3').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep3').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep4', () => {
                let val = $('#volumeStep4').val()
                const progress = $('.progressVolumeStep4').val()
                const qty = $('#volume').val();
                const wf = $('#activityStep4Wf').val()
                const total = qty ? qty.split(' ')[0].trim() : 0
                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep4').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep4').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep4').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep5', () => {
                let val = $('#volumeStep5').val()
                const progress = $('.progressVolumeStep5').text()
                const qty = $('#volume').val();
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep5Wf').val()

                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep5').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep5').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep5').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep6', () => {
                let val = $('#volumeStep6').val()
                const progress = $('.progressVolumeStep6').text()
                const qty = $('#volume').val();
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep6Wf').val()

                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep6').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep6').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep6').val('')
                }
                this.updateAccumulativeTodate()
            })
        }
    });
    var app = new Vue({
        el: '#app2',
        data: {
            accumulativeTodate_2: '',
            progressIndividual_2: '',
            incrimentalInput_2: '',
            discipline2: '',
            subDiscipline2: '',
            activity2: '',
            subActivity2: '',
            detailSubActivity2: '',
            listDiscipline2: [],
            listSubDiscipline2: [],
            listActivity2: [],
            listSubActivity2: [],
            listDetailSubActivity2: [],
            listWeightfactor2: [],
            listVolume2: [],
        },
        methods: {
            convertPercentageStringToFloat(percentageString) {
                let numericString = percentageString.replace('%', '');
                let numericFloat = parseFloat(numericString);
                return numericFloat;
            },
            handleChangeDiscipline: function() {
                console.log('fuadi');
            },
            updateAccumulativeTodate: function() {
                const qty = $('#volume2').val();
                console.log(qty, 'fuadi qty');

                const volume = qty ? qty.split(' ')[0].trim() : 0
                const value = ((parseFloat($('#volumeStep1_2').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep1Wf_2').val() || '0%')) +
                    ((parseFloat($('#volumeStep2_2').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep2Wf_2').val() || '0%')) +
                    ((parseFloat($('#volumeStep3_2').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep3Wf_2').val() || '0%')) +
                    ((parseFloat($('#volumeStep4_2').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep4Wf_2').val() || '0%')) +
                    ((parseFloat($('#volumeStep5_2').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep5Wf_2').val() || '0%')) +
                    ((parseFloat($('#volumeStep6_2').val() || 0) / volume) * this.convertPercentageStringToFloat($('#activityStep6Wf_2').val() || '0%'));
                this.accumulativeTodate_2 = `${value.toFixed(2)}%`;
                this.progressIndividual_2 = `${(this.convertPercentageStringToFloat($('#accumulativePrevious_2').val() || '0%') + value).toFixed(2)}%`;
                this.incrimentalInput_2 = `${value.toFixed(2) - this.convertPercentageStringToFloat($('#accumulativePrevious_2').val() || '0%')}`;
            },
            fetchLevel: function(levelToGet) {
                var formData = new FormData();
                formData.append('levelToGet', levelToGet);
                formData.append('level1', this.discipline2);
                if (this.subDiscipline2) {
                    formData.append('level2', this.subDiscipline2.level_2);
                }
                if (this.activity2) {
                    formData.append('level3', this.activity2.level_3);
                }
                if (this.subActivity2) {
                    formData.append('level4', this.subActivity2.level_4);
                }
                if (this.detailSubActivity2) {
                    formData.append('level5', this.detailSubActivity2.level_5);
                }
                $.ajax({
                    url: "<?= base_url('Project_detail_construction/fetchLevel') ?>",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: (resp) => {
                        const data = JSON.parse(resp).data
                        if (levelToGet === 2) {
                            if (data.lengt === 0) {
                                this.fetchConstructinData(levelToGet)
                            } else {
                                this.listSubDiscipline2 = JSON.parse(resp).data
                            }
                        } else if (levelToGet === 3) {
                            if (data.lengt === 0) {
                                this.fetchConstructinData(levelToGet)
                            } else {
                                this.listActivity2 = JSON.parse(resp).data
                            }
                        } else if (levelToGet === 4) {
                            if (data.lengt === 0) {
                                this.fetchConstructinData(levelToGet)
                            } else {
                                this.listSubActivity2 = JSON.parse(resp).data
                            }
                        } else if (levelToGet === 5) {
                            if (data.lengt === 0) {
                                this.fetchConstructinData(levelToGet)
                            } else {
                                this.listDetailSubActivity2 = JSON.parse(resp).data
                            }
                        } else {
                            return null
                        }
                    },
                    error: err => console.log(err),
                });
            },
            populateLevel1: function() {
                const temp = <?= json_encode($data_list_level1) ?>;
                const data = [];
                temp.map(item => data.push(item.level_1));
                this.listDiscipline2 = data;
            },
            populateConstractionData: function(d) {
                const data = d
                console.log(data, 'fuadi d');
                $('#id_construction').val(data.id);
                $('#weightfactor2').val(`${data.wf}%`);
                $('#volume2').val(`${data.quantity} ${data.unit}`);

                $('#volumeStep1_2').val(null);
                $('#volumeStep2_2').val(null);
                $('#volumeStep3_2').val(null);
                $('#volumeStep4_2').val(null);
                $('#volumeStep5_2').val(null);
                $('#volumeStep6_2').val(null);

                $('.progressVolumeStep1_2').html(data.step_1_actual_volume ? parseFloat(data.step_1_actual_volume).toFixed(2) : '');
                $('.progressVolumeStep2_2').html(data.step_2_actual_volume ? parseFloat(data.step_2_actual_volume).toFixed(2) : '');
                $('.progressVolumeStep3_2').html(data.step_3_actual_volume ? parseFloat(data.step_3_actual_volume).toFixed(2) : '');
                $('.progressVolumeStep4_2').html(data.step_4_actual_volume ? parseFloat(data.step_4_actual_volume).toFixed(2) : '');
                $('.progressVolumeStep5_2').html(data.step_5_actual_volume ? parseFloat(data.step_5_actual_volume).toFixed(2) : '');
                $('.progressVolumeStep6_2').html(data.step_6_actual_volume ? parseFloat(data.step_6_actual_volume).toFixed(2) : '');

                $('#volumeStep1_2').prop('disabled', !data.step_1_name || data.quantity === data.step_1_actual_volume);
                $('#volumeStep2_2').prop('disabled', !data.step_2_name || data.quantity === data.step_2_actual_volume);
                $('#volumeStep3_2').prop('disabled', !data.step_3_name || data.quantity === data.step_3_actual_volume);
                $('#volumeStep4_2').prop('disabled', !data.step_4_name || data.quantity === data.step_4_actual_volume);
                $('#volumeStep5_2').prop('disabled', !data.step_5_name || data.quantity === data.step_5_actual_volume);
                $('#volumeStep6_2').prop('disabled', !data.step_6_name || data.quantity === data.step_6_actual_volume);

                $('#evidence_filename1_2').prop('disabled', !data.step_1_name || data.quantity === data.step_1_actual_volume);
                $('#evidence_filename2_2').prop('disabled', !data.step_2_name || data.quantity === data.step_2_actual_volume);
                $('#evidence_filename3_2').prop('disabled', !data.step_3_name || data.quantity === data.step_3_actual_volume);
                $('#evidence_filename4_2').prop('disabled', !data.step_4_name || data.quantity === data.step_4_actual_volume);
                $('#evidence_filename5_2').prop('disabled', !data.step_5_name || data.quantity === data.step_5_actual_volume);
                $('#evidence_filename6_2').prop('disabled', !data.step_6_name || data.quantity === data.step_6_actual_volume);

                $('#activityStep1_2').val(data.step_1_name);
                $('#activityStep2_2').val(data.step_2_name);
                $('#activityStep3_2').val(data.step_3_name);
                $('#activityStep4_2').val(data.step_4_name);
                $('#activityStep5_2').val(data.step_5_name);
                $('#activityStep6_2').val(data.step_6_name);

                $('#activityStep1Wf_2').val(data.step_1_wf ? `${data.step_1_wf}%` : '');
                $('#activityStep2Wf_2').val(data.step_2_wf ? `${data.step_2_wf}%` : '');
                $('#activityStep3Wf_2').val(data.step_3_wf ? `${data.step_3_wf}%` : '');
                $('#activityStep4Wf_2').val(data.step_4_wf ? `${data.step_4_wf}%` : '');
                $('#activityStep5Wf_2').val(data.step_5_wf ? `${data.step_5_wf}%` : '');
                $('#activityStep6Wf_2').val(data.step_6_wf ? `${data.step_6_wf}%` : '');

                // $('#progressStep1').val(data);
                // $('#progressStep2').val(data);
                // $('#progressStep3').val(data);
                // $('#progressStep4').val(data);
                // $('#progressStep5').val(data);
                // $('#progressStep6').val(data);

                // $('#progressIndividual').val(data);
                // $('#accumulativePrevious').val(data);
                // $('#accumulativeTodate').val(data);
                // $('#incrimentalInput').val(data);

                const accumulativePrevious = ((parseFloat(data.step_1_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_1_wf || 0)) +
                    ((parseFloat(data.step_2_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_2_wf || 0)) +
                    ((parseFloat(data.step_3_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_3_wf || 0)) +
                    ((parseFloat(data.step_4_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_4_wf || 0)) +
                    ((parseFloat(data.step_5_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_5_wf || 0)) +
                    ((parseFloat(data.step_6_actual_volume || 0) / parseFloat(data.quantity || 0)) * parseFloat(data.step_6_wf || 0));
                $('#accumulativePrevious_2').val(`${accumulativePrevious}%`);
                // $('#modal-edit-document').modal('show');
            },
            fetchConstructinData: function(param) {
                const levelToGet = param - 1;
                let id_construction;
                if (levelToGet === 2) {
                    id_construction = this.subDiscipline2.id;
                } else if (levelToGet === 3) {
                    id_construction = this.activity2.id;
                } else if (levelToGet === 4) {
                    id_construction = this.subActivity2.id;
                } else if (levelToGet === 5) {
                    id_construction = this.detailSubActivity2.id;
                }
                console.log(id_construction, 'faudi id_construction');
                var formData = new FormData();
                formData.append('id_construction', id_construction);
                $.ajax({
                    url: "<?= base_url('Project_detail_construction/fetchConstructinData') ?>",
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: (resp) => {
                        console.log(JSON.parse(resp), 'fuadi resp lagi');

                        this.populateConstractionData(JSON.parse(resp)[0])
                    },
                    error: err => console.log(err),
                });
            },
        },
        mounted: function() {
            console.log('Vue instance has been mounted2!');
            $('#modal-add-progress').on('hidden.bs.modal', (e) => {
                this.accumulativeTodate_2 = '';
                this.progressIndividual_2 = '';
                this.incrimentalInput_2 = '';
                this.discipline2 = '';
                this.subDiscipline2 = '';
                this.activity2 = '';
                this.subActivity2 = '';
                this.detailSubActivity2 = '';
                // this.listDiscipline2 = [];
                this.listSubDiscipline2 = [];
                this.listActivity2 = [];
                this.listSubActivity2 = [];
                this.listDetailSubActivity2 = [];
                this.listWeightfactor2 = [];
                this.listVolume2 = [];
                $('#accumulativeTodate_2').val('')
                $('#progressIndividual_2').val('')
                $('#incrimentalInput_2').val('')
                $('#accumulativePrevious_2').val('')

                $('#id_construction').val('');
                $('#weightfactor2').val('');
                $('#volume2').val('');

                $('#volumeStep1_2').val(null);
                $('#volumeStep2_2').val(null);
                $('#volumeStep3_2').val(null);
                $('#volumeStep4_2').val(null);
                $('#volumeStep5_2').val(null);
                $('#volumeStep6_2').val(null);

                $('.progressVolumeStep1_2').html('');
                $('.progressVolumeStep2_2').html('');
                $('.progressVolumeStep3_2').html('');
                $('.progressVolumeStep4_2').html('');
                $('.progressVolumeStep5_2').html('');
                $('.progressVolumeStep6_2').html('');

                $('#volumeStep1_2').prop('disabled', false);
                $('#volumeStep2_2').prop('disabled', false);
                $('#volumeStep3_2').prop('disabled', false);
                $('#volumeStep4_2').prop('disabled', false);
                $('#volumeStep5_2').prop('disabled', false);
                $('#volumeStep6_2').prop('disabled', false);

                $('#evidence_filename1_2').prop('disabled', false);
                $('#evidence_filename2_2').prop('disabled', false);
                $('#evidence_filename3_2').prop('disabled', false);
                $('#evidence_filename4_2').prop('disabled', false);
                $('#evidence_filename5_2').prop('disabled', false);
                $('#evidence_filename6_2').prop('disabled', false);

                $('#activityStep1_2').val('');
                $('#activityStep2_2').val('');
                $('#activityStep3_2').val('');
                $('#activityStep4_2').val('');
                $('#activityStep5_2').val('');
                $('#activityStep6_2').val('');

                $('#activityStep1Wf_2').val('');
                $('#activityStep2Wf_2').val('');
                $('#activityStep3Wf_2').val('');
                $('#activityStep4Wf_2').val('');
                $('#activityStep5Wf_2').val('');
                $('#activityStep6Wf_2').val('');

                $('#accumulativePrevious_2').val('');
            });
            this.populateLevel1();
            $(document).on('change', '#discipline2', (evt) => {
                this.subDiscipline2 = ''
                this.activity2 = ''
                this.subActivity2 = ''
                this.detailSubActivity2 = ''
                $('#subDiscipline2').val('');
                $('#activity2').val('');
                $('#subActivity2').val('');
                $('#detailSubActivity2').val('');
                this.listSubDiscipline2 = []
                this.listActivity2 = []
                this.listSubActivity2 = []
                this.listDetailSubActivity2 = []

                this.discipline2 = evt.target.value
                this.fetchLevel(2);
            });
            $(document).on('change', '#subDiscipline2', (evt) => {
                this.activity2 = ''
                this.subActivity2 = ''
                this.detailSubActivity2 = ''
                $('#activity2').val('');
                $('#subActivity2').val('');
                $('#detailSubActivity2').val('');
                this.listActivity2 = []
                this.listSubActivity2 = []
                this.listDetailSubActivity2 = []

                const data = evt.target.value;
                this.subDiscipline2 = JSON.parse(data)
                this.fetchLevel(3);
            });
            $(document).on('change', '#activity2', (evt) => {
                this.subActivity2 = ''
                this.detailSubActivity2 = ''
                $('#subActivity2').val('');
                $('#detailSubActivity2').val('');
                this.listSubActivity2 = []
                this.listDetailSubActivity2 = []

                const data = evt.target.value;
                this.activity2 = JSON.parse(data)
                this.fetchLevel(4);
            });
            $(document).on('change', '#subActivity2', (evt) => {
                this.detailSubActivity2 = ''
                $('#detailSubActivity2').val('');
                this.listDetailSubActivity2 = []

                const data = evt.target.value;
                this.subActivity2 = JSON.parse(data)
                this.fetchLevel(5);
            });
            $(document).on('change', '#detailSubActivity2', (evt) => {
                const data = evt.target.value;
                this.detailSubActivity2 = JSON.parse(data)
                this.fetchConstructinData(6);
            });
            //
            $(document).on('input', '#volumeStep1_2', () => {
                let val = $('#volumeStep1_2').val()
                console.log(val, 'fuadi val')
                const progress = $('.progressVolumeStep1_2').text()
                const qty = $('#volume2').val()
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep1Wf_2').val()

                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    console.log('fuad');
                    
                    $('#volumeStep1_2').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep1_2').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep1_2').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep2_2', () => {
                let val = $('#volumeStep2_2').val()
                const progress = $('.progressVolumeStep2_2').text()
                const qty = $('#volume2').val();
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep2Wf_2').val()
                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep2_2').val(parseFloat(total) - parseFloat(progress))
                }
                console.log(val)
                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep2_2').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep2_2').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep3_2', () => {
                let val = $('#volumeStep3_2').val()
                const progress = $('.progressVolumeStep3_2').text()
                const qty = $('#volume2').val();
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep3Wf_2').val()
                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep3_2').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep3_2').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep3_2').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep4_2', () => {
                let val = $('#volumeStep4_2').val()
                const progress = $('.progressVolumeStep4_2').val()
                const qty = $('#volume2').val();
                const wf = $('#activityStep4Wf_2').val()
                const total = qty ? qty.split(' ')[0].trim() : 0
                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep4_2').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep4_2').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep4_2').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep5_2', () => {
                let val = $('#volumeStep5_2').val()
                const progress = $('.progressVolumeStep5_2').text()
                const qty = $('#volume2').val();
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep5Wf_2').val()

                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep5_2').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep5_2').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep5_2').val('')
                }
                this.updateAccumulativeTodate()
            })
            $(document).on('input', '#volumeStep6_2', () => {
                let val = $('#volumeStep6_2').val()
                const progress = $('.progressVolumeStep6_2').text()
                const qty = $('#volume2').val();
                const total = qty ? qty.split(' ')[0].trim() : 0
                const wf = $('#activityStep6Wf_2').val()

                if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                    Swal.fire({
                        title: "Error",
                        text: "Nilai melebihi progress",
                        icon: "error",
                    });
                    $('#volumeStep6_2').val(parseFloat(total) - parseFloat(progress))
                }

                if (parseFloat(val) > 0) {
                    if ((parseFloat(total) - parseFloat(progress)) < parseFloat(val)) {
                        val = parseFloat(total) - parseFloat(progress)
                    }
                    const livePercent = ((parseFloat(progress) + parseFloat(val)) / parseFloat(total)) * parseFloat(wf)
                    $('#progressStep6_2').val(livePercent.toFixed(2) + '%')
                } else {
                    $('#progressStep6_2').val('')
                }
                this.updateAccumulativeTodate()
            })
        }
    });

    $(document).ready(function() {
        $('.select2').select2({
            placeholder: '-- Pilih opsi --',
            maximumSelectionLength: 2 // contoh konfigurasi tambahan
        });
    });
</script>