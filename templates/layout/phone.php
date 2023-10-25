<?php if($deviceType == "mobile") { ?> 
<div class="plugbar">
    <ul>
        <li>
            <a href="<?= $config_base ?>" aria-label="<?=$seo->getSeo('title')?>">
                <i class="fas fa-home"></i>
            </a>
        </li>
        <li>
            <a href="tel:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?>">
                <i class="fas fa-phone-alt"></i>
            </a>
        </li>
        <li>
            <a href="//m.me/<?=$optsetting['fanpage']?>" target="_blank">
                <span>
                    <img src="assets/images/MessengerIcon.png" height="50" width="50" alt="Facebook Messenger">
                </span>
            </a>
        </li>
        <li>
            <p class="cart-toggle" title="<?= cart ?>">
                <i class="fas fa-shopping-bag"></i>
            </p>
        </li>
        <?php if(isset($config['login']['active']) && $config['login']['active'] == true) { ?>
        <li>
            <a href="account">
                <i class="fas fa-user"></i>
            </a>
        </li>
        <?php } else { ?> 
        <li>
            <a href="lien-he">
                <i class="fas fa-id-badge"></i>
            </a>
        </li>
        <?php } ?>
    </ul>
</div>

<div class="support-online">
    <div class="support-content" style="display: block;">
        <a target="_blank" href="tel:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?>" class="not-loading call-now" rel="nofollow">
            <i class="fab fa-whatsapp"></i>
            <div class="animated infinite zoomIn kenit-alo-circle"></div>
            <div class="animated infinite pulse kenit-alo-circle-fill"></div>
            <span><?= hotline ?>: <?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?></span>
        </a>
        <a class="mes not-loading" target="_blank" href="lien-he">
            <i class="fa fa-map-marker"></i>
            <span><?= maping ?></span>
        </a>
        <a class="mes not-loading" target="_blank" href="//zalo.me/<?=preg_replace('/[^0-9]/','',$optsetting['zalo']);?>">
            <img src="assets/images/zalo-combo.png" alt="icon zalo">
            <span><?= zalo ?></span>
        </a>
        <a class="sms not-loading" target="_blank" href="sms:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?>">
            <i class="fab fa-weixin"></i>
            <span><?= sms ?>: <?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?></span>
        </a>
    </div>
    <div class="btn-support not-loading">
        <div class="animated infinite zoomIn kenit-alo-circle"></div>
        <div class="animated infinite pulse kenit-alo-circle-fill"></div>
        <i class="fa fa-user-circle"></i>
    </div>
</div>

<div class="widget-mobile">
    <div id="my-phone-circle">
        <div class="wcircle-icon"><i class="fa fa-bell shake-anim"></i></div>
        <div class="wcircle-menu">
            <div class="wcircle-menu-item">
                <a href="tel:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?>"><i class="fa fa-phone"></i></a>
            </div>
            <div class="wcircle-menu-item">
                <a href="sms:<?=preg_replace('/[^0-9]/','',$optsetting['hotline']);?>"><i class="fa fa-comments"></i></a>
            </div>
            <div class="wcircle-menu-item">
                <a href="lien-he" target="_blankl"><i class="fa fa-map"></i></a>
            </div>
            <div class="wcircle-menu-item">
                <a href="<?=$optsetting['fanpage']?>"><i class="fab fa-facebook-f"></i></a>
            </div>
            <div class="wcircle-menu-item">
                <a href="//zalo.me/<?=preg_replace('/[^0-9]/','',$optsetting['zalo']);?>" target="_blank"><img src="assets/images/zalo-mb.png" alt="<?= zalo?>"></a>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript" src="assets/js/jQuery.WCircleMenu-min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        /* Phone circle */
        $('#my-phone-circle').WCircleMenu({
            angle_start : -Math.PI,
            delay: 50,
            distance: 70,
            angle_interval: Math.PI/4,
            easingFuncShow:"easeOutBack",
            easingFuncHide:"easeInBack",
            step:5,
            openCallback:false,
            closeCallback:false,
        });

        /* Phone support */
        $('.support-content').hide();
        $('div.btn-support').click(function (e) {
            e.stopPropagation();
            $('.support-content').slideToggle();
        });
        $('.support-content').click(function (e) {
            e.stopPropagation();
        });
        $(document).click(function () {
            $('.support-content').slideUp();
        });
    })
</script>

<?php } ?>