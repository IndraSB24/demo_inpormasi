<!-- php function for this page -->
<?php
// Function to generate status badge HTML
function generateStatusBadge(
    $status,
    $date,
    $id,
    $description,
    $linkFile,
    $step,
    $file_version,
    $step_code,
    $status_desc
) {
    switch ($status) {
        case 'approve':
            return generateBadge(
                'success',
                'APPROVED',
                $date,
                $id,
                $description,
                $linkFile,
                $step,
                $file_version,
                $step_code,
                $status_desc
            );
        case 'reject':
            return generateBadge(
                'danger',
                'REJECTED',
                $date,
                $id,
                $description,
                $linkFile,
                $step,
                $file_version,
                $step_code,
                $status_desc
            );
        case 'progress':
            return generateBadge(
                'info',
                'DETAIL',
                $date,
                $id,
                $description,
                $linkFile,
                $step,
                $file_version,
                $step_code,
                $status_desc
            );
        default:
            return generateWaitingBadge();
    }
}

// Function to generate badge HTML
function generateBadge(
    $color,
    $text,
    $date,
    $id,
    $description,
    $linkFile,
    $step,
    $file_version,
    $step_code,
    $status_desc
) {
    $html = tgl_indo($date) .
        '<br>' .
        $status_desc .
        '<br>';
    $html .= '<a href="' . base_url('commentPdf/') . '/' . $id . '/' . $step_code . '" class="badge bg-' . $color . ' mt-1 p-2 w-xs" id="btn-approval" 
                    data-id="' . $id . '"
                    data-doc_desc="' . $description . '"
                    data-link_file="' . $linkFile . '"
                    data-step="' . $step . '"
                    data-version="' . $file_version . '"
                >' . $text . '</a>';
    return $html;
}

// Function to generate waiting badge HTML
function generateWaitingBadge()
{
    $html = '
            no date yet
            <br>
            no file yet
            <br>
            <a href="javascript:waitingSwal();" class="badge bg-warning mt-1 p-2 w-xs" >
                &nbsp;WAITING&nbsp;
            </a>';
    return $html;
}

?>

<?= $this->include('partials/main') ?>

<head>
    <?= $title_meta ?>
    <!-- <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" /> -->
    <?= $this->include('partials/head-css') ?>
</head>
<style>
    /* .desc {
            width: 0px !important;
        } */
    td:nth-child(3) {
        position: sticky;
        left: 0;
        background-color: #f2f2f2;
        /* Optional: set background color */
        z-index: 1;
        /* Optional: set z-index to ensure it's above other elements */
    }

    td:nth-child(5) {
        position: sticky;
        left: 13em;
        background-color: #f2f2f2;
        /* Optional: set background color */
        z-index: 1;
        /* Optional: set z-index to ensure it's above other elements */
    }
