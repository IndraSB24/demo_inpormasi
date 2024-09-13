<!-- start page title -->
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <div>

                <h2 class="mb-sm-0"><?= $pagetitle ?></h2>
                <h4 style="color:#999999"><?= isset($subtitle) ? $subtitle : '' ?></h4>
            </div>

            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);"><?= $title ?></a></li>
                    <li class="breadcrumb-item active"><?= $pagetitle ?></li>
                </ol>
            </div>

        </div>
    </div>
</div>
<!-- end page title -->
