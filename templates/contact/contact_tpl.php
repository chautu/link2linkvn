 
<div class="title-main hidden">
    <h1><?= $title_crumb ?></h1>
    <p><?= isset($slogan['ten']) ? $slogan['ten'] : ''?></p>
</div>

<div class="center">
    <div class="section-contact">
        <div class="why-contact">
            <div class="title-main">
                <h2><?= whyus ?></h2>
            </div>
            <div>
                <?= (isset($whyus['noidung']) && $whyus['noidung'] != '') ? htmlspecialchars_decode($whyus['noidung']) : '' ?>
            </div>
        </div>
        <div class="form-contact">
            <h2><?= titlecontact ?></h2>
            <form class="form-contact validation-contact" novalidate method="post" action="" enctype="multipart/form-data">
                <div class="input-group input-normal">
                    <label for="tencontact"><?= yourname ?>:</label>
                    <input id="tencontact" name="ten-contact" placeholder="<?= enteryourname ?>" type="text" required>
                    <div class="invalid-feedback"><?= requiredyourname ?></div>
                </div>
                <div class="input-group input-normal">
                    <label for="emailcontact"><?= email ?>:</label>
                    <input id="emailcontact" name="email-contact" placeholder="<?= examplemail ?>" type="text" required>
                    <div class="invalid-feedback"><?= requiredemail ?></div>
                </div>
                <div class="input-group input-normal">
                    <label for="dienthoai-contact"><?= yourphone ?>: </label>
                    <input type="text" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="dienthoai-contact" name="dienthoai-contact" placeholder="<?= enteryourphone ?>" required />
                    <div class="invalid-feedback"><?= requiredyourphone ?></div>
                </div>
                <div class="input-group input-normal">
                    <label for="chude-contact"><?= content ?>: </label>
                    <textarea name="chude-contact" id="chude-contact" cols="30" rows="4" placeholder="<?= entercontent ?>"></textarea>
                    <div class="invalid-feedback"><?= 	requiredcontent ?></div>
                </div>
                <div>
                    <input type="submit" class="default-button" name="save-contact" value="<?= send ?>" disabled />
                    <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                </div>
            </form>
        </div>
    </div>
</div>

<div class="content my-5">
    <div class="center">
        <?= htmlspecialchars_decode($contact['noidung']) ?>
    </div>
</div>