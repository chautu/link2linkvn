<div class="center">
<form class="form-cart validation-cart" id="form-order" novalidate method="post" action="" enctype="multipart/form-data">
    <div class="wrap-cart d-flex align-items-stretch justify-content-between">
        <?php if (count($cart__)) { ?>
        <div class="top-cart loadding">
            
        </div>
        <div class="bottom-cart">
            <div class="section-cart">
                <p class="title-cart"><?= orderpayment ?>:</p>
                <div class="information-cart">
                    <?php for ($i = 0, $count = count($httt); $i < $count; $i++) { ?>
                    <div class="payments-cart custom-control custom-radio">
                        <input type="radio" class="custom-control-input" id="payments-<?= $httt[$i]['id'] ?>"
                            name="payments" value="<?= $httt[$i]['id'] ?>" required>
                        <label class="payments-label custom-control-label" for="payments-<?= $httt[$i]['id'] ?>"
                            data-payments="<?= $httt[$i]['id'] ?>"><?= $httt[$i]['ten'] ?></label>
                        <div class="payments-info payments-info-<?= $httt[$i]['id'] ?> transition">
                            <?= str_replace("\n", "<br>", $httt[$i]['mota']) ?></div>
                    </div>
                    <?php } ?>
                </div>
              
                <p class="title-cart no-select"><?= shipmentdetail ?>: <?php if(isset($diachis) && count($diachis)) { ?>  <span class="open-address"><i class="fas fa-pen mr-2"></i> <?= changetheaddress ?></span> <?php } ?> </p>
                <div class="information-cart">
                    <?php if(isset($diachis) && count($diachis)) { ?> 
                    <div class="choose-address mb-4" style="display:none">
                        <?php foreach($diachis as $adr) { ?> 
                            <div class="item-table no-select change-address-no <?= $adr['macdinh'] > 0 ? "active" : "" ?>" data-id="<?= $adr['id'] ?>" for="macdinh<?= $adr['id'] ?>">
                                <div class="content-diachi">
                                    <h4>
                                        <strong><?= $adr['ten'] ? $adr['ten'].', ': "" ?></strong> 
                                        <?= $adr['diachi'] ? $adr['diachi'].', ': "" ?>
                                        <?= $func->get_places("street",$adr['id_street'],$config['website']['lang-default']) ? $func->get_places("street",$adr['id_street']).', ': "" ?>
                                        <?= $func->get_places("wards",$adr['id_wards'],$config['website']['lang-default']) ? $func->get_places("wards",$adr['id_wards'],$config['website']['lang-default']).', ': "" ?>
                                        <?= $func->get_places("district",$adr['id_district'],$config['website']['lang-default']) ? $func->get_places("district",$adr['id_district'],$config['website']['lang-default']).', ': "" ?>
                                        <?= $func->get_places("city",$adr['id_city'],$config['website']['lang-default']) ?>    
                                    </h4>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <?php } ?>
                    <div class="address-load grid grid-1 gap-10">
                        <div class="input-group input-normal">
                            <input id="ten" name="ten-order" placeholder="<?= yourname ?>" type="text" required
                                value="<?= !empty($diachi['ten']) ? $diachi['ten'] : '' ?>" />
                            <div class="invalid-feedback"><?= requiredyourname ?></div>
                        </div>
                        <div class="input-group input-normal">
                            <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="dienthoai" 
                            name="dienthoai-order" placeholder="<?= yourphone ?>" required  value="<?= !empty($diachi['dienthoai']) ? $diachi['dienthoai'] : '' ?>" />
                            <div class="invalid-feedback"><?= requiredyourphone ?></div>
                        </div>
                        <div class="input-group input-normal">
                            <input id="email-profile" name="email-order" placeholder="<?= email ?>" type="email" required 
                            value="<?= !empty($diachi['email']) ? $diachi['email'] : '' ?>" />
                            <div class="invalid-feedback"><?= requiredemail ?></div>
                        </div>
                        <div class="grid grid-3 gap-10 gird-cdw w-clear">
                            <div class="input-normal">
                                <select class="select-city-cart custom-select select2" required id="city" name="city-order">
                                    <option value=""><?= city ?></option>
                                    <?php for ($i = 0; $i < count($city); $i++) { ?>
                                    <option value="<?= $city[$i]['id'] ?>" <?= (!empty($diachi['id_city']) && $diachi['id_city'] == $city[$i]['id']) ? 'selected' : '' ?>><?= $city[$i]['ten'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback"><?= requiredcity ?></div>
                            </div>
                            <div class="input-normal">
                                <select class="select-district-cart select-district custom-select select2" required id="district"
                                    name="district-order">
                                    <option value=""><?= district ?></option>
                                    <?php if(isset($district)) { ?> 
                                        <?php foreach($district as $di) { ?> 
                                            <option value="<?= $di['id'] ?>" <?= $di['id'] == $diachi['id_district'] ? "selected" : "" ?>><?= $di['ten'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback"><?= requireddistrict ?></div>
                            </div>
                            <div class="input-normal">
                                <select class="select-wards-cart select-wards custom-select select2" required id="wards"
                                    name="wards-order">
                                    <option value=""><?= wards ?></option>
                                    <?php if(isset($wards)) { ?> 
                                        <?php foreach($wards as $wa) { ?> 
                                            <option value="<?= $wa['id'] ?>" <?= $wa['id'] == $diachi['id_wards'] ? "selected" : "" ?>><?= $wa['ten'] ?></option>
                                        <?php } ?>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback"><?= requiredwards ?></div>
                            </div>
                        </div>
                        <div class="input-group input-normal">
                            <input id="diachi" name="diachi-order"  value="<?= !empty($diachi['diachi']) ? $diachi['diachi'] : '' ?>" placeholder="<?= enteraddress ?>" type="text" value="<?= !empty($row_detail['diachi']) ? $row_detail['diachi'] : '' ?>" required>
                            <div class="invalid-feedback"><?= requiredaddress ?></div>
                        </div>
                    </div>
                 
                    <div class="input-group input-normal my-3">
                        <textarea name="yeucaukhac-order" id="yeucaukhac" placeholder="<?= contentnote ?>" cols="30" rows="5" required></textarea>
                        <div class="invalid-feedback"><?= requiredcontentnote ?></div>
                    </div>  
                    <div class="checkbox-tagqua no-select">
                        <input type="checkbox" name="tangqua" id="tangqua" value="1">
                        <label for="tangqua"><?= givegiftstoothers ?></label>
                    </div>
                    <div class="tangquabox mt-3" style="display: none">
                        <div class="grid grid-2 gap-10">
                            <div class="input-group input-normal">
                                <input id="tennguoigui" name="tennguoigui" placeholder="<?= sendersname ?>" type="text"/>
                                <div class="invalid-feedback"><?= rqsendersname ?></div>
                            </div>
                            <div class="input-group input-normal">
                                <input id="tennguoinhan" name="tennguoinhan" placeholder="<?= recipientsname ?>" type="text"/>
                                <div class="invalid-feedback"><?= rqrecipientsname ?></div>
                            </div>
                        </div>
                        <div class="input-group input-normal my-3">
                            <textarea name="thongdiep" id="thongdiep" placeholder="<?= message ?>" cols="30" rows="5"></textarea>
                            <div class="invalid-feedback"><?= requiredmessage ?></div>
                        </div>  
                    </div>
                </div>

                <button class="default-button w-100" name="thanhtoan" type="submit" title="<?=pay?>"><?=pay?></button>
            </div>
        </div>
        <?php } else { ?>
            <div class="cart-no-item">
                <img src="assets/images/images/cart-no-item.svg" alt="<?= nocart ?>">
                <p><?= pcart ?></p>
                <a href="<?= $config_base ?>"><?= gohome ?></a>
            </div>
        <?php } ?>
    </div>
</form>
</div>
