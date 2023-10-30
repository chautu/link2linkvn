<?php
if(!defined('SOURCES')) die("Error");

switch($act)
{
	/* Login - logout - edit admin */
	case "login":
	if(isset($_SESSION[$login_admin]['active']) && $_SESSION[$login_admin]['active'] == true) $func->transfer("Trang không tồn tại", "index.php", false);
	else $template = "user/login";
	break;
	case "logout":
	logout();
	break;
	case "admin_edit":
	edit();
	$template = "user/admin/admin_add";
	break;

	case "add-address-admin":
	$template = "places/admin/place_add";
	break;

	case "edit-address-admin":
	get_address_admin();
	$template = "places/admin/place_add";
	break;

	case "save-address-admin":
	save_address_admin();
	break;

	case "delete-address-admin":
	delete_address_admin();
	break;

	case "add-bank-admin":
	$template = "bank/admin/bank_add";
	break;

	case "edit-bank-admin":
	get_bank_admin();
	$template = "bank/admin/bank_add";
	break;

	case "save-bank-admin":
	save_bank_admin();
	break;

	case "delete-bank-admin":
	delete_bank_admin();
	break;

	case "add-transition-admin":
	$template = "transition/admin/transition_add";
	break;

	case "edit-transition-admin":
	get_transition_admin();
	$template = "transition/admin/transition_edit";
	break;

	case "save-transition-admin":
	save_transition_admin();
	break;

	case "auto-transition-admin":
	$template = "transition/admin/transition_auto";
	break;

	case "save-auto-transition-admin":
	save_auto_transition_admin();
	break;

	case "return-auto-transition-admin":
	return_auto_transition_admin();
	break;

	case "add-timeline-admin":
	$template = "timeline/admin/timeline_add";
	break;

	case "edit-timeline-admin":
	get_timeline_admin();
	$template = "timeline/admin/timeline_edit";
	break;

	case "save-timeline-admin":
	save_timeline_admin();
	break;

	case "delete-timeline-admin":
	delete_timeline_admin();
	break;

	case "add-photo-timeline-admin":
	$template = "timeline/photo_admin/photo_add";
	break;

	case "edit-photo-timeline-admin":
	get_photo_timeline_admin();
	$template = "timeline/photo_admin/photo_add";
	break;

	case "save-photo-timeline-admin":
	save_photo_timeline_admin();
	break;

	case "delete-photo-timeline-admin":
	delete_photo_timeline_admin();
	break;



	/* Info admin */
	case "man_admin":
	/* Kiểm tra active user admin */
	if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_items_admin();
	$template = "user/man_admin/items";
	break;
	case "add_admin":
	/* Kiểm tra active user admin */
	if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "user/man_admin/item_add";
	break;
	case "edit_admin":
	/* Kiểm tra active user admin */
	if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	if(!isset($_GET['active'])) {
		$_GET['active'] = "gioithieu";
	}
	get_item_admin();
	$template = "user/man_admin/item_add";
	break;
	case "save_admin":
	/* Kiểm tra active user admin */
	if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	save_item_admin();
	break;
	case "delete_admin":
	/* Kiểm tra active user admin */
	if(!isset($config['user']['admin']) || $config['user']['admin'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_item_admin();
	break;


	case "add-address-man-admin":
	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "places/man-admin/place_add";
	break;

	case "edit-address-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_address_man_admin();
	$template = "places/man-admin/place_add";
	break;

	case "save-address-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_address_man_admin();
	break;

	case "delete-address-man-admin":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_address_man_admin();
	break;

	case "add-bank-man-admin":
	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "bank/man-admin/bank_add";
	break;

	case "edit-bank-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_bank_man_admin();
	$template = "bank/man-admin/bank_add";
	break;

	case "save-bank-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_bank_man_admin();
	break;

	case "delete-bank-man-admin":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_bank_man_admin();
	break;

	case "add-transition-man-admin":
	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "transition/man-admin/transition_add";
	break;

	case "edit-transition-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_transition_man_admin();
	$template = "transition/man-admin/transition_edit";
	break;

	case "save-transition-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_transition_man_admin();
	break;

	case "delete-transition-man-admin":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_transition_man_admin();
	break;

	case "add-timeline-man-admin":
	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "timeline/man-admin/timeline_add";
	break;

	case "edit-timeline-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_timeline_man_admin();
	$template = "timeline/man-admin/timeline_edit";
	break;

	case "save-timeline-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_timeline_man_admin();
	break;

	case "delete-timeline-man-admin":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_timeline_man_admin();
	break;

	case "add-photo-timeline-man-admin":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "timeline/photo_man-admin/photo_add";
	break;

	case "edit-photo-timeline-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_photo_timeline_man_admin();
	$template = "timeline/photo_man-admin/photo_add";
	break;

	case "save-photo-timeline-man-admin":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_photo_timeline_man_admin();
	break;

	case "delete-photo-timeline-man-admin":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_photo_timeline_man_admin();
	break;


	/* Info visitor */
	case "man":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_items();
	$template = "user/man/items";
	break;
	case "add":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	if(!isset($_GET['active'])) {
		$_GET['active'] = "gioithieu";
	}
	$template = "user/man/item_add";
	break;
	case "edit":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_item();
	$template = "user/man/item_add";
	break;
	case "save":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_item();
	break;
	case "delete":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_item();
	break;

	case "add-address":
	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "places/man/place_add";
	break;

	case "edit-address":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_address();
	$template = "places/man/place_add";
	break;

	case "save-address":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_address();
	break;

	case "delete-address":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_address();
	break;

	case "add-bank":
	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "bank/man/bank_add";
	break;

	case "edit-bank":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_bank();
	$template = "bank/man/bank_add";
	break;

	case "save-bank":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_bank();
	break;

	case "delete-bank":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_bank();
	break;

	case "add-transition":
	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "transition/man/transition_add";
	break;

	case "edit-transition":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_transition();
	$template = "transition/man/transition_edit";
	break;

	case "save-transition":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_transition();
	break;

	case "delete-transition":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_transition();
	break;

	case "add-timeline":
	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "timeline/man/timeline_add";
	break;

	case "edit-timeline":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_timeline();
	$template = "timeline/man/timeline_edit";
	break;

	case "save-timeline":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_timeline();
	break;

	case "delete-timeline":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_timeline();
	break;

	case "add-photo-timeline":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "timeline/photo/photo_add";
	break;

	case "edit-photo-timeline":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	get_photo_timeline();
	$template = "timeline/photo/photo_add";
	break;

	case "save-photo-timeline":
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_photo_timeline();
	break;

	case "delete-photo-timeline":
	/* Kiểm tra active user visitor */
	if(!isset($config['user']['visitor']) || $config['user']['visitor'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_photo_timeline();
	break;


	/* Phân quyền */
	case "permission_group":
	/* Kiểm tra active phân quyền */
	if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	permission_groups();
	$template = "user/admin/permission_groups";
	break;
	case "add_permission_group":
	/* Kiểm tra active phân quyền */
	if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	$template = "user/admin/permission_group";
	break;
	case "edit_permission_group":
	/* Kiểm tra active phân quyền */
	if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	permission_group();
	$template = "user/admin/permission_group";
	break;
	case "save_permission_group":
	/* Kiểm tra active phân quyền */
	if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	save_permission_group();
	break;
	case "delete_permission_group":
	/* Kiểm tra active phân quyền */
	if(!isset($config['permission']) || $config['permission'] == false) $func->transfer("Trang không tồn tại", "index.php", false);
	if($func->check_permission())
	{
		$func->transfer("Bạn không có quyền vào trang này", "index.php", false);
		exit;
	}
	delete_permission_group();
	break;

	default:
	$template = "404";
}

/* Get phân quyền */
function permission_groups()
{
	global $d, $func, $curPage, $items, $paging;

	$where = "";

	if(isset($_REQUEST['keyword']))
	{
		$keyword = htmlspecialchars($_REQUEST['keyword']);
		$where .= " and ten LIKE '%$keyword%'";
	}

	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_permission_group where id<>0 $where order by stt,id desc $limit";
	$items = $d->rawQuery($sql);
	$sqlNum = "select count(*) as 'num' from #_permission_group where id<>0 $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum);
	$total = $count['num'];
	$url = "index.php?com=user&act=permission_group";
	$paging = $func->pagination($total,$per_page,$curPage,$url);
}

/* Edit phân quyền */
function permission_group()
{
	global $d, $func, $curPage, $item, $ds_quyen;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		/* Lấy nhóm quyền */
		$item = $d->rawQueryOne("select * from #_permission_group where id = ? limit 0,1",array($id));

		if(!isset($item['id'])) $func->transfer("Nhóm quyền này không tồn tại", "index.php?com=user&act=permission_group&p=".$curPage, false);

		/* Lấy quyền */
		$arr = $d->rawQuery("select ma,quyen from #_permission where ma_nhom_quyen = ?",array($id));

		if(!empty($arr)) foreach($arr as $quyen) $ds_quyen[] = $quyen['quyen'];
		else $ds_quyen[] = '';
	}
	else
	{
		$func->transfer("Nhóm quyền này không tồn tại", "index.php?com=user&act=permission_group&p=".$curPage, false);
	}
}

/* Save phân quyền */
function save_permission_group()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	$dataQuyen = (isset($_POST['dataQuyen'])) ? $_POST['dataQuyen'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}
	}
	$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;

	if($id)
	{
		/* Kiểm tra nhóm quyền */
		$row = $d->rawQueryOne("select id from #_permission_group where id = ? limit 0,1",array($id));
		if(!isset($row['id'])) $func->transfer("Nhóm quyền này không tồn tại", "index.php?com=user&act=permission_group&p=".$curPage, false);

		/* Cập nhật thông tin nhóm quyền */
		$data['ngaysua'] = time();
		$d->where('id',$id);
		$d->update('permission_group',$data);

		/* Xóa hết các quyên hiện tại */
		$d->rawQuery("delete from #_permission where ma_nhom_quyen = ?",array($id));

		/* Thêm các quyền mới vào */
		if($dataQuyen)
		{
			for($i=0;$i<count($dataQuyen);$i++)
			{
				$data_permission['ma_nhom_quyen'] = $id;
				$data_permission['quyen'] = $dataQuyen[$i];
				$d->insert('permission',$data_permission);
			}
			$func->transfer("Cập nhật nhóm quyền thành công", "index.php?com=user&act=permission_group&p=".$curPage);
		}
		else
		{
			$func->transfer("Cập nhật nhóm quyền thất bại", "index.php?com=user&act=permission_group&p=".$curPage);
		}
	}
	else
	{

		/* Lưu thông tin nhóm quyền */
		$data['ngaytao'] = time();
		$d->insert('permission_group',$data);

		/* Lưu quyền cho nhóm quyền */
		if($dataQuyen)
		{
			$id_nhomquyen = $d->getLastInsertId();
			for($i=0;$i<count($dataQuyen);$i++)
			{
				$data_permission['ma_nhom_quyen'] = $id_nhomquyen;
				$data_permission['quyen'] = $dataQuyen[$i];
				$d->insert('permission',$data_permission);
			}
			$func->transfer("Tạo nhóm quyền thành công", "index.php?com=user&act=permission_group&p=".$curPage);
		}
		else
		{
			$func->transfer("Tạo nhóm quyền thất bại", "index.php?com=user&act=permission_group&p=".$curPage);
		}
	}
}

/* Delete phân quyền */
function delete_permission_group()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{	
		$row = $d->rawQuery("select * from #_permission_group where id = ?",array($id));

		if(count($row))
		{
			$d->rawQuery("delete from #_permission_group where id = ?",array($id));
			$row = $d->rawQuery("select * from #_permission where ma_nhom_quyen = ?",array($id));
			if(count($row)) $d->rawQuery("delete from #_permission where ma_nhom_quyen = ?",array($id));
			$row = $d->rawQuery("select * from #_user where id_nhomquyen = ?",array($id));

			if(count($row))
			{
				$data_user['id_nhomquyen'] = 0;
				$d->where('id_nhomquyen',$id);
				$d->update('user',$data_user);
			}
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=permission_group&p=".$curPage);
		}
		else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=user&act=permission_group&p=".$curPage, false);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$row = $d->rawQuery("select * from #_permission_group where id = ?",array($id));

			if(count($row))
			{
				$d->rawQuery("delete from #_permission_group where id = ?",array($id));
				$row = $d->rawQuery("select * from #_permission where ma_nhom_quyen = ?",array($id));
				if(count($row)) $d->rawQuery("delete from #_permission where ma_nhom_quyen = ?",array($id));
				$row = $d->rawQuery("select * from #_user where id_nhomquyen = ?",array($id));

				if(count($row))
				{
					$data_user['id_nhomquyen'] = 0;
					$d->where('id_nhomquyen',$id);
					$d->update('user',$data_user);
				}
			}
		}

		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=permission_group&p=".$curPage);
	} 
	else $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=permission_group&p=".$curPage, false);
}

