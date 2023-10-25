<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="table-user nomal-info-user bg-user">
                <h3><strong><?= informationorder ?></strong></h3>
                <div class="content-order-detail py-3">
                    <p><?= codeorder ?>: <strong><?= $detail_order['madonhang'] ?></strong></p>
                    <p><?= orderuser ?>: <strong><?= $detail_order['hoten'] ?></strong></p>
                    <p><?= phone ?>: <strong><?= $detail_order['dienthoai'] ?></strong></p>
                    <p><?= email ?>: <strong><?= $detail_order['email'] ?></strong></p>
                    <p><?= address ?>: <strong><?= $detail_order['diachi'] ?></strong></p>
                    <p><?= provisional ?>: <strong><?= number_format($detail_order['tamtinh']) ?><?= unitonly ?></strong></p>
                    <p><?= discount ?>: <strong><?= number_format($detail_order['giamgia']) ?><?= unitonly ?></strong></p>
                    <p><?= total ?>: <strong><?= number_format($detail_order['tonggia']) ?><?= unitonly ?></strong></p>
                    <p><?= otherrequirements ?>: <strong><?= $detail_order['yeucaukhac'] ?></strong></p>
                    <?php if($detail_order['guitang'] > 0) { ?> 
                        <p><?= 	donated ?>: <strong><?= $detail_order['tennguoigui'] ?> <?= send ?> <?= $detail_order['tennguoinhan'] ?></strong></p>
                        <p><?= message ?>: <?= $detail_order['thongdiep'] ?></p>
                    <?php } ?>
                    <p><?= orderpayment ?>:   <?=$func->get_payments($detail_order['httt'], $config['website']['lang-default'])?></p>
                    <p><?= status ?>: <?= $func->get_status("status", $detail_order['tinhtrang']) ?></p>
                </div>
                <h3 class="pt-3"><strong><?= orderdetail ?></strong></h3>
                <div class="content-product-order py-3">
                    <?php foreach($products as $prd) { ?> 
                        <div class="items-cart items-order-detail">
                            <div class="img-cart">
                                <img onerror="this.src='<?=THUMBS?>/120x120x2/assets/images/noimage.png';" 
                                src="<?=THUMBS?>/120x120x1/<?=UPLOAD_PRODUCT_L.$prd['photo']?>" 
                                alt="<?= $prd['ten'] ?>">
                            </div>
                            <div class="text-cart">
                                <h2>
                                    <a title="<?= $prd['ten'] ?>" class="text-split text-split-1">
                                        <?= $prd['ten'] ?>
                                    </a> 
                                </h2>
                                <p class="options-cart text-split text-split-1">
                                    <?= classify ?>: 
                                    <?= $prd['attribute'] ?>
                                </p>
                                <div class="price-cart">
                                    <div class="gia-box">
                                        <p><?= $prd['giamoi'] ? number_format($prd['giamoi']) : number_format($prd['gia']) ?><?= unitonly ?></p> 
                                        <p class="gia-old"><?= $prd['giamoi'] ? number_format($prd['gia']) : "" ?><?= unitonly ?></p>
                                    </div>
                                </div>
                                <div class="action-cart">
                                    <p><?= quantity ?> : <?= $prd['soluong'] ?></p>
                                </div>
                            </div>
                        </div> 
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

