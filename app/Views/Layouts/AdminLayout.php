
<!DOCTYPE html>
<html lang="vi"><head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="csrf_test_name">
    <title>VPN Services - Admin</title>
    <base href="<?= BASE_URL_GLOBAL ?>"/>
    <link href="<?= BASE_URL_GLOBAL ?>/public/css/admin/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/css/admin/css/global.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/toastr/build/toastr.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/jquery_ui/jquery-ui.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/css/admin/style.css" rel="stylesheet" type="text/css">
    <script src="<?= BASE_URL_GLOBAL ?>/public/vendor/jquery/jquery.min.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/plugins/jquery_ui/jquery-ui.min.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/vendor/jquery-easing/jquery.easing.min.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/plugins/toastr/build/toastr.min.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/plugins/tinymce/tinymce.min.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/js/admin/input-mask/input-mask-init.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/js/admin/input-mask/jquery.mask.min.js"></script>
    <script src="<?= BASE_URL_GLOBAL ?>/public/js/admin/jquery.nestable.js"></script>

</head>
<body id="page-top">
<div id="wrapper">
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
        <a class="sidebar-brand d-flex align-items-center justify-content-center" href="<?= base_url('dashboard') ?>">
            <div class="sidebar-brand-text mx-3">Hostingviet.vn</div>
        </a>
        <hr class="sidebar-divider">
        <div class="sidebar-heading">
            Quản lý đối tượng
        </div>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('post?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Bài viết</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('post_category?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Danh mục</span></a>
        </li>
<!--        tam thời chưa sử dụng-->
<!--        <li class="nav-item">-->
<!--            <a class="nav-link" href="--><?//= base_url('service?for_menu=1') ?><!--">-->
<!--                <i class="fas fa-fw fa-table"></i>-->
<!--                <span>Dịch vụ</span></a>-->
<!--        </li>-->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('contact-user?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Đăng ký liên hệ</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('register_promotion?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Đăng ký nhận tin</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('menu?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Quản lý menu</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('page-admin?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Quản lý trang tĩnh</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('dynamic-page?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Quản lý trang động</span>
                <span class="d-block">(code-dùng để tạo data seo)</span>
            </a>
        </li>

        <div class="sidebar-heading">
            Cài đặt
        </div>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('language_code?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Danh sách ngôn ngữ</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('language?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Cài đặt khóa ngôn ngữ</span></a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('mail?for_menu=1') ?>">
                <i class="fas fa-fw fa-table"></i>
                <span>Cài đặt mail</span></a>
        </li>
<!--        <div class="sidebar-heading">-->
<!--            SEO website-->
<!--        </div>-->
        <div class="sidebar-heading">
            Tài khoản Quản trị
        </div>
        <?php if (session()->get('admin_role')=='SUPER_ADMIN' || session()->get('admin_role')=='ADMIN') { ?>
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url('admins?for_menu=1') ?>" style="cursor: pointer">
                <i class="fas fa-fw fa-chart-area"></i>
                <span class="">Quản lý admin</span></a>
        </li>
        <?php } ?>

        <li class="nav-item">
            <a class="nav-link" style="cursor: pointer">
                <i class="fas fa-fw fa-chart-area"></i>
                <span class="js__change-password" data-id="">Đổi mật khẩu</span></a>
        </li>
        <hr class="sidebar-divider d-none d-md-block">
        <div class="text-center d-none d-md-inline">
            <button class="rounded-circle border-0" id="sidebarToggle"></button>
        </div>
    </ul>
    <div id="content-wrapper" class="d-flex flex-column">
        <div id="content">
            <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                    <i class="fa fa-bars"></i>
                </button>
                <ul class="navbar-nav ml-auto">
                    <div class="topbar-divider d-none d-sm-block"></div>
                    <li class="nav-item dropdown no-arrow">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?= @session('admin_full_name') ?></span>
                            <img class="img-profile rounded-circle"
                                 src="<?= BASE_URL_GLOBAL ?>/public/images/profile.svg">
                        </a>
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                             aria-labelledby="userDropdown">
                            <a class="dropdown-item" href="<?= base_url().'/logout'?>" >
                                <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                Đăng xuất
                            </a>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="container-fluid">
                <!-- Using CSRF configuration -->
                <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="___csrfname" />
                <?= $this->renderSection("admin_main") ?>
            </div>
        </div>
        <footer class="sticky-footer bg-white">
            <div class="container my-auto">
                <div class="copyright text-center my-auto">
                    <span>Copyright &copy; Hostingviet.vn</span>
                </div>
            </div>
        </footer>
    </div>
</div>
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>
<?= $this->include("Modals/change-password") ?>
<style>
    * {
        font-size: 87%;
    }
    label, div, a, small, th, td, .card-header, .card-text {
        font-size: 13px;
    }
</style>
<script type="text/javascript">
    /*Using for csrf prevent*/
    var csrfName = $('.___csrfname').attr('name'); // CSRF Token name
    var csrfHash = $('.___csrfname').val(); // CSRF hash
    /*end*/
    var base_url = "<?php echo base_url();?>";
    var main_url = "<?php echo BASE_URL_GLOBAL;?>";
    var img_url = "<?php echo BASE_URL_GLOBAL.'/public/uploaded/';?>";
    var url_get_category = "<?php echo base_url().'/post_category/get_category_by_type/';?>";
    var url_get_lang = "<?php echo base_url().'/language_code/get_lang/';?>";
    var url_get_category_register = "<?php echo base_url().'/post_category/get_category_type/';?>";
    var url_status_post = "<?php echo base_url() . '/post/ajax_status_post';?>";
    var url_service_status = "<?php echo base_url() . '/service/ajax_service_status';?>";
    var url_contact_status = "<?php echo base_url() . '/contact-user/ajax_contact_status';?>";
    var url_mail_status = "<?php echo base_url() . '/mail/ajax_mail_status';?>";
    var url_slug_isset = "<?php echo base_url() . '/post/check_slug_isset';?>";
    var url_delete_image = "<?php echo base_url() . '/post/delete_image';?>";
    var url_active_admin = "<?php echo base_url() . '/admins/ajax_active_admin';?>";
    var duplicate_url = "<?php echo base_url() . '/post/duplicate';?>";
</script>
<script src="<?= BASE_URL_GLOBAL ?>/public/js/admin/sb-admin-2.min.js"></script>
<script src="<?= BASE_URL_GLOBAL ?>/public/js/admin/global.js"></script>
<script src="<?= BASE_URL_GLOBAL ?>/public/js/admin/menu.js"></script>


</body>
<script type="text/javascript">
    var Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 4000
    });
    toastr.clear();

    // Notification for actions
    <?php if(isset($_SESSION['msg_success'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Thành công!'
    })
    <?php unset($_SESSION['msg_success']); } ?>
    <?php if(isset($_SESSION['msg_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại sau!'
    })
    <?php unset($_SESSION['msg_error']);}?>
    //delete post
    <?php if(isset($_SESSION['msg_delete'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa bài viết thành công!'
    })
    <?php unset($_SESSION['msg_delete']); } ?>
    <?php if(isset($_SESSION['msg_delete_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại sau!'
    })
    <?php unset($_SESSION['msg_delete_error']);}?>
    // delete category
    <?php if(isset($_SESSION['msg_delete_category'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa danh mục thành công!'
    })
    <?php unset($_SESSION['msg_delete_category']); } ?>
    <?php if(isset($_SESSION['msg_delete_category_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại sau!'
    })
    <?php unset($_SESSION['msg_delete_category_error']);}?>

    // delete service
    <?php if(isset($_SESSION['msg_delete_service'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa dịch vụ thành công!'
    })
    <?php unset($_SESSION['msg_delete_service']); } ?>
    <?php if(isset($_SESSION['msg_delete_service_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại sau!'
    })
    <?php unset($_SESSION['msg_delete_service_error']);}?>


    // tạo mới lang
    <?php if(isset($_SESSION['msg_success_lang'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Tạo mới thành công!'
    })
    <?php unset($_SESSION['msg_success_lang']); } ?>

    // edit lang
    <?php if(isset($_SESSION['msg_success_edit_lang'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Cập nhật thành công!'
    })
    <?php unset($_SESSION['msg_success_edit_lang']); } ?>
    // delete contact
    <?php if(isset($_SESSION['msg_delete_contact'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa liên hệ thành công!'
    })
    <?php unset($_SESSION['msg_delete_contact']); } ?>
    <?php if(isset($_SESSION['msg_delete_contact_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại sau!'
    })
    <?php unset($_SESSION['msg_delete_contact_error']);}?>

    // delete mail
    <?php if(isset($_SESSION['msg_delete_mail'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa mail thành công!'
    })
    <?php unset($_SESSION['msg_delete_mail']); } ?>
    <?php if(isset($_SESSION['msg_delete_mail_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại sau!'
    })
    <?php unset($_SESSION['msg_delete_mail_error']);}?>
    // create success mail
    <?php if(isset($_SESSION['msg_success_mail'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Thành công!'
    })
    <?php unset($_SESSION['msg_success_mail']); } ?>

    // send mail
    <?php if(isset($_SESSION['msg_send_promotion'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Thiết lập gửi mail thành công!'
    })
    <?php unset($_SESSION['msg_send_promotion']); } ?>
    <?php if(isset($_SESSION['msg_send_promotion_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng liên hệ bộ phận phát triển!'
    })
    <?php unset($_SESSION['msg_send_promotion_error']);}?>

    // change password admin
    <?php if(isset($_SESSION['msg_success_password'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Thay đổi mật khẩu thành công!'
    })
    <?php unset($_SESSION['msg_success_password']); } ?>
    <?php if(isset($_SESSION['error-password'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi, mật khẩu nhập không đúng thông tin!'
    })
    <?php unset($_SESSION['error-password']);}?>

    // delete lang
    // delete service
    <?php if(isset($_SESSION['msg_delete_language'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa ngôn ngữ thành công!'
    })
    <?php unset($_SESSION['msg_delete_language']); } ?>
    <?php if(isset($_SESSION['msg_delete_language_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại sau!'
    })
    <?php unset($_SESSION['msg_delete_language_error']);}?>


    <?php if(isset($_SESSION['msg_error_password'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi, mật khẩu cũ không chính xác!'
    })
    <?php unset($_SESSION['msg_error_password']);}?>


    //reset password
    <?php if(isset($_SESSION['msg_success_reset_password'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Reset mật khẩu thành công!'
    })
    <?php unset($_SESSION['msg_success_reset_password']); } ?>

    // create admin
    <?php if(isset($_SESSION['success_create_admin'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Tạo mới tài khoản admin thành công!'
    })
    <?php unset($_SESSION['success_create_admin']); } ?>
    <?php if(isset($_SESSION['msg_error_create_admin'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi tạo tài khoản admin thất bại!'
    })
    <?php unset($_SESSION['msg_error_create_admin']);}?>

    //create lang code
    <?php if(isset($_SESSION['msg_success_lang_code'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Thành công!'
    })
    <?php unset($_SESSION['msg_success_lang_code']); } ?>

    // delete lang code

    <?php if(isset($_SESSION['msg_delete_lang_code'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa thành công!'
    })
    <?php unset($_SESSION['msg_delete_lang_code']); } ?>
    <?php if(isset($_SESSION['msg_delete_lang_code_error'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại sau!'
    })
    <?php unset($_SESSION['msg_delete_lang_code_error']);}?>

    //edit lang____

    <?php if(isset($_SESSION['msg_success_edit_lang'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Cập nhật thành công!'
    })
    <?php unset($_SESSION['msg_success_edit_lang']); } ?>
    <?php if(isset($_SESSION['msg_error_edit_lang'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Dữ liệu ngôn ngữ đã tồn tại, vui lòng thay đổi loại ngôn ngữ!'
    })
    <?php unset($_SESSION['msg_error_edit_lang']);}?>

    // trùng mã ngôn ngữ đã tạo
    <?php if(isset($_SESSION['msg_lang_duplicate'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Tồn tại loại ngôn ngữ đã được tạo, kiểm tra lại!'
    })
    <?php unset($_SESSION['msg_error_edit_lang']);}?>
    // check tạo trùng lang trong 1 form
    <?php if(isset($_SESSION['msg_lang_duplicate_in_form'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Dữ liệu tạo mới bị trùng!'
    })
    <?php unset($_SESSION['msg_lang_duplicate_in_form']);}?>


    // check tạo trùng lang trong 1 form
    <?php if(isset($_SESSION['msg_mail_duplicate'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Dữ liệu tạo mới bị trùng! Vui lòng kiểm tra lại!'
    })
    <?php unset($_SESSION['msg_mail_duplicate']);}?>

    // check tạo trùng lang trong 1 form
    <?php if(isset($_SESSION['msg_error_mail'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Dữ liệu bị lỗi! Vui lòng liên hệ admin!'
    })
    <?php unset($_SESSION['msg_error_mail']);}?>

    // check tạo trùng mail trong edit
    <?php if(isset($_SESSION['msg_mail_duplicate_exist'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Dữ liệu đã tồn tại!'
    })
    <?php unset($_SESSION['msg_mail_duplicate_exist']);}?>

    // edit mail
    <?php if(isset($_SESSION['msg_success_edit_mail'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Chỉnh sửa thành công!'
    })
    <?php unset($_SESSION['msg_success_edit_mail']);}?>

    // lỗi validate backend mail
    <?php if(isset($_SESSION['msg_error_edit_mail'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi, liên hệ admin để xử lý!'
    })
    <?php unset($_SESSION['msg_error_edit_mail']);}?>



    // register service
    <?php if(isset($_SESSION['msg_success_register_service'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Tạo mới dịch vụ thành công!'
    })
    <?php unset($_SESSION['msg_success_register_service']);}?>

    // lỗi validate backend mail
    <?php if(isset($_SESSION['msg_error_register_service'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi, liên hệ admin để xử lý!'
    })
    <?php unset($_SESSION['msg_error_register_service']);}?>


        // register post_category
    <?php if(isset($_SESSION['msg_success_register_post_category'])){ ?>
        Toast.fire({
            icon: 'success',
            title: 'Tạo mới danh mục thành công!'
        })
    <?php unset($_SESSION['msg_success_register_post_category']);}?>

    // lỗi validate backend mail
    <?php if(isset($_SESSION['msg_error_register_post_category'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi, liên hệ admin để xử lý!'
    })
    <?php unset($_SESSION['msg_error_register_post_category']);}?>


    // register post
    <?php if(isset($_SESSION['msg_error_register_post'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi dữ liệu, vui lòng liên hệ người quản trị!'
    })
    <?php unset($_SESSION['msg_error_register_post']);}?>

    // error cat anh
    // register post
    <?php if(isset($_SESSION['msg_error_crop_image'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi định dạng cắt ảnh bị sai!'
    })
    <?php unset($_SESSION['msg_error_crop_image']);}?>

    // register post
    <?php if(isset($_SESSION['msg_error_register_admin'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Lỗi vui lòng thử lại!'
    })
    <?php unset($_SESSION['msg_error_register_admin']);}?>

    <?php if(isset($_SESSION['msg_delete_admin'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa tài khoản admin thành công!'
    })
    <?php unset($_SESSION['msg_delete_admin']); } ?>

    <?php if(isset($_SESSION['msg_delete-menu'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Xóa menu thành công!'
    })
    <?php unset($_SESSION['msg_delete-menu']); } ?>
    <?php if(isset($_SESSION['msg_error_img_post'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'File ảnh không phù hợp sử dụng đuôi : jpeg,gif,png,webp!'
    })
    <?php unset($_SESSION['msg_error_img_post']); } ?>
    <?php if(isset($_SESSION['msg_error_img_exist'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'Tên file ảnh đã tồn tại vui lòng đổi tên!'
    })
    <?php unset($_SESSION['msg_error_img_exist']); } ?>

    <?php if(isset($_SESSION['msg_error_sitemap'])){ ?>
    Toast.fire({
        icon: 'error',
        title: 'File sitemap không đúng. Vui lòng thử lại!'
    })
    <?php unset($_SESSION['msg_error_sitemap']); } ?>

    <?php if(isset($_SESSION['msg_success_sitemap'])){ ?>
    Toast.fire({
        icon: 'success',
        title: 'Cập nhật sitemap thành công!'
    })
    <?php unset($_SESSION['msg_success_sitemap']); } ?>


    //Using for multi-views
    var currentPageURL = location.href;
    $(document).ready(function () {
        //For active-menu
        $('.nav-link').each(function() {
            if ($(this).attr("href") !== "#") {
                var targetURL = $(this).prop("href");
                if (targetURL == currentPageURL) {
                    $('nav-link').parents('li, ul').removeClass('active');
                    $(this).parent('li').addClass('active');
                    return false;
                }
            }
        });
        //End-of
    });
    //End-of
</script>
</html>