/* Get admin */
function get_items_admin()
{
	global $d, $func, $curPage, $items, $paging, $config;

	$where = "";

	if(isset($_REQUEST['keyword']))
	{
		$keyword = htmlspecialchars($_REQUEST['keyword']);
		$where .= " and (username LIKE '%$keyword%' or ten LIKE '%$keyword%')";
	}

	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_user where id <> 1 and role = 1 $where order by stt,id desc $limit";
	$items = $d->rawQuery($sql);
	$sqlNum = "select count(*) as 'num' from #_user where id <> 1 and role = 1 $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum);
	$total = $count['num'];
	$url = "index.php?com=user&act=man_admin";
	$paging = $func->pagination($total,$per_page,$curPage,$url);
}

/* Edit admin */
function get_item_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_admin&p=".$curPage, false);

	$item = $d->rawQueryOne("select * from #_user where role = 1 and id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=man_admin&p=".$curPage, false);
}

/* Save admin */
function save_item_admin()
{
	global $d, $func, $curPage, $config;

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man_admin&p=".$curPage, false);

	$id = htmlspecialchars($_POST['id']);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['role'] = 1;
		$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}

	/* Kiểm tra username */
	$username = isset($data['username']) ? $data['username'] : '';
	$check_username = $d->rawQueryOne("select id from #_user where username = ? and id <> ? limit 0,1",array($username, $id));
	if(!empty($check_username)) $func->transfer("Tên đăng nhập này đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=edit_admin&id=".$id."&p=".$curPage, false);

	/* Kiểm tra username */
	$email = isset($data['email']) ? $data['email'] : '';
	$check_email = $d->rawQueryOne("select id from #_user where email = ? and id <> ? limit 0,1",array($email, $id));
	if(!empty($check_email)) $func->transfer("Tên đăng nhập này đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=edit_admin&id=".$id."&p=".$curPage, false);

	/* Kiểm tra username */
	$dienthoai = isset($data['dienthoai']) ? $data['dienthoai'] : '';
	$check_dienthoai = $d->rawQueryOne("select id from #_user where dienthoai = ? and id <> ? limit 0,1",array($dienthoai, $id));
	if(!empty($check_dienthoai)) $func->transfer("Tên đăng nhập này đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=edit_admin&id=".$id."&p=".$curPage, false);


	if($id)
	{
		if($func->check_permission())
		{
			$row = $d->rawQueryOne("select id from #_user where id = ? limit 0,1",array($id));
			if(isset($row['id']) && $row['id'] > 0) $func->transfer("Bạn không có quyền trên tài khoản này. Mọi thắc mắc xin liên hệ quản trị website", "index.php?com=user&act=man_admin&p=".$curPage, false);
		}

		if(isset($data['password']) && ($data['password'] != ''))
		{
			$password = $data['password'];
			$confirm_password = isset($_POST['confirm_password']) ? $_POST['confirm_password'] : '';

			if($confirm_password=='')
			{
				$func->transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=edit_admin&id=".$id."&p=".$curPage, false);
			}

			if($password!=$confirm_password)
			{
				$func->transfer("Xác nhận mật khẩu mới không chính xác","index.php?com=user&act=edit_admin&id=".$id."&p=".$curPage, false);
			}

			$data['password'] = md5($config['website']['secret'].$password.$config['website']['salt']);
		}
		else unset($data['password']);

		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES['file']["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", UPLOAD_USER, $file_name))
			{
				$data['avatar'] = $photo;
				$row = $d->rawQueryOne("select id, avatar from #_user where id = ? limit 0,1",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_USER.$row['avatar']);
			}
		}

		$d->where('id', $id);
		if($d->update('user',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=man_admin&p=".$curPage);
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man_admin&p=".$curPage, false);
	}
	else
	{
		// $username = isset($data['username']) ? $data['username'] : '';
		// $row = $d->rawQueryOne("select id from #_user where username = ? limit 0,1",array($username));
		// if(isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập nay đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=man_admin&p=".$curPage, false);

		if(isset($data['password']) && ($data['password'] == '')) $func->transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add_admin&p=".$curPage, false);
		$data['password'] = md5($config['website']['secret'].$data['password'].$config['website']['salt']);

		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES['file']["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", UPLOAD_USER, $file_name))
			{
				$data['avatar'] = $photo;
			}
		}
		$data['ngaytao'] = time();

		if($d->insert('user',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=man_admin&p=".$curPage);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man_admin", false);
	}
}

