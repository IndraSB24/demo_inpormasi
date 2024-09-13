<?= $this->include('partials/main') ?>

    <head>
        <?= $title_meta ?>
        <link href="assets/libs/dropzone/min/dropzone.min.css" rel="stylesheet" type="text/css" />
        <?= $this->include('partials/head-css') ?>
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
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="card-title mb-1">Overall Progress</h4>
                                        <!--chart-->
                                        <div id="scurve_mdr" class="apex-charts" ></div>
                                        <!--analysis card-->
                                        <div class="card bg-info text-white mt-1">
                                            <div class="card-body">
                                                <h4 class="card-title mb-1 text-white">Analysis</h4>
                                                Isinya analisis
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 mb-3">
                                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target="#modal-add-document">
                                    Add Document
                                </button>
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
                                                    <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" 
                                                        data-date-container="#datepicker1" data-provide="datepicker" name="cut_off_filter" id="cut_off_filter"/>
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
                                                    $weekPlan = [ 0, 0, 0, 0, 0, 0, 0, 0];
                                                    $weekActual = [ 0, 0, 0, 0, 0, 0, 0, 0];
                                                
                                                    foreach($list_doc_engineering as $row) :
                                                        // scurve data
                                                        if(world_date($row->plan_ifr) <= world_date('8-6-2023')){
                                                            $weekPlan[0] += 0.6*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifr) <= world_date('16-6-2023')){
                                                            $weekPlan[1] += 0.6*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifr) <= world_date('24-6-2023')){
                                                            $weekPlan[2] += 0.6*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifr) <= world_date('1-7-2023')){
                                                            $weekPlan[3] += 0.6*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifr) <= world_date('9-7-2023')){
                                                            $weekPlan[4] += 0.6*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifr) <= world_date('17-7-2023')){
                                                            $weekPlan[5] += 0.6*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifr) <= world_date('25-7-2023')){
                                                            $weekPlan[6] += 0.6*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifr) <= world_date('3-8-2023')){
                                                            $weekPlan[7] += 0.6*$row->weight_factor;
                                                        }
                                                        
                                                        if(world_date($row->plan_ifa) <= world_date('8-6-2023')){
                                                            $weekPlan[0] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifa) <= world_date('16-6-2023')){
                                                            $weekPlan[1] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifa) <= world_date('24-6-2023')){
                                                            $weekPlan[2] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifa) <= world_date('1-7-2023')){
                                                            $weekPlan[3] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifa) <= world_date('9-7-2023')){
                                                            $weekPlan[4] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifa) <= world_date('17-7-2023')){
                                                            $weekPlan[5] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifa) <= world_date('25-7-2023')){
                                                            $weekPlan[6] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifa) <= world_date('3-8-2023')){
                                                            $weekPlan[7] += 0.2*$row->weight_factor;
                                                        }
                                                        
                                                        if(world_date($row->plan_ifc) <= world_date('8-6-2023')){
                                                            $weekPlan[0] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifc) <= world_date('16-6-2023')){
                                                            $weekPlan[1] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifc) <= world_date('24-6-2023')){
                                                            $weekPlan[2] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifc) <= world_date('1-6-2023')){
                                                            $weekPlan[3] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifc) <= world_date('9-7-2023')){
                                                            $weekPlan[4] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifc) <= world_date('17-7-2023')){
                                                            $weekPlan[5] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifc) <= world_date('25-7-2023')){
                                                            $weekPlan[6] += 0.2*$row->weight_factor;
                                                        }else if(world_date($row->plan_ifc) <= world_date('3-8-2023')){
                                                            $weekPlan[7] += 0.2*$row->weight_factor;
                                                        }
                                                        
                                                        // set plan cumulative
                                                        $plan_cumulative = 0;
                                                        if(world_date($row->plan_ifr) <= date_now()){
                                                            $plan_cumulative += 0.6*$row->weight_factor;
                                                        }
                                                        if(world_date($row->plan_ifa) <= date_now()){
                                                            $plan_cumulative += 0.2*$row->weight_factor;
                                                        }
                                                        if(world_date($row->plan_ifc) <= date_now()){
                                                            $plan_cumulative += 0.2*$row->weight_factor;
                                                        }
                                                        
                                                        // set actual cumulative
                                                        $actual_cumulative = 0;
                                                        if($row->actual_ifr){
                                                            $actual_cumulative += 0.6*$row->weight_factor;
                                                            if(world_date($row->actual_ifr) <= world_date('8-6-2023')){
                                                                $weekActual[0] += 0.6*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifr) <= world_date('16-6-2023')){
                                                                $weekActual[1] += 0.6*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifr) <= world_date('24-6-2023')){
                                                                $weekActual[2] += 0.6*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifr) <= world_date('1-7-2023')){
                                                                $weekActual[3] += 0.6*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifr) <= world_date('9-7-2023')){
                                                                $weekActual[4] += 0.6*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifr) <= world_date('17-7-2023')){
                                                                $weekActual[5] += 0.6*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifr) <= world_date('25-7-2023')){
                                                                $weekActual[6] += 0.6*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifr) <= world_date('3-8-2023')){
                                                                $weekActual[7] += 0.6*$row->weight_factor;
                                                            }
                                                        }
                                                        if($row->actual_ifa){
                                                            $actual_cumulative += 0.2*$row->weight_factor;
                                                            if(world_date($row->actual_ifa) <= world_date('8-6-2023')){
                                                                $weekActual[0] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifa) <= world_date('16-6-2023')){
                                                                $weekActual[1] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifa) <= world_date('24-6-2023')){
                                                                $weekActual[2] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifa) <= world_date('1-7-2023')){
                                                                $weekActual[3] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifa) <= world_date('9-7-2023')){
                                                                $weekActual[4] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifa) <= world_date('17-7-2023')){
                                                                $weekActual[5] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifa) <= world_date('25-7-2023')){
                                                                $weekActual[6] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifa) <= world_date('3-8-2023')){
                                                                $weekActual[7] += 0.2*$row->weight_factor;
                                                            }
                                                        }
                                                        if($row->actual_ifc){
                                                            $actual_cumulative += 0.2*$row->weight_factor;
                                                            if(world_date($row->actual_ifc) <= world_date('8-6-2023')){
                                                                $weekActual[0] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifc) <= world_date('16-6-2023')){
                                                                $weekActual[1] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifc) <= world_date('24-6-2023')){
                                                                $weekActual[2] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifc) <= world_date('1-7-2023')){
                                                                $weekActual[3] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifc) <= world_date('9-7-2023')){
                                                                $weekActual[4] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifc) <= world_date('17-7-2023')){
                                                                $weekActual[5] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifc) <= world_date('25-7-2023')){
                                                                $weekActual[6] += 0.2*$row->weight_factor;
                                                            }else if(world_date($row->actual_ifc) <= world_date('3-8-2023')){
                                                                $weekActual[7] += 0.2*$row->weight_factor;
                                                            }
                                                        }
                                                        
                                                        // set variance status
                                                        if($actual_cumulative == $plan_cumulative){
                                                            $status = '<span class="badge bg-success p-2 w-xs">ON TRACK</span>';
                                                        }else if($actual_cumulative > $plan_cumulative){
                                                            $status = '<span class="badge bg-info p-2 w-xs">AHEAD</span>';
                                                        }else{
                                                            $status = '<span class="badge bg-danger p-2 w-xs">LATE</span>';
                                                        }
                                                        
                                                        // set actual IFR status
                                                        $file_version = $row->file_version ? $row->file_version : 'nothing';
                                                        if($row->file_status == "ifr_upload"){
                                                            $linkFile = base_url('upload/doc_engineering/'.$row->file);
                                                            $actual_ifr = tgl_indo($row->actual_ifr).
                                                            '
                                                            <br>
                                                                Uploaded V '.$row->file_version.'
                                                            <br>
                                                                <a href="#" class="badge bg-info mt-1 p-2 w-xs" id="btn-approval" 
                                                                    data-id="'.$row->id.'"
                                                                    data-doc_desc="'.$row->description.'"
                                                                    data-link_file = "'.$linkFile.'"
                                                                    data-step = "IFR"
                                                                    data-version = "'.$file_version.'"
                                                                >
                                                                    &nbsp;DETAIL&nbsp;
                                                                </a>
                                                            ';
                                                        }else if(!$row->file_status){
                                                            $actual_ifr = '
                                                                no date yet
                                                            <br>
                                                                no file yet
                                                            <br>
                                                                <a href="#" class="badge bg-warning mt-1 p-2 w-xs" id="btn-upload-file" 
                                                                    data-id="'.$row->id.'"
                                                                    data-doc_desc="'.$row->description.'"
                                                                    data-path = "Project_detail_engineering/update/upload_file"
                                                                    data-step = "IFR"
                                                                    data-version = "'.$file_version.'"
                                                                >
                                                                    &nbsp;UP FILE&nbsp;
                                                                </a>
                                                            ';
                                                        }
                                                        
                                                        // set actual IFA status
                                                        if($row->actual_ifa_file){
                                                            $linkFile = base_url('upload/doc_engineering/'.$row->actual_ifa_file);
                                                            $actual_ifa = tgl_indo($row->actual_ifa).
                                                            '
                                                            <br>
                                                                Uploaded V '.$row->actual_ifa_version.'
                                                            <br>
                                                                <a href="#" class="badge bg-info mt-1 p-2 w-xs" id="btn-approval" 
                                                                    data-id="'.$row->id.'"
                                                                    data-doc_desc="'.$row->description.'"
                                                                    data-link_file = "'.$linkFile.'"
                                                                    data-step = "IFA"
                                                                    data-version = "'.$row->actual_ifa_version.'"
                                                                >
                                                                    &nbsp;DETAIL&nbsp;
                                                                </a>
                                                            ';
                                                        }else{
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
                                                        if($row->actual_ifc_file){
                                                            $linkFile = base_url('upload/doc_engineering/'.$row->actual_ifc_file);
                                                            $actual_ifc = tgl_indo($row->actual_ifc).
                                                            '
                                                            <br>
                                                                Uploaded V '.$row->actual_ifc_version.'
                                                            <br>
                                                                <a href="#" class="badge bg-info mt-1 p-2 w-xs" id="btn-approval" 
                                                                    data-id="'.$row->id.'"
                                                                    data-doc_desc="'.$row->description.'"
                                                                    data-link_file = "'.$linkFile.'"
                                                                    data-step = "IFC"
                                                                    data-version = "'.$row->actual_ifc_version.'"
                                                                >
                                                                    &nbsp;DETAIL&nbsp;
                                                                </a>
                                                            ';
                                                        }else{
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
                                                            <a href="document-timeline/<?= $row->id ?>" >
                                                                <?= $status ?>
                                                            </a>
                                                        </td>
                                                        <td class="text-center" nowrap>
                                                            <a href="#" id="btn-edit-doc" data-bs-toggle="modal" data-bs-target="#modal-edit"
                                                                data-id="<?= $row->id ?>"
                                                                data-level_code="<?= $row->level_code ?>"
                                                                data-description="<?= $row->description ?>"
                                                                data-weight_factor="<?= $row->weight_factor ?>"
                                                                data-plan_ifr="<?= tgl_indo($row->plan_ifr) ?>"
                                                                data-plan_ifa="<?= tgl_indo($row->plan_ifa) ?>"
                                                                data-plan_ifc="<?= tgl_indo($row->plan_ifc) ?>"
                                                            >
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
                                                    for($i_cum_plan=1; $i_cum_plan<8; $i_cum_plan++){
                                                        $weekPlan[$i_cum_plan] += $weekPlan[$i_cum_plan-1];
                                                    }
                                                    for($i_cum_act=1; $i_cum_act<8; $i_cum_act++){
                                                        $weekActual[$i_cum_act] += $weekActual[$i_cum_act-1];
                                                    }
                                                    for($week_counter=0; $week_counter<8; $week_counter++){
                                                        echo '
                                                            <input type="hidden" id="week_plan_'.$week_counter.'" value="'.$weekPlan[$week_counter].'" />
                                                            <input type="hidden" id="week_actual_'.$week_counter.'" value="'.$weekActual[$week_counter].'" />
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
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Engineering Document</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-4">
                        <div class="col-md-12">
                            <label class="form-label">Level 1 Code</label>
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
                            <label class="form-label">Weight Factor</label>
                            <input type="number" class="form-control" name="weight_factor" id="weight_factor" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="form-label">Plan</label>
                        <div class="col-md-4">
                            <label class="form-label">IFR</label>
                            <div class="input-group" id="ifr_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" 
                                    data-date-container="#ifr_date" data-provide="datepicker" name="plan_ifr" id="plan_ifr"/>
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IFA</label>
                            <div class="input-group" id="ifa_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" 
                                    data-date-container="#ifa_date" data-provide="datepicker" name="plan_ifa" id="plan_ifa"/>
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IFC</label>
                            <div class="input-group" id="ifc_date">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" 
                                    data-date-container="#ifc_date" data-provide="datepicker" name="plan_ifc" id="plan_ifc"/>
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
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
                            <label class="form-label">Weight Factor</label>
                            <input type="number" class="form-control" name="weight_factor_edit" id="weight_factor_edit" />
                        </div>
                    </div>
                    <div class="row mb-4">
                        <label class="form-label">Plan</label>
                        <div class="col-md-4">
                            <label class="form-label">IFR</label>
                            <div class="input-group" id="ifr_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" 
                                    data-date-container="#ifr_date_edit" data-provide="datepicker" name="plan_ifr_edit" id="plan_ifr_edit"/>
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IFA</label>
                            <div class="input-group" id="ifa_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" 
                                    data-date-container="#ifa_date_edit" data-provide="datepicker" name="plan_ifa_edit" id="plan_ifa_edit"/>
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <label class="form-label">IFC</label>
                            <div class="input-group" id="ifc_date_edit">
                                <input type="text" class="form-control" placeholder="dd-mm-yyyy" data-date-format="dd-mm-yyyy" 
                                    data-date-container="#ifc_date_edit" data-provide="datepicker" name="plan_ifc_edit" id="plan_ifc_edit"/>
                                <span class="input-group-text"><i class="mdi mdi-calendar"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="id_doc_edit" />
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success" id="btn-simpan-edit-doc" title="Edit Document" data-object="Project_detail_engineering/update/document_detail">Save</button>
                </div>
            </div>
            </form>
        </div>
    </div>
    
    <!--Modal Upload All File-->
    <div class="modal fade" id="modal-upload-file" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                            <label class="form-label">Choose <span class="upload_step"></span> File</label>
                            <div>
                                <label for="upload_uploaded_file" id="upload_btn_choose_file" class="btn btn-info">Choose File</label>
                                <input name="upload_uploaded_file" id="upload_uploaded_file" type="file" multiple="multiple" style="display: none;" />
                                &nbsp;<span id="upload_file_name">No File Choosen</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="upload_id_doc" />
                        <button type="button" class="btn btn-success" id="upload_btn_up"
                            data-path="#"
                            data-step="#"
                            data-version="#"
                        >
                            Upload
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    <!--Modal Approval Document-->
    <div class="modal fade" id="modal-approval" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
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
                        <div class="row mb-4">
                            <label class="form-label">Upload Commented File (Optional)</label>
                            <div>
                                <label for="approval_comment_file" id="approval_btn_comment_file" class="btn btn-info">Choose File</label>
                                <input name="approval_comment_file" id="approval_comment_file" type="file" multiple="multiple" style="display: none;" />
                                &nbsp;<span id="approval_file_name">No File Choosen</span>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <input type="hidden" id="approval_id_doc" />
                        <button type="button" class="btn btn-danger waves-effect" id="btn-approval-reject"> Reject with Comment </button>
                        &nbsp;or&nbsp;
                        <button type="button" class="btn btn-success" id="btn-approval-approve"
                            data-path="#"
                            data-step="#"
                            data-version="#"
                        >
                            Approve
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</html>

<script>
// btn simpan document
// ==========================================================================================================================================================================
    $(document).on('click','#btn-simpan-doc',function(){
        const objek = $(this).data('object')
        const level_code    = document.getElementById("level_code").value;
        const description   = document.getElementById("description").value;
        const weight_factor = document.getElementById("weight_factor").value;
        const plan_ifr      = document.getElementById("plan_ifr").value;
        const plan_ifa      = document.getElementById("plan_ifa").value;
        const plan_ifc      = document.getElementById("plan_ifc").value;
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
                    url:  objek,
                    method: 'POST',
                    dataType: "JSON",
                    data : {
                        level_code  : level_code,
                        description : description,
                        weight_factor   : weight_factor,
                        plan_ifr    : plan_ifr,
                        plan_ifa    : plan_ifa,
                        plan_ifc    : plan_ifc
                    }
                });
                Swal.fire({
                    title: 'Disimpan!',
                    icon: 'success',
                    text: 'Data berhasil disimpan.',
                    timer: 1000,
                    confirmButtonColor: "#5664d2",
                    onBeforeOpen:function () {
                        //Swal.showLoading()
                        timerInterval = setInterval(function() {
                        Swal.getContent().querySelector('strong')
                            .textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: function () {
                        location.reload()
                    }
                })
            }
        })
    })

// btn delete document
// ==========================================================================================================================================================================
    $(document).on('click','#btn-hapus-doc',function(){
        const id    = $(this).data('id')
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
                    url:  objek+'/'+id,
                    method: 'POST',
                    dataType: "JSON",
                    data : {
                        id_project : id
                    }
                });
                Swal.fire({
                    title: 'Dihapus!',
                    icon: 'success',
                    text: 'Document berhasil dihapus.',
                    timer: 1000,
                    confirmButtonColor: "#5664d2",
                    onBeforeOpen:function () {
                        //Swal.showLoading()
                        timerInterval = setInterval(function() {
                        Swal.getContent().querySelector('strong')
                            .textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: function () {
                        location.reload()
                    }
                })
            }
        })
    })

