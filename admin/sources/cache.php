<?php	
	if(!defined('SOURCES')) die("Error");

	switch($act)
	{
		case "delete":
			deleteCache();
			break;

		default:
			$template = "404";
	}

	/* Delete cache */
	function deleteCache()
	{
		global $func, $cache, $d;

		$albums = $d->rawQuery("select id, photo, taptin from #_member_photo where id_timeline = ?", array(0));
		foreach($albums as $alb) {
			if($alb['photo']) {
				$func->delete_file(UPLOAD_USER.$alb['photo']);
			}
			if($alb['taptin']) {
				$func->delete_file(UPLOAD_USER.$alb['taptin']);
			}
		}
		$d->rawQuery("delete from #_member_photo where id_timeline = ?",array(0));

		if($cache->DeleteCache()) $func->transfer("Xóa cache thành công", "index.php");
		else $func->transfer("Xóa cache thất bại", "index.php", false);
	}
?>