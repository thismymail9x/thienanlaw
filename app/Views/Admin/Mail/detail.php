<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 400px;">
                        <h6 class="m-0 font-weight-bold text-primary">Chi tiết thông tin Mail</h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url('mail?for_menu=1') ?>" class="btn btn-sm btn-dark mb-2">Danh sách</a>
                        <a href="<?= base_url('mail/edit/' . @$mailId) ?>" class="btn btn-sm btn-success mb-2">Sửa</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">

            <div class="form-row">
                <?php if (isset($errors['mail_status'])) { ?>
                    <label for="status_en"><span
                                style="color: red; font-style: italic;"><?php print_r($errors['mail_status']); ?></span></label>
                <?php } ?>
                <div class="form-group col-md-4">
                    <label for="inputKey">Kiểu email<span style="color: red;">(*)</span></label>
                    <select disabled name="mail_type" id="mail_type" class="form-control"
                            aria-label="Loại mail "
                            aria-describedby="span-1">
                        <option value="" disabled selected>Chọn</option>
                        <?php if (@MAIL_TYPE) { ?>
                            <?php if (isset(MAIL_TYPE[@$mail['mail_type']]) ) { ?>
                                <option selected ><?php echo MAIL_TYPE[@$mail['mail_type']]; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputKey">Trạng thái<span style="color: red;">(*)</span></label>
                    <select disabled name="mail_status" id="mail_status" class="form-control"
                            aria-label="status_en"
                            aria-describedby="span-4">
                        <option value="" disabled selected>Chọn</option>
                        <?php if (@MAIL_STATUS) { ?>
                            <?php if (isset(MAIL_STATUS[@$mail['mail_status']]) ) { ?>
                                <option selected ><?php echo MAIL_STATUS[@$mail['mail_status']]; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label>Mã mail<span style="color: red;">(*)</span></label>
                    <input type="text" selected disabled placeholder="Dùng để định danh các mail với nhau..." value="<?= @$mail['mail_code']?>" name="mail_code" class="form-control">
                </div>
            </div>

            <div class="js__mail-append">
                <hr>
                <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <div class="form-group">
                        <label>Loại ngôn ngữ<span style="color: red;">(*)</span></label>
                        <select disabled class="form-control choose-lang-create" name="lang">
                            <?php foreach (@$langCode as $key) { ?>
                                <option <?php if ($key['lang_code_key'] == @$mail['lang']) { echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                            <?php } ?>

                        </select>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputEmail1">Tiêu đề mail <span
                                    style="color: red;">(*)</span></label>
                        <input disabled type="text" class="form-control" name="mail_title[]" id="mail_title_en"
                               placeholder="Tiêu đề..." value="<?= @$mail['mail_title'] ?>"
                               aria-label="mail title" aria-describedby="span-5">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Nội dung <span
                                    style="color: red;">(*)</span></label>
                        <textarea disabled class="form-control mail_content_detail" name="mail_content[]" id="mail_content"
                                  placeholder="Nội dung" aria-label="Nội dung" aria-describedby="span-61"
                                  rows="5"><?= @$mail['mail_content'] ?></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <style>
        .custom-mail {
            border: 1px solid #d1d3e2;
            width: 100%;
            border-radius: 0 5px 5px 0;
            padding: 10px 15px;
            background: #EAECF4;
        }
    </style>
    <script>
        $(document).ready(function () {
            tinymce.init({
                selector:'.mail_content_detail',
                readonly:true,
            });
        })

    </script>
<?= $this->endSection() ?>