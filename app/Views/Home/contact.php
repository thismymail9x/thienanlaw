<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("css_home") ?>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/header.css" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/contact.css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/global.css" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/plugins/bootstrap4.5/css/bootstrap.min.css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="<?= BASE_URL_GLOBAL ?>/public/plugins/sweetalert2/dist/sweetalert2.min.css" rel="stylesheet" type="text/css" lazyload>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/section-footer-top.css" type="text/css" lazyload>
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/home/footer.css" type="text/css" lazyload>
    <script src="<?= BASE_URL_GLOBAL ?>/public/vendor/jquery/jquery.min.js"></script>
<?= $this->endSection() ?>
<?= $this->section("content_home") ?>
<section class="contact__vpn">
    <div class="contact__top">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-lg-4 col-xl-4 left">
                    <h1><?= lang("Text.contact.contact-information") ?></h1>
                    <p><?= lang("Text.contact.contact-information-introduce") ?></p>
                </div>
                <div class="col-md-7 col-lg-8 col-xl-8 right">
                    <div class="top" >
                       <span class="circle">
                                <i class="icon"></i>
                       </span>
                        <a style="cursor: pointer;text-decoration: none;margin: auto 0;" href="tel:18009090">
                        <div class="text">
                            <p class="title">Hotline 24/7</p>
                            <p class="text-under">1800 9090</p>
                        </div>
                        </a>
                    </div>
                    <div class="bottom">
                        <span class="circle">
                                <i class="icon"></i>
                       </span>
                        <a style="cursor: pointer;text-decoration: none;margin: auto 0;" href="mailto:hotro@intovpn.com">
                        <div class="text">
                            <p class="title">Email</p>
                            <p class="text-under">hotro@vpn.com</p>
                        </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="contact__form">
        <div class="container">
            <h1 class="title"><?= lang("Text.contact.title") ?></h1>
            <form action="<?php echo base_url('').'/contact';?>" method="post" enctype="multipart/form-data">
                <input type="hidden" class="___csrfname" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" />
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputFullname"><?= lang("Text.contact.full-name") ?> <sup class="text-warning">*</sup></label>
                        <input title="" oninvalid="this.setCustomValidity('<?= lang("Text.contact-form.full_name.required") ?>')" oninput="this.setCustomValidity('')" type="search" name="full_name" value="<?= @$contact['full_name'] ?>" required placeholder="<?= lang("Text.contact.full-name") ?>" class="form-control"
                               id="inputFullname">
                        <?php if (isset($errors['full_name'])) { ?>
                            <label for=""><i class="fz-13 text-danger">
                                    <?php print_r($errors['full_name']); ?></i></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputRoles"><?= lang("Text.contact.position") ?></label>
                        <input title="" type="search" name="roles" value="<?= @$contact['roles'] ?>" placeholder="<?= lang("Text.contact.position") ?>" class="form-control" id="inputRoles">
                        <?php if (isset($errors['roles'])) { ?>
                            <label for=""><i class="fz-13 text-danger">
                                    <?php print_r($errors['roles']); ?></i></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputCompany"><?= lang("Text.contact.company") ?></label>
                        <input title="" type="search" name="company" value="<?= @$contact['company'] ?>" placeholder="<?= lang("Text.contact.company") ?>" class="form-control"
                               id="inputCompany">
                        <?php if (isset($errors['company'])) { ?>
                            <label for="auth_code"><i class="fz-13 text-danger">
                                    <?php print_r($errors['company']); ?></i></label>
                        <?php } ?>
                    </div>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputPhone"><?= lang("Text.contact.phone-number") ?> <sup class="text-warning">*</sup></label>
                        <input title="" type="search" oninvalid="this.setCustomValidity('<?= lang("Text.contact-form.phone.required") ?>')" oninput="this.setCustomValidity('')" required name="phone" value="<?= @$contact['phone'] ?>" placeholder="<?= lang("Text.contact.phone-number") ?>" class="form-control phone-number"
                               id="inputPhone">
                        <?php if (isset($errors['phone'])) { ?>
                            <label for=""><i class="fz-13 text-danger">
                                    <?php print_r($errors['phone']); ?></i></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputEmail">Email <sup class="text-warning">*</sup></label>
                        <input title="" oninvalid="this.setCustomValidity('<?= lang("Text.contact-form.email.required") ?>')" oninput="this.setCustomValidity('')" type="email" required name="email" value="<?= @$contact['email'] ?>" placeholder="user@gmail.com" class="form-control"
                               id="inputEmail">
                        <?php if (isset($errors['email'])) { ?>
                            <label for="auth_code"><i class="fz-13 text-danger">
                                    <?php print_r($errors['email']); ?></i></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputRegions"><?= lang("Text.contact.nation") ?></label>
                        <select name="location" id="inputRegions" class="form-control">
                            <?php foreach (@$regions as $ke =>$item) { ?>
                            <option <?php if ($item['code'] == @$contact['location'] ) {echo 'selected';} ?> value="<?=$item['region_id']?>"><?=$item['name']?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label for="inputAddress"><?= lang("Text.contact.address") ?></label>
                    <input title="" type="search" class="form-control" value="<?= @$contact['address'] ?>" name="address" id="inputAddress" placeholder="<?= lang("Text.contact.address") ?>">
                </div>
                <div class="form-group">
                    <label for="inputTitle"><?= lang("Text.contact.title-form") ?></label>
                    <input title="" type="search" value="<?= @$contact['title'] ?>" class="form-control" name="title" id="inputTitle"
                           placeholder="">
                    <?php if (isset($errors['title'])){ ?>
                        <label for="auth_code"><i class="fz-13 text-danger">
                                <?php print_r($errors['title']); ?></i></label>
                    <?php }?>
                </div>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label for="inputContent"><?= lang("Text.contact.content-form") ?> <sup class="text-warning">*</sup></label>
                        <textarea oninvalid="this.setCustomValidity('<?= lang("Text.contact-form.content.required") ?>')" oninput="this.setCustomValidity('')" required class="form-control" id="inputContent" name="content" cols="20" rows="7"><?= @$contact['content'] ?></textarea>
                        <?php if (isset($errors['content'])) { ?>
                            <label for="auth_code"><i class="fz-13 text-danger">
                                    <?php print_r($errors['content']); ?></i></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-6">
                        <label for="" class="hide__label">&nbsp;</label>
                        <label for="input__file" id="fileClick" class="icon-file">
                            <div class="file"></div>
                            <div><?= lang("Text.contact.file-form") ?></div>
                        </label>
                        <input type="file" name="file" id="input__file" class="input__file">
                        <div style="height: 24px;">
                            <p id="notify_select_file_again" style="margin: 0; color: #dc3545; font-size: 13px; font-style: italic; display: none;">
                                <?php
                                    if(@$lang == 'vi') {
                                        echo 'Vui lòng chọn lại tệp đính kèm!';
                                    } elseif (@$lang == 'en') {
                                        echo 'Please select attachment again!';
                                    }
                                ?>
                            </p>
                            <?php if (isset($errors)) { ?>
                                <script type="application/javascript">
                                    if (sessionStorage.getItem("file_exist") != null) {
                                        $('#notify_select_file_again').show();
                                        sessionStorage.removeItem("file_exist");
                                    } else {
                                        $('#notify_select_file_again').hide();
                                        sessionStorage.removeItem("file_exist");
                                    }
                                </script>
                            <?php } else { ?>
                                <script type="application/javascript">
                                    sessionStorage.removeItem("file_exist");
                                </script>
                            <?php } ?>
                        </div>
                        <label for="inputCode"><?= lang("Text.contact.code-validation") ?></label>
                        <input title="" autocomplete="off" type="search" oninvalid="this.setCustomValidity('<?= lang("Text.contact-form.auth_code.required") ?>')" oninput="this.setCustomValidity('')" required class="form-control" name="auth_code" id="inputCode" placeholder="">
                        <?php if (isset($errors['auth_code'])) { ?>
                            <label for="auth_code"><i class="fz-13 text-danger">
                                    <?php print_r($errors['auth_code']); ?></i></label>
                        <?php } ?>
                        <input type="hidden" name="security_code" value="" class="auth_code_true __value_captcha">

                        <div class="bot__code __load-capcha">
                            <img id="__id_captcha" class="js_captcha" src="data:image/png;base64,<?php echo @$_SESSION['base64_capcha']; ?>" >
                            <div class="reload"></div>
                        </div>

                    </div>
                </div>
                <div class="button__form">
                    <button class="button js-delete-session">
                        <div class="icon-button"></div>
                        <div class="send"><?= lang("Text.contact.send") ?></div>
                    </button>
                </div>

            </form>
        </div>
    </div>
    <script type="application/javascript">
        $('#input__file').on('change', function () {
            let inputFileValue = null;
            if($('input#input__file').val() != null) {
                inputFileValue = 'File exist';
            }
            sessionStorage.setItem("file_exist", inputFileValue);

            $('#notify_select_file_again').hide();
        })
        function refreshCaptcha(){
            //Call ajax to gen new capcha
            var csrfName = $('.___csrfname').attr('name'); // CSRF Token name
            var csrfHash = $('.___csrfname').val(); // CSRF hash
            $.ajax({
                url: " <?php echo BASE_URL_GLOBAL.'/get-captcha'; ?>",
                method: "POST",
                data: {[csrfName]: csrfHash},
                cache: false,
                success: function (response) {
                    //decode json data
                    var data = JSON.parse(response);
                    $('.___csrfname').val(data.csrf);
                    if(data.exit_code == '0'){
                        //Reload image with new base64 content
                        document.getElementById("__id_captcha").src = "data:image/png;base64," + data.base64_capcha;
                        $(".__value_captcha").val(data.value_captcha);
                    }
                },
            });
        }
    </script>
</section>
<?php echo @$blog_bottom['post_content'];?>

<?= $this->endSection() ?>