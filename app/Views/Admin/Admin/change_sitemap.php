<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <form action="<?= base_url('/admins/change_sitemap') ?>" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="card-header py-2">
                <table style="width: 100%;">
                    <tr>
                        <td style="width: auto;">
                            <h6 class="m-0 font-weight-bold text-primary"><?php echo @$title_page; ?></h6>
                        </td>
                        <td style="width: auto; text-align: right;">
                            <a href="<?= base_url('/dashboard') ?>"
                               class="btn btn btn-info btn-sm btn-dark mb-2">Hủy</a>
                            <button type="submit" class="btn btn-info btn-sm btn-success mb-2 js__btn-submit">Đồng ý</button>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="card-body">
                <div class="form-row">
                    <div class="custom-file mb-3">
                        <input type="file" accept="text/xml" name="file" required>
                    </div>
                </div>
            </div>
        </form>
    </div>

<?= $this->endSection() ?>