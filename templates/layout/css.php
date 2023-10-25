<!-- Css Files -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700;900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
<?php
    $css->setCache("cached");
    $css->setCss("./assets/css/animate.min.css");
    $css->setCss("./assets/bootstrap/bootstrap.css");
    $css->setCss("./assets/fontawesome512/all.css");
    $css->setCss("./assets/fancybox3/jquery.fancybox.css");
    $css->setCss("./assets/fancybox3/jquery.fancybox.style.css");
    $css->setCss("./assets/css/cart.css");
    $css->setCss("./assets/photobox/photobox.css");
    $css->setCss("./assets/simplyscroll/jquery.simplyscroll.css");
    $css->setCss("./assets/simplyscroll/jquery.simplyscroll-style.css");
    $css->setCss("./assets/fotorama/fotorama.css");
    $css->setCss("./assets/fotorama/fotorama-style.css");
    $css->setCss("./assets/owlcarousel2/owl.carousel.css");
    $css->setCss("./assets/owlcarousel2/owl.theme.default.css");
    $css->setCss("./assets/datetimepicker/jquery.datetimepicker.css");
    $css->setCss("./assets/simplyscroll/jquery.simplyscroll.css");
    $css->setCss("./assets/simplyscroll/jquery.simplyscroll-style.css");
    $css->setCss("./assets/swiper/swiper.css");
    $css->setCss("./assets/sumoselect/sumoselect.css");
    $css->setCss("./assets/select2/select2.css");
    $css->setCss("./assets/lightgallery/lightgallery.min.css");
    $css->setCss("./assets/hightlight/github-dark.min.css");
    $css->setCss("./assets/animate/animate.min.css");
    $css->setCss("./assets/css/component.css");
    $css->setCss("./assets/css/ckeditor.css");
    $css->setCss("./assets/css/style.css");
    $css->setCss("./assets/css/media.css");
 
    echo $css->getCss();
?>

<!-- Background -->
<?php
    $bgbody = $d->rawQueryOne("select hienthi, options, photo from #_photo where act = ? and type = ? limit 0,1",array('photo_static','background'));

    if($bgbody['hienthi'])
    {
        $bgbodyOptions = json_decode($bgbody['options'],true)['background'];
        if($bgbodyOptions['loaihienthi']) 
        {
            echo '<style type="text/css">body{background: url('.UPLOAD_PHOTO_L.$bgbody['photo'].') '.$bgbodyOptions['repeat'].' '.$bgbodyOptions['position'].' '.$bgbodyOptions['attachment'].' ;background-size:'.$bgbodyOptions['size'].'}</style>';
        }
        else
        {
            echo ' <style type="text/css">body{background-color:#'.$bgbodyOptions['color'].'}</style>';
        }
    }
?>

<!-- Js Google Analytic -->
<?=htmlspecialchars_decode($setting['analytics'])?>

<!-- Js Head -->
<?=htmlspecialchars_decode($setting['headjs'])?>