<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('mail/register') ?>" method="post" enctype="multipart/form-data">
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
                                    <?php if ($key == @$mail['mail_type']) { ?>
                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['mail_type'])) { ?>
                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['mail_type']); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKey">Trạng thái<span style="color: red;">(*)</span></label>
                        <select required name="mail_status" id="mail_status" class="form-control"
                                aria-label="status_en"
                                aria-describedby="span-4">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@MAIL_STATUS) { ?>
                                <?php foreach (MAIL_STATUS as $key => $value) { ?>
                                    <?php if ($key == @$mail['mail_status'] && @$mail['mail_status'] !='') { ?>
                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['mail_status'])) { ?>
                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['mail_status']); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label>Mã mail<span style="color: red;">(*)</span></label>
                        <input autocomplete="off" type="text" required placeholder="Dùng để định danh các mail với nhau..." value="<?= @$mail['mail_code']?>" name="mail_code" class="form-control">
                        <?php if (isset($errors['mail_code'])) { ?>
                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['mail_code']); ?></small>
                        <?php } ?>
                    </div>
                </div>

                <?php if (isset($mail)) { foreach ($mail['lang'] as $k => $v) { ?>
                <div class="js__mail-append">
                    <hr>
                    <p class="text-right"><span class="ml-3 btn btn-sm btn-primary btn__new-lang-mail"><i class="fas fa-plus"></i> Thêm</span>
                    </p>
                    <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                        <div class="form-group">
                            <label>Loại ngôn ngữ<span style="color: red;">(*)</span></label>
                            <select required class="form-control choose-lang-create" name="lang[]">
                                <option value="">Chọn</option>
                                <?php foreach (@$langCode as $key) { ?>
                                    <option <?php if ($key['lang_code_key']  == @$v) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                <?php } ?>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Tiêu đề mail <span
                                    style="color: red;">(*)</span></label>
                            <input autocomplete="off" required type="text" class="form-control" name="mail_title[]" id="mail_title_en"
                                   placeholder="Tiêu đề..." value="<?= @$mail['mail_title'][$k] ?>"
                                   aria-label="mail title" aria-describedby="span-5">
                            <?php if (isset($errors['mail_title'])) { ?>
                                <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['mail_title']); ?></small>
                            <?php } ?>
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nội dung <span
                                    style="color: red;">(*)</span></label>
                            <textarea class="form-control mail_content" name="mail_content[]" id="mail_content"
                                      placeholder="Nội dung" aria-label="Nội dung" aria-describedby="span-61"
                                      rows="5"><?= @$mail['mail_content'][$k] ?></textarea>
                            <?php if (isset($errors['mail_content'])) { ?>
                                <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['mail_content']); ?></small>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <?php } } else { ?>
                    <div class="js__mail-append">
                        <hr>
                        <p class="text-right"><span class="ml-3 btn btn-sm btn-primary btn__new-lang-mail"><i class="fas fa-plus"></i> Thêm</span>
                        </p>
                        <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="form-group">
                                <label>Loại ngôn ngữ<span style="color: red;">(*)</span></label>
                                <select required class="form-control choose-lang-create" name="lang[]">
                                    <option value="">Chọn</option>
                                    <?php foreach (@$langCode as $key) { ?>
                                        <option value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="exampleInputEmail1">Tiêu đề mail <span
                                            style="color: red;">(*)</span></label>
                                <input autocomplete="off" required type="text" class="form-control" name="mail_title[]" id="mail_title_en"
                                       placeholder="Tiêu đề..." value="<?= @$mail['mail_title'] ?>"
                                       aria-label="mail title" aria-describedby="span-5">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Nội dung <span
                                            style="color: red;">(*)</span></label>
                                <textarea class="form-control mail_content" name="mail_content[]" id="mail_content"
                                          placeholder="Nội dung" aria-label="Nội dung" aria-describedby="span-61"
                                          rows="5"><?= @$mail['mail_content'] ?></textarea>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <input type="hidden" id="mail_id" name="mail_id" value="<?php echo @$mail['mail_id'] ?>">
        </form>
    </div>
    <style type="text/css">
        #cke_mail_content_en, #cke_mail_content_vn {
            width: 85%;
        }
    </style>
    <script>
        var key =1;
        $('body').delegate('.btn__new-lang-mail','click',function () {
            key += 1;
            var append_div_mail = '<div class="js__mail-append js__mail-append-'+key+'"> ' +
                '<hr> ' +
                '<p class="text-right">' +
                '<span class="ml-3 btn btn-sm btn-primary btn__new-lang-mail"><i class="fas fa-plus"></i> Thêm</span>' +
                '</p>'+
                '<div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;"> ' +
                '<div class="form-group"> ' +
                '<label>Loại ngôn ngữ<span style="color: red;">(*)</span></label> ' +
                '<select required class="form-control choose-lang-create" name="lang[]">' +
                '<option value="">Chọn</option>'
                <?php foreach (@$langCode as $key) { ?>
                +'<option value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>'
                <?php } ?>
                +'</select>' +
                '</div> ' +
                '<div class="form-group"> ' +
                '<label for="exampleInputEmail1">Tiêu đề mail <span style="color: red;">(*)</span></label> ' +
                '<input autocomplete="off" required type="text" class="form-control" name="mail_title[]" id="mail_title_en" placeholder="Tiêu đề..."' +
            +'" aria-label="mail title" aria-describedby="span-5">'
            +'</div> <div class="form-group"> ' +
            '<label for="exampleInputEmail1">Nội dung <span style="color: red;">(*)</span></label> ' +
            '<textarea class="form-control mail_content" name="mail_content[]" id="mail_content1" placeholder="Nội dung" aria-label="Nội dung" aria-describedby="span-61" rows="5">'
            +'</textarea>'
            +'</div> '
            +'</div>'
            +'<p class="text-right"><span data-key='+ key +' class="ml-3 btn btn-sm btn-danger btn__remove-lang-mail mt-2" title="Xóa"><i class="fas fa-times"></i></span></p>'
            +'</div>';
            $('.js__mail-append').first().before(append_div_mail);

            //
            window.tinymce.dom.Event.domLoaded = true;
            tinymce.init({
                selector: '#post_content_vn, #post_content_en, .mail_content',
                width: '100%',
                height: 300,
                toolbar: [
                    'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | imageupload insertfile image media template link anchor codesample | ltr rtl',
                ],
                plugins: 'image code link print preview paste importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
                menu: {
                    file: {
                        title: 'File',
                        items: 'newdocument restoredraft | preview | print'
                    },
                    edit: {
                        title: 'Edit',
                        items: 'undo redo | cut copy paste | selectall | searchreplace'
                    },
                    view: {
                        title: 'View',
                        items: 'code | visualaid visualchars visualblocks | preview fullscreen'
                    },
                    insert: {
                        title: 'Insert',
                        items: 'image link media template codesample inserttable | charmap emoticons hr | pagebreak nonbreaking anchor toc | insertdatetime'
                    },
                    format: {
                        title: 'Format',
                        items: 'bold italic underline strikethrough superscript subscript codeformat | formats blockformats fontformats fontsizes align | forecolor backcolor | removeformat'
                    },
                    tools: {
                        title: 'Tools',
                        items: 'code wordcount'
                    },
                    table: {
                        title: 'Table',
                        items: 'inserttable | cell row column | tableprops deletetable'
                    },
                    help: {
                        title: 'Help', items: 'help'
                    }
                },
                mobile: {
                    menubar: true
                },
                setup: function (editor) {
                    initImageUpload(editor);
                }
            });

        })

        $('body').delegate('.btn__remove-lang-mail','click',function () {
            var numb= $(this).attr('data-key');
            $('.js__mail-append-'+numb).remove();
        })

    </script>

<?= $this->endSection() ?>