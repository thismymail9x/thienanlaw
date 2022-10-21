<div class="header__top">
    <?php
    // lấy ip người dùng
    use GeoIp2\Database\Reader;
    if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
        $ip = $_SERVER['HTTP_CLIENT_IP'];
    } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
        $ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
    } else {
        $ip = $_SERVER['REMOTE_ADDR'];
    }

    $reader = new Reader(PUBLIC_HTML_PATH . '/public/GeoIP2/GeoLite2-Country.mmdb');
    $record = $reader->country($ip);
    $locale = $record->country->names;
    ?>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <a class="logo-ta"  href="<?php echo base_url('/'); ?>">
                    <img width="100%" height="100%" src="<?php echo BASE_URL_GLOBAL; ?>/public/images/home/logo-ta.png"
                         alt="intoVPN">
                </a>
            </div>
            <div class="col-8" style="color: #956ad6;text-align: right">
                <div class="row" style="padding: 40px 0">
                    <div class="col-2">
                    </div>
                    <div class="col-6" style="font-size: 25px; font-weight: bold"> L.s Nguyễn Phương</div>
                    <div class="col-4" style="">
                        <a href="tel:0987123465" style="text-decoration: none;color: #956ad6">0987.123.456</a>
                        <br>
                        <a style="text-decoration: none;color: #956ad6" href="mailto:email@gmail.com"> email@gmail.com</a>
                    </div>
                </div>
                <p>Trụ sở chính: Số 1 Duy Tân Cầu Giấy - Hà Nội</p>
            </div>
        </div>
    </div>


</div>
<div class="header__navbar" id="navbar">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">

<!--            <span class="navbar-text mobile">-->
<!--                <a href="--><?php //echo URL_LOGIN_MYINTOVPN; ?><!--">--><?//= lang("Text.header.login") ?><!--</a>-->
<!--            </span>-->
<!--            <div class="language mobile d-flex align-items-center">-->
<!--                <div class="icon-earth"></div>-->
<!--                <select class="language__select" name="lang" id="">-->
<!--                    <option --><?php //if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'vi') {
//                        echo 'selected';
//                    } ?><!-- value="vi">--><?//= lang("Text.header.vi") ?><!--</option>-->
<!--                    <option --><?php //if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
//                        echo 'selected';
//                    } ?><!-- value="en">--><?//= lang("Text.header.en") ?><!--</option>-->
<!--                </select>-->
<!--            </div>-->

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <?= @$menu['post_content'] ?>
<!--                <span class="navbar-text"><a-->
<!--                            href="--><?php //echo URL_LOGIN_MYINTOVPN; ?><!--">--><?//= lang("Text.header.login") ?><!--</a></span>-->
<!--                <div class="language d-flex align-items-center">-->
<!--                    <div class="icon-earth"></div>-->
<!--                    <select class="language__select" name="lang" id="">-->
<!--                        <option --><?php //if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'vi') {
//                            echo 'selected';
//                        } ?><!-- value="vi">--><?//= lang("Text.header.vi") ?><!--</option>-->
<!--                        <option --><?php //if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
//                            echo 'selected';
//                        } ?><!-- value="en">--><?//= lang("Text.header.en") ?><!--</option>-->
<!--                    </select>-->
<!--                </div>-->
            </div>
        </nav>
    </div>
</div>

