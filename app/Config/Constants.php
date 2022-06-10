<?php
/*
 | --------------------------------------------------------------------
 | App Namespace
 | --------------------------------------------------------------------
 |
 | This defines the default Namespace that is used throughout
 | CodeIgniter to refer to the Application directory. Change
 | this constant to change the namespace that all application
 | classes should use.
 |
 | NOTE: changing this will require manually modifying the
 | existing namespaces of App\* namespaced-classes.
 */

defined('APP_NAMESPACE') || define('APP_NAMESPACE', 'App');
//defined('BASE_URL_GLOBAL') || define('BASE_URL_GLOBAL', 'http://tuannt-vpn.onoffice.vn');

defined('BASE_URL_GLOBAL') || define('BASE_URL_GLOBAL', 'https://visitor.onoffice.vn');

//defined('BASE_URL_GLOBAL') || define('BASE_URL_GLOBAL', 'https://intovpn.net');
//defined('BASE_URL_GLOBAL') || define('BASE_URL_GLOBAL', 'https://intovpn.onoffice.vn');

$lang = isset($_COOKIE['lang'])?$_COOKIE['lang']:'vi';
defined('BASE_LANG') || define('BASE_LANG',$lang);

$image = [BASE_URL_GLOBAL. '/public/images/vpn-default.webp',BASE_URL_GLOBAL. '/public/images/vpn-default-300x300.webp',BASE_URL_GLOBAL. '/public/images/vpn-default-1024x1024.webp'];
$image_default = implode(',',$image);
defined('DEFAULT_IMAGE') || define('DEFAULT_IMAGE',$image_default);

// lấy theo id của các bài menu,trang tĩnh,trang động.
// không lấy theo slug vì cần join + test check các phần đã phát triển, mất quá nhiều thời gian.
// cho nên sẽ lưu 3 mục này = id
defined('MENU_ID') || define('MENU_ID',22011720492941);
defined('PAGE_ID') || define('PAGE_ID',22011720491783);
defined('DYNAMIC_PAGE_ID') || define('DYNAMIC_PAGE_ID',22011903082534);



defined('SLUG_HOME_VN') || define('SLUG_HOME_VN','trang-chu');
defined('SLUG_HOME_EN') || define('SLUG_HOME_EN','home');

/**
 * các constant này để lấy thông tin các dữ liệu cố định
 */

defined('SLUG_SECURITY_EN') || define('SLUG_SECURITY_EN','user-information-privacy-policy');
defined('SLUG_SECURITY_VN') || define('SLUG_SECURITY_VN','chinh-sach-bao-mat-thong-tin-nguoi-dung');
defined('BLOG_BOTTOM_SLUG_VN') || define('BLOG_BOTTOM_SLUG_VN','bai-viet-duoi-cung-tieng-viet');
defined('BLOG_BOTTOM_SLUG_EN') || define('BLOG_BOTTOM_SLUG_EN','bai-viet-duoi-cung-tieng-anh');
defined('SUPPORT_PAGE_SLUG_EN') || define('SUPPORT_PAGE_SLUG_EN','support');
defined('SUPPORT_PAGE_SLUG_VN') || define('SUPPORT_PAGE_SLUG_VN','huong-dan');

/*
 | -----------------------------------------------------------------------
 | Composer Path
 | --------------------------------------------------------------------------
 |
 | The path that Composer's autoload file is expected to live. By default,
 | the vendor folder is in the Root directory, but you can customize that here.
 */
defined('COMPOSER_PATH') || define('COMPOSER_PATH', ROOTPATH . 'vendor/autoload.php');

/*
 |--------------------------------------------------------------------------
 | Timing Constants
 |--------------------------------------------------------------------------
 |
 | Provide simple ways to work with the myriad of PHP functions that
 | require information to be in seconds.
 */
defined('SECOND') || define('SECOND', 1);
defined('MINUTE') || define('MINUTE', 60);
defined('HOUR')   || define('HOUR', 3600);
defined('DAY')    || define('DAY', 86400);
defined('WEEK')   || define('WEEK', 604800);
defined('MONTH')  || define('MONTH', 2592000);
defined('YEAR')   || define('YEAR', 31536000);
defined('DECADE') || define('DECADE', 315360000);

