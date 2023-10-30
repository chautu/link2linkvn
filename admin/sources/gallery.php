<?php
	if(!defined('SOURCES')) die("Error");

	switch($act)
	{
		case "man_photo":
			get_photos();
			$template = "gallery/man/photos";
			break;

		case "add_photo":
			$template = "gallery/man/photo_add";
			break;

		case "edit_photo":
			get_photo();
			$template = "gallery/man/photo_add";
			break;

		case "save_photo":
			save_photo();
			break;

		case "delete_photo":
			delete_photo();
			break;

		default:
			$template = "404";
	}

	/* Get photo */
	function get_photos()
	{
		global $d, $func, $curPage, $items, $paging, $type, $kind, $val, $idc, $com;
		
		$where = "id_photo = ? and com = ? and type = ? and kind = ? and val = ?";

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_gallery where $where order by stt,id desc $limit";
		$items = $d->rawQuery($sql,array($idc,$com,$type,$kind,$val));
		$sqlNum = "select count(*) as 'num' from #_gallery where $where order by stt,id desc";
		$count = $d->rawQueryOne($sqlNum,array($idc,$com,$type,$kind,$val));
		$total = $count['num'];
		$url = "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val;
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Get photo */
	function get_photo()
	{
		global $d, $func, $curPage, $item, $options, $type, $kind, $val, $idc, $com;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);

		$item = $d->rawQueryOne("select * from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? and id = ? order by stt,id desc limit 0,1",array($idc,$com,$type,$kind,$val,$id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);

		$options = json_decode($item['options'], true);
	}

	/* Save photo */
	function save_photo()
	{
		global $d, $curPage, $func, $config, $dfgallery, $type, $kind, $val, $idc, $com;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				if(is_array($value))
				{
					foreach($value as $k2 => $v2) $option[$k2] = $v2;
					$data[$column] = json_encode($option);
				}
				else
				{
					$data[$column] = htmlspecialchars($value);
				}
			}
		}
		
		$data['gia'] = (isset($data['gia']) && $data['gia'] != '') ? str_replace(",","",$data['gia']) : 0;
		$data['giamoi'] = (isset($data['giamoi']) && $data['giamoi'] != '') ? str_replace(",","",$data['giamoi']) : 0;
		$data['giakm'] = (isset($data['giakm']) && $data['giakm'] != '') ? $data['giakm'] : 0;
		$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;

		if($id)
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", $config[$com][$type][$dfgallery][$val]['img_type_photo'], "../upload/".$com."/",$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? and id = ? order by stt,id desc limit 0,1",array($idc,$com,$type,$kind,$val,$id));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file("../upload/".$com."/".$row['photo']);
				}
			}

			if(isset($_FILES['video-file']))
			{
				$file_name = $func->uploadName($_FILES["video-file"]["name"]);
				if($taptin = $func->uploadImage("video-file", $config[$com][$type][$dfgallery][$val]['file_type_photo'], "../upload/".$com."/",$file_name))
				{
					$data['taptin'] = $taptin;

					$row = $d->rawQueryOne("select id, taptin from #_gallery where id_photo = ? and com = ? and type = ? and kind = ? and val = ? and id = ? order by stt,id desc limit 0,1",array($idc,$com,$type,$kind,$val,$id));
					
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file("../upload/".$com."/".$row['taptin']);
				}
			}
			$data['ngaysua'] = time();

			$d->where('id', $id);
			$d->where('com', $com);
			$d->where('type', $type);
			$d->where('kind', $kind);
			$d->where('val', $val);
			if($d->update('gallery',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
		}
		else
		{
			if(isset($_FILES['file']))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", $config[$com][$type][$dfgallery][$val]['img_type_photo'], "../upload/".$com."/",$file_name))
				{
					$data['photo'] = $photo;
				}
			}

			if(isset($_FILES['video-file']))
			{
				$file_name = $func->uploadName($_FILES["video-file"]["name"]);
				if($taptin = $func->uploadImage("video-file", $config[$com][$type][$dfgallery][$val]['file_type_photo'], "../upload/".$com."/",$file_name))
				{
					$data['taptin'] = $taptin;
				}
			}

			$data['com'] = $com;
			$data['type'] = $type;
			$data['kind'] = $kind;
			$data['val'] = $val;
			$data['id_photo'] = $idc;
			$data['ngaytao'] = time();

			if($d->insert('gallery',$data)) {
				$func->transfer("Lưu dữ liệu thành công.", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage);
			}else {
				$func->transfer("Lưu dữ liệu thất bại", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
			}
		}
	}

	/* Delete photo */
	function delete_photo()
	{
		global $d, $curPage, $func, $type, $kind, $val, $idc, $com;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;
		
		if($id)
		{
			$row = $d->rawQueryOne("select id, photo, taptin from #_gallery where id = ? and com = ? and type = ? and kind = ? and val = ? limit 0,1",array($id,$com,$type,$kind,$val));

			if(isset($row['id']) && $row['id'] > 0)
			{
				$func->delete_file("../upload/".$com."/".$row['photo']);
				$func->delete_file("../upload/".$com."/".$row['taptin']);

				$d->rawQuery("delete from #_gallery where id = ?",array($id));

				$func->transfer("Xóa dữ liệu thành công", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "Dữ liệu không có thực", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id, photo, taptin from #_gallery where id = ? limit 0,1",array($id));

				if(isset($row['id']) && $row['id'] > 0)
				{
					$func->delete_file("../upload/".$com."/".$row['photo']);
					$func->delete_file("../upload/".$com."/".$row['taptin']);

					$d->rawQuery("delete from #_gallery where id = ? and com = ? and type = ? and kind = ? and val = ?",array($id,$com,$type,$kind,$val));
				}
			}
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage, false);
	}
?>