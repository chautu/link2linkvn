<?php
	if(!defined('SOURCES')) die("Error");

	/* Kiểm tra active places */
	if(!isset($config['places']['active']) || $config['places']['active'] == false) $func->transfer("Trang không tồn tại", "index.php", false);

	/* Cấu hình đường dẫn trả về */
	$strUrl = "";
	$strUrl .= (isset($_REQUEST['id_city'])) ? "&id_city=".htmlspecialchars($_REQUEST['id_city']) : "";
	$strUrl .= (isset($_REQUEST['id_district'])) ? "&id_district=".htmlspecialchars($_REQUEST['id_district']) : "";
	$strUrl .= (isset($_REQUEST['id_wards'])) ? "&id_wards=".htmlspecialchars($_REQUEST['id_wards']) : "";
	$strUrl .= (isset($_REQUEST['id_street'])) ? "&id_street=".htmlspecialchars($_REQUEST['id_street']) : "";
	$strUrl .= (isset($_REQUEST['keyword'])) ? "&keyword=".htmlspecialchars($_REQUEST['keyword']) : "";

	switch($act)
	{
		/* City */
		case "man_city":
			get_citys();
			$template = "places/city/items";
			break;
		case "add_city":		
			$template = "places/city/item_add";
			break;
		case "edit_city":		
			get_city();
			$template = "places/city/item_add";
			break;
		case "save_city":
			save_city();
			break;
		case "delete_city":
			delete_city();
			break;

		/* District */
		case "man_district":
			get_districts();
			$template = "places/district/items";
			break;
		case "add_district":		
			$template = "places/district/item_add";
			break;
		case "edit_district":		
			get_district();
			$template = "places/district/item_add";
			break;
		case "save_district":
			save_district();
			break;
		case "delete_district":
			delete_district();
			break;

		/* Wards */
		case "man_wards":
			get_wardss();
			$template = "places/wards/items";
			break;
		case "add_wards":		
			$template = "places/wards/item_add";
			break;
		case "edit_wards":		
			get_wards();
			$template = "places/wards/item_add";
			break;
		case "save_wards":
			save_wards();
			break;
		case "delete_wards":
			delete_wards();
			break;

		/* Street */
		case "man_street":
			get_streets();
			$template = "places/street/items";
			break;
		case "add_street":		
			$template = "places/street/item_add";
			break;
		case "edit_street":		
			get_street();
			$template = "places/street/item_add";
			break;
		case "save_street":
			save_street();
			break;
		case "delete_street":
			delete_street();
			break;

		default:
			$template = "404";
	}

	/* Get list */
	function get_citys()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $config;
		
		$where = "";

		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (ten".$config['website']['lang-default']." LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_city where id<>0 $where order by stt,id asc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_city where id<>0 $where order by stt,id asc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=places".$strUrl."&act=man_city";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit list */
	function get_city()
	{
		global $d, $strUrl, $func, $curPage, $item;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_city&p=".$curPage.$strUrl, false);

		$item = $d->rawQueryOne("select * from #_city where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=places&act=man_city&p=".$curPage.$strUrl, false);
	}

	/* Save list */
	function save_city()
	{
		global $d, $func, $strUrl, $curPage, $config;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_city&p=".$curPage.$strUrl, false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			foreach($config['website']['lang'] as $lang => $key) {
				if(isset($_POST["slug$lang"])) $data["tenkhongdau$lang"] = $func->changeTitle(htmlspecialchars($_POST["slug$lang"]));
				else $data["tenkhongdau$lang"] = (isset($data["ten$lang"])) ? $func->changeTitle($data["ten$lang"]) : '';
			}
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}

		$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
		if($dataSeo)
		{
			foreach($dataSeo as $column => $value)
			{
				$dataSeo[$column] = htmlspecialchars($value);
			}
		}

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_PLACES,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_city where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_PLACES.$row['photo']);
				}
			}
			$data['ngaysua'] = time();

			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,'city','man','city'));

			$dataSeo['idmuc'] = $id;
			$dataSeo['com'] = 'city';
			$dataSeo['act'] = 'man';
			$dataSeo['type'] = 'city';
			$d->insert('seo',$dataSeo);

			$d->where('id', $id);
			if($d->update('city',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=places&act=man_city&p=".$curPage.$strUrl);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=places&act=man_city&p=".$curPage.$strUrl, false);
		}
		else
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_PLACES,$file_name))
				{
					$data['photo'] = $photo;
				}
			}
			$data['ngaytao'] = time();
			
			if($d->insert('city',$data)) {
				
				$id_insert = $d->getLastInsertId();
				$dataSeo['idmuc'] = $id_insert;
				$dataSeo['com'] = 'city';
				$dataSeo['act'] = 'man';
				$dataSeo['type'] = 'city';
				$d->insert('seo',$dataSeo);

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=places&act=man_city&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=places&act=man_city&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete list */
	function delete_city()
	{
		global $d, $func, $strUrl, $curPage;
		
		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$row = $d->rawQueryOne("select id, photo from #_city where id = ? limit 0,1",array($id));

			if(isset($row['id']) && $row['id'] > 0)
			{
				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,"city",'man',"city"));

				$func->delete_file(UPLOAD_PLACES.$row['photo']);
				$d->rawQuery("delete from #_city where id = ?",array($id));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=places&act=man_city&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=places&act=man_city&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);

				$row = $d->rawQueryOne("select id, photo from #_city where id = ? limit 0,1",array($id));

				if(isset($row['id']) && $row['id'] > 0) {

					/* Xóa SEO */
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,"city",'man',"city"));

					$func->delete_file(UPLOAD_PLACES.$row['photo']);
					$d->rawQuery("delete from #_city where id = ?",array($id));
				}
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=places&act=man_city&p=".$curPage.$strUrl);
		}
		$func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_city&p=".$curPage.$strUrl, false);
	}

	/* Get cat */
	function get_districts()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $config;
		
		$where = "";

		$id_city = (isset($_REQUEST['id_city'])) ? htmlspecialchars($_REQUEST['id_city']) : 0;

		if($id_city) $where .= " and id_city=$id_city";
		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (ten".$config['website']['lang-default']." LIKE '%$keyword%')";
		}
	
		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_district where id<>0 $where order by stt,id asc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_district where id<>0 $where order by stt,id asc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=places".$strUrl."&act=man_district";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit cat */
	function get_district()
	{
		global $d, $func, $strUrl, $curPage, $item;
		
		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_district&p=".$curPage.$strUrl, false);
		
		$item = $d->rawQueryOne("select * from #_district where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=places&act=man_district&p=".$curPage.$strUrl, false);
	}

	/* Save cat */
	function save_district()
	{
		global $d, $func, $strUrl, $curPage, $config;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_district&p=".$curPage.$strUrl, false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			foreach($config['website']['lang'] as $lang => $key) {
				if(isset($_POST["slug$lang"])) $data["tenkhongdau$lang"] = $func->changeTitle(htmlspecialchars($_POST["slug$lang"]));
				else $data["tenkhongdau$lang"] = (isset($data["ten$lang"])) ? $func->changeTitle($data["ten$lang"]) : '';
			}
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}

		$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
		if($dataSeo)
		{
			foreach($dataSeo as $column => $value)
			{
				$dataSeo[$column] = htmlspecialchars($value);
			}
		}

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_PLACES,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_district where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_PLACES.$row['photo']);
				}
			}
			$data['ngaysua'] = time();

			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,'district','man','district'));

			$dataSeo['idmuc'] = $id;
			$dataSeo['com'] = 'district';
			$dataSeo['act'] = 'man';
			$dataSeo['type'] = 'district';
			$d->insert('seo',$dataSeo);
			
			$d->where('id', $id);
			if($d->update('district',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=places&act=man_district&p=".$curPage.$strUrl);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=places&act=man_district&p=".$curPage.$strUrl, false);
		}
		else
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_PLACES,$file_name))
				{
					$data['photo'] = $photo;
				}
			}
			$data['ngaytao'] = time();
			
			if($d->insert('district',$data)) {
				
				$id_insert = $d->getLastInsertId();
				$dataSeo['idmuc'] = $id_insert;
				$dataSeo['com'] = 'district';
				$dataSeo['act'] = 'man';
				$dataSeo['type'] = 'district';
				$d->insert('seo',$dataSeo);

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=places&act=man_district&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=places&act=man_district&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete cat */
	function delete_district()
	{
		global $d, $func, $strUrl, $curPage;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$row = $d->rawQueryOne("select id, photo from #_district where id = ? limit 0,1",array($id));

			if(isset($row['id']) && $row['id'] > 0)
			{
				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,"district",'man',"district"));

				$func->delete_file(UPLOAD_PLACES.$row['photo']);
				$d->rawQuery("delete from #_district where id = ?",array($id));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=places&act=man_district&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=places&act=man_district&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id, photo from #_district where id = ? limit 0,1",array($id));

				if(isset($row['id']) && $row['id'] > 0) {
					/* Xóa SEO */
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,"district",'man',"district"));

					$func->delete_file(UPLOAD_PLACES.$row['photo']);
					$d->rawQuery("delete from #_district where id = ?",array($id));
				} 
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=places&act=man_district&p=".$curPage.$strUrl);
		}
		$func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_district&p=".$curPage.$strUrl, false);
	}

	/* Get item */
	function get_wardss()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $config;
		
		$where = "";

		$id_city = (isset($_REQUEST['id_city'])) ? htmlspecialchars($_REQUEST['id_city']) : 0;
		$id_district = (isset($_REQUEST['id_district'])) ? htmlspecialchars($_REQUEST['id_district']) : 0;

		if($id_city) $where .= " and id_city=$id_city";
		if($id_district) $where .= " and id_district=$id_district";
		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (ten".$config['website']['lang-default']." LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_wards where id<>0 $where order by stt,id asc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_wards where id<>0 $where order by stt,id asc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=places".$strUrl."&act=man_wards";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit item */
	function get_wards()
	{
		global $d, $func, $strUrl, $curPage, $item;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl, false);
		
		$item = $d->rawQueryOne("select * from #_wards where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl, false);
	}

	/* Save item */
	function save_wards()
	{
		global $d, $func, $strUrl, $curPage, $config;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl, false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			foreach($config['website']['lang'] as $lang => $key) {
				if(isset($_POST["slug$lang"])) $data["tenkhongdau$lang"] = $func->changeTitle(htmlspecialchars($_POST["slug$lang"]));
				else $data["tenkhongdau$lang"] = (isset($data["ten$lang"])) ? $func->changeTitle($data["ten$lang"]) : '';
			}
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}

		$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
		if($dataSeo)
		{
			foreach($dataSeo as $column => $value)
			{
				$dataSeo[$column] = htmlspecialchars($value);
			}
		}


		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_PLACES,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_wards where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_PLACES.$row['photo']);
				}
			}
			$data['ngaysua'] = time();

			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,'wards','man','wards'));

			$dataSeo['idmuc'] = $id;
			$dataSeo['com'] = 'wards';
			$dataSeo['act'] = 'man';
			$dataSeo['type'] = 'wards';
			$d->insert('seo',$dataSeo);
			
			$d->where('id', $id);
			if($d->update('wards',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl, false);
		}
		else
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_PLACES,$file_name))
				{
					$data['photo'] = $photo;
				}
			}
			$data['ngaytao'] = time();
			
			if($d->insert('wards',$data)) {
				
				$id_insert = $d->getLastInsertId();
				$dataSeo['idmuc'] = $id_insert;
				$dataSeo['com'] = 'wards';
				$dataSeo['act'] = 'man';
				$dataSeo['type'] = 'wards';
				$d->insert('seo',$dataSeo);

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete item */
	function delete_wards()
	{
		global $d, $func, $strUrl, $curPage;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$row = $d->rawQueryOne("select id, photo from #_wards where id = ? limit 0,1",array($id));

			if(isset($row['id']) && $row['id'] > 0)
			{
				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,"wards",'man',"wards"));

				$func->delete_file(UPLOAD_PLACES.$row['photo']);
				$d->rawQuery("delete from #_wards where id = ?",array($id));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id, photo from #_wards where id = ? limit 0,1",array($id));

				if(isset($row['id']) && $row['id'] > 0) {
					/* Xóa SEO */
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,"wards",'man',"wards"));

					$func->delete_file(UPLOAD_PLACES.$row['photo']);
					$d->rawQuery("delete from #_wards where id = ?",array($id));
				} 
			}

			$func->transfer("Xóa dữ liệu thành công", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_wards&p=".$curPage.$strUrl, false);
	}

	/* Get sub */
	function get_streets()
	{
		global $d, $func, $strUrl, $curPage, $items, $paging, $config;
		
		$where = "";

		$id_city = (isset($_REQUEST['id_city'])) ? htmlspecialchars($_REQUEST['id_city']) : 0;
		$id_district = (isset($_REQUEST['id_district'])) ? htmlspecialchars($_REQUEST['id_district']) : 0;
		$id_wards = (isset($_REQUEST['id_wards'])) ? htmlspecialchars($_REQUEST['id_wards']) : 0;

		if($id_city) $where .= " and id_city=$id_city";
		if($id_district) $where .= " and id_district=$id_district";
		if($id_wards) $where .= " and id_wards=$id_wards";
		if(isset($_REQUEST['keyword']))
		{
			$keyword = htmlspecialchars($_REQUEST['keyword']);
			$where .= " and (ten".$config['website']['lang-default']." LIKE '%$keyword%')";
		}

		$per_page = 10;
		$startpoint = ($curPage * $per_page) - $per_page;
		$limit = " limit ".$startpoint.",".$per_page;
		$sql = "select * from #_street where id<>0 $where order by stt,id asc $limit";
		$items = $d->rawQuery($sql);
		$sqlNum = "select count(*) as 'num' from #_street where id<>0 $where order by stt,id asc";
		$count = $d->rawQueryOne($sqlNum);
		$total = $count['num'];
		$url = "index.php?com=places".$strUrl."&act=man_street";
		$paging = $func->pagination($total,$per_page,$curPage,$url);
	}

	/* Edit sub */
	function get_street()
	{
		global $d, $func, $strUrl, $curPage, $item;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if(!$id) $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_street&p=".$curPage.$strUrl, false);
		
		$item = $d->rawQueryOne("select * from #_street where id = ? limit 0,1",array($id));

		if(!$item['id']) $func->transfer("Dữ liệu không có thực", "index.php?com=places&act=man_street&p=".$curPage.$strUrl, false);
	}

	/* Save sub */
	function save_street()
	{
		global $d, $func, $strUrl, $curPage, $config;

		if(empty($_POST)) $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_street&p=".$curPage.$strUrl, false);

		/* Post dữ liệu */
		$data = (isset($_POST['data'])) ? $_POST['data'] : null;
		if($data)
		{
			foreach($data as $column => $value)
			{
				$data[$column] = htmlspecialchars($value);
			}

			foreach($config['website']['lang'] as $lang => $key) {
				if(isset($_POST["slug$lang"])) $data["tenkhongdau$lang"] = $func->changeTitle(htmlspecialchars($_POST["slug$lang"]));
				else $data["tenkhongdau$lang"] = (isset($data["ten$lang"])) ? $func->changeTitle($data["ten$lang"]) : '';
			}
			$data['hienthi'] = (isset($data['hienthi'])) ? 1 : 0;
		}

		$dataSeo = (isset($_POST['dataSeo'])) ? $_POST['dataSeo'] : null;
		if($dataSeo)
		{
			foreach($dataSeo as $column => $value)
			{
				$dataSeo[$column] = htmlspecialchars($value);
			}
		}

		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;

		if($id)
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_PLACES,$file_name))
				{
					$data['photo'] = $photo;
					$row = $d->rawQueryOne("select id, photo from #_street where id = ? and type = ? limit 0,1",array($id,$type));
					if(isset($row['id']) && $row['id'] > 0) $func->delete_file(UPLOAD_PLACES.$row['photo']);
				}
			}
			$data['ngaysua'] = time();

			$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,'street','man','street'));

			$dataSeo['idmuc'] = $id;
			$dataSeo['com'] = 'street';
			$dataSeo['act'] = 'man';
			$dataSeo['type'] = 'street';
			$d->insert('seo',$dataSeo);
			
			$d->where('id', $id);
			if($d->update('street',$data)) $func->transfer("Cập nhật dữ liệu thành công", "index.php?com=places&act=man_street&p=".$curPage.$strUrl);
			else $func->transfer("Cập nhật dữ liệu bị lỗi", "index.php?com=places&act=man_street&p=".$curPage.$strUrl, false);
		}
		else
		{
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', UPLOAD_PLACES,$file_name))
				{
					$data['photo'] = $photo;
				}
			}
			$data['ngaytao'] = time();
			
			if($d->insert('street',$data)) {
				
				$id_insert = $d->getLastInsertId();
				$dataSeo['idmuc'] = $id_insert;
				$dataSeo['com'] = 'street';
				$dataSeo['act'] = 'man';
				$dataSeo['type'] = 'street';
				$d->insert('seo',$dataSeo);

				$func->transfer("Lưu dữ liệu thành công", "index.php?com=places&act=man_street&p=".$curPage.$strUrl);
			}
			else $func->transfer("Lưu dữ liệu bị lỗi", "index.php?com=places&act=man_street&p=".$curPage.$strUrl, false);
		}
	}

	/* Delete sub */
	function delete_street()
	{
		global $d, $func, $strUrl, $curPage;

		$id = (isset($_GET['id'])) ? htmlspecialchars($_GET['id']) : 0;

		if($id)
		{
			$row = $d->rawQueryOne("select id, photo from #_street where id = ? limit 0,1",array($id));

			if(isset($row['id']) && $row['id'] > 0)
			{
				/* Xóa SEO */
				$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,"street",'man',"street"));

				$func->delete_file(UPLOAD_PLACES.$row['photo']);
				$d->rawQuery("delete from #_street where id = ?",array($id));
				$func->transfer("Xóa dữ liệu thành công", "index.php?com=places&act=man_street&p=".$curPage.$strUrl);
			}
			else $func->transfer("Xóa dữ liệu bị lỗi", "index.php?com=places&act=man_street&p=".$curPage.$strUrl, false);
		}
		elseif(isset($_GET['listid']))
		{
			$listid = explode(",",$_GET['listid']);

			for($i=0;$i<count($listid);$i++)
			{
				$id = htmlspecialchars($listid[$i]);
				$row = $d->rawQueryOne("select id from #_street where id = ? limit 0,1",array($id));

				
				if(isset($row['id']) && $row['id'] > 0) {
					/* Xóa SEO */
					$d->rawQuery("delete from #_seo where idmuc = ? and com = ? and act = ? and type = ?",array($id,"street",'man',"street"));

					$func->delete_file(UPLOAD_PLACES.$row['photo']);
					$d->rawQuery("delete from #_street where id = ?",array($id));
				} 
			}
			
			$func->transfer("Xóa dữ liệu thành công", "index.php?com=places&act=man_street&p=".$curPage.$strUrl);
		}
		else $func->transfer("Không nhận được dữ liệu", "index.php?com=places&act=man_street&p=".$curPage.$strUrl, false);
	}
?>