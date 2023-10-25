<?php
if(!defined('SOURCES')) die("Error");

$action = isset($match['params']['action']) ? htmlspecialchars($match['params']['action']) : '';

switch($action)
{
	case 'dang-nhap':
	$title_crumb = login;
	$template = "account/capnhat";
	if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_POST['login'])) login();
	break;

	case 'dang-ky':
	$title_crumb = register;
	$template = "account/capnhat";
	if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_POST['register'])) signup();
	break;

	case 'quen-mat-khau':
	$title_crumb = 	forgotpassword;
	$template = "account/capnhat";
	if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_POST['quenmatkhau'])) doimatkhau_user();
	break;

	case 'kich-hoat':
	$title_crumb = active;
	$template = "account/capnhat";
	$template = "account/kichhoat";
	if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_POST['kichhoat'])) active_user();
	break;

	case '':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/timeline";
	$title_crumb = timeline;
	timeline();
	break;

	case 'photo':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/photo";
	$title_crumb = 	picture;
	picture();
	break;

	case 'video':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/video";
	$title_crumb = 	video;
	video();
	break;

	case 'doi-mat-khau':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/dmk";
	$title_crumb = changepassword;
	doi_mat_khau();
	break;

	case 'cap-nhat-tai-khoan':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	$template = "account/capnhat";
	$title_crumb = updateprofile;
	capnhat();
	break;

	case 'dia-chi':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/diachi";
	$title_crumb = address;
	diachi();
	break;

	case 'ngan-hang':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/nganhang";
	$title_crumb = bank;
	nganhang();
	break;

	case 'lich-su-giao-dich':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/lichsugiaodich";
	$title_crumb = historytransition;
	lichsugiaodich();
	break;

	case 'hoa-don':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	if(isset($_GET['id'])) {
		$template = "account/hoadonchitiet";
	} else {
		$template = "account/hoadon";
	}
	$title_crumb = order;
	hoadon();
	break;

	case 'nap-tien':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/naptien";
	$title_crumb = recharge;
	naptien();
	break;

	case 'return-vnpay':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$title_crumb = returnrecharge;
	return_vnpay();
	break;

	case 'rut-tien':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	if(isset($_SESSION[$login_member]['capnhat']) && $_SESSION[$login_member]['capnhat'] == 0) $func->transferUser(updateprofiletocoutinue,'account/cap-nhat-tai-khoan', false);
	$template = "account/ruttien";
	$title_crumb = withdraw;
	ruttien();
	break;

	case 'login-facebook':
	login_facebook();
	break;

	case 'login-google':
	login_google();
	break;

	case 'dang-xuat':
	if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) $func->transferUser(pagenotfound,$config_base, false);
	logout();
	
	default:
	header('HTTP/1.0 404 Not Found', true, 404);
	include("404.php");
	exit();
}

/* SEO */
$seo->setSeo('title',$title_crumb);

/* breadCrumbs */
if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs('',$title_crumb);
$breadcrumbs = $breadcr->getBreadCrumbs();

