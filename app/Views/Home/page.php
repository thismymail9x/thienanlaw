<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("css_home") ?>
    <link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/plugins/bootstrap4.5/css/bootstrap.min.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/css/home/header.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/css/home/our-vpn.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/css/home/our-story.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/css/home/feature.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/css/home/price.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/css/home/home.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/css/home/policy-security.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/css/home/global.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/plugins/carousel/dist/assets/owl.carousel.min.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/plugins/carousel/dist/assets/owl.theme.default.min.css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/vendor/fontawesome-free/css/all.min.css" type="text/css">
    <link rel="stylesheet preload" as="style"  href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" type="text/css" >
    <link rel="stylesheet preload" as="style"  type="text/css" href="<?= BASE_URL_GLOBAL ?>/public/css/home/section-footer-top.css">
    <link rel="stylesheet preload" as="style"  type="text/css" href="<?= BASE_URL_GLOBAL ?>/public/css/home/footer.css">
<?= $this->endSection() ?>
<?= $this->section("content_home") ?>
    <?php echo @$page['post_content'];?>
<?php if ($page['slug']== SLUG_HOME_EN || $page['slug']== SLUG_HOME_VN) { ?>
    <section class="home__slider">
    <div class="container">
    <h2 class="title"><?= lang("Text.home_slider.title") ?></h2>
    <p class="introduce"><?= lang("Text.home_slider.introduce") ?></p>
    <div class="content__slider">
        <div class="owl-carousel owl-theme" id="owl-carousel">
            <?php if (!empty(@$customer_reviews)) {
                foreach (@$customer_reviews as $k => $v) { ?>
                    <div class="item">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="card-title limit-text-1"><?= $v['post_title']; ?></h3>
                                <p class="card-text limit-text-5"><?= $v['post_introduce']; ?></p>
                                <p class="card-name">
                                    <span><?= $v['post_creator']; ?></span> - <i><?= $v['role_creator']; ?></i>
                                </p>
                            </div>
                        </div>
                        <?php
                        $attachments = explode(',',$v['attachment']);
                        $width = ['700w','1024w','1w']; ?>
                            <img alt="<?= $v['post_title']; ?>" title="<?= $v['post_title']; ?>" src="<?php echo $attachments[2] ?>"
                                 srcset="
                                <?php foreach ($attachments as $key=>$value) {
                                     echo $value.' '.$width[$key].',';
                                 } ?>">
                    </div>
                    <?php
                }
            } ?>
        </div>
    </div>
    </div>
    </section>
<?php } ?>
<?php echo @$blog_bottom['post_content'];?>
<?= $this->endSection() ?>