/* Delete admin */
function delete_item_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$d->rawQuery("delete from #_user where id = ? and role = 1",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=man_admin&p=".$curPage);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_user where id = ? and role = 1",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=man_admin&p=".$curPage);
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin&p=".$curPage, false);
}


/* Edit address */
function get_address_man_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit_admin&active=diachi&p=".$curPage."&id=".$user, false);

	$item = $d->rawQueryOne("select * from #_user_address where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit_admin&active=diachi&p=".$curPage."&id=".$user, false);
}

/* save address */
function save_address_man_admin()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=diachi", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$d->where('id', $id);
		if($d->update('user_address',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=diachi");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=diachi", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('user_address',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=diachi");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=diachi", false);
	}
}

/* Delete address */
function delete_address_man_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	if($id)
	{
		$d->rawQuery("delete from #_user_address where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=diachi");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_user_address where id = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=diachi");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=diachi", false);
}

/* Edit bank */
function get_bank_man_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit_admin&active=nganhang&p=".$curPage."&id=".$user, false);

	$item = $d->rawQueryOne("select * from #_user_bank where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit_admin&active=nganhang&p=".$curPage."&id=".$user, false);
}

/* Save bank */
function save_bank_man_admin()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=nganhang", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$data['ngaysua'] = time();
		$d->where('id', $id);
		if($d->update('user_bank',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=nganhang");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=nganhang", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('user_bank',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=nganhang");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=nganhang", false);
	}
}

/* Delete bank */
function delete_bank_man_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	if($id)
	{
		$d->rawQuery("delete from #_user_bank where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=nganhang");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_user_bank where id = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=nganhang");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=nganhang", false);
}

/* Edit transition */
function get_transition_man_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit_admin&active=transition&id=".$user, false);

	$item = $d->rawQueryOne("select * from #_user_transition where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit_admin&active=transition&id=".$user, false);
}

/* Save transition */
function save_transition_man_admin()
{
	global $d, $func, $curPage, $login_admin, $config;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=transition", false);

	$member = $func->get_profile($user, "user");

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}
		$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : 0;
		if(isset($data['money'])) {
			$data['money'] = str_replace(",","",$data['money']);
			$data['first_money'] = $member['money'];
			if($data['type'] == 0) {
				$data['last_money'] = $member['money'] + $data['money'];
			} else {
				$data['last_money'] = $member['money'] - $data['money'];
				if($data['last_money'] < 0) {
					$func->transfer("Dữ liệu không hợp lệ", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=transition", false);
				}
			}
		}
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$row_detail = $d->rawQueryOne("select ghichu, money from #_user_transition where id = ?", array($id));
		$data['ngaysua'] = time();
		$action =  (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : 0;
		if($action) {
			if($action == 1) {
				$data['first_money'] = $member['money'];
				$data['last_money'] = $member['money'] - $row_detail['money'];
			} else {
				$data['first_money'] = $member['money'];
				$data['last_money'] = $member['money'] + $row_detail['money'];
			}
		}
		$d->where('id', $id);
		if($d->update('user_transition',$data)) {
			$noidung = $_SESSION[$login_admin]['username']." cập nhật trạng thái: ".$func->get_namestatus('status',$data['id_status']);
			if($row_detail['ghichu'] != $data['ghichu']) {
				$noidung .= ". Cập nhật ghi chú: ".$data['ghichu'];
			}
			if($action) {
				if($action == 1) {
					$data_member['money'] = $member['money'] - $row_detail['money'];
					$noidung .= ". Trừ ";
				}else if($action == 2) {
					$data_member['money'] = $row_detail['money'] + $member['money'];
					$noidung .= ". Cộng ";
				}
				$d->where('id', $member['id']);
				$d->update('user',$data_member);
				$noidung .= number_format($row_detail['money'])." tài khoản người dùng";
			}
			$dataLog = [
				"id_transition" => $id,
				"noidung" => $noidung,
				"ngaytao"	=> time()
			];
			$d->insert("user_transition_log", $dataLog);
			$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit-transition-man-admin&p=".$curPage."&id=".$id."&id_status=".$data['id_status']."&user=".$user);
		}
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=transition", false);
	} else {
		$data['bank'] = "Thay đổi số dư từ Admin";
		$data['ngaytao'] = time();
		$data['id_status'] = $func->get_status_by_default("status", "id", "access", "transition", $config['website']['lang-default']);
		if($d->insert('user_transition',$data)) {
			$id_insert = $d->getLastInsertId();
			$dataLog = [
				"id_transition" => $id_insert,
				"noidung" => $_SESSION[$login_admin]['username']." tạo giao dịch thành công. ghi chú: ".$data['ghichu'],
				"ngaytao"	=> time()
			];
			$d->insert("user_transition_log", $dataLog);
			if($data['type'] == 0) {
				$data_member['money'] = $data['money'] + $member['money'];
			} else {
				$data_member['money'] = $member['money'] - $data['money'];
			}
			$d->where('id', $member['id']);
			$d->update('user',$data_member);
			$func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=transition");
		} 
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=transition", false);
	}
}