function login_facebook()
{
	global $d, $func, $config_base, $get_page, $per_page, $login_member, $optsetting;
	if (isset($_GET['code'])) {
		
		$secret = $config['facebook']['secret_facebook'];
		$client_id = $config['facebook']['client_id_facebook'];
		$redirect_url = $config_base.'account/login-facebook';
		$code = $_GET['code'];

		$url = "https://graph.facebook.com/v12.0/oauth/access_token?client_id=$client_id&redirect_uri=$redirect_url&client_secret=$secret&code=$code";
		$call = curl_init();
		curl_setopt($call, CURLOPT_URL, $url);
		curl_setopt($call, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($call, CURLOPT_SSL_VERIFYPEER, false);
		$response = curl_exec($call);
		$response = json_decode($response);
		$response = $response->access_token;
		curl_close($call);
		
		$url_get_info_user = 'https://graph.facebook.com/me?fields=id,name,link,gender,email,picture&access_token=' . $response;
		$call = curl_init();
		curl_setopt($call, CURLOPT_URL, $url_get_info_user);
		curl_setopt($call, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($call, CURLOPT_SSL_VERIFYPEER, false);
		$user_info = curl_exec($call);
		curl_close($call);

		$user_info = json_decode($user_info);

		$check = $d->rawQueryOne("select * from #_member where username = ?", array($user_info->id));
		
		if(!empty($check)) {
			$id_user = $check['id'];
			$lastlogin = time();
			$login_session = md5($check['password'] . $lastlogin);
			$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));
			/* Lưu session login */
			$_SESSION[$login_member]['active'] = true;
			$_SESSION[$login_member]['id'] = $check['id'];
			$_SESSION[$login_member]['username'] = $check['username'];
			$_SESSION[$login_member]['dienthoai'] = $check['dienthoai'];
			$_SESSION[$login_member]['capnhat'] = $check['capnhat'];
			$_SESSION[$login_member]['email'] = $check['email'];
			$_SESSION[$login_member]['role'] = $check['role'];
			$_SESSION[$login_member]['login_session'] = $login_session;

			$avatar = "https://graph.facebook.com/".$user_info->id."/picture?type=large";
			$name = $user_info->id.'_'.time();
			$filename = 'upload/user/' . $name . '.jpg';
			if (file_exists('upload/user/'.$check['avatar'])) {
				unlink('upload/user/'.$check['avatar']);
			}

			$datapic = file_get_contents($avatar);
			file_put_contents($filename, $datapic);

			$data_user['avatar'] = $name . '.jpg';
			$d->where('id', $check['id']);
			$d->update("member", $data_user);

			$func->transferUser(reponselogins, $config_base.'account');
		}else {
			$data_user['ten'] = $user_info->name;
			$data_user['username'] = $user_info->id;
			$data_user['password'] = md5($user_info->id);	
			$data_user['email'] = $user_info->email;
			$data_user['link_facebook'] = $user_info->link;
			$data_user['gioitinh'] = $user_info->gender;
			$data_user['hienthi'] = 1;

			$avatar = "https://graph.facebook.com/".$user_info->id."/picture?type=large";
			$name = $user_info->id.'_'.time();
			$filename = 'upload/user/' . $name . '.jpg';
			if (file_exists($filename)) {
				unlink($filename);
			}

			$datapic = file_get_contents($avatar);
			file_put_contents($filename, $datapic);
		
			$data_user['avatar'] = $user_info->id . '.jpg';

			if($d->insert('member', $data_user)) {
				$row = $d->rawQueryOne("select * from #_member where username = ?", array($user_info->id));
				$id_user = $row['id'];
				$lastlogin = time();
				$login_session = md5($row['password'] . $lastlogin);
				$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));
	
				/* Lưu session login */
				$_SESSION[$login_member]['active'] = true;
				$_SESSION[$login_member]['id'] = $row['id'];
				$_SESSION[$login_member]['username'] = $row['username'];
				$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
				$_SESSION[$login_member]['capnhat'] = $row['capnhat'];
				$_SESSION[$login_member]['email'] = $row['email'];
				$_SESSION[$login_member]['role'] = $row['role'];
				$_SESSION[$login_member]['login_session'] = $login_session;
				
				$func->transferUser(reponselogins, $config_base.'account');
			} else {
				$func->transferUser(responseloginf, $config_base, false);
			}
		}
		
	}
}
function login_google()
{
	global $d, $func, $config_base, $get_page, $per_page, $login_member, $optsetting;
	
	if (isset($_GET['code'])) {
		$secret = $config['google']['secret_google'];
		$client_id = $config['google']['client_id_google'];
		$redirect_url = $config_base.'account/login-google';
		$code = $_GET['code'];

		$url = 'https://www.googleapis.com/oauth2/v4/token';
		$data = [
			'code'  => $code,
			'client_id' => $client_id,
			'client_secret' => $secret,
			
			'redirect_uri' => $redirect_url,
			'grant_type' => 'authorization_code'
		];
		$data_string = http_build_query($data);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, true);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($ch);
		$response = json_decode($response);
		$token = $response->access_token;
		curl_close($ch);

		$url_token = 'https://www.googleapis.com/oauth2/v3/userinfo?alt=json&access_token';
		$url_get_info_user = $url_token . "=$token";
		$call = curl_init();
		curl_setopt($call, CURLOPT_URL, $url_get_info_user);
		curl_setopt($call, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($call, CURLOPT_RETURNTRANSFER, 1);

		$user_info = curl_exec($call);
		curl_close($call);
		$user_info = json_decode($user_info);

		$check = $d->rawQueryOne("select * from #_member where username = ?", array($user_info->sub));		
		
		
		if(!empty($check) && $check['id']) {
			$id_user = $check['id'];
			$lastlogin = time();
			$login_session = md5($check['password'] . $lastlogin);
			$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));
			/* Lưu session login */
			$_SESSION[$login_member]['active'] = true;
			$_SESSION[$login_member]['id'] = $check['id'];
			$_SESSION[$login_member]['username'] = $check['username'];
			$_SESSION[$login_member]['dienthoai'] = $check['dienthoai'];
			$_SESSION[$login_member]['email'] = $check['email'];
			$_SESSION[$login_member]['role'] = $check['role'];
			$_SESSION[$login_member]['capnhat'] = $check['capnhat'];
			$_SESSION[$login_member]['login_session'] = $login_session;

			$func->transferUser(dangnhapthanhcong, $config_base.'account/thong-tin');
		}else {
			$data_user['ten'] = $user_info->name;
			$data_user['username'] = $user_info->sub;
			$data_user['password'] = md5($user_info->sub);	
			$data_user['email'] = $user_info->email;
			$data_user['hienthi'] = 1;

			$avatar = $user_info->picture;
			$filename = 'upload/user/' . $user_info->sub . '.jpg';
			if (file_exists($filename)) {
				unlink($filename);
			}

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_URL, $avatar);
			$datapic = curl_exec($ch);
			curl_close($ch);

			file_put_contents($filename, $datapic);
			// Function to write image into file
			file_put_contents($filename, $datapic);
		
			$data_user['avatar'] = $user_info->sub . '.jpg';

			if($d->insert('member', $data_user)) {
				$row = $d->rawQueryOne("select * from #_member where username = ?", array($user_info->sub));
				$id_user = $row['id'];
				$lastlogin = time();
				$login_session = md5($row['password'] . $lastlogin);
				$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?", array($login_session, $lastlogin, $id_user));
	
				/* Lưu session login */
				$_SESSION[$login_member]['active'] = true;
				$_SESSION[$login_member]['id'] = $row['id'];
				$_SESSION[$login_member]['username'] = $row['username'];
				$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
				$_SESSION[$login_member]['email'] = $row['email'];
				$_SESSION[$login_member]['role'] = $row['role'];
				$_SESSION[$login_member]['capnhat'] = $row['capnhat'];
				$_SESSION[$login_member]['login_session'] = $login_session;
				
				$func->transferUser("Đăng nhập thành công", $config_base.'account');
			} else {
				$func->transferUser(responseloginf, $config_base, false);
			}
		}
	}
}


