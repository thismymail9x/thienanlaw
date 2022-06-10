<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('mail/edit') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('mail?for_menu=1') ?>"
                               class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputKey">Kiểu email<span style="color: red;">(*)</span></label>
                        <select required name="mail_type" id="mail_type" class="form-control"
                                aria-label="Loại mail "
                                aria-describedby="span-1">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@MAIL_TYPE) { ?>
                                <?php foreach (MAIL_TYPE as $key => $value) { ?>
                                        <option <?php if ($key == @$mail['mail_type']) { echo 'selected';}?> value="<?php echo $key; ?>" ><?php echo $value; ?></option>
                                    <?php
                                }
                            } ?>
                            <?php if (isset($errors['mail_type'])) { ?>
                                <small class="form-text text-muted" style="color: red; font-style: italic;"><?php print_r($errors['mail_type']); ?></small>
                            <?php } ?>
                        </select>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKey">Trạng thái<span style="color: red;">(*)</span></label>
                        <select required name="mail_status" id="mail_status" class="form-control"
                                aria-label="status_en"
                                aria-describedby="span-4">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@MAIL_STATUS) { ?>
                                <?php foreach (MAIL_STATUS as $key => $value) { ?>
                                        <option <?php if ($key == @$mail['mail_status']) { echo 'selected';}?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['mail_status'])) { ?>
                            <small class="form-text text-muted" style="color: red; font-style: italic;"><?php print_r($errors['mail_status']); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Mã mail<span style="color: red;">(*)</span></label>
                        <input autocomplete="off" type="text" required placeholder="Dùng để định danh các mail với nhau..." value="<?= @$mail['mail_code']?>" name="mail_code" class="form-control">
                        <?php if (isset($errors['mail_code'])) { ?>
                            <small class="form-text text-muted" style="color: red; font-style: italic;"><?php print_r($errors['mail_code']); ?></small>
                        <?php } ?>
                    </div>
                </div>

                <div class="js__mail-append">
                <hr>
                    <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="form-group">
                            <label>Loại ngôn ngữ<span style="color: red;">(*)</span></label>
                            <select required class="form-control choose-lang-create" name="lang">
                                <option value="">Chọn</option>
                                <?php foreach (@$langCode as $key) { ?>
                                    <option <?php if ($key['lang_code_key'] == @$mail['lang']) { echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                <?php } ?>
                            </select>
                            <?php if (isset($errors['lang'])) { ?>
                                <small class="form-text text-muted" style="color: red; font-style: italic;"><?php print_r($errors['mail_title']); ?></small>
                            <?php } ?>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề mail <span
                                        style="color: red;">(*)</span></label>
                            <input autocomplete="off" required type="text" class="form-control" name="mail_title" id="mail_title"
                                   placeholder="Tiêu đề..." value="<?= @$mail['mail_title'] ?>"
                                   aria-label="mail title" aria-describedby="span-5">
                            <?php if (isset($errors['mail_title'])) { ?>
                                <small class="form-text text-muted" style="color: red; font-style: italic;"><?php print_r($errors['mail_title']); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung <span
                                        style="color: red;">(*)</span></label>
                            <textarea class="form-control mail_content" name="mail_content" id="mail_content"
                                      placeholder="Nội dung" aria-label="Nội dung" aria-describedby="span-61"
                                      rows="5"><?= @$mail['mail_content'] ?></textarea>
                            <?php if (isset($errors['mail_content'])) { ?>
                                <small class="form-text text-muted" style="color: red; font-style: italic;"><?php print_r($errors['mail_content']); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" id="mail_id" name="mail_id" value="<?php echo @$mail['mail_id'] ?>">
        </form>
    </div>
    <style type="text/css">
        #cke_mail_content_en, #cke_mail_content_vn {
            width: 85%;
        }
    </style>
<?= $this->endSection() ?>