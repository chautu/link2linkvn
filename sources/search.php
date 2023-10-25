<?php  
	if(!defined('SOURCES')) die("Error");

	/* Tìm kiếm sản phẩm */
	if(isset($_GET['keyword']))
	{
		$tukhoa = htmlspecialchars($_GET['keyword']);
		$tukhoa = $func->changeTitle($tukhoa);

		if($tukhoa)
		{
			$where = "";
			$whereslug .= "";
			foreach($config['website']['lang'] as $lang => $key) {
				if($key > 0) { $whereslug .= "or"; };
				$whereslug .= "tenkhongdau$lang LIKE ?";
			}
			$whereslug .= "";
			$where = "type = ? and (ten$lang LIKE ? or $whereslug) and hienthi > 0";
			$params = array("san-pham","%$tukhoa%","%$tukhoa%","%$tukhoa%");

			$curPage = $get_page;
			$per_page = 20;
			$startpoint = ($curPage * $per_page) - $per_page;
			$limit = " limit ".$startpoint.",".$per_page;
			$sql = "select photo, ten$lang as ten, $sluglang, giamoi, gia, giakm, id from #_product where $where order by stt,id desc $limit";
			$product = $d->rawQuery($sql,$params);
			$sqlNum = "select count(*) as 'num' from #_product where $where order by stt,id desc";
			$count = $d->rawQueryOne($sqlNum,$params);
			$total = $count['num'];
			$url = $func->getCurrentPageURL();
			$paging = $func->pagination($total,$per_page,$curPage,$url);
		}
	}

	/* SEO */
	$seo->setSeo('title',$title_crumb);

	/* breadCrumbs */
	$breadcr->setBreadCrumbs('',$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
?>