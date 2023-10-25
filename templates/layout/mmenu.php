<div id="menu-mobile">
    <div class="container-mmenu">
        <div class="mmenu-start mmenu-bar">
            <button class="menu-toggle">
                <img src="assets/images/images/menu.png" alt="icon-menu">
            </button>
        </div>
        <div class="logo logo-svg sss d-flex align-items-center">
            <a href="<?= $config_base ?>">
                <img width="150" height="40" onerror="this.src='<?= THUMBS ?>/150x40x2/assets/images/noimage.png';" src="<?= THUMBS ?>/150x40x2/<?= UPLOAD_PHOTO_L . $logo['photo'] ?>" alt="Logo <?= $setting['ten'.$lang] ?>"/>
            </a>
        </div>
        <div class="mmenu-end mmenu-bar">
           <div id="search-hidden">
                <button class="open-search">
                    <img src="assets/images/images/search.png" alt="icon-search">
                </button>
                <input type="text" id="search-hidden-mmenu" onkeypress="doEnter(event,'search-hidden-mmenu')" name="search-hidden" class="input-search-hidden" placeholder="<?=enterkeywords?>">
            </div>
        </div>
    </div>
</div>

