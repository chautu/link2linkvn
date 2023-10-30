<?php
if(!defined('LIBRARIES')) die("Error");

/* Root */
define('ROOT',__DIR__);

/* Timezone */
date_default_timezone_set('Asia/Ho_Chi_Minh');

/* Cấu hình coder */
define('VNS_MSHD','MSHD');

/* Cấu hình chung */
$config = array(
	'author' => array(
		'name' => '',
		'email' => '',
		'timefinish' => '03/2022'
	),
	'arrayDomainSSL' => array(""),
	'database' => array(
		'server-name' => $_SERVER["SERVER_NAME"],
		'url' => '/chineasy/',
		'type' => 'mysql',
		'host' => 'localhost',
		'username' => 'root',
		'password' => '',
		'dbname' => 'nguyennhieu',
		'port' => 3306,
		'prefix' => 'table_',
		'charset' => 'utf8mb4'
	),
	'website' => array(
		'error-reporting' => true,
		'secret' => '$vina@',
		'salt' => '@#$fd_!34^',
		'default_pass' => '123qwe',
		'default_md5' => '3e996cd5598fcdbf639b2f1567d0fb95',
		'debug-developer' => false,
		'debug-developer-mailhost' => false,
		'debug-css' => true,
		'debug-js' => true,
		'index' => true,
		'upload' => array(
			'max-width' => 3960,
			'max-height' => 2560
		),
		'lang' => array(
			'vi'=>'Tiếng Việt',
			// 'ha'=>'Tiếng Hà Lan',
			// 'cn'=>'Tiếng Trung'
		),
		'lang-default' => 'vi',
		'lang-doc' => 'vi',
		'slug' => array(
			'vi'=>'Tiếng Việt',
			// 'en'=>'Tiếng Anh'
		),
		'seo' => array(
			'vi'=>'Tiếng Việt',
			// 'en'=>'Tiếng Anh'
		),
		'comlang' => array(
			"gioi-thieu" => array("vi"=>"gioi-thieu"),
			"san-pham" => array("vi"=>"san-pham"),
			"tin-tuc" => array("vi"=>"tin-tuc"),
			"thu-vien-anh" => array("vi"=>"thu-vien-anh"),
			"video" => array("vi"=>"video"),
			"lien-he" => array("vi"=>"lien-he")
		)
	),
	'googleAPI' => array(
		'recaptcha' => array(
			'active' => false,
			'urlapi' => 'https://www.google.com/recaptcha/api/siteverify',
			'sitekey' => '6LfxII0oAAAAAGBtJ3GWQGid8bRIDbY2UdxZMCNV',
			'secretkey' => '6LfxII0oAAAAAKzjbFALgF7Ls9R1Y2ckYstpBv44'
		)
	),
	'cart' => array(
		'active' => true,
	),
	'order' => array(
		'ship' => false,
		'coupons' => true,
	),
	'oneSignal' => array(
		'active' => false,
		'id' => 'af12ae0e-cfb7-41d0-91d8-8997fca889f8',
		'restId' => 'MWFmZGVhMzYtY2U0Zi00MjA0LTg0ODEtZWFkZTZlNmM1MDg4'
	),
	'login' => array(
		'active' => true,
		'admin' => 'LoginAdmin'.VNS_MSHD,
		'member' => 'LoginMember'.VNS_MSHD,
		'attempt' => 5,
		'delay' => 15
	),
	'google' => array(
		'secret_google' => '',
		'client_id_google' => ''
	),
	'facebook' => array(
		'secret_facebook' => '',
		'client_id_facebook' => ''
	),
	'member' => array(
		'naptien' => true,
		'ruttien' => true,
		'lichsugiaodich' => true,
		'trangcanhan' => true,
		'lichsuorder' => true,
		'diachi' => true,
		'nganhang' => true
	),
	'license' => array(
		'version' => "7.0.0",
		'powered' => ""
	),
	'vnpay' => array(
		'vnp_TmnCode' => "KS7N75A1",
		'vnp_HashSecret' => "GCHVOFQXXVRSQFPNEULQQOLDTIYHDZPA",
		'vnp_Url' => 'https://sandbox.vnpayment.vn/paymentv2/vpcpay.html',
		'vnp_apiUrl'	=> 'http://sandbox.vnpayment.vn/merchant_webapi/merchant.html',
		'apiUrl'	=> 'https://sandbox.vnpayment.vn/merchant_webapi/api/transaction'
	),
	'telegram' => array(
		'active' => false,
		'token' => '6337058368:AAFJHAfQCW8fURoDwF4xmPk004AAbtLd4G8'
	),
);

/* Error reporting */
error_reporting(($config['website']['error-reporting']) ? E_ALL : 0);

/* Cấu hình base */
//require_once LIBRARIES."checkSSL.php";
//$http = getProtocol();
$http = 'http://';
$config_url = $config['database']['server-name'].$config['database']['url'];
$config_base = $http.$config_url;

/* Cấu hình login */
$login_admin = $config['login']['admin'];
$login_member = $config['login']['member'];

/* Cấu hình upload */
require_once LIBRARIES."constant.php";
?>