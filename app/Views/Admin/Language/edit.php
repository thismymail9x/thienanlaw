<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('language/edit') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('language?for_menu=1') ?>"
                               class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">

                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="inputKey">Từ khóa</label>
                        <input autocomplete="off" type="search" name="lang_key" placeholder="service" value="<?= $lang['lang_key'];?>" required class="mt-2 form-control" id="inputKey">
                    </div>

                        <div class="form-group col-md-4">
                            <label>Loại ngôn ngữ
                            </label>
                            <select required class="form-control choose-lang-create mt-2" name="lang">
                                <option value="" disabled selected>Chọn</option>
                                <?php foreach (@$langCode as $key) { ?>
                                    <option <?php if ($key['lang_code_key']  == $lang['lang']) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Giá trị key</label>
                                <input type="search" value="<?=$lang['lang_value']?>" name="lang_value" required placeholder="..." class="form-control mt-2 input-lang-value">
                        </div>

                    <div class="form-group col-md-1">
                            <label for="">&nbsp;</label>
                            <i class="d-flex fas fa-check align-items-center mt-2 form-control" style="border:none;color: green;cursor: pointer;"></i>
                            <input autocomplete="off" type="hidden" name="lang_id" value="<?=$lang['lang_id']?>">
                    </div>

                </div>
            </div>
        </form>
    </div>
    <script>

    </script>
    <style type="text/css">
        label {
            line-height: 2;
        }
    </style>

<?= $this->endSection() ?>