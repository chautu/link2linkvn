<?php
if(!defined('SOURCES')) die("Error");

/* Favicon */
$favicon = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('favicon','photo_static'));

/* Header */
$logo = $d->rawQueryOne("select id, photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('logo','photo_static'));
$banner = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('banner','photo_static'));
$loadding = $d->rawQueryOne("select photo from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('loadding','photo_static'));
$slogan = $d->rawQueryOne("select ten$lang as ten from #_static where type = ? limit 0,1",array('slogan'));
$mxh1 = $d->rawQuery("select ten$lang as ten, icon, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mxh1'));

/* Footer */
$link1 = $d->rawQuery("select ten$lang as ten, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('footer-1'));
$link2 = $d->rawQuery("select ten$lang as ten, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('footer-2'));
$link3 = $d->rawQuery("select ten$lang as ten, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('footer-3'));
$link4 = $d->rawQuery("select ten$lang as ten, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('footer-4'));
$footer = $d->rawQueryOne("select ten$lang as ten, noidung$lang as noidung from #_static where type = ? limit 0,1",array('footer'));
$mxh = $d->rawQuery("select ten$lang as ten, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mxh'));

/* Support */
$social2 = $d->rawQuery("select ten$lang as ten, photo, link from #_photo where type = ? and hienthi > 0 order by stt,id desc",array('mangxahoi2'));

/* Menu */
$splistmenu = $d->rawQuery("select ten$lang as ten, $sluglang, id from #_product_list where type = ? and hienthi > 0 order by stt,id desc",array('san-pham'));
$ttlistmenu = $d->rawQuery("select ten$lang as ten, $sluglang, id from #_news_list where type = ? and hienthi > 0 order by stt,id desc",array('tin-tuc'));

/* City */
$city = $d->rawQuery("select ten$lang as ten, id from #_city where hienthi > 0 order by stt, id desc");

/* Banner auth */
$banner_auth = $d->rawQueryOne("select photo, ten$lang as ten, noidung$lang as noidung from #_photo where type = ? and act = ? and hienthi > 0 limit 0,1",array('banner-auth','photo_static'));

/* Content auth */
$content_auth = $d->rawQueryOne("select noidung$lang as noidung from #_static where type = ?", array("auth"));

/* Get statistic */
// $tagsSanPham = $d->rawQuery("select ten$lang, $sluglang, id from #_tags where type = ? and noibat > 0 order by stt,id desc",array('san-pham'));
// $tagsTinTuc = $d->rawQuery("select ten$lang, $sluglang, id from #_tags where type = ? and noibat > 0 order by stt,id desc",array('tin-tuc'));

$google = 'https://accounts.google.com/o/oauth2/auth?response_type=code&client_id='.$config['google']['client_id_google'].'&redirect_uri='.$config_base.'account/login-google&scope=https://www.googleapis.com/auth/userinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&approval_prompt=force&flowName=GeneralOAuthFlow';
$facebook = 'https://www.facebook.com/v12.0/dialog/oauth?client_id='.$config['facebook']['client_id_facebook'].'&redirect_uri='.$config_base.'account/login-facebook&scope=email,public_profile,user_gender, user_link';

/* Get statistic */
$counter = $statistic->getCounter();
$online = $statistic->getOnline();

/* Newsletter */
if(isset($_POST['register-newsletter']))
{
    $responseCaptcha = $_POST['recaptcha_response_newsletter'];
    $resultCaptcha = $func->checkRecaptcha($responseCaptcha);
    $scoreCaptcha = (isset($resultCaptcha['score'])) ? $resultCaptcha['score'] : 0;
    $actionCaptcha = (isset($resultCaptcha['action'])) ? $resultCaptcha['action'] : '';
    $testCaptcha = (isset($resultCaptcha['test'])) ? $resultCaptcha['test'] : false;

    if(($scoreCaptcha >= 0.5 && $actionCaptcha == 'Newsletter') || $testCaptcha == true)
    {
        $data = array();
        $data['email'] = (isset($_REQUEST['email-newsletter']) && $_REQUEST['email-newsletter'] != '') ? htmlspecialchars($_REQUEST['email-newsletter']) : '';
        $data['ten'] = (isset($_REQUEST['ten-newsletter']) && $_REQUEST['ten-newsletter'] != '') ? htmlspecialchars($_REQUEST['ten-newsletter']) : '';
        $data['dienthoai'] = (isset($_REQUEST['dienthoai-newsletter']) && $_REQUEST['dienthoai-newsletter'] != '') ? htmlspecialchars($_REQUEST['dienthoai-newsletter']) : '';
        $data['diachi'] = (isset($_REQUEST['diachi-newsletter']) && $_REQUEST['diachi-newsletter'] != '') ? htmlspecialchars($_REQUEST['diachi-newsletter']) : '';
        $data['noidung'] = (isset($_REQUEST['noidung-newsletter']) && $_REQUEST['noidung-newsletter'] != '') ? htmlspecialchars($_REQUEST['noidung-newsletter']) : '';
        $data['ngaytao'] = time();
        $data['type'] = 'dangkynhantin';

        if($d->insert('newsletter',$data))
        {
            $func->transferUser(responsesuccessnewsupfor,$config_base);
        }
        else
        {
            $func->transferUser(responseerrornewsupfor,$config_base, false);
        }
    }
    else
    {
        $func->transferUser(responseerrornewsupfor,$config_base, false);
    }
}
?>