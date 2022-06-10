<div class="modal fade" id="changePasswordModal" tabindex="-1" role="dialog" aria-labelledby="titleLogoutLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="post" action="<?php echo base_url('admins/change_pass') ?>">
                <?= csrf_field() ?>
                <input type="hidden" id="jsAdminId" name="admin_id" value="<?= @session('admin_id')?>">
            <div class="modal-header">
                <h5 class="modal-title" id="titleLogoutLabel">Thay đổi mật khẩu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="form-group row">
                    <span style="margin-right: 12px; margin-left: auto; padding: 6px; cursor: pointer;" class="btn-secondary js__random-password">Tạo random</span>
                </div>

                    <div class="form-group row">
                        <label for="inputPasswordNew" class="col-sm-5 ">Mật khẩu</label>
                        <div class="col-sm-7">
                            <input name="admin_password" required type="password" class="form-control" id="inputPassword" placeholder="Tối thiểu 6 kí tự...">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="inputPasswordConfirm" class="col-sm-5 ">Xác nhận mật khẩu mới</label>
                        <div class="col-sm-7">
                            <input name="admin_password_confirm" type="text" class="form-control" id="inputPasswordConfirm">
                        </div>
                    </div>

            </div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                <button type="submit" class="btn btn-primary">Lưu</button>
            </div>
            </form>
        </div>
    </div>
</div>