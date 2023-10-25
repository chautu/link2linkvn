<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="timeline-user">
                <div>
                    <div class="sticky-pv">
                        <div class="pd-20 nomal-info-user bg-user">
                            <div class="title-u">
                                <h4><?= introduce ?></h4>
                            </div>
                            <div class="mt-3">
                                <?= htmlspecialchars_decode($row_detail['gioithieu']) ?>
                                <hr>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <form class="pd-20 form-nomarl validation-user nomal-info-user bg-user no-select" novalidate method="POST">
                        <div class="input-group input-normal">
                            <label for="password-profile"><?= password ?>:</label>
                            <input id="password-profile" name="password-profile" placeholder="<?= examplepassword ?>" type="password" required>
                            <div class="invalid-feedback"><?= requiredpassword ?></div>
                        </div>
                        <div class="input-group input-normal">
                            <label for="new-password-profile"><?= newpassword ?>:</label>
                            <input id="new-password-profile" name="new-password-profile" placeholder="<?= examplenewpassword ?>" type="password" required>
                            <div class="invalid-feedback"><?= requirednewpassword ?></div>
                        </div>
                        <div class="input-group input-normal">
                            <label for="comfirm-new-password-profile"><?= cfnewpassword ?>:</label>
                            <input id="comfirm-new-password-profile" name="comfirm-new-password-profile" placeholder="<?= entercfnewpassword ?>" type="password" required>
                            <div class="invalid-feedback"><?= comfirmnewpassword ?></div>
                        </div>
                      
                        <div class="d-flex justify-content-end">
                            <input type="submit" class="default-button" name="save" value="<?= save ?>" disabled />
                            <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
