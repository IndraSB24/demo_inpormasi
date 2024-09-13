<?= $this->include('partials/main') ?>

<head>
    <?= $title_meta ?>
    <?= $this->include('partials/head-css') ?>

    <script src="https://cdn.zingchart.com/zingchart.min.js"></script>

    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script src="https://code.highcharts.com/highcharts-3d.js"></script>

    <style>
        .equal-height-card-1 {
            min-height: 90%;
            max-height: 90%;
        }

        .equal-height-card-2 {
            min-height: 33%;
            max-height: 33%;
        }

        .equal-height-card-3 {
            min-height: 20%;
            max-height: 20%;
        }
    </style>

</head>

<!--load partial body-->
<?= $this->include('partials/body') ?>

<div id="layout-wrapper">
    <!--menu side-->
    <?= $this->include('partials/menu') ?>

    <div class="main-content">
        <!--message loader-->
        <div class="flash-data" data-flashdata="<?php echo pesan('message'); ?>"></div>
        <div class="page-content">
            <div class="container-fluid">

                <?= $page_title ?>

                <div class="row">
                    <div class="col-xl-8">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body bg-info text-light">
                                        <div class="d-flex">
                                            <div class="flex-1 overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Number of Projects</p>
                                                <h3 class="mb-0 text-light">15</h3>
                                            </div>
                                            <div class="text-muted ms-auto text-light">
                                                <i class="text-light ri-building-2-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body border-top py-3">
                                        <div class="text-truncate">
                                            <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span>
                                            <span class="text-muted ms-2">From previous period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body bg-success text-light">
                                        <div class="d-flex">
                                            <div class="flex-1 overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">On Time/Ahead</p>
                                                <h3 class="text-light mb-0">10</h3>
                                            </div>
                                            <div class="text-light ms-auto">
                                                <i class="ri-chat-check-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body border-top py-3">
                                        <div class="text-truncate">
                                            <span class="badge badge-soft-danger font-size-11"><i class="mdi mdi-menu-up"> </i> 2.4% </span>
                                            <span class="text-muted ms-2">From previous period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="card">
                                    <div class="card-body bg-danger text-light">
                                        <div class="d-flex">
                                            <div class="flex-1 overflow-hidden">
                                                <p class="text-truncate font-size-14 mb-2">Delay</p>
                                                <h3 class="text-light mb-0">5</h3>
                                            </div>
                                            <div class="text-light ms-auto">
                                                <i class="ri-chat-delete-line font-size-24"></i>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-body border-top py-3">
                                        <div class="text-truncate">
                                            <span class="badge badge-soft-success font-size-11"><i class="mdi mdi-menu-down"> </i> 2.4% </span>
                                            <span class="text-muted ms-2">From previous period</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!--projects mapp-->
                            <div class="col-sm-12">
                                <div class="card equal-height-card-1">
                                    <div class="card-body">
                                        <h4 class="card-title mb-4">Projects Map</h4>
                                        <div id="world-map-markers" style="height: 280px"></div>
                                        <!--<div id="indo-maps-markers"></div>-->
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--<div class="row">-->
                        <!--    <div class="col-sm-12">-->
                        <!--        <div class="card">-->
                        <!--            <div class="card-body">-->
                        <!--                <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".modal-project-add">Add Project</button>-->
                        <!--                <div class="table-responsive">-->
                        <!--                    <table id="table_list_project" class="table table-striped table-bordered dt-responsive nowrap" -->
                        <!--                        style="border-collapse: collapse; border-spacing: 0; width: 100%;"-->
                        <!--                    >-->
                        <!--                        <thead class="table-light">-->
                        <!--                            <tr>-->
                        <!--                                <th>Contract No</th>-->
                        <!--                                <th>Award Date</th>-->
                        <!--                                <th>Project Manager</th>-->
                        <!--                                <th>Project Value</th>-->
                        <!--                                <th>Plan</th>-->
                        <!--                                <th>Actual</th>-->
                        <!--                                <th>Variance</th>-->
                        <!--                                <th>Project Status</th>-->
                        <!--                                <th style="width: 120px;">Action</th>-->
                        <!--                            </tr>-->
                        <!--                        </thead>-->
                        <!--                        <tbody></tbody>-->
                        <!--                    </table>-->
                        <!--                </div>-->
                        <!--            </div>-->
                        <!--        </div>-->
                        <!--    </div>-->
                        <!--</div>-->
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="card">
                                    <div class="card-body">
                                        <button type="button" class="btn btn-primary waves-effect waves-light" data-bs-toggle="modal" data-bs-target=".modal-project-add">Add Project</button>
                                        <div class="table-responsive">
                                            <table id="scroll-vertical-datatable" class="table table-bordered nowrap"
                                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead class="table-light">
                                                    <tr>
                                                        <th>Contract No</th>
                                                        <th>Start At </th>
                                                        <th>Finist At </th>
                                                        <th>Project Name</th>
                                                        <th>Project Manager</th>
                                                        <th>Project Value</th>
                                                        <th>Description</th>
                                                        <th>Plan</th>
                                                        <th>Actual</th>
                                                        <th>Variance</th>
                                                        <th>Project Status</th>
                                                        <th style="width: 120px;">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($list_project as $row) : ?>
                                                        <tr>
                                                            <td><a href="project-dashboard" class="text-info fw-bold"><?= $row->contract_no ?></a> </td>
                                                            <td><?= tgl_indo($row->start_date) ?></td>
                                                            <td><?= tgl_indo($row->end_date) ?></td>
                                                            <td><?= $row->nama_project ?></td>
                                                            <td><?= $row->manager ?></td>
                                                            <td><?= rupiah($row->value) ?></td>
                                                            <td><?= $row->deskripsi ?></td>
                                                            <td><?= $row->plan ?>%</td>
                                                            <td><?= $row->progress ?>%</td>
                                                            <td><?= ($row->progress  -  $row->plan) ?>%</td>
                                                            <td>
                                                                <?php
                                                                if ($row->status == "Delayed") {
                                                                    echo '<div class="badge badge-soft-danger font-size-12">' . $row->status . '</div>';
                                                                } else {
                                                                    echo '<div class="badge badge-soft-success font-size-12">' . $row->status . '</div>';
                                                                }
                                                                ?>
                                                            </td>
                                                            <td id="tooltip-container9">
                                                                <a type="button" href="project-dashboard" class="btn btn-sm btn-success btn-detail" title="Hapus Data" data-id="<?= $row->id ?>" data-object="Project/delete">Detail</a>
                                                                <!-- <button type="button" class="btn btn-sm btn-danger btn-hapus" title="Hapus Data" data-id="<?= $row->id ?>" data-object="Project/delete"><i class="mdi mdi-trash-can font-size-18"></i></button> -->
                                                            </td>
                                                        </tr>
                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xl-4">
                        <div class="col-sm-12">
                            <div class="card equal-height-card-2">
                                <div class="card-body">
                                    <div id="cash-flow-chart" class="mt-0 mb-0"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card equal-height-card-2">
                                <div class="card-body">
                                    <div id="projectByIsland-chart"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <h4 class="card-title mt-0 mb-4">Manpower By Month</h4>
                                    <div id="column_chart" class="apex-charts mb-5" dir="ltr"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
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