/*
 | --------------------------------------------------------------------------
 | Exit Status Codes
 | --------------------------------------------------------------------------
 |
 | Used to indicate the conditions under which the script is exit()ing.
 | While there is no universal standard for error codes, there are some
 | broad conventions.  Three such conventions are mentioned below, for
 | those who wish to make use of them.  The CodeIgniter defaults were
 | chosen for the least overlap with these conventions, while still
 | leaving room for others to be defined in future versions and user
 | applications.
 |
 | The three main conventions used for determining exit status codes
 | are as follows:
 |
 |    Standard C/C++ Library (stdlibc):
 |       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
 |       (This link also contains other GNU-specific conventions)
 |    BSD sysexits.h:
 |       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
 |    Bash scripting:
 |       http://tldp.org/LDP/abs/html/exitcodes.html
 |
 */
defined('EXIT_SUCCESS')        || define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          || define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         || define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   || define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  || define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') || define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     || define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       || define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      || define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      || define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
defined('FOLDER_UPLOAD') || define('FOLDER_UPLOAD', 'uploaded');
defined('FOLDER_CONTACT') || define('FOLDER_CONTACT', 'uploaded_contact');
defined('ITEM_PERPAGE') || define('ITEM_PERPAGE',20);
defined('ITEM_PERPAGE_HOME') || define('ITEM_PERPAGE_HOME',7);
/* type lang */
define('MENU_ADMIN', array(
    'POST' => "post?for_menu=1",
    'POST_CATEGORY' => "post_category?for_menu=1",
    'MENU' => "menu?for_menu=1",
    'PAGE_ADMIN' => "page-admin?for_menu=1",
    'DYNAMIC_PAGE' => "dynamic-page?for_menu=1"
));

define('POST_TYPE', array(
    'BLOG' => "Bài viết Blogs",
    'SUPPORT' => "Bài viết Supports",
    'CUSTOMER_REVIEW' => "Đánh giá khách hàng",
    'OTHER' => "Các loại khác",
));
define('SERVICE_TIMELINE_EN', array(
    '1m' => "1 months",
    '6m' => "6 months",
    '1y' => "1 year",
    '2y' => "2 years",
));
define('SERVICE_TIMELINE', array(
    '1m' => "1 tháng",
    '6m' => "6 tháng",
    '1y' => "1 năm",
    '2y' => "2 năm",
));
define('LANG', array(
    'EN' => "Tiếng anh",
    'VI' => "Tiếng việt",
));
define('POST_STATUS', array(
    '0' => "Không hiển thị",
    '1' => "Hiển thị",
));
define('CONTACT_STATUS', array(
    '0' => "Chưa liên hệ",
    '1' => "Đã liên hệ",
));

define('MAIL_TYPE', array(
    'KM' => "Khuyến mãi",
    'TB' => "Thông báo",
    'CB' => "Cảnh báo",
    'K' => "Khác",
));
define('MAIL_STATUS', array(
    '0' => "Không chọn gửi",
    '1' => "Chọn gửi",
));
define('REGISTER_PROMOTION_STATUS', array(
    '0' => "Chưa gửi",
    '1' => "Chờ gửi mail",
));
define('ADMIN_ROLES', array(
    'SUPER_ADMIN' => "Supper Admin",
    'ADMIN' => "Quản trị",
    'MODERATOR' => "Người điều hành",
    'GUEST' => "Khách",
));
define('ADMIN_ACTIVE', array(
    '2' => "Chưa kích hoạt",
    '1' => "Kích hoạt",
));
defined('URL_LOGIN_MYINTOVPN') || define('URL_LOGIN_MYINTOVPN', 'https://my.intovpn.net/home/login');
// 30/05/2022 hungtd add các thẻ được giữ lại khi tạo nội dung. Nhằm tránh xss
define( "HTML_ALLOWED_TAGS", "<h1><h2><h3><h4><h5><h6><p><i><b><strong><br><ol><ul><li><link><map><object><blockquote><hr><div><span>
<table><th><tr><td><a><label><img><embed><video><fieldset><font><pre><del><small><section><em><thead><tbody><tfoot><button>" );
