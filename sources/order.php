<?php
if(!defined('SOURCES')) die("Error");		

/* SEO */
$seo->setSeo('title',$title_crumb);

/* breadCrumbs */
if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
$breadcrumbs = $breadcr->getBreadCrumbs();

/* Tỉnh thành */
$city = $d->rawQuery("select ten$lang as ten, id from #_city order by id asc");

/* Địa chỉ */
if(isset($_SESSION[$login_member]) && $_SESSION[$login_member]['active']==true) {
	$diachi = $d->rawQueryOne("select * from #_member_address where hienthi > 0 and macdinh = 1 and id_member = ?", array($_SESSION[$login_member]['id']));
	$diachis = $d->rawQuery("select * from #_member_address where hienthi > 0 and id_member = ?", array($_SESSION[$login_member]['id']));

	$district = $d->rawQuery("select ten$lang as ten, id from #_district where id_city = ? order by id asc", array($diachi['id_city']));
	$wards = $d->rawQuery("select ten$lang as ten, id from #_wards where id_city = ? and id_district = ? order by id asc", array($diachi['id_city'], $diachi['id_district']));
}

if(isset($_COOKIE['cart__'])) {
	$cart__ = (array) json_decode($_COOKIE['cart__']);
} else {
	$cart__ = [];
}

/* Hình thức thanh toán */
$httt = $d->rawQuery("select ten$lang as ten, mota$lang as mota, id from #_news where type = ? order by stt,id desc",array('hinh-thuc-thanh-toan'));

