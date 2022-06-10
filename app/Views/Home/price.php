<?= $this->extend("Layouts/HomeLayout") ?>
<?= $this->section("content_home") ?>
    <section class="price">
        <div class="container">
            <h1 class="title"><?= lang("Text.price.title") ?></h1>
            <p class="introduce"><?= lang("Text.price.introduce") ?></p>
            <div class="tab__price">
                <ul class="nav nav-pills d-flex justify-content-center" id="pills-tab" role="tablist">
                    <?php if (@SERVICE_TIMELINE) {
                        foreach (isset($_COOKIE['lang']) && $_COOKIE['lang'] =='en'?SERVICE_TIMELINE_EN : SERVICE_TIMELINE as $k => $v) { ?>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link <?php if ($k == '2y') {
                                    echo 'nav-link-last active';
                                } ?>" id="pills-<?= $k; ?>-tab" data-toggle="pill" href="#pills-<?= $k ?>" role="tab"
                                   aria-controls="pills-bantin" aria-selected="false"><?= $v; ?></a>
                            </li>
                            <?php
                        }
                    } ?>
                </ul>
                <div class="tab-content" id="pills-tabContent">
                    <?php if (@SERVICE_TIMELINE) {
                        foreach (isset($_COOKIE['lang']) && $_COOKIE['lang'] =='en'?SERVICE_TIMELINE_EN : SERVICE_TIMELINE as $k => $v) { ?>

                            <div class="tab-pane fade <?php if ($k == '2y') {
                                echo 'show active';
                            } ?>" id="pills-<?= $k; ?>" role="tabpanel"
                                 aria-labelledby="pills-<?= $k; ?>-tab">
                                <div class="price__content">
                                    <div class="row custom_row">
                                        <?php if ($k == '1m') { ?>
                                            <?php foreach (@$services1m as $key => $value) {
                                                $num = $key + 1;
                                                ?>
                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 item <?php if ($key % 2 != 0) {
                                                    echo 'item-even';
                                                } ?>">
                                                    <div class="first">
                                                        <p><?= lang("Text.price.package") ?> <?= $num ?></p>
                                                    </div>
                                                    <div class="second">
                                                        <p><span><?= $value['service_price'] ?> <sup><?= lang("Text.price.money") ?></sup></span>
                                                            /<?= lang("Text.price.month") ?></p>
                                                        <i><?= $value['service_introduce'] ?></i>
                                                    </div>
                                                    <div class="third">
                                                        <ul>
                                                            <!-- tách chuỗi tính năng rồi duyệt -->
                                                            <?php $features = explode(',', $value['service_content']);
                                                            foreach ($features as $list => $item) { ?>
                                                                <!--   tính năng quá 2 thì ẩn đi-->
                                                                <li class="<?php if ($list > 2) {
                                                                    echo 'd-none';
                                                                } ?>">
                                                                    <div>
                                                                        <div class="icon-check-child"></div>
                                                                    </div>
                                                                    <span><?= $item ?></span>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                        <p class="click-more <?php if (count($features)<=2) {echo 'd-none';} ?>">
                                                            <a><?= lang("Text.price.click-more") ?></a>
                                                            <span class="icon-down"></span>
                                                        </p>
                                                    </div>
                                                    <div class="fifth">
                                                        <a href=""><?= lang("Text.price.button") ?></a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } elseif ($k == '6m') { ?>
                                            <?php foreach (@$services6m as $key => $value) {
                                                $num = $key + 1;
                                                ?>

                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 item <?php if ($key % 2 != 0) {
                                                    echo 'item-even';
                                                } ?>">
                                                    <div class="first">
                                                        <p><?= lang("Text.price.package") ?> <?= $num ?></p>
                                                    </div>
                                                    <div class="second">
                                                        <p><span><?= $value['service_price'] ?> <sup><?= lang("Text.price.money") ?></sup></span>
                                                            /<?= lang("Text.price.month") ?></p>
                                                        <i><?= $value['service_introduce'] ?></i>
                                                    </div>
                                                    <div class="third">
                                                        <ul>
                                                            <!-- tách chuỗi tính năng rồi duyệt -->
                                                            <?php $features = explode(',', $value['service_content']);
                                                            foreach ($features as $list => $item) { ?>
                                                                <!--   tính năng quá 2 thì ẩn đi-->
                                                                <li class="<?php if ($list > 2) {
                                                                    echo 'd-none';
                                                                } ?>">
                                                                    <div>
                                                                        <div class="icon-check-child"></div>
                                                                    </div>
                                                                    <span><?= $item ?></span>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                        <p class="click-more <?php if (count($features)<=2) {echo 'd-none';} ?>">
                                                            <a><?= lang("Text.price.click-more") ?></a>
                                                            <span class="icon-down"></span>
                                                        </p>
                                                    </div>
                                                    <div class="fifth">
                                                        <a href=""><?= lang("Text.price.button") ?></a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } elseif ($k == '1y') { ?>
                                            <?php foreach (@$services1y as $key => $value) {
                                                $num = $key + 1;
                                                ?>

                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 item <?php if ($key % 2 != 0) {
                                                    echo 'item-even';
                                                } ?>">
                                                    <div class="first">
                                                        <p><?= lang("Text.price.package") ?> <?= $num ?></p>
                                                    </div>
                                                    <div class="second">
                                                        <p><span><?= $value['service_price'] ?> <sup><?= lang("Text.price.money") ?></sup></span>
                                                            /<?= lang("Text.price.month") ?></p>
                                                        <i><?= $value['service_introduce'] ?></i>
                                                    </div>
                                                    <div class="third">
                                                        <ul>
                                                            <!-- tách chuỗi tính năng rồi duyệt -->
                                                            <?php $features = explode(',', $value['service_content']);
                                                            foreach ($features as $list => $item) { ?>
                                                                <!--   tính năng quá 2 thì ẩn đi-->
                                                                <li class="<?php if ($list > 2) {
                                                                    echo 'd-none';
                                                                } ?>">
                                                                    <div>
                                                                        <div class="icon-check-child"></div>
                                                                    </div>
                                                                    <span><?= $item ?></span>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                        <p class="click-more <?php if (count($features)<=2) {echo 'd-none';} ?>">
                                                            <a><?= lang("Text.price.click-more") ?></a>
                                                            <span class="icon-down"></span>
                                                        </p>
                                                    </div>
                                                    <div class="fifth">
                                                        <a href=""><?= lang("Text.price.button") ?></a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } else { ?>
                                            <?php foreach (@$services2y as $key => $value) {
                                                $num = $key + 1;
                                                ?>

                                                <div class="col-12 col-sm-6 col-md-6 col-lg-4 col-xl-2 item <?php if ($key % 2 != 0) {
                                                    echo 'item-even';
                                                } ?>">
                                                    <div class="first">
                                                        <p><?= lang("Text.price.package") ?> <?= $num ?></p>
                                                    </div>
                                                    <div class="second">
                                                        <p><span><?= $value['service_price'] ?> <sup><?= lang("Text.price.money") ?></sup></span>
                                                            /<?= lang("Text.price.month") ?></p>
                                                        <i><?= $value['service_introduce'] ?></i>
                                                    </div>
                                                    <div class="third">
                                                        <ul>
                                                            <!-- tách chuỗi tính năng rồi duyệt -->
                                                            <?php $features = explode(',', $value['service_content']);
                                                            foreach ($features as $list => $item) { ?>
                                                                <!--   tính năng quá 2 thì ẩn đi-->
                                                                <li class="<?php if ($list > 2) {
                                                                    echo 'd-none';
                                                                } ?>">
                                                                    <div>
                                                                        <div class="icon-check-child"></div>
                                                                    </div>
                                                                    <span><?= $item ?></span>
                                                                </li>
                                                            <?php } ?>
                                                        </ul>
                                                        <p class="click-more <?php if (count($features)<=2) {echo 'd-none';} ?>">
                                                            <a><?= lang("Text.price.click-more") ?></a>
                                                            <span class="icon-down"></span>
                                                        </p>
                                                    </div>
                                                    <div class="fifth">
                                                        <a href=""><?= lang("Text.price.button") ?></a>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <?php
                        }
                    } ?>
                </div>
            </div>
        </div>
    </section>

   <!-- price version 2-->

    <div class="price__intovpn">
        <div class="container mb-5 mt-5">
                        <div class="pricing card-deck flex-column flex-md-row mb-3 owl-carousel owl-theme" id="price__owl-carousel">
                <div href="abc.com" style="text-decoration: none"
                   class="card card-pricing popular shadow text-center px-3 mb-4">
                    <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm mb-3">Best choose</span>
                    <span class="title__plan">2-year plan</span>
                    <div class="bg-transparent card-header pt-1 border-0">
                        <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30"><span
                                    class="currency">$</span><span class="price">4.99</span><span
                                    class="h6 text-muted ml-2">/ per month</span></h1>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <ul class="list-unstyled mb-4 fz-14 fw-500">
                            <li>Up to 25 users</li>
                            <li>
                                <del class="d-inline-block">$287.76</del>
                                <span class="d-inline"><span class="real__price">$119.76</span> for the first 2 years</span>
                            </li>
                            <li><span class="save__price active">Save 51%</span></li>
                            <li>Monthly updates</li>
                            <li class="vat__apply">VAT may apply</li>
                        </ul>
                        <button class="btn btn-primary mb-3" style="width: 100%">Get 2-year plan</button>
                    </div>
                </div>
                <div href="" style="text-decoration: none" class="card card-pricing shadow text-center px-3 mb-4">
                    <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm mb-3 hide__opacity">Best choose</span>
                    <span class="title__plan">1-year plan</span>
                    <div class="bg-transparent card-header pt-1 border-0">
                        <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30"><span
                                    class="currency">$</span><span class="price">6.99</span><span
                                    class="h6 text-muted ml-2">/ per month</span></h1>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <ul class="list-unstyled mb-4 fz-14 fw-500">
                            <li>Up to 15 users</li>
                            <li>
                                <del class="d-inline-block">$143.88</del>
                                <span class="d-inline"><span class="real__price">$83.88</span> for the first 1 year</span>
                            </li>
                            <li><span class="save__price">Save 30%</span></li>
                            <li>Monthly updates</li>
                            <li class="vat__apply">VAT may apply</li>
                        </ul>
                        <button class="btn btn-outline-secondary mb-3" style="width: 100%">Get 1-year plan</button>
                    </div>
                </div>
                <div style="text-decoration: none" class="card card-pricing shadow text-center px-3 mb-4">
                    <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm mb-3 hide__opacity">Best choose</span>
                    <span class="title__plan">1-month plan</span>
                    <div class="bg-transparent card-header pt-1 border-0">
                        <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30"><span
                                    class="currency">$</span><span class="price">11.99</span><span
                                    class="h6 text-muted ml-2">/ per month</span></h1>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <ul class="list-unstyled mb-4 fz-14 fw-500">
                            <li>Up to 5 users</li>
                            <li>
                                <span class="d-inline"><span class="real__price-not-sale">$11.99</span> for the first 1 month</span>
                            </li>
                            <li><span class="save__price">Save 0%</span></li>
                            <li>Monthly updates</li>
                            <li class="vat__apply">VAT may apply</li>
                        </ul>
                        <button class="btn btn-outline-secondary mb-3" style="width: 100%">Get 1-month plan</button>
                    </div>
                </div>
                <div style="text-decoration: none" class="card card-pricing shadow text-center px-3 mb-4">
                    <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm mb-3 hide__opacity">Best choose</span>
                    <span class="title__plan">1-month plan</span>
                    <div class="bg-transparent card-header pt-1 border-0">
                        <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30"><span
                                    class="currency">$</span><span class="price">11.99</span><span
                                    class="h6 text-muted ml-2">/ per month</span></h1>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <ul class="list-unstyled mb-4 fz-14 fw-500">
                            <li>Up to 5 users</li>
                            <li>
                                <span class="d-inline"><span class="real__price-not-sale">$11.99</span> for the first 1 month</span>
                            </li>
                            <li><span class="save__price">Save 0%</span></li>
                            <li>Monthly updates</li>
                            <li class="vat__apply">VAT may apply</li>
                        </ul>
                        <button class="btn btn-outline-secondary mb-3" style="width: 100%">Get 1-month plan</button>
                    </div>
                </div>
                <div style="text-decoration: none" class="card card-pricing shadow text-center px-3 mb-4">
                    <span class="h6 w-60 mx-auto px-4 py-1 rounded-bottom bg-primary text-white shadow-sm mb-3 hide__opacity">Best choose</span>
                    <span class="title__plan">1-month plan</span>
                    <div class="bg-transparent card-header pt-1 border-0">
                        <h1 class="h1 font-weight-normal text-primary text-center mb-0" data-pricing-value="30"><span
                                    class="currency">$</span><span class="price">11.99</span><span
                                    class="h6 text-muted ml-2">/ per month</span></h1>
                    </div>
                    <div class="card-body pt-0 px-0">
                        <ul class="list-unstyled mb-4 fz-14 fw-500">
                            <li>Up to 5 users</li>
                            <li>
                                <span class="d-inline"><span class="real__price-not-sale">$11.99</span> for the first 1 month</span>
                            </li>
                            <li><span class="save__price">Save 0%</span></li>
                            <li>Monthly updates</li>
                            <li class="vat__apply">VAT may apply</li>
                        </ul>
                        <button class="btn btn-outline-secondary mb-3" style="width: 100%">Get 1-month plan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?= $this->endSection() ?>