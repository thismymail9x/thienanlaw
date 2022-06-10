<?php //if (!empty($blogs)) {
//foreach ($blogs as $k => $v) {?>
<!--<div class="col-12 col-md-6 col-xl-4">-->
<!--            <ul style="padding: 0;">-->
<!--                        <li>-->
<!--                            <div>-->
<!--                                <span class="icon-document-child"></span>-->
<!--                            </div>-->
<!--                            <a href="--><?//= base_url().'/'.$v['category_title'].'/'. @$v['slug']; ?><!--"-->
<!--                               title="--><?//= @$v['post_title']; ?><!--">-->
<!--                                --><?//= @$v['post_title']; ?>
<!--                            </a>-->
<!--                        </li>-->
<!--            </ul>-->
<!--</div>-->
<!--    --><?php
//}
//} else { echo 'Không có bài viết nào';} ?>





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
} else {
    if (@$lang == 'vi') {
        echo 'Không tìm thấy bài viết!';
    } elseif (@$lang = 'en') {
        echo 'Not found!';
    }
} ?>
