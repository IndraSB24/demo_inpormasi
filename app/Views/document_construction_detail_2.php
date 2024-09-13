<?= $this->include('partials/main') ?>

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>
    <style>
        td:nth-child(3) {
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
                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-add-document">
                            Add Document
                        </button>
                        <a href="<?= base_url('construction-dashboard') ?>" class="btn btn-warning waves-effect waves-light">
                            Construction Dashboard
                        </a>
                        <a href="<?= base_url('construction-doc-list/1') ?>" class="btn btn-success waves-effect waves-light">
                            Construction List
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
                                    <table id="datatable" class="table table-bordered nowrap">
                                        <thead style="border-top-width: 4px">
                                            <tr>
                                                <th rowspan="2" class="text-center" style="background-color: #b0cbf7;">NO</th>
                                                <th rowspan="2" class="text-center" style="background-color: #b0cbf7;">DOCUMENT NUMBER</th>
                                                <th rowspan="2" style="background-color: #D6CCC2;position: sticky;left: 0;z-index: 1;">DESCRIPTION</th>
                                                <th rowspan="2" class="text-center" style="width: 0px;background-color: #D6CCC2">WF</th>
                                                <th rowspan="1" colspan="6" class="text-center" style="background-color:#9dc9ae">PROGRESS</th>
                                                <!-- <th rowspan="2" class="text-center" style="background-color: #b0cbf7">
                                                    ACTION
                                                </th> -->
                                            </tr>
                                            <tr>
                                                <th class="text-center" style="background-color:#C5EDAC">1</th>
                                                <th class="text-center" style="background-color:#C5EDAC">2</th>
                                                <th class="text-center" style="background-color:#C5EDAC">3</th>
                                                <th class="text-center" style="background-color:#C5EDAC">4</th>
                                                <th class="text-center" style="background-color:#C5EDAC">5</th>
                                                <th class="text-center" style="background-color:#C5EDAC">6</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php foreach ($list_data as $index => $item) : ?>
                                                <tr>
                                                    <td class="text-center" style="background-color:#d2e5f7"> <?= $index + 1 ?> </td>
                                                    <td class="text-center" style="background-color:#d2e5f7"> <?= $item->document_number ?> </td>
                                                    <td style="background-color:#faf1e3"> <?= $item->description ?> </td>
                                                    <td class="text-center" style="background-color:#faf1e3"> <?= $item->wf ?> </td>
                                                    <td class="text-center" style="background-color:#C7F9CC; white-space: normal;word-wrap: break-word;max-width: 450px;">
                                                        <?php
                                                        $button = '
                                                         <a href="javascript:" class="addProgress badge bg-primary mt-1 p-2 w-xs"
                                                                data-id="' . $item->id_construction . '"
                                                                data-document-name="' . $item->description . '"
                                                                data-step="1"
                                                            >
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        $label = '
                                                         <span>' . $item->step_1_name . '</span><br>
                                                         <span>' . $item->step_1_wf . '%</span><br>
                                                         '
                                                        ?>
                                                        <?= !$item->step_1_name ? $button : $label ?>
                                                    </td>
                                                    <td class="text-center" style="background-color:#C7F9CC; white-space: normal;word-wrap: break-word;max-width: 450px;">
                                                        <?php
                                                        $button = '
                                                         <a href="javascript:" class="addProgress badge bg-primary mt-1 p-2 w-xs"
                                                                data-id="' . $item->id_construction . '"
                                                                data-document-name="' . $item->description . '"
                                                                data-step="2"
                                                            >
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        $label = '
                                                         <span>' . $item->step_2_name . '</span><br>
                                                         <span>' . $item->step_2_wf . '%</span><br>
                                                         ';
                                                        $disableButton = '
                                                         <a href="javascript:waitingSwal();" class="badge bg-secondary mt-1 p-2 w-xs">
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        ?>
                                                        <?= !$item->step_2_name ? ($item->step_1_name ? $button : $disableButton) : $label ?>
                                                    </td>
                                                    <td class="text-center" style="background-color:#C7F9CC; white-space: normal;word-wrap: break-word;max-width: 450px;">
                                                        <?php
                                                        $button = '
                                                         <a href="javascript:" class="addProgress badge bg-primary mt-1 p-2 w-xs"
                                                                data-id="' . $item->id_construction . '"
                                                                data-document-name="' . $item->description . '"
                                                                data-step="3"
                                                            >
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        $label = '
                                                         <span>' . $item->step_3_name . '</span><br>
                                                         <span>' . $item->step_3_wf . '%</span><br>
                                                         ';
                                                         $disableButton = '
                                                         <a href="javascript:waitingSwal();" class="badge bg-secondary mt-1 p-2 w-xs">
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        ?>
                                                        <?= !$item->step_3_name ? ($item->step_2_name ? $button : $disableButton) : $label ?>
                                                    </td>
                                                    <td class="text-center" style="background-color:#C7F9CC; white-space: normal;word-wrap: break-word;max-width: 450px;">
                                                        <?php
                                                        $button = '
                                                         <a href="javascript:" class="addProgress badge bg-primary mt-1 p-2 w-xs"
                                                                data-id="' . $item->id_construction . '"
                                                                data-document-name="' . $item->description . '"
                                                                data-step="4"
                                                            >
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        $label = '
                                                         <span>' . $item->step_4_name . '</span><br>
                                                         <span>' . $item->step_4_wf . '%</span><br>
                                                         ';
                                                         $disableButton = '
                                                         <a href="javascript:waitingSwal();" class="badge bg-secondary mt-1 p-2 w-xs">
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        ?>
                                                        <?= !$item->step_4_name ? ($item->step_3_name ? $button : $disableButton) : $label ?>
                                                    </td>
                                                    <td class="text-center" style="background-color:#C7F9CC; white-space: normal;word-wrap: break-word;max-width: 450px;">
                                                        <?php
                                                        $button = '
                                                         <a href="javascript:" class="addProgress badge bg-primary mt-1 p-2 w-xs"
                                                                data-id="' . $item->id_construction . '"
                                                                data-document-name="' . $item->description . '"
                                                                data-step="5"
                                                            >
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        $label = '
                                                         <span>' . $item->step_5_name . '</span><br>
                                                         <span>' . $item->step_5_wf . '%</span><br>
                                                         ';
                                                         $disableButton = '
                                                         <a href="javascript:waitingSwal();" class="badge bg-secondary mt-1 p-2 w-xs">
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        ?>
                                                        <?= !$item->step_5_name ? ($item->step_4_name ? $button : $disableButton) : $label ?>
                                                    </td>
                                                    <td class="text-center" style="background-color:#C7F9CC; white-space: normal;word-wrap: break-word;max-width: 450px;">
                                                        <?php
                                                        $button = '
                                                         <a href="javascript:" class="addProgress badge bg-primary mt-1 p-2 w-xs"
                                                                data-id="' . $item->id_construction . '"
                                                                data-document-name="' . $item->description . '"
                                                                data-step="6"
                                                            >
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        $label = '
                                                         <span>' . $item->step_6_name . '</span><br>
                                                         <span>' . $item->step_6_wf . '%</span><br>
                                                         ';
                                                         $disableButton = '
                                                         <a href="javascript:waitingSwal();" class="badge bg-secondary mt-1 p-2 w-xs">
                                                                &nbsp;ADD PROGRESS&nbsp;
                                                            </a>
                                                         ';
                                                        ?>
                                                        <?= !$item->step_6_name ? ($item->step_5_name ? $button : $disableButton) : $label ?>
                                                    </td>
                                                    <!-- <td class="text-center" nowrap style="background-color: #d2e5f7">
                                                        <a href="#" id="btn-edit-doc" data-bs-toggle="modal" data-bs-target="#modal-edit">
                                                            <i class="ri-pencil-fill text-info font-size-20"></i>
                                                        </a>
                                                        &nbsp;
                                                    </td> -->

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

<!--Modal Add Document-->
<div class="modal fade" id="modal-add-document" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Construction Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 1</label>
                            <input type="text" class="form-control" name="level_code" id="level_code" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 2</label>
                            <input type="text" class="form-control" name="level_code_2" id="level_code_2" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 3</label>
                            <input type="text" class="form-control" name="level_code_3" id="level_code_3" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 4</label>
                            <input type="text" class="form-control" name="level_code_4" id="level_code_4" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 5</label>
                            <input type="text" class="form-control" name="level_code_5" id="level_code_5" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Group</label>
                            <select class="form-control" id="group">
                                <option value="">--Select--</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description" />
                        </div>
                    </div> -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Weight Factor</label>
                            <input type="number" class="form-control" name="weight_factor" id="weight_factor" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Quantity</label>
                            <select class="form-control" id="quantity">
                                <option value="">--Select--</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Unit</label>
                            <select class="form-control" id="unit">
                                <option value="">--Select--</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="form-label">Plan</label>
                        <div class="col-md-4">
                            <label class="form-label">PO</label>
                            <div class="input-group" id="po_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#po_date" data-provide="datepicker" name="po_date" id="plan_po" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">FAT</label>
                            <div class="input-group" id="fat_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#fat_date" data-provide="datepicker" name="fat_date" id="plan_fat" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">RFS</label>
                            <div class="input-group" id="rfs_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#rfs_date" data-provide="datepicker" name="rfs_date" id="plan_rfs" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <label class="form-label">RFQ</label>
                            <div class="input-group" id="ifr_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifr_date" data-provide="datepicker" name="plan_ifr" id="plan_ifr" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">TBE</label>
                            <div class="input-group" id="ifa_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifa_date" data-provide="datepicker" name="plan_ifa" id="plan_ifa" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">ONSITE</label>
                            <div class="input-group" id="onsite_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#onsite_date" data-provide="datepicker" name="onsite_date" id="plan_onsite" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">INSTALL</label>
                            <div class="input-group" id="install_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#install_date" data-provide="datepicker" name="install_date" id="plan_install" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">COMM</label>
                            <div class="input-group" id="comm_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#comm_date" data-provide="datepicker" name="comm_date" id="plan_comm" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-doc" title="Add Data" data-object="Project_detail_procurement/add/doc_procurement">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>


<div class="modal fade" id="modal-add-progress" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Progress</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <input type="text" disabled class="form-control" name="level_code" id="description" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Progress Step</label>
                            <input type="text" disabled class="form-control" name="level_code" id="progress_step" />
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Weight Factor</label>
                            <input type="number" class="form-control" name="level_code_3" id="progress_wf" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Progress Name</label>
                            <input type="text" class="form-control" name="level_code_2" id="progress_name" />
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_construction">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-progress" title="Add Data" data-object="Project_detail_construction/addMeasurementBasis">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!--Modal Edit Document-->
<div class="modal fade" id="modal-edit-document" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Construction Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 1</label>
                            <input type="text" class="form-control" name="level_code_edit" id="level_code_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 2</label>
                            <input type="text" class="form-control" name="level_code_2_edit" id="level_code_2_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 3</label>
                            <input type="text" class="form-control" name="level_code_3_edit" id="level_code_3_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 4</label>
                            <input type="text" class="form-control" name="level_code_4_edit" id="level_code_4_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 5</label>
                            <input type="text" class="form-control" name="level_code_5_edit" id="level_code_5_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Group</label>
                            <select class="form-control" id="group_edit">
                                <option value="">--Select--</option>
                            </select>
                        </div>
                    </div>
                    <!-- <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description_edit" id="description_edit" />
                        </div>
                    </div> -->
                    <div class="row mb-4">
                        <div class="col-md-4">
                            <label class="form-label">Weight Factor</label>
                            <input type="number" class="form-control" name="weight_factor_edit" id="weight_factor_edit" />
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Quantity</label>
                            <select class="form-control" id="quantity_edit">
                                <option value="">--Select--</option>
                            </select>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">Unit</label>
                            <select class="form-control" id="unit_edit">
                                <option value="">--Select--</option>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="form-label">Plan</label>
                        <div class="col-md-4">
                            <label class="form-label">PO</label>
                            <div class="input-group" id="po_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#po_date_edit" data-provide="datepicker" name="po_date_edit" id="plan_po_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">FAT</label>
                            <div class="input-group" id="fat_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#fat_date_edit" data-provide="datepicker" name="fat_date_edit" id="plan_fat_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">RFS</label>
                            <div class="input-group" id="rfs_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#rfs_date_edit" data-provide="datepicker" name="rfs_date_edit" id="plan_rfs_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <!-- <div class="col-md-4">
                            <label class="form-label">RFQ</label>
                            <div class="input-group" id="ifr_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifr_date" data-provide="datepicker" name="plan_ifr" id="plan_ifr" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">TBE</label>
                            <div class="input-group" id="ifa_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifa_date" data-provide="datepicker" name="plan_ifa" id="plan_ifa" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div> -->
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <label class="form-label">ONSITE</label>
                            <div class="input-group" id="onsite_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#onsite_date_edit" data-provide="datepicker" name="onsite_date_edit" id="plan_onsite_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">INSTALL</label>
                            <div class="input-group" id="install_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#install_date_edit" data-provide="datepicker" name="install_date_edit" id="plan_install_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">COMM</label>
                            <div class="input-group" id="comm_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#comm_date_edit" data-provide="datepicker" name="comm_date_edit" id="plan_comm_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_doc_edit" />
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-edit-doc" title="Edit Document" data-object="Project_detail_procurement/update/document_detail">Save</button>
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

<script>
    console.log(<?= json_encode($list_data) ?>, 'MEASUREMENT BASIS');

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

    $(document).on('click', '.addProgress', function() {
        $('#id_construction').val($(this).data('id'))
        $('#description').val($(this).data('document-name'))
        $('#progress_step').val($(this).data('step'))
        $('#progress_wf').val('')
        $('#progress_name').val('')
        $('#modal-add-progress').modal('show');
    });

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

    // update document detail
    // ==========================================================================================================================================================================    
    // get Edit document
    $(document).on('click', '#btn-edit-doc', function() {
        // get data from button edit
        const id_edit = $(this).data('id'),
            levelCode = $(this).data('level_code'),
            levelCode2 = $(this).data('level_code_2'),
            levelCode3 = $(this).data('level_code_3'),
            levelCode4 = $(this).data('level_code_4'),
            levelCode5 = $(this).data('level_code_5'),
            group = $(this).data('group'),
            quantity = $(this).data('quantity'),
            unit = $(this).data('unit'),
            weightFactor = $(this).data('weight_factor');

        // description = $(this).data('description'),

        planPo = $(this).data('plan_po');
        planFat = $(this).data('plan_fat');
        planRfs = $(this).data('plan_rfs');
        planOnsite = $(this).data('plan_onsite');
        planInstall = $(this).data('plan_install');
        planComm = $(this).data('plan_comm');
        // planIfr = $(this).data('plan_ifr'),
        // planIfa = $(this).data('plan_ifa'),
        // planIfc = $(this).data('plan_ifc');

        // Set data to Form Edit
        $('#id_doc_edit').val(id_edit);
        $('#level_code_edit').val(levelCode);
        $('#level_code_2_edit').val(levelCode2);
        $('#level_code_3_edit').val(levelCode3);
        $('#level_code_4_edit').val(levelCode4);
        $('#level_code_5_edit').val(levelCode5);
        $('#group_edit').val(group);
        $('#quantity_edit').val(quantity);
        $('#unit_edit').val(unit);
        $('#weight_factor_edit').val(weightFactor);
        $('#plan_po_edit').val(planPo);
        $('#plan_fat_edit').val(planFat);
        $('#plan_rfs_edit').val(planRfs);
        $('#plan_onsite_edit').val(planOnsite);
        $('#plan_install_edit').val(planInstall);
        $('#plan_comm_edit').val(planComm);
        // $('#description_edit').val(description);
        // $('#plan_ifr_edit').val(planIfr);
        // $('#plan_ifa_edit').val(planIfa);
        // $('#plan_ifc_edit').val(planIfc);

        // Call Modal Edit
        $('#modal-edit-document').modal('show');
    })

    $(document).on('click', '#btn-simpan-edit-doc', function() {
        const objek = $(this).data('object'),
            id = document.getElementById("id_doc_edit").value,
            levelCodeEdit = document.getElementById("level_code_edit").value,
            weightFactorEdit = document.getElementById("weight_factor_edit").value,
            levelCode2Edit = document.getElementById("level_code_2_edit").value,
            levelCode3Edit = document.getElementById("level_code_3_edit").value,
            levelCode4Edit = document.getElementById("level_code_4_edit").value,
            levelCode5Edit = document.getElementById("level_code_5_edit").value,
            groupEdit = document.getElementById("group_edit").value,
            quantityEdit = document.getElementById("quantity_edit").value,
            unitEdit = document.getElementById("unit_edit").value,
            planPoEdit = document.getElementById("plan_po_edit").value,
            planFatEdit = document.getElementById("plan_fat_edit").value,
            planRfsEdit = document.getElementById("plan_rfs_edit").value,
            planOnsiteEdit = document.getElementById("plan_onsite_edit").value,
            planInstallEdit = document.getElementById("plan_install_edit").value,
            planCommEdit = document.getElementById("plan_comm_edit").value,
            // descriptionEdit = document.getElementById("description_edit").value,
            // planIfrEdit = document.getElementById("plan_ifr_edit").value;
            planIfaEdit = document.getElementById("plan_ifa_edit").value;
        planIfcEdit = document.getElementById("plan_ifc_edit").value;
        var timerInterval;
        Swal.fire({
            title: 'Edit Document?',
            icon: 'info',
            text: 'Patikan Data yang Diketik Sudah Sesuai!',
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
                        level_code_edit: levelCodeEdit,
                        level_code_2_edit: levelCode2Edit,
                        level_code_3_edit: levelCode3Edit,
                        level_code_4_edit: levelCode4Edit,
                        level_code_5_edit: levelCode5Edit,
                        weight_factor_edit: weightFactorEdit,
                        group_edit: groupEdit,
                        quantity_edit: quantityEdit,
                        unit_edit: unitEdit,
                        plan_po_edit: planPoEdit,
                        plan_fat_edit: planFatEdit,
                        plan_rfs_edit: planRfsEdit,
                        plan_onsite_edit: planOnsiteEdit,
                        plan_install_edit: planInstallEdit,
                        plan_comm_edit: planCommEdit,
                        // description_edit: descriptionEdit,
                        // plan_ifr_edit: planIfrEdit,
                        // plan_ifa_edit: planIfaEdit,
                        // plan_ifc_edit: planIfcEdit
                    },
                    success: () => {
                        Swal.fire({
                            title: 'Diedit!',
                            icon: 'success',
                            text: 'Document Berhasil Diedit.',
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

    $(document).on('click', '#btn-simpan-progress', function() {
        const objek = $(this).data('object');
        const id_construction = $('#id_construction').val();
        const progress_step = $('#progress_step').val();
        const progress_name = $('#progress_name').val();
        const progress_wf = $('#progress_wf').val();
        Swal.fire({
            title: 'Add Progress?',
            icon: 'info',
            text: 'Patikan Data yang Diketik Sudah Sesuai!',
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
                        id_construction: id_construction,
                        progress_step: progress_step,
                        progress_name: progress_name,
                        progress_wf: progress_wf,
                    },
                    success: () => {
                        Swal.fire({
                            title: 'Ditambahkan!',
                            icon: 'success',
                            text: 'Document Berhasil Ditambahkan.',
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
</script>