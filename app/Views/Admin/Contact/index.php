<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <!-- Page Heading -->
    <!--For Search block-->
    <div style="height: auto; width: 100%;">
        <form class="user" action="<?= base_url('contact-user') ?>" method="get" name="formSearchContact">
            <input type="hidden" id="for_search" name="for_search" value="1">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 25%; padding-left: 10px">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchContact.submit();" type="search" class="form-control"
                                   name="title" id="title"
                                   placeholder="Tiêu đề..." value="<?= @$dataSearch['title'] ?>">
                        </div>
                    </td>
                    <td style="width: 25%; padding-left: 10px;">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchContact.submit();" type="search" class="form-control"
                                   name="content" id="content"
                                   placeholder="Nội dung..." value="<?= @$dataSearch['content'] ?>">
                        </div>
                    </td>
                    <td style="width: 25%; padding-left: 10px;padding-right: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchContact.submit();" class="form-control"
                                    id="service_status"
                                    name="status" style="width: 100%;">
                                <option value="" selected>-- Trạng thái --</option>
                                <?php if (@CONTACT_STATUS) { ?>
                                    <?php foreach (CONTACT_STATUS as $ke => $val) { ?>
                                        <option <?php if (@$dataSearch['status'] == $ke && @$dataSearch['status']!='') {
                                            echo 'selected';
                                        } ?> value="<?php echo $ke; ?>"><?php echo $val; ?></option>
                                    <?php }
                                } ?>

                            </select>
                        </div>
                    </td>

                    <td style="width: auto;" colspan="1">
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
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách đăng ký liên hệ&nbsp;&nbsp;<span
                                    style="color: darkgreen;">(<?php echo @$totals; ?>)</span></h6>
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
                        <th scope="col" style="width: 30%">Tiêu đề liên hệ</th>
                        <th scope="col" style="width: auto">Nội dung</th>
                        <th scope="col" style="width: 110px;">Ngày tạo</th>
                        <th scope="col" style="width: 110px;">Trạng thái</th>
                        <th scope="col" style="width: 150px;">Thao tác</th>
                        <th scope="col" style="width: 50px;"><input type="checkbox" style="float: right;margin-top: 10px;"
                                                                     class="choose__all"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $page = 1;
                    if (isset($_SESSION['contact.page'])) {
                        $page = $_SESSION['contact.page'];
                    } ?>
                    <?php $item_perpage = ITEM_PERPAGE;
                    if (isset($dataSearch['item_perpage'])) {
                        $item_perpage = $dataSearch['item_perpage'];
                    } ?>
                    <?php unset($_SESSION['contact.page']) ?>
                    <?php $count = ($page - 1) * $item_perpage + 1; ?>
                    <?php if (!empty($contacts)) {
                        foreach ($contacts as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $count++;?></td>
                                <td><a title="Xem chi tiết"
                                       href="<?= base_url() . '/contact-user/detail/' . $value['contact_id']; ?>"><?= $value['title']; ?></a>
                                </td>
                                <td>
                                   <span title="<?= $value['content']; ?>" class="limit-text-1"> <?= $value['content']; ?></span>
                                </td>
                                <td><?= date('d-m-Y',strtotime($value['created_at']));  ?></td>
                                <td>
                                    <?php if (@CONTACT_STATUS) {
                                        foreach (CONTACT_STATUS as $ke => $va) {
                                            if ($ke == $value['status']) {
                                                echo $va;
                                                break;
                                            }
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <?php if ($value['status'] == 0) { ?>
                                        <span title="Click thay đổi trạng thái" data-status="1"
                                              data-id="<?= $value['contact_id']; ?>"
                                              class="contact_status btn btn-sm btn-success">Xác nhận liên hệ</span>
                                    <?php } ?>
                                </td>
                                <td>
                                    <input type="checkbox" data-contact-id="<?= $value['contact_id']; ?>"
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
            <p class="text-right"><span class="btn btn-sm btn-danger btn__delete-contact" style="margin-left: 20px;">Delete</span>
            </p>
        </div>
        <div class="row m-0">
            <div class="col-10">
                <?= $pager->links('contact', 'admin_pagination') ?>
            </div>
        </div>
        <form action="<?= base_url() . '/contact-user/delete_contact'; ?>" method="post"
              class="contact_list">
            <?= csrf_field() ?>
            <input type="hidden" name="contact_list" id="contactList">
        </form>
    </div>
<?= $this->endSection() ?>