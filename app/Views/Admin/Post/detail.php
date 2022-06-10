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
                        <a href="<?= base_url('post/edit/' . @$post['post_id']) ?>"
                           class="btn btn-sm btn-success mb-2">Sửa</a>
                    </td>
                </tr>
            </table>
        </div>

        <div class="card-body">
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="inputKey">Loại bài viết</label>
                    <select disabled class="form-control"
                            aria-label="Loại post_type"
                            aria-describedby="span-1">
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
                <div class="form-group col-md-2 offset-4">
                    <label for="">Thứ tự</label>
                    <input disabled class="form-control" type="search" value="<?= @$post['number_order']?>">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label>Ngôn ngữ</label>
                    <select disabled <?php if (!isset($post)) {echo 'disabled';}?> class="form-control">
                        <option value="">Chọn</option>
                        <?php foreach (@$langCode as $key) { ?>
                            <option <?php if ($key['lang_code_key']==@$post['lang']) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                        <?php } ?>
                    </select>
                   
                </div>
                <div class="form-group col-md-4">
                    <label for="inputKey">Danh mục</label>
                    <select disabled class="form-control" aria-label="Loại post_type" aria-describedby="span-1">
                        <?php if (@$post_categories) { ?>
                            <?php foreach ($post_categories as $key => $value) { ?>
                                <option <?php if ($value['post_id'] == @$post['category_id']) {echo 'selected';} ?> value="<?php echo $value['post_id']; ?>"><?php echo $value['post_title']; ?></option>
                                <?php
                            }
                        } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputKey">Trạng thái</label>
                    <select disabled class="form-control"
                            aria-label="Loại post_status"
                            aria-describedby="span-1">
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
                </div>
            </div>
            <div class="form-row">
                <label for="staticEmail" class="form-group col-sm-4 text-primary">Loại nhận xét khách hàng</label>
                <div class="form-group col-sm-4">
                    <input disabled type="text"  value="<?= @$post['post_creator'] ?>" class="form-control" >
                </div>
                <div class="form-group col-sm-4">
                    <input disabled type="text"  value="<?= @$post['role_creator'] ?>" class="form-control" >
                </div>
            </div>
            <div class="card-body" style="box-shadow: rgba(0, 0, 0, 0.35) 0px 5px 15px;">
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputKey">Tiêu đề<span style="color: red;">(*)</span></label>
                        <input disabled autocomplete="off" data-slug="" data-id="0" required type="text" class="form-control" name="post_title" id="post_title"
                               placeholder="Tiêu đề" value="<?= @$post['post_title'] ?>"
                               aria-label="Post title" aria-describedby="span-5">
                        <?php if (isset($errors['post_title'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['post_title']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="inputKey">Link Canonical</label>
                        <input disabled autocomplete="off" data-id="0" required type="text" class="form-control" name="canonical" id="seo_canonical"
                               placeholder="" value="<?= @$post['canonical'] ?>"
                               aria-label="" aria-describedby="span-5">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6 position-relative">
                        <label for="">Bí danh (URL) meta property="og:url"...: <?php if ($post['post_type'] != 'CUSTOMER_REVIEW' && $post['post_status']==1){?><span class="position-absolute btn-primary js__get-url" style="right: 10px;padding: 1px 4px;cursor: pointer;border-radius: 2px">Lấy link</span> <?php } ?></label>
                        <input disabled autocomplete="off" readonly type="text" class="form-control" name="og_url" id="og_url"
                               placeholder="" value="<?= @$post['og_url'] ?>"
                               aria-label="" aria-describedby="span-5">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Tiêu đề trang < title...< /title và meta property="og:title" ...:</label>
                        <input disabled autocomplete="off" type="text" class="form-control" name="og_title" id="og_title"
                               placeholder="" value="<?= @$post['og_title'] ?>"
                               aria-label="Post title" aria-describedby="span-5">
                    </div>
                </div>
                <div class="form-row div__none" style="display: none">
                    <div class="form-group col-md-6">
                        <input type="text" class="form-control" style="background-color: green;color: #fff" value="<?= @$post['og_url'] ?>">
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Meta og:site_name="":</label>
                        <input disabled autocomplete="off" type="text" class="form-control" name="og_site_name" id="og_site_name"
                               placeholder="" value="<?= @$post['og_site_name'] ?>"
                               aria-label="" aria-describedby="span-5">
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Meta fb_ap_id="":</label>
                        <input disabled autocomplete="off" type="text" class="form-control" name="fb_app_id"
                               placeholder="" value="<?= @$post['fb_app_id'] ?>"
                               aria-label="" aria-describedby="span-5">
                    </div>

                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="">Meta property="og:description" content="...":</label>
                        <textarea disabled maxlength="160" class="form-control" name="og_description" cols="30" rows="2"><?= @$post['og_description'] ?></textarea>
                        <small>Giới hạn 160 kí tự</small>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="">Schema data for google SEO:</label>
                        <textarea disabled class="form-control" name="seo_google" cols="30" rows="2"><?= @$post['seo_google'] ?></textarea>

                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label for="">Meta property="keywords" content="...":</label>
                        <input disabled autocomplete="off" type="text" class="form-control" name="keywords" id="keywords"
                               placeholder="chuẩn seo, trang chủ, tin tức ..." value="<?= @$post['keywords'] ?>"
                               aria-label="keywords" aria-describedby="span-5">
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputKey">Mô tả bài viết</label>
                    <input disabled type="text" class="form-control" 
                           placeholder="" value="<?= @$post['post_introduce'] ?>"
                           aria-label="Post introduce" aria-describedby="span-5">
                    <small class="text-success">Sẽ được hiển thị là nội dung của phần đánh giá khách hàng</small>
                </div>

                <div class="form-row">
                    <div class="form-group col-6">
                        <label for="">Ảnh đại diện bài viết<span style="color: red;">(*)</span></label>
                        <?php
                        $attachments = explode(',',$post['attachment']);
                        $width = ['700w','1024w','1w'];
                        if (count($attachments)>1) { ?>
                            <img style="width: 100px;height: 100px" src="<?php echo $attachments[2] ?>"
                                      srcset="
                                                                <?php foreach ($attachments as $key=>$va) {
                                          echo $va.' '.$width[$key].',';
                                      } ?>" >
                        <?php } else { ?>
                            <img  style="width: 100px;height: 100px" src="<?php echo $post['attachment'] ?>" >
                        <?php } ?>
                    </div>

                </div>
                <div class="form-group">
                    <label for="inputKey">Nội dung bài viết<span style="color: red;">(*)</span></label>
                    <textarea disabled class="form-control" name="post_content" id="post_content"
                              placeholder="Email content" aria-label="Post content" aria-describedby="span-6"
                              rows="15"><?= @$post['post_content'] ?></textarea>
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
        .card {
            font-size: 80%;
        }
        .form-control {
            font-size: 13px;
        }
    </style>
    <script>
        tinymce.init({
            selector: '#post_content, .mail_content',
            width: '100%',
            readonly:1,
            toolbar: [
                'undo redo | bold italic underline strikethrough | fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist | forecolor backcolor removeformat | pagebreak | charmap emoticons | fullscreen  preview save print | imageupload insertfile image media template link anchor codesample | ltr rtl',
            ],
            plugins: 'image code link print preview paste importcss searchreplace autolink autosave save directionality visualblocks visualchars fullscreen media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists wordcount imagetools textpattern noneditable help charmap emoticons',
        });
    </script>
<?= $this->endSection() ?>