<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="<?= base_url('dashboard') ?>" class="waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="<?= base_url('karyawan') ?>" class="waves-effect">
                        <i class="ri-group-line"></i>
                    <!-- <i class="fas fa-users"></i> -->
                        <span>Employee Master Data</span>
                    </a>
                </li>

                <!-- list project -->
                <?php $sidebar_data = get_data_list_project(); ?>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-list-line"></i>
                        <span>Project List</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <?php foreach($sidebar_data as $list): ?>
                            <li>
                                <a href="<?= base_url('project-dashboard') ?>">
                                    <?= $list->contract_no ?>
                                </a>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

<script>
    console.log(<?= json_encode(get_data_list_project()) ?>, "SIDEBAR -- LIST PROJECT");
</script>