/* Delete transition */
function delete_transition_man_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);

	if($id)
	{
		$d->rawQuery("delete from #_user_transition where id = ?",array($id));
		$d->rawQuery("delete from #_user_transition_log where id_transition = ?", array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=transition");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_user_transition where id = ?",array($id));
			$d->rawQuery("delete from #_user_transition_log where id_transition = ?", array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=transition");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=transition", false);
}



/* Edit timeline */
function get_timeline_man_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);

	if(!$id) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);

	$item = $d->rawQueryOne("select * from #_user_timeline where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);
}

/* Save timeline */
function save_timeline_man_admin()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$data['ngaysua'] = time();
		$d->where('id', $id);
		if($d->update('user_timeline',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('user_timeline',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);
	}
}

/* Delete timeline */
function delete_timeline_man_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);

	if($id)
	{
		$d->rawQuery("delete from #_user_timeline where id = ?",array($id));
		$photos = $d->rawQuery("select photo,taptin, id from #_user_photo where id_timeline = ? and type <> 1", array($id));
		foreach($photos as $photo) {
			if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
			if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
		}
		$d->rawQuery("delete from #_user_photo where id_timeline = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_user_timeline where id = ?",array($id));
			$photos = $d->rawQuery("select photo,taptin, id from #_user_photo where id_timeline = ? and type <> 1", array($id));
			foreach($photos as $photo) {
				if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
				if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
			}
			$d->rawQuery("delete from #_user_photo where id_timeline = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);
}


/* Edit photo timeline */
function get_photo_timeline_man_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	$id_timeline = (isset($_GET['id-timeline'])) ? htmlspecialchars($_GET['id-timeline']) : 0;
	if(!$id_timeline) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);

	$item = $d->rawQueryOne("select * from #_user_photo where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit_admin&active=trangcanhan&p=".$curPage."&id=".$user, false);
}

/* Save photo timeline */
function save_photo_timeline_man_admin()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	$id_timeline = (isset($_GET['id-timeline'])) ? htmlspecialchars($_GET['id-timeline']) : 0;
	if(!$id_timeline) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit-timeline-man-admin&p=".$curPage."&id=".$id_timeline."&user=".$user, false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES["file"]["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", "../upload/user/",$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_user_photo where id = ?",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file("../upload/user/".$row['photo']);
			}
		}

		if(isset($_FILES['video-file']))
		{
			$file_name = $func->uploadName($_FILES["video-file"]["name"]);
			if($taptin = $func->uploadImage("video-file", ".mp4|.MP4", "../upload/user/",$file_name))
			{
				$data['taptin'] = $taptin;
				$row = $d->rawQueryOne("select id, taptin from #_user_photo where id = ?",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file("../upload/user/".$row['taptin']);
			}
		}
		$d->where('id', $id);
		if($d->update('user_photo',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit-timeline-man-admin&p=".$curPage."&id=".$id_timeline."&user=".$user);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);
	} else {
		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES["file"]["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", "../upload/user/",$file_name))
			{
				$data['photo'] = $photo;
			}
		}

		if(isset($_FILES['video-file']))
		{
			$file_name = $func->uploadName($_FILES["video-file"]["name"]);
			if($taptin = $func->uploadImage("video-file", ".mp4|.MP4", "../upload/user/",$file_name))
			{
				$data['taptin'] = $taptin;
			}
		}
		$data['ngaytao'] = time();
		if($d->insert('user_photo',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit-timeline-man-admin&p=".$curPage."&id=".$id_timeline."&user=".$user);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);
	}
}

/* Delete photo timeline */
function delete_photo_timeline_man_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man_admin", false);
	
	$id_timeline = (isset($_GET['id-timeline'])) ? htmlspecialchars($_GET['id-timeline']) : 0;
	if(!$id_timeline) $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);

	if($id)
	{
		$photo = $d->rawQueryOne("select photo,taptin, id from #_user_photo where id = ?", array($id));
		if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
		if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
		$d->rawQuery("delete from #_user_photo where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit-timeline-man-admin&p=".$curPage."&id=".$id_timeline."&user=".$user);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$photo = $d->rawQueryOne("select photo,taptin, id from #_user_photo where id = ?", array($id));
			if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
			if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
			$d->rawQuery("delete from #_user_photo where id = ?",array($id));
		}
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit-timeline-man-admin&p=".$curPage."&id=".$id_timeline."&user=".$user);
	}
	$func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit_admin&p=".$curPage."&id=".$user."&active=trangcanhan", false);
}


/* Get visitor */
function get_items()
{
	global $d, $func, $curPage, $items, $paging, $config;

	$where = "";

	if(isset($_REQUEST['keyword']))
	{
		$keyword = htmlspecialchars($_REQUEST['keyword']);
		$where .= " and (username LIKE '%$keyword%' or ten LIKE '%$keyword%')";
	}

	$per_page = 10;
	$startpoint = ($curPage * $per_page) - $per_page;
	$limit = " limit ".$startpoint.",".$per_page;
	$sql = "select * from #_member where id <> 0 $where order by stt,id desc $limit";
	$items = $d->rawQuery($sql);
	$sqlNum = "select count(*) as 'num' from #_member where id <> 0 $where order by stt,id desc";
	$count = $d->rawQueryOne($sqlNum);
	$total = $count['num'];
	$url = "index.php?com=user&act=man";
	$paging = $func->pagination($total,$per_page,$curPage,$url);
}

/* Edit visitor */
function get_item()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!isset($_GET['active'])) {
		$_GET['active'] = "gioithieu";
	}

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);

	$item = $d->rawQueryOne("select * from #_member where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=man&p=".$curPage, false);
}

