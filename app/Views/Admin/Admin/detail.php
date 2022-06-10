<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card-header py-2">
        <table style="width: 100%;">
            <tr>
                <td style="width: 400px;">
                    <h6 class="m-0 font-weight-bold text-primary">Chi tiết thông tin Admin</h6>
                </td>
                <td style="width: auto; text-align: right;">
                    <a href="<?= base_url('admins?for_menu=1') ?>" class="btn btn-sm btn-dark mb-2">Danh sách</a>
                    <a href="<?= base_url('admins/edit/' . @$admin['admin_id']) ?>"
                       class="btn btn-sm btn-success mb-2">Sửa</a>
                </td>
            </tr>
        </table>
    </div>
<div class="row">
    <div class="card" style="margin: 0 auto;
    width: 500px;">
        <div class="card-header d-flex">
            Thông tin Admin <span data-id="<?= $admin['admin_id']?>" class="ml-auto btn btn-success btn-sm js__change-password">Đổi mật khẩu</span>
        </div>

        <form action="<?= base_url('admin/changePassword') ?>" method="post">
            <div class="card-body">
                <h5 class="card-title"><?= $admin['full_name'] ?></h5>
                <p class="card-text" >Email : <span style="color: green"><?= $admin['admin_email'] ?></span></p>
                <p class="card-text" >Password : <span style="color: green">********</span>

                </p>
                <p class="card-text" >Quyền : <span style="color: red"><?php if (@ADMIN_ROLES) {
                            foreach (ADMIN_ROLES as $k => $v) {
                                if ($k == $admin['admin_role']) {
                                    echo $v;
                                    break;
                                }
                            }
                        }
                        ?></span>
                </p>
                <p class="card-text" >Trạng thái : <span style="color: red"><?php if (@ADMIN_ACTIVE) {
                            foreach (ADMIN_ACTIVE as $ke => $va) {
                                if ($ke == $admin['active']) {
                                    echo $va;
                                    break;
                                }
                            }
                        } ?></span>
                <p class="card-text" >Phone : <span style="color: green"><?= $admin['phone_number'] ?></span>
                </p>
                <p class="card-text" >Ngày tham gia : <span style="color: green"><?= date('d-m-Y',strtotime($admin['created_at'])) ?></span>
                </p>
            </div>
        </form>
    </div>

</div>

<script type="text/javascript">


    /* show hide password */
    $('body').delegate('.js__show-password','click',function (){
        $(this).hide();
        $('.js__show').show();
        $(".passwordAdmin").prop("type", "password");
    })
</script>
<?= $this->endSection() ?>