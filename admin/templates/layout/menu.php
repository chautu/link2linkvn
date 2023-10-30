    <!-- Main Sidebar -->
    <aside class="main-sidebar sidebar-dark-primary elevation-4 text-sm">
        <!-- Logo -->
        <a class="brand-link" href="index.php">
            <img class="logo-admin-img brand-image" src="assets/images/logo-admintrator.png" alt="Nguyễn Nhiều">
        </a>

        <!-- Sidebar -->
        <div class="sidebar">
            <nav class="mt-3">
                <ul class="nav nav-pills nav-sidebar flex-column nav-child-indent text-sm" data-widget="treeview"
                    role="menu" data-accordion="false">
                    <!-- Bảng điều khiển -->
                    <?php
                $active = "";
                if($com=='index' || $com=='') $active = 'active';
                ?>
                    <li class="nav-item <?=$active?>">
                        <a class="nav-link <?=$active?>" href="index.php" title="Bảng điều khiển">
                            <i class="nav-icon text-sm fas fa-tachometer-alt"></i>
                            <p>Bảng điều khiển</p>
                        </a>
                    </li>

                    <!-- Group -->
                    <?php $disabled = array(); if(isset($config['group'])) { foreach($config['group'] as $key => $value) { ?>
                    <li class="nav-item has-treeview menu-group">
                        <a class="nav-link" href="#" title="Quản lý <?=$key?>">
                            <i class="nav-icon text-sm fas fa-layer-group"></i>
                            <p>
                                <?=$key?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(isset($value['product'])) { foreach($value['product'] as $k) { ?>
                            <?php
                                $disabled['product'][$k] = 1;
                                $v = $config['product'][$k];
                                $none = "";
                                $active = "";
                                $menuopen = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_list', $k, null, 'phrase-1') && $func->check_access('product', 'man_cat', $k, null, 'phrase-1') && $func->check_access('product', 'man_item', $k, null, 'phrase-1') && $func->check_access('product', 'man_sub', $k, null, 'phrase-1') && $func->check_access('product', 'man_brand', $k, null, 'phrase-1') && $func->check_access('product', 'man', $k, null, 'phrase-1') && $func->check_access('import', 'man', $k, null, 'phrase-1') && $func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if((($com=='product') || ($com=='import') || ($com=='export')) && ($k==$_GET['type']))
                                {
                                    $active = 'active';
                                    $menuopen = 'menu-open';
                                }
                                ?>
                            <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                                <a class="nav-link <?=$active?>" href="#" title="Quản lý <?=$v['title_main']?>">
                                    <i class="nav-icon text-sm fas fa-boxes"></i>
                                    <p>
                                        Quản lý <?=$v['title_main']?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if(isset($v['attr']) && $v['attr'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_attr', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='product' && ($act=='man_attr' || $act=='add_attr' || $act=='edit_attr' || $kind=='man_attr') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=product&act=man_attr&type=<?=$k?>"
                                            title="<?=$v['title_main_attr']?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?=$v['title_main_attr']?></p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['attributes']) && $v['attributes'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_attributes', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='product' && ($act=='man_attributes' || $act=='add_attributes' || $act=='edit_attributes' || $kind=='man_attributes') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=product&act=man_attributes&type=<?=$k?>"
                                            title="<?= $v['title_main_attributes'] ?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?= $v['title_main_attributes'] ?></p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['brand']) && $v['brand'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_brand', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='product' && ($act=='man_brand' || $act=='add_brand' || $act=='edit_brand') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=product&act=man_brand&type=<?=$k?>"
                                            title="<?= $v['title_main_brand'] ?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?= $v['title_main_brand'] ?></p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['list']) && $v['list'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='product' && ($act=='man_list' || $act=='add_list' || $act=='edit_list' || $kind=='man_list') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=product&act=man_list&type=<?=$k?>"
                                            title="<?=$v['title_main_list']?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?=$v['title_main_list']?></p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['cat']) && $v['cat'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='product' && ($act=='man_cat' || $act=='add_cat' || $act=='edit_cat' || $kind=='man_cat') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=product&act=man_cat&type=<?=$k?>"
                                            title="<?=$v['title_main_cat']?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?=$v['title_main_cat']?></p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['item']) && $v['item'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='product' && ($act=='man_item' || $act=='add_item' || $act=='edit_item' || $kind=='man_item') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=product&act=man_item&type=<?=$k?>"
                                            title="<?=$v['title_main_item']?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?=$v['title_main_item']?></p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['sub']) && $v['sub'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='product' && ($act=='man_sub' || $act=='add_sub' || $act=='edit_sub' || $kind=='man_sub') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=product&act=man_sub&type=<?=$k?>"
                                            title="<?=$v['title_main_sub']?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?=$v['title_main_sub']?></p>
                                        </a></li>
                                    <?php } ?>
                                    <?php
                                        $none = "";
                                        $active = "";
                                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                        if($com=='product' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                                        ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=product&act=man&type=<?=$k?>"
                                            title="<?=$v['title_main']?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?=$v['title_main']?></p>
                                        </a></li>
                                    <?php if(isset($v['import']) && $v['import'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('import', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                            if(($com=='import') && ($k==$_GET['type'])) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>">
                                        <a class="nav-link <?=$active?>"
                                            href="index.php?com=import&act=man&type=<?=$k?>" title="Import"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p>Import</p>
                                        </a>
                                    </li>
                                    <?php } ?>
                                    <?php if(isset($v['export']) && $v['export'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                            if(($com=='export') && ($act=='man') && ($k==$_GET['type'])) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>">
                                        <a class="nav-link <?=$active?>"
                                            href="index.php?com=export&act=man&type=<?=$k?>" title="Export"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p>Export</p>
                                        </a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </li>
                            <?php } } ?>

                            <?php if(isset($value['news'])) { foreach($value['news'] as $k) { ?>
                            <?php
                                $disabled['news'][$k] = 1;
                                $v = $config['news'][$k];
                                $none = "";
                                $active = "";
                                $menuopen = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_list', $k, null, 'phrase-1') && $func->check_access('news', 'man_cat', $k, null, 'phrase-1') && $func->check_access('news', 'man_item', $k, null, 'phrase-1') && $func->check_access('news', 'man_sub', $k, null, 'phrase-1') && $func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if(($com=='news') && ($k==$_GET['type']))
                                {
                                    $active = 'active';
                                    $menuopen = 'menu-open';
                                }
                                ?>
                            <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                                <a class="nav-link <?=$active?>" href="#" title="Quản lý <?=$v['title_main']?>">
                                    <i class="nav-icon text-sm fas fa-book"></i>
                                    <p>
                                        Quản lý <?=$v['title_main']?>
                                        <i class="right fas fa-angle-left"></i>
                                    </p>
                                </a>
                                <ul class="nav nav-treeview">
                                    <?php if(isset($v['list']) && $v['list'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='news' && ($act=='man_list' || $act=='add_list' || $act=='edit_list' || $kind=='man_list' || $kind=='man_list') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=news&act=man_list&type=<?=$k?>"
                                            title="Danh mục cấp 1"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p>Danh mục cấp 1</p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['cat']) && $v['cat'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='news' && ($act=='man_cat' || $act=='add_cat' || $act=='edit_cat' || $kind=='man_cat' || $kind=='man_cat') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=news&act=man_cat&type=<?=$k?>" title="Danh mục cấp 2"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p>Danh mục cấp 2</p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['item']) && $v['item'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='news' && ($act=='man_item' || $act=='add_item' || $act=='edit_item' || $kind=='man_item' || $kind=='man_item') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=news&act=man_item&type=<?=$k?>"
                                            title="Danh mục cấp 3"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p>Danh mục cấp 3</p>
                                        </a></li>
                                    <?php } ?>
                                    <?php if(isset($v['sub']) && $v['sub'] == true) {
                                            $none = "";
                                            $active = "";
                                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                            if($com=='news' && ($act=='man_sub' || $act=='add_sub' || $act=='edit_sub' || $kind=='man_sub' || $kind=='man_sub') && $k==$_GET['type']) $active = "active"; ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=news&act=man_sub&type=<?=$k?>" title="Danh mục cấp 4"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p>Danh mục cấp 4</p>
                                        </a></li>
                                    <?php } ?>
                                    <?php
                                        $none = "";
                                        $active = "";
                                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                        if($com=='news' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                                        ?>
                                    <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                            href="index.php?com=news&act=man&type=<?=$k?>"
                                            title="<?=$v['title_main']?>"><i
                                                class="nav-icon text-sm far fa-caret-square-right"></i>
                                            <p><?=$v['title_main']?></p>
                                        </a></li>
                                </ul>
                            </li>
                            <?php } } ?>

                            <?php if(isset($value['tags'])) { foreach($value['tags'] as $k) { ?>
                            <?php
                                $disabled['tags'][$k] = 1;
                                $v = $config['tags'][$k];
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('tags', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='tags' && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=tags&act=man&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>

                            <?php if(isset($value['static'])) { foreach($value['static'] as $k) { ?>
                            <?php
                                $disabled['static'][$k] = 1;
                                $v = $config['static'][$k];
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('static', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='static' && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=static&act=capnhat&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>

                            <?php if(isset($value['newsletter'])) { foreach($value['newsletter'] as $k) { ?>
                            <?php
                                $disabled['newsletter'][$k] = 1;
                                $v = $config['newsletter'][$k];
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('newsletter', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='newsletter' && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=newsletter&act=man&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>

                            <?php if(isset($value['photo'])) { foreach($value['photo'] as $k) {
                                $disabled['photo'][$k] = 1;
                                $v = $config['photo']['man_photo'][$k];
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('photo', 'man_photo', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='photo' && $_GET['type']==$k && ($act=='man_photo' || $act=='add_photo' || $act=='edit_photo')) $active = "active"; ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=photo&act=man_photo&type=<?=$k?>"
                                    title="<?=$v['title_main_photo']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main_photo']?></p>
                                </a>
                            </li>
                            <?php } } ?>

                            <?php if(isset($value['photo_static'])) { foreach($value['photo_static'] as $k) {
                                $disabled['photo_static'][$k] = 1;
                                $v = $config['photo']['photo_static'][$k];
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('photo', 'photo_static', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='photo' && $_GET['type']==$k && $act=='photo_static') $active = "active"; ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>"
                                    href="index.php?com=photo&act=photo_static&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                        </ul>
                    </li>
                    <?php } } ?>

                    <!-- Search -->
                    <?php if(isset($config['search'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('search', 'search_static', '', $config['search']['search_static'], 'phrase-2') && $func->check_access('search', 'man_search', '', $config['search']['man_search'], 'phrase-2')) $none = "d-none";
                    if($com=='search' && !isset($disabled['search'][$_GET['type']]) && !isset($disabled['search_static'][$_GET['type']]))
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý bộ tìm kiếm">
                            <i class="nav-icon text-sm fas fa-share-alt"></i>
                            <p>
                                Quản lý bộ tìm kiếm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(isset($config['search']['search_static'])) { ?>
                            <?php foreach($config['search']['search_static'] as $k => $v) { if(!isset($disabled['search_static'][$k])) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('search', 'search_static', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='search' && $_GET['type']==$k && $act=='search_static') $active = "active"; ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>"
                                    href="index.php?com=search&act=search_static&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                            <?php } ?>
                            <?php if(isset($config['search']['man_search'])) { ?>
                            <?php foreach($config['search']['man_search'] as $k => $v) { if(!isset($disabled['search'][$k])) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('search', 'man_search', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='search' && $_GET['type']==$k && ($act=='man_search' || $act=='add_search' || $act=='edit_search')) $active = "active"; ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=search&act=man_search&type=<?=$k?>"
                                    title="<?=$v['title_main_search']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main_search']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- Sản phẩm -->
                    <?php if(isset($config['product'])) { ?>
                    <?php foreach($config['product'] as $k => $v) { if(!isset($disabled['product'][$k])) { ?>
                    <?php
                        $none = "";
                        $active = "";
                        $menuopen = "";
                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_list', $k, null, 'phrase-1') && $func->check_access('product', 'man_cat', $k, null, 'phrase-1') && $func->check_access('product', 'man_item', $k, null, 'phrase-1') && $func->check_access('product', 'man_sub', $k, null, 'phrase-1') && $func->check_access('product', 'man_brand', $k, null, 'phrase-1') && $func->check_access('product', 'man', $k, null, 'phrase-1') && $func->check_access('import', 'man', $k, null, 'phrase-1') && $func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                        if((($com=='product') || ($com=='import') || ($com=='export')) && ($k==$_GET['type']))
                        {
                            $active = 'active';
                            $menuopen = 'menu-open';
                        }
                        ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý <?=$v['title_main']?>">
                            <i class="nav-icon text-sm fas fa-boxes"></i>
                            <p>
                                Quản lý <?=$v['title_main']?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">

                            <?php if(isset($v['attr']) && $v['attr'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_attr', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_attr' || $act=='add_attr' || $act=='edit_attr' || $kind=='man_attr') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=product&act=man_attr&type=<?=$k?>"
                                    title="<?= $v['title_main_attr'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_attr'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['attributes']) && $v['attributes'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_attributes', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_attributes' || $act=='add_attributes' || $act=='edit_attributes' || $kind=='man_attributes') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=product&act=man_attributes&type=<?=$k?>"
                                    title="<?= $v['title_main_attributes'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_attributes'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['brand']) && $v['brand'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_brand', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_brand' || $act=='add_brand' || $act=='edit_brand') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=product&act=man_brand&type=<?=$k?>"
                                    title="<?= $v['title_main_brand'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_brand'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['list']) && $v['list'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_list' || $act=='add_list' || $act=='edit_list' || $kind=='man_list') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=product&act=man_list&type=<?=$k?>"
                                    title="<?= $v['title_main_list'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_list'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['cat']) && $v['cat'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_cat' || $act=='add_cat' || $act=='edit_cat' || $kind=='man_cat') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=product&act=man_cat&type=<?=$k?>"
                                    title="<?= $v['title_main_cat'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_cat'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['item']) && $v['item'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_item' || $act=='add_item' || $act=='edit_item' || $kind=='man_item') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=product&act=man_item&type=<?=$k?>"
                                    title="<?= $v['title_main_item'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_item'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['sub']) && $v['sub'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='product' && ($act=='man_sub' || $act=='add_sub' || $act=='edit_sub' || $kind=='man_sub') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=product&act=man_sub&type=<?=$k?>"
                                    title="<?= $v['title_main_sub'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_sub'] ?></p>
                                </a></li>
                            <?php } ?>


                            <?php
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('product', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='product' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=product&act=man&type=<?=$k?>" title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a></li>
                            <?php if(isset($v['import']) && $v['import'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('import', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                    if(($com=='import') && ($k==$_GET['type'])) $active = "active"; ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=import&act=man&type=<?=$k?>"
                                    title="Import"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Import</p>
                                </a>
                            </li>
                            <?php } ?>
                            <?php if(isset($v['export']) && $v['export'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('export', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                    if(($com=='export') && ($act=='man') && ($k==$_GET['type'])) $active = "active"; ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=export&act=man&type=<?=$k?>"
                                    title="Export"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Export</p>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } } ?>
                    <?php } ?>

                    <!-- Bài viết (Có cấp) -->
                    <?php if(isset($config['news'])) { ?>
                    <?php foreach($config['news'] as $k => $v) { if(!isset($disabled['news'][$k])) { if(isset($v['dropdown']) && $v['dropdown'] == true) { ?>
                    <?php
                        $none = "";
                        $active = "";
                        $menuopen = "";
                        if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_list', $k, null, 'phrase-1') && $func->check_access('news', 'man_cat', $k, null, 'phrase-1') && $func->check_access('news', 'man_item', $k, null, 'phrase-1') && $func->check_access('news', 'man_sub', $k, null, 'phrase-1') && $func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                        if(($com=='news') && ($k==$_GET['type']))
                        {
                            $active = 'active';
                            $menuopen = 'menu-open';
                        }
                        ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý <?=$v['title_main']?>">
                            <i class="nav-icon text-sm fas fa-book"></i>
                            <p>
                                Quản lý <?=$v['title_main']?>
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(isset($v['list']) && $v['list'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_list', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man_list' || $act=='add_list' || $act=='edit_list' || $kind=='man_list' || $kind=='man_list') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=news&act=man_list&type=<?=$k?>"
                                    title="<?= $v['title_main_list'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_list'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['cat']) && $v['cat'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_cat', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man_cat' || $act=='add_cat' || $act=='edit_cat' || $kind=='man_cat' || $kind=='man_cat') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=news&act=man_cat&type=<?=$k?>"
                                    title="<?= $v['title_main_cat'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_cat'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['item']) && $v['item'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_item', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man_item' || $act=='add_item' || $act=='edit_item' || $kind=='man_item' || $kind=='man_item') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=news&act=man_item&type=<?=$k?>"
                                    title="<?= $v['title_main_item'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_item'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($v['sub']) && $v['sub'] == true) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man_sub', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='news' && ($act=='man_sub' || $act=='add_sub' || $act=='edit_sub' || $kind=='man_sub' || $kind=='man_sub') && $k==$_GET['type']) $active = "active"; ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=news&act=man_sub&type=<?=$k?>"
                                    title="<?= $v['title_main_sub'] ?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?= $v['title_main_sub'] ?></p>
                                </a></li>
                            <?php } ?>
                            <?php
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='news' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>"><a class="nav-link <?=$active?>"
                                    href="index.php?com=news&act=man&type=<?=$k?>" title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a></li>
                        </ul>
                    </li>
                    <?php } } } ?>
                    <?php } ?>

                    <!-- Bài viết (Không cấp) -->
                    <?php if(isset($config['shownews']) && $config['shownews'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man', '', $config['news'], 'phrase-2', false)) $none = "d-none";
                    if(($com=='news') && !isset($disabled['news'][$_GET['type']]) && (!isset($config['news'][$_GET['type']]['dropdown']) || (isset($config['news'][$_GET['type']]['dropdown']) && $config['news'][$_GET['type']]['dropdown'] == false)))
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý bài viết">
                            <i class="nav-icon text-sm far fa-newspaper"></i>
                            <p>
                                Quản lý bài viết
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach($config['news'] as $k => $v) { if(!isset($disabled['news'][$k]) && (!isset($v['dropdown']) || (isset($v['dropdown']) && $v['dropdown'] == false))) { ?>
                            <?php
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('news', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='news' && ($act=='man' || $act=='add' || $act=='edit' || $act=='copy' || $kind=='man') && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=news&act=man&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                        </ul>
                    </li>
                    <?php } ?>

                   

                    <!-- Tags -->
                    <?php if(isset($config['tags'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('tags', 'man', '', $config['tags'], 'phrase-2')) $none = "d-none";
                    if($com=='tags' && !isset($disabled['tags'][$_GET['type']]))
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý tags">
                            <i class="nav-icon text-sm fas fa-tags"></i>
                            <p>
                                Quản lý tags
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach($config['tags'] as $k => $v) { if(!isset($disabled['tags'][$k])) { ?>
                            <?php
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('tags', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='tags' && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=tags&act=man&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- Newsletter -->
                    <?php if(isset($config['newsletter'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('newsletter', 'man', '', $config['newsletter'], 'phrase-2')) $none = "d-none";
                    if($com=='newsletter' && !isset($disabled['newsletter'][$_GET['type']]))
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý nhận tin">
                            <i class="nav-icon text-sm fas fa-envelope"></i>
                            <p>
                                Quản lý nhận tin
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach($config['newsletter'] as $k => $v) { if(!isset($disabled['newsletter'][$k])) { ?>
                            <?php
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('newsletter', 'man', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='newsletter' && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=newsletter&act=man&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- Static -->
                    <?php if(isset($config['static'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('static', 'capnhat', '', $config['static'], 'phrase-2')) $none = "d-none";
                    if($com=='static' && !isset($disabled['static'][$_GET['type']]))
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý trang tĩnh">
                            <i class="nav-icon text-sm fas fa-bookmark"></i>
                            <p>
                                Quản lý trang tĩnh
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach($config['static'] as $k => $v) { if(!isset($disabled['static'][$k])) { ?>
                            <?php
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('static', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='static' && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=static&act=capnhat&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- Gallery -->
                    <?php if(isset($config['photo'])) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('photo', 'photo_static', '', $config['photo']['photo_static'], 'phrase-2') && $func->check_access('photo', 'man_photo', '', $config['photo']['man_photo'], 'phrase-2')) $none = "d-none";
                    if($com=='photo' && !isset($disabled['photo'][$_GET['type']]) && !isset($disabled['photo_static'][$_GET['type']]))
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý hình ảnh - video">
                            <i class="nav-icon text-sm fas fa-photo-video"></i>
                            <p>
                                Quản lý hình ảnh - video
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(isset($config['photo']['photo_static'])) { ?>
                            <?php foreach($config['photo']['photo_static'] as $k => $v) { if(!isset($disabled['photo_static'][$k])) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('photo', 'photo_static', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='photo' && $_GET['type']==$k && $act=='photo_static') $active = "active"; ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>"
                                    href="index.php?com=photo&act=photo_static&type=<?=$k?>"
                                    title="<?=$v['title_main']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                            <?php } ?>
                            <?php if(isset($config['photo']['man_photo'])) { ?>
                            <?php foreach($config['photo']['man_photo'] as $k => $v) { if(!isset($disabled['photo'][$k])) {
                                    $none = "";
                                    $active = "";
                                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('photo', 'man_photo', $k, null, 'phrase-1')) $none = "d-none";
                                    if($com=='photo' && $_GET['type']==$k && ($act=='man_photo' || $act=='add_photo' || $act=='edit_photo')) $active = "active"; ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=photo&act=man_photo&type=<?=$k?>"
                                    title="<?=$v['title_main_photo']?>"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v['title_main_photo']?></p>
                                </a>
                            </li>
                            <?php } } ?>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- Địa điểm -->

                    <?php if(isset($config['places']['active']) && $config['places']['active'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('places', 'man_city', '', null, 'phrase-1') && $func->check_access('places', 'man_district', '', null, 'phrase-1') && $func->check_access('places', 'man_wards', '', null, 'phrase-1') && $func->check_access('places', 'man_street', '', null, 'phrase-1')) $none = "d-none";
                    if($com=='places')
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý địa điểm">
                            <i class="nav-icon text-sm fas fa-building"></i>
                            <p>
                                Quản lý địa điểm
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php
                            $none = "";
                            $active = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('places', 'man_city', '', null, 'phrase-1')) $none = "d-none";
                            if($com=='places' && ($act=='man_city' || $act=='add_city' || $act=='edit_city')) $active = "active";
                            ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=places&act=man_city"
                                    title="Tỉnh thành"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Tỉnh thành</p>
                                </a>
                            </li>
                            <?php
                            $none = "";
                            $active = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('places', 'man_district', '', null, 'phrase-1')) $none = "d-none";
                            if($com=='places' && ($act=='man_district' || $act=='add_district' || $act=='edit_district')) $active = "active";
                            ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=places&act=man_district"
                                    title="Quận huyện"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Quận huyện</p>
                                </a>
                            </li>
                            <?php
                            $none = "";
                            $active = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('places', 'man_wards', '', null, 'phrase-1')) $none = "d-none";
                            if($com=='places' && ($act=='man_wards' || $act=='add_wards' || $act=='edit_wards')) $active = "active";
                            ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=places&act=man_wards"
                                    title="Phường xã"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Phường xã</p>
                                </a>
                            </li>
                            <?php
                            $none = "";
                            $active = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('places', 'man_street', '', null, 'phrase-1')) $none = "d-none";
                            if($com=='places' && ($act=='man_street' || $act=='add_street' || $act=='edit_street')) $active = "active";
                            ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=places&act=man_street"
                                    title="Đường"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Đường</p>
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- Comments -->
                    <?php if(isset($config['comments']['active']) && $config['comments']['active'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('comments', 'man', '', null, 'phrase-1')) $none = "d-none";
                    if($com=='comments') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=comments&act=man" title="Quản lý đánh giá">
                            <i class="nav-icon text-sm fas fa-chalkboard"></i>
                            <p>Quản lý đánh giá</p>
                        </a>
                    </li>
                    <?php } ?>

                    <!-- Coupons -->
                    <?php if(isset($config['coupons']['active']) && $config['coupons']['active'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('coupons', 'man', '', null, 'phrase-1')) $none = "d-none";
                    if($com=='coupons') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=coupons&act=man" title="Quản lý mã giảm giá">
                            <i class="nav-icon text-sm fas fa-gift"></i>
                            <p>Quản lý mã giảm giá</p>
                        </a>
                    </li>
                    <?php } ?>

                    <!-- Cart -->
                    <?php if(isset($config['order']['active']) && $config['order']['active'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('order', 'man', '', null, 'phrase-1')) $none = "d-none";
                    if($com=='order') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=order&act=man" title="Quản lý đơn hàng">
                            <i class="nav-icon text-sm fas fa-shopping-bag"></i>
                            <p>Quản lý đơn hàng</p>
                        </a>
                    </li>
                    <?php } ?>

                    <!-- Transition -->
                    <?php if(isset($config['transition']['active']) && $config['transition']['active'] == true) {?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = '';
                    if(isset($kiemtra) && $kiemtra == true) {
                        if($func->check_access('transition', 'man_mem', '', null, 'phrase-1') || $func->check_access('transition', 'man_admin', '', null, 'phrase-1')) {
                            $none = "d-none";
                        } 
                    }
                    if($com=='transition') {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    };
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý thay đổi số dư">
                            <i class="nav-icon text-sm fas fa-money-check"></i>
                            <p>
                                Quản lý số dư
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(isset($config['transition']['admin']) && $config['transition']['admin'] == true) {?>
                            <?php 
                            $none = "";
                            $active = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('transition', 'man_admin', '', null, 'phrase-1')) $none = "d-none";
                            if($com=='transition' && ($act=='man_admin' || $act=='add_admin' || $act=='edit_admin')) $active = "active";
                            ?>
                                <li class="nav-item"><a class="nav-link <?=$active?>"
                                    href="index.php?com=transition&act=man_admin" title="Số dư admin"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Số dư admin</p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($config['transition']['member']) && $config['transition']['member'] == true) {?>
                            <?php 
                            $none = "";
                            $active = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('transition', 'man_mem', '', null, 'phrase-1')) $none = "d-none";
                            if($com=='transition' && ($act=='man_mem' || $act=='add_mem' || $act=='edit_mem')) $active = "active";
                            ?>
                                <li class="nav-item"><a class="nav-link <?=$active?>" href="index.php?com=transition&act=man_mem"
                                    title="Số dư khách"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Số dư khách</p>
                                </a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- Timeline -->
                    <?php if(isset($config['timeline']['active']) && $config['timeline']['active'] == true) {?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = '';
                    if(isset($kiemtra) && $kiemtra == true) {
                        if($func->check_access('timeline', 'man_mem', '', null, 'phrase-1') || $func->check_access('timeline', 'man_admin', '', null, 'phrase-1')) {
                            $none = "d-none";
                        } 
                    }
                    if($com=='timeline') {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    };
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý trang cá nhân">
                            <i class="nav-icon text-sm fas fa-stream"></i>
                            <p>
                                Quản lý trang cá nhân
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(isset($config['timeline']['admin']) && $config['timeline']['admin'] == true) {?>
                            <?php 
                            $none = "";
                            $active = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('timeline', 'man_admin', '', null, 'phrase-1')) $none = "d-none";
                            if($com=='timeline' && ($act=='man_admin' || $act=='add_admin' || $act=='edit_admin')) $active = "active";
                            ?>
                                <li class="nav-item"><a class="nav-link <?=$active?>"
                                    href="index.php?com=timeline&act=man_admin" title="Trang cá nhân admin">
                                    <i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Trang cá nhân admin</p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($config['timeline']['member']) && $config['timeline']['member'] == true) {?>
                            <?php 
                            $none = "";
                            $active = "";
                            if(isset($kiemtra) && $kiemtra == true) if($func->check_access('timeline', 'man_mem', '', null, 'phrase-1')) $none = "d-none";
                            if($com=='timeline' && ($act=='man_mem' || $act=='add_mem' || $act=='edit_mem')) $active = "active";
                            ?>
                                <li class="nav-item"><a class="nav-link <?=$active?>" href="index.php?com=timeline&act=man_mem"
                                    title="Trang cá nhân khách"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Trang cá nhân khách</p>
                                </a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- User -->
                    <?php if(isset($config['user']['active']) && $config['user']['active'] == true && !$func->check_permission()) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if($com=='user' && $act!="auto-transition-admin" && $act!='login' && $act!='logout' && $act!='admin_edit' && $act!="add-timeline-admin" && $act!="edit-timeline-admin" && $act!="edit-photo-timeline-admin" && $act!="add-photo-timeline-admin" && $act!="edit-address-admin" && $act!="add-address-admin" && $act!="edit-bank-admin" && $act!="add-bank-admin" && $act!="edit-transition-admin" && $act!="add-transition-admin")
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý user">
                            <i class="nav-icon text-sm fas fa-users"></i>
                            <p>
                                Quản lý user
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php if(isset($config['permission']) && $config['permission'] == true) {
                                $active = "";
                                if($act=='permission_group' || $act=='add_permission_group' || $act=='edit_permission_group') $active = "active"; ?>
                            <li class="nav-item"><a class="nav-link <?=$active?>"
                                    href="index.php?com=user&act=permission_group" title="Nhóm quyền"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Nhóm quyền</p>
                                </a></li>
                            <?php } ?>

                            <?php if(isset($config['user']['admin']) && $config['user']['admin'] == true) {
                                $active = "";
                                if($com=='user' && ($act=='man_admin' || $act=='add_admin' || $act=='edit_admin' || $act=="add-address-man-admin" || $act=="add-bank-man-admin" || $act=="edit-bank-man-admin" || $act=="edit-address-man-admin" || $act=="add-transition-man-admin" || $act=="edit-transition-man-admin" || $act=="edit-timeline-man-admin" || $act=="add-timeline-man-admin" || $act=="add-photo-timeline-man-admin" || $act=="edit-photo-timeline-man-admin")) $active = "active"; ?>
                            <li class="nav-item"><a class="nav-link <?=$active?>"
                                    href="index.php?com=user&act=man_admin" title="Tài khoản admin"><i
                                        class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Tài khoản admin</p>
                                </a></li>
                            <?php } ?>
                            <?php if(isset($config['user']['visitor']) && $config['user']['visitor'] == true) {
                                $active = "";
                                if($com=='user' && ($act=='man' || $act=='add' || $act=='edit' || $act=="add-address" || $act=="add-bank" || $act=="edit-bank" || $act=="edit-address" || $act=="add-transition" || $act=="edit-transition" || $act=="edit-timeline" || $act=="add-timeline" || $act=="add-photo-timeline" || $act=="edit-photo-timeline")) $active = "active"; ?>
                            <li class="nav-item"><a class="nav-link <?=$active?>" href="index.php?com=user&act=man"
                                    title="Tài khoản khách"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p>Tài khoản khách</p>
                                </a></li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <!-- Onesignal -->
                    <?php if(isset($config['onesignal']) && $config['onesignal'] == true) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('pushOnesignal', 'man', '', null, 'phrase-1')) $none = "d-none";
                    if($com=='pushOnesignal') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=pushOnesignal&act=man"
                            title="Quản lý thông báo đẩy">
                            <i class="nav-icon text-sm fas fa-bell"></i>
                            <p>Quản lý thông báo đẩy</p>
                        </a>
                    </li>
                    <?php } ?>

                    <!-- SEO page -->
                    <?php if(isset($config['seopage']) && count($config['seopage']['page']) > 0) { ?>
                    <?php
                    $none = "";
                    $active = "";
                    $menuopen = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('seopage', 'capnhat', '', $config['seopage']['page'], 'phrase-2')) $none = "d-none";
                    if($com=='seopage')
                    {
                        $active = 'active';
                        $menuopen = 'menu-open';
                    }
                    ?>
                    <li class="nav-item has-treeview <?=$menuopen?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="#" title="Quản lý SEO page">
                            <i class="nav-icon text-sm fas fa-share-alt"></i>
                            <p>
                                Quản lý SEO page
                                <i class="right fas fa-angle-left"></i>
                            </p>
                        </a>
                        <ul class="nav nav-treeview">
                            <?php foreach($config['seopage']['page'] as $k => $v) { ?>
                            <?php
                                $none = "";
                                $active = "";
                                if(isset($kiemtra) && $kiemtra == true) if($func->check_access('seopage', 'capnhat', $k, null, 'phrase-1')) $none = "d-none";
                                if($com=='seopage' && $k==$_GET['type']) $active = "active";
                                ?>
                            <li class="nav-item <?=$none?>">
                                <a class="nav-link <?=$active?>" href="index.php?com=seopage&act=capnhat&type=<?=$k?>"
                                    title="<?=$v?>"><i class="nav-icon text-sm far fa-caret-square-right"></i>
                                    <p><?=$v?></p>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>

                    <?php
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('lang', 'man', '', null, 'phrase-1')) $none = "d-none";
                    if($com=='lang') $active = "active";
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                        <a href="index.php?com=lang&act=man" class="nav-link <?=$active?>" title="Quản lý ngôn ngữ">
                            <i class="nav-icon text-sm fas fa-language"></i>
                            <span>Quản lý ngôn ngữ</span>
                        </a>
                    </li>

                    <?php
                    $active = "";
                    if($act=='admin_edit' || $act=="add-timeline-admin" || $act=="edit-timeline-admin" || $act=="auto-transition-admin" || $act=="edit-photo-timeline-admin" || $act=="add-photo-timeline-admin" || $act=="edit-address-admin" || $act=="add-address-admin" || $act=="edit-bank-admin" || $act=="add-bank-admin" || $act=="edit-transition-admin" || $act=="add-transition-admin") $active = "active";
                    ?>
                    <li class="nav-item"><a class="nav-link <?=$active?>" href="index.php?com=user&act=admin_edit"
                            title="Quản lí tài khoản"><i class="nav-icon text-sm fas fa-user-cog"></i> 
                            <p>Quản lí tài khoản</p>
                        </a></li>

                    <!-- Thiết lập thông tin -->
                    <?php
                    $none = "";
                    $active = "";
                    if(isset($kiemtra) && $kiemtra == true) if($func->check_access('setting', 'capnhat', '', null, 'phrase-1')) $none = "d-none";
                    if($com=='setting') $active = 'active';
                    ?>
                    <li class="nav-item <?=$active?> <?=$none?>">
                        <a class="nav-link <?=$active?>" href="index.php?com=setting&act=capnhat"
                            title="Thiết lập thông tin">
                            <i class="nav-icon text-sm fas fa-cogs"></i>
                            <p>Thiết lập thông tin</p>
                        </a>
                    </li>

                   
                </ul>
            </nav>
        </div>
    </aside>

    <script type="text/javascript">
$(document).ready(function() {
    if ($(".menu-group").length) {
        var navlink = $(".menu-group").find(".nav-link.active").first();
        if (navlink.length) {
            var menugroup = navlink.parents(".menu-group");
            menugroup.addClass("menu-open");
            menugroup.find(">.nav-link").addClass("active");
        }
    }

    if ($(".nav-sidebar").find(">li.nav-item").not('.menu-group, .d-none').length) {
        var navitem = $(".nav-sidebar").find(">li.nav-item").not('.menu-group, .d-none');
        navitem.each(function(index) {
            var navtreeview = $(this).find(">ul.nav-treeview");
            if (navtreeview.length) {
                var navitemchild = $(this).find(">ul.nav-treeview").find(">li.nav-item");
                var navitemchildnone = $(this).find(">ul.nav-treeview").find(">li.nav-item.d-none");
                if (navitemchild.length) {
                    if (navitemchild.length == navitemchildnone.length) {
                        if (!$(this).hasClass("d-none")) {
                            $(this).addClass("d-none");
                        }
                    }
                } else if (navitemchild.length == 0 && navitemchildnone.length == 0) {
                    if (!$(this).hasClass("d-none")) {
                        $(this).addClass("d-none");
                    }
                }
            }
        });
    }
})
    </script>