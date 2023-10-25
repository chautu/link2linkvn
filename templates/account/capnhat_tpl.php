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
                <form class="form-nomarl validation-user nomal-info-user bg-user no-select no-overflow" novalidate method="POST">
                    <div class="input-group input-normal">
                        <label for="ten-profile"><?= yourname ?>:</label>
                        <input id="ten-profile" value="<?= $row_detail ? $row_detail['ten'] : "" ?>" name="ten-profile" placeholder="<?= enteryourname ?>" type="text" required>
                        <div class="invalid-feedback"><?= requiredyourname ?></div>
                    </div>
                    <div class="input-group input-normal">
                        <label for="dienthoai-profile"><?= yourphone ?>: </label>
                        <input type="text" value="<?= $row_detail ? $row_detail['dienthoai'] : "" ?>" oninput="this.value = this.value.replace(/[^0-9]/g, '').replace(/(\..*)\./g, '$1');" id="dienthoai-profile" name="dienthoai-profile" placeholder="<?= enteryourphone ?>" required />
                        <div class="invalid-feedback"><?= requiredyourphone ?></div>
                    </div>
                    <div class="input-group input-normal">
                        <label for="email-profile"><?= email ?>:</label>
                        <input id="email-profile" name="email-profile" value="<?= $row_detail ? $row_detail['email'] : "" ?>" placeholder="<?= 	enteremail ?>" type="text" required>
                        <div class="invalid-feedback"><?= requiredemail ?></div>
                    </div>
                    <div class="grid grid-2 gap-10">
                        <div>
                            <label for="tags-profile"><?= membertags ?>:</label>
                            <select class="multiselect suite" id="tags-profile" multiple name="tag_groups[]">
                                <?php foreach($tags_mem as $tag) { ?>
                                    <option value="<?= $tag['id'] ?>" <?= in_array($tag['id'], explode(",", $row_detail['id_tags'])) ? "selected" : "" ?>><?= $tag['ten'] ?></option>
                                <?php } ?>
                            </select>
                            <div class="invalid-feedback"><?= requiredmembertags ?></div>
                        </div>
                        <div>
                            <label for="gioitinh-profile"><?= sex ?>:</label>
                            <select class="multiselect sex" id="gioitinh-profile" name="gioitinh" required>
                                <option value="0" <?= $row_detail['gioitinh'] == 0 ? 'selected' : '' ?>><?= male ?></option>
                                <option value="1" <?= $row_detail['gioitinh'] == 1 ? 'selected' : '' ?>><?= female ?></option>
                                <option value="2" <?= $row_detail['gioitinh'] == 2 ? 'selected' : '' ?>><?= other ?></option>
                            </select>
                            <div class="invalid-feedback"><?= requiredsex ?></div>
                        </div>
                    </div>
                    <div class="input-normal">
                        <label for="gioithieu-profile"><?= introduce ?>:</label>
                        <textarea class="nguyennhieucme" id="gioithieu-profile" name="gioithieu-profile" cols="10" rows="10" required><?= htmlspecialchars_decode($row_detail['gioithieu']) ?></textarea>
                        <div class="invalid-feedback"><?= requiredintroduce ?></div>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input type="submit" class="default-button" name="save" value="<?= update ?>" disabled />
                        <input type="hidden" name="recaptcha_response_contact" id="recaptchaResponseContact">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    
</div>
