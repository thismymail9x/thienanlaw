<footer id="footer">
    <div class="container">
        <div class="row first-row">
            <div class="col-6 col-md-6 col-xl-4">
                <a href="<?php echo base_url(); ?>"><img loading="lazy" class="logo"
                                                         src="<?= BASE_URL_GLOBAL ?>/public/images/home/logo.svg"
                                                         alt="logo VPN footer">
                </a>
                <p class="email"><a class="email" href="mailto:hotro@vpn.com">hotro@vpn.com</a></p>
                <p class="phone"><a class="phone" href="tel:02466567555">02466.567.555</a></p>
                <p class="facebook_youtube">
                    <a target="_blank" rel="noopener noreferrer"
                       href="https://www.facebook.com/Intovpn-For-a-Safer-World-105223875364388"
                       class="icon-facebook"></a>
                    <a target="_blank" rel="noopener noreferrer" href="https://www.youtube.com"
                       class="icon-youtube"></a>
                </p>
            </div>
            <div class="col-6 col-md-6 col-xl-4 center">
                <p class="title"><?= lang("Text.footer.link") ?></p>
                <?php echo @$menu_footer['post_content']; ?>
            </div>
            <div class="col-12 col-md-12 col-xl-4">
                <p class="title title-2"><?= lang("Text.footer.register_promotion") ?></p>
                <p class="title-email"><?= lang("Text.footer.input_mail") ?></p>
                <form id="registerSale" action="<?= base_url() . '/register_promotion/customer_register'; ?>"
                      method="post">
                    <?= csrf_field() ?>
                    <input title="" autocomplete="off" class="input" name="email" type="email" required
                           oninvalid="this.setCustomValidity('<?= lang("Text.footer.required_form") ?>!')"
                           oninput="this.setCustomValidity('');"
                           placeholder="<?= lang("Text.footer.place_holder") ?>...">
                    <button class="submit-form">
                        <div class="icon-plane"></div>
                    </button>
                </form>
            </div>
        </div>
    </div>
    <div class="footer-bottom">
        <div class="container">
            <div class="row second-row">
                <div class="col-6">
                    <p class="left">© <?= date('Y') ?> intoVPN <?= lang("Text.footer.all_right") ?>.</p>
                </div>
                <div class="col-6">
                    <p class="right">
                        <a href="<?php if (isset($_COOKIE['lang']) && $_COOKIE['lang'] == 'en') {
                            echo base_url() . '/page/' . SLUG_SECURITY_EN;
                        } else {
                            echo base_url() . '/page/' . SLUG_SECURITY_VN;
                        } ?>"> <?= lang("Text.footer.regulations") ?>
                            <span><?= lang("Text.footer.refund") ?></span></a>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <div onclick="topFunction()" class="btn btn-sm btn-warning" id="myBtn" style="display: block"><i class="fas fa-angle-double-up"></i></div>
</footer>
