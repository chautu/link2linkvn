<?php 
	if(!defined('SOURCES')) die("Error");

	if(isset($_POST['save-contact']))
	{
        $responseCaptcha = $_POST['recaptcha_response_contact'];
        $resultCaptcha = $func->checkRecaptcha($responseCaptcha);
        $scoreCaptcha = (isset($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
        $actionCaptcha = (isset($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
        $testCaptcha = (isset($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;

        if(($scoreCaptcha >= 0.5 && $actionCaptcha == 'contact') || $testCaptcha == true)
		{
			$data = array();
			
			if(isset($_FILES["file"]))
			{
				$file_name = $func->uploadName($_FILES["file"]["name"]);
				if($file = $func->uploadImage("file", 'doc|docx|pdf|rar|zip|ppt|pptx|DOC|DOCX|PDF|RAR|ZIP|PPT|PPTX|xls|xlsx|jpg|png|gif|JPG|PNG|GIF', UPLOAD_FILE_L, $file_name))
				{
					$data['taptin'] = $file;
				}
			}

		    $data['ten'] = (isset($_POST['ten-contact']) && $_POST['ten-contact'] != '') ? htmlspecialchars($_POST['ten-contact']) : '';
		    $data['diachi'] = (isset($_POST['diachi']) && $_POST['diachi'] != '') ? htmlspecialchars($_POST['diachi']) : '';
		    $data['dienthoai'] = (isset($_POST['dienthoai-contact']) && $_POST['dienthoai-contact'] != '') ? htmlspecialchars($_POST['dienthoai-contact']) : '';
			$data['email'] = (isset($_POST['email-contact']) && $_POST['email-contact'] != '') ? htmlspecialchars($_POST['email-contact']) : '';
		    $data['tieude'] = (isset($_POST['tieude']) && $_POST['tieude'] != '') ? htmlspecialchars($_POST['tieude']) : '';
		    $data['noidung'] = (isset($_POST['chude-contact']) && $_POST['chude-contact'] != '') ? htmlspecialchars($_POST['chude-contact']) : '';
		    $data['ngaytao'] = time(); 
		    $data['stt'] = 1;
		    $d->insert('contact',$data);
			
		    /* Gán giá trị gửi email */
		    $strThongtin = '';
		    $emailer->setEmail('tennguoigui',$data['ten']);
		    $emailer->setEmail('emailnguoigui',$data['email']);
		    $emailer->setEmail('dienthoainguoigui',$data['dienthoai']);
		    $emailer->setEmail('diachinguoigui',$data['diachi']);
		    $emailer->setEmail('tieudelienhe',$data['tieude']);
		    $emailer->setEmail('noidunglienhe',$data['noidung']);
		    if($emailer->getEmail('tennguoigui'))
		    {
		    	$strThongtin .= '<span style="text-transform:capitalize">'.$emailer->getEmail('tennguoigui').'</span><br>';
		    }
		    if($emailer->getEmail('emailnguoigui'))
		    {
		    	$strThongtin .= '<a href="mailto:'.$emailer->getEmail('emailnguoigui').'" target="_blank">'.$emailer->getEmail('emailnguoigui').'</a><br>';
		    }
		    if($emailer->getEmail('diachinguoigui'))
		    {
		    	$strThongtin .= ''.$emailer->getEmail('diachinguoigui').'<br>';
		    }
		    if($emailer->getEmail('dienthoainguoigui'))
		    {
		    	$strThongtin .= 'Tel: '.$emailer->getEmail('dienthoainguoigui').'';
		    }
		    $emailer->setEmail('thongtin',$strThongtin);

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
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr style="background:#fff">
										<td align="left" height="auto" style="padding:15px" width="600">
											<table>
												<tbody>
													<tr>
														<td>
															<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">'.welcome.'</h1>
															<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">'.mailtitle1.' <span style="text-transform:capitalize">'.$emailer->getEmail('tennguoigui').'</span> '.subtitlemail1.' '.$emailer->getEmail('company:website').'.</p>
															<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">'.contactinfo.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.day.' '.date('d',$emailer->getEmail('datesend')).' '.month.' '.date('m',$emailer->getEmail('datesend')).' '.year.' '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
														</td>
													</tr>
												<tr>
												<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding:3px 0px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">'.$emailer->getEmail('thongtin').'</td>
														</tr>
														<tr>
															<td colspan="2" style="border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">&nbsp;
															<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;margin-top:0"><strong>'.title.': </strong> '.$emailer->getEmail('tieudelienhe').'<br>
															</td>
														</tr>
													</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td>
												<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>'.$emailer->getEmail('noidunglienhe').'</i></p>
												</td>
											</tr>
											<tr>
												<td>&nbsp;
													<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">'.subtitlemail2.' <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, '.orcallhotline.' <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' '.readysupport.'</p>
												</td>
											</tr>
											<tr>
												<td>&nbsp;
												<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;margin:0;padding:0;line-height:18px;color:#444;font-weight:bold">'.onemore.' '.$emailer->getEmail('company:website').' '.thankyou.'</p>
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
									<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">'.subtitlemail3.' '.$emailer->getEmail('company:website').'.<br>
									'.subtitlemail4.' '.$emailer->getEmail('company:website').', '.subtitlemail5.' <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> '.subtitlemail6.'<br>
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
														</td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
									<tr style="background:#fff">
										<td align="left" height="auto" style="padding:15px" width="600">
											<table>
												<tbody>
													<tr>
														<td>
															<h1 style="font-size:17px;font-weight:bold;color:#444;padding:0 0 5px 0;margin:0">'.welcomeyou.'</h1>
															<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal">'.subtitlemail7.' '.$emailer->getEmail('company:website').' '.subtitlemail8.'</p>
															<h3 style="font-size:13px;font-weight:bold;color:'.$emailer->getEmail('color').';text-transform:uppercase;margin:20px 0 0 0;padding: 0 0 5px;border-bottom:1px solid #ddd">'.contactinfo.' <span style="font-size:12px;color:#777;text-transform:none;font-weight:normal">('.day.' '.date('d',$emailer->getEmail('datesend')).' '.month.' '.date('m',$emailer->getEmail('datesend')).' '.year.' '.date('Y H:i:s',$emailer->getEmail('datesend')).')</span></h3>
														</td>
													</tr>
												<tr>
												<td style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px">
												<table border="0" cellpadding="0" cellspacing="0" width="100%">
													<tbody>
														<tr>
															<td style="padding:3px 0px;border-top:0;border-left:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal" valign="top">'.$emailer->getEmail('thongtin').'</td>
														</tr>
														<tr>
															<td colspan="2" style="border-top:0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444" valign="top">&nbsp;
															<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;margin-top:0"><strong>'.title.': </strong> '.$emailer->getEmail('tieudelienhe').'<br>
															</td>
														</tr>
													</tbody>
												</table>
												</td>
											</tr>
											<tr>
												<td>
												<p style="margin:4px 0;font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal"><i>'.$emailer->getEmail('noidunglienhe').'</i></p>
												</td>
											</tr>
											<tr>
												<td>&nbsp;
													<p style="font-family:Arial,Helvetica,sans-serif;font-size:12px;color:#444;line-height:18px;font-weight:normal;border:1px '.$emailer->getEmail('color').' dashed;padding:10px;list-style-type:none">'.subtitlemail2.' <a href="mailto:'.$emailer->getEmail('company:email').'" style="color:'.$emailer->getEmail('color').';text-decoration:none" target="_blank"> <strong>'.$emailer->getEmail('company:email').'</strong> </a>, '.orcallhotline.' <strong style="color:'.$emailer->getEmail('color').'">'.$emailer->getEmail('company:hotline').'</strong> '.$emailer->getEmail('company:worktime').'. '.$emailer->getEmail('company:website').' '.readysupport.'</p>
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
									<p align="left" style="font-family:Arial,Helvetica,sans-serif;font-size:11px;line-height:18px;color:#4b8da5;padding:10px 0;margin:0px;font-weight:normal">'.subtitlemail3.' '.$emailer->getEmail('company:website').'.<br>
									'.subtitlemail4.' '.$emailer->getEmail('company:website').', '.subtitlemail5.' <strong><a href="mailto:'.$emailer->getEmail('email').'" target="_blank">'.$emailer->getEmail('email').'</a></strong> '.subtitlemail6.'<br>
									<b>'.address.':</b> '.$emailer->getEmail('company:address').'</p>
									</td>
								</tr>
							</tbody>
						</table>
						</td>
					</tr>
				</tbody>
			</table>';

			/* Send email admin */
			$arrayEmail = null;
			$subject = titlesendmail." ".$setting['ten'.$lang];
			$message = $contentAdmin;
			$file = 'file';

			if($emailer->sendEmail("admin", $arrayEmail, $subject, $message, $file))
			{
				/* Send email customer */
				$arrayEmail = array(
					"dataEmail" => array(
						"name" => $emailer->getEmail('tennguoigui'),
						"email" => $emailer->getEmail('emailnguoigui')
					)
				);
				$subject = titlesendmail." ".$setting['ten'.$lang];
				$message = $contentCustomer;
				$file = 'file';

				if($emailer->sendEmail("customer", $arrayEmail, $subject, $message, $file)) $func->transferUser(sendcontactsuccess,$config_base);
			}
			else $func->transferUser(sendcontacterror,$config_base, false);
		}
		else
		{
			$func->transferUser(sendcontacterror,$config_base, false);
		}
	}

	/* SEO */
	$seopage = $d->rawQueryOne("select * from #_seopage where type = ? limit 0,1",array('lien-he'));
	$seo->setSeo('h1',$title_crumb);
	if(!empty($seopage['title'.$seolang])) $seo->setSeo('title',$seopage['title'.$seolang]);
	else $seo->setSeo('title',$title_crumb);
	if(!empty($seopage['keywords'.$seolang])) $seo->setSeo('keywords',$seopage['keywords'.$seolang]);
	if(!empty($seopage['description'.$seolang])) $seo->setSeo('description',$seopage['description'.$seolang]);
	$seo->setSeo('url',$func->getPageURL());
	$img_json_bar = (isset($seopage['options']) && $seopage['options'] != '') ? json_decode($seopage['options'],true) : null;
	if(!empty($seopage['photo']))
	{
		if($img_json_bar == null || ($img_json_bar['p'] != $seopage['photo']))
		{
			$img_json_bar = $func->getImgSize($seopage['photo'],UPLOAD_SEOPAGE_L.$seopage['photo']);
			$seo->updateSeoDB(json_encode($img_json_bar),'seopage',$seopage['id']);
		}
		$seo->setSeo('photo',$config_base.THUMBS.'/'.$img_json_bar['w'].'x'.$img_json_bar['h'].'x2/'.UPLOAD_SEOPAGE_L.$seopage['photo']);
		$seo->setSeo('photo:width',$img_json_bar['w']);
		$seo->setSeo('photo:height',$img_json_bar['h']);
		$seo->setSeo('photo:type',$img_json_bar['m']);
	}
	
    $whyus = $d->rawQueryOne("select noidung$lang as noidung from #_static where type = ? limit 0,1",array('whyus'));
    $contact = $d->rawQueryOne("select noidung$lang as noidung from #_static where type = ? limit 0,1",array('lien-he'));

	

	/* breadCrumbs */
	if(isset($title_crumb) && $title_crumb != '') $breadcr->setBreadCrumbs($com,$title_crumb);
	$breadcrumbs = $breadcr->getBreadCrumbs();
?>