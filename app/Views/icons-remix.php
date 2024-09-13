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

                        <div class="row">
                            
                            <div class="col-12" id="icons"></div> <!-- end col-->

                        </div><!-- end row -->

                    </div><!-- container-fluid -->
                    
                </div><!-- End Page-content -->

                <?= $this->include('partials/footer') ?>

            </div><!-- end main content-->

        </div><!-- END layout-wrapper -->

        <!-- Right Sidebar -->
        <?= $this->include('partials/right-sidebar') ?>

        <!-- JAVASCRIPT -->
        <?= $this->include('partials/vendor-scripts') ?>

        <!-- Remix icon js-->
        <script src="assets/js/pages/remix-icons-list.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