function hoadon()
{
	global $d, $func, $row_detail, $config_base, $login_member, $lang, $orders, $detail_order,$products;

	$iduser = $_SESSION[$login_member]['id'];
	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : '';
	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));
		$orders = $d->rawQuery("select * from #_order where id_user = ? order by stt, id desc", array($iduser));
		if($id) {
			$detail_order = $d->rawQueryOne("select * from #_order where id = ? and id_user = ?", array($id, $iduser));
			if(empty($detail_order)) {
				$func->transferUser(pagenotfound,$config_base, false);
			}
 			$products = $d->rawQuery("select * from #_order_detail where id_order = ? order by id desc", array($id));
		}
	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function ruttien()
{
	global $d, $func, $row_detail, $config_base, $login_member, $lang, $banks;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));
		$banks = $d->rawQuery("select id, id_bank, chutk, stk, macdinh from #_member_bank where id_member = ? and hienthi > 0 order by stt, id desc", array($iduser));
		if(isset($_POST['savert'])) {
			$data['money'] = (isset($_POST['moneyrut'])) ? htmlspecialchars($_POST['moneyrut']) : '';
			$data['money'] = (isset($data['money']) && $data['money'] != '') ? str_replace(",","",$data['money']) : 0;
			$noidung = (isset($_POST['noidungrut'])) ? htmlspecialchars($_POST['noidungrut']) : '';
			$banknap = (isset($_POST['nganhangrut'])) ? htmlspecialchars($_POST['nganhangrut']) : 0;
			if($data['money'] <= 0) {
				$func->transferUser(invalidmoney, "account/rut-tien", false);
			}
			$data['first_money'] = $row_detail['money'];
			$data['last_money'] = $row_detail['money'] - $data['money'];
			if($data['last_money'] < 0) {
				$func->transferUser(insufficientbalance, "account/rut-tien", false);
			}
			$data['type'] = 1;
			$data['id_member'] = $_SESSION[$login_member]['id'];
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['ghichu'] = $noidung;
			$data['ngaytao'] = time();
			$bankrut = $d->rawQueryOne("select id_bank, chutk, stk from #_member_bank where id = ?", array($banknap));
			$data['bank'] = receivingbank.": ".$func->get_places("news_list", $bankrut['id_bank'])." - ".$bankrut['chutk']." - ".$bankrut['stk'];
			if($d->insert('member_transition',$data)) {
				$id_insert = $d->getLastInsertId();
				$dataLog = [
					"id_transition" => $id_insert,
					"noidung" => $_SESSION[$login_member]['email']." ".createsuccessfultransactions." ".($data['ghichu'] ? note.": ".$data['ghichu']: ""),
					"ngaytao"	=> time()
				];
				$d->insert("user_transition_log", $dataLog);
				
				$data_user['money'] = $row_detail['money'] - $data['money'];
				$d->where('id', $iduser);
				$d->update('member',$data_user);
				
				$func->transferUser(responsewithdraws, "account/lich-su-giao-dich");
			} 
			else $func->transferUser(	responsewithdrawf, "account/rut-tien", false);
		}
	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function return_vnpay()
{
	global $d, $func, $curPage, $login_member, $config, $tele;

	$vnp_SecureHash = $_GET['vnp_SecureHash'];
	$money = htmlspecialchars($_GET['vnp_Amount']);
	$id = htmlspecialchars($_GET['vnp_TxnRef']);
	$responeCode = htmlspecialchars($_GET['vnp_ResponseCode']);

	$check_transition = $func->check_transition_vnpay($vnp_SecureHash, $money, $id, $responeCode, "member_transition");
	$transition = $d->rawQueryOne("select * from #_member_transition where id = ?", array($id));
	$user = $func->get_profile($_SESSION[$login_member]['id'], "member");

	if ($check_transition == 00) {
		$func->transferUser(Invalidsignature, "account", false);
	} elseif ($check_transition == 01) {
		$func->transferUser(balanceisincorrect, "account", false);
	} elseif ($check_transition == 02) {
		$data_transition = [
			'id_status' => $func->get_status_by_default("status", "id", "access", "transition", $config['website']['lang-default']),
			'ngaysua' => time(),
			'last_money' => $transition['money'] + $user['money'],
			'ghichu'	=> transactioncodevnpay.": ". htmlspecialchars($_GET['vnp_TransactionNo'])
		];
		$d->where('id', $transition['id']);
		if($d->update("member_transition", $data_transition)) {
			$dataLog = [
				'id_transition' => $transition['id'],
				'noidung'	=> $_SESSION[$login_member]['email'].' '.paymentsuccess.'. '.transactioncodevnpay.' '.htmlspecialchars($_GET['vnp_TransactionNo']). '. '.plus.' '.number_format($transition['money']).' '.inaccount,
				'ngaytao'	=> time()
			];
			$d->insert("member_transition_log", $dataLog);
			$dataUser = [
				'money' => $transition['money'] + $user['money'],
			];
			$d->where('id', $user['id']);
			$d->update('member',$dataUser);
			$tele->sendMessage(date("H:i d-m-Y")." ".telepaymentauto." ".number_format($transition['money'])." 🎉");
			$func->transferUser(responseautorecharges, "account/lich-su-giao-dich");
		}
	} else {
		$data_transition = [
			'id_status' => $func->get_status_by_default("status", "id", "cancel", "transition", $config['website']['lang-default']),
			'ngaysua' => time(),
			'last_money' => $transition['first_money'],
			'ghichu'	=> paymenterror
		];
		$d->where('id', $transition['id']);
		if($d->update("member_transition", $data_transition)) {
			$dataLog = [
				'id_transition' => $transition['id'],
				'noidung'	=> $_SESSION[$login_member]['email'].' '.responsepaymenterror,
				'ngaytao'	=> time()
			];
			$d->insert("member_transition_log", $dataLog);
			$func->transferUser(responseautorechargef, "account", false);
		}
	}
}

