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
                        <a href="<?= base_url('service/edit/' . @$serviceGroup) ?>" class="btn btn-sm btn-success mb-2">Sửa</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="span-1" style="width: 200px;">Mốc thời gian<span
                                    style="color: red;">(*)</span></span>
                </div>
                <div class="col-xs-4" style="width: 200px">
                    <select disabled name="service_timeline" id="service_timeline" class="form-control"
                            aria-label="Loại danh mục "
                            aria-describedby="span-1">
                        <option value="" disabled selected>---Chọn mốc thời gian---</option>
                        <?php if (@SERVICE_TIMELINE) { ?>
                            <?php foreach (SERVICE_TIMELINE as $key => $value) { ?>
                                <?php if ($key == @$serviceEN['service_timeline']) { ?>
                                    <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="span-4" style="width: 200px;">Trạng thái <span
                                    style="color: red;">(*)</span></span>
                </div>
                <div class="col-xs-4" style="width: 200px">
                    <select disabled name="service_status" id="service_status" class="form-control"
                            aria-label="status_en"
                            aria-describedby="span-4">
                        <option value="" disabled selected>---Chọn Trạng thái---</option>
                        <?php if (@POST_STATUS) { ?>
                            <?php foreach (POST_STATUS as $key => $value) { ?>
                                <?php if ($key == @$serviceEN['service_status']) { ?>
                                    <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                <?php } else { ?>
                                    <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                <?php }
                            }
                        } ?>
                    </select>
                </div>
            </div>
            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="english-tab" data-toggle="pill" href="#english" role="tab"
                       aria-controls="english" aria-selected="true">Tiếng Anh</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="vietnamese-tab" data-toggle="pill" href="#vietnamese" role="tab"
                       aria-controls="vietnamese" aria-selected="false">Tiếng Việt</a>
                </li>
            </ul>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="english" role="tabpanel" aria-labelledby="english-tab">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Tên <span
                                            style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="service_name_en" id="service_name_en"
                               placeholder="Tên tiếng anh" value="<?= @$serviceEN['service_name'] ?>"
                               aria-label="Service title" aria-describedby="span-5">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Giá dịch vụ <span
                                            style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="service_price_en" id="service_price_en"
                               placeholder="100.." value="<?= @$serviceEN['service_price'] ?>"
                               aria-label="Service title" aria-describedby="span-5">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Mô tả lợi ích <span
                                            style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="service_introduce_en"
                               id="service_introduce_en"
                               placeholder="Mô tả.." value="<?= @$serviceEN['service_introduce'] ?>"
                               aria-label="Service title" aria-describedby="span-5">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Tính năng dịch vụ <span
                                            style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="service_content_en"
                               id="service_content_en"
                               placeholder="Ngăn cách tính năng = dấu ," value="<?= @$serviceEN['service_content'] ?>"
                               aria-label="Service title" aria-describedby="span-5">
                    </div>
                </div>
                <div class="tab-pane fade" id="vietnamese" role="tabpanel" aria-labelledby="vietnamese-tab">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="span-51" style="width: 200px;">Tên <span
                                            style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="service_name_vn" id="service_name_vn"
                               placeholder="Tên tiếng việt" value="<?= @$serviceVN['service_name'] ?>" aria-label="Tên "
                               aria-describedby="span-51">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Giá dịch vụ <span
                                            style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="service_price_vn" id="service_price_vn"
                               placeholder="30000" value="<?= @$serviceVN['service_price'] ?>"
                               aria-label="Service title" aria-describedby="span-5">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Mô tả lợi ích <span
                                            style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="service_introduce_vn"
                               id="service_introduce_vn"
                               placeholder="Mô tả.." value="<?= @$serviceVN['service_introduce'] ?>"
                               aria-label="Service title" aria-describedby="span-5">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Tính năng dịch vụ <span
                                            style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="service_content_vn"
                               id="service_content_vn"
                               placeholder="Ngăn cách tính năng = dấu ," value="<?= @$serviceVN['service_content'] ?>"
                               aria-label="Service title" aria-describedby="span-5">
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