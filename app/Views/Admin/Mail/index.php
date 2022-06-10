<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <!-- Page Heading -->
    <!--For Search block-->
    <div style="height: auto; width: 100%;">
        <form class="user" action="<?= base_url('mail') ?>" method="get" name="formSearchMail">
            <?= csrf_field() ?>
            <input type="hidden" id="for_search" name="for_search" value="1">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 20%;">
                        <div class="form-group">
                            <select onchange="document.formSearchMail.submit();" class="form-control"
                                    id="mail_type" name="mail_type" style="width: 100%;">
                                <option value="" selected>-- Kiểu mail --</option>
                                <?php if (@MAIL_TYPE) { ?>
                                    <?php foreach (MAIL_TYPE as $key => $value) { ?>
                                        <option <?php if (@$dataSearch['mail_type'] == $key) {
                                            echo 'selected';
                                        } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                    </td>
                    <td style="width: 20%; padding-left: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchMail.submit();" class="form-control"
                                    id="mail_status"
                                    name="mail_status" style="width: 100%;">
                                <option value="" selected>-- Trạng thái --</option>
                                <?php if (@MAIL_STATUS) { ?>
                                    <?php foreach (MAIL_STATUS as $ke => $val) { ?>
                                        <option <?php if (@$dataSearch['mail_status'] == $ke && @$dataSearch['mail_status']!='') {
                                            echo 'selected';
                                        } ?> value="<?php echo $ke; ?>"><?php echo $val; ?></option>
                                    <?php }
                                } ?>

                            </select>
                        </div>
                    </td>


                    <td style="width: 20%; padding-left: 10px">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchMail.submit();" type="search" class="form-control"
                                   name="mail_title" id="mail_title"
                                   placeholder="Tiêu đề mail" value="<?= @$dataSearch['mail_title'] ?>">
                        </div>
                    </td>
                    <td style="width: 20%; padding-left: 10px;padding-right: 10px;">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchMail.submit();" type="search" class="form-control"
                                   name="mail_code" id="mail_code"
                                   placeholder="Mã mail" value="<?= @$dataSearch['mail_code'] ?>">
                        </div>
                    </td>
                    <td style="width: auto" colspan="1">
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
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách Mail&nbsp;&nbsp;<span
                                    style="color: darkgreen;">(<?php echo @$totals; ?>)</span></h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url() . '/mail/register' ?>" class="btn btn-info  btn-success mb-2"
                           style="width: 100px;">Tạo mới</a>
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
                        <th scope="col">Tiêu đề mail</th>
                        <th scope="col">Mã mail</th>
                        <th scope="col">Ngôn ngữ</th>
                        <th scope="col">Kiểu mail</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col" style="width: 150px;">Thao tác <input type="checkbox" style="float: right;margin-top: 10px;"
                                                                              class="choose__all"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $page = 1;
                    if (isset($_SESSION['mail.page'])) {
                        $page = $_SESSION['mail.page'];
                    } ?>
                    <?php $item_perpage = ITEM_PERPAGE;
                    if (isset($dataSearch['item_perpage'])) {
                        $item_perpage = $dataSearch['item_perpage'];
                    } ?>
                    <?php unset($_SESSION['mail.page']) ?>
                    <?php $count = ($page - 1) * $item_perpage + 1; ?>
                    <?php if (!empty($mails)) {
                        foreach ($mails as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $count++; ?></td>

                                <td><a title="Xem chi tiết"
                                       href="<?= base_url() . '/mail/detail/' . $value['mail_id']; ?>"><?= $value['mail_title']; ?></a>
                                </td>
                                <td>
                                    <?= $value['mail_code']; ?>
                                </td>
                                <td>
                                    <?php foreach (@$langCode as $key) { ?>
                                        <?php if ($key['lang_code_key'] == @$value['lang']) { echo $key['lang_code_description']; break;} }?>
                                </td>
                                <td>
                                    <?php if (@MAIL_TYPE) {
                                        if (isset(MAIL_TYPE[$value['mail_type']])) { echo MAIL_TYPE[$value['mail_type']];}
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if (@MAIL_STATUS) {
                                        if (isset(MAIL_STATUS[$value['mail_status']])) { echo MAIL_STATUS[$value['mail_status']];}
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if ($value['mail_status'] == 0) { ?>
                                        <span title="Click thay đổi trạng thái" data-type="<?= $value['mail_type']; ?>" data-status="1"
                                              data-group="<?= $value['mail_id']; ?>"
                                              class="mail_status btn btn-sm btn-warning">Hiển thị</span>
                                    <?php } else { ?>
                                        <span title="Click thay đổi trạng thái" data-type="<?= $value['mail_type']; ?>" data-status="0"
                                              data-group="<?= $value['mail_id']; ?>"
                                              class="mail_status btn btn-sm btn-secondary">Không hiển thị</span>
                                    <?php } ?>
                                    <input type="checkbox" data-mail-id="<?= $value['mail_id']; ?>"
                                           class="input__check" style="float: right;margin-top: 10px;">
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
            <p class="text-right"><span class="btn btn-sm btn-danger btn__delete-mail" style="margin-left: 20px;">Delete</span>
            </p>
        </div>
        <div class="row m-0">
            <div class="col-10">
                <?= $pager->links('mail', 'admin_pagination') ?>
            </div>
        </div>
        <form action="<?= base_url() . '/mail/delete_mail'; ?>" method="post"
              class="list_mail_id">
            <?= csrf_field() ?>
            <input type="hidden" name="list_mail_id" id="listMailGroupId">
        </form>
    </div>
<?= $this->endSection() ?>