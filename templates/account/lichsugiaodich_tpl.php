<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="table-user nomal-info-user bg-user">
                <div class="content-table">
                    <div class="item-table transition_table no-select">
                        <div class="transition_money">
                            <?= money ?>
                        </div>
                        <div class="transition_last_money">
                            <?= lastmoney ?>
                        </div>
                        <div class="transition_noidung">
                            <?= content ?>
                        </div>
                        <div class="transition_ghichu">
                            <?= note ?>
                        </div>
                        <div class="transition_trangthai">
                            <?= status ?>
                        </div>
                        <div class="transition_ngaytao">
                            <?= createday ?>
                        </div>
                    </div>
                    <?php foreach($transitions as $tr) { ?> 
                        <div class="item-table transition_table no-select">
                            <div class="transition_money <?= $tr['type'] ? 'text-danger' : 'text-success' ?>" data-title="<?= money ?>">
                                <?= $tr['type'] ? '-' : '+' ?> <?= number_format($tr['money']) ?>
                            </div>
                            <div class="transition_last_money" data-title="<?= lastmoney ?>">
                                <?= number_format($tr['last_money']) ?>
                            </div>
                            <div class="transition_noidung" data-title="<?= content ?>">
                                <?= $tr['bank'] ?>
                            </div>
                            <div class="transition_ghichu" data-title="<?= note ?>">
                                <?= $tr['ghichu'] ?>
                            </div>
                            <div class="transition_trangthai" data-title="<?= status ?>">
                                <?= $func->get_status("status", $tr['id_status']) ?>
                            </div>
                            <div class="transition_ngaytao" data-title="<?= createday ?>">
                                <?=  date("H:i d-m-Y",$tr['ngaytao'])  ?>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>