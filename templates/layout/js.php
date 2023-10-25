<?php /* Js Config */ ?>
<script type="text/javascript">
    var NGUYENNHIEU = NGUYENNHIEU || {};
    var CONFIG_BASE = '<?=$config_base?>';
    var WEBSITE_NAME = '<?=(!empty($setting['ten'.$lang])) ? addslashes($setting['ten'.$lang]) : ''?>';
    var TIMENOW = '<?=date("d/m/Y",time())?>';
    var SHIP_CART = <?=(isset($config['order']['ship']) && $config['order']['ship'] == true) ? 'true' : 'false'?>;
    var GOTOP = 'assets/images/top.png';
    var LANG = {
        'no_keywords': '<?=nokeywords?>',
        'wards': '<?=wards?>',
        'back': '<?=back?>',
        'warning' : '<?=warning?>',
        'areyouwanttodelete' : '<?=areyouwanttodelete?>',
        'yesiscontinue' : '<?=yesiscontinue?>',
        'couponsisrequired' : '<?=couponsisrequired?>',
        'productsolderror' : '<?=productsolderror?>',
        'noquantitypctd' : '<?=noquantitypctd?>',
        'checkallattributes' : '<?=checkallattributes?>',
        'placeseach' : '<?=placeseach?>',
        'select' : '<?=select?>',
        'updatesuccess' : '<?=updatesuccess?>',
        'areyousure': '<?=areyousure?>',
        'tingting': '<?=tingting?>',
        'norestore': '<?=norestore?>',
        'viewmore': '<?=viewmore?>',
        'rutgon': '<?=rutgon?>',
        
    };
</script>


<?php /* Js Files */ ?>
<?php
$js->setCache("cached");
$js->setJs("./assets/js/jquery.min.js");
$js->setJs("./assets/bootstrap/bootstrap.js");
$js->setJs("./assets/simplyscroll/jquery.simplyscroll.js");
$js->setJs("./assets/fotorama/fotorama.js");
$js->setJs("./assets/fancybox3/jquery.fancybox.js");
$js->setJs("./assets/photobox/photobox.js");
$js->setJs("./assets/owlcarousel2/owl.carousel.js");
$js->setJs("./assets/datetimepicker/php-date-formatter.min.js");
$js->setJs("./assets/datetimepicker/jquery.mousewheel.js");
$js->setJs("./assets/datetimepicker/jquery.datetimepicker.js");
$js->setJs("./assets/toc/toc.js");
$js->setJs("./assets/js/functions.js");
$js->setJs("./assets/js/priceFormat.js");
$js->setJs("./assets/js/jquery.pixelentity.shiner.min.js");
$js->setJs("./assets/swiper/swiper.js");
$js->setJs("./assets/lightgallery/Lightgallery.js");
$js->setJs("./assets/hightlight/highlightjs-badge.min.js");
$js->setJs("https://unpkg.com/@highlightjs/cdn-assets@11.8.0/highlight.min.js");
$js->setJs("./assets/sumoselect/jquery.sumoselect.js");
$js->setJs("./assets/comfirm/MSalert.js");
$js->setJs("./assets/select2/select2.full.js");
$js->setJs("./assets/typed/typed.umd.js");
$js->setJs("./assets/tinymce/js/tinymce/tinymce.js");
$js->setJs("./assets/bootstrap-notify/bootstrap-notify.min.js");
$js->setJs("./assets/js/apps.js");
echo $js->getJs();
?>

<?php if(isset($config['googleAPI']['recaptcha']['active']) && $config['googleAPI']['recaptcha']['active'] == true) { ?>
    <?php /* Js Google Recaptcha V3 */ ?>
    <script src="https://www.google.com/recaptcha/api.js?render=<?=$config['googleAPI']['recaptcha']['sitekey']?>"></schttps:>
    <script type="text/javascript">
        grecaptcha.ready(function () {
            grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'Newsletter' }).then(function (token) {
                var recaptchaResponseNewsletter = document.getElementById('recaptchaResponseNewsletter');
                recaptchaResponseNewsletter.value = token;
            });
            <?php if($source=='contact') { ?>
                grecaptcha.execute('<?=$config['googleAPI']['recaptcha']['sitekey']?>', { action: 'contact' }).then(function (token) {
                    var recaptchaResponseContact = document.getElementById('recaptchaResponseContact');
                    recaptchaResponseContact.value = token;
                });
            <?php } ?>
        });
    </script>
<?php } ?>

<?php if(isset($config['oneSignal']['active']) && $config['oneSignal']['active'] == true) { ?>
    <?php /* Js OneSignal */ ?>
    <script src="https://cdn.onesignal.com/sdks/OneSignalSDK.js" async=""></script>
    <script type="text/javascript">
        var OneSignal = window.OneSignal || [];
        OneSignal.push(function() {
            OneSignal.init({
                appId: "<?=$config['oneSignal']['id']?>"
            });
        });
    </script>
<?php } ?>

<?php 
    if(isset($_SESSION['flash_messager']) && $_SESSION['flash_messager']) {
        if($_SESSION['status_messager'] == true) {
            ?> 
            <script>
                MSalert.principal({
                    // 'gear', 'error', 'warning', 'success'
                    icon: "success", 
                    // dialog title
                    title: '<?= notification ?>',
                    // dialog content
                    description: '<?= $_SESSION['flash_messager'] ?>',
                    // footer content
                    extra: "",
                    // enable confirm/cancel buttons
                    button: false, 
                })
            </script>
            <?php 
        } else { ?> 
            <script>
                MSalert.principal({
                    // 'gear', 'error', 'warning', 'success'
                    icon: "error", 
                    // dialog title
                    title: '<?= notification ?>',
                    // dialog content
                    description: '<?= $_SESSION['flash_messager'] ?>',
                    // footer content
                    extra: "",
                    // enable confirm/cancel buttons
                    button: false, 
                })
            </script>
        <?php }
        unset($_SESSION['flash_messager']);
        unset($_SESSION['status_messager']);
    }
?>

<?php /* Js Structdata */ ?>
<?php include TEMPLATE.LAYOUT."strucdata.php"; ?>

<?php /* Js Addons */ ?>
<?=$addons->setAddons('script-main', 'script-main', 0.5);?>
<?=$addons->getAddons();?>

<?php /* Js Body */ ?>
<?=htmlspecialchars_decode($setting['bodyjs'])?>