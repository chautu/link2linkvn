<div class="center">
<div class="title-main hidden">
    <h1><?= $static['ten'] ?></h1>
    <p><?= isset($slogan['ten']) ? $slogan['ten'] : ''?></p>
</div>
<div class="content w-clear">
    <?= (isset($static['noidung']) && $static['noidung'] != '') ? htmlspecialchars_decode($static['noidung']) : '' ?>
</div>

<div class="social-plugin">
    <div class="socials-share">
        <a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-facebook-f"></span></a>
        <a class="bg-twitter" href="https://twitter.com/share?text=<?= urlencode($seo->getSeo('description')) ?>&url=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-twitter"></span></a>
        <a class="bg-email" href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to&su=<?= urlencode($seo->getSeo('title')) ?>&body=<?= urlencode($seo->getSeo('description')) ?>" target="_blank"><span class="fas fa-envelope"></span></a>
        <a class="bg-pinterest" href="https://pinterest.com/pin/create/button/?url=<?= $func->getCurrentPageURL() ?>&description=<?= urlencode($seo->getSeo('description')) ?>&media=<?=$seo->getSeo('photo')?>" target="_blank"><span class="fab fa-pinterest-p"></span></a>
        <a class="bg-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?= $func->getCurrentPageURL() ?>&title=<?= urlencode($seo->getSeo('title')) ?>&source=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-linkedin-in"></span></a>
    </div>
</div>
</div>
