<div class="center">


<div class="hidden"><h1><?=$row_detail['ten']?></h1></div>
<?php if(isset($row_detail['noidung']) && $row_detail['noidung'] != '') { ?>
    
    <div class="content w-clear"><?=htmlspecialchars_decode($row_detail['noidung'])?></div>
    <div class="social-plugin">
        <div class="socials-share">
            <a class="bg-facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-facebook-f"></span></a>
            <a class="bg-twitter" href="https://twitter.com/share?text=<?= urlencode($seo->getSeo('description')) ?>&url=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-twitter"></span></a>
            <a class="bg-email" href="https://mail.google.com/mail/u/0/?view=cm&fs=1&to&su=<?= urlencode($seo->getSeo('title')) ?>&body=<?= urlencode($seo->getSeo('description')) ?>" target="_blank"><span class="fas fa-envelope"></span></a>
            <a class="bg-pinterest" href="https://pinterest.com/pin/create/button/?url=<?= $func->getCurrentPageURL() ?>&description=<?= urlencode($seo->getSeo('description')) ?>&media=<?=$seo->getSeo('photo')?>" target="_blank"><span class="fab fa-pinterest-p"></span></a>
            <a class="bg-linkedin" href="http://www.linkedin.com/shareArticle?mini=true&url=<?= $func->getCurrentPageURL() ?>&title=<?= urlencode($seo->getSeo('title')) ?>&source=<?= $func->getCurrentPageURL() ?>" target="_blank"><span class="fab fa-linkedin-in"></span></a>
        </div>
    </div>
<?php } else { ?>
    <div class="alert alert-danger-custom" role="alert">
        <strong><?=contentisbeingupdated?></strong>
    </div>
<?php } ?>
<div class="share othernews mt-4">
    <b><?=newsother?>:</b>
    <ul class="list-news-other">
        <?php if(isset($news) && count($news) > 0) { ?>
            <?php for($i=0,$count=count($news); $i<$count; $i++) { ?>
                <li><a class="text-decoration-none" href="<?=$news[$i][$sluglang]?>" title="<?=$news[$i]['ten']?>">
                    <?=$news[$i]['ten']?> - <?=date("d/m/Y",$news[$i]['ngaytao'])?>
                </a></li>
            <?php  } ?>
        <?php } ?>
    </ul>
    <div class="pagination-home"><?=(isset($paging) && $paging != '') ? $paging : ''?></div>
</div>

</div>