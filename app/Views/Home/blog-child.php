<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("css_home") ?>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/header.css" type="text/css">
        <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/blog-child.css">
        <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/blogs.css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/global.css" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/plugins/bootstrap4.5/css/bootstrap.min.css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" lazyload>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/section-footer-top.css" type="text/css" lazyload>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/footer.css" type="text/css" lazyload>
<?= $this->endSection() ?>
<?= $this->section("content_home") ?>
<section class="blog__child">
    <div class="blog__breadcrumb">
        <div class="container">
            <p><a href="<?= base_url('/'); ?>"><?= lang("Text.blog-child.home") ?>&nbsp;&nbsp;|</a>
                <a href="<?php if ($blog['post_type'] == 'SUPPORT')
                { echo base_url().'/support/'. @$category['slug'];}
                elseif ($blog['post_type'] == 'BLOG'){echo base_url().'/blogs/'. @$category['slug'];} ?>
                ">&nbsp;&nbsp;<?= @$category['post_title']?>&nbsp;&nbsp;|</a><a >&nbsp;&nbsp;<?= @$blog['post_title']?></a></p>
        </div>
    </div>
    <div class="blog__content container">
        <div class="create-time">
            <div class="item-calendar"></div>
            <p class="text-time"><?= date('d.m.Y',strtotime(@$blog['created_at'])); ?></p>
        </div>
        <h1 class="title limit-text-2"><?= @$blog['post_title']?></h1>

        <div class="blog-avatar">
            <?php
            $attachments = explode(',',$blog['attachment']);
            $width = ['700w','1024w','1w']; ?>
                <img alt="<?= @$blog['post_title']?>" src="<?php echo $attachments[2] ?>"
                     srcset="
                     <?php foreach ($attachments as $key=>$value) {
                         echo $value.' '.$width[$key].',';
                     } ?>">
            <div class="blog-category">
                <?= @$category['post_title']?>
            </div>
        </div>
        <p class="introduce-blog">
            <?= @$blog['post_introduce']?>
        </p>
        <div class="content">
            <p><?= @$blog['post_content']?></p>
        </div>
    </div>
    <?php if (!empty($blogs_more)) { ?>
    <div class="other__blogs container">
        <h2 class="title"><?= lang("Text.blog-child.blog-more") ?></h2>
        <div class="row">
            <?php  foreach ($blogs_more as $k =>$v) { ?>
                    <div class="col-xs-6 col-md-4 col-xl-4 sub-item">
                        <a href="<?= base_url('/'.$category['slug'].'/'.$v['slug']); ?>">
                            <div class="card">
                                <?php
                                $attachments = explode(',',$v['attachment']);
                                $width = ['700w','1024w','1w']; ?>
                                    <img class="card-img" alt="blogs-name" src="<?php echo $attachments[2] ?>"
                                         srcset="
                     <?php foreach ($attachments as $key=>$value) {
                                             echo $value.' '.$width[$key].',';
                                         } ?>" >
                                <div class="card-body">
                                    <div class="create-time">
                                        <div class="item-calendar"></div>
                                        <p class="text-time"><?= date('d.m.Y',strtotime($v['created_at'])); ?></p>
                                    </div>
                                    <h5 class="card-title limit-text-2"><?= $v['post_title']?></h5>
                                    <p class="card-text limit-text-3"><?= $v['post_introduce']?> </p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <?php
                } ?>
        </div>
    </div>
    <?php } ?>
</section>
<?php echo @$blog_bottom['post_content'];?>
<?= $this->endSection() ?>