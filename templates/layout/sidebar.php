<?php if(isset($config['cart']['active']) && $config['cart']['active']){ ?>
<nav id="cart">
    <div class="h2-cart">
        <h2>
            <i class="fas fa fa-arrow-left background-cart"></i>
            <?= yourcart ?>
        </h2>
        <p class="background-cart">
            <i class="fas fa-times"></i>
        </p>
    </div>
    <div class="content-cart no-scrollbar">

    </div>
    <div class="checkout-cart">
        <div>
            <p class="background-cart"><?= coutinueshopping ?></p>
            <hr>
        </div>
        <div class="comfirm-cart">
            <p><?= provisional ?></p>
            <p><span class="total_cart">0</span> <?= unit ?></p>
        </div>
        <a class="default-button a-checkout" href="gio-hang" title="<?= pay ?>"><?= pay ?></a>
    </div>
</nav>
<?php } ?>

<nav id="mmenu">
    <div class="mmenu-section">
        <div class="social-mmenu">
            <div class="social-top">
                <ul class="mxh mxh-mmenu">
                    <li>
                        <a href="<?= $config_base ?>" aria-label="<?=$seo->getSeo('title')?>"><i class="fas fa-home"></i></a>
                    </li>
                </ul>
            </div>
            <div class="social-bottom">
                <ul class="mxh mxh-mmenu">
                    <?php foreach($mxh1 as $smt) { ?>
                    <li>
                        <a href="<?= $smt['link'] ?>" aria-label="<?=$smt['ten']?>"><i class="<?= $smt['icon'] ?>"></i></a>
                    </li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="content-mmenu">
            <div class="header-mmenu">
                <div class="background-mmenu">
                    <i class="fas fa-times"></i>
                </div>
                <?php if(isset($config['login']['active']) && $config['login']['active'] == true) { ?>
                <a href="<?= $config_base ?>"  aria-label="<?=$seo->getSeo('title')?>">
                    <i class="fas fa-user-cog"></i>
                </a>
                <?php } ?>
            </div>
            <ul class="nav-mmenu nav-items no-scrollbar">
                <li class="nav-item">
                    <a class="nav-link transition <?= $com == 'index' ? 'active' : '' ?>" href="<?= $config_base ?>" title="<?= home ?>">
                        <?= home ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link transition <?= $com == 'gioi-thieu' ? 'active' : '' ?>" href="gioi-thieu" title="<?= aboutus ?>">
                        <?= aboutus ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link nav-link transition <?= $com == 'tuyen-dung' ? 'active' : '' ?>" href="tuyen-dung" title="<?= recruitment ?>">
                        <?= recruitment ?>
                    </a>
                </li>
                <li class="nav-item nav-expand">   
                    <p class="nav-link nav-expand-link transition <?= $com == 'san-pham' ? 'active' : '' ?>" title="<?= product ?>">
                        <?= product ?>
                    </p> 
                    <?php if(count($splistmenu)) { ?> 
                    <ul class="nav-items nav-expand-content"> 
                        <li class="nav-item">
                            <a class="nav-link transition <?= $com == 'san-pham' ? 'active' : '' ?>" href="san-pham"  aria-label="<?= product ?>">
                                <?= product ?>
                            </a>
                        </li>
                        <?php foreach($splistmenu as $spl) { ?> 
                        <li class="nav-item">
                            <a class="nav-link transition" href="<?= $spl[$sluglang] ?>"  aria-label="<?= $spl['ten'] ?>">
                                <?= $spl['ten'] ?>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
                    <?php } ?>
                </li>
                <li class="nav-item">    
                    <a class="nav-link transition <?= $com == 'tin-tuc' ? 'active' : '' ?>" href="tin-tuc" title="<?= news ?>">
                        <?= news ?>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link transition <?= $com == 'lien-he' ? 'active' : '' ?>" href="lien-he" title="<?= contact ?>">
                        <?= contact ?>
                    </a>
                </li>
                <?php if(isset($config['cart']['active']) && $config['cart']['active'] == true) { ?> 
                    <li class="nav-item">
                        <p class="nav-link transition cart-toggle" title="<?= cart ?>">
                            <?= cart ?>
                        </p>
                    </li>
                <?php } ?>

                <?php if(isset($config['login']['active']) && $config['login']['active'] == true) { ?>
                <?php if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) { ?> 
                    <li class="nav-item">
                        <a class="nav-link transition <?= $com == 'account' ? 'active' : '' ?>" href="account" title="<?= manageruser ?>">
                            <span class="join-button">
                                <i class="fas fa-user"></i>
                            </span>
                        </a>
                    </li>
                <?php } else { ?> 
                    <li class="nav-item">
                        <p class="nav-link transition open-modals-auth" data-class="register" title="<?= register ?>">
                            <?= register ?>
                        </p>
                    </li>
                    <li class="nav-item">
                        <p class="nav-link transition open-modals-auth" data-class="login" title="<?= login ?>">
                            <span class="join-button"><?= login ?></span>
                        </p>
                    </li>
                <?php } ?>
                <?php } ?>
                
               
            </ul>
        </div>
    </div>
</nav>