<?php
	include "ajax_config.php";
	
	$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
	$table = (isset($_POST['table']) && $_POST['table'] > 0) ? htmlspecialchars($_POST['table']) : "";
	if($id) {
		$check = $d->rawQueryOne("select id from #_$table where id = ? and id_member = ?", array($id, $_SESSION[$login_member]['id']));
		if(!empty($check)) {
			$d->rawQuery("delete from #_$table WHERE id = ?", array($id));
		}
	}
?>
