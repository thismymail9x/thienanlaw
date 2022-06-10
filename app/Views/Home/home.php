<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("content_home") ?>
<? //= lang("Text.header.login") ?>
    <section class="home__top">
        <div class="container">
            <h1 class="title">
                <?= lang("Text.home_top.title-1") ?>
                <span><?= lang("Text.home_top.title-2") ?></span>
            </h1>
            <p class="introduce"><?= lang("Text.home_top.introduce") ?>
                <span><?= lang("Text.home_top.introduce-span") ?>.</span></p>
            <p class="details">
                <a href="<?php echo base_url('/features'); ?>" class="button">
                    <?= lang("Text.home_top.button") ?>
                    <span class="circle"><i class="icon"></i></span>
                </a>
            </p>
        </div>
    </section>
    <section class="home__center">
        <div class="container">
            <h2 class="title"><?= lang("Text.home_center.title") ?></h2>
            <div class="row item item-first">
                <div class="col-5 left-first">
                    <h4>
                        <div class="check-icon">

                        </div>
                        <?= lang("Text.home_center.title-content-first") ?>
                    </h4>
                    <p>
                        <?= lang("Text.home_center.introduce-first") ?>
                        <br>
                        <span><?= lang("Text.home_center.introduce-span-first") ?></span>
                    </p>
                </div>
                <div class="col-7 right-first">
                    <div class="item-image item-lan">
                    </div>
                </div>
            </div>
            <div class="row item item-second">
                <div class="col-7 left-second">
                    <div class="item-image item-ip">
                    </div>
                </div>
                <div class="col-5 right-second">
                    <h4>
                        <div class="check-icon">

                        </div>
                        <?= lang("Text.home_center.title-content-second") ?>
                    </h4>
                    <p>
                        <?= lang("Text.home_center.introduce-second-1") ?>
                        <span><?= lang("Text.home_center.introduce-span-second-1") ?></span></p>
                </div>
            </div>
        </div>
    </section>
    <section class="home__bottom">
        <div class="container">
            <h2 class="title"><?= lang("Text.home_bottom.title") ?></h2>
            <div class="row item item-first">
                <div class="col-5 left-first">
                    <h4>
                        <?= lang("Text.home_bottom.title-content-first") ?></h4>
                </div>
                <div class="col-7 right-first">
                    <div class="item-image item-loi">
                    </div>
                </div>
            </div>
            <div class="row item item-second">
                <div class="col-7 left-second">
                    <div class="item-image item-log">

                    </div>
                </div>
                <div class="col-5 right-second">
                    <h4>
                        <?= lang("Text.home_bottom.title-content-second") ?></h4>
                    <p>
                        <?= lang("Text.home_bottom.introduce-content-second") ?></p>
                </div>
            </div>
            <div class="row item item-third">
                <div class="col-5 left-first">
                    <h4>
                        <?= lang("Text.home_bottom.title-content-third") ?></h4>
                    <p><?= lang("Text.home_bottom.introduce-content-third") ?>
                        <br>
                        <span><?= lang("Text.home_bottom.introduce-span-content-third") ?></span></p>
                </div>
                <div class="col-7 right-first">
                    <div class="item-image item-kn">
                    </div>
                </div>
            </div>
            <div class="row item item-fourth">
                <div class="col-7 left-second">
                    <div class="item-image item-server">

                    </div>
                </div>
                <div class="col-5 right-second">
                    <h4>
                        <?= lang("Text.home_bottom.title-content-fourth") ?>
                    </h4>
                    <p>
                        <?= lang("Text.home_bottom.introduce-content-fourth") ?></p>
                </div>
            </div>
            <div class="row item item-fifth">
                <div class="col-5 left-first">
                    <h4>
                        <?= lang("Text.home_bottom.title-content-fifth") ?></h4>
                    <p> <?= lang("Text.home_bottom.introduce-content-fifth") ?></p>
                </div>
                <div class="col-7 right-first">
                    <div class="item-image item-ip-rieng">
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="home__slider">
        <div class="container">
            <h2 class="title"><?= lang("Text.home_slider.title") ?></h2>
            <p class="introduce"><?= lang("Text.home_slider.introduce") ?></p>
            <div class="content__slider">
                <div class="owl-carousel owl-theme">
                    <?php if (!empty($customer_reviews)) {
                        foreach ($customer_reviews as $k => $v) { ?>
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
                                $width = ['700w', '1024w', '1w'];
                                if (count($attachments) > 1) { ?>
                                    <img alt="avatar" title="avatar" src="<?php echo $attachments[2] ?>"
                                         srcset="
                                <?php foreach ($attachments as $key => $value) {
                                             echo $value . ' ' . $width[$key] . ',';
                                         } ?>"
                                    >
                                <?php } else { ?>
                                    <img alt="avatar" title="avatar" src="<?php echo $v['attachment'] ?>">
                                <?php } ?>

                                <!--                                <img  src="-->
                                <?//= $v['attachment']; ?><!--" alt="avatar">-->
                            </div>
                            <?php
                        }
                    } ?>
                </div>
            </div>
        </div>
    </section>
<?= $this->endSection() ?>