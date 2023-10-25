<div id="footer">
    <div class="footer-top">
        <div class="center">
            <div class="footer-design1-top">
                <div class="content-footer content-footer-1">
                    <h3><?= footer1 ?></h3>
                    <div class="list-footer-links">
                        <?php foreach($link1 as $ft1) { ?> 
                        <div class="footer-link">
                            <i class="fas fa-caret-right"></i>
                            <a href="<?= $ft1['link'] ?>"><?= $ft1['ten'] ?></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="content-footer content-footer-1">
                    <h3><?= footer2 ?></h3>
                    <div class="list-footer-links">
                        <?php foreach($link2 as $ft2) { ?> 
                            <div class="footer-link">
                                <i class="fas fa-caret-right"></i>
                                <a href="<?= $ft2['link'] ?>"><?= $ft2['ten'] ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="content-footer content-footer-1">
                    <h3><?= footer3 ?></h3>
                    <div class="list-footer-links">
                        <?php foreach($link3 as $ft3) { ?> 
                            <div class="footer-link">
                                <i class="fas fa-caret-right"></i>
                                <a href="<?= $ft3['link'] ?>"><?= $ft3['ten'] ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
                <div class="content-footer content-footer-1">
                    <h3><?= footer4 ?></h3>
                    <div class="list-footer-links">
                        <?php foreach($link4 as $ft4) { ?> 
                            <div class="footer-link">
                                <i class="fas fa-caret-right"></i>
                                <a href="<?= $ft4['link'] ?>"><?= $ft4['ten'] ?></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
            <div class="footer-design1-bottom">
                <div class="content-footer">
                    <h3><?= $footer['ten'] ?></h3>
                    <div class="noidung-footer">
                        <?= htmlspecialchars_decode($footer['noidung']) ?>
                    </div>
                </div>
                <div class="content-footer">
                    <div class="fanpage-map">
                        <div id="footer-map">
                            <h3><?= googlemap ?></h3>
                            <?= htmlspecialchars_decode($optsetting['toado_iframe']) ?>
                        </div>
                    </div>
                    <div class="social-network">
                        <?php if (count($mxh) > 0) { ?>
                            <ul class="mxh footer-mxh">
                                <?php foreach ($mxh as $mf) { ?>
                                    <li>
                                        <a href="<?= $mf['link'] ?>" target="_blank">
                                            <img onerror="this.src='assets/images/noimage.png';" src="<?= THUMBS ?>/30x30x1/<?= UPLOAD_PHOTO_L . $mf['photo'] ?>" alt="<?= $mf['ten'] ?>">
                                        </a>
                                    </li>
                                <?php } ?>
                            </ul>
                        <?php } ?>
                    </div>
                    <div class="form-footer">
                        <h3><?= receivenotification ?></h3>
                        <p class="slogan-newsletter"><?= sloganreceive ?></p>
                        <form class="form-newsletter validation-newsletter" novalidate method="post" action="" enctype="multipart/form-data">
                            <div class="w-clear" id="input-newsletter">
                                <input name="email-newsletter" type="text" id="email-newsletter" placeholder="<?= enteremail ?>" required/>
                                <button type="submit" name="register-newsletter"><?= register ?></button>
                                <input type="hidden" name="recaptcha_response_newsletter" id="recaptchaResponseNewsletter">
                                <div class="invalid-feedback"><?= requiredemail ?></div>
                            </div>
                        </form>
                    </div>
                    <div class="note-footer mt-4">
                        <i><?= newspaperwing ?></i>
                    </div>
                    <div class="logo-footer">
                        <?php if ($logo) { ?>
                            <div class="logo sss1 d-flex align-items-center">
                                <a href="<?= $config_base ?>"><img width="250" height="100" onerror="this.src='<?= THUMBS ?>/250x100x2/assets/images/noimage.png';" src="<?= THUMBS ?>/250x100x2/<?= UPLOAD_PHOTO_L . $logo['photo'] ?>" /></a>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
      
    </div>
    <div class="footer-bottom">
        <div class="center container-footer-bottom">
            <p class="copyright"><?= copyright ?> - Web design: <a href="https://www.facebook.com/IL.nguyennhieu.immortaI/"><strong>Dev Nguyễn Nhiều</strong> </a></p>
            <ul class="statistic d-flex flex-wrap align-items-center justify-content-center">
                <li><?= online ?>: <?= $online ?></li>
                <li>|</li>
                <li><?= onweek ?>: <?= $counter['week'] ?></li>
                <li>|</li>
                <li><?= onmonth ?>: <?= $counter['month'] ?></li>
                <li>|</li>
                <li><?= access ?>: <?= $counter['total'] ?></li>
            </ul>
        </div>
    </div>
</div>