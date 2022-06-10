<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <!--    --><?php //echo base_url('post/edit');die('44444s');?>
        <form action="<?= base_url('post_category/edit/'.$post['post_id']) ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <button type="button" href="<?= base_url('post?for_menu=1') ?>" class="btn btn btn-info btn-sm btn-warning mb-2 js_duplicate" data-menu="POST_CATEGORY" data-id="<?=$post['post_id']?>">Nhân bản</button>
                            <a href="<?= base_url('post_category?for_menu=1') ?>" class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>

            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputKey">Loại danh mục<span style="color: red;">(*)</span></label>
                        <select required name="post_type" id="post_type" class="form-control"
                                aria-label="Loại post_category "
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
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKey">Trạng thái<span style="color: red;">(*)</span></label>
                        <select required name="post_status" id="post_status" class="form-control"
                                aria-label="Loại post_status"
                                aria-describedby="span-1">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@POST_STATUS) { ?>
                                <?php foreach (POST_STATUS as $key => $value) { ?>
                                        <option <?php if ($key == @$post['post_status']) {echo 'selected';} ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                            <?php
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
                    <div class="row">
                        <div class="col-4">
                            <div class="form-group">
                                <label>Loại ngôn ngữ<span style="color: red;">(*)</span></label>
                                <select required class="form-control choose-lang-create" id="choose-lang-create-category" name="lang">
                                    <option value="">Chọn</option>
                                    <?php foreach (@$langCode as $key) { ?>
                                        <option <?php if ($key['lang_code_key'] == @$post['lang']) {echo 'selected';} ?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                    <?php } ?>
                                </select>
                                <?php if (isset($errors['lang'])) { ?>
                                    <label for=""><span
                                                style="color: red; font-style: italic;"><?php print_r($errors['lang']); ?></span></label>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="col-2 offset-6">
                            <div class="form-group">
                                <label>Số thứ tự </label>
                                <input autocomplete="off" type="text" class="form-control number_order" name="number_order"
                                       placeholder="vị trí..." value="<?= @$post['number_order'] ?>">
                            </div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKey">Tiêu đề<span style="color: red;">(*)</span></label>
                            <input autocomplete="off" data-lang="<?php echo @$post['lang']?>" data-id="<?php echo @$post['post_id']?>" required type="text" class="form-control post_title_category" name="post_title" id=""
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
                            <input autocomplete="off" data-id="<?php echo @$post['post_id']?>" type="text" class="form-control og_url_category" name="og_url" id="og_url"
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
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="inputKey">Ảnh đại diện seo_image<span style="color: red;">(*)</span></label>
                            <input type="file" name="file" id="file" class="form-control">
                            <img style="width: 100px;height: 100px;margin-top: 10px;display: none" src="#" id="avatar" alt="">
                            <?php
                            $attachments = explode(',',$post['attachment']);
                            $width = ['700w','1024w','1w'];
                            if (count($attachments)>1) { ?>
                                <img id="js__image" class="js__image" style="width: 100px;height: 100px;margin-top: 10px;" src="<?php echo $attachments[2] ?>"
                                     srcset="
                                                                <?php foreach ($attachments as $key=>$va) {
                                         echo $va.' '.$width[$key].',';
                                     } ?>" >
                            <?php } ?>
                            <div class="position-absolute" style="bottom: 0;left: 10px"><i class="fas fa-times-circle text-danger js__delete-img" data-id="<?= @$post['post_id'] ?>" style="cursor: pointer"></i></div>
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
            <input type="hidden" name="post_introduce" value="Mặc định">
            <input type="hidden" name="post_content" value="Mặc định">
            <input type="hidden" name="post_id" value="<?= $post['post_id'] ?>">
            <input type="hidden" name="seo_id" value="<?= $post['seo_id'] ?>">
            <input type="hidden" name="slug" id="slugPost" value="<?= @$post['slug'] ?>">
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