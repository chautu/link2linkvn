<div class="center">
    <div class="title-main hidden">
        <h1><?=(@$title_cat!='')?$title_cat:@$title_crumb?></h1>
        <p><?= isset($slogan['ten']) ? $slogan['ten'] : ''?></p>
    </div>
    <div class="section-news-page pb-3">
        <div class="w-clear">
            <div class="header-tintuc">
                <h2><?= post ?></h2>
                <div class="layout__tintuc">
                    <div class="view-grida <?= !isset($_COOKIE['view-news']) || $_COOKIE['view-news'] == 'grid1' ? 'active' : ''  ?>" data-view="grid1">
                        <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 20 20" aria-hidden="true" width="20" height="20" fill="none" style="width: 20px; height: 20px;"><rect width="5" height="5" fill="currentColor"></rect><rect y="7.5" width="5" height="5" fill="currentColor"></rect><rect y="15" width="5" height="5" fill="currentColor"></rect><rect x="7.5" width="12.5" height="5" fill="currentColor"></rect><rect x="7.5" y="7.5" width="12.5" height="5" fill="currentColor"></rect><rect x="7.5" y="15" width="12.5" height="5" fill="currentColor"></rect></svg>
                    </div>
                    <div class="view-grida <?= isset($_COOKIE['view-news']) && $_COOKIE['view-news'] == 'grid2' ? 'active' : ''  ?>" data-view="grid2">
                        <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 20 20" aria-hidden="true" width="20" height="20" fill="none" style="width: 20px; height: 20px;"><path d="M11.4286 20H20V11.4286H11.4286V20Z" fill="currentColor"></path><path d="M0 20H8.57143V11.4286H0V20Z" fill="currentColor"></path><path d="M11.4286 8.57143H20V0H11.4286V8.57143Z" fill="currentColor"></path><path d="M0 8.57143H8.57143V0H0V8.57143Z" fill="currentColor"></path></svg>
                    </div>
                    <div class="view-grida <?= isset($_COOKIE['view-news']) && $_COOKIE['view-news'] == 'grid3' ? 'active' : ''  ?>" data-view="grid3">
                        <svg class="MuiSvgIcon-root" focusable="false" viewBox="0 0 20 20" aria-hidden="true" width="20" height="20" fill="none" style="width: 20px; height: 20px;"><rect width="20" height="5" fill="currentColor"></rect><rect y="7" width="20" height="13" fill="currentColor"></rect></svg>
                    </div>
                </div>
            </div>
            <div class="container__tin-tuc <?= !isset($_COOKIE['view-news']) ? 'grid1' : $_COOKIE['view-news'] ?>">
            <?php if(count($news)>0) { ?>
                <?php foreach($news as $n) { ?>
                    <?php $category = $d->rawQuery("select ten$lang as ten, $sluglang, id from #_news_cat where id_list = ? and hienthi > 0 order by stt,id desc",array($n['id'])); ?>
                    <div class="item-news">
                        <div class="pics-news">
                            <a class="text-decoration-none scale-img" href="<?=$n[$sluglang]?>" title="<?=$n['ten']?>">
                                <img onerror="this.src='<?=THUMBS?>/599x360x2/assets/images/noimage.png';" src="<?=THUMBS?>/599x360x1/<?=UPLOAD_NEWS_L.$n['photo']?>" alt="<?=$n['ten']?>">
                            </a>
                        </div>
                        <div class="content-item-news">
                            <div class="category-news">
                                <a href="<?= $category ? $category[$sluglang] : 'javascript:window.location.reload(true);' ?>" title="<?= $category ? $category['ten'] : $title_crumb ?>"><?= $category ? $category['ten'] : $title_crumb ?></a>
                                <span> &nbsp; &#8226; &nbsp; <?=date("d/m/Y h:i A",$n['ngaytao'])?></span>
                            </div>
                            <div class="name-news">
                                <a class="text-decoration-none scale-img" href="<?=$n[$sluglang]?>" title="<?=$n['ten']?>">
                                    <?=$n['ten']?>
                                </a>
                            </div>
                            
                            <div class="description-news">
                                <p><?=$n['mota']?></p>
                            </div>
                            <div class="link-news">
                                <a href="<?=$n[$sluglang]?>" title="<?=$n['ten']?>"><?= viewdetail ?></a>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            <?php } else { ?> 
                <div class="alert alert-danger-custom" role="alert">
                    <strong><?=norecord?></strong>
                </div>
            <?php } ?>
            </div>
            <div class="clear"></div>
            <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
        </div>
        <div class="filter-product">
            <form action="" method="get">
                <div class="w-clear" id="search_bar">
                    <input type="text" name="keyword-news" id="search-desktop" placeholder="<?=enterkeywords?>"/>
                    <button type="submit"><i class="fas fa-search"></i></button>
                </div>
            </form>
            <?php if(count($menu_news)) { ?>   
                <div class="group-filter filter-city no-select">
                    <p><?= 	categoriesnews ?>:</p>
                    <?php foreach($menu_news as $nm) { ?> 
                        <a class="text-split text-split-1" href="<?= $nm[$sluglang] ?>" title="<?= $nm['ten'] ?>"><?= $nm['ten'] ?></a>
                    <?php } ?>
                    <?php if(count($menu_news) > 6) { ?> 
                    <div class="viewcity-filter">
                        <?= viewmore ?>
                    </div>
                    <?php } ?>
                </div>
            <?php } ?>
            <?php if(count($tinnb)) { ?> 
            <div class="tinnoibat">
                <p><?= featuredarticle ?></p>
                <?php foreach($tinnb as $tnb) { ?> 
                    <a class="text-split text-split-2" href="<?= $tnb[$sluglang] ?>" title="<?= $tnb['ten'] ?>"><?= $tnb['ten'] ?></a>
                <?php } ?>
            </div>
            <?php } ?>
        </div>
    </div>
</div>

