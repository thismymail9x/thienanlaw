<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <!-- Page Heading -->
    <!--For Search block-->
    <div style="height: auto; width: 100%;">
        <form class="user" action="<?= base_url('page-admin') ?>" method="get" name="formSearchPage">
            <input type="hidden" id="for_search" name="for_search" value="1">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 30%; padding-left: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchPage.submit();" class="form-control" name="lang">
                                <option value="">-- Chọn ngôn ngữ --</option>
                                <?php foreach (@$langCode as $key) { ?>
                                    <option <?php if ($key['lang_code_key']==@$dataSearch['lang']) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>
                    <td style="width: 30%; padding-left: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchPage.submit();" class="form-control" id="status"
                                    name="post_status" style="width: 100%;">
                                <option value="" selected>-- Chọn trạng thái --</option>
                                <?php if (@POST_STATUS) { ?>
                                    <?php foreach (POST_STATUS as $key => $value) { ?>
                                        <option <?php if (@$dataSearch['post_status'] == $key && @$dataSearch['post_status']!='') {
                                            echo 'selected';
                                        } ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                } ?>

                            </select>
                        </div>
                    </td>
                    <td style="width: 30%; padding-left: 10px">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchPage.submit();" type="search" class="form-control"
                                   name="post_title" id="post_title_index"
                                   placeholder="Tiêu đề ..." value="<?= @$dataSearch['post_title'] ?>">
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
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách trang tĩnh&nbsp;&nbsp;<span
                                    style="color: darkgreen;">(<?php echo @$totals; ?>)</span></h6>
                    </td>

                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url() . '/page-admin/register_home' ?>" class="btn btn-info  btn-success mb-2"
                           style="width: 150px;">Tạo trang chủ</a>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url() . '/page-admin/register' ?>" class="btn btn-info  btn-success mb-2"
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
                        <th scope="col">Tiêu đề</th>
                        <th scope="col" style="width: 100px;">Kiểu bài viết</th>
                        <th scope="col" style="width: 150px;">Danh mục</th>
                        <th scope="col" style="width: 90px;">Ngôn ngữ</th>
                        <th scope="col" style="width: 80px;">Trạng thái</th>
                        <th scope="col" style="width: 170px;">Thao tác <input type="checkbox" style="float: right;margin-top: 10px;"
                                                                              class="choose__all"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $page = 1;
                    if (isset($_SESSION['page.page'])) {
                        $page = $_SESSION['page.page'];
                    } ?>
                    <?php $item_perpage = ITEM_PERPAGE;
                    if (isset($dataSearch['item_perpage'])) {
                        $item_perpage = $dataSearch['item_perpage'];
                    } ?>
                   <?php unset($_SESSION['page.page']) ?>
                    <?php $count = ($page - 1) * $item_perpage + 1; ?>
                    <?php if (!empty($pages)) {
                        foreach ($pages as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $count++; ?></td>

                                <td><a title="Xem chi tiết"
                                       href="<?= base_url() . '/page-admin/edit/' . $value['post_id']; ?>"><?= $value['post_title']; ?></a>
                                </td>
                                <td>
                                    <?php if (@POST_TYPE) {
                                        foreach (POST_TYPE as $k => $v) {
                                            if ($k == $value['post_type']) {
                                                echo $v;
                                                break;
                                            }
                                        }
                                    }
                                    ?>
                                </td>

                                <td><?= @$category['post_title']; ?></td>
                                <td><?php foreach ($langCode as $k) {
                                        if ($k['lang_code_key']==$value['lang']) {
                                            echo $k['lang_code_description']; break;
                                        }
                                    } ?></td>
                                <td>
                                    <?php if (@POST_STATUS) {
                                        foreach (POST_STATUS as $ke => $va) {
                                            if ($ke == $value['post_status']) {
                                                echo $va;
                                                break;
                                            }
                                        }
                                    } ?>
                                </td>
                                <td>
                                    <input type="checkbox" data-page-id="<?= $value['post_id']; ?>"
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
            <p class="text-right"><span class="btn btn-sm btn-danger btn__delete-page"
                                        style="margin-left: 20px;">Delete</span></p>
        </div>
        <div class="row m-0">
            <div class="col-10">
                <?= $pager->links('page', 'admin_pagination') ?>
            </div>
        </div>
        <form action="<?= base_url() . '/page-admin/delete_page'; ?>" method="post"
              class="list_page_id">
            <?= csrf_field() ?>
            <input type="hidden" name="list_page_id" id="listPageId">
        </form>
    </div>
    <style>
        /*.table {*/
        /*    font-size: 80%;*/
        /*}*/
    </style>
<?= $this->endSection() ?>