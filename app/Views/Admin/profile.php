<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="row">
        <div class="card" style="    margin: 0 auto;
    width: 500px;">
            <div class="card-header">
                Thông tin Admin
            </div>

            <form action="<?= base_url('admin/changePassword') ?>" method="post">
            <div class="card-body">
                <h5 class="card-title"><?= $admin['full_name'] ?></h5>
                <p class="card-text" >Email : <span style="color: green"><?= $admin['admin_email'] ?></span></p>
                <p class="card-text" >Password : <span style="color: green">********</span>
                    <span class="float-right text-decoration-none js__reset-password" style="cursor: pointer;padding: 0px 8px;border-radius: 25px;background-color:#cccccc;color: blue; height: 40px; vertical-align: middle;"><a class="nav-link">Reset mật khẩu</a></span>

                </p>

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
        $('body').delegate('.js__show','click',function (){
            $(this).hide();
            $('.js__hide').show();
            $(".passwordAdmin").prop("type", "text");
        })
        /* show hide password */
        $('body').delegate('.js__hide','click',function (){
            $(this).hide();
            $('.js__show').show();
            $(".passwordAdmin").prop("type", "password");
        })
    </script>
<?= $this->endSection() ?>