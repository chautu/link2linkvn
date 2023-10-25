<?php
	include "ajax_config.php";
	require_once LIBRARIES."config-type.php";

	if(isset($_POST['id']))
	{
		$id = (isset($_POST['id'])) ? htmlspecialchars($_POST['id']) : 0;
		$money = (isset($_POST['money'])) ? htmlspecialchars($_POST['money']) : '100.000';

		$bank = $d->rawQueryOne("select * from #_news where id = ?", array($id));
		$banking = $d->rawQueryOne("select code from #_news_list where id = ?", array($bank['id_list']));
		$code = $func->generate_string('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',6);
	}
?>
<?php if(isset($bank)) { ?>
	<div class="info-bank">
		<div>
			<p><span><?= numberbank ?>:</span> <strong class="text-info"><?= $bank['stk'] ?></strong> <span class="ml-3 copy copyButton" data-text="<?= $bank['stk'] ?>"><i class="far fa-clipboard"></i></span></p>
			<p><span><?= userbank ?>:</span> <strong class="text-info"><?= $bank['chutk'] ?></strong></p>
			<p><span><?= bank ?>:</span> <strong class="text-info"><?= $func->get_places("news_list", $bank['id_list']) ?></strong> </span></p>
			<p><span><?= money ?>:</span> <strong class="text-info"><?= number_format($money) ?></strong> <span class="ml-3 copy copyButton" data-text="<?= $money ?>"><i class="far fa-clipboard"></i></span></p>
			<p><span><?= contentbank ?>:</span> <strong class="text-success"><?= $code ?></strong> <span class="ml-3 copy copyButton" data-text="<?= $code ?>"><i class="far fa-clipboard"></i></span></p>
		</div>
		<div class="img-qr">
		<img onerror="src='../<?=THUMBS?>/200x200x1/<?=UPLOAD_NEWS_L.$bank['photo']?>'" src="https://vietqr.co/api/generate/<?= $banking['code'] ?>/<?= $bank['stk'] ?>/VIETQR.CO/<?= $money ?>/<?= $code ?>?style=2" alt="">
		</div>
	</div>
	<div class="mt-3">
		<div><?=  nl2br($bank['motavi']) ?></div>
		<div class="form-group mt-3">
			<div class="custom-control custom-checkbox d-inline-block align-middle">
				<input type="checkbox" class="custom-control-input hienthi-checkbox" name="xacnhan" id="xacnhan" required>
				<label for="xacnhan" class="custom-control-label"></label>
			</div>
			<label for="xacnhan" class="d-inline-block align-middle mb-0 mr-2"><?= confirmbank ?></label>
		</div>
		<input type="hidden" name="code" value="<?= $code ?>">
	</div>
<?php } ?>