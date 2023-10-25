<?php
include "ajax_config.php";

$cmd = (isset($_POST['cmd']) && $_POST['cmd'] != '') ? htmlspecialchars($_POST['cmd']) : '';
$groupName = (isset($_POST['groupName']) && $_POST['groupName'] != '') ? $_POST['groupName'] : '';
$option = (isset($_POST['option']) && $_POST['option'] != '') ? $_POST['option'] : '';
$id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
$quantity = (isset($_POST['quantity']) && $_POST['quantity'] > 0) ? htmlspecialchars($_POST['quantity']) : 1;
$code = (isset($_POST['code']) && $_POST['code'] != '') ? htmlspecialchars($_POST['code']) : '';

if(isset($_COOKIE['cart__'])) {
	$cart__ = (array) json_decode($_COOKIE['cart__']);
} else {
	$cart__ = [];
}
// setcookie("cart__", "", -60, '/');
// die();

if($cmd == "update-detail") {
	$detail = $d->rawQueryOne("select id, photo, gia, giakm, giamoi, quantity, sold, options from #_gallery where options = '".json_encode($option)."' and id_photo = $id");
	if(!empty($detail) && $detail['id']) {
		$options_match[$groupName] = $option[$groupName];
		$row = $d->rawQuery("select id, photo, options from #_gallery where JSON_CONTAINS(options, '".json_encode($options_match)."', '$') and id_photo = $id ");
		$active = [];
		foreach($row as $r) {
			$options_t = json_decode($r['options']);
			foreach($options_t as $key => $ot) {
				$active[$key][] = $options_t->{$key};
			}
		}
		unset($active[$groupName]);
		$response = [
			'type' => 1,
			'gia' => number_format($detail['gia']),
			'giamoi' => number_format($detail['giamoi']),
			'giakm' => number_format($detail['giakm']),
			'photo'	=> UPLOAD_PRODUCT_L.$detail['photo'],
			'quantity'	=> number_format($detail['quantity'] - $detail['sold']),
			'active' => $active
		];
	} else {
		$row = $d->rawQuery("select id, photo, options from #_gallery where JSON_CONTAINS(options, '".json_encode($option)."', '$') and id_photo = $id ");
		$active = [];
		foreach($row as $r) {
			$options_t = json_decode($r['options']);
			foreach($options_t as $key => $ot) {
				$active[$key][] = $options_t->{$key};
			}
		}
		unset($active[$groupName]);
		$response = [
			'type' => 2,
			'active' => $active,
			'photo' => UPLOAD_PRODUCT_L.$row[0]['photo']
		];
	}

	echo json_encode($response);
}
else if($cmd == 'add-cart' && $id > 0)
{
    if(!empty($option)) {
        $detail = $d->rawQueryOne("select id, photo, gia, giakm, giamoi, quantity, options from #_gallery where options = '".json_encode($option)."' and id_photo = $id");
    }
	if (isset($detail) && !empty($detail) && $detail['id']) {
		$cart->addtocart($cart__, $quantity, $id, $detail['id'], $option);
	} else {
		$cart->addtocart($cart__, $quantity, $id, 0, $option);
	}
}
else if($cmd == 'update-cart' && $code != '')
{
	$result = $cart->updateCart($cart__, $code, $quantity);
	echo number_format($result);
}
else if($cmd == 'delete-cart' && $code != '')
{
	$cart->remove_product($cart__,$code);
}
else if($cmd == 'total-cart')
{
    $total = $cart->get_order_total($cart__);
	$data = array(
		'sum' => number_format($total), 
        'value' => $total,
		'count' => count($cart__),
	);
	echo json_encode($data);
}
else if($cmd == 'popup-cart') { ?>
<?php if(count($cart__)) { ?> 
<?php foreach($cart__ as $item) {
    $proinfo = $cart->get_product_info($item->productid);
    $detail = [];
    if($item->detail) {
        $detail = $cart->get_detail_info($item->productid, $item->detail);
    }
    if(empty($detail)) { $item_detail = $proinfo; $photo = $proinfo['photo']; }
    else { $item_detail = $detail; $photo = $detail['photo']; }
?>
<div class="items-cart">
    <div class="img-cart">
        <img onerror="this.src='<?=THUMBS?>/120x120x2/assets/images/noimage.png';" 
        src="<?=THUMBS?>/120x120x1/<?=UPLOAD_PRODUCT_L.$item_detail['photo']?>" 
        alt="<?= $proinfo['ten'.$lang] ?>">
    </div>
    <div class="text-cart">
        <h2>
            <a href="<?= $proinfo[$sluglang] ?>" title="<?= $proinfo['ten'.$lang] ?>" class="text-split text-split-1">
                <?= $proinfo['ten'.$lang] ?>
            </a> 
        </h2>
        <p class="options-cart text-split text-split-1">
            <?= classify ?>: 
            <?php if(!empty($item->r_detail)) { ?> 
                <?php foreach($item->r_detail as $index_r => $rdt) { 
                    $r__ = $d->rawQueryOne("select ten$lang as ten from #_product_attributes where id = ? limit 0,1", array($rdt));	
                ?>  
                    <?= $index_r > 0 ? ', ' : '' ?>
                    <?= $r__['ten'] ?>
                <?php } ?>
            <?php } ?>
        </p>
        <div class="price-cart">
            <div class="gia-box">
                <p><?= $item_detail['giamoi'] ? number_format($item_detail['giamoi']) : number_format($item_detail['gia']) ?>đ</p> 
                <p class="gia-old"><?= $item_detail['giamoi'] ? number_format($item_detail['gia']) : "" ?><?= unitonly ?></p>
            </div>
            <?= $item_detail['giakm'] ? '<span>-'.$item_detail['giakm'].'%</span>' : '' ?>
        </div>
        <div class="action-cart">
            <div class="quantity-input no-radius">
                <button data-for="qty-<?= $item->code ?>" class="fas fa-minus minus-input"></button>
                <input type="number" data-code="<?= $item->code ?>" max="<?= $item_detail['quantity'] - $item_detail['sold'] ?>" name="p-cart" class="p-cart quantity-change-event qty-<?= $item->code ?>" id="qty-<?= $item->code ?>" value="<?= $item->qty ?>">
                <button data-for="qty-<?= $item->code ?>" class="fas fa-plus plus-input"></button>
            </div>
            <button class="far fa-trash-alt delete-item-cart_" data-code="<?= $item->code ?>"></button>
        </div>
    </div>
</div>
<?php } ?>
<?php } else { ?> 
    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
        <div class="cart-no-item">
            <img src="assets/images/images/cart-no-item.svg" alt="<?= nocart ?>">
            <p><?= pcart ?></p>
        </div>
    </div>
<?php } ?>
<?php } else if($cmd == 'order') { ?>
<p class="title-cart"><?= yourcart ?>:</p>
<div class="list-procart">
    <div class="procart procart-label d-flex align-items-start justify-content-between">
        <div class="pic-procart"><?= picture ?></div>
        <div class="info-procart"><?= product ?></div>
        <div class="quantity-procart">
            <p><?= quantity ?></p>
        </div>
        <div class="price-procart"><?= provisional ?></div>
    </div>

    <?php $sum = 0; foreach($cart__ as $item) {
						$proinfo = $cart->get_product_info($item->productid);
						if($item->detail) {
							$detail = $cart->get_detail_info($item->productid, $item->detail);
						}
					?>
    <div class="procart procart-<?= $item->code ?> d-flex justify-content-between">
        <div class="pic-procart">
            <a class="text-decoration-none" href="<?= $proinfo[$sluglang] ?>" target="_blank"
                title="<?= $proinfo['ten' . $lang] ?>">
                <?php if(isset($detail)) { ?>
                <img onerror="this.src='<?= THUMBS ?>/85x85x2/assets/images/noimage.png';"
                    src="<?= THUMBS ?>/85x85x1/<?= UPLOAD_PRODUCT_L . $detail['photo'] ?>"
                    alt="<?= $proinfo['ten' . $lang] ?>"></a>
            <?php } else { ?>
            <img onerror="this.src='<?= THUMBS ?>/85x85x2/assets/images/noimage.png';"
                src="<?= THUMBS ?>/85x85x1/<?= UPLOAD_PRODUCT_L . $proinfo['photo'] ?>"
                alt="<?= $proinfo['ten' . $lang] ?>"></a>
            <?php } ?>
        </div>
        <div class="info-procart">
            <h3 class="name-procart">
                <a class="text-decoration-none text-split text-split-1" href="<?= $proinfo[$sluglang] ?>"
                    target="_blank" title="<?= $proinfo['ten' . $lang] ?>"><?= $proinfo['ten' . $lang] ?></a>
            </h3>
            <div>
                <?php if(isset($detail)) {  
                            if($detail['giamoi']) {
                                $gia = $detail['giamoi'];
                            }else {
                                $gia = $detail['gia'];
                            }
                        } else { 
                            if($proinfo['giamoi']) {
                                $gia = $proinfo['giamoi'];
                            }else {
                                $gia = $proinfo['gia'];
                            }
                    } ?>
            </div>
            <div class="properties-procart">
            
                <?php foreach($item->r_detail as $index => $rdt) { 
									$r__ = $d->rawQueryOne("select ten$lang as ten from #_product_attributes where id = ? limit 0,1", array($rdt));	
								?>
                <p class="mr-2"><strong><?= $r__['ten'] ?></strong></p>
                <?php } ?>
                <p><strong><?= number_format($gia) ?></strong></p>
            </div>
        </div>
        <div class="quantity-procart">
            <div class="quantity-input order">
                <span data-for="qty-<?= $item->code ?>" class="fas fa-minus minus-input"></span>
                <input type="number" data-code="<?= $item->code ?>"
                    max="<?= isset($detail) ? $detail['quantity'] : $proinfo['quantity'] ?>" name="p-cart"
                    class="p-cart quantity-change-event qty-<?= $item->code ?>" id="qty-<?= $item->code ?>"
                    value="<?= $item->qty ?>">
                <span data-for="qty-<?= $item->code ?>" class="fas fa-plus plus-input"></span>
            </div>
        </div>
        <div class="price-procart <?= $item->code ?>"><?= number_format($gia * $item->qty) ?></div>
        <?php $sum += $gia * $item->qty; ?>
    </div>
    <?php } ?>
</div>
<div class="coupons">
    <div class="coupon-order mt-3">
        <input type="text" name="coupon" class="code_coupons" placeholder="<?= entercoupons ?>">
        <button id="apply-code"><?= apply ?></button>
    </div>
</div>
<div class="money-procart">
    <div class=" mt-1 d-flex align-items-center justify-content-between">
        <p><?= provisional ?>:</p>
        <p class="total-price load-price-temp total_cart"><?= number_format($sum); ?></p>
    </div>
    <div class="mb-3 mt-1 d-flex align-items-center justify-content-between">
        <p><?= discount ?>:</p>
        <p class="total-price load-price-coupons" data-coupons="0">0</p>
    </div>
    <div class="total-procart mt-1 d-flex align-items-center justify-content-between">
        <p><?= total ?>:</p>
        <p class="total-price load-price-total total_sum_cart"><?= number_format($sum); ?></p>
    </div>
</div>
<?php } else if($cmd=="check-coupons") {
    if(!isset($_SESSION[$login_member]['active']) || $_SESSION[$login_member]['active'] == false ) {
        $response = [
            'status' => false,
            'message' => logintocountinue
        ];
        echo json_encode($response);
    }
    if($code) {
        $coupons = $d->rawQueryOne("select * from #_coupons where code = ? and status = ?", array($code,1));
        if(empty($coupons)) {
            $response = [
                'status' => false,
                'message' => couponsnoexits
            ];
            echo json_encode($response);
        }
        if(!in_array($_SESSION[$login_member]['id'], explode(',', $coupons['id_member']))) {
            $response = [
                'status' => false,
                'message' => younotusecoupons
            ];
            echo json_encode($response);
        }
        if($coupons['quantity'] <= $coupons['used']) {
            $response = [
                'status' => false,
                'message' => couponssold
            ];
            $d->where("code", $code);
            $d->update("coupons", ['status' => 1]);
            echo json_encode($response);
        }
        $check_use = $d->rawQueryOne("select id from #_order where id_user = ? and magiamgia = ?", array($_SESSION[$login_member]['id'], $code));
        if(!empty($check_use)) {
            $response = [
                'status' => false,
                'message' => youhascoupons
            ];
            echo json_encode($response);
        }
        
        $total = $cart->get_order_total($cart__);
        if($coupons['val_type'] == 0) {
            $giam = $coupons['val'];
            $tong = $total - $giam;
            if($tong < 0) {
                $giam = $total;
                $tong = 0;
            }
            $giamformat = number_format($giam);
            $tongformat = number_format($tong);
        } else {
            $giam = $total / 100 * $coupons['val'];
            if($giam > $coupons['max']) {
                $giam = $coupons['max'];
            }
            $tong = $total - $giam;
            $giamformat = number_format($giam);
            $tongformat = number_format($tong);
        }
        $response = [
            'status' => true,
            'message' => couponss,
            'giam' => $giam,
            'giamformat' => $giamformat,
            'tong' => $tong,
            'tongformat' => $tongformat
        ];
        echo json_encode($response);
    }
} ?>