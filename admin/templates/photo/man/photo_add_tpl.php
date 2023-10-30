<?php
    $linkMan = "index.php?com=photo&act=man_photo&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=photo&act=save_photo&type=".$type."&p=".$curPage;

	if( (isset($config['photo']['man_photo'][$type]['images_photo']) && $config['photo']['man_photo'][$type]['images_photo'] == true) ||
	(isset($config['photo']['man_photo'][$type]['icon_photo']) && $config['photo']['man_photo'][$type]['icon_photo'] == true) ||
	(isset($config['photo']['man_photo'][$type]['link_photo']) && $config['photo']['man_photo'][$type]['link_photo'] == true) ||
	(isset($config['photo']['man_photo'][$type]['video_photo']) && $config['photo']['man_photo'][$type]['video_photo'] == true))
	{
		$colLeft = "col-xl-8";
		$colRight = "col-xl-4";
	}
	else
	{
		$colLeft = "col-12";
		$colRight = "d-none";
	}
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>"
                        title="<?=$config['photo']['man_photo'][$type]['title_main_photo']?>">Quản lý
                        <?=$config['photo']['man_photo'][$type]['title_main_photo']?></a></li>
                <li class="breadcrumb-item active">Thêm mới
                    <?=$config['photo']['man_photo'][$type]['title_main_photo']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i
                    class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
            <div class="<?=$colLeft?>">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title"><?=$config['photo']['man_photo'][$type]['title_main_photo'].": "?>
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php if(
		            	(isset($config['photo']['man_photo'][$type]['tieude_photo']) && $config['photo']['man_photo'][$type]['tieude_photo'] == true) || 
		            	(isset($config['photo']['man_photo'][$type]['mota_photo']) && $config['photo']['man_photo'][$type]['mota_photo'] == true) || 
		            	(isset($config['photo']['man_photo'][$type]['noidung_photo']) && $config['photo']['man_photo'][$type]['noidung_photo'] == true)
		            ) { ?>
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                                    <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                    <li class="nav-item">
                                        <a class="nav-link <?=($k==$config['website']['lang-default'])?'active':''?>" id="tabs-lang"
                                            data-toggle="pill" href="#tabs-lang-<?=$k?>" role="tab"
                                            aria-controls="tabs-lang-<?=$k?>" aria-selected="true"><?=$v?></a>
                                    </li>
                                    <?php } ?>
                                </ul>
                            </div>
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                    <div class="tab-pane fade show <?=($k==$config['website']['lang-default'])?'active':''?>"
                                        id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang">
                                        <?php if((isset($config['photo']['man_photo'][$type]['tieude_photo']) && $config['photo']['man_photo'][$type]['tieude_photo'] == true)) { ?>
                                        <div class="form-group">
                                            <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                            <input type="text" class="form-control"
                                                name="data[ten<?=$k?>]" id="ten<?=$k?>"
                                                placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>">
                                        </div>
                                        <?php } ?>
                                        <?php if((isset($config['photo']['man_photo'][$type]['mota_photo']) && $config['photo']['man_photo'][$type]['mota_photo'] == true)) { ?>
                                        <div class="form-group">
                                            <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                            <textarea
                                                class="form-control short <?=((isset($config['photo']['man_photo'][$type]['mota_cke_photo']) && $config['photo']['man_photo'][$type]['mota_cke_photo'] == true))?'form-control-ckeditor':''?>"
                                                name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5"
                                                placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                        </div>
                                        <?php } ?>
                                        <?php if((isset($config['photo']['man_photo'][$type]['noidung_photo']) && $config['photo']['man_photo'][$type]['noidung_photo'] == true)) { ?>
                                        <div class="form-group">
                                            <label for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                            <textarea
                                                class="form-control <?=((isset($config['photo']['man_photo'][$type]['noidung_cke_photo']) && $config['photo']['man_photo'][$type]['noidung_cke_photo'] == true))?'form-control-ckeditor':''?>"
                                                name="data[noidung<?=$k?>]" id="noidung<?=$k?>"
                                                rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <?php } ?>
                        <?php if((isset($config['photo']['man_photo'][$type]['mau_photo']) && $config['photo']['man_photo'][$type]['mau_photo'] == true)) { ?>
                            <div class="form-group">
                                <label class="d-block" for="mau">Màu sắc:</label>
                                <input type="text" class="form-control jscolor" name="data[mau]" id="mau" maxlength="7"
                                    value="<?=(@$item['mau'])?$item['mau']:'#fff'?>">
                            </div>
                        <?php } ?>
						<div class="form-group">
                            <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                            <div class="custom-control custom-checkbox d-inline-block align-middle">
                                <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                    name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                                <label for="hienthi-checkbox" class="custom-control-label"></label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="stt" class="d-inline-block align-middle mr-2">Số thứ tự:</label>
                            <input type="number" class="form-control d-inline-block align-middle" min="0"
                                name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
                        </div>
                    </div>
                </div>
            </div>
            <div class="<?=$colRight?>">
				<?php if(isset($config['photo']['man_photo'][$type]['images_photo']) && $config['photo']['man_photo'][$type]['images_photo'] == true) { ?>
					<div class="card card-primary card-outline text-sm">
						<div class="card-header">
							<h3 class="card-title">Upload hình ảnh</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
										class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<?php
								$photoDetail = ($act != 'copy') ? UPLOAD_PHOTO.@$item['photo'] : '';
								$dimension = "Width: ".$config['photo']['man_photo'][$type]['width_photo']." px - Height: ".$config['photo']['man_photo'][$type]['height_photo']." px (".$config['photo']['man_photo'][$type]['img_type_photo'].")";
								include TEMPLATE.LAYOUT."image.php";
								?>
						</div>
					</div>
                <?php } ?>
				<?php if(isset($config['photo']['man_photo'][$type]['video_photo']) && $config['photo']['man_photo'][$type]['video_photo'] == true) { ?>
					<div class="card card-primary card-outline text-sm">
						<div class="card-header">
							<h3 class="card-title">Video photo</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
										class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="link_video">Video:</label>
								<input type="text" class="form-control" name="data[link_video]"
									id="link_video" onchange="youtubePreview(this.value,'#loadVideo');"
									placeholder="Video">
							</div>
							<div class="form-group">
								<label for="link_video">Video preview:</label>
								<div><iframe id="loadVideo" src="//www.youtube.com/embed/<?=$func->getYoutube(@$item['link_video'])?>" style="background: #0000008f;" width="100%" height="250"
										frameborder="0" allowfullscreen></iframe></div>
							</div>
						</div>
					</div>
                <?php } ?>
				<?php if(isset($config['photo']['man_photo'][$type]['link_photo']) && $config['photo']['man_photo'][$type]['link_photo'] == true) { ?>
					<div class="card card-primary card-outline text-sm">
						<div class="card-header">
							<h3 class="card-title">Link photo</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
										class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
							<div class="form-group">
								<label for="link">Link:</label>
								<input type="text" class="form-control" name="data[link]" id="link"
									placeholder="Link"  value="<?=@$item['link']?>">
							</div>
						</div>
					</div>
                <?php } ?>
				<?php if(isset($config['photo']['man_photo'][$type]['icon_photo']) && $config['photo']['man_photo'][$type]['icon_photo'] == true) { ?>
					<div class="card card-primary card-outline text-sm">
						<div class="card-header">
							<h3 class="card-title">Icon photo</h3>
							<div class="card-tools">
								<button type="button" class="btn btn-tool" data-card-widget="collapse"><i
										class="fas fa-minus"></i></button>
							</div>
						</div>
						<div class="card-body">
						<div class="form-group">
                            <label for="icon_photo">Chọn icon:</label>
                            <select id="icon_photo" name="data[icon]" class="form-control text-sm iconSelect"
                                required data-default="<?= @$item['icon'] ?>">
                            </select>
                        </div>
						</div>
					</div>
                <?php } ?>
            </div>
        </div>

        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary"><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i
                    class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>