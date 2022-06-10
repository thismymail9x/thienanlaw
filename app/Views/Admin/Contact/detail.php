<?= $this->extend("Layouts/AdminLayout") ?>
<?= $this->section("admin_main") ?>
    <div class="card shadow mb-4">
        <div class="card-header py-2">
            <table style="width: 100%;">
                <tr>
                    <td style="width: 400px;">
                        <h6 class="m-0 font-weight-bold text-primary">Chi tiết thông tin khách hàng liên hệ</h6>
                    </td>
                    <td style="width: auto; text-align: right;">
                        <a href="<?= base_url('contact-user?for_menu=1') ?>" class="btn btn-sm btn-dark mb-2">Danh sách</a>
                    </td>
                </tr>
            </table>
        </div>
        <div class="card-body">

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                        <span class="input-group-text" id="span-4" style="width: 200px;">Trạng thái <span
                                    style="color: red;">(*)</span></span>
                </div>
                <div class="col-xs-4" style="width: 200px">
                    <select disabled name="service_status" id="service_status" class="form-control"
                            aria-label="status_en"
                            aria-describedby="span-4">
                        <option value="" disabled selected>---Chọn Trạng thái---</option>
                        <?php if (@CONTACT_STATUS) { ?>
                            <?php if (isset(CONTACT_STATUS[@$contact['status']]) ) { ?>
                                <option selected ><?php echo CONTACT_STATUS[@$contact['status']]; ?></option>
                            <?php }
                        } ?>
                    </select>
                </div>
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Tiêu đề </span>
                </div>
                <input disabled type="text" class="form-control" name="service_name_en" id="service_name_en"
                       placeholder="" value="<?= @$contact['title'] ?>"
                       aria-label="contact title" aria-describedby="span-5">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Nội dung</span>
                </div>
                <textarea class="form-control" name="" id="" cols="30" rows="10"><?= @$contact['content'] ?></textarea>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Họ tên </span>
                </div>
                <input disabled type="text" class="form-control"
                       placeholder="" value="<?= @$contact['full_name'] ?>"
                       aria-label="contact title" aria-describedby="span-5">
            </div>

            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Email </span>
                </div>
                <input disabled type="text" class="form-control"
                       placeholder="" value="<?= @$contact['email'] ?>"
                       aria-label="contact title" aria-describedby="span-5">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="span-5" style="width: 200px;">Số điện thoại </span>
                </div>
                <input disabled type="text" class="form-control"
                       placeholder="" value="<?= @$contact['phone'] ?>"
                       aria-label="contact title" aria-describedby="span-5">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Chức vụ </span>
                </div>
                <input disabled type="text" class="form-control"
                       placeholder="" value="<?= @$contact['roles'] ?>"
                       aria-label="contact title" aria-describedby="span-5">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Địa chỉ </span>
                </div>
                <input disabled type="text" class="form-control"
                       placeholder="" value="<?= @$contact['address'] ?>"
                       aria-label="contact title" aria-describedby="span-5">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Công ty </span>
                </div>
                <input disabled type="text" class="form-control"
                       placeholder="" value="<?= @$contact['company'] ?>"
                       aria-label="contact title" aria-describedby="span-5">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">Quốc gia </span>
                </div>
                <input disabled type="text" class="form-control"
                       placeholder="" value="<?= @$region['name'] ?>"
                       aria-label="contact title" aria-describedby="span-5">
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                                <span class="input-group-text" id="span-5" style="width: 200px;">File đính kèm </span>
                </div>
                <p class="form-control"><a title="<?= $contact['attachment']; ?>" class="limit-text-1" style="text-decoration: none" href="<?= base_url().'/contact-user/download-file?filename='. $contact['attachment']?>"><?= $contact['attachment']; ?></a>
                </p>
            </div>
        </div>
    </div>
    <style>
        .custom-mail {
            border: 1px solid #d1d3e2;
            width: 100%;
            border-radius: 0 5px 5px 0;
            padding: 10px 15px;
            background: #EAECF4;
        }
        textarea,p {
            background-color: #eaecf4!important;
            border: 1px solid #d1d3e2;
        }
    </style>
<?= $this->endSection() ?>