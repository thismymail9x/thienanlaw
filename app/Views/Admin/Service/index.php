<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <!-- Page Heading -->
    <!--For Search block-->
    <div style="height: auto; width: 100%;">
        <form class="user" action="<?= base_url('service') ?>" method="get" name="formSearchService">
            <?= csrf_field() ?>
            <input type="hidden" id="for_search" name="for_search" value="1">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 25%;">
                        <div class="form-group">
                            <select onchange="document.formSearchService.submit();" class="form-control"
                                    id="service_timeline" name="service_timeline" style="width: 100%;">
                                <option value="" selected>-- Mốc thời gian --</option>
                                <?php if (@SERVICE_TIMELINE) { ?>
                                    <?php foreach (SERVICE_TIMELINE as $key => $value) { ?>
                                        <option <?php if (@$dataSearch['service_timeline'] == $key) {
                                            echo 'selected';
                                        } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                } ?>
                            </select>
                        </div>
                    </td>
                    <td style="width: 25%; padding-left: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchService.submit();" class="form-control"
                                    id="service_status"
                                    name="service_status" style="width: 100%;">
                                <option value="" selected>-- Trạng thái --</option>
                                <?php if (@POST_STATUS) { ?>
                                    <?php foreach (POST_STATUS as $ke => $val) { ?>
                                        <option <?php if (@$dataSearch['service_status'] == $ke && @$dataSearch['service_status']!='') {
                                            echo 'selected';
                                        } ?> value="<?php echo $ke; ?>"><?php echo $val; ?></option>
                                    <?php }
                                } ?>

                            </select>
                        </div>
                    </td>

                    <td style="width: 25%; padding-left: 10px;padding-right: 10px;">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchService.submit();" type="search" class="form-control"
                                   name="service_name" id="service_name"
                                   placeholder="Tên gói dịch vụ" value="<?= @$dataSearch['service_name'] ?>">
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
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách dịch vụ&nbsp;&nbsp;<span
                                    style="color: darkgreen;">(<?php echo @$totals; ?>)</span></h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url() . '/service/register' ?>" class="btn btn-info  btn-success mb-2"
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
                        <th scope="col" style="width: 35%;">Tên dịch vụ</th>
                        <th scope="col">Giá</th>
                        <th scope="col">Nhóm thời gian</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Sắp xếp</th>
                        <th scope="col" style="width: 150px;">Thao tác <input type="checkbox" style="float: right;margin-top: 10px;"
                                                                              class="choose__all"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $page = 1;
                    if (isset($_SESSION['service.page'])) {
                        $page = $_SESSION['service.page'];
                    } ?>
                    <?php $item_perpage = ITEM_PERPAGE;
                    if (isset($dataSearch['item_perpage'])) {
                        $item_perpage = $dataSearch['item_perpage'];
                    } ?>
                    <?php unset($_SESSION['service.page']) ?>
                    <?php $count = ($page - 1) * $item_perpage + 1; ?>
                    <?php if (!empty($services)) {
                        foreach ($services as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $count++; ?></td>

                                <td><a title="Xem chi tiết"
                                       href="<?= base_url() . '/service/detail/' . $value['service_id']; ?>"><?= $value['service_name']; ?></a>
                                </td>
                                <td>
                                    <?= $value['service_price']; ?>
                                    <?php foreach ($langCode as $k) {
                                        if ($k['lang_code_key']==$value['lang']) {
                                            echo $k['currency_symbol']; break;
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <?php if (@SERVICE_TIMELINE) {
                                       if (isset(SERVICE_TIMELINE[$value['service_timeline']])) { echo SERVICE_TIMELINE[$value['service_timeline']];}
                                    }
                                    ?>
                                </td>
                                <td>
                                    <?php if (@POST_STATUS) {
                                       if (isset(POST_STATUS[$value['service_status']])) { echo POST_STATUS[$value['service_status']];}
                                    }
                                    ?>
                                </td>
                                <td> <?= $value['number_order']; ?></td>
                                <td>
                                    <?php if ($value['service_status'] == 0) { ?>
                                        <span title="Click thay đổi trạng thái" data-status="1"
                                              data-group="<?= $value['service_id']; ?>"
                                              class="service_status btn btn-sm btn-warning">Hiển thị</span>
                                    <?php } else { ?>
                                        <span title="Click thay đổi trạng thái" data-status="0"
                                              data-group="<?= $value['service_id']; ?>"
                                              class="service_status btn btn-sm btn-secondary">Không hiển thị</span>
                                    <?php } ?>
                                    <input type="checkbox" data-service-group="<?= $value['service_id']; ?>"
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
            <p class="text-right"><span class="btn btn-sm btn-danger btn__delete-service" style="margin-left: 20px;">Delete</span>
            </p>
        </div>
        <div class="row m-0">
            <div class="col-10">
                <?= $pager->links('service', 'admin_pagination') ?>
            </div>
        </div>
        <form action="<?= base_url() . '/service/delete_service'; ?>" method="post"
              class="list_service_id">
            <?= csrf_field() ?>
            <input type="hidden" name="list_service_id" id="listServiceGroupId">
        </form>
    </div>
<?= $this->endSection() ?>