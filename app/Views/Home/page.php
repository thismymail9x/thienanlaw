<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("css_home") ?>
<link rel="stylesheet preload" as="style"
      href="<?= BASE_URL_GLOBAL ?>/public/plugins/bootstrap4.5/css/bootstrap.min.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/header.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/our-vpn.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/our-story.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/feature.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/price.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/home.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/policy-security.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/global.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/css/home/thienan.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/plugins/fontawesome6/css/all.min.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/plugins/fontawesome6/css/fontawesome.min.css">

<link rel="stylesheet preload" as="style"
      href="<?= BASE_URL_GLOBAL ?>/public/plugins/carousel/dist/assets/owl.carousel.min.css">
<link rel="stylesheet preload" as="style"
      href="<?= BASE_URL_GLOBAL ?>/public/plugins/carousel/dist/assets/owl.theme.default.min.css">
<link rel="stylesheet preload" as="style" href="<?= BASE_URL_GLOBAL ?>/public/vendor/fontawesome-free/css/all.min.css"
      type="text/css">
<link rel="stylesheet preload" as="style"
      href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" type="text/css">
<link rel="stylesheet preload" as="style" type="text/css"
      href="<?= BASE_URL_GLOBAL ?>/public/css/home/section-footer-top.css">
<link rel="stylesheet preload" as="style" type="text/css" href="<?= BASE_URL_GLOBAL ?>/public/css/home/footer.css">
<?= $this->endSection() ?>
<?= $this->section("content_home") ?>
<?php echo @$page['post_content']; ?>
<?php if ($page['slug'] == SLUG_HOME_EN || $page['slug'] == SLUG_HOME_VN) { ?>
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
                                $attachments = explode(',', $v['attachment']);
                                $width = ['700w', '1024w', '1w']; ?>
                                <img alt="<?= $v['post_title']; ?>" title="<?= $v['post_title']; ?>"
                                     src="<?php echo $attachments[2] ?>"
                                     srcset="
                                <?php foreach ($attachments as $key => $value) {
                                         echo $value . ' ' . $width[$key] . ',';
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

<?php echo @$blog_bottom['post_content']; ?>

<section class="thienan-trangchu">
    <div class="container list_features" >
        <div class="row" style="margin: 10px 0;">
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card wallet">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-building"></i>
                    </div>
                    <p class="mobile-properties">Pháp lý doanh nghiệp</p>
                    <p class="pc-properties">Tư vấn pháp lý doanh nghiệp</p>
                </a>
            </div>
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card wallet">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-heart-circle-exclamation"></i>
                    </div>
                    <p class="mobile-properties">Tư vấn luật hôn nhân</p>
                    <p class="pc-properties">Tư vấn luật hôn nhân gia đình</p>
                </a>
            </div>
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card wallet">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-envelope-open-text"></i>
                    </div>
                    <p>Tư vấn thừa kế di chúc</p>
                </a>
            </div>
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card credentialing">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-mosque"></i>
                    </div>
                    <p>Tư vấn luật đất đai</p>
                </a>
            </div>
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card credentialing">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-truck-fast"></i>
                    </div>
                    <p>Tư vấn luật giao thông</p>
                </a>
            </div>
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card credentialing">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-people-carry-box"></i>
                    </div>
                    <p>Tư vấn luật lao động</p>
                </a>
            </div>
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card human-resources">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-person-military-to-person"></i>
                    </div>
                    <p>Tư vấn luật hình sự</p>
                </a>
            </div>
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card human-resources">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-person-rays"></i>
                    </div>
                    <p>Tư vấn luật dân sự</p>
                </a>
            </div>
            <div class=" col-6 col-md-4 col-lg-4">
                <a href="#" class="card human-resources">
                    <div class="overlay"></div>
                    <div class="circle">
                        <i class="fa-solid fa-people-roof"></i>
                    </div>
                    <p class="mobile-properties">Thủ tục hành chính</p>
                    <p class="pc-properties">Tư vấn các thủ tục hành chính</p>
                </a>
            </div>
        </div>

    </div>
</section>


<?= $this->endSection() ?>

