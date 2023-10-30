<?php
	include "ajax_config.php";

	if(isset($_POST['id']))
	{
		$flag = 1;
		$slug = (isset($_POST['slug'])) ? htmlspecialchars($_POST['slug']) : '';
		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
		$copy = (isset($_POST['copy'])) ? htmlspecialchars($_POST['copy']) : 0;
		$lang = (isset($_POST['lang'])) ? htmlspecialchars($_POST['lang']) : $config['website']['lang-default'];
		$where = ($id && !$copy) ? "id <> $id AND " : "";

		$table = array(
			"#_product_list",
			"#_product_cat",
			"#_product_item",
			"#_product_sub",
			"#_product_brand",
			"#_product",
			"#_news_list",
			"#_news_cat",
			"#_news_item",
			"#_news_sub",
			"#_news",
			"#_tags",
			"#_city",
			"#_district",
			"#_static",
			"#_street",
			"#_wards"
		);

		if(isset($table) && count($table) > 0)
		{
			foreach($table as $v)
			{
				$whereslug = "tenkhongdau$lang LIKE ?";
				
				$check = $d->rawQueryOne("select id from $v where $where $whereslug limit 0,1",array($slug));
				
				if(isset($check['id']) && $check['id'] > 0)
				{
					$flag = 0;
					break;
				}
			}
		}

		echo $flag;
	}
	else
	{
		echo 0;
	}
?>