function naptien()
{
	global $d, $func, $row_detail, $config_base, $login_member, $lang, $banks;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));
		
		$banks = $d->rawQuery("select ten$lang as ten, id from #_news where type=? and hienthi > 0 order by stt,id desc", array("bank"));
		
		if(isset($_POST['save_auto'])) {
			$data['money'] = (isset($_POST['moneyauto'])) ? htmlspecialchars($_POST['moneyauto']) : '';
			$data['money'] = (isset($data['money']) && $data['money'] != '') ? str_replace(",","",$data['money']) : 0;
			if($data['money'] <= 0) {
				$func->transferUser(invalidmoney, "account", false);
			}
			$data['first_money'] = $row_detail['money'];
			$data['type'] = 0;
			$data['last_money'] = $row_detail['money'];
			$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : $func->get_status_by_default("status", "id", "await", "transition", $config['website']['lang-default']);
			$data['id_member'] = $_SESSION[$login_member]['id'];
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['bank'] = rechargeauto;
			$data['ngaytao'] = time();
			if($d->insert('member_transition',$data)) {
				$id_insert = $d->getLastInsertId();
				$dataLog = [
					"id_transition" => $id_insert,
					"noidung" => $_SESSION[$login_admin]['email']." ".createsuccessfultransactions,
					"ngaytao"	=> time()
				];
				$d->insert("member_transition_log", $dataLog);
	
				$func->payment_vnpay($id_insert,$data['money'],$_POST['bankCode'],$config_base."account/return-vnpay");
			} else {
				$func->transferUser(responsewithdrawf, "account", false);
			}
		}
		if(isset($_POST['savetc'])) {
			$data['money'] = (isset($_POST['moneytc'])) ? htmlspecialchars($_POST['moneytc']) : '';
			$data['money'] = (isset($data['money']) && $data['money'] != '') ? str_replace(",","",$data['money']) : 0;
			$noidung = (isset($_POST['noidungtc'])) ? htmlspecialchars($_POST['noidungtc']) : '';
			$banknap = (isset($_POST['id_bank_naptc'])) ? htmlspecialchars($_POST['id_bank_naptc']) : 0;
			$code = (isset($_POST['code'])) ? htmlspecialchars($_POST['code']) : '';
			if($data['money'] <= 0) {
				$func->transferUser(invalidmoney, "account", false);
			}
			$data['first_money'] = $row_detail['money'];
			$data['type'] = 0;
			$data['last_money'] = $row_detail['money'];
			$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : $func->get_status_by_default("status", "id", "await", "transition", $config['website']['lang-default']);
			$data['id_member'] = $_SESSION[$login_member]['id'];
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			$data['bank'] = receivingbank.": ".$func->get_places("news", $banknap);
			$data['bank'] .= ". ".content.": ".$code;
			$data['ghichu'] = $noidung;
			$data['ngaytao'] = time();
			if($d->insert('member_transition',$data)) {
				$id_insert = $d->getLastInsertId();
				$dataLog = [
					"id_transition" => $id_insert,
					"noidung" => $_SESSION[$login_member]['email']." ".createsuccessfultransactions." ".($noidung ? note.": ".$noidung: ""),
					"ngaytao"	=> time()
				];
				$d->insert("member_transition_log", $dataLog);
				$func->transferUser(responsewithdraws, "account/lich-su-giao-dich");
			} 
			else $func->transferUser(responsewithdrawf, "account/nap-tien", false);
		}
	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function lichsugiaodich()
{
	global $d, $func, $row_detail, $config_base, $login_member, $lang, $transitions;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));
		$transitions = $d->rawQuery("select * from #_member_transition where id_member = ? order by stt, id desc", array($iduser));
	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function nganhang()
{
	global $d, $func, $row_detail, $config_base, $login_member, $lang, $banks;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));
		$banks = $d->rawQuery("select * from #_member_bank where id_member = ? order by stt, id desc", array($iduser));

		if(isset($_POST['save'])) {

			$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

			$data['stk'] = (isset($_POST['stk'])) ? htmlspecialchars($_POST['stk']) : '';
			$data['chutk'] = (isset($_POST['chutk'])) ? htmlspecialchars($_POST['chutk']) : '';
			$data['id_bank'] = (isset($_POST['data']['id_bank'])) ? htmlspecialchars($_POST['data']['id_bank']) : '';
			$data['macdinh'] = (isset($_POST['macdinh'])) ? htmlspecialchars($_POST['macdinh']) : 0;
			$data['id_member'] = $_SESSION[$login_member]['id'];

			if($data['macdinh']) {
				$d->rawQuery("update #_member_bank SET macdinh = 0 WHERE id_member = ?", array($_SESSION[$login_member]['id']));
			}			
			if($id) {
				$d->where("id", $id);
				$d->update("member_bank", $data);
				$func->transferUser(responsebanks,$config_base.'account/ngan-hang');
			} else {
				$d->insert('member_bank', $data);
				$func->transferUser(responsebankus,$config_base.'account/ngan-hang');
			}
		}
	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function diachi()
{
	global $d, $func, $row_detail, $config_base, $login_member, $lang, $address;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));
		$address = $d->rawQuery("select * from #_member_address where id_member = ? order by stt, id desc", array($iduser));

		if(isset($_POST['save'])) {

			$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

			$data['ten'] = (isset($_POST['ten-address'])) ? htmlspecialchars($_POST['ten-address']) : '';
			$data['dienthoai'] = (isset($_POST['dienthoai-address'])) ? htmlspecialchars($_POST['dienthoai-address']) : '';
			$data['email'] = (isset($_POST['email-address'])) ? htmlspecialchars($_POST['email-address']) : '';
			$data['id_city'] = (isset($_POST['id_city'])) ? htmlspecialchars($_POST['id_city']) : '';
			$data['id_district'] = (isset($_POST['id_district'])) ? htmlspecialchars($_POST['id_district']) : '';
			$data['id_wards'] = (isset($_POST['id_wards'])) ? htmlspecialchars($_POST['id_wards']) : '';
			$data['diachi'] = (isset($_POST['diachi'])) ? htmlspecialchars($_POST['diachi']) : '';
			$data['macdinh'] = (isset($_POST['macdinh'])) ? htmlspecialchars($_POST['macdinh']) : 0;
			$data['id_member'] = $_SESSION[$login_member]['id'];

			if($data['macdinh']) {
				$d->rawQuery("update #_member_address SET macdinh = 0 WHERE id_member = ?", array($_SESSION[$login_member]['id']));
			}			
			if($id) {
				$d->where("id", $id);
				$d->update("member_address", $data);
				$func->transferUser(responseaddresss,$config_base.'account/dia-chi');
			} else {
				$d->insert('member_address', $data);
				$func->transferUser(responseuaddresss,$config_base.'account/dia-chi');
			}
		}

	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}


