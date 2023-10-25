<?php
	include "ajax_config.php";
	
	$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
	$act = (isset($_POST['act']) && $_POST['act']) ? htmlspecialchars($_POST['act']) : "";

	if($act == "member_bank") {
		if($id) {
			$row_detail = $d->rawQueryOne("select * from #_$act where id = ?", array($id));	
		}
		$nganhangs = $d->rawQuery("select ten$lang as ten, id from #_news_list where type = ? and hienthi > 0 order by stt, id desc", array("bank"));
		?> 
		<form class="form-user form-nomarl validation-user no-overflow" novalidate method="post">
			<h3><?= addbank ?></h3>
			
			<div class="input-group input-normal">
				<label for="stk"><?= numberbank ?>:</label>
				<input id="stk" name="stk" placeholder="<?= enternumberbank ?>" value="<?= isset($row_detail) ? $row_detail['stk'] : "" ?>" type="text" required>
				<div class="invalid-feedback"><?= requirednumberbank ?></div>
			</div>
			<div class="input-group input-normal">
				<label for="chutk"><?= userbank ?>:</label>
				<input id="chutk" name="chutk" value="<?= isset($row_detail) ? $row_detail['chutk'] : "" ?>" placeholder="<?= enteruserbank ?>" type="text" required>
				<div class="invalid-feedback"><?= requiredenteruserbank ?></div>
			</div>
			<div>
				<label for="id_bank"><?= checkbank ?>:</label>
				<select class="multiselect banking" data-class="checkbank" id="id_bank" name="id_bank" required>
					<option value="" disabled="" selected="" hidden=""><?= checkbank ?></option>';
					<?php foreach($nganhangs as $nganhang) { ?> 
						<option value="<?= $nganhang['id'] ?>" <?= isset($row_detail) && $row_detail['id_bank'] == $nganhang['id'] ? "selected" : "" ?>><?= $nganhang['ten'] ?></option>
					<?php } ?>
				</select>
				<div class="invalid-feedback"><?= requiredcheckbank ?></div>
			</div>
			
			<div class="no-select checkbox-tagqua">
				<input type="checkbox" name="macdinh" id="macdinh" <?= isset($row_detail) && !empty($row_detail) && $row_detail['macdinh'] ? 'checked' : '' ?> value="1">
				<label for="macdinh"><?= checkbankdefault ?></label>
			</div>
			<div class="d-flex justify-content-end">
				<input type="hidden" name="id" value="<?= isset($row_detail) && !empty($row_detail) ? $row_detail['id'] : '' ?>">
				<input type="submit" class="default-button" name="save" value="<?= save ?>" disabled />
			</div>
		</form>	
	<?php 
	} else if($act == 'member_address') { 
		$city = $d->rawQuery("select ten$lang as ten, id from #_city where hienthi > 0 order by stt, id desc");
		if($id) {
			$row_detail = $d->rawQueryOne("select * from #_member_address where id_member = ? and id = ?",array($_SESSION[$login_member]['id'], $id));
			$district = $d->rawQuery("select ten$lang as ten, id from #_district where id_city = ?", array($row_detail['id_city']));
			$wards = $d->rawQuery("select ten$lang as ten, id from #_wards where id_city = ? and id_district = ?", array($row_detail['id_city'], $row_detail['id_district']));
		}
		?> 
		<form class="form-user  form-nomarl validation-user no-overflow" novalidate method="post">
			<h3><?= addaddress ?></h3>
			<div class="main-form no-scrollbar">
				<div class="grid grid-2 gap-10 user-profile">
					<div class="input-group input-normal">
						<label for="ten-address"><?= yourname ?>:</label>
						<input id="ten-address" name="ten-address" value="<?= isset($row_detail) ? $row_detail['ten'] : "" ?>" placeholder="<?= enteryourname ?>" type="text" required>
						<div class="invalid-feedback"><?= requiredyourname ?></div>
					</div>
					<div class="input-group input-normal">
						<label for="dienthoai-address"><?= yourphone ?>: </label>
						<input type="text" <?= isset($row_detail) ? $row_detail['dienthoai'] : "" ?> oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="dienthoai-address" name="dienthoai-address" placeholder="<?= enteryourphone ?>" required />
						<div class="invalid-feedback"><?= requiredyourphone ?></div>
					</div>
				</div>
				<div class="input-group input-normal">
					<label for="email-address"><?= email ?>:</label>
					<input id="email-address" <?= isset($row_detail) ? $row_detail['email'] : "" ?> name="email-address" placeholder="<?= examplemail ?>" type="text" required>
					<div class="invalid-feedback"><?= requiredemail ?></div>
				</div>
				<div class="grid grid-2 gap-10 user-profile">
					<div class="input-normal">
						<label for="id_city"><?= city ?>:</label>
						<select class="select2 select-city-cart" id="id_city" name="id_city" required>
							<option value="" disabled="" selected="" hidden=""><?= city ?></option>';
							<?php foreach($city as $c) { ?>
								<option value="<?= $c['id'] ?>" <?= (isset($row_detail) && !empty($row_detail['id_city']) && $row_detail['id_city'] == $c['id']) ? 'selected' : '' ?>><?= $c['ten'] ?></option>
							<?php } ?>
						</select>
						<div class="invalid-feedback"><?= requiredcity ?></div>
					</div>
					<div class="input-normal">
						<label for="id_district"><?= district ?>:</label>
						<select class="select2 select-district-cart select-district" id="id_district" name="id_district" required>
							<option value="" disabled="" selected="" hidden=""><?= district ?></option>';
							<?php if(isset($district)) { ?> 
								<?php foreach($district as $di) { ?> 
									<option value="<?= $di['id'] ?>" <?= $di['id'] == $row_detail['id_district'] ? "selected" : "" ?>><?= $di['ten'] ?></option>
								<?php } ?>
							<?php } ?>
						</select>
						<div class="invalid-feedback"><?= requireddistrict ?></div>
					</div>
					<div class="input-normal">
						<label for="id_wards"><?= wards ?>:</label>
						<select class="select2 select-wards-cart select-wards" id="id_wards" name="id_wards" required>
							<option value="" disabled="" selected="" hidden=""><?= wards ?></option>
							<?php if(isset($wards)) { ?> 
								<?php foreach($wards as $wa) { ?> 
									<option value="<?= $wa['id'] ?>" <?= $wa['id'] == $row_detail['id_wards'] ? "selected" : "" ?>><?= $wa['ten'] ?></option>
								<?php } ?>
							<?php } ?>
						</select>
						<div class="invalid-feedback"><?= requiredwards ?></div>
					</div>
				</div>
			
				<div class="input-group input-normal">
					<label for="diachi"><?= address ?>:</label>
					<input id="diachi" name="diachi" placeholder="<?= enteraddress ?>" type="text" value="<?= isset($row_detail) ? $row_detail['diachi'] : '' ?>" required>
					<div class="invalid-feedback"><?= requiredaddress ?></div>
				</div>
				<div class="no-select checkbox-tagqua mt-2">
					<input type="checkbox" name="macdinh" id="macdinh" <?= isset($row_detail) && !empty($row_detail) && $row_detail['macdinh'] ? 'checked' : '' ?> value="1">
					<label for="macdinh"><?= checkaddressdefault ?></label>
				</div>
			</div>
			<div class="d-flex justify-content-end">
				<input type="hidden" name="id" value="<?= isset($row_detail) && !empty($row_detail) ? $row_detail['id'] : '' ?>">
				<input type="submit" class="default-button" name="save" value="<?= save ?>" disabled />
			</div>
		</form>	
		<?php 
	} else if($act == "member_timeline") { 
		if($id) {
			$row_detail = $d->rawQueryOne("select id,noidung from #_member_timeline where id = ? and id_member = ?", array($id, $_SESSION[$login_member]['id']));
			$list_file = $d->rawQuery("select * from #_member_photo where id_timeline = ?", array($row_detail['id']));
		}
		?> 
		<form class="form-user form-nomarl validation-user no-overflow" novalidate method="post" enctype="multipart/form-data">
			<h3><?= addtimeline ?></h3>
			<div class="main-form no-scrollbar">
				<?php $hash =  $func->generateHash() ?>
				<div class="input-normal">
					<textarea class="nguyennhieucme" name="noidung-timeline" cols="10" rows="10" required placeholder="<?= placehothertimeline ?>">
						<?= isset($row_detail) ? htmlspecialchars_decode($row_detail['noidung']) : "" ?>
					</textarea>
					<div class="invalid-feedback"><?= requiredtimeline ?></div>
				</div>
				<div class="container-upload-file">
					<?php if(isset($list_file) && count($list_file)) { ?> 
						<div class="container-photo-timeline grid<?= count($list_file) == 1 ? "1" : (count($list_file) == 2 ? "2" : (count($list_file) == 3 ? "3" : (count($list_file) == 4 ? "2" : "5"))) ?>">
							<?php foreach($list_file as $key => $file) { ?>
								<?php if($key < 5) { ?> 
									<?php if($file['type'] == 0) { ?> 
										<div class="img-photo <?= $key == 4 && count($list_file) - 5 > 0 ? "active" : "" ?>" data-plus="+ <?= count($list_file) - 5 ?>">
											<img src="<?= THUMBS ?>/680x620x1/<?= UPLOAD_USER_L.$file['photo'] ?>" alt="<?= $file['mota'] ?>">
										</div>    
									<?php } else if($file['type'] == 2) { ?> 
										<div class="img-photo <?= $key == 4 && count($list_file) - 5 > 0 ? "active" : "" ?>" data-plus="+ <?= count($list_file) - 5 ?>">
											<video id="myVideo" controls loop data-autoplay>
												<source src="<?= UPLOAD_USER_L.$file['taptin'] ?>" type="video/mp4">
											</video>
										</div> 
									<?php } ?>
								<?php } ?> 
							<?php } ?>
							<div class="edit-photo-timeline" data-id="<?= $row_detail['id'] ?>" data-hash="<?= $hash ?>">
								<i class="fas fa-pen"></i>
								<p><?= edit ?></p> 
							</div>
						</div>
					<?php } ?>
				</div>
				<div class="timeline-add">
					<p class="no-select"><?= addcontenttimeline ?></p>
					<div class="input-file">
						<input type="file" name="upload_file[]"  id="upload_file" data-id="<?= isset($row_detail) ? $row_detail['id'] : 0 ?>" data-hash="<?= $hash ?>" multiple>
						<label for="upload_file" title="Ảnh và video" id="upload-file-timeline"><i class="fas fa-camera"></i></label>
					</div>
				</div>
			</div>
			<div class="d-flex justify-content-end mt-3">
				<input type="hidden" name="id" value="<?= isset($row_detail) ? $row_detail['id'] : 0 ?>">
				<input type="hidden" value="<?= $hash ?>" name="hash" class="hash_post">
				<input type="submit" class="default-button w-100" name="save-timeline" value="<?= submit ?>" disabled />
			</div>
		</form>	
	<?php
	} else if($act == "update_noibat") { 
		$noibat = (isset($_POST['noibat']) && $_POST['noibat']) ? 1 : 0;
		$row_detail = $d->rawQueryOne("select #_member_photo.id,#_member_photo.type,#_member_photo.photo,
		#_member_photo.taptin from 
		#_member_photo INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id
		where #_member_photo.id = ? and #_member_timeline.id_member = ?", array($id, $_SESSION[$login_member]['id']));
		if(!empty($row_detail)) {
			$data_update = [
				"noibat" => $noibat
			];
			$d->where("id", $row_detail['id']);
			$d->update("member_photo", $data_update);
		}
	} else if($act == "popup-photo") { 
		$hash = (isset($_POST['hash']) && $_POST['hash']) ? htmlspecialchars($_POST['hash']) : "";
		if($id) {
			$row_detail = $d->rawQueryOne("select id,noidung from #_member_timeline where id = ? and id_member = ?", array($id, $_SESSION[$login_member]['id']));
			$id = $row_detail['id'];
			$hash = "null";
		}
		$list_file = $d->rawQuery("select * from #_member_photo where id_timeline = ? and hash = ?", array($row_detail['id'], $hash));	
	?> 
		<div class="edit-photo no-scrollbar">
			<h4 id="modals-photo-active" class="hidden" data-id="<?= $id ?>" data-hash="<?= $hash ?>"></h4>
			<h3><?= capnhathinhanh ?></h3>
			<div class="container-update-img">
				<?php foreach($list_file as $file) { ?> 
					<?php if($file['type'] == 0) { ?> 
					<div class="img-editphoto no-select" id="box-photo-<?= $file['id'] ?>">
						<img src="<?= THUMBS ?>/680x620x1/<?= UPLOAD_USER_L.$file['photo'] ?>" alt="<?= $file['mota'] ?>">
						<div class="editname">
							<input type="text" class="change-noidungphoto" name="noidung-photo-<?= $file['id'] ?>" data-act="update-photo" data-id="<?= $file['id'] ?>" id="noidung-photo-<?= $file['id'] ?>" placeholder="<?= content ?>" value="<?= $file['mota'] ?>">
						</div>
						<div class="remove-photo" data-box="box-photo-<?= $file['id'] ?>" data-id="<?= $file['id'] ?>">
							<i class="fas fa-times"></i>
						</div>
					</div>
					<?php } else if($file['type'] == 2) { ?> 
					<div class="img-editphoto no-select" id="box-photo-<?= $file['id'] ?>">
						<video id="myVideo" controls loop data-autoplay>
                            <source src="<?= UPLOAD_USER_L.$file['taptin'] ?>" type="video/mp4">
                        </video>
						<div class="editname">
							<input type="text" class="change-noidungphoto" name="noidung-photo-<?= $file['id'] ?>" data-act="update-photo" data-id="<?= $file['id'] ?>" id="noidung-photo-<?= $file['id'] ?>" placeholder="<?= content ?>" value="<?= $file['mota'] ?>">
						</div>
						<div class="remove-photo" data-box="box-photo-<?= $file['id'] ?>" data-id="<?= $file['id'] ?>">
							<i class="fas fa-times"></i>
						</div>
					</div>	
					<?php } ?>
				<?php } ?>
			</div>
		</div>
		<div class="footer-edit">
			<div class="d-flex justify-content-center">
				<button class="default-button" class="close" data-dismiss="modal" aria-label="Close" id="checkout-photo" name="save-photo"><?= update ?></button>
			</div>
		</div>
	<?php } else if($act == "update-photo") { 
		$value = (isset($_POST['value']) && $_POST['value']) ? htmlspecialchars($_POST['value']) : "";
		if($id) {
			$data_photo = [
				"mota" => $value
			];
			$d->where("id", $id);
			if($d->update("member_photo", $data_photo)) {
				$response = [
					"status" => 3827,
				];
			} else {
				$response = [
					"status" => 7366,
				];
			}
			echo json_encode($response);
			die();
		}
	} else if($act == "delete-photo") {
		$row_detail = $d->rawQueryOne("select #_member_photo.id,#_member_photo.type,#_member_photo.photo,
		#_member_photo.taptin from 
		#_member_photo INNER JOIN #_member_timeline ON #_member_photo.id_timeline = #_member_timeline.id
		where #_member_photo.id = ? and #_member_timeline.id_member = ?", array($id, $_SESSION[$login_member]['id']));
		if(!empty($row_detail)) {
			if($row_detail['type'] == 0) {
				$func->delete_file(UPLOAD_USER.$row_detail['photo']);
			} else if($row_detail['type'] == 2) {
				$func->delete_file(UPLOAD_USER.$row_detail['taptin']);
			}
			$d->rawQuery("delete from #_member_photo where id = ?",array($id));
		}
	} else if($act == "delete-timeline") {
		$row_detail = $d->rawQueryOne("select id from #_member_timeline where id = ? and id_member = ?", array($id, $_SESSION[$login_member]['id']));
		if(!empty($row_detail['id'])) {
			$file = $d->rawQuery("select id, photo, taptin, type from #_member_photo where id_timeline = ?", array($row_detail['id']));
			foreach($file as $f) {
				if($f['type'] == 0) {
					$func->delete_file(UPLOAD_USER.$f['photo']);
				} else if($f['type'] == 2) {
					$func->delete_file(UPLOAD_USER.$f['taptin']);
				}
				$d->rawQuery("delete from #_member_photo where id = ?",array($f['id']));
			}
			$d->rawQuery("delete from #_member_timeline where id = ?", array($row_detail['id']));
		}
	}
?>
