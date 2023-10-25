<div>
    <?php if(isset($config['cart']['active']) && $config['cart']['active']==true) { ?>
        <a class="cart-fixed text-decoration-none" href="gio-hang" title="<?= cart ?>">
            <i class="fas fa-shopping-bag"></i>
            <span class="count-cart"><?=(isset($_SESSION['cart'])) ? count($_SESSION['cart']) : 0?></span>
        </a>
    <?php } ?>
    <a class="btn-zalo btn-frame text-decoration-none" target="_blank"
        href="https://zalo.me/<?= preg_replace('/[^0-9]/', '', $optsetting['zalo']); ?>">
        <div class="animated infinite zoomIn kenit-alo-circle"></div>
        <div class="animated infinite pulse kenit-alo-circle-fill"></div>
        <i><img src="assets/images/zl.png" alt="Zalo"></i>
    </a>
    <a class="btn-phone btn-frame text-decoration-none"
        href="tel:<?= preg_replace('/[^0-9]/', '', $optsetting['hotline']); ?>">
        <div class="animated infinite zoomIn kenit-alo-circle"></div>
        <div class="animated infinite pulse kenit-alo-circle-fill"></div>
        <i><img src="assets/images/hl.png" alt="Hotline"></i>
    </a>
</div>

<?php /* 
<?= $addons->setAddons('messages-facebook', 'messages-facebook', 10); ?>
*/ ?>

<div class="background-cart"></div>
<div class="background-mmenu"></div>

<?php if(!empty($loadding)) { ?> 
<nav>
    <div class="loadding-page not-select d-flex">
        <img onerror="this.src='<?= THUMBS ?>/320x320x2/assets/images/noimage.png';" src="<?= UPLOAD_PHOTO_L . $loadding['photo'] ?>" alt="<?= loaddingpage ?>">
    </div>
</nav>
<?php } ?>
