<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="/" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="<?= base_url('assets/images/logo-sm-dark.png') ?>" alt="logo-sm-dark" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('assets/images/logo-dark.png') ?>" alt="logo-dark" height="20">
                    </span>
                </a>

                <a href="/" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="<?= base_url('assets/images/logo-sm-light.png') ?>" alt="logo-sm-light" height="22">
                    </span>
                    <span class="logo-lg">
                        <img src="<?= base_url('assets/images/logo-light.png') ?>" alt="logo-light" height="20">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 d-lg-none header-item" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                <i class="ri-menu-2-line align-middle"></i>
            </button>

            <!-- App Search-->
            <form class="app-search d-none d-lg-block">
                <div class="position-relative">
                    <input type="text" class="form-control" placeholder="Search...">
                    <span class="ri-search-line"></span>
                </div>
            </form>

            <div class="dropdown dropdown-mega d-none d-lg-block ms-2">
                <button type="button" class="btn header-item waves-effect" data-bs-toggle="dropdown" aria-haspopup="false" aria-expanded="false">
                    <?= lang('Files.Mega_Menu') ?>
                    <i class="mdi mdi-chevron-down"></i> 
                </button>
                <div class="dropdown-menu dropdown-megamenu">
                    <div class="row">
                        <div class="col-sm-8">
                
                            <div class="row">
                                <div class="col-md-4">
                                    <h5 class="font-size-14 mt-0"><?= lang('Files.UI_Components') ?></h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Lightbox') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Range_Slider') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Sweet_Alert') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Rating') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Forms') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Tables') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Charts') ?></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <h5 class="font-size-14 mt-0"><?= lang('Files.Applications') ?></h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Ecommerce') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Calendar') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Email') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Projects') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Tasks') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Contacts') ?></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-md-4">
                                    <h5 class="font-size-14 mt-0"><?= lang('Files.Extra_Pages') ?></h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Light_Sidebar') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Compact_Sidebar') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Horizontal_layout') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Maintenance') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Coming_Soon') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Timeline') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.FAQs') ?></a>
                                        </li>
                                        
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <div class="row">
                                <div class="col-sm-6">
                                    <h5 class="font-size-14 mt-0"><?= lang('Files.UI_Components') ?></h5>
                                    <ul class="list-unstyled megamenu-list">
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Lightbox') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Range_Slider') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Sweetalert_2') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Rating') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Forms') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Tables') ?></a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0);"><?= lang('Files.Charts') ?></a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="col-sm-5">
                                    <div>
                                        <img src="<?= base_url('assets/images/megamenu-img.png" alt="megamenu-img') ?>" class="img-fluid mx-auto d-block">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">
                    
                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i></button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <?php
                        $session = \Config\Services::session();
                        $lang = $session->get('lang');
                        switch($lang){
                            case 'en':
                                echo '<img src="'.base_url('assets/images/flags/us.jpg').'" alt="Header Language" height="16">';
                            break;
                            case 'fr':
                                echo '<img src="'.base_url('assets/images/flags/french.jpg').'" alt="Header Language" height="16"> ';
                            break;
                            case 'es':
                                echo '<img src="'.base_url('assets/images/flags/spain.jpg').'" alt="Header Language" height="16"> ';
                            break;
                            case 'de':
                                echo '<img src="'.base_url('assets/images/flags/germany.jpg').'" alt="Header Language" height="16"> ';
                            break;
                            case 'it':
                                echo '<img src="'.base_url('assets/images/flags/italy.jpg').'" alt="Header Language" height="16"> ';
                            break;
                            case 'ru':
                                echo '<img src="'.base_url('assets/images/flags/russia.jpg').'" alt="Header Language" height="16"> ';
                            break;
                            default:
                                echo '<img src="'.base_url('assets/images/flags/us.jpg').'" alt="Header Language" height="16"> ';
                        }
                    ?>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    
                    <!-- item-->
                   <a href="<?= base_url('lang/en'); ?>" class="dropdown-item notify-item">
                        <img src="<?= base_url('assets/images/flags/us.jpg') ?>" alt="user-image" class="me-1" height="12"> <span class="align-middle"> English </span>
                    </a>

                    <!-- item-->
                    <a href="<?= base_url('lang/de'); ?>" class="dropdown-item notify-item">
                        <img src="<?= base_url('assets/images/flags/germany.jpg') ?>" alt="user-image" class="me-1" height="12"> <span class="align-middle"> German </span>
                    </a>

                    <!-- item-->
                    <a href="<?= base_url('lang/it'); ?>" class="dropdown-item notify-item">
                        <img src="<?= base_url('assets/images/flags/italy.jpg') ?>" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Italian </span>
                    </a>

                    <!-- item-->
                    <a href="<?= base_url('lang/fr'); ?>" class="dropdown-item notify-item">
                        <img src="<?= base_url('assets/images/flags/french.jpg') ?>" alt="user-image" class="me-1" height="12"> <span class="align-middle"> French </span>
                    </a>

                    <!-- item-->
                    <a href="<?= base_url('lang/es'); ?>" class="dropdown-item notify-item">
                        <img src="<?= base_url('assets/images/flags/spain.jpg') ?>" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Spanish </span>
                    </a>

                     <!-- item-->
                     <a href="<?= base_url('lang/ru'); ?>" class="dropdown-item notify-item">
                        <img src="<?= base_url('assets/images/flags/russia.jpg') ?>" alt="user-image" class="me-1" height="12"> <span class="align-middle"> Russian </span>
                    </a>
                    
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-apps-2-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end">
                    <div class="px-lg-2">
                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?= base_url('assets/images/brands/github.png') ?>" alt="Github">
                                    <span>GitHub</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?= base_url('assets/images/brands/bitbucket.png') ?>" alt="bitbucket">
                                    <span>Bitbucket</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?= base_url('assets/images/brands/dribbble.png') ?>" alt="dribbble">
                                    <span>Dribbble</span>
                                </a>
                            </div>
                        </div>

                        <div class="row g-0">
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?= base_url('assets/images/brands/dropbox.png') ?>" alt="dropbox">
                                    <span>Dropbox</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?= base_url('assets/images/brands/mail_chimp.png') ?>" alt="mail_chimp">
                                    <span>Mail Chimp</span>
                                </a>
                            </div>
                            <div class="col">
                                <a class="dropdown-icon-item" href="#">
                                    <img src="<?= base_url('assets/images/brands/slack.png') ?>" alt="slack">
                                    <span>Slack</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-notifications-dropdown"
                      data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="ri-notification-3-line"></i>
                    <span class="noti-dot"></span>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications </h6>
                            </div>
                            <div class="col-auto">
                                <a href="#!" class="small"> View All</a>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-primary rounded-circle font-size-16">
                                        <i class="ri-shopping-cart-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mt-0 mb-1">Your order is placed</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="<?= base_url('assets/images/users/avatar-3.jpg') ?>"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mt-0 mb-1">James Lemire</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">It will seem like simplified English.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <div class="avatar-xs me-3">
                                    <span class="avatar-title bg-success rounded-circle font-size-16">
                                        <i class="ri-checkbox-circle-line"></i>
                                    </span>
                                </div>
                                <div class="flex-1">
                                    <h6 class="mt-0 mb-1">Your item is shipped</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">If several languages coalesce the grammar</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 3 min ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>

                        <a href="" class="text-reset notification-item">
                            <div class="d-flex">
                                <img src="<?= base_url('assets/images/users/avatar-4.jpg') ?>"
                                    class="me-3 rounded-circle avatar-xs" alt="user-pic">
                                <div class="flex-1">
                                    <h6 class="mt-0 mb-1">Salena Layfield</h6>
                                    <div class="font-size-12 text-muted">
                                        <p class="mb-1">As a skeptical Cambridge friend of mine occidental.</p>
                                        <p class="mb-0"><i class="mdi mdi-clock-outline"></i> 1 hours ago</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">
                            <a class="btn btn-sm btn-link font-size-14 text-center" href="javascript:void(0)">
                                <i class="mdi mdi-arrow-right-circle me-1"></i> View More..
                            </a>
                        </div>
                    </div>
                </div>
            </div>


            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user" src="<?= base_url('assets/images/users/avatar-2.jpg') ?>"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">Kevin</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="#"><i class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="#"><i class="ri-wallet-2-line align-middle me-1"></i> My Wallet</a>
                    <a class="dropdown-item d-block" href="#"><span class="badge bg-success float-end mt-1">11</span><i class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i> Lock screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="#"><i class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon right-bar-toggle waves-effect">
                    <i class="ri-settings-2-line"></i>
                </button>
            </div>
            
        </div>
    </div>
