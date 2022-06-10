<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('post/edit') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('post?for_menu=1') ?>" class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <?php if (isset($errors['post_type'])) { ?>
                    <label for="post_type"><span
                                style="color: red; font-style: italic;"><?php print_r($errors['lang']); ?></span></label>
                <?php } ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="span-1" style="width: 150px;">Loại bài viết <span
                                    style="color: red;">(*)</span></span>
                    </div>
                    <div class="col-xs-4">
                        <select required name="post_type" id="post_type" class="form-control" aria-label="Loại bài "
                                aria-describedby="span-1">
                            <option value="" disabled selected>---Chọn loại---</option>
                            <?php if (@POST_TYPE) { ?>
                                <?php foreach (POST_TYPE as $key => $value) { ?>
                                    <?php if ($key == @$postEN['post_type']) { ?>
                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <div class="input-group mb-3 ">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="span-1" style="width: 150px;">Danh mục <span
                                    style="color: red;">(*)</span></span>
                    </div>
                    <div class="col-xs-4">
                        <select required name="category_id" id="category_id" class="form-control category__load"
                                aria-label="Danh mục "
                                aria-describedby="span-1">
                            <option value="" disabled selected>---Chọn danh mục---</option>
                            <?php if (@$post_categories) { ?>
                                <?php foreach ($post_categories as $key => $value) { ?>
                                    <?php if ($key == @$postEN['category_id']) { ?>
                                        <option value="<?php echo $value['category_id']; ?>"
                                                selected><?php echo $value['category_name']; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $value['category_id']; ?>"><?php echo $value['category_name']; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                    </div>
                </div>
                <?php if (isset($errors_en['post_status'])) { ?>
                    <label for="status_en"><span
                                style="color: red; font-style: italic;"><?php print_r($errors_en['post_status']); ?></span></label>
                <?php } ?>
                <div class="input-group mb-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="span-4" style="width: 150px;">Trạng thái <span
                                    style="color: red;">(*)</span></span>
                    </div>
                    <div class="col-xs-4">
                        <select required name="status" id="status" class="form-control" aria-label="status_en"
                                aria-describedby="span-4">
                            <option value="" disabled selected>---Chọn Trạng thái---</option>
                            <?php if (@POST_STATUS) { ?>
                                <?php foreach (POST_STATUS as $key => $value) { ?>
                                    <?php if ($key == @$postEN['post_status']) { ?>
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
                        <span class="input-group-text"
                              style="width: 250px;border-radius: 5px">Phần nhận xét khách hàng</span>
                    </div>
                    <div class="col-xs-4" style="margin:0 10px">
                        <input autocomplete="off" type="text" placeholder="Tên người tạo..." value="<?= @$postEN['post_creator'] ?>"
                               class="form-control" name="post_creator">
                    </div>
                    <div class="col-xs-4">
                        <input autocomplete="off" type="text" placeholder="Chức vụ người tạo..." value="<?= @$postEN['role_creator'] ?>"
                               class="form-control" name="role_creator">
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
                        <input type="hidden" id="post_id_en" name="post_id_en"
                               value="<?php echo @$postEN['post_id'] ?>">
                        <?php if (isset($errors_en['post_title'])) { ?>
                            <label for="post_title_en"><span
                                        style="color: red; font-style: italic;"><?php print_r($errors_en['post_title']); ?></span></label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 150px;">Tiêu đề <span
                                            style="color: red;">(*)</span></span>
                            </div>
                            <input autocomplete="off" required type="text" class="form-control" name="post_title_en" id="post_title_en"
                                   placeholder="Tiêu đề bài viết" value="<?= @$postEN['post_title'] ?>"
                                   aria-label="Post title" aria-describedby="span-5">
                        </div>
                        <?php if (isset($errors_en['post_introduce'])) { ?>
                            <label for="post_introduce_en"><span
                                        style="color: red; font-style: italic;"><?php print_r($errors_en['post_introduce']); ?></span></label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 150px;">Mô tả</span>
                            </div>
                            <input autocomplete="off" type="text" class="form-control" name="post_introduce_en" id="post_introduce_en"
                                   placeholder="Mô tả bài viết" value="<?= @$postEN['post_introduce'] ?>"
                                   aria-label="Post introduce" aria-describedby="span-5">
                        </div>
                        <?php if (isset($errors_en['attachment'])) { ?>
                            <label for="status_en"><span
                                        style="color: red; font-style: italic;"><?php print_r($errors_en['attachment']); ?></span></label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span-4" style="width: 150px;">Ảnh đại diện <span
                                            style="color: red;">(*)</span></span>
                            </div>
                            <input <?php if (!isset($postEN)) {
                                echo 'required';
                            } ?> type="file" name="file_en" id="file_en" class="form-control">
                        </div>
                        <?php if (!empty($postEN['attachment'])) { ?>
                            <img class="avatar_post" src="<?php echo @$postEN['attachment']; ?>" alt="avatar">
                        <?php } ?>
                        <?php if (isset($errors_en['post_content'])) { ?>
                            <label for="post_content_en"><span
                                        style="color: red; font-style: italic;"><?php print_r($errors_en['post_content']); ?></span></label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span-6" style="width: 150px;">Nội dung <span
                                            style="color: red;">(*)</span></span>
                            </div>
                            <textarea class="form-control" name="post_content_en" id="post_content_en"
                                      placeholder="Email content" aria-label="Post content" aria-describedby="span-6"
                                      rows="15"><?= @$postEN['post_content'] ?></textarea>
                        </div>

                    </div>
                    <div class="tab-pane fade" id="vietnamese" role="tabpanel" aria-labelledby="vietnamese-tab">
                        <input type="hidden" id="post_id_vn" name="post_id_vn"
                               value="<?php echo @$postVN['post_id'] ?>">
                        <?php if (isset($errors_vn['post_title'])) { ?>
                            <label for="post_title_vn"><span
                                        style="color: red; font-style: italic;"><?php print_r($errors_vn['post_title']); ?></span></label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span-51" style="width: 150px;">Tiêu đề <span
                                            style="color: red;">(*)</span></span>
                            </div>
                            <input autocomplete="off" required type="text" class="form-control" name="post_title_vn" id="post_title_vn"
                                   placeholder="Tiêu đề" value="<?= @$postVN['post_title'] ?>" aria-label="Tiêu đề"
                                   aria-describedby="span-51">
                        </div>
                        <?php if (isset($errors_en['post_introduce'])) { ?>
                            <label for="post_introduce_vn"><span
                                        style="color: red; font-style: italic;"><?php print_r($errors_vn['post_introduce']); ?></span></label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 150px;">Mô tả</span>
                            </div>
                            <input autocomplete="off" type="text" class="form-control" name="post_introduce_vn" id="post_introduce_v"
                                   placeholder="Mô tả bài viết" value="<?= @$postVN['post_introduce'] ?>"
                                   aria-label="Post introduce" aria-describedby="span-5">
                        </div>
                        <?php if (isset($errors_en['attachment'])) { ?>
                            <label for="status_vn"><span
                                        style="color: red; font-style: italic;"><?php print_r($errors_vn['attachment']); ?></span></label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span-4" style="width: 150px;">Ảnh đại diện <span
                                            style="color: red;">(*)</span></span>
                            </div>
                            <input <?php if (!isset($postEN)) {
                                echo 'required';
                            } ?> type="file" name="file_vn" id="file_vn" class="form-control">
                        </div>
                        <?php if (!empty($postVN['attachment'])) { ?>
                            <img class="avatar_post" src="<?php echo @$postVN['attachment']; ?>" alt="avatar">
                        <?php } ?>
                        <?php if (isset($errors_vn['post_content'])) { ?>
                            <label for="post_content_vn"><span
                                        style="color: red; font-style: italic;"><?php print_r($errors_vn['post_content']); ?></span></label>
                        <?php } ?>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="span-61" style="width: 150px;">Nội dung <span
                                            style="color: red;">(*)</span></span>
                            </div>
                            <textarea class="form-control" name="post_content_vn" id="post_content_vn"
                                      placeholder="Nội dung" aria-label="Nội dung" aria-describedby="span-61"
                                      rows="15"><?= @$postVN['post_content'] ?></textarea>
                        </div>
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
    </style>

<?= $this->endSection() ?>