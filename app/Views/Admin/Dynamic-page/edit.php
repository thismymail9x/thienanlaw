<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('dynamic-page/edit') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <input type="hidden" name="post_id" value="<?= @$post['post_id']?>">
            <input type="hidden" name="seo_id" value="<?= @$post['seo_id']?>">
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <button type="button" href="<?= base_url('post?for_menu=1') ?>" class="btn btn btn-info btn-sm btn-warning mb-2 js_duplicate" data-menu="DYNAMIC_PAGE" data-id="<?=$post['post_id']?>">Nhân bản</button>
                            <a href="<?= base_url('dynamic-page?for_menu=1') ?>"
                               class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2 js__btn-submit">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Ngôn ngữ<span style="color: red;">(*)</span></label>
                        <select required class="form-control" id="dynamic-lang" name="lang">
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
                    <div class="form-group col-md-4">
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
                </div>
                <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKey">Tiêu đề<span style="color: red;">(*)</span></label>
                            <input data-lang="<?php echo $_COOKIE['lang']?>" autocomplete="off" data-id="0" required type="text" class="form-control" id="post_title_dynamic" name="post_title"
                                   placeholder="Tiêu đề" value="<?= @$post['post_title'] ?>"
                                   aria-label="Post title" aria-describedby="span-5">
                            <?php if (isset($errors['post_title'])) { ?>
                                <label for=""><span
                                            style="color: red; font-style: italic;"><?php print_r($errors['post_title']); ?></span></label>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputKey">Link Canonical</label>
                            <input autocomplete="off" data-id="0" type="text" class="form-control" name="canonical" id="seo_canonical"
                                   placeholder="" value="<?= @$post['canonical'] ?>"
                                   aria-label="" aria-describedby="span-5">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 position-relative">
                            <label for="">Bí danh (URL) meta property="og:url"...: <span class="text-danger">Đường dẫn đến trang động</span> </label>
                            <input required autocomplete="off" type="text" class="form-control" name="og_url" id="dynamic-page-edit"
                                   placeholder="ví dụ : trangdong" value="<?= @$post['og_url'] ?>"
                                   aria-label="" aria-describedby="span-5">
                            <?php if (isset($errors['og_url'])) { ?>
                                <label for=""><span
                                            style="color: red; font-style: italic;"><?php print_r($errors['og_url']); ?></span></label>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Tiêu đề trang < title...< /title và meta property="og:title" ...:</label>
                            <input autocomplete="off" type="text" class="form-control" name="og_title" id="og_title"
                                   placeholder="" value="<?= @$post['og_title'] ?>"
                                   aria-label="Post title" aria-describedby="span-5">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Meta og:site_name="":</label>
                            <input autocomplete="off" type="text" class="form-control" name="og_site_name" id="og_site_name"
                                   placeholder="" value="<?= @$post['og_site_name'] ?>"
                                   aria-label="" aria-describedby="span-5">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Meta fb_ap_id="":</label>
                            <input autocomplete="off" type="text" class="form-control" name="fb_app_id"
                                   placeholder="" value="<?= @$post['fb_app_id'] ?>"
                                   aria-label="" aria-describedby="span-5">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="">Meta property="og:description" content="...":</label>
                            <textarea maxlength="160" class="form-control" name="og_description" cols="30" rows="2"><?= @$post['og_description'] ?></textarea>
                            <small>Giới hạn 160 kí tự</small>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Schema data for google SEO:</label>
                            <textarea class="form-control" name="seo_google" cols="30" rows="2"><?= @$post['seo_google'] ?></textarea>

                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="">Meta property="keywords" content="...":</label>
                            <input autocomplete="off" type="text" class="form-control" name="keywords" id="keywords"
                                   placeholder="chuẩn seo, trang chủ, tin tức ..." value="<?= @$post['keywords'] ?>"
                                   aria-label="keywords" aria-describedby="span-5">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKey">Ảnh đại diện seo_image<span style="color: red;">(*)</span></label>
                            <input type="file" name="file" id="file" class="form-control">
                            <img style="width: 100px;height: 100px;margin-top: 10px;display: none" src="#" id="avatar" alt="">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Cắt ảnh</label>
                            <input autocomplete="off" type="text" class="form-control" name="crop_photo" id="crop_photo"
                                   placeholder="Kích thước muốn cắt, ví dụ: 200x150" value="<?= @$post['crop_photo'] ?>"
                                   aria-label="" aria-describedby="span-5">
                        </div>
                    </div>
                </div>
            </div>
        </form>

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