</header>
    
    <div class="topnav">
        <div class="container-fluid">
            <nav class="navbar navbar-light navbar-expand-lg topnav-menu">
    
                <div class="collapse navbar-collapse" id="topnav-menu-content">
                    <ul class="navbar-nav">

                        <li class="nav-item">
                            <a class="nav-link" href="/">
                                <i class="ri-dashboard-line me-2"></i> <?= lang('Files.Dashboard') ?>
                            </a>
                        </li>
    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-uielement" role="button"
                            >
                                <i class="ri-pencil-ruler-2-line me-2"></i><?= lang('Files.UI_Elements') ?> <div class="arrow-down"></div>
                            </a>

                            <div class="dropdown-menu mega-dropdown-menu px-2 dropdown-mega-menu-xl"
                                aria-labelledby="topnav-uielement">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-alerts" class="dropdown-item"><?= lang('Files.Alerts') ?></a>
                                            <a href="ui-buttons" class="dropdown-item"><?= lang('Files.Buttons') ?></a>
                                            <a href="ui-cards" class="dropdown-item"><?= lang('Files.Cards') ?></a>
                                            <a href="ui-carousel" class="dropdown-item"><?= lang('Files.Carousel') ?></a>
                                            <a href="ui-dropdowns" class="dropdown-item"><?= lang('Files.Dropdowns') ?></a>
                                            <a href="ui-grid" class="dropdown-item"><?= lang('Files.Grid') ?></a>
                                            <a href="ui-images" class="dropdown-item"><?= lang('Files.Images') ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-lightbox" class="dropdown-item"><?= lang('Files.Lightbox') ?></a>
                                            <a href="ui-modals" class="dropdown-item"><?= lang('Files.Modals') ?></a>
                                            <a href="ui-rangeslider" class="dropdown-item"><?= lang('Files.Range_Slider') ?></a>
                                            <a href="ui-roundslider" class="dropdown-item"><?= lang('Files.Round_Slider') ?></a>
                                            <a href="ui-session-timeout" class="dropdown-item"><?= lang('Files.Session_Timeout') ?></a>
                                            <a href="ui-progressbars" class="dropdown-item"><?= lang('Files.Progress_Bars') ?></a>
                                            <a href="ui-sweet-alert" class="dropdown-item"><?= lang('Files.Sweetalert_2') ?></a>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div>
                                            <a href="ui-tabs-accordions" class="dropdown-item"><?= lang('Files.Tabs_and_Accordions') ?></a>
                                            <a href="ui-typography" class="dropdown-item"><?= lang('Files.Typography') ?></a>
                                            <a href="ui-video" class="dropdown-item"><?= lang('Files.Video') ?></a>
                                            <a href="ui-general" class="dropdown-item"><?= lang('Files.General') ?></a>
                                            <a href="ui-rating" class="dropdown-item"><?= lang('Files.Rating') ?></a>
                                            <a href="ui-notifications" class="dropdown-item"><?= lang('Files.Notifications') ?></a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </li>
    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-apps" role="button"
                            >
                                <i class="ri-apps-2-line me-2"></i><?= lang('Files.Apps') ?> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-apps">

                                <a href="calendar" class="dropdown-item"><?= lang('Files.Calendar') ?></a>
                                <a href="apps-chat" class="dropdown-item"><?= lang('Files.Chat') ?></a>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-email"
                                        role="button">
                                        <?= lang('Files.Email') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-email">
                                        <a href="email-inbox" class="dropdown-item"><?= lang('Files.Inbox') ?></a>
                                        <a href="email-read" class="dropdown-item"><?= lang('Files.Read_Email') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-ecommerce"
                                        role="button">
                                        <?= lang('Files.Ecommerce') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-ecommerce">
                                        <a href="ecommerce-products" class="dropdown-item"><?= lang('Files.Products') ?></a>
                                        <a href="ecommerce-product-detail" class="dropdown-item"><?= lang('Files.Product_Detail') ?></a>
                                        <a href="ecommerce-orders" class="dropdown-item"><?= lang('Files.Orders') ?></a>
                                        <a href="ecommerce-customers" class="dropdown-item"><?= lang('Files.Customers') ?></a>
                                        <a href="ecommerce-cart" class="dropdown-item"><?= lang('Files.Cart') ?></a>
                                        <a href="ecommerce-checkout" class="dropdown-item"><?= lang('Files.Checkout') ?></a>
                                        <a href="ecommerce-shops" class="dropdown-item"><?= lang('Files.Shops') ?></a>
                                        <a href="ecommerce-add-product" class="dropdown-item"><?= lang('Files.Add_Product') ?></a>
                                    </div>
                                </div>

                                <a href="apps-kanban-board" class="dropdown-item"><?= lang('Files.Kanban_Board') ?> </a>
                            </div>
                        </li>
    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-components" role="button"
                            >
                                <i class="ri-stack-line me-2"></i><?= lang('Files.Components') ?> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-components">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-form"
                                        role="button">
                                        <?= lang('Files.Forms') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-form">
                                        <a href="form-elements" class="dropdown-item"><?= lang('Files.Elements') ?></a>
                                        <a href="form-validation" class="dropdown-item"><?= lang('Files.Validation') ?></a>
                                        <a href="form-advanced" class="dropdown-item"><?= lang('Files.Advanced_Plugins') ?></a>
                                        <a href="form-editors" class="dropdown-item"><?= lang('Files.Editors') ?></a>
                                        <a href="form-uploads" class="dropdown-item"><?= lang('Files.File_Upload') ?></a>
                                        <a href="form-xeditable" class="dropdown-item"><?= lang('Files.X_editable') ?></a>
                                        <a href="form-wizard" class="dropdown-item"><?= lang('Files.Wizard') ?></a>
                                        <a href="form-mask" class="dropdown-item"><?= lang('Files.Mask') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-table"
                                        role="button">
                                        <?= lang('Files.Tables') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-table">
                                        <a href="tables-basic" class="dropdown-item"><?= lang('Files.Basic_Tables') ?></a>
                                        <a href="tables-datatable" class="dropdown-item"><?= lang('Files.Data_Tables') ?></a>
                                        <a href="tables-responsive" class="dropdown-item"><?= lang('Files.Responsive_Table') ?></a>
                                        <a href="tables-editable" class="dropdown-item"><?= lang('Files.Editable_Table') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-charts"
                                        role="button">
                                        <?= lang('Files.Charts') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-charts">
                                        <a href="charts-apex" class="dropdown-item"><?= lang('Files.Apex_Charts') ?></a>
                                        <a href="charts-chartjs" class="dropdown-item"><?= lang('Files.Chartjs') ?></a>
                                        <a href="charts-flot" class="dropdown-item"><?= lang('Files.Flot') ?></a>
                                        <a href="charts-knob" class="dropdown-item"><?= lang('Files.Jquery_Knob') ?></a>
                                        <a href="charts-sparkline" class="dropdown-item"><?= lang('Files.Sparkline') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-icons"
                                        role="button">
                                        <?= lang('Files.Icons') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-icons">
                                        <a href="icons-remix" class="dropdown-item"><?= lang('Files.Remix_Icons') ?></a>
                                        <a href="icons-materialdesign" class="dropdown-item"><?= lang('Files.Material_Design') ?></a>
                                        <a href="icons-dripicons" class="dropdown-item"><?= lang('Files.Dripicons') ?></a>
                                        <a href="icons-fontawesome" class="dropdown-item"><?= lang('Files.Font_awesome_5') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-map"
                                        role="button">
                                        <?= lang('Files.Maps') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-map">
                                        <a href="maps-google" class="dropdown-item"><?= lang('Files.Google_Maps') ?></a>
                                        <a href="maps-vector" class="dropdown-item"><?= lang('Files.Vector_Maps') ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>
    
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-more" role="button"
                            >
                                <i class="ri-file-copy-2-line me-2"></i><?= lang('Files.Pages') ?> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-more">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-auth"
                                        role="button">
                                        <?= lang('Files.Authentication') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-auth">
                                        <a href="auth-login" class="dropdown-item"><?= lang('Files.Login') ?></a>
                                        <a href="auth-register" class="dropdown-item"><?= lang('Files.Register') ?></a>
                                        <a href="auth-recoverpw" class="dropdown-item"><?= lang('Files.Recover_Password') ?></a>
                                        <a href="auth-lock-screen" class="dropdown-item"><?= lang('Files.Lock_Screen') ?></a>
                                    </div>
                                </div>
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-utility"
                                        role="button">
                                        <?= lang('Files.Utility') ?> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-utility">
                                        <a href="pages-starter" class="dropdown-item"><?= lang('Files.Starter_Page') ?></a>
                                        <a href="pages-maintenance" class="dropdown-item"><?= lang('Files.Maintenance') ?></a>
                                        <a href="pages-comingsoon" class="dropdown-item"><?= lang('Files.Coming_Soon') ?></a>
                                        <a href="pages-timeline" class="dropdown-item"><?= lang('Files.Timeline') ?></a>
                                        <a href="pages-faqs" class="dropdown-item"><?= lang('Files.FAQs') ?></a>
                                        <a href="pages-pricing" class="dropdown-item"><?= lang('Files.Pricing') ?></a>
                                        <a href="pages-404" class="dropdown-item"><?= lang('Files.Error_404') ?></a>
                                        <a href="pages-500" class="dropdown-item"><?= lang('Files.Error_500') ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>

                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle arrow-none" href="#" id="topnav-layout" role="button">
                                <i class="ri-layout-3-line me-2"></i><span key="t-layouts"><?= lang('Files.Layouts') ?></span> <div class="arrow-down"></div>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="topnav-layout">
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-layout-verti"
                                        role="button">
                                        <span key="t-vertical"><?= lang('Files.Vertical') ?></span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-layout-verti">
                                        <a href="layouts-light-sidebar" class="dropdown-item" key="t-light-sidebar"><?= lang('Files.Light_Sidebar') ?></a>
                                        <a href="layouts-compact-sidebar" class="dropdown-item" key="t-compact-sidebar"><?= lang('Files.Compact_Sidebar') ?></a>
                                        <a href="layouts-icon-sidebar" class="dropdown-item" key="t-icon-sidebar"><?= lang('Files.Icon_Sidebar') ?></a>
                                        <a href="layouts-boxed" class="dropdown-item" key="t-boxed-width"><?= lang('Files.Boxed_Width') ?></a>
                                        <a href="layouts-preloader" class="dropdown-item" key="t-preloader"><?= lang('Files.Preloader') ?></a>
                                        <a href="layouts-colored-sidebar" class="dropdown-item" key="t-colored-sidebar"><?= lang('Files.Colored_Sidebar') ?></a>
                                    </div>
                                </div>
    
                                <div class="dropdown">
                                    <a class="dropdown-item dropdown-toggle arrow-none" href="#" id="topnav-layout-hori"
                                        role="button">
                                        <span key="t-horizontal"><?= lang('Files.Horizontal') ?></span> <div class="arrow-down"></div>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="topnav-layout-hori">
                                        <a href="layouts-horizontal" class="dropdown-item" key="t-horizontal"><?= lang('Files.Horizontal') ?></a>
                                        <a href="layouts-hori-topbar-light" class="dropdown-item" key="t-topbar-light"><?= lang('Files.Topbar_light') ?></a>
                                        <a href="layouts-hori-boxed-width" class="dropdown-item" key="t-boxed-width"><?= lang('Files.Boxed_width') ?></a>
                                        <a href="layouts-hori-preloader" class="dropdown-item" key="t-preloader"><?= lang('Files.Preloader') ?></a>
                                        <a href="layouts-hori-colored-header" class="dropdown-item" key="t-colored-topbar"><?= lang('Files.Colored_Header') ?></a>
                                    </div>
                                </div>
                            </div>
                        </li>
    
                    </ul>
                </div>
            </nav>
        </div>
    </div>