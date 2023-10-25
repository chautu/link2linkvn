<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="table-user nomal-info-user bg-user">
                <div class="header-table">
                    <button class="default-button open-popup-user" data-act="member_address" data-id="0"><i class="fas fa-plus-circle mr-2"></i> <?= createnaddress ?></button>
                </div>
                <div class="content-table">
                    <?php foreach($address as $adr) { ?> 
                        <label id="box-remove-<?= $adr['id'] ?>" class="item-table no-select <?= $adr['macdinh'] > 0 ? "active" : "" ?>" for="macdinh<?= $adr['id'] ?>">
                            <div class="content-diachi">
                                <div class="top-diachi">
                                    <input type="radio" class="radio-macdinh" data-table="member_address" value="<?= $adr['id'] ?>" id="macdinh<?= $adr['id'] ?>" <?= $adr['macdinh'] > 0 ? "checked" : "" ?> name="macdinh">
                                    <p><?= thedefault ?></p>
                                </div>
                                <h4>
                                <strong><?= $adr['ten'] ? $adr['ten'].', ': "" ?></strong> 
                                <?= $adr['diachi'] ? $adr['diachi'].', ': "" ?>
                                <?= $func->get_places("street",$adr['id_street'],$config['website']['lang-default']) ? $func->get_places("street",$adr['id_street']).', ': "" ?>
                                <?= $func->get_places("wards",$adr['id_wards'],$config['website']['lang-default']) ? $func->get_places("wards",$adr['id_wards'],$config['website']['lang-default']).', ': "" ?>
                                <?= $func->get_places("district",$adr['id_district'],$config['website']['lang-default']) ? $func->get_places("district",$adr['id_district'],$config['website']['lang-default']).', ': "" ?>
                                <?= $func->get_places("city",$adr['id_city'],$config['website']['lang-default']) ?>    
                            </div>
                            <div class="action-diachi">
                                <button class="edit-act open-popup-user" data-act="member_address" data-id="<?= $adr['id'] ?>"><i class="fas fa-pen"></i></button>
                                <button class="remove-act" data-box="box-remove-<?= $adr['id'] ?>" data-table="member_address" data-id="<?= $adr['id'] ?>"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </label>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>        
</div>