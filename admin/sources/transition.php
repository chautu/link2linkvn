<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active đơn hàng */
	if(!isset($config['transition']['active']) || $config['transition']['active'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Cấu hình đường dẫn trả về */
	$strUrl = "?";
	$strUrl .= (isset($_REQUEST['id_status'])) ? "&id_status=".htmlspecialchars($_REQUEST['id_status']) : "";
	$strUrl .= (isset($_REQUEST['type'])) ? "&type=".htmlspecialchars($_REQUEST['type']) : "";
	$strUrl .= (isset($_REQUEST['keyword'])) ? "&keyword=".htmlspecialchars($_REQUEST['keyword']) : "";
	$strUrl .= (isset($_REQUEST['id_member'])) ? "&id_member=".htmlspecialchars($_REQUEST['id_member']) : "";
	$strUrl .= (isset($_REQUEST['id_user'])) ? "&id_user=".htmlspecialchars($_REQUEST['id_user']) : "";

	switch($act)
	{
		case "man_mem":
			get_items_mem();
			$template = "transition_man/man/items";
			break;

		case "add_mem":
			add_item_mem();
			$template = "transition_man/man/item_add";
			break;

		case "edit_mem":
			get_item_mem();
			$template = "transition_man/man/item_edit";
			break;

		case "save_mem":
			save_item_mem();
			break;

		case "man_admin":
			get_items_admin();
			$template = "transition_man/man_admin/items";
			break;

		case "add_admin":
			add_item_admin();
			$template = "transition_man/man_admin/item_add";
			break;

		case "edit_admin":
			get_item_admin();
			$template = "transition_man/man_admin/item_edit";
			break;

		case "save_admin":
			save_item_admin();
			break;

		default:
			$template = "404";

		
	}

	/* Get transition mem */
	function get_items_mem()
	{
		global $d, $func, $curPage, $items, $paging, $config, $member;

		$where = "";

		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (#_member.username LIKE '%$keyword%' or #_member.ten LIKE '%$keyword%' or #_member_transition.ghichu LIKE '%$keyword%' or #_member_transition.bank LIKE '%$keyword%')";
		}
		if(isset($_REQUEST['id_status']))
		{
			$where .= " and #_member_transition.id_status = ".$_REQUEST['id_status'];
		}
		if(isset($_REQUEST['type']))
		{
			$where .= " and #_member_transition.type = ".$_REQUEST['type']-1;
		}
		if(isset($_REQUEST['id_member']))
		{
			$where .= " and #_member_transition.id_member = ".$_REQUEST['id_member'];
		}

		$member = $d->rawQuery("select username, id from #_member where hienthi > 0");

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select #_member_transition.*, #_member.username from #_member_transition INNER JOIN #_member ON #_member_transition.id_member = #_member.id where #_member_transition.id <> 1 $where order by #_member_transition.stt,#_member_transition.id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_member_transition INNER JOIN #_member ON #_member_transition.id_member = #_member.id where #_member_transition.id <> 1 $where order by #_member_transition.stt,#_member_transition.id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=transition&act=man_mem";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Add transition mem */
	function add_item_mem()
	{
		global $d, $func, $items;

		$items = $d->rawQuery("select * from #_member where hienthi > 0");
	}

	/* Edit transition mem */
	function get_item_mem()
	{
		global $d, $func, $item;

		$id = htmlspecialchars($_GET['id']);

		if(!$id) $func->transfer("Không nhận được dữ liệu","index.php?com=transition&act=man_mem", false);

		$item = $d->rawQueryOne("select * from #_member_transition where id = ?", array($id));
	}

	/* Save transition mem */
	function save_item_mem()
	{
		global $d, $func, $curPage, $login_admin, $config;

		$id = htmlspecialchars($_POST['id']);

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=transition&act=man_mem", false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}
			$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : 0;
			
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}
		
		if($id) {
			$row_detail = $d->rawQueryOne("select ghichu, money, id_member from #_member_transition where id = ?", array($id));
			$member = $func->get_profile($row_detail['id_member'], "member");
			if(isset($data['money'])) {
				$data['money'] = str_replace(",","",$data['money']);
				$data['first_money'] = $member['money'];
				if($data['type'] == 0) {
					$data['last_money'] = $member['money'] + $data['money'];
				} else {
					$data['last_money'] = $member['money'] - $data['money'];
					if($data['last_money'] < 0) {
						$func->transfer("Dữ liệu không hợp lệ", "index.php?com=transition&act=man_mem", false);
					}
				}
			}
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
				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=transition&act=man_mem");
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=transition&act=man_mem", false);
		} else {
			$member = $func->get_profile($data['id_member'], "member");
			if(isset($data['money'])) {
				$data['money'] = str_replace(",","",$data['money']);
				$data['first_money'] = $member['money'];
				if($data['type'] == 0) {
					$data['last_money'] = $member['money'] + $data['money'];
				} else {
					$data['last_money'] = $member['money'] - $data['money'];
					if($data['last_money'] < 0) {
						$func->transfer("Dữ liệu không hợp lệ", "index.php?com=transition&act=man_mem", false);
					}
				}
			}
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
				$func->transfer("Lưu dữ liệu thành công", "index.php?com=transition&act=man_mem");
			} 
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=transition&act=man_mem", false);
		}
	}

	/* Get transition mem */
	function get_items_admin()
	{
		global $d, $func, $curPage, $items, $paging, $config, $member;

		$where = "";

		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (#_user.username LIKE '%$keyword%' or #_user.ten LIKE '%$keyword%' or #_user_transition.ghichu LIKE '%$keyword%' or #_user_transition.bank LIKE '%$keyword%')";
		}
		if(isset($_REQUEST['id_status']))
		{
			$where .= " and #_user_transition.id_status = ".$_REQUEST['id_status'];
		}
		if(isset($_REQUEST['type']))
		{
			$where .= " and #_user_transition.type = ".$_REQUEST['type']-1;
		}
		if(isset($_REQUEST['id_user']))
		{
			$where .= " and #_user_transition.id_user = ".$_REQUEST['id_user'];
		}

		$member = $d->rawQuery("select username, id from #_user where hienthi > 0 and role = 1");

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select #_user_transition.*, #_user.username from #_user_transition INNER JOIN #_user ON #_user_transition.id_user = #_user.id where #_user_transition.id <> 1 and #_user.role = 1 $where order by #_user_transition.stt,#_user_transition.id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_user_transition INNER JOIN #_user ON #_user_transition.id_user = #_user.id where #_user_transition.id <> 1 and #_user.role = 1 $where order by #_user_transition.stt,#_user_transition.id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=transition&act=man_admin";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Add transition mem */
	function add_item_admin()
	{
		global $d, $func, $items;

		$items = $d->rawQuery("select * from #_user where hienthi > 0 and role = 1");
	}

	/* Edit transition mem */
	function get_item_admin()
	{
		global $d, $func, $item;

		$id = htmlspecialchars($_GET['id']);

		if(!$id) $func->transfer("Không nhận được dữ liệu","index.php?com=transition&act=man_admin", false);

		$item = $d->rawQueryOne("select * from #_user_transition where id = ?", array($id));
	}

	/* Save transition mem */
	function save_item_admin()
	{
		global $d, $func, $curPage, $login_admin, $config;

		$id = htmlspecialchars($_POST['id']);

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=transition&act=man_admin", false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}
			$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : 0;
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}
		
		if($id) {
			$row_detail = $d->rawQueryOne("select ghichu, money, id_user from #_user_transition where id = ?", array($id));
			$member = $func->get_profile($row_detail['id_user'], "user");
			if(isset($data['money'])) {
				$data['money'] = str_replace(",","",$data['money']);
				$data['first_money'] = $member['money'];
				if($data['type'] == 0) {
					$data['last_money'] = $member['money'] + $data['money'];
				} else {
					$data['last_money'] = $member['money'] - $data['money'];
					if($data['last_money'] < 0) {
						$func->transfer("Dữ liệu không hợp lệ", "index.php?com=transition&act=man_admin", false);
					}
				}
			}
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
				$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=transition&act=man_admin");
			}
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=transition&act=man_admin", false);
		} else {
			$member = $func->get_profile($data['id_user'], "user");
			if(isset($data['money'])) {
				$data['money'] = str_replace(",","",$data['money']);
				$data['first_money'] = $member['money'];
				if($data['type'] == 0) {
					$data['last_money'] = $member['money'] + $data['money'];
				} else {
					$data['last_money'] = $member['money'] - $data['money'];
					if($data['last_money'] < 0) {
						$func->transfer("Dữ liệu không hợp lệ", "index.php?com=transition&act=man_admin", false);
					}
				}
			}
			$data['bank'] = "Thay đổi số dư từ Admin";
			$data['ngaytao'] = time();
			$data['id_status'] = $func->get_status_by_default("status", "id", "access", "transition", $config['website']['lang-default']);
			if($d->insert('user_transition',$data)) {
				$id_insert = $d->getLastInsertId();
				$dataLog = [
					"id_transition" => $id_insert,
					"noidung" => $_SESSION[$login_admin]['username']." tạo giao dịch thành công. ".(isset($data['ghichu']) && $data['ghichu'] ? "Ghi chú: ".$data['ghichu'] : "" ),
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
				$func->transfer("Lưu dữ liệu thành công", "index.php?com=transition&act=man_admin");
			} 
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=transition&act=man_admin", false);
		}
	}
?>