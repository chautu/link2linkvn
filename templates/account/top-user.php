<div class="nomal-info-user bg-user">
    <div class="card-profile">
        <form id="form-avatar" class="bg-card-profile" action="account/cap-nhat-tai-khoan" novalidate method="post" enctype="multipart/form-data">
            <img onerror="src='<?= THUMBS ?>/1400x200x1/assets/images/noimage.png'" class="background-image" src="<?= THUMBS ?>/1400x200x1/<?= UPLOAD_USER_L.$row_detail['background'] ?>" alt="background-user">
            <div class="avatar-card-user">
                <label for="file_avatar" title="Thay đổi">
                    <img class="img-avatar-user avatar-top-user" onerror="src='assets/images/noimage.png'"
                src="<?=THUMBS?>/120x120x1/<?=UPLOAD_USER_L.$row_detail['avatar']?>">
                    <div class="change-avatar">
                        <i class="fas fa-camera"></i>
                    </div>
                </label>
                <input type="file" name="file_avatar" onchange="previewFiles(this, '.avatar-top-user')" class="hidden" id="file_avatar">
            </div>
            <label class="edit-bg-avatar" for="file_background"><i class="far fa-edit"></i></label>
            <input type="file" name="file_background" onchange="previewFiles(this, '.background-image')" class="hidden" id="file_background">
            <h3 class="username"><?= $row_detail['username'] ? "@".$row_detail['username'] : "" ?></h3><h3></h3>
        </form>
    </div>
    <div class="content-card-profile">
        <div class="sec-name">
            <h2><?= $row_detail['ten'] ?></h2>
            <h2><?= number_format($row_detail['money']) ?></h2>
        </div>
        <div class="sec-info">
            <h3><?= $row_detail['dienthoai'] ?></h3>
            <h3><?= $row_detail['email'] ?></h3>
        </div>
        <div class="sec-action">
            <div class="group-btn">
                <a href="account/cap-nhat-tai-khoan"><?= updateprofile ?></a>
                <a href="account/doi-mat-khau"><?= changepassword ?></a>
                <a href="account/dang-xuat"><?= logout ?></a>
            </div>
            <div class="group-tags">
                <?php $tags = $d->rawQuery("select ten$lang as ten from #_tags where id in (".$row_detail['id_tags'].")") ?>
                <?php foreach($tags as $tag) { ?> 
                    <span><?= $tag['ten'] ?></span>    
                <?php } ?>
            </div>
        </div>
    </div>
</div>