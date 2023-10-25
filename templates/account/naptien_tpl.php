<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="nomal-info-user pd-20 bg-user no-overflow">
                <div class="tabs-content">
                    <ul class="ul-tabs-content w-clear">
                        <li class="active transition" data-tabs="info-pro-detail"><?= rechargeauto ?></li>
                        <li class="transition" data-tabs="commentfb-pro-detail"><?= rechargehandmade ?></li>
                    </ul>
                    <div class="content-tabs-content info-pro-detail active">
                        <form class="validation-user grid grid-1 gap-10" novalidate action="" method="post">
                            <div class="input-group input-normal">
                                <label for="moneyauto"><?= moneyrecharge ?>: </label>
                                <input type="text" class="input-money format-price" id="moneyauto" name="moneyauto" placeholder="<?= entermoneyrecharge ?>" required />
                                <div class="invalid-feedback"><?= requiredmoneyrecharge ?></div>
                            </div>
                            <div class="custom-row">
                                <strong class="mb-2"><?= checkpaymentrecharge ?>:</strong>
                            </div>
                            <div class="custom-row grid-method">
                                <div class="debit-card mb-3">
                                    <label class="d-flex flex-column h-100 p-3">
                                        <div class="d-block">
                                            <div class="d-flex position-relative">
                                                <div>
                                                    <img src="assets/images/images/vnpay.png" class="visa"
                                                        alt="visa">
                                                    <p class="mt-2 text-white"><?= paymentwithvnpayqr ?></p>
                                                </div>
                                                <div class="input-debit-card">
                                                    <input type="radio" name="bankCode" id="bankCode" value="VNPAYQR" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-auto adcarddebit text-white card-title d-flex align-items-center justify-content-between">
                                            <p><?= vnpayqrdes ?></p>
                                            
                                        </div>
                                    </label>
                                </div>
                                <div class="debit-card card-2 mb-4">
                                    <label class="d-flex flex-column h-100 p-3">
                                        <div class="d-block">
                                            <div class="d-flex position-relative">
                                                <div>
                                                    <img src="assets/images/images/noidia.png"
                                                        alt="master" class="master">
                                                    <p class="mt-2 text-white"><?= paymentwithcard ?></p>
                                                </div>
                                                <div class="input-debit-card">
                                                    <input type="radio" name="bankCode" id="bankCode" value="VNBANK" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-auto adcarddebit text-white card-title d-flex align-items-center justify-content-between">
                                            <p><?= carddes ?></p>
                                        
                                        </div>
                                    </label>
                                </div>
                                <div class="debit-card mb-4">
                                    <label class="d-flex flex-column h-100 p-3">
                                        <div class="d-block">
                                            <div class="d-flex position-relative">
                                                <div>
                                                    <img src="assets/images/images/payment.png"
                                                        alt="master" class="master">
                                                    <p class="mt-2 text-white fw-bold"><?= 	paymentwithvisa ?></p>
                                                </div>
                                                <div class="input-debit-card">
                                                    <input type="radio" name="bankCode" id="bankCode" value="INTCARD" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-auto adcarddebit text-white card-title d-flex align-items-center justify-content-between">
                                            <p><?= visades ?></p>
                                            
                                        </div>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-4">
                                <div class="d-flex justify-content-end">
                                    <input type="submit" class="default-button" name="save_auto" value="<?= save ?>" disabled />
                                    <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="content-tabs-content commentfb-pro-detail">
                        <form class="validation-user grid grid-1 gap-10" novalidate action="" method="post">
                            <div class="input-group input-normal">
                                <label for="moneytc"><?= moneyrecharge ?>: </label>
                                <input type="text" class="input-money format-price" id="moneytc" name="moneytc" placeholder="<?= entermoneyrecharge ?>" required />
                                <div class="invalid-feedback"><?= requiredmoneyrecharge ?></div>
                            </div>
                            <div class="input-normal">
                                <label for="id_bank_naptc"><?= bankrecharge ?>:</label>
                                <select name="id_bank_naptc" id="id_bank_naptc" class="select2" required>
                                    <option value="" disabled="" selected="" hidden=""><?= checkbank ?></option>
                                    <?php foreach($banks as $bank) { ?> 
                                        <option value="<?= $bank['id'] ?>"><?= $bank['ten'] ?></option>
                                    <?php } ?>
                                </select>
                                <div class="invalid-feedback"><?= requiredcheckbank ?></div>
                            </div>
                            <div class="input-normal container-info-bank">

                            </div>
                            <div class="input-group input-normal">
                                <label for="noidungtc"><?= contentnote ?>: </label>
                                <textarea name="noidungtc" id="noidungtc" cols="30" rows="5" required placeholder="<?= entercontentnote ?>"></textarea>
                                <div class="invalid-feedback"><?= requiredcontentnote ?></div>
                            </div>
                            <div class="d-flex justify-content-end">
                                <input type="submit" class="default-button" name="savetc" value="<?= save ?>" disabled />
                                <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                            </div>
                        </form>
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
</div>