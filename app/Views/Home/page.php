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
    <div class="container">
        <div class="row" style="margin: 10px 0;">
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;color: #70C2B4;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> pháp lý doanh nghiệp
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/ldn.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn pháp lý doanh nghiệp</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;color: #70C2B4;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> luật hôn nhân và gia đình
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/hngd.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn luật hôn nhân gia đình</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;color: #70C2B4;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> thừa kế di chúc
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/tkdc.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn thừa kế di chúc</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin: 10px 0;">
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> luật đất đai
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/ldd.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn luật đất đai</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> luật giao thông
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/lgt.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn luật giao thông</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> luật lao động
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/lld.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn luật lao động</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin: 10px 0;">
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;color: #fba2d0;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> luật hình sự
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/lhs.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn luật hình sự</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;color: #fba2d0;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> luật dân sự
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/lds.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn luật dân sự</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card" style="position: relative">
                    <a href="" class="title-category" style="padding: 30px 0;color: #fba2d0;
    text-align: center;
    position: absolute;
    top: 20%;
    width: 100%;
    background-color: rgba(230, 230, 230,0.3);;
    text-transform: uppercase;
    font-weight: 500;">
                        Tư vấn <br> các thủ tục hành chính
                    </a>
                    <img style="width: 100%;height: 250px" src="<?= BASE_URL_GLOBAL ?>/public/images/thienan/tthc.png"
                         class="" alt="...">
                    <div class="card-body">
                        <p class="card-text">Tư vấn các thủ tục hành chính</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<?= $this->endSection() ?>

