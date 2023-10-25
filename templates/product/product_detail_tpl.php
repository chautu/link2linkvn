<div class="center">
    <div class="w-clear page-detail-product">
        <div class="box-product-page">
            <div class="swiper-product">
                <div style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff" class="swiper mySwiper2 product-detail">
                    <div class="swiper-wrapper" id="lightgallery">
                        <?php foreach($hinhanhsp as $ha) { ?>
                            <?php if($ha['type_hienthi'] == 0) { ?>
                                <div class="swiper-slide product-detail" data-url="<?= UPLOAD_PRODUCT_L. $ha['photo'] ?>">
                                    <a class="zoom" href="<?=UPLOAD_PRODUCT_L.$ha['photo']?>" title="<?=$ha['ten']?>">
                                        <img src="<?= UPLOAD_PRODUCT_L. $ha['photo'] ?>" alt="<?= $ha['ten'] ?>" />
                                    </a>
                                </div>
                            <?php } else if($ha['type_hienthi'] == 1) { ?> 
                                <div class="swiper-slide product-detail" data-url="<?= $ha['link_video']?>">
                                    <a class="video-youtube" href="<?=$ha['link_video']?>" title="<?=$ha['ten']?>">
                                        <img src="https://img.youtube.com/vi/<?=$func->getYoutube($ha['link_video'])?>/0.jpg" alt="<?=$ha['ten']?>" />
                                    </a>
                                </div>
                            <?php } else { ?> 
                                <div class="swiper-slide product-detail" data-url="<?= UPLOAD_PRODUCT_L. $ha['taptin']?>">
                                    <div title="<?=$ha['ten']?>">
                                        <video controls data-autoplay style="width:100%; height: 100%">
                                            <source src="<?= UPLOAD_PRODUCT_L. $ha['taptin']?>" type="video/mp4">
                                        </video>
                                    </div>                               
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="swiper-slide product-detail">
                            <a class="zoom" href="<?=UPLOAD_PRODUCT_L.$row_detail['photo']?>">
                                <img src="<?= UPLOAD_PRODUCT_L. $row_detail['photo'] ?>" alt="<?= $row_detail['ten'] ?>" />
                            </a>
                        </div>
                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                    <canvas id="canvas" style="display: none;"></canvas>
                </div>
                <?php if(count($hinhanhsp)) { ?>
                <div thumbsSlider="" class="swiper mySwiper product-detail">
                    <div class="swiper-wrapper">
                        <?php foreach($hinhanhsp as $ha) { ?>
                            <?php if($ha['type_hienthi'] == 0) { ?>
                                <div class="swiper-slide product-detail">
                                    <img src="<?= UPLOAD_PRODUCT_L. $ha['photo'] ?>" alt="<?= $ha['ten'] ?>" />
                                </div>
                            <?php } else if($ha['type_hienthi'] == 1) { ?> 
                                <div class="swiper-slide product-detail video-youtube">
                                    <img src="https://img.youtube.com/vi/<?=$func->getYoutube($ha['link_video'])?>/0.jpg" alt="<?= $ha['ten'] ?>" />
                                </div>
                            <?php } else { ?> 
                                <div class="swiper-slide product-detail video-youtube">                                
                                    <img src="<?= UPLOAD_PRODUCT_L. $ha['photo'] ?>" alt="<?= $ha['ten'] ?>" />
                                </div>
                            <?php } ?>
                        <?php } ?>
                        <div class="swiper-slide product-detail">
                            <img src="<?= UPLOAD_PRODUCT_L. $row_detail['photo'] ?>" alt="<?= $row_detail['ten'] ?>" />
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <div class="sticky-product">
            <div class="box-detail-price">
                <h2><?= $row_detail['ten'] ?></h2>
                <div class="w-clear mt-3 content">
                    <?= nl2br($row_detail['mota']); ?>
                </div>
                <div class="thuoctinh-product-page mt-3">
                    <?php $atzAttributes = json_decode($row_detail['attributes']); $attr1 = $d->rawQuery("select ten$lang as ten, photo, id from #_product_attr where id in (".$row_detail['id_attr'].") and type_hienthi = ?", array(1)); ?>
                    <?php foreach($attr1 as $atz) {
                        $atz_details = $d->rawQuery("select ten$lang as ten from #_product_attributes where id in (". implode(",",$atzAttributes->{'attr_'.$atz['id']}).")");
                    ?> 
                        <div class="items--thuoctinh">
                            <img src="<?= THUMBS ?>/25x25x1/<?= UPLOAD_ATTR_L.$atz['photo'] ?>"
                                alt="<?= $atz['ten'] ?>" title="<?= $atz['ten'] ?>">
                            <p class="text-split text-split-2"><?= $atz['ten'] ?>: <?php foreach($atz_details as $key => $atzd) { ?><?= $key > 0 ? "," : '' ?> <?= $atzd['ten'] ?><?php } ?></p>
                        </div>
                    <?php } ?>
                </div>
                <?php 
                    $data = [
                        'count' => 0,
                        'sold' => 0,
                        'gia' => 0,
                        'giamoi' => 0,
                        'giakm' => 0
                    ];
                    if($row_detail['id_attr']) {
                        $attr2 = $d->rawQuery("select ten$lang as ten, id from #_product_attr where id in (".$row_detail['id_attr'].") and type_hienthi = ?", array(0));
                        if(isset($config['product'][$type]['type']) && $config['product'][$type]['type'] == 2) { 
                            $array_detail = [];
                            $attr_key = 'option_';
                            foreach($attr2 as $at) {
                                $array_detail[$attr_key.$at['id']] = [];
                            }
                            $attr_detail = $d->rawQuery("select options, gia, giakm, giamoi, quantity, sold from #_gallery where id_photo = ? and com='product' and type = ? and kind='man' and val = ? and hienthi > 0 and quantity > 0 order by stt,id desc",array($row_detail['id'],$type,'gia-'.$type));
                            if(!empty($attr_detail)) {
                                $minItem = array_reduce($attr_detail, function($carry, $item) {
                                    return $item['gia'] < $carry['gia'] ? $item : $carry;
                                }, $attr_detail[0]);
                                $data['gia'] = $minItem['gia'];
                                $data['giamoi'] = $minItem['giamoi'];
                                $data['giakm'] = $minItem['giakm'];
                                foreach($attr_detail as $detail) {
                                    $options = json_decode($detail['options']);
                                    $data['count'] += $detail['quantity'] - $detail['sold'];
                                    $data['sold'] += $detail['sold'];
                                    if(!empty($options)) {
                                        foreach($options as $key => $op) {
                                            $array_detail[$key][] = $op;
                                            $array_detail[$key] = array_unique($array_detail[$key]);
                                        } 
                                    }
                                }
                            } else {
                                $array_detail = [];
                                $attr_key = 'attr_';
                                foreach($attr2 as $at) {
                                    $array_detail[$attr_key.$at['id']] = [];
                                }
                                $data['count'] = $row_detail['quantity'] - $row_detail['sold']; 
                                $data['sold'] =  $row_detail['sold'];
                                $data['gia'] = $row_detail['gia'];
                                $data['giamoi'] = $row_detail['giamoi'];
                                $data['giakm'] = $row_detail['giakm'];
                                $attr_detail = json_decode($row_detail['attributes']);
                                if(!empty($attr_detail)) {
                                    foreach($array_detail as $key => $value) {
                                        $array_detail[$key] = $attr_detail->{$key};
                                    }
                                }
                            }
                        } else {
                            $array_detail = [];
                            $attr_key = 'attr_';
                            foreach($attr2 as $at) {
                                $array_detail[$attr_key.$at['id']] = [];
                            }
                            $data['count'] = $row_detail['quantity'] - $row_detail['sold']; 
                            $data['sold'] =  $row_detail['sold'];
                            $data['gia'] = $row_detail['gia'];
                            $data['giamoi'] = $row_detail['giamoi'];
                            $data['giakm'] = $row_detail['giakm'];
                            $attr_detail = json_decode($row_detail['attributes']);
                            if(!empty($array_detail)) {
                                foreach($array_detail as $key => $value) {
                                    $array_detail[$key] = $attr_detail->{$key};
                                }
                            }
                        }
                    } else {
                        $data['count'] = $row_detail['quantity'] - $row_detail['sold']; 
                        $data['sold'] =  $row_detail['sold'];
                        $data['gia'] = $row_detail['gia'];
                        $data['giamoi'] = $row_detail['giamoi'];
                        $data['giakm'] = $row_detail['giakm'];
                    }
                ?>
                 <div class="price-detail">   
                    <?php if(isset($config['product'][$type]['gia']) && $config['product'][$type]['gia'] == true) { ?>
                    <p class="<?= isset($config['product'][$type]['giamoi']) && $config['product'][$type]['giamoi'] == true ? "gia" : "giamoi" ?>"><sup><?= unitonly ?></sup><span id="change-gia" data-default="<?= number_format($data['gia']) ?>"><?= number_format($data['gia']) ?></span> </p> 
                    <?php } ?>
                    <?php if(isset($config['product'][$type]['giamoi']) && $config['product'][$type]['giamoi'] == true) { ?>
                    <p class="<?= isset($config['product'][$type]['gia']) && $config['product'][$type]['gia'] == true ? "giamoi" : "gia" ?>"><sup><?= unitonly ?></sup><span id="change-giamoi" data-default="<?= number_format($data['giamoi']) ?>"><?= number_format($data['giamoi']) ?></span> </p> 
                    <?php } ?>
                    <?php if(isset($config['product'][$type]['giakm']) && $config['product'][$type]['giakm'] == true) { ?>
                    <span id="change-giakm" data-default="<?= $data['giakm'] ?> <?= reduce ?>"><?= $data['giakm'] ?>% <?= reduce ?></span> 
                    <?php } ?>
                </div>
                <div class="attr-detail">
                    <?php if(isset($attr2) && !empty($attr2)) { ?> 
                        <?php foreach($attr2 as $at) { ?> 
                            <div class="items-arr">
                                <p><?= $at['ten'] ?>:</p>
                                <div class="arr-detail">
                                    <?php  ?>
                                    <?php foreach($array_detail[$attr_key.$at['id']] as $op) { 
                                        $attribute = $d->rawQueryOne("select id, ten$lang as ten, mau, photo, type_hienthi from #_product_attributes where id = ?", array($op));   ?> 
                                        <input type="checkbox" name="option_<?= $at['id'] ?>" value="<?= $attribute['id'] ?>" data-options="option_<?= $at['id'] ?>" data-photo="<?= $row_detail['id'] ?>" class="<?= isset($config['product'][$type]['type']) && $config['product'][$type]['type'] == 2 ? "picker" : "checkbox_attribute" ?> option_<?= $at['id'] ?>" id="pick_<?= $attribute['id'] ?>" required>
                                        <?php if($attribute['type_hienthi'] == 0) { ?> 
                                            <label for="pick_<?= $attribute['id'] ?>" class="pick_name"><span><?= $attribute['ten'] ?></span> </label>  
                                        <?php } else if($attribute['type_hienthi'] == 1) { ?> 
                                            <label for="pick_<?= $attribute['id'] ?>" class="pick_color"><div style="--color:#<?= $attribute['mau'] ?>"><?= $attribute['ten'] ?></div></label>  
                                        <?php } else { ?> 
                                            <label for="pick_<?= $attribute['id'] ?>" class="pick_image"><img src="<?= THUMBS ?>/80x30x1/<?= UPLOAD_ATTR_L.$attribute['photo'] ?>" alt="<?= $attribute['ten'] ?>"></label>  
                                        <?php } ?>  
                                    <?php } ?>
                                </div>
                            </div>
                        <?php } ?>    
                    <?php } ?>
                    <div class="items-arr">
                        <p><?= quantity ?>:</p>
                        <div class="arr-detail">
                            <div class="quantity-input">
                                <button data-for="add-cart" class="fas fa-minus minus-input"></button>
                                <input type="number" min="1" max="<?= $data['count'] ?>" name="p-cart" class="p-cart add-cart" id="add-cart" value="1">
                                <button data-for="add-cart" class="fas fa-plus plus-input"></button>
                            </div>
                            <p> <span id="change-quantity" data-default="<?= number_format($data['count']); ?>"><?= number_format($data['count']); ?> </span> <?= productsavailable ?></p>
                        </div>
                    </div>
                </div>
                <div class="add-to-cart">
                    <?php if(isset($config['cart']['active']) && $config['cart']['active'] == true) { ?> 
                        <a class="add-cart-now <?= isset($attr2) && !empty($attr2) ? "disable" : "warning" ?>" data-action="add" href="javascript:void(0)" data-id="<?= $row_detail['id'] ?>"><?= addcart ?></a>
                        <a class="add-cart-now confirm-cart <?= isset($attr2) && !empty($attr2) ? "disable" : "warning" ?>" data-action="payment" href="javascript:void(0)" data-id="<?= $row_detail['id'] ?>"><?= 	buynow ?></a>
                    <?php } else { ?> 
                        <a class="confirm-cart" href="javascript:void(0)"><?= contactfororder ?></a>
                    <?php } ?>
                </div>
                <div class="chinhsach-cart">
                    <hr class="my-4">
                    <h3>
                        <i class="fas fa-shield-alt"></i>
                        <span><?= 	commit ?></span>
                    </h3>
                    <hr class="my-4">
                </div>
                <div class="social-plugin social-plugin-pro-detail w-clear">
                    <div class="socials-share">
                        <a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-facebook-f"></span></a>
                        <a class="bg-twitter" href="https://twitter.com/share?text=<?= urlencode($seo->getSeo('description')) ?>&url=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-twitter"></span></a>
                        <a class="bg-email" href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to&su=<?= urlencode($seo->getSeo('title')) ?>&body=<?= urlencode($seo->getSeo('description')) ?>" target="_blank"><span class="fas fa-envelope"></span></a>
                        <a class="bg-pinterest" href="https://pinterest.com/pin/create/button/?url=<?= $func->getCurrentPageURL() ?>&description=<?= urlencode($seo->getSeo('description')) ?>&media=<?=$seo->getSeo('photo')?>" target="_blank"><span class="fab fa-pinterest-p"></span></a>
                        <a class="bg-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?= $func->getCurrentPageURL() ?>&title=<?= urlencode($seo->getSeo('title')) ?>&source=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-linkedin-in"></span></a>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="box-product-page">
            <div class="w-clear content">
                <?= htmlspecialchars_decode($row_detail['noidung']); ?>
            </div>
            
            <?php if($row_detail['diachi']) { ?> 
                <div class="address-product-page">
                    <?= $row_detail['diachi'] ?>
                </div>
            <?php } ?>
            <?php if($row_detail['iframe']) { ?> 
                <div class="iframe-map-product">
                    <?= htmlspecialchars_decode($row_detail['iframe']) ?>
                </div>
            <?php } ?>
        </div>
</div>
