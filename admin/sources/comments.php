<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active đơn hàng */
	if(!isset($config['comments']['active']) || $config['comments']['active'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Cấu hình đường dẫn trả về */
	$strUrl = "";
	$strUrl .= (isset($_REQUEST['keyword'])) ? "&keyword=".htmlspecialchars($_REQUEST['keyword']) : "";

	switch($act)
	{
		case "man":
			get_items();
			$template = "comments/man/items";
			break;

		case "add":
			add_item();
			$template = "comments/man/item_add";
			break;

		case "edit":
			get_item();
			$template = "comments/man/item_add";
			break;

		case "save":
			save_item();
			break;

		case "delete":
			delete_item();
			break;

		default:
			$template = "404";
	}

	/* Get order */
	function get_items()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $lang;
		
		$where = "";

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_comments where id<>0 $where order by ngaytao desc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_comments where id<>0 $where order by ngaytao desc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=comments&act=man".$strUrl;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Add order */
	function add_item()
	{
		global $d, $func, $curPage, $item, $config, $members, $products;
		$members = $d->rawQuery("select id, email from #_member order by stt, id desc");
		$products = $d->rawQuery("select id, ten".$config['website']['lang-default']." as ten from #_product order by stt, id desc");
	}

	/* Edit order */
	function get_item()
	{
		global $d, $func, $curPage, $item, $config, $members, $products;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=comments&act=man&p=".$curPage, false);
		
		$item = $d->rawQueryOne("select * from #_comments where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=comments&act=man&p=".$curPage, false);

		$members = $d->rawQuery("select id, email from #_member order by stt, id desc");
		$products = $d->rawQuery("select id, ten".$config['website']['lang-default']." as ten from #_product order by stt, id desc");
	}

	/* Save order */
	function save_item()
	{
		global $d, $func, $curPage;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=comments&act=man&p=".$curPage, false);

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
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
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG', UPLOAD_PHOTO,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_comments where id = ? limit 0,1",array($id));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_PHOTO.$row['photo']);
				}
			}
			$d->where('id', $id);
			if($d->update('comments',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=comments&act=man&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=comments&act=man&p=".$curPage, false);
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES['file']["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG', UPLOAD_PHOTO,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_comments where id = ? limit 0,1",array($id));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_PHOTO.$row['photo']);
				}
			}
			$data['ngaytao'] = time();
			if($d->insert('comments',$data)) $func->transfer("Lưu dữ liệu thành công", "index.php?com=comments&act=man&p=".$curPage);
		}
	}

	/* Delete order */
	function delete_item()
	{
		global $d, $func, $curPage;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$row = $d->rawQueryOne("select id, photo from #_comments where id = ? limit 0,1",array($id));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file(UPLOAD_PHOTO.$row['photo']);
				$d->rawQuery("delete from #_comments where id = ?",array($id));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=comments&act=man&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=comments&act=man&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);
			
			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id, photo from #_comments where id = ? limit 0,1",array($id));

				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file(UPLOAD_PHOTO.$row['photo']);
					$d->rawQuery("delete from #_comments where id = ?",array($id));
				}
			}
			
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=comments&act=man&p=".$curPage);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=comments&act=man&p=".$curPage, false);
	}
?>