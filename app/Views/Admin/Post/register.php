<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('post/register') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('post?for_menu=1') ?>"
                               class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2 js__btn-submit">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputKey">Loại bài viết<span style="color: red;">(Chọn các thông số cần thiết)</span></label>
                        <select required name="post_type" id="post_type" class="form-control"
                                aria-label="Loại post_type"
                                aria-describedby="span-1">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@POST_TYPE) { ?>
                                <?php foreach (POST_TYPE as $key => $value) { ?>
                                    <?php if ($key == @$post['post_type']) { ?>
                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['post_type'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['post_type']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-2 offset-4">
                        <label for="inputKey">Thứ tự</label>
                        <input autocomplete="off" class="form-control" type="search" name="number_order" value="<?= @$post['number_order']?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4 js__lang">
                        <label>Ngôn ngữ<span style="color: red;">(*)</span></label>
                        <select <?php if (!isset($post)) {echo 'disabled';}?> required class="form-control" data-post-type="<?= @$post['post_type']?>" id="choose-lang-create" name="lang">
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
                        <label for="inputKey">Danh mục<span style="color: red;">(*)</span></label>
                        <select <?php if (!isset($post)) {echo 'disabled';}?> required name="category_id" id="category_id" class="form-control"
                                aria-label="Loại post_type "
                                aria-describedby="span-1">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@$post_categories) { ?>
                                <?php foreach ($post_categories as $key => $value) { ?>
                                    <option <?php if ($value['post_id'] == @$post['category_id']) {echo 'selected';} ?> value="<?php echo $value['post_id']; ?>" data-slug="<?=$value['slug']?>"><?php echo $value['post_title']; ?></option>
                                    <?php
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['category_id'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['category_id']); ?></span></label>
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
                <div class="form-row">
                    <label for="staticEmail" class="form-group col-sm-4 text-primary">Loại nhận xét khách hàng</label>
                    <div class="form-group col-sm-4">
                        <input autocomplete="off" type="text" placeholder="Tên người tạo..." value="<?= @$post['post_creator'] ?>" class="form-control" name="post_creator">
                    </div>
                    <div class="form-group col-sm-4">
                        <input autocomplete="off" type="text" placeholder="Chức vụ người tạo..." value="<?= @$post['role_creator'] ?>" class="form-control" name="role_creator">
                    </div>
                </div>


                <div class="card-body <?php if (!isset($post)){ echo 'js__change_category';} ?>" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKey">Tiêu đề<span style="color: red;">(*)</span></label>
                            <input data-lang="<?php echo $_COOKIE['lang']?>" autocomplete="off" data-slug="" data-id="0" required type="text" class="form-control" name="post_title" id="post_title"
                                   placeholder="Tiêu đề" value="<?= @$post['post_title'] ?>"
                                   aria-label="Post title" aria-describedby="span-5">
                            <?php if (isset($errors['post_title'])) { ?>
                                <label for=""><span
                                            style="color: red; font-style: italic;"><?php print_r($errors['post_title']); ?></span></label>
                            <?php } ?>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="inputKey">Link Canonical</label>
                            <input readonly autocomplete="off" data-id="0" required type="text" class="form-control" name="canonical" id="seo_canonical"
                                   placeholder="" value="<?= @$post['canonical'] ?>"
                                   aria-label="" aria-describedby="span-5">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6 position-relative">
                            <label for="">Bí danh (URL) meta property="og:url"...: </label>
                            <input autocomplete="off" type="text" class="form-control og_url_post" name="og_url" id="og_url"
                                   placeholder="" value="<?= @$post['og_url'] ?>"
                                   aria-label="" aria-describedby="span-5">
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
                    <div class="form-group">
                        <label for="inputKey">Mô tả bài viết</label>
                        <input autocomplete="off" type="text" class="form-control" name="post_introduce" id="post_introduce"
                               placeholder="Mô tả bài viết" value="<?= @$post['post_introduce'] ?>"
                               aria-label="Post introduce" aria-describedby="span-5">
                        <small class="text-success">Sẽ được hiển thị là nội dung của phần đánh giá khách hàng</small>
                        <?php if (isset($errors['post_introduce'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['post_introduce']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKey">Ảnh đại diện bài viết<span style="color: red;">(*)</span></label>
                            <input type="file" name="file" id="file" class="form-control">
                            <img style="width: 100px;height: 100px;margin-top: 10px;display: none" src="#" id="avatar" alt="">
                            <div class="position-absolute" style="bottom: 0;left: 10px"><i class="fas fa-times-circle text-danger js__delete-img-register" style="cursor: pointer; display: none;"></i></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="">Cắt ảnh</label>
                            <input type="text" class="form-control" name="crop_photo" id="crop_photo"
                                   placeholder="Kích thước muốn cắt, ví dụ: 200x150" value="<?= @$post['crop_photo'] ?>"
                                   aria-label="" aria-describedby="span-5">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputKey">Nội dung bài viết<span style="color: red;">(*)</span></label>
                        <textarea class="form-control" name="post_content" id="post_content"
                                  placeholder="Email content" aria-label="Post content" aria-describedby="span-6"
                                  rows="15"><?= @$post['post_content'] ?></textarea>
                        <?php if (isset($errors['post_content'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['post_content']); ?></span></label>
                        <?php } ?>
                    </div>
                    <input type="hidden" name="slug" id="slugPost" value="<?= @$post['slug'] ?>">
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
        .boxshadow {
            box-shadow: rgba(179, 45, 0, 0.9) 0px 5px 15px;
        }
        .js__change_category {
            display: none;
        }
    </style>
    <script type="application/javascript">
        //delete img on register page
        $('input#file').on('change', function () {
            $('.js__delete-img-register').show();
        });
        $('.js__delete-img-register').on('click', function () {
            $('input#file').val('');
            $('#avatar').hide();
            $(this).hide();
        });
    </script>
<?= $this->endSection() ?>