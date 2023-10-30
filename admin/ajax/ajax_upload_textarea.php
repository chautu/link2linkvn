<?php
	include "ajax_config.php";
	require_once LIBRARIES."config-type.php";

	/* Xử lý $_FILE - Path image */
	if(isset($_FILES['file']))
	{
		$file_name = $func->uploadName($_FILES['file']['name']);
		if($photo = $func->uploadImage("file", '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF', '../'.UPLOAD_CKEDITOR,$file_name))
		{
			$data = array(
				'location' => $config_base.UPLOAD_CKEDITOR_L.$photo
			);
		} 
	}

	echo json_encode($data);
?>