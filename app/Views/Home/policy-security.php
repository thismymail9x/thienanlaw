<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("content_home") ?>
<section class="policy-security">
    <div class="blog__breadcrumb">
        <div class="container">
            <p><a href="<?php echo base_url();?>">Trang chủ&nbsp;&nbsp;|</a><a>&nbsp;&nbsp;<?= @$blog['post_title']?></a></p>
        </div>
    </div>
    <div class="blog__content container">
        <h1 class="title limit-text-2"><?= @$blog['post_title']?></h1>
        <p class="introduce-blog">
            <?= @$blog['post_introduce']?>
        </p>
        <div class="content">
            <p><?= @$blog['post_content']?></p>
        </div>
    </div>
</section>
<?= $this->endSection() ?>