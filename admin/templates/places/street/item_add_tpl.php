<?php
	$linkMan = "index.php?com=places&act=man_street&p=".$curPage;
	if($act=='add_street') $linkFilter = "index.php?com=places&act=add_street&p=".$curPage;
	else if($act=='edit_street') $linkFilter = "index.php?com=places&act=edit_street&id=".$id."&p=".$curPage;
    $linkSave = "index.php?com=places&act=save_street&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Chi tiết đường phố</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
            <div class="col-xl-8">
                <?php
                    $slugchange = ($act=='edit_street') ? 1 : 0;
                    include TEMPLATE.LAYOUT."slug.php";
                ?>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title"><?=($act=="edit_city")?"Cập nhật":"Thêm mới";?> Đường phố</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
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
                                        <div class="form-group">
                                            <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                            <textarea class="form-control for-seo form-control-ckeditor short" name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5" placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                            <textarea class="form-control for-seo form-control-ckeditor" name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5" placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                        </div>
                                    </div>
                                    <?php } ?>
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
                                <div class="form-group">
                                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                                    <input type="number"
                                        class="form-control form-control-mini d-inline-block align-middle" min="0"
                                        name="data[stt]" id="stt" placeholder="Số thứ tự"
                                        value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục</h3>
                    </div>
                    <div class="card-body">
                        <div class="form-group-category">
                            <div class="form-group">
                                <label class="d-block" for="id_city">Danh sách tỉnh thành:</label>
                                <?=$func->get_ajax_place("city", $config['website']['lang-default'], true, "Chọn tỉnh thành")?>
                            </div>
                            <div class="form-group">
                                <label class="d-block" for="id_district">Danh sách quận huyện:</label>
                                <?=$func->get_ajax_place("district", $config['website']['lang-default'], true, "Chọn quận huyện")?>
                            </div>
                            <div class="form-group">
                                <label class="d-block" for="id_wards">Danh sách phường xã:</label>
                                <?=$func->get_ajax_place("wards", $config['website']['lang-default'], true, "Chọn phường xã")?>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
							$photoDetail = ($act != 'copy') ? UPLOAD_PLACES.@$item['photo'] : '';
							$dimension = "Width: 400px - Height: 400px (.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)";
							include TEMPLATE.LAYOUT."image.php";
							?>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Nội dung SEO</h3>
                <a class="btn btn-sm bg-gradient-success d-inline-block text-white float-right create-seo"
                    title="Tạo SEO">Tạo SEO</a>
            </div>
            <div class="card-body">
                <?php
                    $seoDB = $seo->getSeoDB($id,'street','man','street');
                    include TEMPLATE.LAYOUT."seo.php";
                ?>
            </div>
        </div>
       
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>