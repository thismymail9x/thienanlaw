<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Hostingviet.vn</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Hostingviet.vn">
	<meta name="author" content="Hostingviet.vn">
    <link rel="stylesheet" href="<?= BASE_URL_GLOBAL ?>/public/css/styles.css">
</head>
<body class="focusedform">
<div class="verticalcenter">
	<div style="font-family: 'Arial'; font-size: 30px; font-weight: bold; width: 100%; height: 70px; padding-bottom: 10px; text-align: center;">
		<a href="#">
			<span style="">INTOVPN.NET</span>
		</a>
	</div>
	<div class="panel panel-primary">
        <!-- Using CSRF configuration -->
        <input type="hidden" name="<?= csrf_token() ?>" value="<?= csrf_hash() ?>" class="___csrfname" />
		<?= $this->renderSection("content_login") ?>
	</div>
 </div>
</body>
<script type="text/javascript">
    /*Using for csrf prevent*/
    var csrfName = $('.___csrfname').attr('name'); // CSRF Token name
    var csrfHash = $('.___csrfname').val(); // CSRF hash
    /*end*/
</script>
</html>