/* Save visitor */
function save_item()
{
	global $d, $func, $curPage;

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=man&p=".$curPage, false);

	$id = htmlspecialchars($_POST['id']);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;

		if(isset($_POST['tags_group']) && ($_POST['tags_group'] != '')) $data['id_tags'] = implode(",", $_POST['tags_group']);
		else $data['id_tags'] = "";
	}

	/* Kiểm tra username */
	$username = isset($data['username']) ? $data['username'] : '';
	$check_username = $d->rawQueryOne("select id from #_member where username = ? and id <> ? limit 0,1",array($username, $id));
	if(!empty($check_username)) $func->transfer("Tên đăng nhập này đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=man&p=".$curPage, false);

	/* Kiểm tra username */
	$email = isset($data['email']) ? $data['email'] : '';
	$check_email = $d->rawQueryOne("select id from #_member where email = ? and id <> ? limit 0,1",array($email, $id));
	if(!empty($check_email)) $func->transfer("Tên đăng nhập này đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=man&p=".$curPage, false);

	/* Kiểm tra username */
	$dienthoai = isset($data['dienthoai']) ? $data['dienthoai'] : '';
	$check_dienthoai = $d->rawQueryOne("select id from #_member where dienthoai = ? and id <> ? limit 0,1",array($dienthoai, $id));
	if(!empty($check_dienthoai)) $func->transfer("Tên đăng nhập này đã tồn tại. Xin chọn tên khác", "index.php?com=user&act=man&p=".$curPage, false);


	if($id)
	{
		if($func->check_permission())
		{
			$row = $d->rawQueryOne("select id from #_member where id = ? limit 0,1",array($id));
			if(isset($row['id']) && $row['id'] > 0) $func->transfer("Bạn không có quyền trên tài khoản này. Mọi thắc mắc xin liên hệ quản trị website", "index.php?com=user&act=man&p=".$curPage, false);
		}

		if(isset($data['password']) && ($data['password'] != ''))
		{
			$password = $data['password'];
			$confirm_password = (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] : '';

			if($confirm_password == '')
			{
				$func->transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=edit&id=".$id."&p=".$curPage, false);
			}

			if($password != $confirm_password)
			{
				$func->transfer("Xác nhận mật khẩu mới không chính xác","index.php?com=user&act=edit&id=".$id."&p=".$curPage, false);
			}

			$data['password'] = md5($password);
		}
		else unset($data['password']);

		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES['file']["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", UPLOAD_USER, $file_name))
			{
				$data['avatar'] = $photo;
				$row = $d->rawQueryOne("select id, avatar from #_member where id = ? limit 0,1",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_USER.$row['avatar']);
			}
		}

		$d->where('id', $id);
		if($d->update('member',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=man&p=".$curPage);
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=man&p=".$curPage, false);
	}
	else
	{
		if(isset($data['password']) && ($data['password'] == '')) $func->transfer("Chưa nhập mật khẩu", "index.php?com=user&act=add&p=".$curPage, false);
		$data['password'] = md5($data['password']);

		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES['file']["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", UPLOAD_USER, $file_name))
			{
				$data['avatar'] = $photo;
			}
		}
		$data['ngaytao'] = time();

		if($d->insert('member',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=man&p=".$curPage);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=man&p=".$curPage, false);
	}
}

/* Delete visitor */
function delete_item()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$d->rawQuery("delete from #_member where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=man&p=".$curPage);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_member where id = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=man&p=".$curPage);
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man&p=".$curPage, false);
}

/* Edit address */
function get_address()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit&active=diachi&p=".$curPage."&id=".$user, false);

	$item = $d->rawQueryOne("select * from #_member_address where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit&active=diachi&p=".$curPage."&id=".$user, false);
}

/* save address */
function save_address()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=diachi", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$d->where('id', $id);
		if($d->update('member_address',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=diachi");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=diachi", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('member_address',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=diachi");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=diachi", false);
	}
}

/* Delete address */
function delete_address()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if($id)
	{
		$d->rawQuery("delete from #_member_address where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=diachi");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_member_address where id = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=diachi");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=diachi", false);
}

/* Edit bank */
function get_bank()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit&active=nganhang&p=".$curPage."&id=".$user, false);

	$item = $d->rawQueryOne("select * from #_member_bank where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit&active=nganhang&p=".$curPage."&id=".$user, false);
}

/* Save bank */
function save_bank()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=nganhang", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$data['ngaysua'] = time();
		$d->where('id', $id);
		if($d->update('member_bank',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=nganhang");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=nganhang", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('member_bank',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=nganhang");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=nganhang", false);
	}
}

/* Delete bank */
function delete_bank()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if($id)
	{
		$d->rawQuery("delete from #_member_bank where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=nganhang");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_member_bank where id = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=nganhang");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=nganhang", false);
}

/* Edit timeline */
function get_timeline()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit&active=trangcanhan&p=".$curPage."&id=".$user, false);

	$item = $d->rawQueryOne("select * from #_member_timeline where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit&active=trangcanhan&p=".$curPage."&id=".$user, false);
}

/* Save timeline */
function save_timeline()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$data['ngaysua'] = time();
		$d->where('id', $id);
		if($d->update('member_timeline',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('member_timeline',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan", false);
	}
}

/* Delete timeline */
function delete_timeline()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if($id)
	{
		$d->rawQuery("delete from #_member_timeline where id = ?",array($id));
		$photos = $d->rawQuery("select photo,taptin, id from #_member_photo where id_timeline = ? and type <> 1", array($id));
		foreach($photos as $photo) {
			if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
			if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
		}
		$d->rawQuery("delete from #_member_photo where id_timeline = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_member_timeline where id = ?",array($id));
			$photos = $d->rawQuery("select photo,taptin, id from #_member_photo where id_timeline = ? and type <> 1", array($id));
			foreach($photos as $photo) {
				if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
				if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
			}
			$d->rawQuery("delete from #_member_photo where id_timeline = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan", false);
}


/* Edit photo timeline */
function get_photo_timeline()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	$id_timeline = (isset($_GET['id-timeline'])) ? htmlspecialchars($_GET['id-timeline']) : 0;
	if(!$id_timeline) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan", false);
	
	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit-timeline&p=".$curPage."&id=".$id_timeline."&user=".$user, false);

	$item = $d->rawQueryOne("select * from #_member_photo where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit&p=".$curPage."&id=".$user, false);
}

/* Save photo timeline */
function save_photo_timeline()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	$id_timeline = (isset($_GET['id-timeline'])) ? htmlspecialchars($_GET['id-timeline']) : 0;
	if(!$id_timeline) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit-timeline&p=".$curPage."&id=".$id_timeline."&user=".$user, false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES["file"]["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", "../upload/user/",$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_member_photo where id = ?",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file("../upload/user/".$row['photo']);
			}
		}

		if(isset($_FILES['video-file']))
		{
			$file_name = $func->uploadName($_FILES["video-file"]["name"]);
			if($taptin = $func->uploadImage("video-file", ".mp4|.MP4", "../upload/user/",$file_name))
			{
				$data['taptin'] = $taptin;
				$row = $d->rawQueryOne("select id, taptin from #_member_photo where id = ?",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file("../upload/user/".$row['taptin']);
			}
		}
		$d->where('id', $id);
		if($d->update('member_photo',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit-timeline&p=".$curPage."&id=".$id_timeline."&user=".$user);
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit-timeline&id=".$id_timeline."&user=".$user, false);
	} else {
		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES["file"]["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", "../upload/user/",$file_name))
			{
				$data['photo'] = $photo;
			}
		}

		if(isset($_FILES['video-file']))
		{
			$file_name = $func->uploadName($_FILES["video-file"]["name"]);
			if($taptin = $func->uploadImage("video-file", ".mp4|.MP4", "../upload/user/",$file_name))
			{
				$data['taptin'] = $taptin;
			}
		}
		$data['ngaytao'] = time();
		if($d->insert('member_photo',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit-timeline&p=".$curPage."&id=".$id_timeline."&user=".$user);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit-timeline&id=".$id_timeline."&user=".$user, false);
	}
}

/* Delete photo timeline */
function delete_photo_timeline()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	$id_timeline = (isset($_GET['id-timeline'])) ? htmlspecialchars($_GET['id-timeline']) : 0;
	if(!$id_timeline) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan", false);

	if($id)
	{
		$photo = $d->rawQueryOne("select photo,taptin, id from #_member_photo where id = ?", array($id));
		if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
		if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
		$d->rawQuery("delete from #_member_photo where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit-timeline&p=".$curPage."&id=".$id_timeline."&user=".$user);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$photo = $d->rawQueryOne("select photo,taptin, id from #_member_photo where id = ?", array($id));
			if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
			if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
			$d->rawQuery("delete from #_member_photo where id = ?",array($id));
		}
		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit-timeline&p=".$curPage."&id=".$id_timeline."&user=".$user);
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=trangcanhan", false);
}

