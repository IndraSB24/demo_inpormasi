<?= $this->include('partials/main') ?>

<head>

    <?= $title_meta ?>

    <?= $this->include('partials/head-css') ?>
    <style>
        #signPlace,
        #signPlace_edit {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            /* Adjust as needed */
            height: 100%;
            /* Adjust as needed */
            border: 1px solid grey;
            background-color: #fcfaf5;
            border-radius: 10px;
            /* Optional, for visualization */
        }

        #signPlace img,
        #signPlace_edit img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
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

                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->
                <div class="row">
                    <div class="col-xl-12">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="d-flex flex-column flex-sm-row justify-content-end mb-3">
                                    <button class="btn btn-primary waves-effect waves-light float-right" data-bs-toggle="modal" data-bs-target="#main_modal"><i class="fas fa-plus"></i> Add Data</button>
                                </div>
                                <div class="card">
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table id="table_main" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                                <thead>
                                                    <tr class="bg-primary text-light">
                                                        <th>No.</th>
                                                        <th>Name</th>
                                                        <th>Email</th>
                                                        <th>Phone</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
        </div>

        <!--Modal Add Document-->
        <div id="main_modal" class="modal fade" role="dialog" aria-labelledby="main_modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="#" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0">Add Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="level_code" id="name" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="description" id="email" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control num-only" name="weight_factor" id="phone" />
                                    <small class="text-muted">Please enter only numeric characters (0-9).</small>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Role</label>
                                    <select class="form-select" name="category" id="role">
                                        <option selected> --Select-- </option>
                                        <option value="7">Staff PP</option>
                                        <option value="8">Internal Vendor</option>
                                        <option value="9">External Vendor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12"><small>draw/ upload your signature</small></div>
                                            <div class="col-md-12">
                                                <canvas id="signature-pad" style="border: 1px solid grey; border-radius: 10px;"></canvas> <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mb-3">
                                                <input type="hidden" id="signType">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-warning" id="clear-button">Clear Canvas</button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-primary" id="saveSign" style="margin-left: 40px;">Add Sign</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a href="javascript:" id="open-file-button"><i class="fas fa-upload"></i> Upload File <small>(Max size. 500KB)</small></a>
                                                <input type="file" id="file-input" style="display: none;" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <div class="row">
                                            <div class="col-6"><small>Signature:</small></div>
                                            <div class="col-6" style="display: flex;justify-content:end"> <a href="javascript:" id="remove-sign"><small><i class="fas fa-trash"></i> remove sign</small></a>
                                        </div>
                                    </div> -->
                                        <div><small>Signature:</small></div>
                                        <div id="signPlace"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn_simpan" title="Add Data">
                                Add
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div id="edit_modal" class="modal fade" role="dialog" aria-labelledby="edit_modal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <form action="#" method="POST">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0">Edit Data</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Name</label>
                                    <input type="text" class="form-control" name="level_code" id="edit_name" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Email</label>
                                    <input type="text" class="form-control" name="description" id="edit_email" />
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Phone</label>
                                    <input type="text" class="form-control num-only" name="weight_factor" id="edit_phone" />
                                    <small class="text-muted">Please enter only numeric characters (0-9).</small>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Role</label>
                                    <select class="form-select" name="category" id="edit_role">
                                        <option selected> --Select-- </option>
                                        <option value="7">Staff PP</option>
                                        <option value="8">Internal Vendor</option>
                                        <option value="9">External Vendor</option>
                                    </select>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12"><small>draw/ upload your signature</small></div>
                                            <div class="col-md-12">
                                                <canvas id="signature-pad_edit" style="border: 1px solid grey; border-radius: 10px;"></canvas> <br>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="row mb-3">
                                                <input type="hidden" id="signType_edit">
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-warning" id="clear-button_edit">Clear Canvas</button>
                                                </div>
                                                <div class="col-6">
                                                    <button type="button" class="btn btn-primary" id="saveSign_edit" style="margin-left: 40px;">Add Sign</button>
                                                </div>
                                            </div>
                                            <div class="col-12">
                                                <a href="javascript:" id="open-file-button_edit"><i class="fas fa-upload"></i> Upload File <small>(Max size. 500KB)</small></a>
                                                <input type="file" id="file-input_edit" style="display: none;" accept="image/*">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <!-- <div class="row">
                                            <div class="col-6"><small>Signature:</small></div>
                                            <div class="col-6" style="display: flex;justify-content:end"> <a href="javascript:" id="remove-sign"><small><i class="fas fa-trash"></i> remove sign</small></a>
                                        </div>
                                    </div> -->
                                        <div><small>Signature:</small></div>
                                        <div id="signPlace_edit"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="edit_id">
                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="btn_update" title="Add Data">
                                Save
                            </button>
                        </div>
                    </div>
                </form>
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

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>

