<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="pd-20 nomal-info-user bg-user">
                <div class="container-photo-user">
                    <?php foreach($photos as $pt) { ?> 
                        <div class="img-photo-user" draggable="true">
                            <img src="<?= THUMBS ?>/680x620x1/<?= UPLOAD_USER_L.$pt['photo'] ?>" alt="<?= $pt['mota'] ?>">
                            <p class="text-split text-split-2"><?= $pt['mota'] ? $pt['mota'] : "Chưa cập nhật" ?></p>
                            <div class="input-group input-normal">
                                <div class="checkbox-user custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input change-noibat-photo" data-id="<?= $pt['id'] ?>" name="photo-nb-<?= $pt['id'] ?>"
                                        id="photo-nb-<?= $pt['id'] ?>" value="1" <?= $pt['noibat'] > 0 ? "checked" : "" ?>>
                                    <label class="custom-control-label" for="photo-nb-<?= $pt['id'] ?>">Ảnh nổi bật</label>
                                </div>
                            </div>
                        </div>    
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

