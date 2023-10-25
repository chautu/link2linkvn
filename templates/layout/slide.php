<?php if (count($slider)) { ?>
<div class="section-slider">
    <div class="slideshow">
        <div class="swiper swiper-slideshow">
            <div class="swiper-wrapper">
                <?php foreach($slider as $sl) { ?>
                <div class="swiper-slide">
                    <div class="background-slider" style=" background-color: #<?= $sl['mau'] ?>">
                            <img class="img-slider" src="<?= THUMBS ?>/1635x770x1/<?= UPLOAD_PHOTO_L.$sl['photo'] ?>" alt="<?= $sl['ten'] ?>">
                        <p class="center n-ct-sl no-select"><?= $sl['ten'] ?></p>
                    </div>
                </div>
                <?php } ?>
            </div>
            <div class="center box-content-slider no-select">
                <div class="content-slider">
                    <div class="t-ct-sl">
                        <h2><?= $setting['ten'.$lang] ?></h2>
                        <div class="h3">
                            <div id="typed-strings" class="hidden">
                                <p><?= titleslider ?></p>
                                <p><?= 	typed ?> <strong><?= javascript ?></strong> <?= library ?></p>
                                <p><?= it ?> <em><?= types ?></em> <?= outsentences ?></p>
                            </div>
                            <h3 id="title-typed"></h3>
                        </div>
                        <form action="">
                                <label class="hidden" for="jobs-search"><?= linhvuc ?></label>
                                <select class="multiselect suite" id="jobs-search" data-class="<?= linhvuc ?>" multiple name="jobs" aria-label="jobs">
                                    <?php foreach($tagsnhansu as $t) { ?>
                                    <option data-label="jobs" id="jobs-<?= $t['id'] ?>" value="<?= $t['id'] ?>"><?= $t['ten'] ?></option>
                                    <?php } ?>
                                </select>
                                <label class="hidden" for="city-search"><?= city ?></label>
                                <select class="multiselect ping" id="city-search" data-class="<?= city ?>" multiple name="city" aria-label="city">
                                    <?php foreach($city as $c) { ?>
                                    <option data-label="city" id="city-<?= $c['id'] ?>" value="<?= $c['id'] ?>"><?= $c['ten'] ?></option>
                                    <?php } ?>
                                </select>
                            <button><?= search ?></button>
                        </form>
                    </div>
                    <div class="popular">
                        <p><?= 	popular ?>:</p>
                        <a href="<?= $config_base ?>" aria-label="Website Design">Website Design</a>
                        <a href="<?= $config_base ?>" aria-label="Wordpress">Wordpress</a>
                        <a href="<?= $config_base ?>" aria-label="Logo Design">Logo Design</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>