<?php
session_start();
define('LIBRARIES','../libraries/');
define('SOURCES','./sources/');
define('TEMPLATE','./templates/');
define('LAYOUT','layout/');
define('THUMBS','../thumbs');
define('WATERMARK','../watermark');

require_once LIBRARIES."config.php";
require_once LIBRARIES.'autoload.php';
new AutoLoad();
$d = new PDODb($config['database']);
$seo = new Seo($d);
$emailer = new Email($d);
$func = new Functions($d);
$tele = new Telegram($d);
$cache = new FileCache($d);	

/* Check HTTP */
$func->checkHTTP($http,$config['arrayDomainSSL'],$config_base,$config_url);

/* Config type */
require_once LIBRARIES."config-type.php";

/* Lang Init */
require_once LIBRARIES."lang/langinit.php";

/* Setting */
$setting = $d->rawQueryOne("select * from #_setting limit 0,1");
$optsetting = (isset($setting['options']) && $setting['options'] != '') ? json_decode($setting['options'],true) : null;

/* Requick */
require_once LIBRARIES."requick.php";
if(isset($_GET['elfinder'])){ require_once "elfinder/php/connector.minimal.php"; exit; } 
?>
<!DOCTYPE html>
<html lang="vi">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	
	<!-- Favicon -->
	<link href="../admin/assets/images/logo-admintrator.png" rel="shortcut icon" type="image/x-icon" />

	<title>Administrator - <?=$setting["ten".$config['website']['lang-default']]?></title>

	<!-- CSS -->
	<link href="../assets/fontawesome512/all-admin.css" rel="stylesheet">
	<link href="../assets/css/animate.min.css" rel="stylesheet">
	<link href="assets/sweetalert2/sweetalert2.css" rel="stylesheet">
	<link href="../assets/select2/select2.css" rel="stylesheet">
	<link href="../assets/sumoselect/sumoselect.css" rel="stylesheet">
	<link href="assets/datetimepicker/jquery.datetimepicker.css" rel="stylesheet">
	<link href="assets/daterangepicker/daterangepicker.css" rel="stylesheet">
	<link href="assets/rangeSlider/ion.rangeSlider.css" rel="stylesheet">
	<link href="assets/filer/jquery.filer.css" rel="stylesheet">
	<link href="assets/filer/jquery.filer-dragdropbox-theme.css" rel="stylesheet">
	<link href="assets/holdon/HoldOn.css" rel="stylesheet">
	<link href="assets/css/adminlte.css" rel="stylesheet">
	<link href="assets/css/adminlte-style.css" rel="stylesheet">
	<link href="assets/css/adminlte-edit.css" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

	<!-- JS -->
	<script src="assets/js/jquery.min.js"></script>
	<script src="assets/js/moment.min.js"></script>
	<script src="assets/sweetalert2/sweetalert2.js"></script>
	<script src="../assets/select2/select2.full.js"></script>
	<script src="../assets/sumoselect/jquery.sumoselect.js"></script>
	<script src="assets/datetimepicker/php-date-formatter.min.js"></script>
	<script src="assets/datetimepicker/jquery.mousewheel.js"></script>
	<script src="assets/datetimepicker/jquery.datetimepicker.js"></script>
	<script src="assets/daterangepicker/daterangepicker.js"></script>
	<script src="assets/rangeSlider/ion.rangeSlider.js"></script>
	<script src="../assets/js/priceFormat.js"></script>
	<script src="assets/jscolor/jscolor.js"></script>
	<script src="assets/filer/jquery.filer.js"></script>
	<script src="assets/holdon/HoldOn.js"></script>
	<script src="assets/sortable/Sortable.js"></script>
	<script src="assets/js/bootstrap.bundle.js"></script>
	<script src="assets/js/template.js"></script>
	<script src="assets/js/adminlte.js"></script>
	<script src="../assets/tinymce/js/tinymce/tinymce.min.js" referrerpolicy="origin"></script>
</head>
<body class="sidebar-mini hold-transition text-sm <?=(!isset($_SESSION[$login_admin]['active']) || $_SESSION[$login_admin]['active']==false)?'login-page':''?>">
	<?php if($template == 'index' || $template == 'user/login') include TEMPLATE.LAYOUT."loader.php"; ?>
	<!-- Wrapper -->
	<?php if(isset($_SESSION[$login_admin]['active']) && ($_SESSION[$login_admin]['active'] == true)) { ?>
		<div class="wrapper">
			<?php
			include TEMPLATE.LAYOUT."header.php";
			include TEMPLATE.LAYOUT."menu.php";
			?>
			<div class="content-wrapper">
				<?php if($alertlogin) { ?>
					<section class="content">
						<div class="container-fluid">
							<div class="alert my-alert alert-warning alert-dismissible text-sm bg-gradient-warning mt-3 mb-0">
								<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
								<i class="icon fas fa-exclamation-triangle"></i> <?=$alertlogin?>
							</div>
						</div>
					</section>
				<?php } ?>
				<?php include TEMPLATE.$template."_tpl.php"; ?>
			</div>
			<?php include TEMPLATE.LAYOUT."footer.php"; ?>
		
			<?php include "assets/js/myscript.php"; ?>
			<script src="assets/js/myscript.js"></script>
		</div>
		
	<?php } else { include TEMPLATE."user/login_tpl.php" ; } ?>
</body>
</html>