<!-- Modal -->
<!--  Modal content for the above example -->
<div class="modal fade modal-project-add" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <form action="#" method="POST">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title mt-0" id="myLargeModalLabel">Add Project Detail</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div>
                        <label class="form-label">Contract No</label>
                        <input type="text" class="form-control" name="contract_no" id="contract_no" />
                    </div>
                    <!-- <div>
                    <label class="form-label">Award Date</label>
                    <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                        <input type="text" class="form-control" name="award_date" id="award_date" placeholder="Award Date" />
                    </div>
                </div> -->
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Start At</label>
                            <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                <input type="text" class="form-control" name="start_date" id="start_date" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Finist At</label>
                            <div class="input-daterange input-group" id="datepicker6" data-date-format="dd M, yyyy" data-date-autoclose="true" data-provide="datepicker" data-date-container='#datepicker6'>
                                <input type="text" class="form-control" name="end_date" id="end_date" />
                            </div>
                        </div>
                    </div>
                    <div>
                        <label class="form-label">Project Manager</label>
                        <input type="text" class="form-control" name="project_manager" id="project_manager" />
                    </div>
                    <div>
                        <label class="form-label">Project Value</label>
                        <input type="number" class="form-control" name="value" id="value" />
                    </div>
                    <div>
                        <label class="form-label">Project Name</label>
                        <input type="text" class="form-control" name="nama_project" id="nama_project" />
                    </div>
                    <div>
                        <label class="form-label">Description </label>
                        <input type="text" class="form-control" name="description " id="description " />
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-success btn-simpan" id="btn-simpan" title="Add Data" data-object="Project/add">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    // datatable
    //     $(document).ready( function () {
    // 		$('#table_list_project').DataTable({
    // 		    "processing": true,
    //             "serverSide": true,
    //             // "responsive": true,
    // 			language: {
    // 				"paginate": {
    // 					"first":      "&laquo",
    // 					"last":       "&raquo",
    // 					"next":       "&gt",
    // 					"previous":   "&lt"
    // 				},
    // 			},
    // 			dom:'lfBrtip',
    // 			buttons: [
    //                 'copyHtml5',
    //                 'excelHtml5',
    //                 'csvHtml5',
    //                 'pdfHtml5'
    //             ],
    //             lengthMenu: [ 
    //                 [10, 20, 50, -1],
    //                 [ '10', '25', '50', 'ALL' ]
    //             ],
    //             ajax: {
    //                 "url": "<?= base_url('Home/get_datatable') ?>",
    //                 "type": "POST",
    //                 "data": function (data) {
    //                     data.searchValue = $('#datatable_filter input').val();
    //                 }
    //             },
    //             columnDefs: [
    //                 { 
    //                     "targets": [ 0, 5 ],
    //                     "orderable": false,
    //                 },
    //             ],
    // 		});
    // 	});

    $(document).on('click', '.btn-simpan', function() {
        // const contract_no = document.getElementById("contract_no").value;
        // const award_date = document.getElementById("award_date").value;
        // const project_manager = document.getElementById("project_manager").value;
        // const value = document.getElementById("value").value;
        const objek = $(this).data('object')
        var timerInterval;
        Swal.fire({
            title: 'Tambah Project?',
            icon: 'info',
            //text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
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
                        // contract_no: contract_no,
                        // award_date: award_date,
                        // project_manager: project_manager,
                        // value: value
                        contract_no : $('#contract_no').val(),
                        start_date : $('#start_date').val(),
                        end_date : $('#end_date').val(),
                        project_manager : $('#project_manager').val(),
                        value : $('#value').val(),
                        nama_project : $('#nama_project').val(),
                        description : $('#description').val(),
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

    $(document).on('click', '.btn-hapus', function() {
        const id = $(this).data('id')
        const objek = $(this).data('object')
        var timerInterval;
        Swal.fire({
            title: 'Hapus Data?',
            icon: 'error',
            text: 'Data yang sudah dihapus tidak dapat dikembalikan lagi!',
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
                    text: 'Data berhasil dihapus.',
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

    $(document).on('click', '.btn-logout', function() {
        const id = $(this).data('id')
        const objek = $(this).data('object')
        var timerInterval;
        Swal.fire({
            title: 'Yakin Untuk Logout?',
            icon: 'question',
            text: '',
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
                        id_project: id
                    }
                });
                Swal.fire({
                    title: 'Logout!',
                    icon: 'success',
                    text: 'Anda berhasil Logout.',
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
                        location.href = "<?php echo base_url(); ?>";
                    }
                })
            }
        })
    })

    // cash in chart
    var radialoptions = {
        series: [72],
        chart: {
            type: 'radialBar',
            wight: 60,
            height: 60,
            sparkline: {
                enabled: true
            }
        },
        dataLabels: {
            enabled: false
        },
        colors: ['#5664d2'],
        stroke: {
            lineCap: 'round'
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    margin: 0,
                    size: '70%'
                },
                track: {
                    margin: 0,
                },

                dataLabels: {
                    show: false
                }
            }
        }
    };
    var radialchart = new ApexCharts(document.querySelector("#radialchart-1"), radialoptions);
    radialchart.render();

    // cash flow chart
    (function() {
        let totalCashIn = 1000000000,
            totalCashOut = 700000000;
        let total = totalCashIn + totalCashOut;

        Highcharts.chart('cash-flow-chart', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                },
                marginTop: 0,
                marginBottom: 0,
                height: 200
            },
            title: {
                text: 'Cash Flow',
                margin: 10
            },
            plotOptions: {
                pie: {
                    innerSize: '40%',
                    depth: 20
                }
            },
            series: [{
                name: 'Cash',
                data: [{
                        name: 'Cash In ' + totalCashIn,
                        y: totalCashIn,
                        color: '#5dbd8d',
                    },
                    {
                        name: 'Cash Out ' + totalCashOut,
                        y: totalCashOut,
                        color: '#e9425d',
                    }
                ]
            }]
        });
    })();

    // Sebaran Project Chart
    (function() {
        var sebaranProjectData = [{
                name: 'Sumatera',
                y: 20,
                color: '#beddad' // Customize the color for Sumatera
            },
            {
                name: 'Jawa',
                y: 20,
                color: '#7e0cd6' // Customize the color for Jawa
            },
            {
                name: 'Kalimantan',
                y: 40,
                color: '#008080' // Customize the color for Kalimantan
            },
            {
                name: 'Sulawesi',
                y: 5,
                color: '#f28f93' // Customize the color for Sulawesi
            },
            {
                name: 'Papua',
                y: 15,
                color: '#1cbb8c' // Customize the color for Papua
            }
        ];

        var totalY = 0;
        for (var i = 0; i < sebaranProjectData.length; i++) {
            totalY += sebaranProjectData[i].y;
        }

        for (var i = 0; i < sebaranProjectData.length; i++) {
            // var percentage = (sebaranProjectData[i].y / totalY * 100).toFixed(0);
            sebaranProjectData[i].name = sebaranProjectData[i].name + ' - ' + sebaranProjectData[i].y;
        }

        Highcharts.chart('projectByIsland-chart', {
            chart: {
                type: 'pie',
                options3d: {
                    enabled: true,
                    alpha: 45
                },
                marginTop: 5,
                marginBottom: 0,
                height: 200
            },
            title: {
                text: 'Projects by Region'
            },
            plotOptions: {
                pie: {
                    innerSize: '0%',
                    depth: 20,
                    center: ['50%', '50%'],
                }
            },
            series: [{
                name: 'Projects',
                data: sebaranProjectData
            }]
        });
    })();

    // indonesian map
    var map = new GMaps({
        div: '#indo-maps-markers',
        lat: -2.5, // Center the map on Indonesia
        lng: 120,
        zoom: 5, // Zoom level to show Indonesia
    });

    // List of cities in Indonesia with coordinates
    var cities = [{
            lat: 0.510440,
            lng: 101.438309,
            name: 'Pekanbaru'
        },
        {
            lat: -0.942942,
            lng: 100.371857,
            name: 'Padang'
        },
        {
            lat: -5.450000,
            lng: 105.266670,
            name: 'Lampung'
        },
        {
            lat: -6.200000,
            lng: 106.816666,
            name: 'Jakarta'
        },
        {
            lat: -6.905977,
            lng: 107.613144,
            name: 'Bandung'
        },
        {
            lat: -6.966667,
            lng: 110.416664,
            name: 'Semarang'
        },
        {
            lat: -1.265386,
            lng: 116.831200,
            name: 'Balikpapan'
        },
        {
            lat: -2.2136,
            lng: 113.9108,
            name: 'Palangkaraya'
        },
        {
            lat: -0.502106,
            lng: 117.153709,
            name: 'Samarinda'
        },
        {
            lat: -5.135399,
            lng: 119.423790,
            name: 'Makassar'
        },
        {
            lat: -5.310289,
            lng: 119.742604,
            name: 'Gowa'
        },
        {
            lat: -3.87000000,
            lng: 119.62000000,
            name: 'Pare-Pare'
        },
        {
            lat: -2.53,
            lng: 140.72,
            name: 'Jayapura'
        },
        {
            lat: -8.499112,
            lng: 140.404984,
            name: 'Merauke'
        },
        {
            lat: -0.88,
            lng: 131.26,
            name: 'Sorong'
        },
    ];

    // Add markers for each city
    cities.forEach(function(city) {
        map.addMarker({
            lat: city.lat,
            lng: city.lng,
            title: city.name,
            details: {
                // Additional details if needed
            },
            click: function(e) {
                if (console.log) console.log(e);
                alert('You clicked on ' + city.name);
            },
        });
    });
</script>