</style>
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
                        <a href="<?= base_url('engineering-dashboard') ?>" class="btn btn-warning waves-effect waves-light">
                            Engineering Dashboard
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
                                <div class="table-rep-plugin">
                                    <div class="table-responsive mb-0" data-pattern="priority-columns"></div>
                                    <font size="2">
                                        <?php if (sessActiveRole() === 'vendor_external') { ?>
                                            <table id="scroll-vertical-datatable" class="table table-bordered nowrap" style="border: 0px;">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="4" style="background-color: #b0cbf7;">NO</th>
                                                        <th rowspan="4" style="background-color: #b0cbf7;">WBS CODE</th>
                                                        <th rowspan="4" style="background-color: #b0cbf7;position:sticky;left:0;z-index: 100">DOCUMENT NUMBER</th>
                                                        <th rowspan="4" style="background-color: #b0cbf7;">DOCUMENT DICIPLINE</th>
                                                        <th class="desc" rowspan="4" style="width: 0px;background-color: #b0cbf7;position:sticky;left:13em;z-index: 100">DESCRIPTION</th>
                                                        <th class="desc" rowspan="4" style="width: 0px;background-color: #b0cbf7;">MANHOUR PLAN</th>
                                                        <th class="desc" rowspan="4" style="width: 0px;background-color: #b0cbf7;">MANHOUR ACTUAL</th>
                                                        <th colspan="9" class="text-center" style="background-color:#9dc9ae">EXTERNAL</th>
                                                        <th rowspan="4" class="text-center" style="background-color: #b0cbf7;">STATUS</th>
                                                    </tr>
                                                    <tr>
                                                        <th rowspan="3" style="background-color:#d3f5b0">WEIGHT FACTOR</th>
                                                        <th colspan="4" class="text-center" style="background-color:#b0f5b0">PLAN</th>
                                                        <th colspan="4" class="text-center" style="background-color:#a0faca">ACTUAL</th>

                                                    </tr>
                                                    <tr>
                                                        <!-- <th class="text-center" style="background-color:#d2fad2">IFR</th> -->
                                                        <th class="text-center" style="background-color:#d2fad2">IFA</th>
                                                        <th class="text-center" style="background-color:#d2fad2">IFC /IFP</th>
                                                        <th class="text-center" style="background-color:#d2fad2">FINAL RESULT/ ASBUILD</th>
                                                        <th class="text-center" style="background-color:#d2fad2">CUMMULATIVE</th>
                                                        <!-- <th class="text-center" style="background-color:#c1f5d9">IFR</th> -->
                                                        <th class="text-center" style="background-color:#c1f5d9">IFA</th>
                                                        <th class="text-center" style="background-color:#c1f5d9">IFC /IFP</th>
                                                        <th class="text-center" style="background-color:#c1f5d9">FINAL RESULT/ ASBUILD</th>
                                                        <th class="text-center" style="background-color:#c1f5d9">CUMMULATIVE</th>
                                                    </tr>
                                                    <tr>
                                                        <!-- <th class="text-center" style="background-color:#d2fad2"><?= $data_weight[0]->description ?>%</th> -->
                                                        <th class="text-center" style="background-color:#d2fad2"><?= $data_weight[1]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#d2fad2"><?= $data_weight[2]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#d2fad2"><?= $data_weight[3]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#d2fad2">100%</th>
                                                        <!-- <th class="text-center" style="background-color:#c1f5d9"><?= $data_weight[0]->description ?>%</th> -->
                                                        <th class="text-center" style="background-color:#c1f5d9"><?= $data_weight[1]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#c1f5d9"><?= $data_weight[2]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#c1f5d9"><?= $data_weight[3]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#c1f5d9">100%</th>
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
                                                    $no = 0;
                                                    foreach ($list_doc_engineering as $row) :
                                                        $no++;
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


                                                        $linkFile = base_url('upload/engineering_doc/list/' . $row->file);
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
                                                                <a href="javascript:waitingSwal();" class="badge bg-warning mt-1 p-2 w-xs" >
                                                                    &nbsp;WAITING&nbsp;
                                                                </a>
                                                            ';
                                                        }

                                                        // set actual IFA status
                                                        $actual_ifa = generateStatusBadge(
                                                            $row->actual_ifa_status,
                                                            $row->actual_ifa,
                                                            $row->id,
                                                            $row->description,
                                                            $linkFile,
                                                            'IFA',
                                                            $file_version,
                                                            'external_ifa',
                                                            'version ' . $file_version
                                                        );
                                                        $actual_AsBuild = generateStatusBadge(
                                                            $row->external_asbuild_status,
                                                            $row->external_asbuild_actual,
                                                            $row->id,
                                                            $row->description,
                                                            $linkFile,
                                                            'AsBuild',
                                                            $file_version,
                                                            'external_asbuild',
                                                            'version ' . $file_version
                                                        );

                                                        // set actual IFC status                                                       
                                                        $actual_ifc = generateStatusBadge(
                                                            $row->actual_ifc_status,
                                                            $row->actual_ifc,
                                                            $row->id,
                                                            $row->description,
                                                            $linkFile,
                                                            'IFC',
                                                            $file_version,
                                                            'external_ifc',
                                                            'version ' . $file_version
                                                        );
                                                    ?>
                                                        <tr>
                                                            <td nowrap style="background-color: #d2e5f7;"><?= $no ?></td>
                                                            <td nowrap style="background-color: #d2e5f7;"><?= $row->wbs_code ?></td>
                                                            <td class="text-center" style="background-color: #d2e5f7;" nowrap> <?= $row->level_code ?> </td>
                                                            <td class="text-center" style="background-color: #d2e5f7;" nowrap> <?= $row->doc_dicipline ?> </td>
                                                            <td style="background-color: #d2e5f7;"><?= $row->description ?></td>
                                                            <td class="text-center" style="background-color: #d2e5f7;"><?= $row->man_hour_plan ?></td>
                                                            <td class="text-center" style="background-color: #d2e5f7;"><?= $row->man_hour_actual ?></td>
                                                            <td class="text-center" style="background-color: #dff5c9;"><?= $row->weight_factor ?>%</td>
                                                            <!-- <td class="text-center" style="background-color: #e5f2e5;" nowrap><?= tgl_indo($row->plan_ifr) ?></td> -->
                                                            <td class="text-center" style="background-color: #e5f2e5;" nowrap><?= tgl_indo($row->plan_ifa) ?></td>
                                                            <td class="text-center" style="background-color: #e5f2e5;" nowrap><?= tgl_indo($row->plan_ifc) ?></td>
                                                            <td class="text-center" style="background-color: #e5f2e5;" nowrap><?= tgl_indo($row->external_asbuild_plan) ?></td>
                                                            <td class="text-center" style="background-color: #e5f2e5;"><?= $plan_cumulative ?>%</td>
                                                            <!-- <td class="text-center" style="background-color: #daf7e8;" nowrap><?= $actual_ifr ?></td> -->
                                                            <td class="text-center" style="background-color: #daf7e8;" nowrap><?= $actual_ifa ?></td>
                                                            <td class="text-center" style="background-color: #daf7e8;" nowrap><?= $actual_ifc ?></td>
                                                            <td class="text-center" style="background-color: #daf7e8;" nowrap><?= $actual_AsBuild ?></td>
                                                            <td class="text-center" style="background-color: #daf7e8;"><?= $actual_cumulative ?>%</td>
                                                            <td class="text-center" style="background-color: #d2e5f7;">
                                                                <a href="<?= base_url('document-timeline/' . $row->id) ?>">
                                                                    <?= $status ?>
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
                                        <?php } else { ?>
                                            <table id="scroll-vertical-datatable" class="table table-bordered nowrap" style="border: 0px;">
                                                <thead>
                                                    <tr>
                                                        <th rowspan="4" style="background-color: #b0cbf7;">NO</th>
                                                        <th rowspan="4" style="background-color: #b0cbf7;">WBS CODE</th>
                                                        <th rowspan="4" style="background-color: #b0cbf7;position:sticky;left:0;z-index: 100">DOCUMENT NUMBER</th>
                                                        <th rowspan="4" style="background-color: #b0cbf7;">DOCUMENT DICIPLINE</th>
                                                        <th class="desc" rowspan="4" style="width: 0px;background-color: #b0cbf7;position:sticky;left:13em;z-index: 100">DESCRIPTION</th>
                                                        <th class="desc" rowspan="4" style="width: 0px;background-color: #b0cbf7;">MANHOUR PLAN</th>
                                                        <th class="desc" rowspan="4" style="width: 0px;background-color: #b0cbf7;">MANHOUR ACTUAL</th>
                                                        <th colspan="4" class="text-center" style="background-color:#fad8a2">INTERNAL</th>
                                                        <th colspan="9" class="text-center" style="background-color:#9dc9ae">EXTERNAL</th>
                                                        <th rowspan="4" class="text-center" style="background-color: #b0cbf7;">STATUS</th>
                                                        <th rowspan="4" class="text-center" style="background-color: #b0cbf7;">ACTION</th>
                                                    </tr>
                                                    <tr>

                                                        <th rowspan="3" style="background-color:blanchedalmond">JEDHI TEKNIKA</th>
                                                        <th rowspan="3" style="background-color:blanchedalmond">ENGINER PP</th>
                                                        <th rowspan="3" style="background-color:blanchedalmond">HO PP</th>
                                                        <th rowspan="3" style="background-color:blanchedalmond">PEM PP</th>
                                                        <th rowspan="3" style="background-color:#d3f5b0">WEIGHT FACTOR</th>
                                                        <th colspan="4" class="text-center" style="background-color:#b0f5b0">PLAN</th>
                                                        <th colspan="4" class="text-center" style="background-color:#a0faca">ACTUAL</th>

                                                    </tr>
                                                    <tr>
                                                        <!-- <th class="text-center" style="background-color:#d2fad2">IFR</th> -->
                                                        <th class="text-center" style="background-color:#d2fad2">IFA</th>
                                                        <th class="text-center" style="background-color:#d2fad2">IFC /IFP</th>
                                                        <th class="text-center" style="background-color:#d2fad2">FINAL RESULT/ ASBUILD</th>
                                                        <th class="text-center" style="background-color:#d2fad2">CUMMULATIVE</th>
                                                        <!-- <th class="text-center" style="background-color:#c1f5d9">IFR</th> -->
                                                        <th class="text-center" style="background-color:#c1f5d9">IFA</th>
                                                        <th class="text-center" style="background-color:#c1f5d9">IFC /IFP</th>
                                                        <th class="text-center" style="background-color:#c1f5d9">FINAL RESULT/ ASBUILD</th>
                                                        <th class="text-center" style="background-color:#c1f5d9">CUMMULATIVE</th>
                                                    </tr>
                                                    <tr>
                                                        <!-- <th class="text-center" style="background-color:#d2fad2"><?= $data_weight[0]->description ?>%</th> -->
                                                        <th class="text-center" style="background-color:#d2fad2"><?= $data_weight[1]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#d2fad2"><?= $data_weight[2]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#d2fad2"><?= $data_weight[3]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#d2fad2">100%</th>
                                                        <!-- <th class="text-center" style="background-color:#c1f5d9"><?= $data_weight[0]->description ?>%</th> -->
                                                        <th class="text-center" style="background-color:#c1f5d9"><?= $data_weight[1]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#c1f5d9"><?= $data_weight[2]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#c1f5d9"><?= $data_weight[3]->description ?>%</th>
                                                        <th class="text-center" style="background-color:#c1f5d9">100%</th>
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
                                                    $no = 0;
                                                    foreach ($list_doc_engineering as $row) :
                                                        $no++;
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


                                                        // internal section
                                                        $linkFile = base_url('upload/engineering_doc/list/' . $row->file);
                                                        $file_version = $row->file_version ? $row->file_version : 'nothing';
                                                        if ($row->has_access === '1' || $row->has_access === '2' || sessActiveRole() == 'super_admin') {
                                                            if ($row->internal_originator_status === 'uploaded') {
                                                                $actual_JEDHI = tgl_indo($row->internal_originator_date) .
                                                                    '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_engineering/preview' . ' class="badge bg-success mt-1 p-2 w-xs"
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-link_file = "' . $linkFile . '"
                                                                        data-step = "IFR"
                                                                        data-version = "' . $file_version . '"
                                                                    >
                                                                        &nbsp;DETAIL&nbsp;
                                                                    </a>
                                                                ';
                                                            } else if ($row->internal_originator_status === 'progress') {
                                                                $actual_JEDHI = '
                                                                    no date yet
                                                                <br>
                                                                    no file yet
                                                                <br>
                                                                <a href=' . base_url('reupload/') . '/' . $row->id  . ' class="badge bg-warning mt-1 p-2 w-xs"
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-path = "Project_detail_engineering/update/up_originator"
                                                                        data-step = ""
                                                                        data-version = "' . $file_version . '"
                                                                        data-doc_code = "' . $row->level_code . '"
                                                                        data-doc_name = "' . $row->description . '"
                                                                    >
                                                                        &nbsp;REUPLOAD&nbsp;
                                                                    </a>
                                                                ';
                                                            } else {
                                                                $actual_JEDHI = '
                                                                    no date yet
                                                                <br>
                                                                    no file yet
                                                                <br>
                                                                    <a href="#" class="badge bg-warning mt-1 p-2 w-xs" id="btn-upload-file" 
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-path = "Project_detail_engineering/update/up_originator"
                                                                        data-step = ""
                                                                        data-version = "' . $file_version . '"
                                                                        data-doc_code = "' . $row->level_code . '"
                                                                        data-doc_name = "' . $row->description . '"
                                                                    >
                                                                        &nbsp;UP FILE&nbsp;
                                                                    </a>
                                                                ';
                                                            }
                                                        } else {
                                                            $actual_JEDHI = '
                                                                    no date yet
                                                                <br>
                                                                    no file yet
                                                                <br>
                                                                    <a href="javascript:noAccessSwal();" class="badge bg-secondary mt-1 p-2 w-xs"
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-path = "Project_detail_engineering/update/up_originator"
                                                                        data-step = ""
                                                                        data-version = "' . $file_version . '"
                                                                        data-doc_code = "' . $row->level_code . '"
                                                                        data-doc_name = "' . $row->description . '"
                                                                    >
                                                                        &nbsp;NO ACCESS&nbsp;
                                                                    </a>
                                                                ';
                                                        }

                                                        if ($row->has_access === '2' || sessActiveRole() == 'super_admin') {
                                                            if ($row->internal_engineering_status === 'approve') {
                                                                $enginerPP = tgl_indo($row->internal_engineering_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_engineering/preview' . ' class="badge bg-success mt-1 p-2 w-xs" id="btn-approval" 
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-link_file = "' . $linkFile . '"
                                                                        data-step = "IFA"
                                                                        data-version = "' . $file_version . '"
                                                                    >
                                                                        &nbsp;APPROVED&nbsp;
                                                                    </a>
                                                                ';
                                                            } else if ($row->internal_engineering_status === 'reject') {
                                                                $enginerPP = tgl_indo($row->internal_engineering_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_engineering/preview' . ' class="badge bg-danger mt-1 p-2 w-xs" id="btn-approval" 
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-link_file = "' . $linkFile . '"
                                                                        data-step = "IFA"
                                                                        data-version = "' . $file_version . '"
                                                                    >
                                                                        &nbsp;REJECTED&nbsp;
                                                                    </a>
                                                                ';
                                                            } else if ($row->internal_engineering_status === 'progress') {
                                                                $enginerPP = tgl_indo($row->internal_engineering_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_engineering' . ' class="badge bg-info mt-1 p-2 w-xs" id="btn-approval" 
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
                                                                $enginerPP = '
                                                                no date yet
                                                                <br>
                                                                    no file yet
                                                                <br>
                                                                    <a href="javascript:waitingSwal();" class="badge bg-warning mt-1 p-2 w-xs" >
                                                                        &nbsp;WAITING&nbsp;
                                                                    </a>
                                                                ';
                                                            }
                                                        } else {
                                                            $enginerPP = '
                                                            no date yet
                                                            <br>
                                                                no file yet
                                                            <br>
                                                                <a href="javascript:noAccessSwal();" class="badge bg-secondary mt-1 p-2 w-xs"
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-path = "Project_detail_engineering/update/up_originator"
                                                                    data-step = ""
                                                                    data-version = "' . $file_version . '"
                                                                    data-doc_code = "' . $row->level_code . '"
                                                                    data-doc_name = "' . $row->description . '"
                                                                >
                                                                    &nbsp;NO ACCESS&nbsp;
                                                                </a>
                                                            ';
                                                        }

                                                        if ($row->has_access === '3' || sessActiveRole() == 'super_admin') {
                                                            if ($row->internal_ho_status === 'approve') {
                                                                $hoPP = tgl_indo($row->internal_ho_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_ho/preview/' . ' class="badge bg-success mt-1 p-2 w-xs" id="btn-approval" 
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-link_file = "' . $linkFile . '"
                                                                        data-step = "IFA"
                                                                        data-version = "' . $file_version . '"
                                                                    >
                                                                        &nbsp;APPROVED&nbsp;
                                                                    </a>
                                                                ';
                                                            } else if ($row->internal_ho_status === 'reject') {
                                                                $hoPP = tgl_indo($row->internal_ho_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_ho' . ' class="badge bg-danger mt-1 p-2 w-xs" id="btn-approval" 
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-link_file = "' . $linkFile . '"
                                                                        data-step = "IFA"
                                                                        data-version = "' . $file_version . '"
                                                                    >
                                                                        &nbsp;REJECTED&nbsp;
                                                                    </a>
                                                                ';
                                                            } else if ($row->internal_ho_status === 'progress') {
                                                                $hoPP = tgl_indo($row->internal_ho_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_ho' . ' class="badge bg-info mt-1 p-2 w-xs" id="btn-approval" 
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
                                                                $hoPP = '
                                                                    no date yet
                                                                <br>
                                                                    no file yet
                                                                <br>
                                                                    <a href="javascript:waitingSwal();" class="badge bg-warning mt-1 p-2 w-xs" >
                                                                        &nbsp;WAITING&nbsp;
                                                                    </a>
                                                                ';
                                                            }
                                                        } else {
                                                            $hoPP = '
                                                            no date yet
                                                            <br>
                                                                no file yet
                                                            <br>
                                                                <a href="javascript:noAccessSwal();" class="badge bg-secondary mt-1 p-2 w-xs"
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-path = "Project_detail_engineering/update/up_originator"
                                                                    data-step = ""
                                                                    data-version = "' . $file_version . '"
                                                                    data-doc_code = "' . $row->level_code . '"
                                                                    data-doc_name = "' . $row->description . '"
                                                                >
                                                                    &nbsp;NO ACCESS&nbsp;
                                                                </a>
                                                            ';
                                                        }

                                                        if ($row->has_access === '4' || sessActiveRole() == 'super_admin') {
                                                            if ($row->internal_pem_status === 'approve') {
                                                                $pemPP = tgl_indo($row->internal_pem_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_pem/preview' . ' class="badge bg-success mt-1 p-2 w-xs" id="btn-approval" 
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-link_file = "' . $linkFile . '"
                                                                        data-step = "IFA"
                                                                        data-version = "' . $file_version . '"
                                                                    >
                                                                        &nbsp;APPROVED&nbsp;
                                                                    </a>
                                                                ';
                                                            } else if ($row->internal_pem_status === 'reject') {
                                                                $pemPP = tgl_indo($row->internal_pem_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_pem/preview' . ' class="badge bg-danger mt-1 p-2 w-xs" id="btn-approval" 
                                                                        data-id="' . $row->id . '"
                                                                        data-doc_desc="' . $row->description . '"
                                                                        data-link_file = "' . $linkFile . '"
                                                                        data-step = "IFA"
                                                                        data-version = "' . $file_version . '"
                                                                    >
                                                                        &nbsp;REJECTED&nbsp;
                                                                    </a>
                                                                ';
                                                            } else if ($row->internal_pem_status === 'progress') {
                                                                $pemPP = tgl_indo($row->internal_pem_date) . '
                                                                <br>
                                                                <br>
                                                                    <a href=' . base_url('commentPdf/') . '/' . $row->id . '/internal_pem' . ' class="badge bg-info mt-1 p-2 w-xs" id="btn-approval" 
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
                                                                $pemPP = '
                                                                    no date yet
                                                                <br>
                                                                    no file yet
                                                                <br>
                                                                    <a href="javascript:waitingSwal();" class="badge bg-warning mt-1 p-2 w-xs" >
                                                                        &nbsp;WAITING&nbsp;
                                                                    </a>
                                                                ';
                                                            }
                                                        } else {
                                                            $pemPP = '
                                                            no date yet
                                                            <br>
                                                                no file yet
                                                            <br>
                                                                <a href="javascript:noAccessSwal();" class="badge bg-secondary mt-1 p-2 w-xs"
                                                                    data-id="' . $row->id . '"
                                                                    data-doc_desc="' . $row->description . '"
                                                                    data-path = "Project_detail_engineering/update/up_originator"
                                                                    data-step = ""
                                                                    data-version = "' . $file_version . '"
                                                                    data-doc_code = "' . $row->level_code . '"
                                                                    data-doc_name = "' . $row->description . '"
                                                                >
                                                                    &nbsp;NO ACCESS&nbsp;
                                                                </a>
                                                            ';
                                                        }
                                                        // end internal section

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
                                                                <a href="javascript:waitingSwal();" class="badge bg-warning mt-1 p-2 w-xs" >
                                                                    &nbsp;WAITING&nbsp;
                                                                </a>
                                                            ';
                                                        }

                                                        // set actual IFA status
                                                        $actual_ifa = generateStatusBadge(
                                                            $row->actual_ifa_status,
                                                            $row->actual_ifa,
                                                            $row->id,
                                                            $row->description,
                                                            $linkFile,
                                                            'IFA',
                                                            $row->ifa_version,
                                                            'external_ifa',
                                                            'IFA Version: ' . $row->ifa_version
                                                        );
                                                        $actual_AsBuild = generateStatusBadge(
                                                            $row->external_asbuild_status,
                                                            $row->external_asbuild_actual,
                                                            $row->id,
                                                            $row->description,
                                                            $linkFile,
                                                            'AsBuild',
                                                            $file_version,
                                                            'external_asbuild',
                                                            'version ' . $file_version
                                                        );

                                                        // set actual IFC status                                                       
                                                        $actual_ifc = generateStatusBadge(
                                                            $row->actual_ifc_status,
                                                            $row->actual_ifc,
                                                            $row->id,
                                                            $row->description,
                                                            $linkFile,
                                                            'IFC',
                                                            $row->ifc_version,
                                                            'external_ifc',
                                                            'IFC Version: ' . $row->ifc_version
                                                        );
                                                    ?>
                                                        <tr>
                                                            <td nowrap style="background-color: #d2e5f7;"><?= $no ?></td>
                                                            <td nowrap style="background-color: #d2e5f7;"><?= $row->wbs_code ?></td>
                                                            <td class="text-center" style="background-color: #d2e5f7;" nowrap> <?= $row->level_code ?> </td>
                                                            <td class="text-center" style="background-color: #d2e5f7;" nowrap> <?= $row->doc_dicipline ?> </td>
                                                            <td style="background-color: #d2e5f7;"><?= $row->description ?></td>
                                                            <td class="text-center" style="background-color: #d2e5f7;"><?= $row->man_hour_plan ?></td>
                                                            <td class="text-center" style="background-color: #d2e5f7;"><?= $row->man_hour_actual ?></td>
                                                            <td class="text-center" style="background-color:#faf1e3"><?= $actual_JEDHI ?></td>
                                                            <td class="text-center" style="background-color:#faf1e3"><?= $enginerPP ?></td>
                                                            <td class="text-center" style="background-color:#faf1e3"><?= $hoPP  ?></td>
                                                            <td class="text-center" style="background-color:#faf1e3"><?= $pemPP   ?></td>
                                                            <td class="text-center" style="background-color: #dff5c9;"><?= $row->weight_factor ?>%</td>
                                                            <!-- <td class="text-center" style="background-color: #e5f2e5;" nowrap><?= tgl_indo($row->plan_ifr) ?></td> -->
                                                            <td class="text-center" style="background-color: #e5f2e5;" nowrap><?= tgl_indo($row->plan_ifa) ?></td>
                                                            <td class="text-center" style="background-color: #e5f2e5;" nowrap><?= tgl_indo($row->plan_ifc) ?></td>
                                                            <td class="text-center" style="background-color: #e5f2e5;" nowrap><?= tgl_indo($row->external_asbuild_plan) ?></td>
                                                            <td class="text-center" style="background-color: #e5f2e5;"><?= $plan_cumulative ?>%</td>
                                                            <!-- <td class="text-center" style="background-color: #daf7e8;" nowrap><?= $actual_ifr ?></td> -->
                                                            <td class="text-center" style="background-color: #daf7e8;" nowrap><?= $actual_ifa ?></td>
                                                            <td class="text-center" style="background-color: #daf7e8;" nowrap><?= $actual_ifc ?></td>
                                                            <td class="text-center" style="background-color: #daf7e8;" nowrap><?= $actual_AsBuild ?></td>
                                                            <td class="text-center" style="background-color: #daf7e8;"><?= $actual_cumulative ?>%</td>
                                                            <td class="text-center" style="background-color: #d2e5f7;">
                                                                <a href="<?= base_url('document-timeline/' . $row->id) ?>">
                                                                    <?= $status ?>
                                                                </a>
                                                            </td>
                                                            <td class="text-center" nowrap style="background-color: #d2e5f7">
                                                                <a href="#" id="btn-edit-doc" data-bs-toggle="modal" data-bs-target="#modal-edit" data-id="<?= $row->id ?>" data-plan_man_hour="<?= $row->man_hour_plan ?>" data-level_code="<?= $row->level_code ?>" data-description="<?= $row->description ?>" data-weight_factor="<?= $row->weight_factor ?>" data-plan_ifr="<?= $row->plan_ifr ?>" data-external_asbuild_plan="<?= $row->external_asbuild_plan ?>" data-plan_ifa="<?= $row->plan_ifa ?>" data-plan_ifc="<?= $row->plan_ifc ?>" data-ifc_version="<?= $row->ifc_version ?>" data-ifa_version="<?= $row->ifa_version ?>">
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
                                        <?php } ?>
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

</div>
<!-- END layout-wrapper -->

<!-- JAVASCRIPT -->
<?= $this->include('partials/vendor-scripts') ?>
</body>

<!--Modal Add Document-->
<div id="modal-add-document" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Engineering Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Document Number</label>
                            <input type="text" class="form-control" name="level_code" id="level_code" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description" id="description" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="actual_man_hour" class="form-label">Discipline</label>
                            <select class="form-control" id="discipline">
                                <option value="">--Select--</option>
                                <?php foreach ($list_doc_dicipline as $row) : ?>
                                    <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Weight Factor</label>
                            <input type="number" class="form-control" name="weight_factor" id="weight_factor" />
                        </div>
                        <div class="col-md-6">
                            <label for="plan_man_hour" class="form-label">Plan Man Hour</label>
                            <input type="number" class="form-control" name="plan_man_hour" id="plan_man_hour" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="form-label">Plan</label>
                        <div class="col-md-4">
                            <label class="form-label">IFA</label>
                            <div class="input-group" id="ifa_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifa_date" data-provide="datepicker" name="plan_ifa" id="plan_ifa" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IFC /IFP</label>
                            <div class="input-group" id="ifc_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifc_date" data-provide="datepicker" name="plan_ifc" id="plan_ifc" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">ASBUILD</label>
                            <div class="input-group" id="asbuild_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#asbuild_date" data-provide="datepicker" name="plan_ifr" id="external_asbuild_plan" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-doc" title="Add Data">
                        Add
                    </button>
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Edit Engineering Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 1 Code</label>
                            <input type="text" class="form-control" name="level_code_edit" id="level_code_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <input type="text" class="form-control" name="description_edit" id="description_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label for="actual_man_hour" class="form-label">Discipline</label>
                            <select class="form-control" id="discipline_edit">
                                <option value="">--Select--</option>
                                <?php foreach ($list_doc_dicipline as $row) : ?>
                                    <option value="<?= $row->id ?>"><?= $row->name ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Weight Factor</label>
                            <input type="number" class="form-control" name="weight_factor_edit" id="weight_factor_edit" />
                        </div>
                        <div class="col-md-6">
                            <label for="plan_man_hour" class="form-label">Plan Man Hour</label>
                            <input type="number" class="form-control" name="plan_man_hour_edit" id="plan_man_hour_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="form-label">Plan</label>
                        <div class="col-md-4">
                            <label class="form-label">IFA</label>
                            <div class="input-group" id="ifa_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifa_date_edit" data-provide="datepicker" name="plan_ifa_edit" id="plan_ifa_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IFC/ IFP</label>
                            <div class="input-group" id="ifc_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifc_date_edit" data-provide="datepicker" name="plan_ifc_edit" id="plan_ifc_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">ASBUILD</label>
                            <div class="input-group" id="ifr_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#ifr_date_edit" data-provide="datepicker" name="plan_ifr_edit" id="external_asbuild_plan_edit" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_doc_edit" />
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-edit-doc" title="Edit Document" data-object="Project_detail_engineering/edit_document">Save</button>
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
                        <div class="col-md-4">
                            <label for="actual_man_hour" class="form-label">Actual Man Hour</label>
                            <input type="number" class="form-control" name="actual_man_hour" id="actual_man_hour" />
                        </div>
                        <div class="col-md-4">
                            <label for="actual_man_hour" class="form-label">IFA Version</label>
                            <input type="number" class="form-control" name="actual_man_hour" id="ifa_version" />
                        </div>
                        <div class="col-md-4 mb-3">
                            <label for="actual_man_hour" class="form-label">IFC Version</label>
                            <input type="number" class="form-control" name="actual_man_hour" id="ifc_version" />
                        </div>
                        <div>
                            <label for="upload_uploaded_file" id="upload_btn_choose_file" class="btn btn-info">Choose File</label>
                            <input name="upload_uploaded_file" id="upload_uploaded_file" type="file" multiple="multiple" style="display: none;" />
                            &nbsp;<span id="upload_file_name">No File Choosen</span>
                        </div>
                        <div class="col-md-4 mt-4">
                            <label class="form-label">Backdate</label>
                            <div class="input-group" id="backdate1">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" data-date-container="#backdate1" data-provide="datepicker" name="backdate" id="backdate" />
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
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

<!--Modal Approval Document-->
<div class="modal fade" id="modal_approval" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST" id="form-modal-approval" enctype="multipart/form-data">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">
                        Document Approval for <span id="approval_step_version"></span>
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Document Description</label>
                            <input type="text" class="form-control" name="approval_doc_desc" id="approval_doc_desc" readonly />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-6">
                            <label class="form-label">Submitted By</label>
                            <input type="text" class="form-control" name="approval_submitted_by" id="approval_submitted_by" readonly />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Submitted At</label>
                            <input type="text" class="form-control" name="approval_submitted_at" id="approval_submitted_at" readonly />
                        </div>
                        <div class="col-md-3">
                            <label class="form-label">Submitted File</label>
                            <div>
                                <a href="#" target="blank" id="approval_link_file" class="btn btn-info" style="width: 100%">
                                    &nbsp;Check File&nbsp;
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Comment</label>
                            <textarea id="approval_comment_text" name="approval_comment_text" class="form-control" maxlength="1000" rows="3" placeholder="type your comment"></textarea>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="approval_id_doc" />
                    <a type="button" class="btn btn-primary waves-effect" id="btn-approval-reject" data-step="#" data-version="#">
                        Detail Document
                    </a>
                    <!-- &nbsp;or&nbsp;
                        <button type="button" class="btn btn-success" id="btn-approval-approve"
                            data-path="#"
                            data-step="#"
                            data-version="#"
                        >
                            Approve
                        </button> -->
                </div>
            </div>
        </form>
    </div>
</div>

</html>

<script src="<?= base_url('assets/libs/jquery-knob/jquery.knob.min.js') ?>"></script>
<script src="<?= base_url('assets/js/pages/jquery-knob.init.js') ?>"></script>
<script>
    console.log(<?= json_encode($list_doc_engineering) ?>, 'LIST DOC');
    console.log(<?= json_encode(sess('active_karyawan_id')) ?>, 'SESSION DATA');
    // btn simpan document
    // ==========================================================================================================================================================================
    $(document).on('click', '#btn-simpan-doc', function() {
        const level_code = document.getElementById("level_code").value;
        const description = document.getElementById("description").value;
        const weight_factor = document.getElementById("weight_factor").value;
        const discipline = document.getElementById("discipline").value;
        const external_asbuild_plan = document.getElementById("external_asbuild_plan").value;
        const plan_ifa = document.getElementById("plan_ifa").value;
        const plan_ifc = document.getElementById("plan_ifc").value;
        const man_hour_plan = document.getElementById("plan_man_hour").value;
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
                    url: "<?= base_url('Project_detail_engineering/add/doc_engineering') ?>",
                    method: 'POST',
                    dataType: "JSON",
                    data: {
                        level_code: level_code,
                        description: description,
                        weight_factor: weight_factor,
                        discipline: discipline,
                        external_asbuild_plan: external_asbuild_plan,
                        plan_ifa: plan_ifa,
                        plan_ifc: plan_ifc,
                        man_hour_plan: man_hour_plan,

                    },
                    success: () => {
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
                    },
                    error: err => console.log(err),
                });
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
                    }
                });
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
        })
    })

    // update document detail
    // ==========================================================================================================================================================================    
    // get Edit document
    $(document).on('click', '#btn-edit-doc', function() {
        // get data from button edit
        const id_edit = $(this).data('id'),
            levelCode = $(this).data('level_code'),
            description = $(this).data('description'),
            weightFactor = $(this).data('weight_factor'),
            discipline = $(this).data('discipline'),
            external_asbuild_plan = $(this).data('external_asbuild_plan'),
            planIfa = $(this).data('plan_ifa'),
            plan_man_hour = $(this).data('plan_man_hour'),
            planIfc = $(this).data('plan_ifc');

        // Set data to Form Edit
        $('#id_doc_edit').val(id_edit);
        $('#level_code_edit').val(levelCode);
        $('#description_edit').val(description);
        $('#weight_factor_edit').val(weightFactor);
        $('#discipline_edit').val(discipline);
        $('#external_asbuild_plan_edit').val(external_asbuild_plan);
        $('#plan_ifa_edit').val(planIfa);
        $('#plan_ifc_edit').val(planIfc);
        $('#plan_man_hour_edit').val(plan_man_hour);

        // Call Modal Edit
        $('#modal-edit-document').modal('show');
    })

    $(document).on('click', '#btn-simpan-edit-doc', function() {
        const objek = $(this).data('object'),
            link = `<?= base_url() ?>/${objek}`
        levelCodeEdit = document.getElementById("level_code_edit").value,
            descriptionEdit = document.getElementById("description_edit").value,
            weightFactorEdit = document.getElementById("weight_factor_edit").value,
            disciplineEdit = document.getElementById("discipline_edit").value,
            external_asbuild_plan_edit = document.getElementById("external_asbuild_plan_edit").value;
        planIfaEdit = document.getElementById("plan_ifa_edit").value;
        planIfcEdit = document.getElementById("plan_ifc_edit").value;
        id_edit = document.getElementById("id_doc_edit").value;
        manHourPlanEdit = document.getElementById("plan_man_hour_edit").value;

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
                    url: link,
                    method: 'POST',
                    dataType: "JSON",
                    data: {
                        level_code: levelCodeEdit,
                        description: descriptionEdit,
                        weight_factor: weightFactorEdit,
                        discipline: disciplineEdit,
                        external_asbuild_plan: external_asbuild_plan_edit,
                        plan_ifa: planIfaEdit,
                        plan_ifc: planIfcEdit,
                        id_edit: id_edit,
                        man_hour_plan: manHourPlanEdit,
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
                    },
                    error: (err) => {
                        console.log(err);
                    }
                });
            }
        })
    })



    // upload file
    // ==========================================================================================================================================================================    
    $(document).on('click', '#btn-upload-file', function() {
        // Set data from button to Form Approval
        $('.upload_step').text($(this).data('step'));
        $('#upload_doc_desc').val($(this).data('doc_desc'));
        $('#upload_id_doc').val($(this).data('id'));
        $("#upload_btn_up").data("path", $(this).data('path'));
        $("#upload_btn_up").data("step", $(this).data('step'));
        $("#upload_btn_up").data("actual_man_hour", $(this).data('actual_man_hour'));
        $("#upload_btn_up").data("ifa_version", $(this).data('ifa_version'));
        $("#upload_btn_up").data("ifc_version", $(this).data('ifc_version'));
        $("#upload_btn_up").data("version", $(this).data('version'));
        $("#upload_btn_up").data("doc_name", $(this).data('doc_name'));
        $("#upload_btn_up").data("doc_code", $(this).data('doc_code'));
        $('#upload_file_name').text("No File Choosen");

        // Call Modal Approval
        $('#modal-upload-file').modal('show');
    })

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

    // save file
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
        formData.append('version', version);
        formData.append('id_doc', id_doc);
        formData.append('backdate', $('#backdate').val());
        formData.append('doc_name', $(this).data('doc_name'));
        formData.append('doc_code', $(this).data('doc_code'));
        formData.append('man_hour_actual', $('#actual_man_hour').val());
        formData.append('ifa_version', $('#ifa_version').val());
        formData.append('ifc_version', $('#ifc_version').val());

        swalTitle = 'Upload File ' + fileDesc;

        Swal.fire({
            title: swalTitle,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: "<?= base_url('Project_detail_engineering/up_originator') ?>",
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

    // $(document).on('click', '#upload_btn_up', function () {
    //     const path = $(this).data('path');
    //     const fileDesc = $(this).data('step');
    //     const version = $(this).data('version');
    //     let id_doc, swalTitle;
    //     var timerInterval, i, file;
    //     var formData = new FormData();

    //     id_doc = document.getElementById("upload_id_doc").value;
    //     i = $('#upload_uploaded_file'),
    //         file = i[0].files[0];
    //     formData.append('file', file);
    //     formData.append('version', version);
    //     formData.append('id_doc', id_doc);
    //     formData.append('doc_name', $(this).data('doc_name'));
    //     formData.append('doc_code', $(this).data('doc_code'));

    //     swalTitle = 'Upload File ' + fileDesc;

    //     Swal.fire({
    //         title: swalTitle,
    //         icon: 'info',
    //         showCancelButton: true,
    //         confirmButtonText: 'Ya',
    //         cancelButtonText: 'Batal'
    //     }).then(function (result) {
    //         if (result.value) {
    //             $.ajax({
    //                 url: "<?= base_url('Project_detail_engineering/up_originator') ?>",
    //                 method: 'POST',
    //                 data: formData,
    //                 contentType: false,
    //                 cache: false,
    //                 processData: false,
    //                 success: function (response) {
    //                     if (response.success) {
    //                         Swal.fire({
    //                             title: 'Diupload!',
    //                             icon: 'success',
    //                             text: 'File Berhasil Diupload.',
    //                             timer: 2000,
    //                             confirmButtonColor: "#5664d2",
    //                             onBeforeOpen: function () {
    //                                 timerInterval = setInterval(function () {
    //                                     Swal.getContent().querySelector('strong')
    //                                         .textContent = Swal.getTimerLeft()
    //                                 }, 100)
    //                             },
    //                             onClose: function () {
    //                                 location.reload()
    //                             }
    //                         })
    //                     } else {
    //                         Swal.fire({
    //                             title: 'Error!',
    //                             icon: 'error',
    //                             text: 'Gagal mengupload file.',
    //                             confirmButtonColor: "#5664d2",
    //                         })
    //                     }
    //                 },
    //                 error: function () {
    //                     Swal.fire({
    //                         title: 'Error!',
    //                         icon: 'error',
    //                         text: 'Gagal mengupload file.',
    //                         confirmButtonColor: "#5664d2",
    //                     })
    //                 }
    //             });
    //         }
    //     })
    // });




    // approval
    // ==========================================================================================================================================================================
    // $(document).on('click', '#btn-approval', function(){
    //     // Set data from button to Form Approval
    //     $('#approval_doc_desc').val( $(this).data('doc_desc') );
    //     $('#approval_id_doc').val( $(this).data('id') );
    //     $("#approval_link_file").attr("href", $(this).data('link_file'));
    //     $('#approval_step_version').text($(this).data('step')+" Version "+$(this).data('version'));
    //     $('#approval_file_name').text("No File Choosen");

    //     // btn approve set
    //     $("#btn-approval-approve").data("step", $(this).data('step'));
    //     $("#btn-approval-approve").data("version", $(this).data('version'));

    //     // btn reject set
    //     const id_doc = document.getElementById("approval_id_doc").value;
    //     const link = "<?= base_url('commentPdf/') ?>"
    //     $("#btn-approval-reject")
    //         .data("step", $(this).data('step'))
    //         .data("version", $(this).data('version'))
    //         .attr("href", `${link}/${id_doc}`);

    //     // Call Modal Approval
    //     $('#modal_approval').modal('show');
    // })

    $(document).ready(function() {
        $('#approval_btn_comment_file').click(function(e) {
            e.preventDefault(); // Prevent default behavior
            $('#approval_comment_file').trigger('click');
        });

        $('#approval_comment_file').change(function() {
            var fileInput = $(this);
            var fileName = fileInput.val().split('\\').pop();
            $('#approval_file_name').text("File Choosen: " + fileName);
        });
    });

    // approve
    $(document).on('click', '#btn-approval-approve', function() {
        const path = "Project_detail_engineering/update/approval";
        const fileDesc = $(this).data('step');
        const version = $(this).data('version');
        let id_doc, swalTitle;
        var timerInterval;
        var formData = new FormData();

        id_doc = document.getElementById("approval_id_doc").value;
        if (fileDesc == "IFA") {
            formData.append('file_status', 'ifa_approved');
        } else if (fileDesc == "IFC") {
            formData.append('file_status', 'ifc_approved');
        }
        swalTitle = 'Approve ' + fileDesc + ' Version ' + version + ' ?';

        Swal.fire({
            title: swalTitle,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url: path + '/' + id_doc,
                    method: 'POST',
                    data: formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                });
                Swal.fire({
                    title: 'Approved!',
                    icon: 'success',
                    text: 'This Version is Approved.',
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

    // reject
    $(document).on('click', '#btn-approval-reject', function() {
        const path = "Project_detail_engineering/update/approval";
        const fileDesc = $(this).data('step');
        const version = $(this).data('version');
        let id_doc, swalTitle;
        var timerInterval;
        var formData = new FormData();

        id_doc = document.getElementById("approval_id_doc").value;
        formData.append('version', version);
        formData.append('file_status', 'ifa_rejected');
        swalTitle = 'Reject ' + fileDesc + ' Version ' + version + ' ?';

        // Swal.fire({
        //     title: swalTitle,
        //     icon: 'info',
        //     showCancelButton: true,
        //     confirmButtonText: 'Ya',
        //     cancelButtonText: 'Batal'
        // }).then(function(result) {
        //     if (result.value) {
        //         $.ajax({
        //             url:  path+'/'+id_doc,
        //             method: 'POST',
        //             data:formData,
        //             contentType: false,
        //             cache: false,
        //             processData: false,
        //         });
        //         Swal.fire({
        //             title: 'Approved!',
        //             icon: 'success',
        //             text: 'This Version is Approved.',
        //             timer: 1000,
        //             confirmButtonColor: "#5664d2",
        //             onBeforeOpen:function () {
        //                 //Swal.showLoading()
        //                 timerInterval = setInterval(function() {
        //                 Swal.getContent().querySelector('strong')
        //                     .textContent = Swal.getTimerLeft()
        //                 }, 100)
        //             },
        //             onClose: function () {
        //                 location.reload()
        //             }
        //         })
        //     }
        // })
    })

    // waiting btn clicked swal
    function waitingSwal() {
        Swal.fire({
            title: 'Nothing You Can Do Here!',
            icon: 'warning',
            text: 'The progress is not here yet',
            timer: 5000,
            confirmButtonColor: "#5664d2",
        })
    }
    function noAccessSwal() {
        Swal.fire({
            title: 'Nothing You Can Do Here!',
            icon: 'warning',
            text: 'you have no access to this step!',
            timer: 5000,
            confirmButtonColor: "#5664d2",
        })
    }
</script>
<script src="<?= base_url('assets/libs/dropzone/min/dropzone.min.js') ?>"></script>
