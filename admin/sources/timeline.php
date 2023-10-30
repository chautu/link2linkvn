<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active đơn hàng */
	if(!isset($config['timeline']['active']) || $config['timeline']['active'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

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
			$template = "timeline_man/man/items";
			break;

		case "edit_mem":
			get_item_mem();
			$template = "timeline_man/man/item_edit";
			break;

		case "save_mem":
			save_item_mem();
			break;

		case "man_admin":
			get_items_admin();
			$template = "timeline_man/man_admin/items";
			break;

		case "edit_admin":
			get_item_admin();
			$template = "timeline_man/man_admin/item_edit";
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
			$where .= " and (#_member.username LIKE '%$keyword%' or #_member.ten LIKE '%$keyword%' or #_member_timeline.ten LIKE '%$keyword%' or #_member_timeline.noidung LIKE '%$keyword%')";
		}
		if(isset($_REQUEST['id_status']))
		{
			$where .= " and #_member_timeline.id_status = ".$_REQUEST['id_status'];
		}
		
		if(isset($_REQUEST['id_member']))
		{
			$where .= " and #_member_timeline.id_member = ".$_REQUEST['id_member'];
		}

		$member = $d->rawQuery("select username, id, email from #_member where hienthi > 0");

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select #_member_timeline.*, #_member.username, #_member.email from #_member_timeline INNER JOIN #_member ON #_member_timeline.id_member = #_member.id where #_member_timeline.id <> 1 $where order by #_member_timeline.stt,#_member_timeline.id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_member_timeline INNER JOIN #_member ON #_member_timeline.id_member = #_member.id where #_member_timeline.id <> 1 $where";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=timeline&act=man_mem";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit transition mem */
	function get_item_mem()
	{
		global $d, $func, $item;

		$id = htmlspecialchars($_GET['id']);

		if(!$id) $func->transfer("Không nhận được dữ liệu","index.php?com=timeline&act=man_mem", false);

		$item = $d->rawQueryOne("select * from #_member_timeline where id = ?", array($id));
	}

	/* Save transition mem */
	function save_item_mem()
	{
		global $d, $func, $curPage, $login_admin, $config;

		$id = htmlspecialchars($_POST['id']);

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=timeline&act=man_mem", false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}
			$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : 0;
		}
		
		if($id) {
			$data['ngaysua'] = time();
			$d->where('id', $id);
			if($d->update('member_timeline',$data))	$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=timeline&act=man_mem");
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=timeline&act=man_mem", false);
		} else {
			$data['ngaytao'] = time();
			if($d->insert('member_timeline',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=timeline&act=man_mem");
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=timeline&act=man_mem", false);
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
			$where .= " and (#_user.username LIKE '%$keyword%' or #_user.ten LIKE '%$keyword%' or #_user_timeline.ten LIKE '%$keyword%' or #_user_timeline.noidung LIKE '%$keyword%')";
		}
		if(isset($_REQUEST['id_status']))
		{
			$where .= " and #_user_timeline.id_status = ".$_REQUEST['id_status'];
		}
		
		if(isset($_REQUEST['id_user']))
		{
			$where .= " and #_user_timeline.id_user = ".$_REQUEST['id_user'];
		}

		$member = $d->rawQuery("select username, id from #_user where hienthi > 0 and role = 1");

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select #_user_timeline.*, #_user.username from #_user_timeline INNER JOIN #_user ON #_user_timeline.id_user = #_user.id where #_user_timeline.id <> 1 and #_user.role = 1 $where order by #_user_timeline.stt,#_user_timeline.id desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_user_timeline INNER JOIN #_user ON #_user_timeline.id_user = #_user.id where #_user_timeline.id <> 1 and #_user.role = 1 $where order by #_user_timeline.stt,#_user_timeline.id desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=timeline&act=man_admin";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit transition mem */
	function get_item_admin()
	{
		global $d, $func, $item;

		$id = htmlspecialchars($_GET['id']);

		if(!$id) $func->transfer("Không nhận được dữ liệu","index.php?com=timeline&act=man_admin", false);

		$item = $d->rawQueryOne("select * from #_user_timeline where id = ?", array($id));
	}

	/* Save transition mem */
	function save_item_admin()
	{
		global $d, $func, $curPage, $login_admin, $config;

		$id = htmlspecialchars($_POST['id']);

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu","index.php?com=timeline&act=man_admin", false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}
			$data['id_status'] = (isset($data['id_status'])) ? $data['id_status'] : 0;
		}
		
		if($id) {
			$data['ngaysua'] = time();
			$d->where('id', $id);
			if($d->update('user_timeline',$data))	$func->transfer("Cập nhật dữ liệu thành công", "index.php?com=timeline&act=man_admin");
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=timeline&act=man_admin", false);
		} else {
			$data['ngaytao'] = time();
			if($d->insert('user_timeline',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=timeline&act=man_admin");
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=timeline&act=man_admin", false);
		}
	}
?>