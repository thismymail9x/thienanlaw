<?php $lang = 'vi';
if (isset($_COOKIE['lang'])) {
    $lang = $_COOKIE['lang'];
} ?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb#" xmlns="http://www.w3.org/1999/xhtml"
      xmlns:fb="http://ogp.me/ns/fb#">

<head>
    <script class="rank-math-schema" type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@graph": [
                {
                    "@type": "Organization",
                    "@id": "https://intovpn.net/vi/",
                    "url": "https://intovpn.net/vi/",
                    "name": "IntoVPN",
                    "sameAs": [],
                    "logo": {
                        "@type": "ImageObject",
                        "url": "https://intovpn.net/vi/public/images/home/logo-0.jpg",
                        "caption": "IntoVPN Branding"
                    }
                },
                {
                    "@type": "WebSite",
                    "@id": "https://intovpn.net/vi/",
                    "name": "IntoVPN",
                    "url": "https://intovpn.net/vi/",
                    "description": "Website cung cấp các dịch vụ VPN dành cho khách hàng."
                }
            ]
        }
    </script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="dns-prefetch" type="image/x-icon" href="<?php echo BASE_URL_GLOBAL ?>/favicon.ico">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <base href="<?= base_url(); ?>">
    <?= $this->include("meta-seo") ?>
    <?= $this->renderSection("css_home") ?>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
          rel="preconnect">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&display=swap"
          rel="preconnect">
</head>
<body style="background-color: #DDE6F1;">
<!-- Using CSRF configuration -->
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>"/>
<?= $this->include("Home/header") ?>
<!-- Using CSRF configuration -->
<input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="___csrfname"/>
<?= $this->renderSection("content_home") ?>
<?= $this->include("Home/footer") ?>
</body>
<script rel="preload" as="script" src="<?= BASE_URL_GLOBAL ?>/public/vendor/jquery/jquery.min.js"></script>
<script rel="preload" as="script" defer src="<?= BASE_URL_GLOBAL ?>/public/plugins/jquery_ui/jquery-ui.min.js"></script>
<script rel="preload" as="script" type="text/javascript">
    jQuery.event.special.touchstart = {
        setup: function (_, ns, handle) {
            this.addEventListener("touchstart", handle, {passive: !ns.includes("noPreventDefault")});
        }
    };
    jQuery.event.special.touchmove = {
        setup: function (_, ns, handle) {
            this.addEventListener("touchmove", handle, {passive: !ns.includes("noPreventDefault")});
        }
    };
    jQuery.event.special.wheel = {
        setup: function (_, ns, handle) {
            this.addEventListener("wheel", handle, {passive: true});
        }
    };
    jQuery.event.special.mousewheel = {
        setup: function (_, ns, handle) {
            this.addEventListener("mousewheel", handle, {passive: true});
        }
    };
</script>
<script rel="preload" as="script" async
        src="<?= BASE_URL_GLOBAL ?>/public/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script rel="preload" as="script" defer
        src="<?= BASE_URL_GLOBAL ?>/public/vendor/jquery-easing/jquery.easing.min.js"></script>
<script rel="preload" as="script" src="<?= BASE_URL_GLOBAL ?>/public/plugins/toastr/build/toastr.min.js" async></script>
<script rel="preload" as="script" src="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.js"
        async></script>
<script rel="preload" as="script" src="<?= BASE_URL_GLOBAL ?>/public/plugins/carousel/dist/owl.carousel.min.js"
        async></script>

<script rel="preload" as="script" src="<?= BASE_URL_GLOBAL ?>/public/js/home/global.js" async></script>
<script type="text/javascript">
    document.addEventListener("DOMContentLoaded", function () {
        var lazyloadImages;

        if ("IntersectionObserver" in window) {
            lazyloadImages = document.querySelectorAll(".lazy");
            var imageObserver = new IntersectionObserver(function (entries, observer) {
                entries.forEach(function (entry) {
                    if (entry.isIntersecting) {
                        var image = entry.target;
                        image.classList.remove("lazy");
                        imageObserver.unobserve(image);
                    }
                });
            });

            lazyloadImages.forEach(function (image) {
                imageObserver.observe(image);
            });
        } else {
            var lazyloadThrottleTimeout;
            lazyloadImages = document.querySelectorAll(".lazy");

            function lazyload() {
                if (lazyloadThrottleTimeout) {
                    clearTimeout(lazyloadThrottleTimeout);
                }

                lazyloadThrottleTimeout = setTimeout(function () {
                    var scrollTop = window.pageYOffset;
                    lazyloadImages.forEach(function (img) {
                        if (img.offsetTop < (window.innerHeight + scrollTop)) {
                            img.src = img.dataset.src;
                            img.classList.remove('lazy');
                        }
                    });
                    if (lazyloadImages.length == 0) {
                        document.removeEventListener("scroll", lazyload);
                        window.removeEventListener("resize", lazyload);
                        window.removeEventListener("orientationChange", lazyload);
                    }
                }, 20);
            }

            document.addEventListener("scroll", lazyload);
            window.addEventListener("resize", lazyload);
            window.addEventListener("orientationChange", lazyload);
        }
    })
</script>
<script type="text/javascript">
    /*Using for csrf prevent*/
    var csrfName = $('.___csrfname').attr('name'); // CSRF Token name
    var csrfHash = $('.___csrfname').val(); // CSRF hash
    /*end*/
</script>
<script type="text/javascript" async>

    var url_load_code = "<?php echo base_url() . '/load_code';?>";
    var url_load_lang_en = "<?= BASE_URL_GLOBAL . '/en/lang/en'; ?>";
    var url_load_lang_vn = "<?= BASE_URL_GLOBAL . '/vi/lang/vi'; ?>";
    var url_load_more_blog = "<?php echo base_url() . '/load-more-blog/';?>";
    var url_support_search = "<?php echo base_url() . '/support_search';?>";
    var reload_captcha = "<?php echo base_url() . '/get_captcha'?>" + "?rand=Math.random()*10000";
    $(document).ready(function () {
        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        <?php if(isset($_SESSION['msg_success_contact'])){ ?>
        Toast.fire({
            icon: 'success',
            title: '<?= lang("Text.toastr.success-contact") ?>!'
        })
        <?php unset($_SESSION['msg_success_contact']); } ?>
        <?php if(isset($_SESSION['msg_error_contact'])){ ?>
        Toast.fire({
            icon: 'error',
            title: '<?= lang("Text.toastr.error-contact") ?>!'
        })
        <?php unset($_SESSION['msg_error_contact']);}?>

        <?php if(isset($_SESSION['msg_register_promotion'])){ ?>
        Toast.fire({
            icon: 'success',
            title: "<?= lang("Text.toastr.register-promotion") ?>"
        })
        <?php unset($_SESSION['msg_register_promotion']); } ?>
        <?php if(isset($_SESSION['msg_register_promotion_error'])){ ?>
        Toast.fire({
            icon: 'error',
            title: "<?= $_SESSION['msg_register_promotion_error']; ?>"
        })
        <?php unset($_SESSION['msg_register_promotion_error']);}?>

        <?php if(isset($_SESSION['msg_error_file'])){ ?>
        Toast.fire({
            icon: 'error',
            title: '<?= lang("Text.toastr.error-contact-file") ?>!'
        })
        <?php unset($_SESSION['msg_error_file']);}?>

    });
</script>
</html>