// update document detail
// ==========================================================================================================================================================================    
    // get Edit document
    $(document).on('click', '#btn-edit-doc', function(){
        // get data from button edit
        const   id_edit = $(this).data('id'),
                levelCode = $(this).data('level_code'),
                description = $(this).data('description'),
                weightFactor = $(this).data('weight_factor'),
                planIfr = $(this).data('plan_ifr'),
                planIfa = $(this).data('plan_ifa'),
                planIfc = $(this).data('plan_ifc');
        
        // Set data to Form Edit
        $('#id_doc_edit').val(id_edit);
        $('#level_code_edit').val(levelCode);
        $('#description_edit').val(description);
        $('#weight_factor_edit').val(weightFactor);
        $('#plan_ifr_edit').val(planIfr);
        $('#plan_ifa_edit').val(planIfa);
        $('#plan_ifc_edit').val(planIfc);
        
        // Call Modal Edit
        $('#modal-edit-document').modal('show');
    })
    
    $(document).on('click','#btn-simpan-edit-doc',function(){
        const   objek = $(this).data('object'),
                id = document.getElementById("id_doc_edit").value,
                levelCodeEdit = document.getElementById("level_code_edit").value,
                descriptionEdit = document.getElementById("description_edit").value,
                weightFactorEdit = document.getElementById("weight_factor_edit").value,
                planIfrEdit = document.getElementById("plan_ifr_edit").value;
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
                    url:  objek+'/'+id,
                    method: 'POST',
                    dataType: "JSON",
                    data : {
                        level_code_edit     : levelCodeEdit,
                        description_edit    : descriptionEdit,
                        weight_factor_edit  : weightFactorEdit,
                        plan_ifr_edit       : planIfrEdit,
                        plan_ifa_edit       : planIfaEdit,
                        plan_ifc_edit       : planIfcEdit
                    }
                });
                Swal.fire({
                    title: 'Diedit!',
                    icon: 'success',
                    text: 'Document Berhasil Diedit.',
                    timer: 1000,
                    confirmButtonColor: "#5664d2",
                    onBeforeOpen:function () {
                        //Swal.showLoading()
                        timerInterval = setInterval(function() {
                        Swal.getContent().querySelector('strong')
                            .textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: function () {
                        location.reload()
                    }
                })
            }
        })
    })



