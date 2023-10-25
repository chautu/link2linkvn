<div id="menu" class="section-menu <?= $source != 'index' ? 'no-fixed' : '' ?>">
    <div class="center">
        <div class="no-select container-menu">
            <div class="logo-menu">
                <div class="logo logo-svg sss d-flex align-items-center">
                    <a href="<?= $config_base ?>" aria-label="<?=$seo->getSeo('title')?>">
                        <img width="150" height="40" onerror="this.src='<?= THUMBS ?>/150x40x2/assets/images/noimage.png';" src="<?= THUMBS ?>/150x40x2/<?= UPLOAD_PHOTO_L . $logo['photo'] ?>" alt="Logo <?= $setting['ten'.$lang] ?>"/>
                    </a>
                </div>
                <div class="w-clear" id="search_bar">
                    <input type="text" name="search-desktop" id="search-desktop" placeholder="<?=enterkeywords?>" onkeypress="doEnter(event,'search-desktop');"/>
                    <button aria-label="button-search" onclick="onSearch('search-desktop');"><i class="fas fa-search"></i></button>
                </div>
            </div>
            <ul class="nav-menu no-scrollbar">
                <li>
                    <a class="transition <?= $com == 'index' ? 'active' : '' ?>" href="<?= $config_base ?>"
                        title="<?= home ?>"><?= home ?></a>
                </li>
                <li>
                    <a class="transition <?= $com == 'gioi-thieu' ? 'active' : '' ?>" href="gioi-thieu"
                        title="<?= aboutus ?>"><?= aboutus ?></a>
                </li>
                <li>    
                    <a class="transition <?= $com == 'san-pham' ? 'active' : '' ?>" href="san-pham" title="<?= product ?>"><?= product ?></a>
                    <?php if(count($splistmenu)) { ?> 
                        <ul class="first">
                            <?php foreach($splistmenu as $spl) { ?> 
                                <li>
                                    <a href="<?= $spl[$sluglang] ?>"><?= $spl['ten'] ?></a>
                                </li>
                            <?php } ?>
                        </ul>
                    <?php } ?>
                </li>
                <li>    
                    <a class="transition <?= $com == 'tin-tuc' ? 'active' : '' ?>" href="tin-tuc" title="<?= news ?>"><?= news ?></a>
                </li>
                <li>
                    <a class="transition <?= $com == 'lien-he' ? 'active' : '' ?>" href="lien-he" title="<?= contact ?>"><?= contact ?></a>
                </li>
                <?php if(isset($config['cart']['active']) && $config['cart']['active'] == true) { ?> 
                    <li>
                        <p class="transition cart-toggle" title="<?= cart ?>"><?= cart ?></p>
                    </li>
                <?php } ?>
                <?php if(isset($config['login']['active']) && $config['login']['active'] == true) { ?>
                <?php if(isset($_SESSION[$login_member]['active']) && $_SESSION[$login_member]['active'] == true) { ?> 
                    <li>
                        <a class="transition <?= $com == 'account' ? 'active' : '' ?>" href="account" title="<?= manageruser ?>">
                            <span class="join-button">
                                <i class="fas fa-user"></i>
                            </span>
                        </a>
                    </li>
                <?php } else { ?> 
                    <li>
                        <p class="transition open-modals-auth" data-class="login" title="<?= login ?>">
                            <span class="join-button"><?= login ?></span>
                        </p>
                    </li>
                <?php } ?>
                <?php } ?>
                <li>
                    <p class="transition menu-toggle" id="menu-toggle" title="<?= menu ?>">
                        <i class="fas fa-bars"></i>
                    </p>
                </li>
            </ul>
        </div>
    </div>
</div>