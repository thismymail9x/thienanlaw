<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
<?php //print_r($postEN);die(); ?>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 400px;">
                        <h6 class="m-0 font-weight-bold text-primary">Chi tiết thông tin Bài viết</h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url('post?for_menu=1') ?>" class="btn btn-sm btn-dark mb-2">Danh sách</a>
                        <a href="<?= base_url('post/edit/' . @$groupPost) ?>"
                           class="btn btn-sm btn-success mb-2">Sửa</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="span-1" style="width: 150px;">Loại bài viết <span
                                style="color: red;">(*)</span></span>
                </div>
                <div class="col-xs-4">
                    <select disabled name="post_type" id="post_type" class="form-control" aria-label="Loại bài "
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
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="span-1" style="width: 150px;">Danh mục <span style="color: red;">(*)</span></span>
                </div>
                <div class="col-xs-4">
                    <select disabled name="category_id" id="category_id" class="form-control" aria-label="Danh mục "
                            aria-describedby="span-1">
                        <option value="" selected><?php echo $postEN['category_name']; ?></option>
                    </select>
                </div>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="span-4" style="width: 150px;">Chọn Trạng thái <span
                                style="color: red;">(*)</span></span>
                </div>
                <div class="col-xs-4">
                    <select disabled name="status" id="status" class="form-control" aria-label="status_en"
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
                            <span class="input-group-text" id="span-5" style="width: 150px;">Tiêu đề <span
                                        style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="post_title_en" id="post_title_en"
                               placeholder="Tiêu đề bài viết" value="<?= @$postEN['post_title'] ?>"
                               aria-label="Post title" aria-describedby="span-5">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="span-5" style="width: 150px;">Mô tả</span>
                        </div>
                        <input disabled type="text" class="form-control" name="post_introduce_en" id="post_introduce_en"
                               placeholder="Mô tả bài viết" value="<?= @$postEN['post_introduce'] ?>"
                               aria-label="Post introduce" aria-describedby="span-5">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="span-4" style="width: 150px;">Ảnh đại diện <span
                                        style="color: red;">(*)</span></span>
                        </div>
                        <img class="avatar_post" src="<?php echo @$postEN['attachment']; ?>" alt="avatar">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="span-6" style="width: 150px;">Nội dung <span
                                        style="color: red;">(*)</span></span>
                        </div>
                    </div>
                    <div class="content__post">
                        <?= @$postEN['post_content'] ?>
                    </div>

                </div>
                <div class="tab-pane fade" id="vietnamese" role="tabpanel" aria-labelledby="vietnamese-tab">
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="span-51" style="width: 150px;">Tiêu đề <span
                                        style="color: red;">(*)</span></span>
                        </div>
                        <input disabled type="text" class="form-control" name="post_title_vn" id="post_title_vn"
                               placeholder="Tiêu đề" value="<?= @$postVN['post_title'] ?>" aria-label="Tiêu đề"
                               aria-describedby="span-51">
                    </div>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="span-5" style="width: 150px;">Mô tả</span>
                        </div>
                        <input disabled type="text" class="form-control" name="post_introduce_vn" id="post_introduce_vn"
                               placeholder="Mô tả bài viết" value="<?= @$postVN['post_introduce'] ?>"
                               aria-label="Post introduce" aria-describedby="span-5">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="span-4" style="width: 150px;">Ảnh đại diện <span
                                        style="color: red;">(*)</span></span>
                        </div>
                        <img class="avatar_post" src="<?php echo @$postVN['attachment']; ?>" alt="avatar">
                    </div>

                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="span-61" style="width: 150px;">Nội dung <span
                                        style="color: red;">(*)</span></span>
                        </div>
                    </div>
                    <div class="content__post">
                        <?= @$postVN['post_content'] ?>
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