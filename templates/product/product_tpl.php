<div class="title-main hidden">
    <h1><?=(@$title_cat!='')?$title_cat:@$title_crumb?></h1>
    <p><?=$slogan?$slogan['ten']:""?></p>
</div>

<div class="w-clear">
    <div class="center">
        <form method="get" action="" class="container-page-product">
            <div class="filter-product">
                <h3><i class="fas fa-filter mr-2"></i> <?= searchfilters ?></h3>
                <div class="form-filter">
                    <?php if(count($city)) { ?>   
                    <div class="group-filter filter-city no-select">
                        <p><?= placeofsale ?>:</p>
                        <?php foreach($city as $ci) { ?> 
                            <div class="form-radio">
                                <input type="radio" name="id_city"
                                    id="id_city_<?= $ci['id'] ?>" value="<?= $ci['id'] ?>">
                                <label for="id_city_<?= $ci['id'] ?>"><?= $ci['ten'] ?></label>
                            </div>
                        <?php } ?>
                        <?php if(count($city) > 6) { ?> 
                        <div class="viewcity-filter">
                            <?= viewmore ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <?php if(count($brands)) { ?> 
                    <div class="group-filter filter-brand no-select">
                        <p><?= brands ?>:</p>
                        <?php foreach($brands as $br) { ?> 
                            <div class="form-radio">
                                <input type="radio" name="id_brand"
                                    id="id_brand_<?= $br['id'] ?>" value="<?= $br['id'] ?>">
                                <label for="id_brand_<?= $br['id'] ?>"><?= $br['ten'] ?></label>
                            </div>
                        <?php } ?>
                        <?php if(count($brands) > 6) { ?> 
                        <div class="viewbrand-filter">
                            <?= viewmore ?>
                        </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="group-filter filter-price no-select">
                        <p><?= price ?>:</p>
                        <div class="group-price">
                            <div class="input-normal">
                                <label for="price_to"><?= pricefrom ?>:</label>
                                <input type="number" name="price_to" id="price_to" placeholder="<?= pricefrom ?>">
                            </div>
                            <div class="input-normal">
                                <label for="price_for"><?= pricearrived ?>:</label>
                                <input type="number" name="price_for" id="price_for" placeholder="<?= pricearrived ?>">
                            </div>
                        </div>
                    </div>
                    <div class="group-filter">
                        <p><?= keywords ?>:</p>
                        <div class="w-clear" id="search_bar">
                            <input type="text" name="keyword-filter" id="search-desktop" placeholder="<?=enterkeywords?>"/>
                            <button name="search-button" type="submit"><i class="fas fa-search"></i></button>
                        </div>
                    </div>
                    <button type="submit" class="default-button">
                        <?= apply ?>
                    </button>
                </div>
            </div>
            <div class="main-product">
                <div class="header-product">
                    <div class="order-filter">
                        <p><?= sortedby ?>:</p>
                        <button name="order" value="1" class="active">
                            <?= latest ?>
                        </button>
                        <button name="order" value="2">
                            <?= selling ?>
                        </button>
                        <button name="order" value="3">
                            <?= price ?>
                        </button>
                    </div>
                    <div class="paging-filter">
                        <p><?= display ?> <?= count($product) ?> <?= ontotal ?> <?= $total ?></p>
                    </div>
                </div>
                <?php if(isset($product) && count($product) > 0) { ?>
                    <div class="container-product">
                        <?php foreach($product as $item) { ?> 
                            <div class="item-product">
                                <div class="pic-product">
                                    <a class="text-decoration-none scale-img" href="<?=$item[$sluglang]?>" title="<?=$item['ten']?>">
                                        <img onerror="this.src='<?=THUMBS?>/540x540x2/assets/images/noimage.png';" src="<?=THUMBS?>/540x540x1/<?=UPLOAD_PRODUCT_L.$item['photo']?>" alt="<?=$item['ten']?>"/>
                                    </a>
                                </div>
                                <h2><a class="text-split text-split-2" href="<?= $item[$sluglang] ?>"><?= $item['ten'] ?></a></h2>
                                <?php 
                                    $data = [
                                        'count' => 0,
                                        'sold' => 0,
                                        'gia' => 0,
                                        'giamoi' => 0,
                                        'giakm' => 0
                                    ];
                                    if(isset($config['product'][$type]['type']) && $config['product'][$type]['type'] == 2) { 
                                        $attr_detail = $d->rawQuery("select options, gia, giakm, giamoi, quantity, sold from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and quantity > 0 order by stt,id desc",array($item['id'],$type,'gia-'.$type));
                                        $minItem = array_reduce($attr_detail, function($carry, $it) {
                                            return $it['gia'] < $carry['gia'] ? $it : $carry;
                                        }, $attr_detail[0]);
                                        $data['gia'] = $minItem['gia'];
                                        $data['giamoi'] = $minItem['giamoi'];
                                        $data['giakm'] = $minItem['giakm'];
                                        foreach($attr_detail as $detail) {
                                            $options = json_decode($detail['options']);
                                            $data['count'] += $detail['quantity'] - $detail['sold'];
                                            $data['sold'] += $detail['sold'];
                                        }
                                    } else {
                                        $data['count'] = $item['quantity'] - $item['sold']; 
                                        $data['sold'] =  $item['sold'];
                                        $data['gia'] = $item['gia'];
                                        $data['giamoi'] = $item['giamoi'];
                                        $data['giakm'] = $item['giakm'];
                                    } ?>
                                    <div class="price-detail-item">   
                                        <?php if(isset($config['product'][$type]['gia']) && $config['product'][$type]['gia'] == true) { ?>
                                        <p class="<?= isset($config['product'][$type]['giamoi']) && $config['product'][$type]['giamoi'] == true ? "gia" : "giamoi" ?>"><sup><?= unitonly ?></sup><span data-default="<?= number_format($data['gia']) ?>"><?= number_format($data['gia']) ?></span> </p> 
                                        <?php } ?>
                                        <?php if(isset($config['product'][$type]['giamoi']) && $config['product'][$type]['giamoi'] == true) { ?>
                                        <p class="<?= isset($config['product'][$type]['gia']) && $config['product'][$type]['gia'] == true ? "giamoi" : "gia" ?>"><sup><?= unitonly ?></sup><span data-default="<?= number_format($data['giamoi']) ?>"><?= number_format($data['giamoi']) ?></span> </p> 
                                        <?php } ?>
                                    </div>
                                    <?php if(isset($config['product'][$type]['giakm']) && $config['product'][$type]['giakm'] == true) { ?>
                                        <p class="item-sale" data-default="<?= $data['giakm'] ?> giảm"><span><?= $data['giakm'] ?>%</span><span><?= reduce ?></span> </p> 
                                    <?php } ?>
                                    <div class="quantity-item-prd">
                                        <p><?= number_format($data['count']) ?> <?= available ?></p>
                                        <p><?= number_format($data['sold']) ?> <?= sold ?></p>
                                    </div>
                            </div>
                        <?php } ?>
                    </div>
                <?php } else { ?>
                    <div class="alert alert-danger-custom" role="alert">
                        <strong><?=	norecord ?></strong>
                    </div>
                <?php } ?>
                <div class="clear"></div>
                <div class="pagination-home mt-3"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
            </div>
        
        </form>
    </div>
    
</div>