<!-- apexcharts init -->
<script src="assets/js/pages/apexcharts.init.js"></script>

<!-- jquery.vectormap map -->
<script src="assets/libs/admin-resources/jquery.vectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="assets/libs/admin-resources/jquery.vectormap/maps/jquery-jvectormap-us-merc-en.js"></script>

<!-- Required datatable js -->
<script src="assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js"></script>

<!-- Responsive examples -->
<script src="assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
<script src="assets/libs/datatables.net-responsive-bs4/js/responsive.bootstrap4.min.js"></script>

<script src="assets/js/pages/dashboard.init.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/signature_pad/1.5.3/signature_pad.min.js"></script>

<!-- App js -->

</body>

</html>

<script>
    // var
    const baseUrl = "<?= base_url() ?>";
    var mainTable;

    // Call the function when the document is ready
    $(document).ready(function() {
        mainDatatable();

        // for add form
        $('#main_modal').on('hidden.bs.modal', function(e) {
            signaturePad.clear();
            $('#name').val(null);
            $('#email').val(null);
            $('#phone').val(null);
            $('#signType').val(null);
            $('#file-input').val(null);
            $('#signPlace').html(null)
        });

        let canvas = document.getElementById('signature-pad');
        let signaturePad = new SignaturePad(canvas);

        $('#clear-button').click(function() {
            signaturePad.clear();
        });

        $('#saveSign').click(function() {
            if (signaturePad.isEmpty()) {
                Swal.fire("Error", 'Tanda tangan tidak boleh kosong!', "error")
                return;
            }
            let canvas = $('#signature-pad')[0]
            $('#dataSign').val($('#signature-pad')[0])
            let imageDataUrl = canvas.toDataURL();

            let $imgElement = $("<img>").attr("src", imageDataUrl);

            $('#signPlace').html($imgElement)
            $('#signType').val('signPad')
            // signaturePad.clear();
        });

        $("#file-input").change(function() {
            signaturePad.clear();
            let selectedFile = this.files[0];
            if (selectedFile) {
                if (selectedFile.size >= 500000) {
                    Swal.fire("Error", 'Size terlalu besar!', "error")
                    $(this).val('');
                    return;
                }
                var $newImg = $("<img>");

                var reader = new FileReader();

                reader.onload = function(e) {
                    $(this).val('');
                    $newImg.attr("src", e.target.result);
                    $newImg.attr("max-height", "200px"); // Atur tinggi gambar

                    $("#signPlace").html($newImg);
                };
                reader.readAsDataURL(selectedFile);
                $('#signature-pad').empty()
                $('#signType').val('image')
            }
        });

        // for edit form
        $('#edit_modal').on('hidden.bs.modal', function(e) {
            signaturePad_edit.clear();
            $('#signType_edit').val(null);
            $('#signPlace_edit').html(null)
        });

        let canvas_edit = document.getElementById('signature-pad_edit');
        let signaturePad_edit = new SignaturePad(canvas_edit);

        $('#clear-button_edit').click(function() {
            signaturePad_edit.clear();
        });

        $('#saveSign_edit').click(function() {
            if (signaturePad_edit.isEmpty()) {
                Swal.fire("Error", 'Tanda tangan tidak boleh kosong!', "error")
                return;
            }
            let canvas = $('#signature-pad_edit')[0]
            $('#dataSign_edit').val($('#signature-pad_edit')[0])
            let imageDataUrl = canvas.toDataURL();
            console.log(imageDataUrl, 'fuadi imageDataUrlimageDataUrl');


            let $imgElement = $("<img>").attr("src", imageDataUrl);

            $('#signPlace_edit').html($imgElement)
            $('#signType_edit').val('signPad')
            // signaturePad_edit.clear();
        });

        $("#file-input_edit").change(function() {
            signaturePad_edit.clear();
            let selectedFile = this.files[0];
            if (selectedFile) {
                if (selectedFile.size >= 500000) {
                    Swal.fire("Error", 'Size terlalu besar!', "error")
                    $(this).val('');
                    return;
                }
                var $newImg = $("<img>");

                var reader = new FileReader();

                reader.onload = function(e) {
                    $(this).val('');
                    $newImg.attr("src", e.target.result);
                    $newImg.attr("max-height", "200px"); // Atur tinggi gambar

                    $("#signPlace_edit").html($newImg);
                };
                reader.readAsDataURL(selectedFile);
                $('#signature-pad_edit').empty()
                $('#signType_edit').val('image')
            }
        });
    });

    // Initialize or reinitialize the DataTable
    function mainDatatable() {
        // Destroy the existing DataTable instance if it exists
        if (mainTable) {
            mainTable.destroy();
        }

        // Initialize the DataTable
        mainTable = $('#table_main').DataTable({
            "processing": true,
            "serverSide": true,
            language: {
                "paginate": {
                    "first": "&laquo",
                    "last": "&raquo",
                    "next": "&gt",
                    "previous": "&lt"
                },
            },
            lengthMenu: [
                [10, 25, 50, 100, -1],
                ['10', '25', '50', '100', 'ALL']
            ],
            ajax: {
                "url": "<?= site_url('karyawan/ajax_get_list') ?>",
                "type": "POST",
                "data": function(data) {
                    data.searchValue = $('#table_main_filter input').val();
                }
            },
            columnDefs: [{
                    "targets": [0, 3, 4],
                    "className": "text-center"
                },
                {
                    "targets": [0, 4],
                    "orderable": false,
                },
            ],
        });
    }

    // simpan
    $(document).on('click', '#btn_simpan', function() {
        const path = "<?= site_url('Karyawan/add_Karyawan') ?>";
        if ($('#signType').val() == 'image') {
            // jika TTD upload gambar
            let selectedFile = $("#file-input")[0].files[0];
            if (selectedFile) {
                const name = selectedFile.name;
                const file = new FormData();
                file.append(name, selectedFile);
                console.log(file, 'image');
                // $.ajax({
                //     method: 'post',
                //     url: `https://api-image.assist.id/hospitalImage`,
                //     data: file,
                //     processData: false,
                //     contentType: false,
                //     crossDomain: true,
                // }).done((resp) => {
                //     console.log(resp)
                //     submitImageName(resp)
                // }).fail((err) => {
                //     console.log(err)
                //     swal("Error", 'Terjadi Kesalahan', "error")
                // });
            }
        } else {
            // jika TTD sign pad
            let canvas = $('#signature-pad')[0]
            let imageDataUrl = canvas.toDataURL();
            const image = $("<img>").attr("src", imageDataUrl);
            image.on("load", function() {
                // Buat elemen <canvas> baru untuk mengubah gambar menjadi Blob
                const canvas = $("<canvas>")[0];
                const ctx = canvas.getContext("2d");
                canvas.width = image[0].width;
                canvas.height = image[0].height;
                ctx.drawImage(image[0], 0, 0, canvas.width, canvas.height);

                // Ubah elemen <canvas> menjadi Blob
                canvas.toBlob(function(blob) {
                    // Buat objek FormData dan tambahkan Blob ke dalamnya
                    const formData = new FormData();
                    formData.append("signature", blob, "signature.png");
                    console.log(formData, 'pad');

                    // $.ajax({
                    //     method: 'post',
                    //     url: `https://api-image.assist.id/hospitalImage`,
                    //     // dataType: 'json',
                    //     data: formData,
                    //     processData: false,
                    //     contentType: false,
                    //     crossDomain: true,
                    // }).done((resp) => {
                    //     submitImageName(resp)
                    // }).fail(resp => {
                    //     swal("Error", 'Terjadi Kesalahan!', "error")
                    // })

                }, "image/png");
            });
        }

        const data = {
            name: $('#name').val(),
            email: $('#email').val(),
            phone: $('#phone').val(),
            role: $('#role').val(),
        };

        loadQuestionalSwal(
            path, data, 'Tambahkan karyawan dengan nama: ' + $('#name').val() + ' ?',
            'Disimpan!', 'Karyawan dengan nama: ' + $('#name').val() + ' berhasil ditambahkan.', 'main_modal'
        );

        $('#name').val(null)
        $('#email').val(null)
        $('#phone').val(null)
        $('#role').val(null)
    });

    $(document).on('click', '#btn_update', function() {
        const path = "<?= site_url('Karyawan/edit_karyawan') ?>";
        const pathSign = "<?= base_url('Karyawan/setSignature') ?>"
        console.log($('#signType_edit').val());

        if ($('#signType_edit').val() == 'image') {
            // jika TTD upload gambar
            let selectedFile = $("#file-input_edit")[0].files[0];
            if (selectedFile) {
                const name = selectedFile.name;
                const file = new FormData();
                file.append('file', selectedFile);
                file.append("id_karyawan", $('#edit_id').val());
                console.log(file, 'image');
                $.ajax({
                    method: 'post',
                    url: pathSign,
                    data: file,
                    processData: false,
                    contentType: false,
                    crossDomain: true,
                }).done((resp) => {
                    console.log(resp)
                    // submitImageName(resp)
                }).fail((err) => {
                    console.log(err)
                    Swal.fire("Error", 'Terjadi Kesalahan', "error")
                });
            }
        } else {
            // jika TTD sign pad
            let canvas = $('#signature-pad_edit')[0]
            let imageDataUrl = canvas.toDataURL();
            console.log(imageDataUrl, 'fuadi imageDataUrl');

            const image = $("<img>").attr("src", imageDataUrl);
            image.on("load", function() {
                // Buat elemen <canvas> baru untuk mengubah gambar menjadi Blob
                const canvas = $("<canvas>")[0];
                const ctx = canvas.getContext("2d");
                canvas.width = image[0].width;
                canvas.height = image[0].height;
                ctx.drawImage(image[0], 0, 0, canvas.width, canvas.height);

                // Ubah elemen <canvas> menjadi Blob
                canvas.toBlob(function(blob) {
                    // Buat objek FormData dan tambahkan Blob ke dalamnya
                    const formData = new FormData();
                    formData.append("file", blob, "signature.png");
                    formData.append("id_karyawan", $('#edit_id').val());
                    console.log(formData, 'pad');

                    $.ajax({
                        method: 'post',
                        url: pathSign,
                        // dataType: 'json',
                        data: formData,
                        processData: false,
                        contentType: false,
                        crossDomain: true,
                    }).done((resp) => {
                        // submitImageName(resp)
                    }).fail(resp => {
                        Swal.fire("Error", 'Terjadi Kesalahan!', "error")
                    })

                }, "image/png");
            });
        }
        const data = {
            edit_id: $('#edit_id').val(),
            name: $('#edit_name').val(),
            email: $('#edit_email').val(),
            phone: $('#edit_phone').val(),
            role: $('#edit_role').val(),
        };

        loadQuestionalSwal(
            path, data, 'Edit data karyawan dengan nama: ' + $('#edit_name').val() + ' ?',
            'Disimpan!', 'Karyawan dengan nama: ' + $('#name').val() + ' berhasil diedit.', 'edit_modal'
        );
    });


    $(document).on('click', '#showPdf', function() {
        const id = $(this).data()['id'];
        const link = "<?= base_url('karyawan-doc') ?>" + '/' + id
        window.location.href = link;
    })

    $("#open-file-button").click(function() {
        $("#file-input").val('')
        $("#file-input").click();
    });

    $("#open-file-button_edit").click(function() {
        $("#file-input_edit").val('')
        $("#file-input_edit").click();
    });

    // delete
    $(document).on('click', '#btn_delete', function() {
        const thisData = $(this).data();
        const path = "<?= site_url('karyawan/delete_karyawan') ?>";
        const data = {
            id: thisData['id']
        };

        loadQuestionalSwal(
            path, data, 'Hapus Karyawan dengan nama: ' + thisData['name'] + ' ?',
            'Dihapus!', 'Karyawan dengan nama: ' + thisData['name'] + ' berhasil dihapus.', ''
        );
    });

    // load edit modal
    $(document).on('click', '#btn_edit', function() {
        var idItem = $(this).data('id');
        console.log(idItem);
        const path = "<?= site_url('karyawan/ajax_get_item_data') ?>";
        $.ajax({
            url: path,
            method: 'POST',
            data: {
                id_item: idItem
            },
            dataType: 'json',
            success: function(response) {
                console.log(response);

                // Populate modal fields with fetched data
                $('#edit_id').val(response.id);
                $('#edit_email').val(response.email);
                $('#edit_name').val(response.name);
                $('#edit_phone').val(response.phone);
                $('#edit_modal').modal('show');
            },
            error: function(xhr, status, error) {
                // Handle errors
                console.error(xhr.responseText);
            }
        });
    });

    // konfirmasi edit
    $(document).on('click', '#btn_konfirmasi_edit', function() {
        const thisData = $(this).data();
        const path = "<?= site_url('item/edit_item') ?>";
        const data = {
            edit_id: $('#edit_id').val(),
            kode_item: $('#kode_item_edit').val(),
            barcode: $('#barcode_edit').val(),
            nama: $('#nama_edit').val(),
            id_kategori_jenis: $('#jenis_edit').val(),
            id_satuan: $('#satuan_edit').val(),
            id_kategori_item: $('#kategori_edit').val(),
            id_brand: $('#brand_edit').val(),
            id_supplier: $('#supplier_edit').val(),
            stok_minimum: $('#stok_minimum_edit').val(),
            harga_dasar: $('#harga_dasar_edit').val()
        };

        loadQuestionalSwal(
            path, data, 'Konfirmasi edit Item dengan Kode: ' + $('#kode_item_edit').val() + ' ?',
            'Diedit!', 'Item dengan kode: ' + $('#kode_item_edit').val() + ' berhasil diedit.', 'modal_edit'
        );
    });
</script>