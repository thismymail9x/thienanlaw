<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <!-- Page Heading -->
    <!--For Search block-->
    <div style="height: auto; width: 100%;">
        <form class="user" action="<?= base_url('admins') ?>" method="get" name="formSearchAdmin">
            <input type="hidden" id="for_search" name="for_search" value="1">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 30%; padding-left: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchAdmin.submit();" class="form-control" id="role"
                                    name="admin_role" style="width: 100%;">
                                <option value="" selected>-- Chọn quyền --</option>
                                <?php if (@ADMIN_ROLES) { ?>
                                    <?php foreach (ADMIN_ROLES as $key => $value) { ?>
                                        <option <?php if (@$dataSearch['admin_role'] == $key) {
                                            echo 'selected';
                                        } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                    </td>
                    <td style="width: 30%; padding-left: 10px">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchAdmin.submit();" type="search" class="form-control"
                                   name="admin_email" id="admin_email"
                                   placeholder="email ..." value="<?= @$dataSearch['admin_email'] ?>">
                        </div>
                    </td>
                    <td style="width: auto; padding-left: 10px" colspan="3">
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
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách admin&nbsp;&nbsp;<span
                                    style="color: darkgreen;">(<?php echo @$totals; ?>)</span></h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url() . '/admin/register' ?>" class="btn btn-info  btn-success mb-2"
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
                        <th scope="col" style="width: 250px;">Họ tên</th>
                        <th scope="col">Email</th>
                        <th scope="col" style="width: 150px;">Số điện thoại</th>
                        <th scope="col" style="width: 120px;">Quyền</th>
                        <th scope="col" style="width: 120px;">Trạng thái</th>
                        <th scope="col" style="width: 170px;">Thao tác <input type="checkbox" style="float: right;margin-top: 10px;"
                                                                              class="choose__all"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $page = 1;
                    if (isset($_SESSION['admins.page'])) {
                        $page = $_SESSION['admins.page'];
                    } ?>
                    <?php $item_perpage = ITEM_PERPAGE;
                    if (isset($dataSearch['item_perpage'])) {
                        $item_perpage = $dataSearch['item_perpage'];
                    } ?>
                   <?php unset($_SESSION['admins.page']) ?>
                    <?php $count = ($page - 1) * $item_perpage + 1; ?>
                    <?php if (!empty($admins)) {
                        foreach ($admins as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $count++; ?></td>
                                <td><?= $value['full_name']; ?></td>
                                <td><a title="Xem chi tiết"
                                       href="<?= base_url() . '/admins/detail/' . $value['admin_id']; ?>"><?= $value['admin_email']; ?></a>
                                </td>
                                <td><?= $value['phone_number']; ?></td>
                                <td>
                                    <?php if (@ADMIN_ROLES) {
                                        foreach (ADMIN_ROLES as $k => $v) {
                                            if ($k == $value['admin_role']) {
                                                echo $v;
                                                break;
                                            }
                                        }
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if (@ADMIN_ACTIVE) {
                                        foreach (ADMIN_ACTIVE as $ke => $va) {
                                            if ($ke == $value['active']) {
                                                echo $va;
                                                break;
                                            }
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <?php if ($value['active'] == 2) { ?>
                                        <span title="Click thay đổi trạng thái" data-active="1"
                                              data-id="<?= $value['admin_id']; ?>"
                                              class="js__active-admin btn btn-sm btn-warning">Kích hoạt</span>
                                    <?php } else { ?>
                                        <span title="Click thay đổi trạng thái" data-active="2"
                                              data-id="<?= $value['admin_id']; ?>"
                                              class="js__active-admin btn btn-sm btn-secondary">Hủy kích hoạt</span>
                                    <?php } ?>
                                    <input type="checkbox" data-admin-id="<?= $value['admin_id']; ?>"
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
            <p class="text-right"><span class="btn btn-sm btn-danger btn__delete-admin"
                                        style="margin-left: 20px;">Delete</span></p>
        </div>
        <div class="row m-0">
            <div class="col-10">
                <?= $pager->links('admins', 'admin_pagination') ?>
            </div>
        </div>
        <form action="<?= base_url() . '/admins/delete_admin'; ?>" method="post"
              class="list_admin_id">
            <?= csrf_field() ?>
            <input type="hidden" name="list_admin_id" id="listAdminId">
        </form>
    </div>
    <style>
        /*.table {*/
        /*    font-size: 80%;*/
        /*}*/
    </style>
<?= $this->endSection() ?>