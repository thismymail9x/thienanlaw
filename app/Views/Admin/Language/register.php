<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('language/register') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?>
                            </h6>

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
                    <div class="js__div-after"></div>
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="inputKey">Từ khóa</label>
                            <input autocomplete="off" type="search" value="<?=@$lang['lang_key']?>" name="lang_key" placeholder="service..." required class="mt-2 form-control" id="inputKey">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Chọn loại ngôn ngữ
                                <span class="ml-3 btn btn-sm btn-secondary btn__new-lang"><i class="fas fa-plus"></i> Thêm</span>
                            </label>


                            <?php if (isset($lang)) { foreach ($lang['lang'] as $k => $v) { ?>
                                <select required class="form-control choose-lang-create mt-2" name="lang[]">
                                    <option value="" disabled selected>Chọn</option>
                                    <?php foreach (@$langCode as $key) { ?>
                                        <option <?php if ($key['lang_code_key']  == @$v) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                    <?php } ?>
                                </select>
                            <?php } } else {?>
                                <select required class="form-control choose-lang-create mt-2" name="lang[]">
                                    <option value="">Chọn</option>
                                    <?php foreach (@$langCode as $key) { ?>
                                        <option value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                    <?php } ?>
                                </select>
                            <?php } ?>

                        </div>
                        <div class="form-group col-md-4">
                            <label>Giá trị key</label>
                            <?php if (isset($lang)) { foreach ($lang['lang_value'] as $k => $v) { ?>
                                <input autocomplete="off" type="search" value="<?=$v?>" name="lang_value[]" required placeholder="..." class="form-control mt-2 input-lang-value" >
                            <?php } } else { ?>
                            <input autocomplete="off" type="search" value="" name="lang_value[]" required placeholder="..." class="form-control mt-2 input-lang-value">
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-1">
                            <label for="">&nbsp;</label>
                            <i class="d-flex fas fa-check align-items-center mt-2 form-control" style="border:none;color: green;cursor: pointer;"></i>
                            <div class="js__hide-input"></div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
    <script>

    </script>
    <style type="text/css">
        #cke_post_content_en, #cke_post_content_vn {
            width: 85%;
        }
        label {
            line-height: 2;
        }
    </style>
    <script>

    //select thêm input ngôn ngữ
    var key =1;
    $('.btn__new-lang').click(function (){
        key += 1;
        var append_input_select = '<select required class="form-control choose-lang-create mt-2 select-num-'+key+'" name="lang[]"><option value="" disabled selected>Chọn</option>'
            <?php foreach (@$langCode as $key) { ?>
            +'<option value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>'
             <?php } ?>
            + '</select>';

        var append_input_value = ' <input type="search" name="lang_value[]" required placeholder="..." class="input-num-'+key+' form-control input-lang-value mt-2">';
        var append_delete_input = '<i data-key="'+key+'" class="d-flex fas fa-times js__hide-input align-items-center form-control mt-2" style="border:none;color: red;cursor: pointer;"></i>';

        $('.choose-lang-create').last().after(append_input_select);
        $('.input-lang-value').last().after(append_input_value);
        $('.js__hide-input').last().after(append_delete_input);
    })
    </script>
<?= $this->endSection() ?>