// upload file
// ==========================================================================================================================================================================    
    $(document).on('click', '#btn-upload-file', function(){
        // Set data from button to Form Approval
        $('.upload_step').text($(this).data('step'));
        $('#upload_doc_desc').val( $(this).data('doc_desc') );
        $('#upload_id_doc').val( $(this).data('id') );
        $("#upload_btn_up").data("path", $(this).data('path'));
        $("#upload_btn_up").data("step", $(this).data('step'));
        $("#upload_btn_up").data("version", $(this).data('version'));
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
        $('#upload_file_name').text("File Choosen: "+fileName);
      });
    });
    
    // save file
    $(document).on('click','#upload_btn_up',function(){
        const   path    = $(this).data('path');
        const   fileDesc= $(this).data('step');
        const   version = $(this).data('version');
        let id_doc, swalTitle;
        var timerInterval, i, file;
        var formData = new FormData();
        
        id_doc = document.getElementById("upload_id_doc").value;
        i       = $('#upload_uploaded_file'),
        file    = i[0].files[0];
        formData.append('file',file);
        formData.append('version',version);
        swalTitle = 'Upload File '+fileDesc;
        
        Swal.fire({
            title: swalTitle,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url:  path+'/'+id_doc,
                    method: 'POST',
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                });
                Swal.fire({
                    title: 'Diupload!',
                    icon: 'success',
                    text: 'File Berhasil Diupload.',
                    timer: 1000,
                    confirmButtonColor: "#5664d2",
                    onBeforeOpen:function () {
                        //Swal.showLoading()
                        timerInterval = setInterval(function() {
                        Swal.getContent().querySelector('strong')
                            .textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: function () {
                        location.reload()
                    }
                })
            }
        })
    })
    
    
    