function capnhat()
{
	global $d, $func, $row_detail, $config_base, $login_member, $photos, $videos, $tags_mem, $lang;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));

		$photos = $d->rawQuery("select #_member_photo.*, #_member_timeline.id from #_member_photo INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id where #_member_timeline.id_member = ? and #_member_timeline.hienthi > 0 and #_member_photo.type = 0 order by #_member_photo.id desc limit 0, 12", array($iduser));
		
		$videos = $d->rawQuery("select #_member_photo.*, #_member_timeline.id from #_member_photo INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id where #_member_timeline.id_member = ? and #_member_timeline.hienthi > 0 and #_member_photo.type = 2 order by #_member_photo.id desc limit 0, 12", array($iduser));
	
		$tags_mem = $d->rawQuery("select ten$lang as ten, id from #_tags where type = ? and hienthi > 0", array('member'));

		if(isset($_POST['save']))
		{
			$data['ten'] = (isset($_POST['ten-profile'])) ? htmlspecialchars($_POST['ten-profile']) : '';
			$data['username'] = (isset($_POST['username'])) ? htmlspecialchars($_POST['username']) : '';
			$data['dienthoai'] = (isset($_POST['dienthoai-profile'])) ? htmlspecialchars($_POST['dienthoai-profile']) : 0;

			if(isset($_POST['tag_groups']) && ($_POST['tag_groups'] != '')) $data['id_tags'] = implode(",", $_POST['tag_groups']);
			else $data['id_tags'] = "";

			$data['gioithieu'] = (isset($_POST['gioithieu-profile'])) ? htmlspecialchars($_POST['gioithieu-profile']) : '';
			$data['email'] = (isset($_POST['email-profile'])) ? htmlspecialchars($_POST['email-profile']) : '';
			$data['ngaysinh'] = (isset($_POST['ngaysinh'])) ? strtotime(str_replace("/","-",htmlspecialchars($_POST['ngaysinh']))) : 0;
			$data['gioitinh'] = (isset($_POST['gioitinh'])) ? htmlspecialchars($_POST['gioitinh']) : 0;
			$data['capnhat'] = (isset($_POST['capnhat'])) ? htmlspecialchars($_POST['capnhat']) : 1;

			/* Kiểm tra điện thoại đăng ký */
			$row = $d->rawQueryOne("select id from #_member where dienthoai = ? and id <> ? limit 0,1",array($data['dienthoai'], $iduser));
			if(!empty($row)) $func->transferUser("Số điện thoại đã tồn tại", $config_base.'account/cap-nhat-tai-khoan', false);

			/* Kiểm tra username đăng ký */
			$row = $d->rawQueryOne("select id from #_member where username = ? and id <> ? limit 0,1",array($data['username'], $iduser));
			if(!empty($row)) $func->transferUser("Username đã tồn tại", $config_base.'account/cap-nhat-tai-khoan', false);

			/* Kiểm tra email đăng ký */
			$row = $d->rawQueryOne("select id from #_member where email = ? and id <> ? limit 0,1",array($data['email'], $iduser));
			if(!empty($row)) $func->transferUser("Email đã tồn tại", $config_base.'account/cap-nhat-tai-khoan', false);


			$_SESSION[$login_member]['capnhat'] = 1;

			$d->where('id', $iduser);
			if($d->update('member',$data))
			{
				$func->transferUser(responseufs,$config_base."account");	            
			}
		}

		if(isset($_FILES['file_avatar']))
		{
			$file_name = $func->uploadName($_FILES['file_avatar']["name"]);
			if($photo = $func->uploadImage("file_avatar",".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", UPLOAD_USER_L,$file_name))
			{
				if($row_detail['avatar']) $func->delete_file(UPLOAD_USER.$row_detail['avatar']);
				$data['avatar'] = $photo;
			}
			$d->where('id', $iduser);
			$d->update('member', $data);
			$func->transferUser(responseufs,$config_base.'account');
		}
		if(isset($_FILES['file_background']))
		{
			$file_name = $func->uploadName($_FILES['file_background']["name"]);
			if($photo = $func->uploadImage("file_background",".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", UPLOAD_USER_L,$file_name))
			{
				if($row_detail['background']) $func->delete_file(UPLOAD_USER.$row_detail['background']);
				$data['background'] = $photo;
			}
			$d->where('id', $iduser);
			$d->update('member', $data);
			$func->transferUser(responseufs,$config_base.'account');
		}

	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function doi_mat_khau()
{
	global $d, $func, $row_detail, $config_base, $login_member, $photos, $videos;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));

		$photos = $d->rawQuery("select #_member_photo.*, #_member_timeline.id from #_member_photo INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id where #_member_timeline.id_member = ? and #_member_timeline.hienthi > 0 and #_member_photo.type = 0 order by #_member_photo.id desc limit 0, 12", array($iduser));
		
		$videos = $d->rawQuery("select #_member_photo.*, #_member_timeline.id from #_member_photo INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id where #_member_timeline.id_member = ? and #_member_timeline.hienthi > 0 and #_member_photo.type = 2 order by #_member_photo.id desc limit 0, 12", array($iduser));
	
		if(isset($_POST['save'])) {
			$password = (isset($_POST['password-profile'])) ? htmlspecialchars($_POST['password-profile']) : '';
			$passwordMD5 = md5($password);
			$new_password = (isset($_POST['new-password-profile'])) ? htmlspecialchars($_POST['new-password-profile']) : '';
			$new_passwordMD5 = md5($new_password);
			$new_password_confirm = (isset($_POST['comfirm-new-password-profile'])) ? htmlspecialchars($_POST['comfirm-new-password-profile']) : '';

			if($password)
			{
				$row = $d->rawQueryOne("select id from #_member where id = ? and password = ? limit 0,1",array($iduser,$passwordMD5));

				if(!$row['id']) $func->transferUser(responsefperror,"", false);
				if(!$new_password || ($new_password != $new_password_confirm)) $func->transferUser(responseconfirmperror,"", false);

				$data['password'] = $new_passwordMD5;
			}

			$d->where('id', $iduser);
			if($d->update('member',$data))
			{
				if($password)
				{
					unset($_SESSION[$login_member]);
					setcookie('login_member_id',"",-1,'/');
					setcookie('login_member_session',"",-1,'/');
					$func->transferUser(responseufs,$config_base."account/dang-nhap");
				}           
			}
		}

	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function timeline()
{
	global $d, $func, $row_detail, $config_base, $login_member, $timeline, $photos, $videos;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));

		$timeline = $d->rawQuery("select id, noidung, ngaytao from #_member_timeline where id_member = ? order by id desc", array($iduser));

		$photos = $d->rawQuery("select #_member_photo.*, #_member_timeline.id from #_member_photo INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id where #_member_timeline.id_member = ? and #_member_photo.type = 0 order by #_member_photo.id desc limit 0, 12", array($iduser));
		
		$videos = $d->rawQuery("select #_member_photo.*, #_member_timeline.id from #_member_photo INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id where #_member_timeline.id_member = ? and #_member_photo.type = 2 order by #_member_photo.id desc limit 0, 12", array($iduser));
	

		if(isset($_POST['save-timeline'])) {
			$data['noidung'] = (isset($_POST['noidung-timeline'])) ? htmlspecialchars($_POST['noidung-timeline']) : '';
			$hash = (isset($_POST['hash'])) ? htmlspecialchars($_POST['hash']) : '';
			$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
			if($id) {
				$check = $d->rawQueryOne("select id from #_member_timeline where id = ? and id_member = ?", array($id, $iduser));
				if(empty($check)) {
					$func->transferUser(errorreponse,$config_base, false);
				}
			}
			$data['id_member'] = $iduser;
			if($id) {
				$d->where("id", $id);
				$d->update("member_timeline", $data);
				$func->transferUser(responsetimelines,$config_base.'account');
			} else {
				$data['ngaytao'] = time();
				if($d->insert('member_timeline', $data)) {
					$id_insert = $d->getLastInsertId();
					$d->rawQuery("update #_member_photo set id_timeline = ?, 
					hash = ? where hash = ?",array($id_insert, "null",$hash));
				}
				$func->transferUser(responsetimelines,$config_base.'account');
			}
			
		}
	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function picture()
{
	global $d, $func, $row_detail, $config_base, $login_member, $timeline, $photos, $videos;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));

		$photos = $d->rawQuery("select #_member_photo.*  from #_member_photo 
		INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id 
		where #_member_timeline.id_member = ? and #_member_photo.type = 0 
		order by #_member_photo.stt, #_member_photo.id desc", array($iduser));
	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function video()
{
	global $d, $func, $row_detail, $config_base, $login_member, $timeline, $photos, $videos;

	$iduser = $_SESSION[$login_member]['id'];

	if($iduser)
	{
		$row_detail = $d->rawQueryOne("select ten, username, gioitinh, ngaysinh, email, dienthoai, avatar, background, gioithieu, money, ngaytao, gioithieu, id_tags from #_member where id = ? limit 0,1",array($iduser));
		
		$videos = $d->rawQuery("select #_member_photo.* from #_member_photo 
		INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id 
		where #_member_timeline.id_member = ? and #_member_photo.type = 2 
		order by #_member_photo.stt, #_member_photo.id desc limit 0, 12", array($iduser));
	

		if(isset($_POST['save-timeline'])) {
			$data['noidung'] = (isset($_POST['noidung-timeline'])) ? htmlspecialchars($_POST['noidung-timeline']) : '';
			$hash = (isset($_POST['hash'])) ? htmlspecialchars($_POST['hash']) : '';
			$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
			if($id) {
				$check = $d->rawQueryOne("select id from #_member_timeline where id = ? and id_member = ?", array($id, $iduser));
				if(empty($check)) {
					$func->transferUser(errorreponse,$config_base, false);
				}
			}
			$data['id_member'] = $iduser;
			if($id) {
				$d->where("id", $id);
				$d->update("member_timeline", $data);
				$func->transferUser(responsetimelines,$config_base.'account');
			} else {
				$data['ngaytao'] = time();
				if($d->insert('member_timeline', $data)) {
					$id_insert = $d->getLastInsertId();
					$d->rawQuery("update #_member_photo set id_timeline = ?, 
					hash = ? where hash = ?",array($id_insert, "null",$hash));
				}
				$func->transferUser(responsetimelines,$config_base.'account');
			}
			
		}
	}
	else
	{
		$func->transferUser(pagenotfound,$config_base, false);
	}
}

function active_user()
{
	global $d, $func, $row_detail, $config_base;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
	$maxacnhan = (isset($_POST['maxacnhan'])) ? htmlspecialchars($_POST['maxacnhan']) : '';

	/* Kiểm tra thông tin */
	$row_detail = $d->rawQueryOne("select hienthi, maxacnhan, id from #_member where id = ? limit 0,1",array($id));

	if(empty($row_detail)) $func->transferUser(accountdonthaveactive,$config_base, false);
	else if($row_detail['hienthi']) $func->transferUser(accounthasactive,$config_base);
	else
	{
		if($row_detail['maxacnhan'] == $maxacnhan)
		{
			$data['hienthi'] = 1;
			$data['maxacnhan'] = '';
			$d->where('id', $id);
			if($d->update('member',$data)) $func->transferUser(activeaccounts,$config_base."account");
		}
		else
		{
			$func->transferUser(codeactivef,$config_base."account/kich-hoat?id=".$id, false);
		}
	}
}

function login()
{
	global $d, $func, $login_member, $config_base;

	$email = (isset($_POST['email-login'])) ? htmlspecialchars($_POST['email-login']) : '';
	$password = (isset($_POST['password-login'])) ? htmlspecialchars($_POST['password-login']) : '';
	$passwordMD5 = md5($password);
	$remember = (isset($_POST['remember-user'])) ? htmlspecialchars($_POST['remember-user']) : false;

	if(!$email) $func->transferUser(requiredemail,'', false);
	if(!$password) $func->transferUser(requiredpassword,'', false);
	
	$row = $d->rawQueryOne("select id, password, username, dienthoai, email, ten, capnhat from #_member where email = ? and hienthi > 0 limit 0,1",array($email));

	if(!empty($row))
	{
		if($row['password'] == $passwordMD5)
		{
			/* Tạo login session */
			$id_user = $row['id'];
			$lastlogin = time();
			$login_session = md5($row['password'].$lastlogin);
			$d->rawQuery("update #_member set login_session = ?, lastlogin = ? where id = ?",array($login_session,$lastlogin,$id_user));

			/* Lưu session login */
			$_SESSION[$login_member]['active'] = true;
			$_SESSION[$login_member]['id'] = $row['id'];
			$_SESSION[$login_member]['username'] = $row['username'];
			$_SESSION[$login_member]['dienthoai'] = $row['dienthoai'];
			$_SESSION[$login_member]['email'] = $row['email'];
			$_SESSION[$login_member]['capnhat'] = $row['capnhat'];
			$_SESSION[$login_member]['ten'] = $row['ten'];
			$_SESSION[$login_member]['login_session'] = $login_session;

			/* Nhớ mật khẩu */
			setcookie('login_member_id',"",-1,'/');
			setcookie('login_member_session',"",-1,'/');
			if($remember)
			{
				$time_expiry = time()+3600*24;
				setcookie('login_member_id',$row['id'],$time_expiry,'/');
				setcookie('login_member_session',$login_session,$time_expiry,'/');
			}

			$func->transferUser(reponselogins, $config_base."account");
		}
		else
		{
			$func->transferUser(responseloginnoactive, $config_base, false);
		}
	}
	else
	{
		$func->transferUser(responseloginnoactive, $config_base, false);
	}
}

function signup()
{
	global $d, $func, $config_base;

	$email = (isset($_POST['email-register'])) ? htmlspecialchars($_POST['email-register']) : '';
	$password = (isset($_POST['password-register'])) ? htmlspecialchars($_POST['password-register']) : '';
	$passwordMD5 = md5($password);
	$repassword = (isset($_POST['repassword-register'])) ? htmlspecialchars($_POST['repassword-register']) : '';
	$maxacnhan = $func->digitalRandom(0,3,6);

	if($password != $repassword) $func->transferUser(passwordnotcomfirm, $config_base, false);

	/* Kiểm tra email đăng ký */
	$row = $d->rawQueryOne("select id from #_member where email = ? limit 0,1",array($email));
	if(!empty($row)) $func->transferUser(emailisexits, $config_base, false);

	$data['password'] = md5($password);
	$data['email'] = $email;
	$data['maxacnhan'] = $maxacnhan;
	$data['ngaytao'] = time();
	$data['hienthi'] = 0;
	
	if($d->insert('member',$data))
	{
		send_active_user($email);
		$func->transferUser(responseregisters1." ".$data['email']." ".responseregister2, $config_base);
	}
	else
	{
		$func->transferUser(responseregisterf, $config_base, false);
	}
}

function send_active_user($email)
{
	global $d, $setting, $emailer, $func, $config_base, $lang;

	/* Lấy thông tin người dùng */
	$row = $d->rawQueryOne("select id, maxacnhan, email, password, ten, email, dienthoai from #_member where email = ? limit 0,1",array($email));

	/* Gán giá trị gửi email */
	$iduser = $row['id'];
	$maxacnhan = $row['maxacnhan'];
	$matkhau = $row['password'];
	$tennguoidung = $row['ten'];
	$emailnguoidung = $row['email'];
	$dienthoainguoidung = $row['dienthoai'];
	$linkkichhoat = $config_base."account/kich-hoat?id=".$iduser;

	/* Thông tin đăng ký */
	$thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">Mật khẩu: *******'.substr($matkhau,-3).'<br>Mã kích hoạt: '.$maxacnhan.'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
	if($emailnguoidung)
	{
		$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
	}
	if($dienthoainguoidung)
	{
		$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
	}

	$contentMember = '
	<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
	<tbody>
	<tr>
	<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
	<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
	<tbody>
	<tr>
	<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
	<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
	<tbody>
	<tr>
	<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
	<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
	<div style="display:flex;justify-content:space-between;align-items:center;">
	<table style="width:100%;">
	<tbody>
	<tr>
	<td>
	<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
	</td>
	<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
	</tr>
	</tbody>
	</table>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr style="background:#fff">
	<td align="left" height="auto" style="padding:15px" width="600">
	<table>
	<tbody>
	<tr>
	<td>
	<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">'.titlemailactive2.' '.$emailer->getEmail('company:website').'</h1>
	<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">'.titlemailactive3.' '.$emailer->getEmail('company:website').' '.titlemailactive4.'</p>
	<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">'.accountinfo.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.day.' '.date('d',$emailer->getEmail('datesend')).' '.month.' '.date('m',$emailer->getEmail('datesend')).' '.year.' '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
	</td>
	</tr>
	<tr>
	<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<thead>
	<tr>
	<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'.accountinfo.'</th>
	<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'.accountuser.'</th>
	</tr>
	</thead>
	<tbody>
	<tr>'.$thongtindangky.'</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>'.titleaccountmail5.'</i>
	<div style="margin:auto"><a href="'.$linkkichhoat.'" style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:38%;margin-top:5px" target="_blank">'.activeaccount.'</a></div>
	</p>
	</td>
	</tr>
	<tr>
	<td>&nbsp;
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">'.subtitlemail2.' <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, '.orcallhotline.' <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' '.readysupport.'</p>
	</td>
	</tr>
	<tr>
	<td>&nbsp;
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">'.onemore.' '.$emailer->getEmail('company:website').' '.thankyou.'.</p>
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td align="center">
	<table width="600">
	<tbody>
	<tr>
	<td>
	<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">'.titlemailactive1.' '.$emailer->getEmail('company:website').'.<br>
	'.subtitlemail4.' '.$emailer->getEmail('company:website').', '.subtitlemail5.' <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> '.subtitlemail6.'<br>
	<b>Địa chỉ:</b> '.$emailer->getEmail('company:address').'</p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>';

	/* Send email admin */
	$arrayEmail = array(
		"dataEmail" => array(
			"name" => $row['username'],
			"email" => $row['email']
		)
	);
	$subject = titleactiveacount." ".$setting['ten'.$lang];
	$message = $contentMember;
	$file = '';

	if(!$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) $func->transferUser(activeerror,$config_base."lien-he", false);
}

function doimatkhau_user()
{
	global $d, $setting, $emailer, $func, $login_member, $config_base, $lang;

	$email = (isset($_POST['emailforgot'])) ? htmlspecialchars($_POST['emailforgot']) : '';
	$newpass = substr(md5(rand(0,999)*time()), 15, 6);
	$newpassMD5 = md5($newpass);

	if(!$email) $func->transferUser(requiredemail, $config_base, false);

	/* Kiểm tra username và email */
	$row = $d->rawQueryOne("select id from #_member where email = ? limit 0,1",array($email));
	if(!$row['id']) $func->transferUser(emailnoexits, $config_base, false);

	/* Cập nhật mật khẩu mới */
	$data['password'] = $newpassMD5;
	$d->where('email', $email);
	$d->update('member',$data);

	/* Lấy thông tin người dùng */
	$row = $d->rawQueryOne("select id, username, password, ten, email, dienthoai from #_member where username = ? limit 0,1",array($username));

	/* Gán giá trị gửi email */
	$iduser = $row['id'];
	$matkhau = $row['password'];
	$tennguoidung = $row['ten'];
	$emailnguoidung = $row['email'];
	$dienthoainguoidung = $row['dienthoai'];

	/* Thông tin đăng ký */
	$thongtindangky='<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><br>'.password.': *******'.substr($matkhau,-3).'</td><td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">';
	if($tennguoidung)
	{
		$thongtindangky.='<span style="text-transform:capitalize">'.$tennguoidung.'</span><br>';
	}

	if($emailnguoidung)
	{
		$thongtindangky.='<a href="mailto:'.$emailnguoidung.'" target="_blank">'.$emailnguoidung.'</a><br>';
	}

	if($dienthoainguoidung)
	{
		$thongtindangky.='Tel: '.$dienthoainguoidung.'</td>';
	}

	$contentMember = '
	<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
	<tbody>
	<tr>
	<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
	<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
	<tbody>
	<tr>
	<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
	<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
	<tbody>
	<tr>
	<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
	<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
	<table style="width:100%;">
	<tbody>
	<tr>
	<td>
	<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
	</td>
	<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr style="background:#fff">
	<td align="left" height="auto" style="padding:15px" width="600">
	<table>
	<tbody>
	<tr>
	<td>
	<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">'.welcomeyou.'</h1>
	<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">'.titlefgp1.'</p>
	<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">'.accountinfo.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.day.' '.date('d',$emailer->getEmail('datesend')).' '.month.' '.date('m',$emailer->getEmail('datesend')).' '.year.' '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
	</td>
	</tr>
	<tr>
	<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<thead>
	<tr>
	<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'.accountinfo.'</th>
	<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'.accountuser.'</th>
	</tr>
	</thead>
	<tbody>
	<tr>'.$thongtindangky.'</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>'.titlefgp2.'</i>
	<div style="margin:auto"><p style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;margin-right:30px;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-left:33%;margin-top:5px" target="_blank">'.newpassword.': '.$newpass.'</p></div>
	</p>
	</td>
	</tr>
	<tr>
	<td>&nbsp;
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">'.subtitlemail2.' <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, '.orcallhotline.' <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' '.readysupport.'</p>
	</td>
	</tr>
	<tr>
	<td>&nbsp;
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">'.onemore.' '.$emailer->getEmail('company:website').' '.thankyou.'.</p>
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td align="center">
	<table width="600">
	<tbody>
	<tr>
	<td>
	<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">'.subtitlemail3.' '.$emailer->getEmail('company:website').'.<br>
	'.subtitlemail4.' '.$emailer->getEmail('company:website').', '.subtitlemail5.' <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> '.subtitlemail6.'.<br>
	<b>Địa chỉ:</b> '.$emailer->getEmail('company:address').'</p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>';

	/* Send email admin */
	$arrayEmail = array(
		"dataEmail" => array(
			"name" => $tennguoidung,
			"email" => $email
		)
	);
	$subject = titlefgp." ".$setting['ten'.$lang];
	$message = $contentMember;
	$file = '';

	if($emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file))
	{
		unset($_SESSION[$login_member]);
		setcookie('login_member_id',"",-1,'/');
		setcookie('login_member_session',"",-1,'/');
		$func->transferUser(fgps." ".$email, $config_base);
	}
	else
	{
		$func->transferUser(fgpe, $config_base.'lien-he', false);
	}
}

function logout()
{
	global $d, $func, $login_member, $config_base;

	unset($_SESSION[$login_member]);
	setcookie('login_member_id',"",-1,'/');
	setcookie('login_member_session',"",-1,'/');

	$func->transferUser(logouts, $config_base);
}
?>