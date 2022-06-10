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
    <p class="title-top container">
        <span><?= lang("Text.header.your_ip") ?>: <?= $ip ?>
        </span>
        <span>|&nbsp;<?= lang("Text.header.country") ?>: <?php echo $locale['en'] ?> </span>
    </p>
</div>
<div class="header__navbar" id="navbar">
    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-light">
            <a class="navbar-brand" href="<?php echo base_url('/'); ?>">
                <img width="100%" height="100%" src="<?php echo BASE_URL_GLOBAL; ?>/public/images/home/logo-0.jpg"
                     alt="intoVPN">
            </a>
            <span class="navbar-text mobile">
                <a href="<?php echo URL_LOGIN_MYINTOVPN; ?>"><?= lang("Text.header.login") ?></a>
            </span>
            <div class="language mobile d-flex align-items-center">
                <div class="icon-earth"></div>
                <select class="language__select" name="lang" id="">
                    <option <?php if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'vi') {
                        echo 'selected';
                    } ?> value="vi"><?= lang("Text.header.vi") ?></option>
                    <option <?php if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
                        echo 'selected';
                    } ?> value="en"><?= lang("Text.header.en") ?></option>
                </select>
            </div>

            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarText"
                    aria-controls="navbarText" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarText">
                <?= @$menu['post_content'] ?>
                <span class="navbar-text"><a
                            href="<?php echo URL_LOGIN_MYINTOVPN; ?>"><?= lang("Text.header.login") ?></a></span>
                <div class="language d-flex align-items-center">
                    <div class="icon-earth"></div>
                    <select class="language__select" name="lang" id="">
                        <option <?php if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'vi') {
                            echo 'selected';
                        } ?> value="vi"><?= lang("Text.header.vi") ?></option>
                        <option <?php if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
                            echo 'selected';
                        } ?> value="en"><?= lang("Text.header.en") ?></option>
                    </select>
                </div>
            </div>
        </nav>
    </div>
</div>

