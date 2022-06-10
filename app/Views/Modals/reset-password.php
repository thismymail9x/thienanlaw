<div class="modal fade" id="resetPasswordModal" tabindex="-1" role="dialog" aria-labelledby="titleLogoutLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="titleLogoutLabel">Xác nhận reset mật khẩu</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">Chọn "Xác nhận" bên dưới nếu bạn muốn reset mật khẩu</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">Hủy</button>
                <a class="btn btn-primary" href="<?= base_url('admin/reset-pass') ?>">Xác nhận</a>
            </div>
        </div>
    </div>
</div>