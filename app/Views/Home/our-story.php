<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("content_home") ?>
<section class="our__story-top">
    <div class="top-section">
        <h1 class="title">
            <?= lang("Text.our_story-top.title") ?> <span class="d-block"><?= lang("Text.our_story-top.title-span-first") ?></span>
            <span class="d-block"><?= lang("Text.our_story-top.title-span-second") ?></span>
        </h1>
    </div>
</section>
<section class="our__story-center">
    <div class="container">
        <h2 class="title"><?= lang("Text.our_story-center.title") ?></h2>
        <p class="introduce">
            <?= lang("Text.our_story-center.introduce") ?>
            <span class="d-block"> <?= lang("Text.our_story-center.introduce-span-first") ?></span>
            <span class="d-block"><?= lang("Text.our_story-center.introduce-span-second") ?></span>
        </p>
        <h2 class="title title-second"><?= lang("Text.our_story-center.title-second") ?></h2>
        <div class="row item">
            <div class="col-5">
                <h3><?= lang("Text.our_story-center.row-title-first") ?></h3>
                <p>
                    <?= lang("Text.our_story-center.row-introduce-first") ?></p>
            </div>
            <div class="col-7">
                <div class="item-image item-mb">

                </div>

            </div>
        </div>
        <div class="row item">
            <div class="col-7">
                <div class="item-image item-tt">

                </div>

            </div>
            <div class="col-5">
                <h3><?= lang("Text.our_story-center.row-title-second") ?></h3>
                <p>
                    <?= lang("Text.our_story-center.row-introduce-second") ?> <span class="hide-mobile"><?= lang("Text.our_story-center.row-introduce-span-second") ?></span></p>
            </div>
        </div>
        <div class="row item">
            <div class="col-5">
                <h3><?= lang("Text.our_story-center.row-title-third") ?></h3>
                <p>
                    <?= lang("Text.our_story-center.row-introduce-third") ?> <span class="hide-mobile"> <?= lang("Text.our_story-center.row-introduce-span-third") ?></span></p>
            </div>
            <div class="col-7">
                <div class="item-image item-bm">

                </div>

            </div>
        </div>
        <div class="row item">
            <div class="col-7">
                <div class="item-image item-kt">

                </div>
            </div>
            <div class="col-5">
                <h3><?= lang("Text.our_story-center.row-title-fourth") ?></h3>
                <p>
                    <?= lang("Text.our_story-center.row-introduce-fourth") ?> <span class="hide-mobile"><?= lang("Text.our_story-center.row-introduce-span-fourth") ?></span></p>
            </div>
        </div>
        <div class="row item">
            <div class="col-5">
                <h3><?= lang("Text.our_story-center.row-title-fifth") ?></h3>
                <p>
                    <?= lang("Text.our_story-center.row-introduce-fifth") ?> <span class="hide-mobile"><?= lang("Text.our_story-center.row-introduce-span-fifth") ?> </span></p>
            </div>
            <div class="col-7">
                <div class="item-image item-tn">
                </div>
            </div>
        </div>
    </div>
</section>
<?= $this->endSection() ?>