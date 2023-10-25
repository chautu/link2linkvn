<div class="center">
    <div class="form-user nomal-info-user bg-user">
        <form class="validation-user" novalidate method="post" action="account/kich-hoat?id=<?=$_GET['id']?>" enctype="multipart/form-data">
        <div class="title-auth">
            <a href="<?= $config_base ?>"><i class="fas fa-long-arrow-alt-left mr-3"></i><?= back ?></a>
            <h3><?= titleactive ?></h3>
        </div>
        <div class="form-reg-email mt-3">
            <div class="input-group input-normal">
                <label for="maxacnhan"><?=enntercode?></label>
                <input id="maxacnhan" name="maxacnhan" type="text" placeholder="<?=enntercode?>" required>
                <div class="invalid-feedback"><?= requiredentercode ?></div>
            </div>
            <button type="submit" class="default-button" name="kichhoat"><?= active ?></button>
        </div>
        </form>
        <div class="noidung-auth mt-5">
            <?= htmlspecialchars_decode($content_auth['noidung']) ?>
        </div>
    </div>
</div>