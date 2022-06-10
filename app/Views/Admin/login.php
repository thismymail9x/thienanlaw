<?= $this->extend("Layouts/LoginLayout") ?>
<?= $this->section("content_login") ?>
<div class="panel-body">
	<h4 class="text-center" style="margin-bottom: 25px;">ĐĂNG NHẬP</h4>
	<form action="<?= base_url().'/login' ?>" class="form-horizontal" style="margin-bottom: 0px !important;" method="post">
        <?= csrf_field() ?>
		<?php if(@$msg) {?>
		<label><span style="font-family: 'Time New Roman'; font-size: 11px; font-style: italic; color: red; height:30px; padding-bottom: 10px;">
					<?= @$msg; ?></span>
		</label>
		<?php } ?>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-user"></i></span>
					<input type="email" class="form-control" id="adminEmail" name="adminEmail" placeholder="Địa chỉ email" value="<?php if (isset($_COOKIE['admin_email'])) { echo $_COOKIE['admin_email'];} else { echo @$adminObj['admin_password'];} ?>">
				</div>
				<?php if(isset($errors['admin_mail'])) {?>
				<label for="adminEmail"><span style="font-family: 'Time New Roman'; font-size: 11px; font-style: italic; color: red;">
					<?php print_r($errors['admin_email']); ?></span></label>
				<?php } ?>
			</div>
		</div>
		<div class="form-group">
			<div class="col-sm-12">
				<div class="input-group">
					<span class="input-group-addon"><i class="fa fa-lock"></i></span>
					<input type="password" class="form-control" id="adminPassword" name="adminPassword" placeholder="Mật khẩu" value="<?php if (isset($_COOKIE['admin_password'])) { echo $_COOKIE['admin_password'];} else { echo @$adminObj['admin_password'];} ?>">
				</div>
				<?php if(isset($errors['admin_password'])) {?>
				<label for="adminPassword"><span style="font-family: 'Time New Roman'; font-size: 11px; font-style: italic; color: red;"><?php print_r($errors['admin_password']); ?></span></label></span></label>
				<?php } ?>
			</div>
		</div>
		<div class="clearfix">
			<div class="pull-right"><label><input type="checkbox" <?php if (isset($_COOKIE['admin_password'])) { echo 'checked';} ?> style="margin-bottom: 20px" name="rememberMe"> Nhớ mật khẩu</label></div>
		</div>
	</form>
</div>
<div class="panel-footer">
	<div class="pull-right">
		<a href="#" onclick="document.getElementById('adminPassword').value='';document.getElementById('adminEmail').value=''" class="btn btn-default">Nhập lại</a>
		<a href="#" onclick="document.forms[0].submit();return false;" class="btn btn-primary">Đăng nhập</a>
	</div>
</div>
<?= $this->endSection() ?>