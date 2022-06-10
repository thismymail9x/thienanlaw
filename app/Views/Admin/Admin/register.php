<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <form action="<?= base_url('admins/register') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('admin?for_menu=1') ?>"
                               class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2 js__btn-submit">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="form-group col-md-4">
                        <label>Email<span style="color: red;">(*)</span></label>
                        <input autocomplete="off" value="<?= @$admin['admin_email']?>" name="admin_email" required type="email" class="form-control" id="inputEmail" placeholder="Email">
                        <?php if (isset($errors['admin_email'])) { ?>
                            <label for=""><span
                                    style="color: red; font-style: italic;"><?php print_r($errors['admin_email']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKey">Mật khẩu<span style="color: red;">(*)</span> <span style="margin-left: 180px;padding: 6px;cursor: pointer" class="btn-secondary js__random-password">Tạo random</span></label>
                        <input autocomplete="off" value="<?= @$admin['admin_password']?>" name="admin_password" required type="password" class="form-control" id="inputPassword" placeholder="Tối thiểu 6 kí tự">

                        <?php if (isset($errors['admin_password'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['admin_password']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKey">Quyền<span style="color: red;">(*)</span></label>
                        <select required name="admin_role" id="admin_role" class="form-control"
                                aria-label=""
                                aria-describedby="span-1">
                            <option value="" disabled selected>Chọn</option>
                            <?php if (@ADMIN_ROLES) { ?>
                                <?php foreach (ADMIN_ROLES as $key => $value) { ?>
                                    <?php if ($key == @$admin['admin_role']) { ?>
                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                        <?php if (isset($errors['admin_role'])) { ?>
                            <label for=""><span
                                    style="color: red; font-style: italic;"><?php print_r($errors['admin_role']); ?></span></label>
                        <?php } ?>
                    </div>
                </div>
                    <div class="form-row">
                    <div class="form-group col-md-4">
                        <label for="inputKey">Họ tên</label>

                        <input autocomplete="off" value="<?= @$admin['full_name']?>" name="full_name" required type="search" class="form-control" id="inputFullName" placeholder="Họ tên">

                        <?php if (isset($errors['full_name'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['full_name']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKey">Số điện thoại</label>
                        <input value="<?= @$admin['full_name']?>" autocomplete="off" name="phone_number" required type="search" class="form-control" id="inputPhoneNumber" placeholder="Số điện thoại">
                        <?php if (isset($errors['phone_number'])) { ?>
                            <label for=""><span
                                        style="color: red; font-style: italic;"><?php print_r($errors['phone_number']); ?></span></label>
                        <?php } ?>
                    </div>
                    <div class="form-group col-md-4">
                        <label for="inputKey">Kích hoạt</label>
                        <select required name="active" id="active" class="form-control"
                                aria-label=""
                                aria-describedby="span-1">
                            <?php if (@ADMIN_ACTIVE) { ?>
                                <?php foreach (ADMIN_ACTIVE as $key => $value) { ?>
                                    <?php if ($key == @$admin['active']) { ?>
                                        <option value="<?php echo $key; ?>" selected><?php echo $value; ?></option>
                                    <?php } else { ?>
                                        <option value="<?php echo $key; ?>"><?php echo $value; ?></option>
                                    <?php }
                                }
                            } ?>
                        </select>
                    </div>
                    </div>

            </div>
        </form>
       
    </div>

<?= $this->endSection() ?>