<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="table-user nomal-info-user bg-user">
                <div class="content-table">
                    <div class="item-table orders_table no-select">
                        <div class="order-ma">
                            <?= ordercode ?>
                        </div>
                        <div class="order-ngaytao">
                            <?= orderday ?>
                        </div>
                        <div class="order-diachi">
                            <?= address ?>
                        </div>
                        <div class="order-total">
                            <?= total ?>
                        </div>
                        <div class="order-httt">
                            <?= orderpayment ?>
                        </div>
                        <div class="order-trangthai">
                            <?= status ?>
                        </div>
                        <div class="order-view text-right">
                            <?= view ?>
                        </div>
                    </div>
                    <?php foreach($orders as $tr) { ?> 
                        <div class="item-table orders_table no-select">
                            <div class="order-ma" data-title="<?= ordercode ?>">
                                <?= $tr['madonhang'] ?>
                            </div>
                            <div class="order-ngaytao" data-title="<?= orderday ?>">
                                <?= date("H:i d-m-Y",$tr['ngaytao'])  ?>
                            </div>
                            <div class="order-diachi text-split text-split-1"  data-title="<?= address ?>">
                                <?= $tr['diachi'] ?>
                            </div>
                            <div class="order-total"  data-title="<?= total ?>">
                                <?= number_format($tr['tonggia']) ?> <?= unitonly ?>
                            </div>
                            <div class="order-httt" data-title="<?= orderpayment ?>">
                                <?=$func->get_payments($tr['httt'], $config['website']['lang-default'])?>
                            </div>
                            <div class="order-trangthai" data-title="<?= status ?>">
                                <?= $func->get_status("status", $tr['tinhtrang']) ?>
                            </div>
                            <div class="order-view text-right" data-title="<?= view ?>">
                                <a class="edit-act" href="account/hoa-don?id=<?= $tr['id'] ?>"><i class="fas fa-pen"></i></a>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>