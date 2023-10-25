<?php
	include "ajax_config.php";
?>
<?php if(isset($_POST['url']) && $_POST['url'] != '') { ?>
<iframe title="video-youtube" width="100%" height="600px" src="//www.youtube.com/embed/<?=$func->getYoutube($_POST['url'])?>" frameborder="0" allowfullscreen></iframe>
<?php } ?>