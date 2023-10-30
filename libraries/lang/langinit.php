<?php
	$columnarr = array(
		"title"=>'TEXT',
		"keywords"=>'TEXT',
		"description"=>'TEXT',
		"ten" => "VARCHAR(255)",
		"mota" => "LONGTEXT",
		"noidung" => "LONGTEXT",
		"tenkhongdau" => "VARCHAR(255)",
		"lang"=>"TEXT"
	);

	$columnLang = array(
		"lang"=>"TEXT"
	);
	
	function createLangInit()
	{
		global $config, $d, $columnarr, $columnLang;

		$table  = $d->rawQuery("SHOW TABLES");
		
		foreach($table as $tb) { 
			foreach($config['website']['lang'] as $klang => $vlang)
			{
				foreach($columnarr as $kcol => $vcol)
				{
					$col = $kcol.$klang;
					$rowcheck = $d->rawQueryOne("show columns from ".$tb["Tables_in_".$config['database']['dbname']]." like '".$kcol."__'");
					if($rowcheck != null) {
						$rowcol = $d->rawQueryOne("show columns from ".$tb["Tables_in_".$config['database']['dbname']]." like '$col'");
						if($rowcol==null) $d->rawQuery("alter table ".$tb["Tables_in_".$config['database']['dbname']]." add $col $vcol character set utf8 collate utf8_unicode_ci ");
					}
				}
			}
		}
		
		die("Thêm cột ngôn ngữ thành công.");
	}

	function deleteLangInit($lang)
	{
		if($lang!='')
		{
			global $config, $d, $columnarr, $columnLang;

			$table  = $d->rawQuery("SHOW TABLES");
		
			foreach($table as $tb) { 
				foreach($config['website']['lang'] as $klang => $vlang)
				{
					foreach($columnarr as $kcol => $vcol)
					{
						$col = $kcol.$lang;
						$row = $d->rawQueryOne("show columns from ".$tb["Tables_in_".$config['database']['dbname']]." like '$col'");
						if($row!=null) $d->rawQuery("alter table ".$tb["Tables_in_".$config['database']['dbname']]." drop $col");
					}
				}
			}
			die("Xóa cột ngôn ngữ thành công.");
		}
	}

	// createLangInit();
	// deleteLangInit("ha");
?>