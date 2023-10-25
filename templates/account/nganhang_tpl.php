<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="table-user nomal-info-user bg-user">
                <div class="header-table">
                    <button class="default-button open-popup-user" data-act="member_bank" data-id="0"><i class="fas fa-plus-circle mr-2"></i> <?= createnewbank ?></button>
                </div>
                <div class="content-table">
                    <?php foreach($banks as $ba) { ?> 
                        <label  id="box-remove-<?= $ba['id'] ?>" class="item-table no-select <?= $ba['macdinh'] > 0 ? "active" : "" ?>" for="macdinh<?= $ba['id'] ?>">
                            <div class="content-diachi">
                                <div class="top-diachi">
                                    <input type="radio" class="radio-macdinh"  data-table="member_bank" value="<?= $ba['id'] ?>" id="macdinh<?= $ba['id'] ?>" <?= $ba['macdinh'] > 0 ? "checked" : "" ?> name="macdinh">
                                    <p><?= thedefault ?></p>
                                </div>
                                <h4>
                                <?= $func->get_places("news_list", $ba['id_bank']) ?> 
                                <br>
                                <?= $ba['stk'] ?>
                                <br>  
                                <?= $ba['chutk'] ?>  
                            </div>
                            <div class="action-diachi">
                                <button class="edit-act open-popup-user" data-act="member_bank" data-id="<?= $ba['id'] ?>"><i class="fas fa-pen"></i></button>
                                <button class="remove-act" data-box="box-remove-<?= $ba['id'] ?>" data-table="member_bank" data-id="<?= $ba['id'] ?>"><i class="far fa-trash-alt"></i></button>
                            </div>
                        </label>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
