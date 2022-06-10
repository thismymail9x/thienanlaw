<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('menu/register') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('menu?for_menu=1') ?>"
                               class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2 js__btn-submit">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label>Ngôn ngữ<span style="color: red;">(*)</span></label>
                        <select required class="form-control" data-post-type="<?= @$post['post_type']?>" id="choose-lang-create" name="lang">
                            <option value="">Chọn</option>
                            <?php foreach (@$langCode as $key) { ?>
                                <option <?php if ($key['lang_code_key']==@$post['lang']) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                            <?php } ?>
                        </select>
                        <?php if (isset($errors['lang'])) { ?>
                            <label for=""><span
                                    style="color: red; font-style: italic;"><?php print_r($errors['lang']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputKey">Tiêu đề<span style="color: red;">(*)</span></label>
                        <input autocomplete="off" data-id="0" required type="text" class="form-control" name="post_title" id=""
                               placeholder="Tiêu đề..." value="<?= @$post['post_title'] ?>"
                               aria-label="Post title" aria-describedby="span-5">
                        <?php if (isset($errors['post_title'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['post_title']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputKey">Trạng thái<span style="color: red;">(*)</span></label>
                        <select required name="post_status" id="post_status" class="form-control"
                                aria-label="Loại post_status"
                                aria-describedby="span-1">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@POST_STATUS) { ?>
                                <?php foreach (POST_STATUS as $key => $value) { ?>
                                    <?php if ($key == @$post['post_status'] && @$post['post_status'] !='') { ?>
                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['post_status'])) { ?>
                            <label for=""><span
                                    style="color: red; font-style: italic;"><?php print_r($errors['post_status']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-3">
                        <label for="inputKey">Thứ tự</label>
                        <input placeholder="menu-top = 1, menu-bottom = 2" autocomplete="off" class="form-control" type="search" name="number_order" value="<?= @$post['number_order']?>">
                    </div>
                    <div class="form-group hide-if-edit-menu">
                        <label for="inputKey">Mô tả bài viết<span style="color: red;">(*)</span></label>

                        <textarea name="post_introduce" id="data_post_excerpt" cols="30" rows="10">
                        </textarea>
                        <?php if (isset($errors['post_introduce'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['post_introduce']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group hide-if-edit-menu">
                        <label for="inputKey">Nội dung bài viết<span style="color: red;">(*)</span></label>
                        <textarea class="form-control" name="post_content" id="post_content_menu"
                                  placeholder="Email content" aria-label="Post content" aria-describedby="span-6"
                                  rows="15"><?= @$post['post_content'] ?></textarea>
                        <?php if (isset($errors['post_content'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['post_content']); ?></span></label>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </form>
        <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
            <div class="row">
                <div class="col-6">
                    <h4>Menu</h4>
                    <ol class="dd-tmp-list hide-if-edit-menu">
                        <li class="dd-item" data-id="%id%" data-name="%name%" data-slug="%slug%" data-new="0" data-deleted="0">
                            <div class="dd-handle">%newText%</div>
                            <span class="button-delete btn btn-default btn-xs pull-right"
                                  data-owner-id="%id%"> <i class="fa far fa-times-circle" aria-hidden="true"></i> </span>
                            <span class="button-edit btn btn-default btn-xs pull-right" data-owner-id="%id%"> <i class="fas fa-pencil-alt" aria-hidden="true"></i> </span> %child_htm%</li>
                    </ol>
                    <div class="dd nestable">
                        <ol class="dd-list">
                        </ol></div>
                </div>
                <div class="col-6 menu-edit-input">
                    <form onsubmit="return get_json_code_menu(this);" id="menu-add">
                        <h4>Thêm menu</h4>
                        <div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="addInputName">Tên menu</label>
                                <input autocomplete="off" type="text" class="form-control" id="addInputName" placeholder="Item name" required>
                            </div>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="addInputSlug">Đường dẫn</label>
                                <input autocomplete="off" type="text" class="form-control" id="addInputSlug" placeholder="/price" required>
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-info" id="addButton"><i class="fa fa-plus"></i> Thêm mới</button>
                        </div>
                    </form>
                    <form class="hide-if-edit-menu" onsubmit="return get_json_code_menu(this);" id="menu-editor">
                        <h3>Chỉnh sửa: <span id="currentEditName"></span></h3>
                        <div class="form-group">
                            <label for="addInputName">Tên menu</label>
                            <input autocomplete="off" type="text" class="form-control" id="editInputName" placeholder="Item name" required>
                        </div>
                        <div>
                            <div class="form-group">
                                <label for="addInputSlug">Đường dẫn</label>
                                <input autocomplete="off" type="text" class="form-control" id="editInputSlug" placeholder="item-slug">
                            </div>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-info" id="editButton"><i class="fa fa-save"></i> Cập nhật</button>
                        </div>
                    </form>
                    <form class="form-json hide-if-edit-menu">
                        <textarea class="form-control" id="json-output" rows="5" style="width: 100%;"></textarea>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <style type="text/css">
        #cke_post_category_content_en, #cke_post_category_content_vn {
            width: 85%;
        }
        /*.card {*/
        /*    font-size: 80%;*/
        /*}*/
        /*.form-control {*/
        /*    font-size: 13px;*/
        /*}*/
        .hide-if-menu {
            display: none;
        }
        .boxshadow {
            box-shadow: rgba(179, 45, 0, 0.9) 0px 5px 15px;
        }


        .button-delete {
            position: absolute;
            top: 0px;
            right: -26px;
        }
        .button-edit {
            position: absolute;
            top: 0px;
            right: -52px;
        }
        .pull-right {
            float: right;
        }
        .btn-default {
            display: inline-block;
            padding: 4px 12px;
            margin-bottom: 3px;
            font-size: 14px;
            line-height: 20px;
            border-radius: 0;
            color: #333;
            text-align: center;
            text-shadow: 0 1px 1px rgb(255 255 255 / 75%);
            vertical-align: middle;
            cursor: pointer;
            background-color: #dadada;
        }
        .hide-if-edit-menu {
            display: none;
        }
    </style>

<?= $this->endSection() ?>