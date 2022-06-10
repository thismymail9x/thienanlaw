<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <!-- Page Heading -->
    <!--For Search block-->
    <div style="height: auto; width: 100%;">
        <form class="user"  action="<?= base_url('post_category') ?>" method="get" name="formSearchPostCategory">
            <?= csrf_field() ?>
            <input type="hidden" id="for_search" name="for_search" value="1">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 25%;">
                        <div class="form-group">
                            <select onchange="document.formSearchPostCategory.submit();" class="form-control" id="post_type" name="post_type" style="width: 100%;">
                                <option value="" selected>-- Chọn kiểu danh mục --</option>
                                <?php if (@POST_TYPE) { ?>
                                    <?php foreach (POST_TYPE as $key => $value) { ?>
                                            <option <?php if (@$dataSearch['post_type']==$key){ echo 'selected';} ?> value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                        <?php } } ?>
                            </select>
                        </div>
                    </td>
                    <td style="width: 25%;padding-left: 10px;">
                        <div class="form-group">
                            <select onchange="document.formSearchPostCategory.submit();" class="form-control" id="lang" name="lang" style="width: 100%;">
                                <option value="" selected>-- Chọn ngôn ngữ --</option>
                                <?php foreach (@$langCode as $key) { ?>
                                    <option <?php if ($key['lang_code_key']  == @$dataSearch['lang']) {echo 'selected';}?> value="<?= $key['lang_code_key'] ?>"><?= $key['lang_code_description'] ?></option>
                                <?php } ?>
                            </select>
                        </div>
                    </td>


                    <td style="width: 25%; padding-left: 10px;padding-right: 10px;">
                        <div class="form-group">
                            <input autocomplete="off" onchange="document.formSearchPostCategory.submit();" type="search" class="form-control" name="post_title"
                                   placeholder="Tiêu đề danh mục" value="<?= @$dataSearch['post_title'] ?>">
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
                        <h6 class="m-0 font-weight-bold text-primary">Danh sách danh mục&nbsp;&nbsp;<span
                                    style="color: darkgreen;">(<?php echo @$totals; ?>)</span></h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url() . '/post_category/register' ?>" class="btn btn-info  btn-success mb-2"
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
                        <th scope="col">Kiểu danh mục</th>
                        <th scope="col">Ngôn ngữ</th>
                        <th scope="col">Trạng thái</th>
                        <th scope="col">Vị trí</th>
                        <th scope="col" style="width:100px;"><input type="checkbox" style="float: right" class="choose__all"></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $page = 1; if(isset($_SESSION['post_category.page'])){ $page = $_SESSION['post_category.page']; }?>
                    <?php $item_perpage = ITEM_PERPAGE; if(isset($dataSearch['item_perpage'])){ $item_perpage = $dataSearch['item_perpage']; } ?>
                    <?php unset($_SESSION['post_category.page']) ?>
                    <?php  $count = ($page - 1)*$item_perpage + 1; ?>
                    <?php if (!empty($post_categories)) {
                        foreach ($post_categories as $key => $value) { ?>
                            <tr>
                                <td class="text-center"><?= $count++; ?></td>

                                <td><a title="Xem chi tiết" href="<?= base_url().'/post_category/edit/'.$value['post_id']; ?>"><?= $value['post_title']; ?></a></td>
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
                                <td><?= $value['number_order']; ?></td>
                                <td>
                                    <input type="checkbox" data-category-id="<?= $value['post_id']; ?>" class="input__check" style="float: right">
                                </td>
                            </tr>
                        <?php } } else { ?>
                        <tr>
                            <td colspan="8" style="color: brown;">Không tìm thấy dữ liệu</td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
            <p class="text-right"><span class="btn btn-sm btn-danger btn__delete-category" style="margin-left: 20px;">Delete</span></p>
        </div>
        <div class="row m-0">
            <div class="col-10">
                <?= $pager->links('post_category', 'admin_pagination') ?>
            </div>
        </div>
        <form action="<?= base_url().'/post_category/delete_category'; ?>" method="post"
              class="list_group_id">
            <?= csrf_field() ?>
            <input type="hidden" name="list_category_id" id="listGroupPostCategoryId">
        </form>
    </div>
<?= $this->endSection() ?>