/* Edit transition */
function get_transition()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);


	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=edit&active=transition&id=".$user, false);

	$item = $d->rawQueryOne("select * from #_member_transition where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=edit&active=transition&id=".$user, false);
}

/* Save transition */
function save_transition()
{
	global $d, $func, $curPage, $login_admin, $config;

	$id = htmlspecialchars($_POST['id']);

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=transition", false);

	$member = $func->get_profile($user, "member");

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}
		$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : 0;
		if(isset($data['money'])) {
			$data['money'] = str_replace(",","",$data['money']);
			$data['first_money'] = $member['money'];
			if($data['type'] == 0) {
				$data['last_money'] = $member['money'] + $data['money'];
			} else {
				$data['last_money'] = $member['money'] - $data['money'];
				if($data['last_money'] < 0) {
					$func->transfer("Dữ liệu không hợp lệ", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=transition", false);
				}
			}
		}
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$row_detail = $d->rawQueryOne("select ghichu, money from #_member_transition where id = ?", array($id));
		$data['ngaysua'] = time();
		$action =  (isset($_POST['action'])) ? htmlspecialchars($_POST['action']) : 0;
		if($action) { 
			if($action == 1) {
				$data['first_money'] = $member['money'];
				$data['last_money'] = $member['money'] - $row_detail['money'];
			} else {
				$data['first_money'] = $member['money'];
				$data['last_money'] = $member['money'] + $row_detail['money'];
			}
		}
		$d->where('id', $id);
		if($d->update('member_transition',$data)) {
			$noidung = $_SESSION[$login_admin]['username']." cập nhật trạng thái: ".$func->get_namestatus('status',$data['id_status']);
			if($row_detail['ghichu'] != $data['ghichu']) {
				$noidung .= ". Cập nhật ghi chú: ".$data['ghichu'];
			}
			if($action) {
				if($action == 1) {
					$data_member['money'] = $member['money'] - $row_detail['money'];
					$noidung .= ". Trừ ";
				}else if($action == 2) {
					$data_member['money'] = $row_detail['money'] + $member['money'];
					$noidung .= ". Cộng ";
				}
				$d->where('id', $member['id']);
				$d->update('member',$data_member);
				$noidung .= number_format($row_detail['money'])." tài khoản người dùng";
			}
			$dataLog = [
				"id_transition" => $id,
				"noidung" => $noidung,
				"ngaytao"	=> time()
			];
			$d->insert("member_transition_log", $dataLog);
			$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit-transition&p=".$curPage."&id=".$id."&id_status=".$data['id_status']."&user=".$user);
		}
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=transition", false);
	} else {
		$data['bank'] = "Thay đổi số dư từ Admin";
		$data['ngaytao'] = time();
		$data['id_status'] = $func->get_status_by_default("status", "id", "access", "transition", $config['website']['lang-default']);
		if($d->insert('member_transition',$data)) {
			$id_insert = $d->getLastInsertId();
			$dataLog = [
				"id_transition" => $id_insert,
				"noidung" => $_SESSION[$login_admin]['username']." tạo giao dịch thành công. ".(isset($data['ghichu']) && $data['ghichu'] ? "Ghi chú: ".$data['ghichu'] : "" ),
				"ngaytao"	=> time()
			];
			$d->insert("member_transition_log", $dataLog);
			if($data['type'] == 0) {
				$data_member['money'] = $data['money'] + $member['money'];
			} else {
				$data_member['money'] = $member['money'] - $data['money'];
			}
			$d->where('id', $member['id']);
			$d->update('member',$data_member);
			$func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=transition");
		} 
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=transition", false);
	}
}

/* Delete transition */
function delete_transition()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$user = (isset($_GET['user'])) ? htmlspecialchars($_GET['user']) : 0;
	if(!$user) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=man", false);

	if($id)
	{
		$d->rawQuery("delete from #_member_transition where id = ?",array($id));
		$d->rawQuery("delete from #_member_transition_log where id_transition = ?", array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=transition");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_member_transition where id = ?",array($id));
			$d->rawQuery("delete from #_member_transition_log where id_transition = ?", array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=transition");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit&p=".$curPage."&id=".$user."&active=transition", false);
}



/* Edit admin */
function edit()
{
	global $d, $func, $curPage, $item, $config, $login_admin;

	if(!empty($_POST))
	{
		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			$data['ngaysinh'] = strtotime(str_replace("/","-",$data['ngaysinh']));
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
			if(isset($data['role'])) unset($data['role']);
			if(isset($data['money'])) unset($data['money']);

			if(isset($_POST['tags_group']) && ($_POST['tags_group'] != '')) $data['id_tags'] = implode(",", $_POST['tags_group']);
			else $data['id_tags'] = "";
		}

		/* Kiểm tra username */
		$username = $data['username'];
		$row = $d->rawQueryOne("select id from #_user where username <> ? and username = ? limit 0,1",array($_SESSION[$login_admin]['username'],$username));
		if(isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập này đã tồn tại","index.php?com=user&act=admin_edit", false);

		/* Kiểm tra username */
		$email = $data['email'];
		$row = $d->rawQueryOne("select id from #_user where email <> ? and email = ? limit 0,1",array($_SESSION[$login_admin]['email'],$email));
		if(isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập này đã tồn tại","index.php?com=user&act=admin_edit", false);

		/* Kiểm tra username */
		$dienthoai = $data['dienthoai'];
		$row = $d->rawQueryOne("select id from #_user where dienthoai <> ? and dienthoai = ? limit 0,1",array($_SESSION[$login_admin]['dienthoai'],$dienthoai));
		if(isset($row['id']) && $row['id'] > 0) $func->transfer("Tên đăng nhập này đã tồn tại","index.php?com=user&act=admin_edit", false);


		$user = $d->rawQueryOne("select * from #_user where id = ?", array($_SESSION[$login_admin]['id']));

		if(isset($data['password']) && ($data['password'] != ''))
		{
			$password = $data['password'];
			$confirm_password = (isset($_POST['confirm_password'])) ? $_POST['confirm_password'] : '';

			if($confirm_password == '')
			{
				$func->transfer("Chưa xác nhận mật khẩu mới","index.php?com=user&act=admin_edit", false);
			}

			if($password != $confirm_password)
			{
				$func->transfer("Xác nhận mật khẩu mới không chính xác","index.php?com=user&act=admin_edit", false);
			}

			$data['password'] = md5($config['website']['secret'].$password.$config['website']['salt']);
		}
		else unset($data['password']);

		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES['file']["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", UPLOAD_USER, $file_name))
			{
				$data['avatar'] = $photo;
				$row = $d->rawQueryOne("select id, avatar from #_user where id = ? limit 0,1",array($user['id']));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_USER.$row['avatar']);
			}
		}

		$d->where('id',  $_SESSION[$login_admin]['id']);
		if($d->update('user',$data)) {
			if(isset($password)) {
				session_unset();
				$func->transfer("Cập nhật dữ liệu thành công","index.php");	
			}
			$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=admin_edit");
		}
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=admin_edit", false);
	}
	if(!isset($_GET['active'])) {
		$_GET['active'] = "gioithieu";
	}
	$item = $d->rawQueryOne("select * from #_user where username = ? limit 0,1",array($_SESSION[$login_admin]['username']));
}

