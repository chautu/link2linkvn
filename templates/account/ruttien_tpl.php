<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="nomal-info-user bg-user no-overflow">           
                <form class="validation-user form-nomarl" novalidate action="" method="post">
                    <div class="input-group input-normal">
                        <label for="moneyrut"><?= moneywithdraw ?>: </label>
                        <input type="text" class="format-price" id="moneyrut" name="moneyrut" placeholder="<?= entermoneywithdraw ?>" required />
                        <div class="invalid-feedback"><?= requiredmoneywithdraw ?></div>
                    </div>
                    <div class="input-normal">
                        <label for="nganhangrut"><?= bankwithdraw ?>:</label>
                        <select name="nganhangrut" id="nganhangrut" class="select2" required>
                            <option value="" disabled="" selected="" hidden=""><?= checkbank ?></option>
                            <?php foreach($banks as $bank) { ?> 
                                <option value="<?= $bank['id'] ?>"> <?= $bank['chutk'] ?> - <?= $bank['stk'] ?> - <?= $func->get_places("news_list", $bank['id_bank']); ?></option>
                            <?php } ?>
                        </select>
                        <div class="invalid-feedback"><?= requiredcheckbank ?></div>
                    </div>
                    <div class="input-group input-normal">
                        <label for="noidungrut"><?= contentnote ?>: </label>
                        <textarea name="noidungrut" id="noidungrut" placeholder="<?= entercontentnote ?>" cols="30" rows="5" required></textarea>
                        <div class="invalid-feedback"><?= requiredcontentnote ?></div>
                    </div>  
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="default-button" name="savert" value="<?= save ?>" disabled />
                        <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
