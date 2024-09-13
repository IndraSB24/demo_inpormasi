<?= $this->include('partials/main') ?>

    <head>
        
    <?= $title_meta ?>
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

                        <!-- start page title -->
                        <?= $page_title ?>
                        <!-- end page title -->

                        <div class="row justify-content-center">
                            <div class="col-xl-10">
                                <div class="timeline">
                                    <div class="timeline-item timeline-left">
                                        <div class="timeline-block">
                                            <div class="time-show-btn mt-0">
                                                <a href="#" class="btn btn-danger btn-rounded w-lg">Timeline</a>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <?php
                                        $data_length = count($timeline_data);
                                        if($data_length % 2 == 0){
                                            $card_position[0] = "left";
                                        }else{
                                            $card_position[0] = "right";
                                        }
                                        for($i=0; $i<$data_length; $i++){
                                            if($i != 0){
                                                if($card_position[$i-1] == "right"){
                                                    $card_position[$i] = "left";   
                                                }else if($card_position[$i-1] == "left"){
                                                    $card_position[$i] = "right";
                                                }
                                            }
                                    ?>
                                            <div class="timeline-item <?= $card_position[$i]=='left' ? 'timeline-left' : '' ?>">
                                                <div class="timeline-block">
                                                    <div class="timeline-box card">
                                                        <div class="card-body">
                                                            <span class="timeline-icon"></span>
                                                            <div class="timeline-date">
                                                                <i class="mdi mdi-circle-medium circle-dot"></i> 
                                                                <?= date('Y, d F', strtotime($timeline_data[$i]->time)) ?>
                                                            </div>
                                                            <h5 class="mt-3 foont-size-15">
                                                                <?= $timeline_data[$i]->timeline_title ? $timeline_data[$i]->timeline_title : 'No Title' ?>
                                                            </h5>
                                                            <div class="text-muted">
                                                                <p class="mb-0">
                                                                    Created At <?= $timeline_data[$i]->created_at ?>
                                                                </p>
                                                                <p class="mb-0">
                                                                    <?= 
                                                                        $timeline_data[$i]->timeline_description ? 
                                                                        $timeline_data[$i]->timeline_description : 
                                                                        'No Description' 
                                                                    ?>
                                                                </p>
                                                            </div>
                                                            <div class="timeline-album">
                                                            <!-- base_url('commentPdf/') . '/' . $row->id . '/internal -->
                                                                <!-- <a  href="<?=
                                                                        $timeline_data[$i]->new_file ?
                                                                        base_url($timeline_data[$i]->new_file) :
                                                                        'javascript:noFileFoundError();'
                                                                    ?>" 
                                                                    class="me-1"
                                                                > -->
                                                                <a  href="<?= base_url('commentPdf').'/'.$timeline_data[$i]->doc_id.'/preview'?>" 
                                                                    class="me-1"
                                                                >
                                                                    <span>Cek Dokumen</span>
                                                                    <!--<img src="assets/images/small/img-2.jpg" alt="small img-2">-->
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                    <?php
                                        }
                                    ?>
                                </div>
                            </div>
                        </div>
                        <!-- end row -->

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
        <!-- /Right-bar -->

        <?= $this->include('partials/vendor-scripts') ?>
        
        <!--<script src="assets/js/app.js"></script>-->

    </body>
</html>

<script>
    // check file availability
    function noFileFoundError(){
        Swal.fire({
            title: 'No File Found!',
            icon: 'error',
            // text: 'File Berhasil Diupload.',
            timer: 2000,
            confirmButtonColor: "#5664d2",
        })
    }
</script>
