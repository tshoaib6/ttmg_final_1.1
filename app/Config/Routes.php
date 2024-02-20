<?php namespace Config;

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
$routes->setDefaultController('Auth');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/**
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/login', 'Auth::index',['filter' => 'authenticated']);
$routes->get('/login/(:any)', 'Auth::index/$1',['filter' => 'authenticated']);
$routes->get('/recover-password', 'Auth::recoverpassword',['filter' => 'authenticated']);
$routes->post('/recover-password', 'Auth::recoverpassword',['filter' => 'authenticated']);
$routes->match(['post'],'/recover-password', 'Auth::recoverpassword',['filter' => 'authenticated']);
$routes->post('/login', 'Auth::login',['filter' => 'authenticated']);


//Referral for Client Signup
$routes->get('/referral-signup/(:any)/(:any)', 'Referral::referralSignup/$1/$2',['filter' => 'authenticated']);
$routes->post('/referral-register', 'Auth::referral_register',['filter' => 'authenticated']);

//404 Page Redirection
$routes->get('404', 'PageController::show_pages_404');

$routes->group('', ['filter' => 'authenticate'], static function ($routes) 
{
	$routes->get('/register', 'Auth::register');
	$routes->post('/create', 'Auth::register');
	$routes->get('/allUsers', 'Auth::getAllUsers');
	$routes->get('/ajax-user-datatable', 'Auth::ajaxAllUsers');
	$routes->get('/deleteUser/(:any)', 'Auth::deleteUser/$1');
	$routes->get('/editUser/(:any)', 'Auth::editUser/$1');
	$routes->post('/editUser/(:any)', 'Auth::editUser/$1');
	$routes->get('/getuserid/(:any)', 'Auth::getUserId/$1');
	$routes->get('/blockUser/(:any)/(:any)', 'Auth::blockUser/$1/$2');
	$routes->get('/logout', 'Auth::logout');
	$routes->get('/profile', 'Auth::profile');

	//Email Templates
	$routes->get('/allEmail', 'EmailTemplate::index');
	$routes->get('/ajax-emailtemplates-datatable', 'EmailTemplate::ajaxAllEmailTemplates');
	$routes->get('/editTemplate/(:any)', 'EmailTemplate::editTemplate/$1');
	$routes->post('/editTemplate/(:any)', 'EmailTemplate::editTemplate/$1');

	//dashboard
    $routes->get('home', 'Home::index');
    $routes->get('ajax-dashboard-lead-chart/(:any)', 'Home::ajaxDashboardLeadChart/$1');

    //settings
    $routes->get('/settings', 'Settings::index');
    $routes->post('/settings', 'Settings::index');
    $routes->get('/email-action', 'Settings::notification_action');
    $routes->post('/email-action', 'Settings::notification_action');

    //Notifications ajax_top_notification
    $routes->get('/all-notifications', 'Notifications::index');
    $routes->post('/notifications', 'Notifications::index');
    $routes->get('/ajax-notifications', 'Notifications::ajax_top_notification');
    $routes->get('/ajax-notifications-read/(:any)', 'Notifications::ajax_top_notification_read/$1');

    //Activity Logs
    $routes->get('/all-activities', 'ActivityLog::index');
    $routes->get('/ajax-activities-datatable', 'ActivityLog::ajaxActivitiesLogs');
    $routes->get('/delete-activity/(:any)', 'ActivityLog::deleteActivity/$1');

    //Support & Request
    $routes->get('/support-request-center', 'Support::index');
    $routes->get('/ajax-chat-user-list', 'Support::ajaxUserList');
    $routes->get('/ajax-chat-user-msg/(:any)', 'Support::ajaxUserChat/$1');
    $routes->post('/ajax-chat-client-send-msg', 'Support::ajaxClientMsgSend');
    $routes->post('/ajax-chat-admin-send-msg', 'Support::ajaxSupportMsgSend');
    
    //Referral
    $routes->get('/all-referral', 'Referral::index');
    $routes->post('/add-referral', 'Referral::addReferral');
    $routes->get('/delete-referral/(:any)', 'Referral::deleteReferral/$1');
    $routes->get('/send-referral-email/(:any)', 'Referral::sendReferralEmail/$1');
    $routes->get('/ajax-referral-datatable', 'Referral::ajaxAllReferral');
    

});


// Shoaib


// Campaign 
$routes->get('/campaign-index', 'CampaignController::index',['filter' => 'authenticate']);
$routes->match(["get", "post"], "/create-campaign", 'CampaignController::create',['filter' => 'authenticate']);
$routes->get('/create-campaign/(:any)', 'CampaignController::create/$1',['filter' => 'authenticate']);
$routes->get('/campaign-datatable', 'CampaignController::ajaxDataTables');
$routes->get('/campaign-delete/(:any)', 'CampaignController::delete/$1',['filter' => 'authenticate']);
$routes->get('/campaign-detail/(:any)', 'CampaignController::campaign_detail/$1',['filter' => 'authenticate']);


//Order
$routes->match(["get", "post"], "/create-order", 'OrdersContoller::create',['filter' => 'authenticate']);
$routes->get('/create-order/(:any)', 'OrdersContoller::create/$1',['filter' => 'authenticate']);
$routes->get('/order-index', 'OrdersContoller::index',['filter' => 'authenticate']);

$routes->get('/orders-datatable/(:any)?', 'OrdersContoller::ajax_Datatable_orders/$1');
$routes->get('/lead-form-ajax', 'OrdersContoller::getLeadFormData');
$routes->post('/add-lead', 'OrdersContoller::lead_add');
$routes->get('/import-csv/(:any)', 'OrdersContoller::importCsv/$1',['filter' => 'authenticate']);
$routes->post('/get-campaign-col', 'OrdersContoller::get_campaign_col',['filter' => 'authenticate'],['filter' => 'authenticate']);
$routes->post('/upload-lead', 'OrdersContoller::upload_lead',['filter' => 'authenticate']);
$routes->get('/map-headers', 'OrdersContoller::map_headers',['filter' => 'authenticate']);
$routes->post('/import-leads', 'OrdersContoller::importLeads',['filter' => 'authenticate']);
$routes->get('/order-detail/(:any)', 'OrdersContoller::order_detail/$1',['filter' => 'authenticate']);
$routes->get('/order-delete/(:any)', 'OrdersContoller::delete/$1',['filter' => 'authenticate']);
$routes->post('/block-order', 'OrdersContoller::block_order',['filter' => 'authenticate']);
$routes->post('/unblock-order', 'OrdersContoller::unblock_order',['filter' => 'authenticate']);



//Leads
$routes->get('/lead-index', 'LeadController::index',['filter' => 'authenticate']);
$routes->get('/add-lead', 'LeadController::add_lead',['filter' => 'authenticate']);
$routes->get('/add-lead/(:any)', 'LeadController::add_lead/$1',['filter' => 'authenticate']);


$routes->get('/leads-datatable/(:any)?', 'LeadController::ajax_Datatable_leads/$1',['filter' => 'authenticate']);
$routes->get('/getleaddetail/(:any)', 'LeadController::get_lead_detail/$1',['filter' => 'authenticate']);
$routes->post('/reject-lead', 'LeadController::reject_lead',['filter' => 'authenticate']);
$routes->post('/accept-lead', 'LeadController::accept_lead',['filter' => 'authenticate']);
$routes->post('/save-notes', 'LeadController::save_notes',['filter' => 'authenticate']);
$routes->get('/getnotes/(:any)', 'LeadController::get_notes/$1',['filter' => 'authenticate']);
$routes->post('/get-campaign-col_by_id', 'LeadController::getLeadFormDataByCampId',['filter' => 'authenticate']);
$routes->post('/save-remainder', 'LeadController::save_remainder',['filter' => 'authenticate']);
$routes->get('/getremainder/(:any)', 'LeadController::get_remainder/$1',['filter' => 'authenticate']);
$routes->post('/assign-leads','LeadController::assign_lead',['filter' => 'authenticate']);
$routes->get('/replace-lead/(:any)', 'LeadController::add_lead/$1',['filter' => 'authenticate']);







//$routes->get('/index', 'Home::index');


$routes->get('/lang/{locale}', 'Language::index');

//Layout page routing
$routes->get('index-dark', 'Home::show_index_dark');
$routes->get('index-rtl', 'Home::show_index_rtl');
$routes->get('layouts-horizontal', 'Home::show_layouts_horizontal');
$routes->get('layouts-hori-topbar-dark', 'Home::show_layouts_hori_topbar_dark');
$routes->get('layouts-hori-boxed-width', 'Home::show_layouts_hori_boxed_width');
$routes->get('layouts-hori-preloader', 'Home::show_layouts_hori_preloader');
$routes->get('layouts-vertical', 'Home::show_layouts_vertical');
$routes->get('layouts-dark-sidebar', 'Home::show_layouts_dark_sidebar');
$routes->get('layouts-compact-sidebar', 'Home::show_layouts_compact_sidebar');
$routes->get('layouts-icon-sidebar', 'Home::show_layouts_icon_sidebar');
$routes->get('layouts-boxed', 'Home::show_layouts_boxed');
$routes->get('layouts-preloader', 'Home::show_layouts_preloader');
$routes->get('layouts-colored-sidebar', 'Home::show_layouts_colored_sidebar');
$routes->get('layouts-horizontal-dark', 'Home::show_layouts_horizontal_dark');
$routes->get('layouts-horizontal-rtl', 'Home::show_layouts_horizontal_rtl');

//App page routing
$routes->get('calendar', 'AppController::show_calendar');
$routes->get('chat', 'AppController::show_chat');
$routes->get('file-manager', 'AppController::show_file_manager');

$routes->get('ecommerce-products', 'AppController::show_ecommerce_products');
$routes->get('ecommerce-product-detail', 'AppController::show_ecommerce_product_detail');
$routes->get('ecommerce-orders', 'AppController::show_ecommerce_orders');
$routes->get('ecommerce-customers', 'AppController::show_ecommerce_customers');
$routes->get('ecommerce-cart', 'AppController::show_ecommerce_cart');
$routes->get('ecommerce-checkout', 'AppController::show_ecommerce_checkout');
$routes->get('ecommerce-shops', 'AppController::show_ecommerce_shops');
$routes->get('ecommerce-add-product', 'AppController::show_ecommerce_add_product');

$routes->get('email-inbox', 'AppController::show_email_inbox');
$routes->get('email-read', 'AppController::show_email_read');
$routes->get('invoices-list', 'AppController::show_invoices_list');
$routes->get('invoices-detail', 'AppController::show_invoices_detail');
$routes->get('contacts-grid', 'AppController::show_contacts_grid');
$routes->get('contacts-list', 'AppController::show_contacts_list');
$routes->get('contacts-profile', 'AppController::show_contacts_profile');

//Pages section routing
$routes->get('auth-login', 'PageController::show_auth_login');
$routes->get('auth-register', 'PageController::show_auth_register');
$routes->get('auth-recoverpw', 'PageController::show_auth_recoverpw');
$routes->get('auth-lock-screen', 'PageController::show_auth_lock_screen');

$routes->get('pages-starter', 'PageController::show_pages_starter');
$routes->get('pages-maintenance', 'PageController::show_pages_maintenance');
$routes->get('pages-comingsoon', 'PageController::show_pages_comingsoon');
$routes->get('pages-timeline', 'PageController::show_pages_timeline');
$routes->get('pages-faqs', 'PageController::show_pages_faqs');
$routes->get('pages-pricing', 'PageController::show_pages_pricing');

$routes->get('pages-500', 'PageController::show_pages_500');

//Component section routing
$routes->get('ui-alerts', 'ComponentController::show_ui_alerts');
$routes->get('ui-buttons', 'ComponentController::show_ui_buttons');
$routes->get('ui-cards', 'ComponentController::show_ui_cards');
$routes->get('ui-carousel', 'ComponentController::show_ui_carousel');
$routes->get('ui-dropdowns', 'ComponentController::show_ui_dropdowns');
$routes->get('ui-grid', 'ComponentController::show_ui_grid');
$routes->get('ui-images', 'ComponentController::show_ui_images');
$routes->get('ui-lightbox', 'ComponentController::show_ui_lightbox');
$routes->get('ui-modals', 'ComponentController::show_ui_modals');
$routes->get('ui-rangeslider', 'ComponentController::show_ui_rangeslider');
$routes->get('ui-session-timeout', 'ComponentController::show_ui_session_timeout');
$routes->get('ui-progressbars', 'ComponentController::show_ui_progressbars');
$routes->get('ui-sweet-alert', 'ComponentController::show_ui_sweet_alert');
$routes->get('ui-tabs-accordions', 'ComponentController::show_ui_tabs_accordions');
$routes->get('ui-typography', 'ComponentController::show_ui_typography');
$routes->get('ui-placeholders', 'ComponentController::show_ui_placeholders');
$routes->get('ui-toasts', 'ComponentController::show_ui_toasts');
$routes->get('ui-video', 'ComponentController::show_ui_video');
$routes->get('ui-utilities', 'ComponentController::show_ui_utilities');
$routes->get('ui-general', 'ComponentController::show_ui_general');
$routes->get('ui-colors', 'ComponentController::show_ui_colors');
$routes->get('ui-rating', 'ComponentController::show_ui_rating');
$routes->get('ui-notifications', 'ComponentController::show_ui_notifications');
$routes->get('ui-offcanvas', 'ComponentController::show_ui_offcanvas');


$routes->get('form-elements', 'ComponentController::show_form_elements');
$routes->get('form-validation', 'ComponentController::show_form_validation');
$routes->get('form-advanced', 'ComponentController::show_form_advanced');
$routes->get('form-editors', 'ComponentController::show_form_editors');
$routes->get('form-uploads', 'ComponentController::show_form_uploads');
$routes->get('form-xeditable', 'ComponentController::show_form_xeditable');
$routes->get('form-repeater', 'ComponentController::show_form_repeater');
$routes->get('form-wizard', 'ComponentController::show_form_wizard');
$routes->get('form-mask', 'ComponentController::show_form_mask');

$routes->get('tables-basic', 'ComponentController::show_tables_basic');
$routes->get('tables-datatable', 'ComponentController::show_tables_datatable');
$routes->get('tables-responsive', 'ComponentController::show_tables_responsive');
$routes->get('tables-editable', 'ComponentController::show_tables_editable');

$routes->get('charts-apex', 'ComponentController::show_charts_apex');
$routes->get('charts-chartjs', 'ComponentController::show_charts_chartjs');
$routes->get('charts-flot', 'ComponentController::show_charts_flot');
$routes->get('charts-knob', 'ComponentController::show_charts_knob');
$routes->get('charts-sparkline', 'ComponentController::show_charts_sparkline');

$routes->get('icons-unicons', 'ComponentController::show_icons_unicons');
$routes->get('icons-boxicons', 'ComponentController::show_icons_boxicons');
$routes->get('icons-materialdesign', 'ComponentController::show_icons_materialdesign');
$routes->get('icons-dripicons', 'ComponentController::show_icons_dripicons');
$routes->get('icons-fontawesome', 'ComponentController::show_icons_fontawesome');

$routes->get('maps-google', 'ComponentController::show_maps_google');
$routes->get('maps-vector', 'ComponentController::show_maps_vector');
$routes->get('maps-leaflet', 'ComponentController::show_maps_leaflet');

//Api 

$routes->get('get-campaigns-types', 'CampaignController::get_campaign_api');
$routes->post('test-api', 'LeadController::sync_lead_api');
$routes->get('test-email', 'LeadController::test_mail');






/**
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