// approval
// ==========================================================================================================================================================================
    $(document).on('click', '#btn-approval', function(){
        // Set data from button to Form Approval
        $('#approval_doc_desc').val( $(this).data('doc_desc') );
        $('#approval_id_doc').val( $(this).data('id') );
        $("#approval_link_file").attr("href", $(this).data('link_file'));
        $('#approval_step_version').text($(this).data('step')+" Version "+$(this).data('version'));
        $('#approval_file_name').text("No File Choosen");

        // Call Modal Approval
        $('#modal-approval').modal('show');
    })
    
    $(document).ready(function() {
      $('#approval_btn_comment_file').click(function(e) {
        e.preventDefault(); // Prevent default behavior
        $('#approval_comment_file').trigger('click');
      });
    
      $('#approval_comment_file').change(function() {
        var fileInput = $(this);
        var fileName = fileInput.val().split('\\').pop();
        $('#approval_file_name').text("File Choosen: "+fileName);
      });
    });
    
    // approve
    $(document).on('click','#btn-approval-approve',function(){
        const   path    = "Project_detail_engineering/update/approval";
        const   fileDesc= $(this).data('step');
        const   version = $(this).data('version');
        let id_doc, swalTitle;
        var timerInterval, i, file;
        var formData = new FormData();
        
        id_doc = document.getElementById("approval_id_doc").value;
        i       = $('#approval_comment_file'),
        file    = i[0].files[0];
        formData.append('file',file);
        formData.append('version',version);
        swalTitle = 'Upload Commented File '+fileDesc;
        
        Swal.fire({
            title: swalTitle,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Ya',
            cancelButtonText: 'Batal'
        }).then(function(result) {
            if (result.value) {
                $.ajax({
                    url:  path+'/'+id_doc,
                    method: 'POST',
                    data:formData,
                    contentType: false,
                    cache: false,
                    processData: false,
                });
                Swal.fire({
                    title: 'Diupload!',
                    icon: 'success',
                    text: 'File Berhasil Diupload.',
                    timer: 1000,
                    confirmButtonColor: "#5664d2",
                    onBeforeOpen:function () {
                        //Swal.showLoading()
                        timerInterval = setInterval(function() {
                        Swal.getContent().querySelector('strong')
                            .textContent = Swal.getTimerLeft()
                        }, 100)
                    },
                    onClose: function () {
                        location.reload()
                    }
                })
            }
        })
    })



