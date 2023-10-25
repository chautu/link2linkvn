<div class="nav-user nomal-info-user bg-user no-overflow my-3">
    <?php if(isset($config['member']['nganhang']) && $config['member']['nganhang'] == true) { ?> 
    <li class="<?= $action == "ngan-hang" ? 'active' : '' ?>">
        <a class="<?= $action == "ngan-hang" ? 'active' : '' ?>" href="account/ngan-hang" title="<?= bank ?>"><?= bank ?></a>
    </li>
    <?php } ?>
    <?php if(isset($config['member']['diachi']) && $config['member']['diachi'] == true) { ?> 
    <li class="<?= $action == "dia-chi" ? 'active' : '' ?>">
        <a class="<?= $action == "dia-chi" ? 'active' : '' ?>" href="account/dia-chi" title="<?= address ?>"><?= address ?></a>
    </li>
    <?php } ?>
    <?php if(isset($config['member']['lichsugiaodich']) && $config['member']['lichsugiaodich'] == true) { ?> 
    <li class="<?= $action == "lich-su-giao-dich" ? 'active' : '' ?>">
        <a class="<?= $action == "lich-su-giao-dich" ? 'active' : '' ?>" href="account/lich-su-giao-dich" title="<?= historytransition ?>"><?= historytransition ?></a>
    </li>
    <?php } ?>
    <?php if(isset($config['member']['trangcanhan']) && $config['member']['trangcanhan'] == true) { ?> 
    <li class="<?= $action == ""  || $action == "doi-mat-khau" || $action == "cap-nhat-tai-khoan" || $action == "photo" || $action == "video"  ? 'active' : '' ?>">
        <a class="<?= $action == "" || $action == "doi-mat-khau" || $action == "cap-nhat-tai-khoan" || $action == "photo" || $action == "video" ? 'active' : '' ?>" href="account" title="<?= timeline ?>"><?= timeline ?></a>
    </li>
    <?php } ?>
    <?php if(isset($config['member']['lichsuorder']) && $config['member']['lichsuorder'] == true) { ?> 
    <li class="<?= $action == "hoa-don" ? 'active' : '' ?>">
        <a class="<?= $action == "hoa-don" ? 'active' : '' ?>" href="account/hoa-don" title="<?= orderhasbuy ?>"><?= orderhasbuy ?></a>
    </li>
    <?php } ?>
    <?php if(isset($config['member']['naptien']) && $config['member']['naptien'] == true) { ?> 
    <li class="<?= $action == "nap-tien" ? 'active' : '' ?>">
        <a class="<?= $action == "nap-tien" ? 'active' : '' ?>" href="account/nap-tien" title="<?= recharge ?>"><?= recharge ?></a>
    </li>
    <?php } ?>
    <?php if(isset($config['member']['ruttien']) && $config['member']['ruttien'] == true) { ?> 
    <li class="<?= $action == "rut-tien" ? 'active' : '' ?>">
        <a class="<?= $action == "rut-tien" ? 'active' : '' ?>" href="account/rut-tien" title="<?= 	withdraw ?>"><?= withdraw ?></a>
    </li>
    <?php } ?>

    <div class="dropdown-nav-user">
        <div class="dropdown no-select">
            <input type="checkbox" id="dropdown-nav">
            <label for="dropdown-nav"><i class="fas fa-ellipsis-h"></i></label>
            <div class="dropdown-container nomal-info-user no-overflow bg-user">
            <?php if(isset($config['member']['nganhang']) && $config['member']['nganhang'] == true) { ?> 
            <li>
                <a class="<?= $action == "ngan-hang" ? 'active' : '' ?>" href="account/ngan-hang" title="<?= bank ?>">
                    <i class="fas fa-university"></i> <?= bank ?>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($config['member']['diachi']) && $config['member']['diachi'] == true) { ?> 
            <li>
                <a class="<?= $action == "dia-chi" ? 'active' : '' ?>" href="account/dia-chi" title="<?= address ?>">
                    <i class="fas fa-map-pin"></i> <?= address ?>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($config['member']['lichsugiaodich']) && $config['member']['lichsugiaodich'] == true) { ?> 
            <li>
                <a class="<?= $action == "lich-su-giao-dich" ? 'active' : '' ?>" href="account/lich-su-giao-dich" title="<?= historytransition ?>">
                    <i class="fas fa-history"></i> <?= historytransition ?>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($config['member']['trangcanhan']) && $config['member']['trangcanhan'] == true) { ?> 
            <li>
                <a class="<?= $action == ""  || $action == "doi-mat-khau" || $action == "cap-nhat" || $action == "photo" || $action == "video" ? 'active' : '' ?>" href="account" title="<?= timeline ?>">
                    <i class="far fa-calendar-alt"></i> <?= timeline ?>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($config['member']['lichsuorder']) && $config['member']['lichsuorder'] == true) { ?> 
            <li>
                <a class="<?= $action == "hoa-don" ? 'active' : '' ?>" href="account/hoa-don" title="<?= orderhasbuy ?>">
                    <i class="far fa-calendar-alt"></i> <?= orderhasbuy ?>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($config['member']['naptien']) && $config['member']['naptien'] == true) { ?> 
            <li>
                <a class="<?= $action == "nap-tien" ? 'active' : '' ?>" href="account/nap-tien" title="<?= recharge ?>">
                    <i class="fas fa-money-bill"></i> <?= recharge ?>
                </a>
            </li>
            <?php } ?>
            <?php if(isset($config['member']['ruttien']) && $config['member']['ruttien'] == true) { ?> 
            <li>
                <a class="<?= $action == "rut-tien" ? 'active' : '' ?>" href="account/rut-tien" title="<?= 	withdraw ?>">
                    <i class="fas fa-wallet"></i> <?= withdraw ?>
                </a>
            </li>
            <?php } ?>
            </div>
        </div>
    </div>
</div>