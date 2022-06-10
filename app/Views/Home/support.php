<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("css_home") ?>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/header.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/support.css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/global.css" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/plugins/bootstrap4.5/css/bootstrap.min.css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" lazyload>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/section-footer-top.css" type="text/css" lazyload>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/footer.css" type="text/css" lazyload>
<?= $this->endSection() ?>
<?= $this->section("content_home") ?>
    <section class="support__top ">
        <h1 class="container title"><?= lang("Text.support.title") ?></h1>
    </section>
    <section class="support__search d-flex justify-content-center">
        <div class="position-relative">
            <input class="input" type="text" placeholder="<?= lang("Text.support.place_holder") ?>...">
            <div class="submit-form">
                <div class="icon-search">
                </div>
                <span><?= lang("Text.support.search") ?></span>
            </div>
        </div>
    </section>
    <section class="support__center">
        <div class="container">
            <div class="row search-row">
                <?php if (!empty($blogCategories)) {
                    foreach ($blogCategories as $key => $value) { ?>
                        <div class="col-12 col-md-6 col-xl-4">
                            <a style="text-decoration: none" href="<?= $page['og_url'].'/'.$value['slug']?>">
                                <div class="title-category">
                                    <div class="icon-document"></div>
                                    <span><?= $value['post_title'] ?></span>
                                </div>
                            </a>
                            <ul>
                                <?php if (!empty($value['posts'])) {
                                    foreach ($value['posts'] as $k => $v) { ?>
                                        <li>
                                            <div>
                                                <span class="icon-document-child"></span>
                                            </div>
                                            <a href="<?= base_url().'/'.$value['slug'].'/'. $v['slug']; ?>"
                                               title="<?= $v['post_title']; ?>">
                                                <?= $v['post_title']; ?>
                                            </a>
                                        </li>
                                        <?php
                                    }
                                } ?>
                            </ul>
                        </div>
                        <?php
                    }
                } ?>
            </div>
        </div>
    </section>
    <section class="support__bottom">
        <div class="container">
            <p class="title">
                <?= lang("Text.support.title-bottom") ?>
            </p>
            <div class="title-email">
                <div class="icon-email"></div>
                <a href="mailto:help@intovpn.com" class="text-email">help@intovpn.com</a>
            </div>
            <span class="ticket-child"><?= lang("Text.support.introduce-bottom") ?> <span>(<?= lang("Text.support.introduce-span-bottom") ?>)</span></span>
            <div class="layer"></div>
        </div>
    </section>
<?= $this->endSection() ?>