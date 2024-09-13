<?= $this->include('partials/main') ?>

    <head>
        
    <?= $title_meta ?>

        <!-- DataTables -->
        <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
        <link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

        <!-- Responsive datatable examples -->
        <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />     

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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
        
                                        <table id="datatable-buttons" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                            <thead>
                                                <tr>
                                                    <th>No</th>
                                                    <th>Document Number</th>
                                                    <th>Dicipline</th>
                                                    <th>Document Description</th>
                                                    <th>Revision Number</th>
                                                    <th>Schedule Submission Data</th>
                                                    <th>Priority</th>
                                                    <th>Planned Start</th>
                                                    <th>Planned Finish</th>
                                                </tr>
                                            </thead>
        
                                            <tbody>
                                                <tr>
                                                    <td>1</td>
                                                    <td>EPC01</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Welding</td>
                                                    <td>0</td>
                                                    <td>25/02/2023</td>
                                                    <td>urgent</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>2</td>
                                                    <td>PPP01</td>
                                                    <td>PLANTATION</td>
                                                    <td>Field Check</td>
                                                    <td>3</td>
                                                    <td>25/02/2023</td>
                                                    <td>Medium</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>3</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>4</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>5</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>6</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>7</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>8</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>9</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>10</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>11</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>12</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                                <tr>
                                                    <td>13</td>
                                                    <td>EPC02</td>
                                                    <td>OIL & GAS</td>
                                                    <td>Piping</td>
                                                    <td>1</td>
                                                    <td>25/02/2023</td>
                                                    <td>Low</td>
                                                    <td>25/02/2023</td>
                                                    <td>25/02/2023</td>
                                                </tr>
                                            </tbody>
                                        </table>
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

        <!-- Required datatable js -->
        <script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
        <script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>
        <!-- Buttons examples -->
        <script src="assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
        <script src="assets/libs/datatables.net-buttons-bs4/js/buttons.bootstrap4.min.js"></script>
        <script src="assets/libs/jszip/jszip.min.js"></script>
        <script src="assets/libs/pdfmake/build/pdfmake.min.js"></script>
        <script src="assets/libs/pdfmake/build/vfs_fonts.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
        <script src="assets/libs/datatables.net-buttons/js/buttons.colVis.min.js"></script>

        <script src="assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
        <script src="assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
        
        <!-- Responsive examples -->
        <script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
        <script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

        <!-- Datatable init js -->
        <script src="assets/js/pages/datatables.init.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