// chart
// ==========================================================================================================================================================================    
    //  Scurve mdr
    let weekList=[],
        dataPlan=[],
        dataActual=[],
        cek = document.getElementById("week_plan_0").value;
    
    weeklist = [1, 2, 3, 4, 5, 6, 7, 8];
    
    dataPlan = [
        document.getElementById("week_plan_0").value,
        document.getElementById("week_plan_1").value,
        document.getElementById("week_plan_2").value,
        document.getElementById("week_plan_3").value,
        document.getElementById("week_plan_4").value,
        document.getElementById("week_plan_5").value,
        document.getElementById("week_plan_6").value,
        document.getElementById("week_plan_7").value
    ];
    
    dataActual.push(document.getElementById("week_actual_0").value);
    if(document.getElementById("week_actual_1").value != document.getElementById("week_actual_0").value){
        dataActual.push(document.getElementById("week_actual_1").value);
    }
    if(document.getElementById("week_actual_2").value != document.getElementById("week_actual_1").value){
        dataActual.push(document.getElementById("week_actual_2").value);
    }
    if(document.getElementById("week_actual_3").value != document.getElementById("week_actual_2").value){
        dataActual.push(document.getElementById("week_actual_3").value);
    }
    if(document.getElementById("week_actual_4").value != document.getElementById("week_actual_3").value){
        dataActual.push(document.getElementById("week_actual_4").value);
    }
    if(document.getElementById("week_actual_5").value != document.getElementById("week_actual_4").value){
        dataActual.push(document.getElementById("week_actual_5").value);
    }
    if(document.getElementById("week_actual_6").value != document.getElementById("week_actual_5").value){
        dataActual.push(document.getElementById("week_actual_6").value);
    }
    if(document.getElementById("week_actual_7").value != document.getElementById("week_actual_6").value){
        dataActual.push(document.getElementById("week_actual_7").value);
    }

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
        title: {
            text: 'SCurve Project',
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
        document.querySelector("#scurve_mdr"),
        options_scurve_mdr
    );
    chart.render();
    
    // waiting btn clicked swal
    function waitingSwal(){
        Swal.fire({
            title: 'Nothing You Can Do Here!',
            icon: 'warning',
            text: 'The progress is not here yet',
            timer: 5000,
            confirmButtonColor: "#5664d2",
        })
    }
</script>
<script src="assets/libs/dropzone/min/dropzone.min.js"></script>
<script src="assets/js/app.js"></script>