/* Logout admin */
function logout()
{
	global $d, $func, $login_admin;

	/* Hủy bỏ quyền */
	$data_capnhatquyen['quyen'] = '';
	$d->where('id',$_SESSION[$login_admin]['id']);
	$d->update('user',$data_capnhatquyen);

	/* Hủy bỏ login */
	unset($_SESSION[$login_admin]);
	unset($_SESSION['list_quyen']);
	$func->redirect("index.php?com=user&act=login");
}



/* Edit address */
function get_address_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=admin_edit&active=nganhang", false);

	$item = $d->rawQueryOne("select * from #_user_address where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=admin_edit&active=diachi", false);
}

/* save address */
function save_address_admin()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=diachi", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$d->where('id', $id);
		if($d->update('user_address',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=admin_edit&active=diachi");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=diachi", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('user_address',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=admin_edit&active=diachi");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=diachi", false);
	}
}

/* Delete address */
function delete_address_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$d->rawQuery("delete from #_user_address where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=admin_edit&active=diachi");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_user_address where id = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=admin_edit&active=diachi");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=diachi", false);
}

/* Edit bank */
function get_bank_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=admin_edit&active=nganhang", false);

	$item = $d->rawQueryOne("select * from #_user_bank where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=admin_edit&active=nganhang", false);
}

/* Save bank */
function save_bank_admin()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=nganhang", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$data['ngaysua'] = time();
		$d->where('id', $id);
		if($d->update('user_bank',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=admin_edit&active=nganhang");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=nganhang", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('user_bank',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=admin_edit&active=nganhang");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=nganhang", false);
	}
}

/* Delete bank */
function delete_bank_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$d->rawQuery("delete from #_user_bank where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=admin_edit&active=nganhang");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_user_bank where id = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=admin_edit&active=nganhang");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=nganhang", false);
}

/* Edit timeline */
function get_timeline_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=admin_edit&active=trangcanhan", false);

	$item = $d->rawQueryOne("select * from #_user_timeline where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=admin_edit&active=trangcanhan".$curPage, false);
}

/* Save timeline */
function save_timeline_admin()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=trangcanhan", false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$data['ngaysua'] = time();
		$d->where('id', $id);
		if($d->update('user_timeline',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=admin_edit&active=trangcanhan");
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=trangcanhan", false);
	} else {
		$data['ngaytao'] = time();
		if($d->insert('user_timeline',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=admin_edit&active=trangcanhan");
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=trangcanhan", false);
	}
}

/* Delete timeline */
function delete_timeline_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if($id)
	{
		$d->rawQuery("delete from #_user_timeline where id = ?",array($id));
		$photos = $d->rawQuery("select photo,taptin, id from #_user_photo where id_timeline = ? and type <> 1", array($id));
		foreach($photos as $photo) {
			if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
			if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
		}
		$d->rawQuery("delete from #_user_photo where id_timeline = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=admin_edit&active=trangcanhan");
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$d->rawQuery("delete from #_user_timeline where id = ?",array($id));
			$photos = $d->rawQuery("select photo,taptin, id from #_user_photo where id_timeline = ? and type <> 1", array($id));
			foreach($photos as $photo) {
				if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
				if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
			}
			$d->rawQuery("delete from #_user_photo where id_timeline = ?",array($id));
		}

		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=admin_edit&active=trangcanhan");
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=trangcanhan", false);
}


/* Edit photo timeline */
function get_photo_timeline_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=admin_edit&active=trangcanhan", false);

	$item = $d->rawQueryOne("select * from #_user_photo where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=admin_edit&active=trangcanhan", false);
}

