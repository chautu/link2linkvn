<?php
$linkMan = "index.php?com=product&act=man_attr&type=".$type."&p=".$curPage;
$linkSave = "index.php?com=product&act=save_attr&type=".$type."&p=".$curPage;

/* Check cols */
if(isset($config['product'][$type]['gallery_attr']) && count($config['product'][$type]['gallery_attr']) > 0)
{
    foreach($config['product'][$type]['gallery_attr'] as $key => $value)
    {
        if($key == $type)
        {
            $flagGallery = true;
            break;
        }
    }
}

if((isset($config['product'][$type]['images_attr']) && $config['product'][$type]['images_attr'] == true))
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
                <li class="breadcrumb-item active">Chi tiết <?=$config['product'][$type]['title_main_attr']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i
                    class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i
                    class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="row">
            <div class="<?=$colLeft?>">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Nội dung <?=$config['product'][$type]['title_main_attr']?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="card card-primary card-outline card-outline-tabs">
                            <div class="card-header p-0 border-bottom-0">
                                <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tabattr">
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
                                        <?php if(isset($config['product'][$type]['mota_attr']) && $config['product'][$type]['mota_attr'] == true) { ?>
                                        <div class="form-group">
                                            <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                            <textarea
                                                class="form-control for-seo short <?=(isset($config['product'][$type]['mota_cke_attr']) && $config['product'][$type]['mota_cke_attr'] == true)?'form-control-ckeditor':''?>"
                                                name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5"
                                                placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                        </div>
                                        <?php } ?>
                                        <?php if(isset($config['product'][$type]['noidung_attr']) && $config['product'][$type]['noidung_attr'] == true) { ?>
                                        <div class="form-group">
                                            <label for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                            <textarea
                                                class="form-control for-seo <?=(isset($config['product'][$type]['noidung_cke_attr']) && $config['product'][$type]['noidung_cke_attr'] == true)?'form-control-ckeditor':''?>"
                                                name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5"
                                                placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12 category-mau">
                                        <label for="type_hienthi">Kiểu hiện thị:</label>
                                        <select id="type_hienthi" name="data[type_hienthi]" class="form-control text-sm select2"
                                            required>
                                            <option value="0"
                                                <?= isset($item) && @$item['type_hienthi'] == 0 ? "selected" : '' ?>>Options để chọn
                                            </option>
                                            <option value="1"
                                                <?= isset($item) && @$item['type_hienthi'] == 1 ? "selected" : '' ?>>Hiển thị
                                            </option>
                                        </select>
                                    </div>
                               
                                    <div class="form-group col-md-12">
                                        <label for="stt">Số thứ tự:</label>
                                        <input type="number" class="form-control for-seo" name="data[stt]" id="stt" min="0"
                                            placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>"
                                            required>
                                    </div>
                                

                                    <div class="form-group  col-md-12">
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
                    </div>
                </div>
            </div>
            <div class="<?=$colRight?>">
                <?php if(isset($config['product'][$type]['images_attr']) && $config['product'][$type]['images_attr'] == true) { ?>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title"><?=$config['product'][$type]['title_images_attr']?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                            $photoDetail = UPLOAD_ATTR.@$item['photo'];
                            $dimension = "Width: ".$config['product'][$type]['width_attr']." px - Height: ".$config['product'][$type]['height_attr']." px (".$config['product'][$type]['img_type_attr'].")";
                            include TEMPLATE.LAYOUT."image.php";
                            ?>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php if(isset($flagGallery) && $flagGallery == true) { ?>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Bộ sưu tập <?=$config['product'][$type]['title_main_attr']?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="filer-gallery" class="label-filer-gallery mb-3">Album hình:
                        (<?=$config['product'][$type]['gallery_attr'][$key]['img_type_photo']?>)</label>
                    <input type="file" name="files[]" id="filer-gallery" multiple="multiple">
                    <input type="hidden" class="col-filer" value="col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6">
                    <input type="hidden" class="act-filer" value="man_attr">
                    <input type="hidden" class="folder-filer" value="product">
                </div>
                <?php if(isset($gallery) && count($gallery) > 0) { ?>
                <div class="form-group form-group-gallery">
                    <label class="label-filer">Album hiện tại:</label>
                    <div class="action-filer mb-3">
                        <a class="btn btn-sm bg-gradient-primary text-white check-all-filer mr-1"><i
                                class="far fa-square mr-2"></i>Chọn tất cả</a>
                        <button type="button" class="btn btn-sm bg-gradient-success text-white sort-filer mr-1"><i
                                class="fas fa-random mr-2"></i>Sắp xếp</button>
                        <a class="btn btn-sm bg-gradient-danger text-white delete-all-filer"><i
                                class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
                    </div>
                    <div class="alert my-alert alert-sort-filer alert-info text-sm text-white bg-gradient-info"><i
                            class="fas fa-info-circle mr-2"></i>Có thể chọn nhiều hình để di chuyển</div>
                    <div class="jFiler-items my-jFiler-items jFiler-row">
                        <ul class="jFiler-items-attr jFiler-items-grid row scroll-bar" id="jFilerSortable">
                            <?php foreach($gallery as $v) echo $func->galleryFiler($v['stt'],$v['id'],$v['photo'],$v['ten'.$config['website']['lang-default']],'product','col-xl-2 col-lg-3 col-md-3 col-sm-4 col-6'); ?>
                        </ul>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
        <?php } ?>

        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary submit-check"><i
                    class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i
                    class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>