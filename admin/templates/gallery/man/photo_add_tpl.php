<?php
    $linkMan = "index.php?com=".$com."&act=man_photo&idc=".$idc."&kind=".$kind."&val=".$val."&type=".$type."&p=".$curPage;
    $linkSave = "index.php?com=".$com."&act=save_photo&idc=".$idc."&kind=".$kind."&val=".$val."&type=".$type."&p=".$curPage;

	$colLeft = "col-xl-8";
	$colRight = "col-xl-4";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Thêm mới
                    <?=$config[$com][$type][$dfgallery][$val]['title_main_photo']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
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
                        <h3 class="card-title"><?=$config[$com][$type][$dfgallery][$val]['title_main_photo'].": "?>
                        </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
						<?php if(isset($config[$com][$type][$dfgallery][$val]['tieude_photo']) && $config[$com][$type][$dfgallery][$val]['tieude_photo'] == true) { ?>
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
                            <div class="card-body card-article">
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                    <div class="tab-pane fade show <?=($k==$config['website']['lang-default'])?'active':''?>" id="tabs-lang-<?=$k?>"
                                        role="tabpanel" aria-labelledby="tabs-lang">
                                        <div class="form-group">
                                            <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                            <input type="text" class="form-control for-seo" name="data[ten<?=$k?>]"
                                                id="ten<?=$k?>" placeholder="Tiêu đề (<?=$k?>)"
                                                value="<?=@$item['ten'.$k]?>" <?=($k==$config['website']['lang-default'])?'required':''?>>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
						<?php } ?>
                        <?php if(isset($config[$com][$type]['type']) && $config[$com][$type]['type'] == 2 && isset($config[$com][$type][$dfgallery][$val]['gia_photo']) && $config[$com][$type][$dfgallery][$val]['gia_photo']) { ?>

                        <?php if(isset($config[$com][$type]['giatext']) && $config[$com][$type]['giatext'] == true) { ?>
                        <div class="row">
                            <div class="form-group col-md-6">
                                <label class="d-block" for="giatext">Giá bán:</label>
                                <input type="text" class="form-control gia_ban" name="data[giatext]"
                                    id="giatext" placeholder="Giá text"
                                    value="<?=@$item['giatext'] ? @$item['giatext'] : '' ?>" required>
                            </div>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <?php 
								$attr = $d->rawQueryOne("select id_attr from #_product where id = ? limit 0,1",array($idc)); 
								if(isset($attr['id_attr']))
								{
									$listattr = explode(",",$attr['id_attr']);
									$cols = ['ten'.$config['website']['lang-default'],"id"];
									$d->where('id', $listattr, 'IN');
									$d->where('hienthi', 0, '>');
                                    $d->where('type_hienthi', 0);
									$d->where('type', $type);
									$resAttr = $d->get("product_attr", null, $cols);
								}
							?>
                            <?php foreach($resAttr as $attr) { ?>
                            <?php $attrbutes = $d->rawQuery("select ten".$config['website']['lang-default'].", id from #_product_attributes where id_attr = ? and hienthi > 0 order by stt, id desc", array($attr['id'])); ?>
                            <div class="form-group col-md-6">
                                <label for="attr-<?= $attr['id'] ?>"><?= $attr['ten'.$config['website']['lang-default']] ?>:</label>
                                <select id="attr-<?= $attr['id'] ?>" name="data[options][option_<?= $attr['id'] ?>]"
                                    class="form-control text-sm select2" required>
                                    <option value="" disabled="" selected="" hidden="">Chọn <?= $attr['ten'.$config['website']['lang-default']] ?>
                                    </option>
                                    <?php foreach($attrbutes as $attribute) { ?>
                                    <option value="<?= $attribute['id'] ?>"
                                        <?= isset($options) && $attribute['id'] == $options['option_'.$attr['id']] ? 'selected' : '' ?>>
                                        <?= $attribute['ten'.$config['website']['lang-default']] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <?php if(isset($config[$com][$type]['gia']) && $config[$com][$type]['gia'] == true) { ?>
                            <div class="form-group col-md-4">
                                <label class="d-block" for="gia">Giá bán:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control format-price gia_ban" name="data[gia]"
                                        id="gia" placeholder="Giá bán" value="<?=@$item['gia']?>">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>VNĐ</strong></div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(isset($config[$com][$type]['giamoi']) && $config[$com][$type]['giamoi'] == true) { ?>
                            <div class="form-group col-md-4">
                                <label class="d-block" for="giamoi">Giá mới:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control format-price gia_moi" name="data[giamoi]"
                                        id="giamoi" placeholder="Giá mới" value="<?=@$item['giamoi']?>">
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>VNĐ</strong></div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(isset($config[$com][$type]['giakm']) && $config[$com][$type]['giakm'] == true) { ?>
                            <div class="form-group col-md-4">
                                <label class="d-block" for="giakm">Chiết khấu:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control gia_km" name="data[giakm]" id="giakm"
                                        placeholder="Chiết khấu" value="<?=@$item['giakm']?>" maxlength="3" readonly>
                                    <div class="input-group-append">
                                        <div class="input-group-text"><strong>%</strong></div>
                                    </div>
                                </div>
                            </div>

                            <script type="text/javascript">
                            function roundNumber(rnum, rlength) {
                                return Math.round(rnum * Math.pow(10, rlength)) / Math.pow(10, rlength);
                            }
                            $(document).ready(function() {

                                $(".gia_ban, .gia_moi").keyup(function() {
                                    var gia_ban = $('.gia_ban').val();
                                    var gia_moi = $('.gia_moi').val();
                                    var gia_km = 0;

                                    if (gia_ban == '' || gia_ban == '0' || gia_moi == '' ||
                                        gia_moi == '0') {
                                        gia_km = 0;
                                    } else {
                                        gia_ban = gia_ban.replaceAll(",", "");
                                        gia_moi = gia_moi.replaceAll(",", "");
                                        gia_ban = parseInt(gia_ban);
                                        gia_moi = parseInt(gia_moi);

                                        if (gia_moi < gia_ban) {
                                            gia_km = 100 - ((gia_moi * 100) / gia_ban);
                                            gia_km = roundNumber(gia_km, 0);
                                        } else {
                                            gia_km = 0;
                                        }
                                    }
                                    $('.gia_km').val(gia_km);
                                })
                            })
                            </script>
                            <?php } ?>
                        </div>
                        <div class="row">
                            <?php if(isset($config[$com][$type][$dfgallery][$val]['quantity_photo']) && $config[$com][$type][$dfgallery][$val]['quantity_photo'] == true) { ?>
                            <div class="form-group col-md-12">
                                <label class="d-block" for="quantity">Số lượng:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control quantity" name="data[quantity]"
                                        id="quantity" placeholder="Số lượng" value="<?=@$item['quantity']?>">
                                </div>
                            </div>
                            <?php } ?>
                            <?php if(isset($item['sold'])) { ?>
                            <div class="form-group col-md-12">
                                <label class="d-block" for="quantity">Đã bán:</label>
                                <div class="input-group">
                                    <input type="number" class="form-control sold" name="data[sold]" id="sold"
                                        placeholder="Số lượng" value="<?=@$item['sold']?>" readonly>
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <?php } ?>
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="stt">Số thứ tự:</label>
                                <input type="number" class="form-control for-seo" name="data[stt]" id="stt" min="0"
                                    placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>"
                                    required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                            <div class="custom-control custom-checkbox d-inline-block align-middle">
                                <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                    name="data[hienthi]" id="hienthi-checkbox"
                                    <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                                <label for="hienthi-checkbox" class="custom-control-label"></label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="<?=$colRight?>">
                <?php if(isset($config[$com][$type][$dfgallery][$val]['craft_photo']) && $config[$com][$type][$dfgallery][$val]['craft_photo'] == true) { ?>
                <div class="card card-primary card-outline text-sm" id="type-display">
                    <div class="card-header">
                        <h3 class="card-title">Loại hiển thị</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group-category row">
                            <div class="form-group col-md-12 category-mau">
                                <label for="type_hienthi">Chọn loại:</label>
                                <select id="type_hienthi" name="data[type_hienthi]" class="form-control text-sm select2"
                                    required>
                                    <option value="0"
                                        <?= isset($item) && @$item['type_hienthi'] == 0 ? "selected" : '' ?>>Hình ảnh
                                    </option>
                                    <option value="1"
                                        <?= isset($item) && @$item['type_hienthi'] == 1 ? "selected" : '' ?>>Video
                                        youtube
                                    </option>
                                    <option value="2"
                                        <?= isset($item) && @$item['type_hienthi'] == 2 ? "selected" : '' ?>>File video
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                $(document).ready(function() {
                    if ($('#type_hienthi option').filter(':selected').val() == 0) {
                        $(".box-picture").show();
                        $(".box-mp4").hide();
                        $(".box-video").hide();
                    } else if ($('#type_hienthi option').filter(':selected').val() == 1) {
                        $(".box-picture").hide();
                        $(".box-mp4").hide();
                        $(".box-video").show();
                    } else {
                        $(".box-picture").show();
                        $(".box-mp4").show();
                        $(".box-video").hide();
                    }
                    $("#type_hienthi").change(function() {
                        const box = $(this).val();
                        if (box == 0) {
                            $(".box-picture").show();
                            $(".box-mp4").hide();
                            $(".box-video").hide();
                        } else if (box == 1) {
                            $(".box-picture").hide();
                            $(".box-mp4").hide();
                            $(".box-video").show();
                        } else {
                            $(".box-picture").show();
                            $(".box-mp4").show();
                            $(".box-video").hide();
                        }
                    });
                });
                </script>
                <?php } ?>
                <?php if(isset($config[$com][$type][$dfgallery][$val]['images_photo']) && $config[$com][$type][$dfgallery][$val]['images_photo'] == true || isset($config[$com][$type][$dfgallery][$val]['video_photo']) && $config[$com][$type][$dfgallery][$val]['video_photo'] == true) { ?>
                <div class="card card-primary card-outline text-sm box-picture">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh mô tả</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
							$photoDetail = ($act != 'copy') ? "../upload/".$com."/".@$item['photo'] : '';
							$dimension = "Width: ".$config[$com][$type][$dfgallery][$val]['width_photo']." px - Height: ".$config[$com][$type][$dfgallery][$val]['height_photo']." px (".$config[$com][$type][$dfgallery][$val]['img_type_photo'].")";
							include TEMPLATE.LAYOUT."image.php";
							?>
                    </div>
                </div>
                <?php } ?>
                <?php if(isset($config[$com][$type][$dfgallery][$val]['radio_photo']) && $config[$com][$type][$dfgallery][$val]['radio_photo'] == true ) { ?>
                <div class="card card-primary card-outline text-sm box-picture">
                    <div class="card-header">
                        <h3 class="card-title">Chọn hình ảnh mô tả</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php $listhinhanh = $d->rawQuery("select photo, id from #_gallery where id_photo = ? and com=? and type = ? and kind='man' and val = ? and hienthi > 0 and type_hienthi = 0", array($idc,$com,$type, $type)); ?>
                    
                        <?php if(count($listhinhanh)) { ?> 
                            <div class="box_radio_photo">
                                <?php foreach($listhinhanh as $hinhanh) { ?> 
                                    <input class="form-control" type="radio" <?= $hinhanh['photo'] == @$item['photo'] ? "checked" : "" ?> name="data[photo]" value="<?= $hinhanh['photo'] ?>" id="radio_<?= $hinhanh['id'] ?>" required>
                                    <label for="radio_<?= $hinhanh['id'] ?>">
                                        <img src="<?= "../upload/".$com."/".$hinhanh['photo'] ?>" alt="">
                                    </label>
                                <?php } ?>
                            </div>
                        <?php } else { ?> 
                            Thêm hình ảnh sản phẩm trước khi chọn ảnh mô tả    
                        <?php } ?>
                    </div>
                </div>
                
                <?php } ?>
                <?php if(isset($config[$com][$type][$dfgallery][$val]['file_photo']) && $config[$com][$type][$dfgallery][$val]['file_photo'] == true) { ?>
                <div class="card card-primary card-outline text-sm card_upload upload_video_mp4 box-mp4">
                    <div class="card-header">
                        <h3 class="card-title">Upload file</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="change-photo w-100" for="video-file">
                                <p>Upload video:</p>
                                <div class="rounded">
                                    <video id="myVideo" controls loop data-autoplay style="width:100%;">
                                        <!-- muted -->
                                        <source src="<?= "../upload/".$com."/" . @$item['taptin'] ?>" type="video/mp4">
                                    </video>
                                    <strong>
                                        <b class="text-sm text-split"></b>
                                        <span class="btn btn-sm bg-gradient-success"><i
                                                class="fas fa-camera mr-2"></i>Chọn video</span>
                                    </strong>
                                </div>
                            </label>
                            <strong
                                class="d-block mt-2 mb-2 text-sm"><?php echo "File type: (" . $config[$com][$type][$dfgallery][$val]['file_type_photo'] . ")" ?></strong>
                            <div class="custom-file my-custom-file d-none">
                                <input type="file" class="custom-file-input" name="video-file" id="video-file">
                                <label class="custom-file-label" for="video-file">Chọn file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                $('#video-file').change(function() {
                    var $source = $('#myVideo');
                    $source[0].src = URL.createObjectURL(this.files[0]);
                    $source.parent()[0].load();
                });
                </script>
                <?php } ?>
                <?php if(isset($config[$com][$type][$dfgallery][$val]['video_photo']) && $config[$com][$type][$dfgallery][$val]['video_photo'] == true) { ?>
                <div class="card card-primary card-outline text-sm box-video">
                    <div class="card-header">
                        <h3 class="card-title">Upload file</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="link_video">Video:</label>
                            <input type="text" class="form-control" name="data[link_video]" id="link_video"
                                onchange="youtubePreview(this.value,'#loadVideo');" placeholder="Video">
                        </div>
                        <div class="form-group">
                            <label for="link_video">Video preview:</label>
                            <div>
                                <iframe style="background: #4b4949;"
                                    src="//www.youtube.com/embed/<?=$func->getYoutube($item['link_video'])?>"
                                    id="loadVideo" width="100%" height="250px" frameborder="0" allowfullscreen></iframe>
                            </div>
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