<?= $this->include('partials/main') ?>

<head>

    <?= $title_meta ?>

    <!-- DataTables -->
    <link href="assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-buttons-bs4/css/buttons.bootstrap4.min.css" rel="stylesheet" type="text/css" />
    <link href="assets/libs/datatables.net-select-bs4/css//select.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- Responsive datatable examples -->
    <link href="assets/libs/datatables.net-responsive-bs4/css/responsive.bootstrap4.min.css" rel="stylesheet" type="text/css" />

    <!-- toast -->
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet" />

    <?= $this->include('partials/head-css') ?>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/4.5.0/fabric.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/pdfjs-dist@2.7.570/build/pdf.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdf.js/1.8.349/pdf.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vue@2"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.3.4/jspdf.min.js"></script>
    <style>
        #canvasContainer {
            /* display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            height: 100vh; */
            /* background-color: red; */
            background-color: rgba(200, 200, 200, 0.5);
            /* Warna latar belakang dengan opasitas */
            /* box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1); */
            overflow: auto;
            /* Adjust the height as needed */
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
    <div class="main-content" id="app">

        <div class="page-content">
            <div class="container-fluid">

                <!-- start page title -->
                <?= $page_title ?>
                <!-- end page title -->
                <div class='row'>
                    <div class="col-md-8">
                        <div class="card" style="padding: 30px">
                            <div class='row mb-3'>
                                <div class="align-items-end" style="display: flex; justify-content:center; gap: 10px; ">
                                    <button class="btn btn-sm btn-primary waves-effect waves-light" :disabled="this.currentPage === 1" id="prev">Prev</button>
                                    <div style='width: 70px'>
                                        <input type="number" class="form-control form-control-sm" v-model="currentPage" id="page" />
                                    </div>
                                    <button class="btn btn-sm btn-primary waves-effect waves-light" :disabled="this.currentPage === this.totalPagePdf" id="next">Next</button>
                                </div>
                            </div>
                            <div id="canvasContainer" class="card" style="padding: 20px">
                                <canvas id="canvas" width="750" height="1000"></canvas>
                                <input id='currentPdf' type="hidden">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-body">
                                <div class="card" style="border: 1px solid #eff2f7;border-radius: 10px;padding: 10px; margin: 0">
                                    <div class="container">
                                        <div class="row mb-4">
                                            <div class="col-md-12">
                                                <label class="form-label">Document Description</label>
                                                <input type="text" class="form-control" name="upload_doc_desc" id="upload_doc_desc" value="<?= $doc_data[0]->description ?>" readonly />
                                            </div>
                                        </div>
                                        <div class="row mb-4">
                                            <div class="row mb-4">
                                                <div class="col-md-12">
                                                    <label for="actual_man_hour" class="form-label">Actual Man Hour</label>
                                                    <input type="number" class="form-control" name="actual_man_hour" id="actual_man_hour" value="" />
                                                </div>
                                            </div>
                                            <div class="mb-4">
                                                <label for="upload_uploaded_file" id="upload_btn_choose_file" class="btn btn-info">Choose File</label>
                                                <input name="upload_uploaded_file" id="upload_uploaded_file" type="file" multiple="multiple" style="display: none;" />
                                                &nbsp;<span id="upload_file_name">No File Choosen</span>
                                            </div>
                                            <div class="modal-footer">
                                                <input type="hidden" id="upload_id_doc" />
                                                <button type="button" class="btn btn-success" id="upload_btn_up" data-path="#" data-step="#" data-version="#" data-doc_name="#" data-doc_code="#">
                                                    Upload
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table id="datatables" class="table table-striped table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                        <thead class="table-light">
                                            <tr>
                                                <th>Comment Title</th>
                                                <th>page</th>
                                                <th>Comment by</th>
                                                <th>Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(item, index) in listComment" :key="index">
                                                <td><a href="#" class="text-info fw-bold" @click.prevent="showModal(item)"> {{ item.comment_title }} </a> </td>
                                                <td><span class="fw-bold" v-bind:data-page="item.page_data"> {{ item.page_detail }} </span> </td>
                                                <td><span class="fw-bold">{{ item.created_by }}</span></td>
                                                <td><span class="fw-bold">{{ item.created_at }}</span></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- container-fluid -->
            </div>
            <!-- <div class="modal" id="title_comment_modal" tabindex="-1" role="dialog">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">Comment Title</h5>
                            <button type="button" class="btn-close" @click="closeModal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            masukan
                        </div>
                    </div>
                </div>
            </div> -->
            <div class="modal fade" id="title_comment_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myLargeModalLabel">Comment Title</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row mb-4">
                                <div class="col-md-12">
                                    <label class="form-label">Title</label>
                                    <input type="text" class="form-control" name="description_edit" id="comment_title" required />
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <button type="button" class="btn btn-success" id="saveBtn">Save</button>
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal fade" id="modal-add-document" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title mt-0" id="myLargeModalLabel">
                                <h5 class="modal-title">{{ selectedFile.comment_file }} (by: {{ selectedFile.created_by }})</h5>
                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div style="display: flex; justify-content: center">
                                <button class="btn btn-primary waves-effect waves-light" @click="prevImage" id="prev">Prev</button>
                                <button class="btn btn-primary waves-effect waves-light" @click="nextImage" style="margin-left: 5px" id="next">Next</button>
                            </div>
                            <div class="mt-2" style="overflow: auto;">
                                <img :src="selectedFile.link" alt="File">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-light waves-effect" data-bs-dismiss="modal">Close</button>
                            <!-- <button type="button" class="btn btn-success" id="btn-simpan-doc" title="Add Data" data-object="Project_detail_procurement/add/doc_procurement">Add</button> -->
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
    <script>
        document.addEventListener('DOMContentLoaded', function() {})
        var app = new Vue({
            el: '#app',
            data: {
                isDraw: false,
                weightBrush: 5,
                fontSize: 20,
                isTransparant: true,
                fontColor: '#ff3838',
                isAddText: false,
                typeAction: 'off',
                totalPagePdf: 0,
                currentPage: 1,
                listComment: [],
                selectedFile: {},
                show: false,
                currentIndex: 0,
            },
            methods: {
                toggleDrawingMode: function() {
                    console.log('masuk sini');
                    this.isDraw = !this.isDraw;
                },
                changeFontSize: function(evt) {
                    this.changeFontSize = evt.target.value;
                },
                toggleAddText: function() {
                    // this.isAddText = !this.isAddText;
                    this.typeAction = 'text';
                },
                showModal(item) {
                    console.log(item);
                    this.selectedFile = item;
                    this.show = true;
                    $('#modal-add-document').modal('show');
                },
                closeModal() {
                    this.show = false;
                },
                prevImage() {
                    this.currentIndex = (this.currentIndex - 1 + this.listComment.length) % this.listComment.length;
                    this.selectedFile = this.listComment[this.currentIndex];
                },
                nextImage() {
                    this.currentIndex = (this.currentIndex + 1) % this.listComment.length;
                    this.selectedFile = this.listComment[this.currentIndex];
                },
                colorChanged(evt) {
                    this.fontColor = evt.target.value
                },
                hexToRGBA(hex, alpha) {
                    var r = parseInt(hex.slice(1, 3), 16),
                        g = parseInt(hex.slice(3, 5), 16),
                        b = parseInt(hex.slice(5, 7), 16);

                    return 'rgba(' + r + ', ' + g + ', ' + b + ', ' + alpha + ')';
                },
            },
            mounted: function() {
                // Kode yang akan dijalankan setelah instance Vue di-mount
                console.log('Vue instance has been mounted!');
                const url = "<?= base_url('upload/procurement_doc/list/' . $doc_data[0]->po_filename) ?>";

                function clearCanvas() {
                    canvas.clear();
                    canvas.renderAll();
                }

                //fabric
                var canvas = new fabric.Canvas('canvas');
                canvas.set({
                    selection: false,
                    grid: 10,
                });

                $.ajax({
                    method: 'GET',
                    url: `<?= base_url('Project_detail_engineering/ajax_get_comment/' . $doc_id) ?>`,
                    dataType: "json",
                    contentType: 'application/json; charset=utf-8',
                    delay: 250,
                }).done((resp) => {
                    const baseUrl = '<?= base_url('upload/engineering_doc/comment/') ?>/'
                    const tmp = resp.map(d => ({
                        ...d,
                        link: baseUrl + d.comment_file
                    }))
                    this.listComment = tmp
                    console.log(resp);
                }).fail((err) => {
                    console.log(err);
                })

                function convertDataURIToBlob(dataURI) {
                    var byteString;
                    if (dataURI.split(',')[0].indexOf('base64') >= 0)
                        byteString = atob(dataURI.split(',')[1]);
                    else
                        byteString = unescape(dataURI.split(',')[1]);

                    var mimeString = dataURI.split(',')[0].split(':')[1].split(';')[0];

                    var ia = new Uint8Array(byteString.length);
                    for (var i = 0; i < byteString.length; i++) {
                        ia[i] = byteString.charCodeAt(i);
                    }

                    return new Blob([ia], {
                        type: mimeString
                    });
                }

                $('#update_btn_choose_file').click(function(e) {
                    e.preventDefault(); // Prevent default behavior
                    $('#upload_uploaded_file').trigger('click');
                });

                $('#upload_uploaded_file').change(function() {
                    var fileInput = $(this);
                    var fileName = fileInput.val().split('\\').pop();
                    $('#upload_file_name').text("File Choosen: " + fileName);
                });

                $(document).on('click', '#upload_btn_up', function() {
                    const fileDesc = $(this).data('step');
                    let id_doc, swalTitle;
                    var timerInterval, i, file;
                    var formData = new FormData();

                    id_doc = '<?= $doc_data[0]->id ?>';
                    i = $('#upload_uploaded_file'),
                        file = i[0].files[0];
                    
                    console.log(file, 'fuadi file');
                    console.log(id_doc, 'fuadi id_doc');
                    formData.append('file', file);
                    formData.append('id_doc', id_doc);
                    formData.append('doc_step', '<?= $doc_step ?>');
                    formData.append('doc_name', '<?= $doc_data[0]->activity_name_lvl_1 ?>');
                    formData.append('doc_code', '');
                    formData.append('man_hour_actual', $('#actual_man_hour').val());

                    console.log(formData);

                    swalTitle = 'Upload File?';

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
                                    }).then(() => {
                                        window.history.back();
                                    })
                                },
                                error: err => console.log(err),
                            });
                        }
                    })
                })

                $('#mode').on('change', (evt) => {
                    this.typeAction = evt.target.value;
                    if (this.typeAction === 'freeDraw') {
                        canvas.isDrawingMode = true; // Aktifkan mode menggambar bebas
                        canvas.freeDrawingBrush.color = this.fontColor; // Atur warna kuas
                        canvas.freeDrawingBrush.width = this.weightBrush; // Atur lebar kuas
                    } else {
                        canvas.isDrawingMode = false; // Nonaktifkan mode menggambar bebas jika bukan mode free draw
                    }
                });

                $('#customRange1').on('change', (evt) => {
                    let weightBrush = parseFloat(evt.target.value);
                    canvas.freeDrawingBrush.width = weightBrush; // Atur lebar kuas
                    this.weightBrush = weightBrush;
                });

                $('#colorInput').on('change', (evt) => {
                    canvas.freeDrawingBrush.color = evt.target.value; // Atur lebar kuas
                    canvas.freeDrawingBrush.width = this.weightBrush;; // Atur lebar kuas
                });

                function snapToGrid(object) {
                    object.set({
                        left: Math.round(object.left / 10) * 10,
                        top: Math.round(object.top / 10) * 10
                    });
                }

                $('#addText').on('click', () => {
                    $('#addText').toggleClass('non-active btn-primary');
                });


                canvas.on('mouse:down', (options) => {
                    if (this.typeAction === 'text') {
                        canvas.isDrawingMode = false;
                        if (options.target) {
                            snapToGrid(options.target);
                        } else {
                            var textbox = new fabric.Textbox('Your Text', {
                                width: 100,
                                fontSize: this.fontSize,
                                fill: this.fontColor,
                                left: options.e.clientX - canvas.upperCanvasEl.getBoundingClientRect().left,
                                top: options.e.clientY - canvas.upperCanvasEl.getBoundingClientRect().top,
                            });

                            canvas.add(textbox);
                            snapToGrid(textbox);
                        }

                        canvas.renderAll();
                    } else if (this.typeAction === 'line') {
                        canvas.isDrawingMode = false;
                        // Mulai menggambar garis bebas
                        var pointer = canvas.getPointer(options.e);
                        var points = [pointer.x, pointer.y, pointer.x, pointer.y];
                        var freeDrawLine = new fabric.Line(points, {
                            strokeWidth: 5,
                            stroke: this.fontColor,
                            selectable: false,
                            evented: false, // Agar tidak dapat dipilih atau diubah setelah digambar
                        });

                        canvas.add(freeDrawLine);
                        canvas.renderAll();

                        // Saat mouse digerakkan
                        canvas.on('mouse:move', function(options) {
                            if (freeDrawLine) {
                                var pointer = canvas.getPointer(options.e);
                                freeDrawLine.set({
                                    x2: pointer.x,
                                    y2: pointer.y
                                });
                                canvas.renderAll();
                            }
                        });

                        // Saat mouse dilepas
                        canvas.on('mouse:up', function() {
                            freeDrawLine = null; // Hentikan garis bebas saat mouse dilepas
                            canvas.off('mouse:move'); // Matikan event mouse:move
                            canvas.off('mouse:up'); // Matikan event mouse:up
                        });
                    } else if (this.typeAction === 'square') {
                        if (options.target) {
                            snapToGrid(options.target);
                        } else {
                            // Mendapatkan koordinat klik mouse
                            var pointer = canvas.getPointer(options.e);
                            var x = pointer.x;
                            var y = pointer.y;
                            var rectangle = new fabric.Rect({
                                left: x - 50, // Menyesuaikan posisi untuk membuat bentuk di tengah klik mouse
                                top: y - 50,
                                // fill: this.fontColor,
                                fill: this.isTransparant ? this.hexToRGBA(this.fontColor, 0.3) : this.fontColor,
                                width: 100,
                                height: 100
                            });
                            canvas.add(rectangle);
                            snapToGrid(rectangle);
                        }
                    } else if (this.typeAction === 'circle') {
                        if (options.target) {
                            snapToGrid(options.target);
                        } else {
                            // Mendapatkan koordinat klik mouse
                            var pointer = canvas.getPointer(options.e);
                            var x = pointer.x;
                            var y = pointer.y;
                            var circle = new fabric.Circle({
                                left: x - 50, // Menyesuaikan posisi untuk membuat bentuk di tengah klik mouse
                                top: y - 50,
                                // fill: this.fontColor,
                                fill: this.isTransparant ? this.hexToRGBA(this.fontColor, 0.3) : this.fontColor,
                                radius: 50
                            });
                            canvas.add(circle);
                            snapToGrid(circle);
                        }

                    }
                });

                document.addEventListener('keydown', function(event) {
                    if (event.key === 'Delete') {
                        var activeObject = canvas.getActiveObject();
                        if (activeObject) {
                            canvas.remove(activeObject);
                            canvas.renderAll();
                        }
                    }
                });

                $('#deleteButton').on('click', () => {
                    var activeObject = canvas.getActiveObject();
                    if (activeObject) {
                        canvas.remove(activeObject);
                        canvas.renderAll();
                    }
                });
                // end fabric

                // new render PDF
                PDFJS.getDocument(url).then((pdf) => {
                    // you can now use *pdf* here
                    console.log("the pdf has ", pdf.numPages, "page(s).")
                    this.totalPagePdf = pdf.numPages;
                    pdf.getPage(1).then(function(page) {
                        // you can now use *page* here
                        var viewport = page.getViewport(2.0);
                        var canvasEl = document.querySelector("canvas")
                        canvasEl.height = viewport.height;
                        canvasEl.width = viewport.width;

                        page.render({
                            canvasContext: canvasEl.getContext('2d'),
                            viewport: viewport
                        }).then(function() {

                            var bg = canvasEl.toDataURL("image/png");

                            fabric.Image.fromURL(bg, function(img) {
                                img.scaleToHeight(viewport.height);
                                canvas.setHeight(viewport.height);
                                canvas.setWidth(viewport.width);
                                canvas.setBackgroundImage(img);
                            });
                            canvas.renderAll();
                        });
                    });

                });

                function dataURItoBlob(blob, fileName) {
                    const file = new File([blob], fileName)
                    return file;
                }

                function dataURLtoBlob(dataUrl) {
                    const filename = 'fuadi.png'
                    var arr = dataUrl.split(',');
                    var mime = arr[0].match(/:(.*?);/)[1];
                    var bstr = atob(arr[1]);
                    var n = bstr.length;
                    var u8arr = new Uint8Array(n);
                    while (n--) {
                        u8arr[n] = bstr.charCodeAt(n);
                    }
                    // Create a new File object with the Blob and the filename
                    return new File([new Blob([u8arr], {
                        type: mime
                    })], filename, {
                        type: mime
                    });
                }

                // blob convert
                function dataURItoBlob_1(dataURI) {
                    // Parse the data URI
                    var [metadata, base64Data] = dataURI.split(',');
                    var mimeString = metadata.split(':')[1].split(';')[0];

                    // Decode base64 data
                    var byteCharacters = atob(base64Data);
                    var byteNumbers = new Array(byteCharacters.length);
                    for (var i = 0; i < byteCharacters.length; i++) {
                        byteNumbers[i] = byteCharacters.charCodeAt(i);
                    }
                    var byteArray = new Uint8Array(byteNumbers);

                    // Create Blob
                    return new Blob([byteArray], {
                        type: mimeString
                    });
                }


                function renderPage(pageNum) {
                    clearCanvas()
                    PDFJS.getDocument(url).then(function(pdf) {
                        // you can now use *pdf* here
                        console.log("the pdf has ", pdf.numPages, "page(s).")
                        pdf.getPage(pageNum).then(function(page) {
                            // you can now use *page* here
                            var viewport = page.getViewport(2.0);
                            var canvasEl = document.querySelector("canvas")
                            canvasEl.height = viewport.height;
                            canvasEl.width = viewport.width;

                            page.render({
                                canvasContext: canvasEl.getContext('2d'),
                                viewport: viewport
                            }).then(function() {

                                var bg = canvasEl.toDataURL("image/png");

                                fabric.Image.fromURL(bg, function(img) {
                                    img.scaleToHeight(viewport.height);
                                    canvas.setHeight(viewport.height);
                                    canvas.setWidth(viewport.width);
                                    canvas.setBackgroundImage(img);
                                });
                                canvas.renderAll();
                            });
                        });
                    });
                }

                // changePage (item) {
                //     console.log(item);
                //     console.log(this.currentPage)
                //     renderPage(item);
                // }

                // $('.changePage').on('click', () => {
                //     var dataValue = $(this).data('value');
                //     console.log(dataValue)
                //     this.currentPage = dataValue
                //     renderPage(dataValue);
                // });

                $('.changePage').on('click', () => {
                    var dataValue = $(this).data('value');
                    console.log('Nilai data-value:', dataValue);
                });
                $('#next').on('click', () => {
                    if (this.currentPage === this.totalPagePdf) return;
                    const page = parseInt(this.currentPage, 10) + 1;
                    this.currentPage = page
                    renderPage(page);
                });

                $('#prev').on('click', () => {
                    if (this.currentPage === 1) return;
                    const page = parseInt(this.currentPage, 10) - 1;
                    this.currentPage = page
                    renderPage(page);
                });
                $('#page').on('change', (evt) => {
                    const value = evt.target.value
                    let page;
                    if (value > this.totalPagePdf) {
                        page = this.totalPagePdf
                    } else if (value < 1) {
                        page = 1
                    } else {
                        page = value
                    }
                    this.currentPage = page
                    renderPage(page);
                })
                // end new render pdf


                // download pdf
                document.getElementById('downloadBtn').addEventListener('click', () => {
                    var pdf = new jsPDF();
                    var dataUrl = canvas.toDataURL('image/png');
                    var a = document.createElement('a');
                    a.href = dataUrl;
                    a.download = 'canvas.jpg'; // Nama file yang akan diunduh
                    document.body.appendChild(a); // Menambahkan tautan ke dalam dokumen
                    a.click(); // Klik tautan secara otomatis untuk memulai unduhan
                    document.body.removeChild(a); // Menghapus tautan setelah selesai
                });

                $('#submitBtn').on('click', () => {
                    $('#title_comment_modal').modal('show');
                });

                document.getElementById('saveBtn').addEventListener('click', () => {
                    if ($('#comment_title').val() === '') {
                        Swal.fire({
                            title: 'Error!',
                            icon: 'error',
                            text: 'Title is required!',
                            timer: 1000,
                            confirmButtonColor: "#5664d2",
                        })
                        return;
                    };
                    var pdf = new jsPDF();
                    var dataUrl = canvas.toDataURL('image/png');
                    // Convert data URL to Blob
                    var blob = dataURLtoBlob(dataUrl);
                    var formData = new FormData();
                    formData.append('image', blob, 'image.png');
                    formData.append('id_doc', <?= $doc_id ?>);
                    formData.append('page_detail', this.currentPage);
                    formData.append('comment_title', $('#comment_title').val());
                    console.log(blob);

                    $.ajax({
                        type: 'POST',
                        url: '<?= base_url('Project_detail_engineering/add_comment') ?>',
                        processData: false, // Memproses data menjadi string tidak diperlukan
                        contentType: false, // Jenis konten tidak diperlukan, karena FormData akan mengatur header secara otomatis
                        data: formData,
                        success: (response) => {
                            // Menampilkan respons dari server jika berhasil
                            console.log(response);
                            Swal.fire({
                                title: 'Disimpan!',
                                icon: 'success',
                                text: 'Data berhasil disimpan.',
                                timer: 1000,
                                confirmButtonColor: "#5664d2",
                                onBeforeOpen: () => {
                                    $.ajax({
                                        method: 'GET',
                                        url: `<?= base_url('Project_detail_engineering/ajax_get_comment/' . $doc_id) ?>`,
                                        dataType: "json",
                                        contentType: 'application/json; charset=utf-8',
                                        delay: 250,
                                    }).done((resp) => {
                                        console.log(this.listComment, 'fff')
                                        const baseUrl = '<?= base_url('upload/engineering_doc/comment/') ?>/'
                                        const tmp = resp.map(d => ({
                                            ...d,
                                            link: baseUrl + d.comment_file
                                        }))
                                        this.listComment = tmp
                                        $('#comment_title').val(null)
                                        $('#title_comment_modal').modal('hide');
                                        console.log(resp);
                                    }).fail((err) => {
                                        console.log(err);
                                    })
                                },
                            })
                        },
                        error: function(xhr, status, error) {
                            // Menampilkan pesan kesalahan jika terjadi kesalahan
                            console.error('Terjadi kesalahan: ' + status + ' - ' + error);
                        }
                    });
                });
            }
        });
    </script>
    </body>

    </html>