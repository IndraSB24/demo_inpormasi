<?php

namespace App\Controllers;

class Landing extends BaseController
{
    
    public function index()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Login'])
		];
		return view('auth-login', $data);
	}

	public function show_pages_register()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Register'])
		];
		return view('auth-register', $data);
	}

	public function show_pages_recoverpw()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Recover_Password'])
		];
		return view('auth-recoverpw', $data);
	}

	public function show_pages_lock_screen()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Lock_Screen'])
		];
		return view('auth-lock-screen', $data);
	}

	public function login()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Overal', 'pagetitle' => 'Dashboard'])
		];
		return view('index', $data);
	}
	
	public function show_project_list()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Project List']),
			'page_title' => view('partials/page-title', ['title' => 'Project', 'pagetitle' => 'Project List'])
		];
		return view('project-list', $data);
	}
	
	public function show_document_list()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Document List']),
			'page_title' => view('partials/page-title', ['title' => 'Document', 'pagetitle' => 'Document List'])
		];
		return view('document-list', $data);
	}

	// Vertical Layout Pages Routes
	public function show_layout_light_sidebar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Light_Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Light Sidebar'])
		];
		return view('layouts-light-sidebar', $data);
	}

	public function show_layout_compact_sidebar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Compact_Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Compact Sidebar'])
		];
		return view('layouts-compact-sidebar', $data);
	}

	public function show_layout_icon_sidebar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Icon_Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Icon Sidebar'])
		];
		return view('layouts-icon-sidebar', $data);
	}

	public function show_layout_boxed()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxed_Width']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Boxed Layout'])
		];
		return view('layouts-boxed', $data);
	}

	public function show_layout_preloader()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Preloader']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Preloader'])
		];
		return view('layouts-preloader', $data);
	}

	public function show_layout_colored()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Colored_Header']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Colored Sidebar'])
		];
		return view('layouts-colored-sidebar', $data);
	}

	// Horizontal Layout Pages Routes
	public function show_layouts_horizontal()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Horizontal']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Horizontal Layout'])
		];
		return view('layouts-horizontal', $data);
	}

	public function show_layouts_hori_topbar_light()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Topbar_light']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Horizontal Topbar Light'])
		];
		return view('layouts-hori-topbar-light', $data);
	}

	public function show_layouts_hori_boxed_width()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Boxed_Width']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Boxed Layout'])
			
		];
		return view('layouts-hori-boxed-width', $data);
	}

	public function show_layouts_hori_preloader()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Preloader']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Horizontal Preloader Layout'])
			
		];
		return view('layouts-hori-preloader', $data);
	}

	public function show_layouts_hori_colored_header()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Colored_Sidebar']),
			'page_title' => view('partials/page-title', ['title' => 'Layouts', 'pagetitle' => 'Horizontal Topbar Colored'])
			
		];
		return view('layouts-hori-colored-header', $data);
	}

	// Vertical and Horizontal Layout RTL and DARK Layout
	public function show_vertical_rtl()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'RTL'])
		];
		return view('vertical-rtl', $data);
	}

	public function show_vertical_dark()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Dark'])
		];
		return view('vertical-dark', $data);
	}

	public function show_horizontal_rtl()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Horizontal RTL'])
		];
		return view('horizontal-rtl', $data);
	}

	public function show_horizontal_dark()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dashboard']),
			'page_title' => view('partials/page-title', ['title' => 'Dashboard', 'pagetitle' => 'Horizontal Dark'])
		];
		return view('horizontal-dark', $data);
	}

	// UI Elements
	public function show_ui_buttons()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Buttons']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Buttons'])
		];
		return view('ui-buttons', $data);
	}

	public function show_ui_cards()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Cards']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Cards'])
		];
		return view('ui-cards', $data);
	}

	public function show_ui_tabs_accordions()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Tabs_and_Accordions']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Tabs & Accordions'])
		];
		return view('ui-tabs-accordions', $data);
	}

	public function show_ui_modals()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Modals']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Modals'])
		];
		return view('ui-modals', $data);
	}

	public function show_ui_rangeslider()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Range_Slider']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Range Slider'])
		];
		return view('ui-rangeslider', $data);
	}

	public function show_ui_roundslider()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Round_Slider']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Round slider'])
		];
		return view('ui-roundslider', $data);
	}

	public function show_ui_images()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Images']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Images'])
		];
		return view('ui-images', $data);
	}

	public function show_ui_alerts()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Alerts']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Alerts'])
		];
		return view('ui-alerts', $data);
	}

	public function show_ui_progressbars()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Progress_Bars']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Progress Bars'])
		];
		return view('ui-progressbars', $data);
	}

	public function show_ui_dropdowns()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dropdowns']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Dropdowns'])
		];
		return view('ui-dropdowns', $data);
	}

	public function show_ui_lightbox()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Lightbox']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Lightbox'])
		];
		return view('ui-lightbox', $data);
	}

	public function show_ui_carousel()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Carousel']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Carousel'])
		];
		return view('ui-carousel', $data);
	}

	public function show_ui_video()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Video']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Video'])
		];
		return view('ui-video', $data);
	}

	public function show_ui_typography()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Typography']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Typography'])
		];
		return view('ui-typography', $data);
	}

	public function show_ui_general()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'General']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'General'])
		];
		return view('ui-general', $data);
	}

	public function show_ui_sweet_alert()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Sweetalert_2']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Sweetalert 2'])
		];
		return view('ui-sweet-alert', $data);
	}

	public function show_ui_grid()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Grid']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Grid'])
		];
		return view('ui-grid', $data);
	}

	// Email
	public function show_email_inbox()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Inbox']),
			'page_title' => view('partials/page-title', ['title' => 'Email', 'pagetitle' => 'Inbox'])
		];
		return view('email-inbox', $data);
	}

	public function show_email_read()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Read_Email']),
			'page_title' => view('partials/page-title', ['title' => 'Email', 'pagetitle' => 'Read Email'])
		];
		return view('email-read', $data);
	}

	// Calender
	public function show_calendar()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Calendar']),
			'page_title' => view('partials/page-title', ['title' => 'Nazox', 'pagetitle' => 'Calendar'])
		];
		return view('calendar', $data);
	}

	// Ecommerce
	public function show_ecommerce_products()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Products']),
			'page_title' => view('partials/page-title', ['title' => 'Ecommerce', 'pagetitle' => 'Products'])
		];
		return view('ecommerce-products', $data);
	}

	public function show_ecommerce_product_detail()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Product_Detail']),
			'page_title' => view('partials/page-title', ['title' => 'Ecommerce', 'pagetitle' => 'Product Detail'])
		];
		return view('ecommerce-product-detail', $data);
	}

	public function show_ecommerce_orders()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Orders']),
			'page_title' => view('partials/page-title', ['title' => 'Ecommerce', 'pagetitle' => 'Orders'])
		];
		return view('ecommerce-orders', $data);
	}

	public function show_ecommerce_customers()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Customers']),
			'page_title' => view('partials/page-title', ['title' => 'Ecommerce', 'pagetitle' => 'Customers'])
		];
		return view('ecommerce-customers', $data);
	}

	public function show_ecommerce_cart()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Cart']),
			'page_title' => view('partials/page-title', ['title' => 'Ecommerce', 'pagetitle' => 'Cart'])
		];
		return view('ecommerce-cart', $data);
	}

	public function show_ecommerce_checkout()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Checkout']),
			'page_title' => view('partials/page-title', ['title' => 'Ecommerce', 'pagetitle' => 'Checkout'])
		];
		return view('ecommerce-checkout', $data);
	}

	public function show_ecommerce_shops()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Shops']),
			'page_title' => view('partials/page-title', ['title' => 'Ecommerce', 'pagetitle' => 'Shops'])
		];
		return view('ecommerce-shops', $data);
	}

	public function show_ecommerce_add_product()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Add_Product']),
			'page_title' => view('partials/page-title', ['title' => 'Ecommerce', 'pagetitle' => 'Add Product'])
		];
		return view('ecommerce-add-product', $data);
	}

	//Kanban Board
	public function show_apps_kanban_board()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Kanban_Board']),
			'page_title' => view('partials/page-title', ['title' => 'Nazox', 'pagetitle' => 'Kanban Board'])
		];
		return view('apps-kanban-board', $data);
	}

	// chat
	public function show_apps_chat()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Chat']),
			'page_title' => view('partials/page-title', ['title' => 'Nazox', 'pagetitle' => 'Chat'])
		];
		return view('apps-chat', $data);
	}

	// Forms
	public function show_form_elements()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Elements']),
			'page_title' => view('partials/page-title', ['title' => 'Forms', 'pagetitle' => 'Forms Elements'])
		];
		return view('form-elements', $data);
	}

	public function show_form_validation()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Validation']),
			'page_title' => view('partials/page-title', ['title' => 'Forms', 'pagetitle' => 'Form Validation'])
		];
		return view('form-validation', $data);
	}

	public function show_form_advanced()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Advanced_Plugins']),
			'page_title' => view('partials/page-title', ['title' => 'Forms', 'pagetitle' => 'Form Advanced'])
		];
		return view('form-advanced', $data);
	}

	public function show_form_editors()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Editors']),
			'page_title' => view('partials/page-title', ['title' => 'Forms', 'pagetitle' => 'Form Editor'])
		];
		return view('form-editors', $data);
	}

	public function show_form_uploads()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'File_Upload']),
			'page_title' => view('partials/page-title', ['title' => 'Forms', 'pagetitle' => 'File Upload'])
		];
		return view('form-uploads', $data);
	}

	public function show_form_mask()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Mask']),
			'page_title' => view('partials/page-title', ['title' => 'Forms', 'pagetitle' => 'Form Mask'])
		];
		return view('form-mask', $data);
	}

	public function show_form_xeditable()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'X_editable']),
			'page_title' => view('partials/page-title', ['title' => 'Forms', 'pagetitle' => 'Form X-editable'])
		];
		return view('form-xeditable', $data);
	}

	public function show_form_wizard()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Wizard']),
			'page_title' => view('partials/page-title', ['title' => 'Forms', 'pagetitle' => 'Form Wizard'])
		];
		return view('form-wizard', $data);
	}

	// Icons
	public function show_icons_material()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Material_Design']),
			'page_title' => view('partials/page-title', ['title' => 'Icons', 'pagetitle' => 'MD Icons'])
		];
		return view('icons-materialdesign', $data);
	}


	public function show_icons_fontawesome()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Font_awesome_5']),
			'page_title' => view('partials/page-title', ['title' => 'Icons', 'pagetitle' => 'Font awesome 5'])
		];
		return view('icons-fontawesome', $data);
	}


	public function show_icons_dripicons()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Dripicons']),
			'page_title' => view('partials/page-title', ['title' => 'Icons', 'pagetitle' => 'Dripicons'])
		];
		return view('icons-dripicons', $data);
	}

	public function show_icons_remix()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Remix_Icons']),
			'page_title' => view('partials/page-title', ['title' => 'Icons', 'pagetitle' => 'Remix Icons'])
		];
		return view('icons-remix', $data);
	}

	// Charts
	public function show_charts_apex()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Apex_Charts']),
			'page_title' => view('partials/page-title', ['title' => 'Charts', 'pagetitle' => 'Apex charts'])
		];
		return view('charts-apex', $data);
	}

	public function show_charts_chartjs()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Chartjs']),
			'page_title' => view('partials/page-title', ['title' => 'Charts', 'pagetitle' => 'Chartjs'])
		];
		return view('charts-chartjs', $data);
	}

	public function show_charts_flot()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Flot']),
			'page_title' => view('partials/page-title', ['title' => 'Charts', 'pagetitle' => 'Flot Chart'])
		];
		return view('charts-flot', $data);
	}

	public function show_charts_sparkline()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Sparkline']),
			'page_title' => view('partials/page-title', ['title' => 'Charts', 'pagetitle' => 'Sparkline'])
		];
		return view('charts-sparkline', $data);
	}

	public function show_charts_other()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Jquery_Knob']),
			'page_title' => view('partials/page-title', ['title' => 'Charts', 'pagetitle' => 'Jquery Knob'])
		];
		return view('charts-knob', $data);
	}

	// Tables
	public function show_tables_basic()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Basic_Tables']),
			'page_title' => view('partials/page-title', ['title' => 'Tables', 'pagetitle' => 'Basic Tables'])
		];
		return view('tables-basic', $data);
	}
	public function show_tables_datatable()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Data_Tables']),
			'page_title' => view('partials/page-title', ['title' => 'Tables', 'pagetitle' => 'Data Tables'])
		];
		return view('tables-datatable', $data);
	}
	public function show_tables_responsive()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Responsive_Table']),
			'page_title' => view('partials/page-title', ['title' => 'Tables', 'pagetitle' => 'Responsive Table'])
		];
		return view('tables-responsive', $data);
	}
	public function show_tables_editable()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Editable_Table']),
			'page_title' => view('partials/page-title', ['title' => 'Tables', 'pagetitle' => 'Editable Table'])
		];
		return view('tables-editable', $data);
	}

	// Maps
	public function show_maps_google()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Google_Maps']),
			'page_title' => view('partials/page-title', ['title' => 'Maps', 'pagetitle' => 'Google Maps'])
		];
		return view('maps-google', $data);
	}
	public function show_maps_vector()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Vector_Maps']),
			'page_title' => view('partials/page-title', ['title' => 'Maps', 'pagetitle' => 'Vector Maps'])
		];
		return view('maps-vector', $data);
	}

	public function show_ui_rating()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Rating']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Rating'])
		];
		return view('ui-rating', $data);
	}

	public function show_ui_notifications()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Notifications']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Notifications'])
		];
		return view('ui-notifications', $data);
	}

	public function show_advanced_rangeslider()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Range_Slider']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Range Slider'])
		];
		return view('advanced-rangeslider', $data);
	}

	public function show_ui_sessiontimeout()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Session_Timeout']),
			'page_title' => view('partials/page-title', ['title' => 'UI Elements', 'pagetitle' => 'Session Timeout'])
		];
		return view('ui-session-timeout', $data);
	}

	// Pages
	public function show_pages_timeline()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Timeline']),
			'page_title' => view('partials/page-title', ['title' => 'Utility', 'pagetitle' => 'Timeline'])
		];
		return view('pages-timeline', $data);
	}

	public function show_pages_faqs()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'FAQs']),
			'page_title' => view('partials/page-title', ['title' => 'Utility', 'pagetitle' => 'FAQs'])
		];
		return view('pages-faqs', $data);
	}

	public function show_pages_pricing()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Pricing']),
			'page_title' => view('partials/page-title', ['title' => 'Utility', 'pagetitle' => 'Pricing'])
		];
		return view('pages-pricing', $data);
	}

	public function show_pages_404()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Error_404'])
		];
		return view('pages-404', $data);
	}

	public function show_pages_500()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Error_500'])
		];
		return view('pages-500', $data);
	}

	public function show_pages_maintenance()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Maintenance'])
		];
		return view('pages-maintenance', $data);
	}

	public function show_pages_comingsoon()
	{
		$data = [
			'title_meta' => view('partials/title-meta', ['title' => 'Coming_Soon'])
		];
		return view('pages-comingsoon', $data);
	}
}
