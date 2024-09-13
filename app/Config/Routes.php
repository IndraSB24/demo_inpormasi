<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php'))
{
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Landing');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

// Auth 
$routes->get('/', 'Landing::index');
$routes->get('login', 'Auth::login');
//$routes->get('dashboard', 'Home::index', ['filter' => 'filter_is_login']);
$routes->get('dashboard', 'Home::index');
$routes->get('karyawan', 'Karyawan::index');
$routes->get('karyawan-doc/(:segment)', 'Karyawan_doc_role::index/$1');
$routes->get('project-list', 'Home::show_project_list');
$routes->get('document-list', 'Home::show_document_list');

// Home
$routes->get('dashboard-get-project-list', 'Home::get_datatable');
$routes->put('submitPdf', 'Project_detail_engineering::add_comment');

// Project
$routes->get('project-dashboard', 'Project::index');
$routes->get('project-add', 'Project::add');
$routes->get('project-show-over-prog-month', 'Project::show_over_prog_month_detail');

// Project Detail Engineering Doc
$routes->get('engineering-dashboard', 'Project_detail_engineering::index');
$routes->get('document-timeline/(:segment)', 'Project_detail_engineering::show_doc_timeline/$1');
$routes->get('commentPdf/(:segment)/(:segment)/(:segment)', 'Project_detail_engineering::show_pdf/$1/$2/$3');
$routes->get('commentPdf/(:segment)/(:segment)', 'Project_detail_engineering::show_pdf/$1/$2');
$routes->get('reupload/(:segment)', 'Project_detail_engineering::show_pdf_reupload/$1');
$routes->get('reupload_procurement/(:segment)/(:segment)', 'Project_detail_procurement::show_pdf_reupload/$1/$2');
// $routes->get('document-timeline', 'Project_detail_engineering::show_doc_timeline');
$routes->get('show', 'Project_detail_engineering@show');
$routes->get('engineering-doc-list/(:segment)', 'Project_detail_engineering::show_doc_list/$1');

// Project Detail Procurement Doc
$routes->get('procurement-dashboard', 'Project_detail_procurement::index');
$routes->get('document-timeline-procurement/(:segment)', 'Project_detail_procurement::show_doc_timeline/$1');
$routes->get('procurement-doc-list/(:segment)', 'Project_detail_procurement::show_doc_list/$1');
$routes->get('commentPdfProcurement/(:segment)/(:segment)/(:segment)', 'Project_detail_procurement::show_pdf/$1/$2/$3');
$routes->get('commentPdfProcurement/(:segment)/(:segment)', 'Project_detail_procurement::show_pdf/$1/$2');

// contruction
$routes->get('construction-dashboard', 'Project_detail_construction::index');
$routes->get('construction-doc-list/(:segment)', 'Project_detail_construction::show_doc_list/$1');
$routes->get('measurement_basis_list', 'Project_detail_construction::measurement_basis_list');









// Language
$routes->get('/lang/{locale}', 'Language::index');

// // Vertical Layout Pages Routes
$routes->get('layouts-light-sidebar', 'Home::show_layout_light_sidebar');
$routes->get('layouts-compact-sidebar', 'Home::show_layout_compact_sidebar');
$routes->get('layouts-icon-sidebar', 'Home::show_layout_icon_sidebar');
$routes->get('layouts-boxed', 'Home::show_layout_boxed');
$routes->get('layouts-preloader', 'Home::show_layout_preloader');
$routes->get('layouts-colored-sidebar', 'Home::show_layout_colored');

// Horizontal Layout Pages Routes
$routes->get('layouts-horizontal', 'Home::show_layouts_horizontal');
$routes->get('layouts-hori-topbar-light', 'Home::show_layouts_hori_topbar_light');
$routes->get('layouts-hori-boxed-width', 'Home::show_layouts_hori_boxed_width');
$routes->get('layouts-hori-preloader', 'Home::show_layouts_hori_preloader');
$routes->get('layouts-hori-colored-header', 'Home::show_layouts_hori_colored_header');

// Vertical and Horizontal Layout RTL and DARK Layout
$routes->get('vertical-rtl', 'Home::show_vertical_rtl');
$routes->get('vertical-dark', 'Home::show_vertical_dark');
$routes->get('horizontal-rtl', 'Home::show_horizontal_rtl');
$routes->get('horizontal-dark', 'Home::show_horizontal_dark');

// // Calender
$routes->get('calendar', 'Home::show_calendar');

// // Chat
$routes->get('apps-chat', 'Home::show_apps_chat');

// // Ecommerce
$routes->get('ecommerce-products', 'Home::show_ecommerce_products');
$routes->get('ecommerce-product-detail', 'Home::show_ecommerce_product_detail');
$routes->get('ecommerce-orders', 'Home::show_ecommerce_orders');
$routes->get('ecommerce-customers', 'Home::show_ecommerce_customers');
$routes->get('ecommerce-cart', 'Home::show_ecommerce_cart');
$routes->get('ecommerce-checkout', 'Home::show_ecommerce_checkout');
$routes->get('ecommerce-shops', 'Home::show_ecommerce_shops');
$routes->get('ecommerce-add-product', 'Home::show_ecommerce_add_product');

// // Email
$routes->get('email-inbox', 'Home::show_email_inbox');
$routes->get('email-read', 'Home::show_email_read');

//kanban-board
$routes->get('apps-kanban-board', 'Home::show_apps_kanban_board');

//Authentication
$routes->get('auth-login', 'Home::show_pages_login');
$routes->get('auth-register', 'Home::show_pages_register');
$routes->get('auth-recoverpw', 'Home::show_pages_recoverpw');
$routes->get('auth-lock-screen', 'Home::show_pages_lock_screen');

// // Utility
$routes->get('pages-starter', 'Home::show_pages_starter');
$routes->get('pages-maintenance', 'Home::show_pages_maintenance');
$routes->get('pages-comingsoon', 'Home::show_pages_comingsoon');
$routes->get('pages-timeline', 'Home::show_pages_timeline');
$routes->get('pages-faqs', 'Home::show_pages_faqs');
$routes->get('pages-pricing', 'Home::show_pages_pricing');
$routes->get('pages-404', 'Home::show_pages_404');
$routes->get('pages-500', 'Home::show_pages_500');

// // User Interface
$routes->get('ui-alerts', 'Home::show_ui_alerts');
$routes->get('ui-buttons', 'Home::show_ui_buttons');
$routes->get('ui-cards', 'Home::show_ui_cards');
$routes->get('ui-carousel', 'Home::show_ui_carousel');
$routes->get('ui-dropdowns', 'Home::show_ui_dropdowns');
$routes->get('ui-grid', 'Home::show_ui_grid');
$routes->get('ui-images', 'Home::show_ui_images');
$routes->get('ui-lightbox', 'Home::show_ui_lightbox');
$routes->get('ui-modals', 'Home::show_ui_modals');
$routes->get('ui-rangeslider', 'Home::show_ui_rangeslider');
$routes->get('ui-roundslider', 'Home::show_ui_roundslider');
$routes->get('ui-session-timeout', 'Home::show_ui_sessiontimeout');
$routes->get('ui-progressbars', 'Home::show_ui_progressbars');
$routes->get('ui-sweet-alert', 'Home::show_ui_sweet_alert');
$routes->get('ui-tabs-accordions', 'Home::show_ui_tabs_accordions');
$routes->get('ui-typography', 'Home::show_ui_typography');
$routes->get('ui-video', 'Home::show_ui_video');
$routes->get('ui-general', 'Home::show_ui_general');
$routes->get('ui-rating', 'Home::show_ui_rating');
$routes->get('ui-notifications', 'Home::show_ui_notifications');

// // Forms
$routes->get('form-elements', 'Home::show_form_elements');
$routes->get('form-validation', 'Home::show_form_validation');
$routes->get('form-advanced', 'Home::show_form_advanced');
$routes->get('form-editors', 'Home::show_form_editors');
$routes->get('form-uploads', 'Home::show_form_uploads');
$routes->get('form-xeditable', 'Home::show_form_xeditable');
$routes->get('form-wizard', 'Home::show_form_wizard');
$routes->get('form-mask', 'Home::show_form_mask');

// // Tables
$routes->get('tables-basic', 'Home::show_tables_basic');
$routes->get('tables-datatable', 'Home::show_tables_datatable');
$routes->get('tables-responsive', 'Home::show_tables_responsive');
$routes->get('tables-editable', 'Home::show_tables_editable');

// // // Charts
$routes->get('charts-apex', 'Home::show_charts_apex');
$routes->get('charts-chartjs', 'Home::show_charts_chartjs');
$routes->get('charts-flot', 'Home::show_charts_flot');
$routes->get('charts-knob', 'Home::show_charts_other');
$routes->get('charts-sparkline', 'Home::show_charts_sparkline');



// // // Icons
$routes->get('icons-remix', 'Home::show_icons_remix');
$routes->get('icons-materialdesign', 'Home::show_icons_material');
$routes->get('icons-dripicons', 'Home::show_icons_dripicons');
$routes->get('icons-fontawesome', 'Home::show_icons_fontawesome');

// // // Maps
$routes->get('maps-google', 'Home::show_maps_google');
$routes->get('maps-vector', 'Home::show_maps_vector');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
