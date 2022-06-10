<?php if(!empty($seos)) {?>
    <?php if(!empty($seos['seo_google'])) {?>
<!--        <meta property="og:google" content="--><?//= $seos['seo_google']?><!--">-->
    <?php } else {?>

<!--        <meta property="og:google" content="--><?//= BASE_URL_GLOBAL.'/public/images/vpn-default-1024x1024.webp'?><!--">-->
    <?php }?>



    <?php if(!empty($seos['og_title'])) {?>
        <title><?= $seos['og_title']?></title>
    <?php } else {?>
        <title><?= @$home_seo['og_title']?></title>
    <?php }?>
    <?php if(!empty($seos['og_description'])) {?>
        <meta name="description" content="<?= $seos['og_description']?>">
    <?php } else {?>
        <meta name="description" content="<?= @$home_seo['og_description']?>">
    <?php }?>
    <?php if(!empty($seos['keywords'])) {?>
        <meta name="keywords" itemprop="keywords" content="<?= $seos['keywords']?>">
    <?php } else {?>
        <meta name="keywords" itemprop="keywords" content="<?= @$home_seo['keywords']?>">
    <?php }?>

    <?php if(!empty($seos['canonical'])) {?>
        <link rel="canonical" href="<?= $seos['canonical']?>">
    <?php } else {?>
        <link rel="canonical" href="<?= @$home_seo['canonical']?>">
    <?php }?>
    <?php if(!empty($seos['og_locale'])) {?>
        <meta property="og:locale" content="<?= $seos['og_locale']?>">
    <?php } else {?>
        <meta property="og:locale" content="<?= @$home_seo['og_locale']?>">
    <?php }?>
    <?php if(!empty($seos['og_type'])) {?>
        <meta property="og:type" content="<?= $seos['og_type']?>">
    <?php } else {?>
        <meta property="og:type" content="<?= @$home_seo['og_type']?>">
    <?php }?>
    <?php if(!empty($seos['og_title'])) {?>
        <meta property="og:title" content="<?= $seos['og_title']?>">
    <?php } else {?>
        <meta property="og:title" content="<?= @$home_seo['og_title']?>">
    <?php }?>

    <?php if(!empty($seos['og_description'])) {?>
        <meta property="og:description" content="<?= $seos['og_description']?>">
    <?php } else {?>
        <meta property="og:description" content="<?= @$home_seo['og_description']?>">
    <?php }?>

    <?php if(!empty($seos['og_url'])) {?>
        <meta property="og:url" content="<?= $seos['og_url']?>">
    <?php } else {?>
        <meta property="og:url" content="<?= @$home_seo['og_url']?>">
    <?php }?>
    <?php if(!empty($seos['og_site_name'])) {?>
        <meta property="og:site_name" content="<?= $seos['og_site_name']?>">
    <?php } else {?>
        <meta property="og:site_name" content="<?= @$home_seo['og_site_name']?>">
    <?php }?>
    <?php if(!empty($seos['fb_app_id'])) {?>
        <meta property="fb:app_id" content="<?= $seos['fb_app_id']?>">
    <?php } else {?>
        <meta property="fb:app_id" content="<?= @$home_seo['fb_app_id']?>">
    <?php }?>
    <?php if(!empty($seos['og_image'])) {?>
        <meta property="og:image" content="<?= $seos['og_image']?>">
    <?php } else {?>
        <meta property="og:image" content="<?= BASE_URL_GLOBAL.'/public/images/vpn-default-1024x1024.webp'?>">
    <?php }?>

    <meta property="og:image:alt" content="<?php if (!empty($seos['og_title'])){echo $seos['og_title'];}else {echo 'vpn';} ?>">
    <meta property="og:image:width" content="1024">
    <meta property="og:image:height" content="1024">
    <meta property="og:image:type" content="image/webp">

    <?php if(!empty($seos['alternate'])) {?>
        <link rel="alternate" type="application/rss+xml" title="<?= $seos['og_title'] ?>" href="<?= $seos['alternate'] ?>">
    <?php } else {?>
        <link rel="alternate" type="application/rss+xml" title="<?= $seos['og_title'] ?>" href="<?= base_url() ?>">
    <?php }?>



<?php }?>