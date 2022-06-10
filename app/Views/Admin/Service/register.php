<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('service/register') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('service?for_menu=1') ?>"
                               class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputKey">Mốc thời gian<span style="color: red;">(*)</span></label>
                        <select required name="service_timeline" id="service_timeline" class="form-control"
                                aria-label="Loại service "
                                aria-describedby="span-1">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@SERVICE_TIMELINE) { ?>
                                <?php foreach (SERVICE_TIMELINE as $key => $value) { ?>
                                    <?php if ($key == @$service['service_timeline']) { ?>
                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['service_timeline'])) { ?>
                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['service_timeline']); ?></small>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKey">Trạng thái<span style="color: red;">(*)</span></label>
                        <select required name="service_status" id="service_status" class="form-control"
                                aria-label="status_en"
                                aria-describedby="span-4">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@POST_STATUS) { ?>
                                <?php foreach (POST_STATUS as $key => $value) { ?>
                                        <option <?php if ($key == @$service['service_status'] && @$service['service_status'] !='') {echo 'selected';} ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['service_status'])) { ?>
                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['service_status']); ?></small>
                        <?php } ?>
                    </div>
                </div>
                <?php if (isset($service)) { foreach ($service['lang'] as $k => $v) { ?>
                    <div class="js__service-append">
                        <hr>
                        <p class="text-right"><span class="ml-3 btn btn-sm btn-primary btn__new-lang-service"><i class="fas fa-plus"></i> Thêm</span>
                        </p>
                        <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Loại ngôn ngữ<span style="color: red;">(*)</span></label>
                                        <select required class="form-control choose-lang-create" name="lang[]">
                                            <option value="">Chọn</option>
                                            <?php foreach (@$langCode as $key) { ?>
                                                <option <?php if ($key['lang_code_key']  == @$v) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Số thứ tự </label>
                                        <input autocomplete="off" type="text" class="form-control" name="number_order[]"
                                               placeholder="số thứ tự..." value="<?= @$service['number_order'][$k] ?>">
                                        <?php if (isset($errors['number_order'])) { ?>
                                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['number_order']); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tên dịch vụ <span
                                                    style="color: red;">(*)</span></label>
                                        <input autocomplete="off" required type="text" class="form-control" name="service_title[]"
                                               placeholder="Tên..." value="<?= @$service['service_name'][$k] ?>">
                                        <?php if (isset($errors['service_name'])) { ?>
                                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['service_name']); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Giá dịch vụ <span
                                                    style="color: red;">(*)</span></label>
                                        <input autocomplete="off" required type="text" class="form-control service_price" name="service_price[]"
                                               placeholder="Giá..." value="<?= @$service['service_price'][$k] ?>">
                                        <?php if (isset($errors['service_price'])) { ?>
                                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['service_price']); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Mô tả lợi ích <span
                                                    style="color: red;">(*)</span></label>
                                        <input autocomplete="off" required type="text" class="form-control" name="service_introduce[]"
                                               placeholder="mô tả..." value="<?= @$service['service_introduce'][$k] ?>">
                                        <?php if (isset($errors['service_introduce'])) { ?>
                                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['service_introduce']); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Tính năng dịch vụ <span
                                                    style="color: red;">(*)</span></label>
                                        <input autocomplete="off" required type="text" class="form-control" name="service_content[]"
                                               placeholder="phân cách nhau bằng dấu ," value="<?= @$service['service_content'][$k] ?>">
                                        <?php if (isset($errors['service_content'])) { ?>
                                            <small class="form-text" style="color: red; font-style: italic;"><?php print_r($errors['service_content']); ?></small>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } } else { ?>
                    <div class="js__service-append">
                        <hr>
                        <p class="text-right"><span class="ml-3 btn btn-sm btn-primary btn__new-lang-service"><i class="fas fa-plus"></i> Thêm</span>
                        </p>
                        <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Loại ngôn ngữ<span style="color: red;">(*)</span></label>
                                        <select required class="form-control choose-lang-create" name="lang[]">
                                            <option value="">Chọn</option>
                                            <?php foreach (@$langCode as $key) { ?>
                                                <option value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label>Số thứ tự </label>
                                        <input autocomplete="off" type="text" class="form-control" name="number_order[]"
                                               placeholder="vị trí..." value="<?= @$service['number_order'] ?>">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEservice1">Tên dịch vụ <span
                                                    style="color: red;">(*)</span></label>
                                        <input autocomplete="off" required type="text" class="form-control" name="service_name[]"
                                               placeholder="Tên..." value="<?= @$service['service_name'] ?>"
                                               aria-label="service title" aria-describedby="span-5">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEservice1">Giá dịch vụ <span
                                                    style="color: red;">(*)</span></label>
                                        <input autocomplete="off" required type="text" class="form-control service_price" name="service_price[]"
                                               placeholder="Giá..." value="<?= @$service['service_price']?>"
                                               aria-label="service title" aria-describedby="span-5">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEservice1">Mô tả lợi ích <span
                                                    style="color: red;">(*)</span></label>
                                        <input autocomplete="off" required type="text" class="form-control" name="service_introduce[]"
                                               placeholder="mô tả..." value="<?= @$service['service_introduce'] ?>"
                                               aria-label="service title" aria-describedby="span-5">
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="exampleInputEservice1">Tính năng dịch vụ <span
                                                    style="color: red;">(*)</span></label>
                                        <input autocomplete="off" required type="text" class="form-control" name="service_content[]"
                                               placeholder="phân cách nhau bằng dấu ," value="<?= @$service['service_content'] ?>"
                                               aria-label="service title" aria-describedby="span-5">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </form>
    </div>



    <style type="text/css">
        #cke_service_content_en, #cke_service_content_vn {
            width: 85%;
        }
    </style>
    <script>
        var key =1;
        $('body').delegate('.btn__new-lang-service','click',function () {
            key += 1;
            var append_div_service = '<div class="js__service-append js__service-append-'+key+'"> ' +
            '<hr> ' +
            '<p class="text-right">' +
            '<span class="ml-3 btn btn-sm btn-primary btn__new-lang-service"><i class="fas fa-plus"></i> Thêm</span>' +
            '</p>'+
            '<div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">' +
                '<div class="row">' +
                '<div class="col-6"> ' +
                '<div class="form-group"> ' +
                '<label>Loại ngôn ngữ<span style="color: red;">(*)</span></label> ' +
                '<select required class="form-control choose-lang-create" name="lang[]"> ' +
                '<option value="">Chọn</option>'
                  <?php foreach (@$langCode as $key) { ?>
                +'<option value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>'
                 <?php } ?>
                 +'</select>' +
                '</div>' +
                '</div> ' +
                '<div class="col-6"> ' +
                '<div class="form-group"><label>Số thứ tự </label> ' +
                '<input type="text" class="form-control" name="number_order[]"   placeholder="vị trí..."' +
                ' aria-label="service title" aria-describedby="span-5"> </div>' +
                '</div>' +
                '</div>'+
                '<div class="row"> ' +
                '<div class="col-6"> ' +
                '<div class="form-group"> ' +
                '<label>Tên dịch vụ <span style="color: red;">(*)</span></label> ' +
                '<input required type="text" class="form-control" name="service_name[]"   placeholder="Tên..."' +
                ' aria-label="service title" aria-describedby="span-5">' +
                '</div> ' +
                '</div> ' +
                '<div class="col-6"> ' +
                '<div class="form-group"> ' +
                '<label>Giá dịch vụ <span style="color: red;">(*)</span></label> ' +
                '<input required type="text" class="form-control service_price" name="service_price[]"   placeholder="Giá..." >' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<div class="row"> ' +
                '<div class="col-6"> ' +
                '<div class="form-group"> ' +
                '<label>Mô tả lợi ích <span style="color: red;">(*)</span></label> ' +
                '<input required type="text" class="form-control" name="service_introduce[]"   placeholder="mô tả..." ' +
                'value="" aria-label="service title" aria-describedby="span-5"> ' +
                '</div> ' +
                '</div> ' +
                '<div class="col-6"> ' +
                '<div class="form-group"> ' +
                '<label>Tính năng dịch vụ <span style="color: red;">(*)</span></label> ' +
                '<input required type="text" class="form-control" name="service_content[]"   placeholder="phân cách nhau bằng dấu ,"> ' +
                '</div> ' +
                '</div> ' +
                '</div> ' +
                '<p class="text-right"><span data-key='+ key +' class="ml-3 btn btn-sm btn-danger btn__remove-lang-service mt-2" ' +
                'title="Xóa"><i class="fas fa-times"></i></span></p>'+
                '</div>';
            $('.js__service-append').first().before(append_div_service);
            $('.service_price').mask('000,000,000,000,000', {reverse: true});
            //
        })

        $('body').delegate('.btn__remove-lang-service','click',function () {
            var numb= $(this).attr('data-key');
            $('.js__service-append-'+numb).remove();
        })

    </script>

<?= $this->endSection() ?>