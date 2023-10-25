<?php if(isset($popup) && $popup['hienthi'] == 1) { ?>
<!-- Modal popup -->
<div class="modal fade" id="popup" tabindex="-1" role="dialog" aria-labelledby="popupModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <a href="<?=$popup['link']?>"><img src="<?=THUMBS?>/800x530x1/<?=UPLOAD_PHOTO_L.$popup['photo']?>"
                        alt="Popup"></a>
            </div>
        </div>
    </div>
</div>
<?php } ?>

<!-- Modal notify -->
<div class="modal modal-custom fade" id="popup-notify" tabindex="-1" role="dialog" aria-labelledby="popup-notify-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-top modal-md" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="popup-notify-label"><?=notification?></h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body"></div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-danger" data-dismiss="modal"><?=escape?></button>
            </div>
        </div>
    </div>
</div>

<div class="modal modal-custom fade" id="popup-user" tabindex="-1" role="dialog" aria-labelledby="popup-user-label"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="container-modals-user no-scrollbar">
                
            </div>
        </div>
    </div>
</div>

<div class="modal modal-custom fade" id="popup-photo" tabindex="-1" role="dialog" aria-labelledby="popup-user-label"
    aria-hidden="true">
    <div class="modal-dialog modals-auth modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="container-modals-user no-scrollbar" id="modlas-photo">
               
            </div>
        </div>
    </div>
</div>

<?php if(isset($config['login']['active']) && $config['login']['active'] == true) { ?>
<?php if(!isset($_SESSION[$login_member]['active']) || !$_SESSION[$login_member]['active']) { ?>
<!-- Modal prototype -->
<div class="modal fade toggle-auth" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modals-auth modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="container-auth">
                <div class="banner-auth">
                    <img onerror="this.src='<?= THUMBS ?>/436x645x2/assets/images/noimage.png';"
                        src="<?= THUMBS ?>/436x645x1/<?= UPLOAD_PHOTO_L . $banner_auth['photo'] ?>"
                        alt="<?= $banner_auth['ten'] ?>" />
                    <div class="content-banner-auth">
                        <h3><?= $banner_auth['ten'] ?></h3>
                        <div class="noidung-auth">
                            <?= htmlspecialchars_decode($banner_auth['noidung']) ?>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="form-auth register">
                        <div class="title-auth">
                            <h3><?= titleregister ?></h3>
                            <h4><?= haveanaccount ?> <span class="toogle-form-auth no-select" data-action="login"><?= signin ?></span></h4>
                        </div>
                        <form class="validation-form" novalidate method="post" action="account/dang-ky" enctype="multipart/form-data">
                            <div class="form-reg-email">
                                <div class="input-group input-normal">
                                    <label for="emailres"><?= email ?></label>
                                    <input id="emailres" name="email-register" type="email" placeholder="<?= examplemail ?>" required>
                                    <div class="invalid-feedback"><?= requiredemail ?></div>
                                </div>
                                <div class="input-group input-normal">
                                    <label for="passwordres"><?= password ?></label>
                                    <input id="passwordres" name="password-register" type="password" placeholder="<?= examplepassword ?>"
                                        required>
                                    <div class="invalid-feedback"><?= requiredpassword ?></div>
                                </div>
                                <div class="input-group input-normal">
                                    <label for="passwordresr"><?= confirmpassword ?></label>
                                    <input id="passwordresr" name="repassword-register" type="password" placeholder="<?= confirmpassword ?>"
                                        required>
                                    <div class="invalid-feedback"><?= 	comfirmnewpassword ?></div>
                                </div>
                                <button type="submit" class="default-button" name="register"><?= register ?></button>
                            </div>
                        </form>
                        <div class="noidung-auth">
                            <?= htmlspecialchars_decode($content_auth['noidung']) ?>
                        </div>
                    </div>
                    <div class="form-auth login">
                        <div class="title-auth">
                            <h3><?= titlesignin ?></h3>
                            <h4><?= donthaveaccount ?> <span class="toogle-form-auth no-select" data-action="register"><?= joinhere ?></span></h4>
                        </div>
                        <div class="button-auth">
                            <a href="<?= $google ?>"><i class="fab fa-google mr-3"></i><?= countinuegoogle ?></a>
                            <a href="<?= $facebook ?>"><i class="fab fa-facebook-f mr-3"></i><?= countinuefacebook ?></a>
                            <p class="toogle-form-auth no-select" data-action="reg-login"><i class="far fa-envelope mr-3"></i><?= normalauth ?></p>
                        </div>
                        <div class="noidung-auth">
                            <?= htmlspecialchars_decode($content_auth['noidung']) ?>
                        </div>
                    </div>
                    
                    <div class="form-auth reg-login">
                        <form class="validation-form" novalidate method="post"  action="account/dang-nhap" enctype="multipart/form-data">
                            <div class="title-auth">
                                <h4 class="toogle-form-auth no-select" data-action="login"><i
                                        class="fas fa-long-arrow-alt-left mr-3"></i><?= back ?></h4>
                                <h3><?= loginwithemail ?></h3>
                            </div>
                            <div class="form-reg-email mt-3">
                                <div class="input-group input-normal">
                                    <label for="emaillogin"><?= email ?></label>
                                    <input id="emaillogin" name="email-login" placeholder="<?= examplemail ?>" type="email"
                                        required>
                                    <div class="invalid-feedback"><?= requiredemail ?></div>
                                </div>
                                <div class="input-group input-normal">
                                    <label for="passwordlogin"><?= password ?></label>
                                    <input id="passwordlogin" name="password-login" type="password" placeholder="<?= examplepassword ?>"
                                        required>
                                    <div class="invalid-feedback"><?= requiredpassword ?></div>
                                </div>
                                <div class="input-group input-normal align-items-end">
                                    <div class="checkbox-user custom-control custom-checkbox">
                                        <input type="checkbox" class="custom-control-input" name="remember-user"
                                            id="remember-user" value="1">
                                        <label class="custom-control-label" for="remember-user"><?=	savelogin ?></label>
                                    </div>
                                </div>
                               
                                <button type="submit" class="default-button" name="login"><?= login ?></button>
                            </div>
                            <div class="input-group mt-3">
                                <h4 class="toogle-form-auth no-select" data-action="forgotpass"><?= forgotpassword ?></h4>
                            </div>
                        </form>
                        <div class="noidung-auth">
                            <?= htmlspecialchars_decode($content_auth['noidung']) ?>
                        </div>
                    </div>
                    <div class="form-auth forgotpass">
                        <form class="validation-form" novalidate method="post"  action="account/quen-mat-khau" enctype="multipart/form-data">
                            <div class="title-auth">
                                <h4 class="toogle-form-auth no-select" data-action="reg-login"><i
                                        class="fas fa-long-arrow-alt-left mr-3"></i><?= back ?></h4>
                                <h3><?= forgotwithemail ?></h3>
                            </div>
                            <div class="form-reg-email mt-3">
                                <div class="input-group input-normal">
                                    <label for="emailforgot"><?= email ?></label>
                                    <input id="emailforgot" name="emailforgot" placeholder="<?= examplemail ?>" type="email"
                                        required>
                                    <div class="invalid-feedback"><?= requiredemail ?></div>
                                </div>                               
                                <button type="submit" class="default-button" name="quenmatkhau"><?= getcode ?></button>
                            </div>
                        </form>
                        <div class="noidung-auth">
                            <?= htmlspecialchars_decode($content_auth['noidung']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>
<?php } ?>