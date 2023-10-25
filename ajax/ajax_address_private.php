<?php
	include "ajax_config.php";
	
	$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
	
	
	/* Tỉnh thành */
	$city = $d->rawQuery("select ten$lang as ten, id from #_city order by id asc");

	if($id) {
		$diachi = $d->rawQueryOne("select * from #_member_address where hienthi > 0 and id = ? and id_member = ?", array($id, $_SESSION[$login_member]['id']));
		$district = $d->rawQuery("select ten$lang as ten, id from #_district where id_city = ? order by id asc", array($diachi['id_city']));
		$wards = $d->rawQuery("select ten$lang as ten, id from #_wards where id_city = ? and id_district = ? order by id asc", array($diachi['id_city'], $diachi['id_district']));
	}
?>

<?php if(isset($diachi)) { ?> 
	<div class="input-group input-normal">
		<input id="ten" name="ten-order" placeholder="<?= yourname ?>" type="text" required
			value="<?= !empty($diachi['ten']) ? $diachi['ten'] : '' ?>" />
		<div class="invalid-feedback"><?= requiredyourname ?></div>
	</div>
	<div class="input-group input-normal">
		<input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="dienthoai" 
		name="dienthoai-order" placeholder="<?= yourphone ?>" required  value="<?= !empty($diachi['dienthoai']) ? $diachi['dienthoai'] : '' ?>" />
		<div class="invalid-feedback"><?= requiredyourphone ?></div>
	</div>
	<div class="input-group input-normal">
		<input id="email-profile" name="email-order" placeholder="<?= examplemail ?>" type="text" required 
		value="<?= !empty($diachi['email']) ? $diachi['email'] : '' ?>" />
		<div class="invalid-feedback"><?= requiredemail ?></div>
	</div>
	<div class="input-triple-cart w-clear mb-3">
		<div class="input-cart">
			<select class="select-city-cart custom-select select2" required id="city" name="city-order">
				<option value=""><?= city ?></option>
				<?php for ($i = 0; $i < count($city); $i++) { ?>
				<option value="<?= $city[$i]['id'] ?>" <?= (!empty($diachi['id_city']) && $diachi['id_city'] == $city[$i]['id']) ? 'selected' : '' ?>><?= $city[$i]['ten'] ?></option>
				<?php } ?>
			</select>
			<div class="invalid-feedback"><?= requiredcity ?></div>
		</div>
		<div class="input-cart">
			<select class="select-district-cart select-district custom-select select2" required id="district"
				name="district-order">
				<option value=""><?= district ?></option>
				<?php if(isset($district)) { ?> 
					<?php foreach($district as $di) { ?> 
						<option value="<?= $di['id'] ?>" <?= $di['id'] == $diachi['id_district'] ? "selected" : "" ?>><?= $di['ten'] ?></option>
					<?php } ?>
				<?php } ?>
			</select>
			<div class="invalid-feedback"><?= requireddistrict ?></div>
		</div>
		<div class="input-cart">
			<select class="select-wards-cart select-wards custom-select select2" required id="wards"
				name="wards-order">
				<option value=""><?= wards ?></option>
				<?php if(isset($wards)) { ?> 
					<?php foreach($wards as $wa) { ?> 
						<option value="<?= $wa['id'] ?>" <?= $wa['id'] == $diachi['id_wards'] ? "selected" : "" ?>><?= $wa['ten'] ?></option>
					<?php } ?>
				<?php } ?>
			</select>
			<div class="invalid-feedback"><?= requiredwards ?></div>
		</div>
	</div>
	<div class="input-group input-normal">
		<input id="diachi" name="diachi-order"  value="<?= !empty($diachi['diachi']) ? $diachi['diachi'] : '' ?>" placeholder="<?= enteraddress ?>" type="text" value="<?= !empty($row_detail['diachi']) ? $row_detail['diachi'] : '' ?>" required>
		<div class="invalid-feedback"><?= requiredaddress ?></div>
	</div>
<?php } ?>