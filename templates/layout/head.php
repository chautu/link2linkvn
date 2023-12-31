<base href="<?=$config_base?>"/>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?=$seo->getSeo('title')?></title>

<meta name="keywords" content="<?=$seo->getSeo('keywords')?>"/>
<meta name="description" content="<?=$seo->getSeo('description')?>"/>

<meta name="robots" content="index,follow" />

<link href="<?=UPLOAD_PHOTO_L.$favicon['photo']?>" rel="shortcut icon" type="image/x-icon" />

<?=htmlspecialchars_decode($setting['mastertool'])?>

<?php if(count($config['arrayDomainSSL'])) { ?>
	<meta http-equiv="Content-Security-Policy" content="upgrade-insecure-requests">
<?php } ?>

<meta name="geo.region" content="VN" />
<meta name="geo.placename" content="Hồ Chí Minh" />
<meta name="geo.position" content="10.823099;106.629664" />
<meta name="ICBM" content="10.823099, 106.629664" />

<meta name='revisit-after' content='1 days' />
<meta name="author" content="<?=$setting['ten'.$lang]?>" />
<meta name="copyright" content="<?=$setting['ten'.$lang]." - [".$optsetting['email']."]"?>" />

<meta property="og:type" content="<?=$seo->getSeo('type')?>" />
<meta property="og:site_name" content="<?=$setting['ten'.$lang]?>" />
<meta property="og:title" content="<?=$seo->getSeo('title')?>" />
<meta property="og:description" content="<?=$seo->getSeo('description')?>" />
<meta property="og:url" content="<?=$seo->getSeo('url')?>" />
<meta property="og:image" content="<?=$seo->getSeo('photo')?>" />
<meta property="og:image:alt" content="<?=$seo->getSeo('title')?>" />
<meta property="og:image:type" content="<?=$seo->getSeo('photo:type')?>" />
<meta property="og:image:width" content="<?=$seo->getSeo('photo:width')?>" />
<meta property="og:image:height" content="<?=$seo->getSeo('photo:height')?>" />

<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:site" content="<?=$optsetting['email']?>" />
<meta name="twitter:creator" content="<?=$setting['ten'.$lang]?>" />
<meta property="og:url" content="<?=$seo->getSeo('url')?>" />
<meta property="og:title" content="<?=$seo->getSeo('title')?>" />
<meta property="og:description" content="<?=$seo->getSeo('description')?>" />
<meta property="og:image" content="<?=$seo->getSeo('photo')?>" />

<link rel="canonical" href="<?=$func->getCurrentPageURL()?>" />
<meta name="format-detection" content="telephone=no">
<?php /* <meta name="viewport" content="width=1349" /> */ ?>
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">