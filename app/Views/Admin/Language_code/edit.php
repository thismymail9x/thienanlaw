<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('language_code/edit') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('language_code?for_menu=1') ?>" class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <input type="hidden" id="lang_code_id" name="lang_code_id"
                       value="<?php echo @$langCode['lang_code_id'] ?>">

                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 150px;">Mã ngôn ngữ <span
                                            style="color: red;">(*)</span></span>
                    </div>
                    <input autocomplete="off" required type="text" class="form-control" name="lang_code_key" id="lang_code_key"
                           placeholder="viết tắt chữ thường..." value="<?= @$langCode['lang_code_key'] ?>"
                           aria-label="" aria-describedby="span-5">
                    <?php if (isset($errors['lang_code_key'])) { ?>
                        <label for="lang_code_key"><span
                                    style="color: red; font-style: italic;"><?php print_r($errors['lang_code_key']); ?></span></label>
                    <?php } ?>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 150px;">Mô tả <span
                                            style="color: red;">(*)</span></span>
                    </div>
                    <input autocomplete="off" required type="text" class="form-control" name="lang_code_description" id="lang_code_description"
                           placeholder="là ngôn ngữ nào..." value="<?= @$langCode['lang_code_description'] ?>"
                           aria-label="" aria-describedby="span-5">
                    <?php if (isset($errors['lang_code_description'])) { ?>
                        <label for="lang_code_description"><span
                                    style="color: red; font-style: italic;"><?php print_r($errors['lang_code_description']); ?></span></label>
                    <?php } ?>
                </div>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 150px;">Kí hiệu tiền tệ <span
                                            style="color: red;">(*)</span></span>
                    </div>
                    <input autocomplete="off" required type="text" class="form-control" name="currency_symbol" id="currency_symbol"
                           placeholder="kí hiệu tiền..." value="<?= @$langCode['currency_symbol'] ?>"
                           aria-label="" aria-describedby="span-5">
                    <?php if (isset($errors['currency_symbol'])) { ?>
                        <label for="currency_symbol"><span
                                    style="color: red; font-style: italic;"><?php print_r($errors['currency_symbol']); ?></span></label>
                    <?php } ?>
                </div>
            </div>
        </form>
    </div>
<?= $this->endSection() ?>