<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <!-- Page Heading -->
    <!--For Search block-->
    <div style="height: auto; width: 100%;">
        <form class="user" action="<?= base_url('language_code') ?>" method="get" name="formSearchlanguageCode">
            <?= csrf_field() ?>
            <input type="hidden" id="for_search" name="for_search" value="1">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 30%; padding-left: 10px;padding-right: 10px;">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchlanguageCode.submit();" type="search" class="form-control"
                                   name="lang_code_key" id="lang_code_key"
                                   placeholder="Từ khóa ngôn ngữ" value="<?= @$dataSearch['lang_code_key'] ?>">
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
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách ngôn ngữ&nbsp;&nbsp;<span
                                    style="color: darkgreen;">(<?php echo @$totals; ?>)</span></h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url() . '/language_code/edit/' ?>" class="btn btn-info  btn-success mb-2"
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
                        <th scope="col">Từ khóa</th>
                        <th scope="col">Mô tả</th>
                        <th scope="col">Kí hiệu tiền tệ</th>
                        <th scope="col" style="width: 70px;"><input type="checkbox" style="float: right"
                                                                              class="choose__all"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $page = 1;
                    if (isset($_SESSION['language_code.page'])) {
                        $page = $_SESSION['language_code.page'];
                    } ?>
                    <?php $item_perpage = ITEM_PERPAGE;
                    if (isset($dataSearch['item_perpage'])) {
                        $item_perpage = $dataSearch['item_perpage'];
                    } ?>
                    <?php unset($_SESSION['language_code.page']) ?>
                    <?php $count = ($page - 1) * $item_perpage + 1; ?>
                    <?php if (!empty($language_codes)) {
                        foreach ($language_codes as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $count++; ?></td>

                                <td><a title="Chỉnh sửa"
                                       href="<?= base_url() . '/language_code/edit/' . $value['lang_code_id']; ?>"><?= $value['lang_code_key']; ?></a>
                                </td>
                                <td>
                                    <?= $value['lang_code_description']; ?>
                                </td>
                                <td>
                                    <?= $value['currency_symbol']; ?>
                                </td>
                                <td>
                                    <input type="checkbox" data-id="<?= $value['lang_code_id']; ?>"
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
            <p class="text-right"><span class="btn btn-sm btn-danger btn__delete-language-code" style="margin-left: 20px;">Delete</span>
            </p>
        </div>
        <div class="row m-0">
            <div class="col-10">
                <?= $pager->links('language_code', 'admin_pagination') ?>
            </div>
        </div>
        <form action="<?= base_url() . '/language_code/delete_lang_code'; ?>" method="post"
              class="list_language_code_id">
            <?= csrf_field() ?>
            <input type="hidden" name="list_language_code_id" id="listlanguageCodeId">
        </form>
    </div>
<?= $this->endSection() ?>