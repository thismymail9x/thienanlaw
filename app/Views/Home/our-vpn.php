<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("content_home") ?>
<section class="our__vpn-top">
    <div class="container">
        <div class="item-top">
            <h1 class="title"><?= lang("Text.our_vpn.title") ?><span> <?= lang("Text.our_vpn.title-span") ?></span></h1>
            <div class="row">
                <div class="col col-xs">
                    <div class="icon icon-ios"></div>
                    <span class="name">IOS</span>
                </div>
                <div class="col col-xs">
                    <div class="icon icon-android"></div>
                    <span class="name">Android</span>
                </div>
                <div class="col col-xs">
                    <div class="icon icon-windows"></div>
                    <span class="name">Windows</span>
                </div>
                <div class="col col-xs">
                    <div class="icon icon-macos"></div>
                    <span class="name">MacOS</span>
                </div>
                <div class="col col-xs">
                    <div class="icon icon-chrome"></div>
                    <span class="name">Chrome</span>
                </div>
                <div class="col col-xs">
                    <div class="icon icon-firefox"></div>
                    <span class="name">Firefox</span>
                </div>
                <div class="col col-xs">
                    <div class="icon icon-linux"></div>
                    <span class="name">Linux</span>
                </div>
            </div>
        </div>
        <div class="item-bottom">
            <h2 class="title"><?= lang("Text.our_vpn.title-content-first") ?></h2>
            <div class="row d-flex justify-content-between">
                <div class="col-md col-xl left text-left">
                    <img src="<?php echo base_url('/public/images/home/windows.svg'); ?>" alt="windows">
                    <div>
                        <span class="name">Windows app
                    </span>
                        <a href="">Download.EXE</a>
                    </div>
                </div>
                <div class="col-md col-xl-5 center text-center">
                    <img src="<?php echo base_url('/public/images/home/macos.svg'); ?>" alt="macos">
                    <div>
                    <span class="name">MacOs app
                    </span>
                        <a href="">Download.EXE</a>
                    </div>
                </div>
                <div class="col-md col-xl right text-right">
                    <img src="<?php echo base_url('/public/images/home/linux.svg'); ?>" alt="linux">
                    <div>
                    <span class="name">Linux app
                    </span>
                        <a href="">Download.EXE</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section class="our__vpn-center">
    <div class="container">
        <h2 class="title"><?= lang("Text.our_vpn.title-content-second") ?></h2>
        <div class="row d-flex justify-content-between">
            <div class="col col-xs-6 col-md-6 col-xl-6 left text-center">
                <img src="<?php echo base_url('/public/images/home/android.svg'); ?>" alt="android">
                <div>
                        <span class="name">Android app
                    </span>
                    <a class="text-secondary" style="text-decoration: none"><?= lang("Text.our_vpn.developing") ?></a>

                </div>
            </div>
            <div class="col col-xs-6 col-md-6 col-xl-6 right text-center">
                <img src="<?php echo base_url('/public/images/home/ios.svg'); ?>" alt="ios">
                <div>
                    <span class="name">IOS app
                    </span>
                    <a class="text-secondary" style="text-decoration: none"><?= lang("Text.our_vpn.developing") ?></a>
                </div>
            </div>

        </div>
    </div>
</section>

<section class="our__vpn-bottom">
    <div class="container">
        <div class="item-bottom">
            <h2 class="title"><?= lang("Text.our_vpn.title-content-third") ?></h2>
            <div class="row d-flex justify-content-between">
                <div class="col-md-4 col-xl left text-left">
                    <img src="<?php echo base_url('/public/images/home/chrome.svg'); ?>" alt="chrome">
                    <div>
                        <span class="name">Chrome <span class="hide-mobile">extension</span>
                    </span>
                        <a class="text-secondary" style="text-decoration: none"><?= lang("Text.our_vpn.developing") ?></a>
                    </div>
                </div>
                <div class="col-md-4 col-xl center text-center">
                    <img src="<?php echo base_url('/public/images/home/firefox.svg'); ?>" alt="firefox">
                    <div>
                    <span class="name">Firefox <span class="hide-mobile">extension</span>
                    </span>
                        <a class="text-secondary" style="text-decoration: none"><?= lang("Text.our_vpn.developing") ?></a>
                    </div>
                </div>
                <div class="col-md-4 col-xl right text-right">
                    <img src="<?php echo base_url('/public/images/home/edge.svg'); ?>" alt="microsoft edge">
                    <div>
                    <span class="name">Microsoft Edge <span class="hide-mobile">extension</span>
                    </span>
                        <a class="text-secondary" style="text-decoration: none"><?= lang("Text.our_vpn.developing") ?></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>