/* Save photo timeline */
function save_photo_timeline_admin()
{
	global $d, $func, $curPage;

	$id = htmlspecialchars($_POST['id']);

	$id_timeline = (isset($_GET['id-timeline'])) ? htmlspecialchars($_GET['id-timeline']) : 0;
	if(!$id_timeline) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=trangcanhan", false);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=edit-timeline-admin&id=".$id_timeline, false);

	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}

		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES["file"]["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", "../upload/user/",$file_name))
			{
				$data['photo'] = $photo;
				$row = $d->rawQueryOne("select id, photo from #_user_photo where id = ?",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file("../upload/user/".$row['photo']);
			}
		}

		if(isset($_FILES['video-file']))
		{
			$file_name = $func->uploadName($_FILES["video-file"]["name"]);
			if($taptin = $func->uploadImage("video-file", ".mp4|.MP4", "../upload/user/",$file_name))
			{
				$data['taptin'] = $taptin;
				$row = $d->rawQueryOne("select id, taptin from #_user_photo where id = ?",array($id));
				if(isset($row['id']) && $row['id'] > 0) $func->delete_file("../upload/user/".$row['taptin']);
			}
		}
		$d->where('id', $id);
		if($d->update('user_photo',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=user&act=edit-timeline-admin&id=".$id_timeline);
		else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=trangcanhan", false);
	} else {
		if(isset($_FILES['file']))
		{
			$file_name = $func->uploadName($_FILES["file"]["name"]);
			if($photo = $func->uploadImage("file", ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF", "../upload/user/",$file_name))
			{
				$data['photo'] = $photo;
			}
		}

		if(isset($_FILES['video-file']))
		{
			$file_name = $func->uploadName($_FILES["video-file"]["name"]);
			if($taptin = $func->uploadImage("video-file", ".mp4|.MP4", "../upload/user/",$file_name))
			{
				$data['taptin'] = $taptin;
			}
		}
		$data['ngaytao'] = time();
		if($d->insert('user_photo',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=edit-timeline-admin&id=".$id_timeline);
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=trangcanhan", false);
	}
}

/* Delete photo timeline */
function delete_photo_timeline_admin()
{
	global $d, $func, $curPage;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	$id_timeline = (isset($_GET['id-timeline'])) ? htmlspecialchars($_GET['id-timeline']) : 0;
	if(!$id_timeline) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=trangcanhan", false);

	if($id)
	{
		$photo = $d->rawQueryOne("select photo,taptin, id from #_user_photo where id = ?", array($id));
		if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
		if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
		$d->rawQuery("delete from #_user_photo where id = ?",array($id));
		$func->transfer("Xóa dữ liệu thành công", "index.php?com=user&act=edit-timeline-admin&id=".$id_timeline);
	}
	elseif(isset($_GET['listid']))
	{
		$listid = explode(",",$_GET['listid']);

		for($i=0;$i<count($listid);$i++)
		{
			$id = htmlspecialchars($listid[$i]);
			$photo = $d->rawQueryOne("select photo,taptin, id from #_user_photo where id = ?", array($id));
			if($photo['photo']) $func->delete_file("../upload/user/".$photo['photo']);
			if($photo['taptin']) $func->delete_file("../upload/user/".$photo['taptin']);	
			$d->rawQuery("delete from #_user_photo where id = ?",array($id));
		}
		$func->transfer("Xóa dữ liệu thành công","index.php?com=user&act=edit-timeline-admin&id=".$id_timeline);
	}
	$func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=trangcanhan", false);
}

/* Edit transition */
function get_transition_admin()
{
	global $d, $func, $curPage, $item;

	$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

	if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=user&act=admin_edit&active=transition", false);

	$item = $d->rawQueryOne("select * from #_user_transition where id = ? limit 0,1",array($id));

	if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=user&act=admin_edit&active=transition", false);
}

/* Save transition */
function save_transition_admin()
{
	global $d, $func, $curPage, $login_admin;

	$id = htmlspecialchars($_POST['id']);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=transition", false);

	$user = $func->get_profile($_SESSION[$login_admin]['id'], "user");
	
	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}
		$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : 0;
		if(isset($data['money'])) {
			$data['money'] = str_replace(",","",$data['money']);
			if($data['money'] <= 0) {
				$func->transfer("Dữ liệu không hợp lệ", "index.php?com=user&act=admin_edit&active=transition", false);
			}
			$data['first_money'] = $user['money'];
			if($data['type'] == 0) {
				$data['last_money'] = $user['money'];
			} else {
				$data['last_money'] = $user['money'] - $data['money'];
				if($data['last_money'] < 0) {
					$func->transfer("Dữ liệu không hợp lệ", "index.php?com=user&act=admin_edit&active=transition", false);
				}
			}
		}
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$func->transfer("Bạn không có quyền thực hiện thao tác này", "index.php?com=user&act=admin_edit&active=transition", false);
	} else {
		if($data['type'] == 0) {
			$data['bank'] = "Ngân hàng nhận: ".$func->get_places("news", $_POST['id_banknap']);
			if(isset($_POST['code'])) {
				$data['bank'] .= ". Nội dung: ".$_POST['code'];
			}
		}else {
			$bankrut = $d->rawQueryOne("select id_bank, chutk, stk from #_user_bank where id = ?", array($_POST['id_bankrut']));
			$data['bank'] = "Ngân hàng nhận: ".$func->get_places("news_list", $bankrut['id_bank'])." - ".$bankrut['chutk']." - ".$bankrut['stk'];
		}
		$data['ngaytao'] = time();
		if($d->insert('user_transition',$data)) {
			$id_insert = $d->getLastInsertId();
			$dataLog = [
				"id_transition" => $id_insert,
				"noidung" => $_SESSION[$login_admin]['username']." tạo giao dịch thành công. ".($data['ghichu'] ? "ghi chú: ".$data['ghichu']: ""),
				"ngaytao"	=> time()
			];
			$d->insert("user_transition_log", $dataLog);
			if($data['type'] == 1) {
				$data_user['money'] = $user['money'] - $data['money'];
				$d->where('id', $user['id']);
				$d->update('user',$data_user);
			}
			$func->transfer("Lưu dữ liệu thành công", "index.php?com=user&act=admin_edit&active=transition");
		} 
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=transition", false);
	}
}

function save_auto_transition_admin()
{
	global $d, $func, $curPage, $login_admin, $config, $config_base;

	$id = htmlspecialchars($_POST['id']);

	if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=user&act=admin_edit&active=transition", false);

	$user = $func->get_profile($_SESSION[$login_admin]['id'], "user");
	
	/* Post dữ liệu */
	$data = (isset($_POST['data'])) ? $_POST['data'] : null;
	if($data)
	{
		foreach($data as $column => $value)
		{
			$data[$column] = htmlspecialchars($value);
		}
		$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : $func->get_status_by_default("status", "id", "await", "transition", $config['website']['lang-default']);
		if(isset($data['money'])) {
			$data['money'] = str_replace(",","",$data['money']);
			if($data['money'] <= 0) {
				$func->transfer("Dữ liệu không hợp lệ", "index.php?com=user&act=admin_edit&active=transition", false);
			}
			$data['first_money'] = $user['money'];
			$data['type'] = 0;
			$data['last_money'] = $user['money'];
		}
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
	}
	
	if($id) {
		$func->transfer("Bạn không có quyền thực hiện thao tác này", "index.php?com=user&act=admin_edit&active=transition", false);
	} else {
		$data['bank'] = "Nạp tiền tự động";
		$data['ngaytao'] = time();
		if($d->insert('user_transition',$data)) {
			$id_insert = $d->getLastInsertId();
			$dataLog = [
				"id_transition" => $id_insert,
				"noidung" => $_SESSION[$login_admin]['username']." tạo giao dịch thành công. ",
				"ngaytao"	=> time()
			];
			$d->insert("user_transition_log", $dataLog);

			$func->payment_vnpay($id_insert,$data['money'],$_POST['bankCode'],$config_base."admin/index.php?com=user&act=return-auto-transition-admin");
		} 
		else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=user&act=admin_edit&active=transition", false);
	}
}

function return_auto_transition_admin()
{
	global $d, $func, $curPage, $login_admin, $config, $tele;

	$vnp_SecureHash = $_GET['vnp_SecureHash'];
	$money = htmlspecialchars($_GET['vnp_Amount']);
	$id = htmlspecialchars($_GET['vnp_TxnRef']);
	$responeCode = htmlspecialchars($_GET['vnp_ResponseCode']);

	$check_transition = $func->check_transition_vnpay($vnp_SecureHash, $money, $id, $responeCode, "user_transition");
	$transition = $d->rawQueryOne("select * from #_user_transition where id = ?", array($id));
	$user = $func->get_profile($_SESSION[$login_admin]['id'], "user");

	if ($check_transition == 00) {
		$func->transfer("Chữ ký không hợp lệ!!", "index.php?com=user&act=admin_edit&active=transition", false);
	} elseif ($check_transition == 01) {
		$func->transfer("Số dư giao dịch không chính xác! Liên hệ admin để kiểm tra lại!!", "index.php?com=user&act=admin_edit&active=transition", false);
	} elseif ($check_transition == 02) {
		$data_transition = [
			'id_status' => $func->get_status_by_default("status", "id", "access", "transition", $config['website']['lang-default']),
			'ngaysua' => time(),
			'last_money' => $transition['money'] + $user['money'],
			'ghichu'	=> "Mã giao dịch vnpay: ". htmlspecialchars($_GET['vnp_TransactionNo'])
		];
		$d->where('id', $transition['id']);
		if($d->update("user_transition", $data_transition)) {
			$dataLog = [
				'id_transition' => $transition['id'],
				'noidung'	=> $_SESSION[$login_admin]['username'].' đã thanh toán thành công. Mã giao dịch vnpay '.htmlspecialchars($_GET['vnp_TransactionNo']). '. Cộng '.number_format($transition['money']).' vào tài khoản.',
				'ngaytao'	=> time()
			];
			$d->insert("user_transition_log", $dataLog);
			$dataUser = [
				'money' => $transition['money'] + $user['money'],
			];
			$d->where('id', $user['id']);
			$d->update('user',$dataUser);
			$tele->sendMessage(date("H:i d-m-Y")." 💥 Nạp tự động thành công ".number_format($transition['money'])." 🎉");
			$func->transfer("Giao dịch thành công! Hệ thống đã cộng tiền và quay lại trong ít giây", "index.php?com=user&act=admin_edit&active=transition");
		}
	} else {
		$data_transition = [
			'id_status' => $func->get_status_by_default("status", "id", "cancel", "transition", $config['website']['lang-default']),
			'ngaysua' => time(),
			'last_money' => $transition['first_money'],
			'ghichu'	=> "Thanh toán thất bại"
		];
		$d->where('id', $transition['id']);
		if($d->update("user_transition", $data_transition)) {
			$dataLog = [
				'id_transition' => $transition['id'],
				'noidung'	=> $_SESSION[$login_admin]['username'].' đã thanh toán thất bại. Giao dịch đã bị huỷ.',
				'ngaytao'	=> time()
			];
			$d->insert("user_transition_log", $dataLog);
			$func->transfer("Giao dịch không thành công! Hệ thống đã huỷ giao dịch", "index.php?com=user&act=admin_edit&active=transition", false);
		}
	}
}

?>