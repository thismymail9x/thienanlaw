<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 400px;">
                        <h6 class="m-0 font-weight-bold text-primary">Chi tiết thông tin danh mục</h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url('service?for_menu=1') ?>" class="btn btn-sm btn-dark mb-2">Danh sách</a>
                        <a href="<?= base_url('service/edit/' . @$service['service_id']) ?>" class="btn btn-sm btn-success mb-2">Sửa</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputKey">Mốc thời gian<span style="color: red;">(*)</span></label>
                    <select disabled name="service_timeline" id="service_timeline" class="form-control"
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
                </div>
                <div class="form-group col-md-4">
                    <label for="inputKey">Trạng thái<span style="color: red;">(*)</span></label>
                    <select disabled name="service_status" id="service_status" class="form-control"
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
            <div class="js__service-append">
                <hr>
                <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label>Loại ngôn ngữ<span style="color: red;">(*)</span></label>
                                <select disabled class="form-control choose-lang-create" name="lang[]">
                                    <option value="">Chọn</option>
                                    <?php foreach (@$langCode as $key) { ?>
                                        <option <?php if ($key['lang_code_key'] == @$service['lang']) {echo 'selected';} ?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label>Số thứ tự </label>
                                <input disabled type="text" class="form-control" name="number_order[]"
                                       placeholder="vị trí..." value="<?= @$service['number_order'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEservice1">Tên dịch vụ <span
                                            style="color: red;">(*)</span></label>
                                <input disabled type="text" class="form-control" name="service_name[]"
                                       placeholder="Tên..." value="<?= @$service['service_name'] ?>"
                                       aria-label="service title" aria-describedby="span-5">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEservice1">Giá dịch vụ <span
                                            style="color: red;">(*) </span><?php foreach ($langCode as $k) {
                                        if ($k['lang_code_key']==$service['lang']) {
                                            echo $k['currency_symbol']; break;
                                        }
                                    } ?></label>
                                <input disabled type="text" class="form-control service_price" name="service_price[]"
                                       placeholder="Giá..." value="<?= @$service['service_price'] ?>"
                                       aria-label="service title" aria-describedby="span-5">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEservice1">Mô tả lợi ích <span
                                            style="color: red;">(*)</span></label>
                                <input disabled type="text" class="form-control" name="service_introduce[]"
                                       placeholder="mô tả..." value="<?= @$service['service_introduce'] ?>"
                                       aria-label="service title" aria-describedby="span-5">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="exampleInputEservice1">Tính năng dịch vụ <span
                                            style="color: red;">(*)</span></label>
                                <input disabled type="text" class="form-control" name="service_content[]"
                                       placeholder="phân cách nhau bằng dấu ," value="<?= @$service['service_content'] ?>"
                                       aria-label="service title" aria-describedby="span-5">
                            </div>
                        </div>
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
<?= $this->endSection() ?>