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
$routes->setDefaultController('Home');
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
$routes->get('/sitemap.xml','Home::sitemap');

//$routes->get('/vi', 'Home::index');
//$routes->get('/(:any)', 'Home::index');


/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php'))
{
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
/* visitor */
$routes->get('lang/(:segment)', 'LanguageController::index_lang/$1');
$routes->get('/', 'Home::index');
    $routes->get('/our-story', 'Home::our_story');
    $routes->get('/our-vpn', 'Home::our_vpn');
    $routes->get('/features', 'Home::features');
    $routes->get('/blogs/(:segment)', 'Home::blogs/$1');
    $routes->get('/blog-child/(:any)', 'Home::blog_child/$1');
    $routes->get('/support', 'Home::support');
    $routes->get('/support/(:segment)', 'Home::support_category/$1');
    $routes->get('/support_search/(:any)', 'Home::support_search/$1');
   // $routes->get('/contact', 'Home::contact');
    $routes->get('/load_code', 'Home::load_code');
    $routes->get('/contact', 'Home::register_contact');
    $routes->post('/contact', 'Home::register_contact');
    $routes->get('/price', 'Home::price');
    $routes->get('/policy-security', 'Home::policy_security');
    //$routes->get('/get_captcha', 'Home::get_captcha');
    $routes->get('/page/(:any)', 'Home::page/$1');
    $routes->post('get-captcha', 'Home::getCaptcha');
//    $routes->get('seo', 'Home::sitemap');



//});
/*Dashboard*/
$routes->get('/admin', 'DashboardController::login');
$routes->post('/login', 'DashboardController::dashboard');
$routes->get('/dashboard', 'DashboardController::index',['filter' => 'auth']);
$routes->get('/logout', 'DashboardController::logout',['filter' => 'auth']);

$routes->group('post', function ($routes) {
    $routes->get('/', 'PostController::index',['filter' => 'auth']);
    $routes->post('/', 'PostController::index',['filter' => 'auth']);
    $routes->get('register', 'PostController::register',['filter' => 'auth']);
    $routes->post('register', 'PostController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'PostController::edit/$1',['filter' => 'auth']);
    $routes->post('edit', 'PostController::edit',['filter' => 'auth']);
    $routes->get('detail/(:any)', 'PostController::detail/$1',['filter' => 'auth']);
    $routes->get('ajax_status_post', 'PostController::ajax_status_post',['filter' => 'auth']);
    $routes->post('delete_post', 'PostController::delete_post',['filter' => 'auth']);
    $routes->post('uploaded_image_tinymce', 'PostController::uploaded_image_tinymce',['filter' => 'auth']);
    $routes->get('check_slug_isset/(:any)/(:any)', 'PostController::check_slug_isset/$1/$2',['filter' => 'auth']);
    $routes->get('delete_image/(:any)', 'PostController::delete_image/$1',['filter' => 'auth']);
    $routes->get('duplicate/(:segment)/(:segment)', 'PostController::duplicate/$1/$2',['filter' => 'auth']);
});
$routes->group('post_category', function ($routes) {
    $routes->get('/', 'PostCategoryController::index',['filter' => 'auth']);
    $routes->post('/', 'PostCategoryController::index',['filter' => 'auth']);
    $routes->get('register', 'PostCategoryController::register',['filter' => 'auth']);
    $routes->post('register', 'PostCategoryController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'PostCategoryController::edit/$1',['filter' => 'auth']);
    $routes->post('edit/(:any)', 'PostCategoryController::edit/$1',['filter' => 'auth']);
    $routes->post('delete_category', 'PostCategoryController::delete_category',['filter' => 'auth']);
    $routes->get('get_category_by_type/(:any)', 'PostCategoryController::get_category_by_type/$1',['filter' => 'auth']);
    $routes->get('get_category_type/(:any)/(:any)', 'PostCategoryController::get_category_type/$1/$2',['filter' => 'auth']);
});
$routes->group('register_promotion', function ($routes) {
    $routes->get('/', 'RegisterPromotionController::index',['filter' => 'auth']);
    $routes->post('/', 'RegisterPromotionController::index',['filter' => 'auth']);
    $routes->post('customer_register', 'RegisterPromotionController::customer_register');
    $routes->post('delete_register_promotion', 'RegisterPromotionController::delete_register_promotion',['filter' => 'auth']);
    $routes->post('send_register_promotion', 'RegisterPromotionController::send_register_promotion',['filter' => 'auth']);
});
$routes->group('service', function ($routes) {
    $routes->get('/', 'ServiceController::index',['filter' => 'auth']);
    $routes->post('/', 'ServiceController::index',['filter' => 'auth']);
    $routes->get('register', 'ServiceController::register',['filter' => 'auth']);
    $routes->post('register', 'ServiceController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'ServiceController::edit/$1',['filter' => 'auth']);
    $routes->post('edit', 'ServiceController::edit',['filter' => 'auth']);
    $routes->get('detail/(:any)', 'ServiceController::detail/$1',['filter' => 'auth']);
    $routes->post('delete_mail', 'ServiceController::delete_mail',['filter' => 'auth']);
    $routes->get('ajax_mail_status', 'ServiceController::ajax_mail_status',['filter' => 'auth']);
});
$routes->group('contact-user', function ($routes) {
    $routes->get('/', 'ContactController::index',['filter' => 'auth']);
    $routes->post('/', 'ContactController::index',['filter' => 'auth']);
    $routes->get('detail/(:any)', 'ContactController::detail/$1',['filter' => 'auth']);
    $routes->post('delete_contact', 'ContactController::delete_contact',['filter' => 'auth']);
    $routes->get('ajax_contact_status', 'ContactController::ajax_contact_status',['filter' => 'auth']);
    $routes->get('download-file', 'ContactController::download_file',['filter' => 'auth']);
});
$routes->group('mail', function ($routes) {
    $routes->get('/', 'MailController::index',['filter' => 'auth']);
    $routes->post('/', 'MailController::index',['filter' => 'auth']);
    $routes->get('register', 'MailController::register',['filter' => 'auth']);
    $routes->post('register', 'MailController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'MailController::edit/$1',['filter' => 'auth']);
    $routes->post('edit', 'MailController::edit',['filter' => 'auth']);
    $routes->get('detail/(:any)', 'MailController::detail/$1',['filter' => 'auth']);
    $routes->post('delete_mail', 'MailController::delete_mail',['filter' => 'auth']);
    $routes->get('ajax_mail_status', 'MailController::ajax_mail_status',['filter' => 'auth']);
});
/*Admin Actions*/
$routes->group('admin', function ($routes) {
    $routes->get('register', 'AdminController::register');
    $routes->get('edit/(:num)', 'AdminController::edit/$1',['filter' => 'auth']);
    $routes->post('change-pass', 'AdminController::changePassword',['filter' => 'auth']);
    $routes->get('reset-pass', 'AdminController::resetPassword',['filter' => 'auth']);
    $routes->get('profile', 'AdminController::profile', ['filter' => 'auth']);
    $routes->post('create-admin', 'AdminController::registerAdmin',['filter' => 'auth']);
});
$routes->group('language', function ($routes) {
    $routes->get('/', 'LanguageController::index',['filter' => 'auth']);
    $routes->post('/', 'LanguageController::index',['filter' => 'auth']);
    $routes->get('register', 'LanguageController::register',['filter' => 'auth']);
    $routes->post('register', 'LanguageController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'LanguageController::edit/$1',['filter' => 'auth']);
    $routes->post('edit', 'LanguageController::edit',['filter' => 'auth']);
    $routes->post('delete_language', 'LanguageController::delete_language',['filter' => 'auth']);

});
$routes->group('language_code', function ($routes) {
    $routes->get('/', 'LanguageCodeController::index',['filter' => 'auth']);
    $routes->post('/', 'LanguageCodeController::index',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'LanguageCodeController::edit/$1',['filter' => 'auth']);
    $routes->post('edit', 'LanguageCodeController::edit',['filter' => 'auth']);
    $routes->post('delete_lang_code', 'LanguageCodeController::delete_lang_code',['filter' => 'auth']);
    $routes->get('get_lang/(:any)', 'LanguageCodeController::get_lang/$1',['filter' => 'auth']);
});
$routes->group('menu', function ($routes) {
    $routes->get('/', 'MenuController::index',['filter' => 'auth']);
    $routes->post('/', 'MenuController::index',['filter' => 'auth']);
    $routes->get('register', 'MenuController::register',['filter' => 'auth']);
    $routes->post('register', 'MenuController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'MenuController::edit/$1',['filter' => 'auth']);
    $routes->post('edit', 'MenuController::edit',['filter' => 'auth']);
    $routes->get('ajax_status_post', 'MenuController::ajax_status_post',['filter' => 'auth']);
    $routes->post('delete_menu', 'MenuController::delete_menu',['filter' => 'auth']);
});
$routes->group('page-admin', function ($routes) {
    $routes->get('/', 'PageController::index',['filter' => 'auth']);
    $routes->post('/', 'PageController::index',['filter' => 'auth']);
    $routes->get('register', 'PageController::register',['filter' => 'auth']);
    $routes->get('register_home', 'PageController::register_home',['filter' => 'auth']);
    $routes->post('register_home', 'PageController::register_home',['filter' => 'auth']);
    $routes->post('register', 'PageController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'PageController::edit/$1',['filter' => 'auth']);
    $routes->post('edit', 'PageController::edit',['filter' => 'auth']);
    $routes->get('ajax_status_post', 'PageController::ajax_status_post',['filter' => 'auth']);
    $routes->post('delete_page', 'PageController::delete_page',['filter' => 'auth']);
});

$routes->group('dynamic-page', function ($routes) {
    $routes->get('/', 'DynamicPageController::index',['filter' => 'auth']);
    $routes->post('/', 'DynamicPageController::index',['filter' => 'auth']);
    $routes->get('register', 'DynamicPageController::register',['filter' => 'auth']);
    $routes->post('register', 'DynamicPageController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'DynamicPageController::edit/$1',['filter' => 'auth']);
    $routes->post('edit', 'DynamicPageController::edit',['filter' => 'auth']);
    $routes->post('delete_page', 'DynamicPageController::delete_page',['filter' => 'auth']);
});

$routes->group('admins', function ($routes) {
    $routes->get('/', 'AdminController::index',['filter' => 'auth']);
    $routes->post('/', 'AdminController::index',['filter' => 'auth']);
    $routes->get('register', 'AdminController::register',['filter' => 'auth']);
    $routes->post('register', 'AdminController::register',['filter' => 'auth']);
    $routes->get('edit/(:any)', 'AdminController::edit/$1',['filter' => 'auth']);
    $routes->get('detail/(:any)', 'AdminController::detail/$1',['filter' => 'auth']);
    $routes->post('edit', 'AdminController::edit',['filter' => 'auth']);
    $routes->get('ajax_active_admin', 'AdminController::ajax_active_admin',['filter' => 'auth']);
    $routes->post('change_pass', 'AdminController::change_pass',['filter' => 'auth']);
    $routes->post('delete_admin', 'AdminController::delete_admin',['filter' => 'auth']);
});




// route nay luôn để cuối cùng-> là route hiển thị bài viết của danh mục
$routes->get('/(:segment)/(:segment)', 'Home::blog/$1/$2');



