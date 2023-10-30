<?php
	include "ajax_config.php";
	require_once LIBRARIES."config-type.php";

	/* Xử lý $_FILE - Path image */
	if(isset($_POST['src']))
	{
		$func->delete_file('../../'.$_POST['src']);
	}

	
?>