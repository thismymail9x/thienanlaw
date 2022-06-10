<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("css_home") ?>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/header.css" type="text/css">
<!--    <link rel="stylesheet" href="--><?//= BASE_URL_GLOBAL ?><!--/public/css/home/support.css">-->
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/blogs.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/blog-child.css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/global.css" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/plugins/bootstrap4.5/css/bootstrap.min.css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" lazyload>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/section-footer-top.css" type="text/css" lazyload>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/footer.css" type="text/css" lazyload>
<?= $this->endSection() ?>

<?= $this->section("content_home") ?>
    <section class="blogs-tabs">
    <section class="blog__child">
        <div class="blog__breadcrumb">
            <div class="container">
                <p><a href="<?= base_url('/'); ?>"><?= lang("Text.blog-child.home") ?>&nbsp;&nbsp;|</a><a href="<?= base_url().'/support/'.@$category['slug']; ?>">&nbsp;&nbsp;<?= @$category['post_title'] ?></a></p>
            </div>
        </div>
    </section>
        <div class="container">
            <div class="tab-content" >
                        <div class="tab-pane fade fade active show " id="" role="tabpanel"
                             aria-labelledby="pills-bantin-tab">
                            <div class="blogs__content">
                                <div class="container">
                                    <div class="row row-custom">
                                        <?php if (!empty($supports)) {
                                            foreach ($supports as $k => $v) { ?>
                                                    <div class="col-xs-6 col-md-4 col-xl-4 sub-item">
                                                        <a href="<?= base_url('/'.$category['slug'].'/'.$v['slug']); ?>">
                                                            <div class="card">
                                                                <?php
                                                                $attachments = explode(',',$v['attachment']);
                                                                $width = ['700w','1024w','1w']; ?>
                                                                    <img class="card-img img_under" alt="<?= $v['post_title']; ?>" src="<?php echo $attachments[2] ?>"
                                                                         srcset="
                                                                <?php foreach ($attachments as $key=>$va) {
                                                                             echo $va.' '.$width[$key].',';
                                                                         } ?>">
                                                                <div class="card-body">
                                                                    <div class="create-time">
                                                                        <div class="item-calendar"></div>
                                                                        <p class="text-time"><?= date('d.m.Y',strtotime($v['created_at'])); ?></p>
                                                                    </div>
                                                                    <h5 class="card-title limit-text-2"><?= $v['post_title']; ?></h5>
                                                                    <p class="card-text limit-text-2"><?= $v['post_introduce']; ?></p>
                                                                </div>
                                                            </div>
                                                        </a>
                                                    </div>
                                                    <?php
                                            }
                                        } ?>
                                    </div>
                                    <div class="row m-0">
                                        <div class="col-12">
                                            <?= $pager->links('supports', 'home_pagination') ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
            </div>

        </div>

    </section>
<?php echo @$blog_bottom['post_content'];?>
<?= $this->endSection() ?>