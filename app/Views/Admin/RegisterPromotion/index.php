<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <!-- Page Heading -->
    <!--For Search block-->
    <div style="height: auto; width: 100%;">
        <form class="user" action="<?= base_url('register_promotion') ?>" method="get"
              name="formSearchRegisterPromotion">
            <?= csrf_field() ?>
            <input type="hidden" id="for_search" name="for_search" value="1">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 25%; padding-left: 10px;">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchRegisterPromotion.submit();" type="search"
                                   class="form-control"
                                   name="email" id="email_register_promotion"
                                   placeholder="Tên email" value="<?= @$dataSearch['email'] ?>">
                        </div>
                    </td>
                    <td style="width: 25%; padding-left: 10px;padding-right: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchRegisterPromotion.submit();" class="form-control" name="lang">
                                <option value="">-- Chọn ngôn ngữ --</option>
                                <?php foreach (@$langCode as $key) { ?>
                                    <option <?php if ($key['lang_code_key']==@$dataSearch['lang']) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td style="width: 25%;padding-right: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchRegisterPromotion.submit();" class="form-control" name="send_email_status">
                                <option value="">-- Trạng thái --</option>
                                <?php foreach (@REGISTER_PROMOTION_STATUS as $key =>$value) { ?>
                                    <option <?php if ($key==@$dataSearch['send_email_status'] && @$dataSearch['send_email_status']!='') {echo 'selected';}?> value="<?= $key ?>"><?= $value ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td style="width: auto; " colspan="3">
                        <button class="btn btn-success mb-3" type="submit" style="width: 100px;">Tìm kiếm</button>
                    </td>
                </tr>
            </table>
        </form>
    </div>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <table style="width: 100%;">
                <tr>
                    <td style="width: auto;">
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách email&nbsp;&nbsp;<span
                                    style="color: darkgreen;">(<?php echo @$totals; ?>)</span>

                        </h6>
                    </td>
                    <td style="width: 200px;">
                        <select class="form-control js__choose-mail" name="mail_template" id="">
                            <option value="">Chọn mẫu mail</option>
                            <?php foreach ($mail_templates as $k => $v) { ?>
                                <option value="<?php echo $v['mail_id'] ?>"><?php echo $v['mail_title'] ?><i>(<?php echo $v['lang'] ?>)</i></option>
                            <?php } ?>
                        </select></td>
                    <td style="text-align: right;width: 150px;">
                        <span class="btn btn-sm btn-primary btn__send_promotion"
                              style="margin-left: 20px;">Gửi tin khuyến mại</span>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">
            <div class="table-responsive" id="divLoadData">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                    <tr>
                        <th scope="col" class="text-center" style="width: 25px;">STT</th>
                        <th scope="col">Tên email</th>
                        <th scope="col" style="width: 300px;">Thời gian đăng kí</th>
                        <th scope="col" style="width: 150px;">Ngôn ngữ</th>
                        <th scope="col" style="width: 200px;">Trạng thái</th>
                        <th scope="col" style="width: 50px;"><input type="checkbox" style="float: right"
                                                                              class="choose__all"></th>
                    </tr>
                    </thead>
                    <tbody>

                    <?php $page = 1;

                    if (isset($_SESSION['register_promotion.page'])) {
                        $page = $_SESSION['register_promotion.page'];
                    } ?>
                    <?php $item_perpage = ITEM_PERPAGE;
                    if (isset($dataSearch['item_perpage'])) {
                        $item_perpage = $dataSearch['item_perpage'];
                    } ?>
                    <?php unset($_SESSION['register_promotion.page']) ?>
                    <?php $count = ($page - 1) * $item_perpage + 1; ?>
                    <?php if (!empty($register_promotions)) {
                        foreach ($register_promotions as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $count++; ?></td>
                                <td><?= $value['email']; ?></td>
                                <td><?= date('d-m-Y',strtotime($value['created_at']));  ?></td>
                                <td>
                                    <?php foreach (@$langCode as $key) { ?>
                                        <?php if ($key['lang_code_key'] == @$value['lang']) { echo $key['lang_code_description']; break;} }?>
                                </td>
                                <td><?php if($value['send_email_status']==1){echo 'Chờ gửi mail';}else {echo 'Chưa gửi';}  ?></td>
                                <td>
                                    <input type="checkbox" data-register-promotion-id="<?= $value['register_promotion_id'];?>"
                                           class="input__check" style="float: right">
                                </td>
                            </tr>

                        <?php }
                    } else { ?>
                        <tr>
                            <td colspan="8" style="color: brown;">Không tìm thấy dữ liệu</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>

            </div>
            <p class="text-right">

                <span class="btn btn-sm btn-danger btn__delete_promotion" style="margin-left: 20px;">Delete</span>
            </p>
        </div>
        <div class="row m-0">
            <div class="col-10">
                <?= $pager->links('register_promotion', 'admin_pagination') ?>
            </div>
        </div>
<!--        form delete-->
        <form action="<?= base_url() . '/register_promotion/delete_register_promotion'; ?>" method="post"
              class="register_promotion_list">
            <?= csrf_field() ?>
            <input type="hidden" name="register_promotion_list" id="registerPromotionList">
        </form>
<!--        form send email-->
        <form action="<?= base_url() . '/register_promotion/send_register_promotion'; ?>" method="post"
              class="send_promotion_list">
            <?= csrf_field() ?>
            <input type="hidden" name="send_promotion_list" id="sendPromotionList">
            <input type="hidden" name="template_mail_id" id="mailTemplateId">
        </form>



    </div>
    <script>
    </script>
<?= $this->endSection() ?>