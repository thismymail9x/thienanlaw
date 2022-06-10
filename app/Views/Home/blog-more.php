<?php foreach ($blogs as $v) {?>
<div class="col-xs-6 col-md-4 col-xl-4 sub-item">
    <a href="<?= base_url('/'.$category['slug'].'/'.$v['slug']); ?>">
        <div class="card">
            <?php
            $attachments = explode(',',$v['attachment']);
            $width = ['700w','1024w','1w']; ?>
                <img class="card-img img_under" alt="blogs-name" src="<?php echo $attachments[2] ?>"
                     srcset="
                     <?php foreach ($attachments as $key=>$value) {
                         echo $value.' '.$width[$key].',';
                     } ?>" >
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
<?php } ?>