if(isset($_POST['thanhtoan']))
{
	/* Gán giá trị gửi email */
	$madonhang = strtoupper($func->stringRandom(6));
	$hoten = (isset($_POST['ten-order'])) ? htmlspecialchars($_POST['ten-order']) : '';
	$email = (isset($_POST['email-order'])) ? htmlspecialchars($_POST['email-order']) : '';
	$dienthoai = (isset($_POST['dienthoai-order'])) ? htmlspecialchars($_POST['dienthoai-order']) : '';
	$city = (isset($_POST['city-order'])) ? htmlspecialchars($_POST['city-order']) : 0;
	$district = (isset($_POST['district-order'])) ? htmlspecialchars($_POST['district-order']) : 0;
	$wards = (isset($_POST['wards-order'])) ? htmlspecialchars($_POST['wards-order']) : 0;
	$diachi = htmlspecialchars($_POST['diachi-order']).', '.$func->get_places("wards",$wards,$config['website']['lang-default']).', '.$func->get_places("district",$district,$config['website']['lang-default']).', '.$func->get_places("city",$city,$config['website']['lang-default']);
	$httt = (isset($_POST['payments'])) ? htmlspecialchars($_POST['payments']) : 0;
	$htttText = ($httt) ? $func->get_payments($httt, $config['website']['lang-default']) : '';
	$yeucaukhac = (isset($_POST['yeucaukhac-order'])) ? htmlspecialchars($_POST['yeucaukhac-order']) : '';
	$tamtinh = 0;
	$ship = (!empty($_POST['price-ship'])) ? htmlspecialchars($_POST['price-ship']) : 0;
	$code_coupons = (isset($_POST['coupon'])) ? htmlspecialchars($_POST['coupon']) : '';
	$val_coupons = 0;
	$total = 0;
	$ngaydangky = time();
	$tangqua = (isset($_POST['tangqua'])) ? htmlspecialchars($_POST['tangqua']) : 0;
	$tennguoigui = (isset($_POST['tennguoigui'])) ? htmlspecialchars($_POST['tennguoigui']) : 0;
	$tennguoinhan = (isset($_POST['tennguoinhan'])) ? htmlspecialchars($_POST['tennguoinhan']) : 0;
	$thongdiep = (isset($_POST['thongdiep'])) ? htmlspecialchars($_POST['thongdiep']) : 0;
	$chitietdonhang = '';

	foreach($cart__ as $key => $item) { 
		$pid = $item->productid;
		$q =  $item->qty;
		$code = $item->code;
		$detail = $item->detail;
		$r_detail = $item->r_detail;
		$proinfo = $cart->get_product_info($pid);
		if($detail) {
			$detail = $cart->get_detail_info($pid, $detail);
		}

		if(isset($detail) && $detail) {  
			$giamoi = $detail['giamoi'];
			$gia = $detail['gia'];
		} else { 
			$giamoi = $proinfo['giamoi'];
			$gia = $proinfo['gia'];
		}

		$textsm='';
		$index = 0;
		foreach($r_detail as $rdt) { 
			$r__ = $d->rawQueryOne("select ten$lang as ten from #_product_attributes where id = ? limit 0,1", array($rdt));
			if($index == 0) {
				$textsm .= $r__['ten'];
			} else {
				$textsm .= " - ".$r__['ten'];
			}
			$index = $index + 1;
		}

		if($q==0) continue;
		$chitietdonhang.='<tbody bgcolor="';
		if($key%2==0) $chitietdonhang.='#eee';
		else $chitietdonhang.='#e6e6e6';

		$chitietdonhang.='" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px"><tr>';
		$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top">';
		$chitietdonhang.='<span style="display:block;font-weight:bold">'.$proinfo['ten'.$lang].'</span>';
		if($textsm!='') $chitietdonhang.='<span style="display:block;font-size:12px">'.$textsm.'</span>';
		$chitietdonhang.='</td>';

		if($giamoi)
		{
			$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top">';
			$chitietdonhang.='<span style="display:block;color:#ff0000;">'.$func->format_money($giamoi).'</span>';
			$chitietdonhang.='<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">'.$func->format_money($gia).'</span>';
			$chitietdonhang.='</td>';
		}
		else
		{
			$chitietdonhang.='<td align="left" style="padding:3px 9px" valign="top"><span style="color:#ff0000;">'.$func->format_money($gia).'</span></td>';
		}
		$chitietdonhang.='<td align="center" style="padding:3px 9px" valign="top">'.$q.'</td>';

		if($giamoi)
		{
			$tamtinh += $giamoi*$q;
			$chitietdonhang.='<td align="right" style="padding:3px 9px" valign="top">';
			$chitietdonhang.='<span style="display:block;color:#ff0000;">'.$func->format_money($giamoi*$q).'</span>';
			$chitietdonhang.='<span style="display:block;color:#999;text-decoration:line-through;font-size:11px;">'.$func->format_money($gia*$q).'</span>';
			$chitietdonhang.='</td>';
		}
		else
		{
			$tamtinh += $gia*$q;
			$chitietdonhang.='<td align="right" style="padding:3px 9px" valign="top"><span style="color:#ff0000;">'.$func->format_money($gia*$q).'</span></td>';
		}
		$chitietdonhang.='</tr></tbody>';
	}

	
	if($code_coupons) {
		if(isset($_SESSION[$login_member]['active']) || $_SESSION[$login_member]['active'] == true ) {
			$coupons = $d->rawQueryOne("select * from #_coupons where code = ? and status = ?", array($code_coupons,1));
			if(!empty($coupons)) {
				if(in_array($_SESSION[$login_member]['id'], explode(',', $coupons['id_member']))) {
					if($coupons['quantity'] > $coupons['used']) {
						$check_use = $d->rawQueryOne("select id from #_order where id_user = ? and magiamgia = ?", array($_SESSION[$login_member]['id'], $code_coupons));
						if(empty($check_use)) {
							if($coupons['val_type'] == 0) {
								$val_coupons = $coupons['val'];
								$total = $tamtinh - $val_coupons;
								if($total < 0) {
									$val_coupons = $val_coupons;
									$total = 0;
								}
							} else {
								$val_coupons = $tamtinh / 100 * $coupons['val'];
								if($val_coupons > $coupons['max']) {
									$val_coupons = $coupons['max'];
								}
								$total = $tamtinh - $val_coupons;
							}
						}
					}
				}
			}
		}
	} else {
		$total = $tamtinh;
	}


	$chitietdonhang.='
	<tfoot style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
	<tr>
	<td align="right" colspan="3" style="padding:5px 9px">'.provisional.'</td>
	<td align="right" style="padding:5px 9px"><span>'.$func->format_money($tamtinh).'</span></td>
	</tr>';
	if($ship)
	{
		$chitietdonhang.=
		'<tr>
		<td align="right" colspan="3" style="padding:5px 9px">'.shipping.'</td>
		<td align="right" style="padding:5px 9px"><span>'.$func->format_money($ship).'</span></td>
		</tr>';
	}
	if($val_coupons)
	{
		$chitietdonhang.=
		'<tr>
		<td align="right" colspan="3" style="padding:5px 9px">'.applycoupons.' '.$code_coupons.':</td>
		<td align="right" style="padding:5px 9px"><span>'.$func->format_money($val_coupons).'</span></td>
		</tr>';
	}
	$chitietdonhang.='
	<tr bgcolor="#eee">
	<td align="right" colspan="3" style="padding:7px 9px"><strong><big>'.totalorder.'</big> </strong></td>
	<td align="right" style="padding:7px 9px"><strong><big><span>'.$func->format_money($total).'</span> </big> </strong></td>
	</tr>
	</tfoot>';

	/* Nội dung gửi email cho admin */
	$contentAdmin = '
	<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
	<tbody>
	<tr>
	<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
	<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
	<tbody>
	<tr>
	<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
	<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
	<tbody>
	<tr>
	<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
	<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
	<div style="display:flex;justify-content:space-between;align-items:center;">
	<table style="width:100%;">
	<tbody>
	<tr>
	<td>
	<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
	</td>
	<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
	</tr>
	</tbody>
	</table>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr style="background:#fff">
	<td align="left" height="auto" style="padding:15px" width="600">
	<table style="width:100%;">
	<tbody>
	<tr>
	<td>
	<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">'.welcome.'</h1>
	<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">'.titlemailorder.' '.$emailer->getEmail('company:website').'</p>
	<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">'.informationorder.' #'.$madonhang.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.day.' '.date('d',$emailer->getEmail('datesend')).' '.month.' '.date('m',$emailer->getEmail('datesend')).' '.year.' '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
	</td>
	</tr>
	<tr>
	<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<thead>
	<tr>
	<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'.billinginformation.'</th>
	<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'.deliveryaddress.'</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
	<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
	'.$dienthoai.'</td>
	<td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
	<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
	'.$diachi.'<br>
	Tel: '.$dienthoai.'</td>
	</tr>
	<tr>
	<td colspan="2" style="padding:7px 0px 0px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>'.orderpayment.': </strong> '.$htttText.'';
	if($ship)
	{
		$contentAdmin.='<br><strong>'.shipping.': </strong> '.$func->format_money($ship);
	}
	if($val_coupons)
	{
		$contentAdmin.='<br><br><strong>'.applycoupons.' '.$code_coupons.': </strong> '.$func->format_money($val_coupons);
	}
	$contentAdmin.='</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td>
	';
	if($yeucaukhac) {
		$contentAdmin .= '<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>'.otherrequirements.':</strong> <i>'.$yeucaukhac.'</i></p>';
	}
	if($tangqua) {
		$contentAdmin .= '<br> <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>'.$tennguoigui.' '.donated.' '.$tennguoinhan.':</strong> <i>'.$thongdiep.'</i></p>';
	}
	$contentAdmin .= '</td>
	</tr>
	<tr>
	<td>
	<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:'.$emailer->getEmail('color').'">'.orderdetail.'</h2>
	<table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
	<thead>
	<tr>
	<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">'.product.'</th>
	<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">'.unitprice.'</th>
	<th align="center" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px;min-width:55px;">'.quantity.'</th>
	<th align="right" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">'.provisional.'</th>
	</tr>
	</thead>
	'.$chitietdonhang.'
	</table>
	</td>
	</tr>
	<tr>
	<td>
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;margin-top:10px;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td align="center">
	<table width="600">
	<tbody>
	<tr>
	<td>
	<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">'.titlemailorder2.' '.$emailer->getEmail('company:website').'.<br>
	'.titlemainorder3.' '.$emailer->getEmail('company:website').', '.subtitlemail5.' <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> '.subtitlemail6.'<br>
	<b>'.address.':</b> '.$emailer->getEmail('company:address').'</p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>';

	/* Nội dung gửi email cho khách hàng */
	$contentCustomer = '
	<table align="center" bgcolor="#dcf0f8" border="0" cellpadding="0" cellspacing="0" style="margin:0;padding:0;background-color:#f2f2f2;width:100%!important;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px" width="100%">
	<tbody>
	<tr>
	<td align="center" style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">
	<table border="0" cellpadding="0" cellspacing="0" style="margin-top:15px" width="600">
	<tbody>
	<tr>
	<td align="center" id="m_-6357629121201466163headerImage" valign="bottom">
	<table cellpadding="0" cellspacing="0" style="border-bottom:3px solid '.$emailer->getEmail('color').';padding-bottom:10px;background-color:#fff" width="100%">
	<tbody>
	<tr>
	<td bgcolor="#FFFFFF" style="padding:0" valign="top" width="100%">
	<div style="color:#fff;background-color:f2f2f2;font-size:11px">&nbsp;</div>
	<div style="display:flex;justify-content:space-between;align-items:center;">
	<table style="width:100%;">
	<tbody>
	<tr>
	<td>
	<a href="'.$emailer->getEmail('home').'" style="border:medium none;text-decoration:none;color:#007ed3;margin:0px 0px 0px 20px" target="_blank">'.$emailer->getEmail('logo').'</a>
	</td>
	<td style="padding:15px 20px 0 0;text-align:right">'.$emailer->getEmail('social').'</td>
	</tr>
	</tbody>
	</table>
	</div>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr style="background:#fff">
	<td align="left" height="auto" style="padding:15px" width="600">
	<table style="width:100%;">
	<tbody>
	<tr>
	<td>
	<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">'.thankfororder.' '.$emailer->getEmail('company:website').'</h1>
	<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">'.notificationorder.' #'.$madonhang.' '.notificationordersub.' '.$emailer->getEmail('company:website').' '.notificationforsend.'</p>
	<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">'.informationorder.' #'.$madonhang.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.day.' '.date('d',$emailer->getEmail('datesend')).' '.month.' '.date('m',$emailer->getEmail('datesend')).' '.year.' '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
	</td>
	</tr>
	<tr>
	<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<thead>
	<tr>
	<th align="left" style="padding:6px 9px 0px 0px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'.billinginformation.'</th>
	<th align="left" style="padding:6px 0px 0px 9px;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;font-weight:bold" width="50%">'.deliveryaddress.'</th>
	</tr>
	</thead>
	<tbody>
	<tr>
	<td style="padding:3px 9px 9px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
	<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
	'.$dienthoai.'</td>
	<td style="padding:3px 0px 9px 9px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top"><span style="text-transform:capitalize">'.$hoten.'</span><br>
	<a href="mailto:'.$email.'" target="_blank">'.$email.'</a><br>
	'.$diachi.'<br>
	Tel: '.$dienthoai.'</td>
	</tr>
	<tr>
	<td colspan="2" style="padding:7px 0px 0px 0px;border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>Hình thức thanh toán: </strong> '.$htttText.'';
	if($ship)
	{
		$contentCustomer.='<br><strong>'.shipping.': </strong> '.$func->format_money($ship);
	}
	if($val_coupons)
	{
		$contentCustomer.='<br><br><strong>'.applycoupons.' '.$code_coupons.': </strong> '.$func->format_money($val_coupons);
	}
	$contentCustomer.='</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td>';
	if($yeucaukhac) {
		$contentCustomer .= '<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>'.otherrequirements.':</strong> <i>'.$yeucaukhac.'</i></p>';
	}
	if($tangqua) {
		$contentCustomer .= '<br> <p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><strong>'.$tennguoigui.' '.donated.' '.$tennguoinhan.':</strong> <i>'.$thongdiep.'</i></p>';
	}
	$contentCustomer .= '</td>
	</tr>
	<tr>
	<td>
	<h2 style="text-align:left;margin:10px 0;border-bottom:1px solid #ddd;padding-bottom:5px;font-size:13px;color:'.$emailer->getEmail('color').'">'.orderdetail.'</h2>

	<table border="0" cellpadding="0" cellspacing="0" style="background:#f5f5f5" width="100%">
	<thead>
	<tr>
	<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">'.product.'</th>
	<th align="left" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">'.unitprice.'</th>
	<th align="center" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px;min-width:55px;">'.soluong.'</th>
	<th align="right" bgcolor="'.$emailer->getEmail('color').'" style="padding:6px 9px;color:#fff;font-family:Arial,Helvetica,sans-serif;font-size:12px;line-height:14px">'.provisional.'</th>
	</tr>
	</thead>
	'.$chitietdonhang.'
	</table>
	<div style="margin:auto;text-align:center"><a href="'.$emailer->getEmail('home').'" style="display:inline-block;text-decoration:none;background-color:'.$emailer->getEmail('color').'!important;text-align:center;border-radius:3px;color:#fff;padding:5px 10px;font-size:12px;font-weight:bold;margin-top:5px" target="_blank">'.orderdetail.' '.$emailer->getEmail('company:website').'</a></div>
	</td>
	</tr>
	<tr>
	<td>&nbsp;
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">'.subtitlemail2.' <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, '.orcallhotline.' <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' '.readysupport.'.</p>
	</td>
	</tr>
	<tr>
	<td>&nbsp;
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">'.onemore.' '.$emailer->getEmail('company:website').' '.thankyou.'.</p>
	<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;text-align:right"><strong><a href="'.$emailer->getEmail('home').'" style="color:'.$emailer->getEmail('color').';text-decoration:none;font-size:14px" target="_blank">'.$emailer->getEmail('company').'</a> </strong></p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	<tr>
	<td align="center">
	<table width="600">
	<tbody>
	<tr>
	<td>
	<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">'.titlemailorder2.' '.$emailer->getEmail('company:website').'.<br>
	'.titlemainorder3.' '.$emailer->getEmail('company:website').', '.subtitlemail5.' <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> '.subtitlemail6.'<br>
	<b>'.address.':</b> '.$emailer->getEmail('company:address').'</p>
	</td>
	</tr>
	</tbody>
	</table>
	</td>
	</tr>
	</tbody>
	</table>';

	/* lưu đơn hàng */
	$data_donhang = array();
	$data_donhang['id_user'] = (isset($_SESSION[$login_member]['id'])) ? $_SESSION[$login_member]['id'] : 0;
	$data_donhang['madonhang'] = $madonhang;
	$data_donhang['magiamgia'] = $code_coupons;
	$data_donhang['hoten'] = $hoten;
	$data_donhang['dienthoai'] = $dienthoai;
	$data_donhang['diachi'] = $diachi;
	$data_donhang['email'] = $email;
	$data_donhang['httt'] = $httt;
	$data_donhang['phiship'] = $ship;
	$data_donhang['tamtinh'] = $tamtinh;
	$data_donhang['giamgia'] = $val_coupons;
	$data_donhang['tonggia'] = $total;
	$data_donhang['yeucaukhac'] = $yeucaukhac;
	$data_donhang['ngaytao'] = $ngaydangky;
	$data_donhang['tinhtrang'] = 0;
	$data_donhang['city'] = $city;
	$data_donhang['district'] = $district;
	$data_donhang['wards'] = $wards;
	$data_donhang['stt'] = 1;
	$data_donhang['guitang'] = $tangqua;
	$data_donhang['tennguoigui'] = $tennguoigui;
	$data_donhang['tennguoinhan'] = $tennguoinhan;
	$data_donhang['thongdiep'] = $thongdiep;
	$id_insert = $d->insert('order',$data_donhang);

	/* lưu đơn hàng chi tiết */
	if($id_insert)
	{
		if($data_donhang['magiamgia']) {
			$d->rawQuery("update #_coupons SET used = used + 1 WHERE code = ?", array($data_donhang['magiamgia']));
		}
		foreach($cart__ as $item) {
			$pid = $item->productid;
			$q =  $item->qty;
			$code = $item->code;
			$detail = $item->detail;
			$r_detail = $item->r_detail;
			$proinfo = $cart->get_product_info($pid);
			if($detail) {
				$detail = $cart->get_detail_info($pid, $detail);
			}

			if(isset($detail) && $detail) {  
				$giamoi = $detail['giamoi'];
				$gia = $detail['gia'];
				$photo = $detail['photo'];
			} else { 
				$giamoi = $proinfo['giamoi'];
				$gia = $proinfo['gia'];
				$photo = $proinfo['photo'];
			}

			$textsm='';
			$index = 0;
			foreach($r_detail as $rdt) { 
				$r__ = $d->rawQueryOne("select ten$lang as ten from #_product_attributes where id = ? limit 0,1", array($rdt));
				if($index == 0) {
					$textsm .= $r__['ten'];
				} else {
					$textsm .= " - ".$r__['ten'];
				}
				$index = $index + 1;
			}

			if($q==0) continue;
			$data_donhangchitiet = array();
			$data_donhangchitiet['id_product'] = $pid;
			$data_donhangchitiet['id_order'] = $id_insert;
			$data_donhangchitiet['photo'] = $photo;
			$data_donhangchitiet['ten'] = $proinfo['ten'.$lang];
			$data_donhangchitiet['code'] = $code;
			$data_donhangchitiet['attribute'] = $textsm;
			$data_donhangchitiet['gia'] = $gia;
			$data_donhangchitiet['giamoi'] = $giamoi;
			$data_donhangchitiet['soluong'] = $q;
			$d->insert('order_detail',$data_donhangchitiet);
		}
	}

	/* Send email admin */
	$arrayEmail = null;
	$subject = titlemainordersend." ".$setting['ten'.$lang];
	$message = $contentAdmin;
	$file = '';
	$emailer->sendEmail("admin", $arrayEmail, $subject, $message, $file);

	/* Send email customer */
	$arrayEmail = array(
		"dataEmail" => array(
			"name" => $hoten,
			"email" => $email
		)
	);
	$subject = titlemainordersend." ".$setting['ten'.$lang];
	$message = $contentCustomer;
	$file = '';
	$emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file);

	if($config['telegram']['active'] == true && isset($config['telegram']['active'])) {
		$message_tele = telegrammessage.'
'.date("H:i d-m-Y");
			$tele->sendMessage($message_tele);
	}

	/* Xóa giỏ hàng */
	setcookie("cart__", "", -60, '/');
	$func->transferUser(responseordersuccess, $config_base);
}
?>