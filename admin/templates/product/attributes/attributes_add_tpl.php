<?php
$linkMan = "index.php?com=product&act=man_attributes&type=".$type."&p=".$curPage;
$linkSave = "index.php?com=product&act=save_attributes&type=".$type."&p=".$curPage;

/* Check cols */
if(isset($config['product'][$type]['gallery_attributes']) && count($config['product'][$type]['gallery_attributes']) > 0)
{
    foreach($config['product'][$type]['gallery_attributes'] as $key => $value)
    {
        if($key == $type)
        {
            $flagGallery = true;
            break;
        }
    }
}

if( (isset($config['product'][$type]['images_attributes']) && $config['product'][$type]['images_attributes'] == true) ||
    (isset($config['product'][$type]['category_attributes']) && $config['product'][$type]['category_attributes'] == true))
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
                <li class="breadcrumb-item active">Chi tiết <?=$config['product'][$type]['title_main_attributes']?></li>
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
                        <h3 class="card-title">Nội dung <?=$config['product'][$type]['title_main_attributes']?></h3>
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
                                        <?php if(isset($config['product'][$type]['mota_attributes']) && $config['product'][$type]['mota_attributes'] == true) { ?>
                                        <div class="form-group">
                                            <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                            <textarea
                                                class="form-control for-seo short <?=(isset($config['product'][$type]['mota_cke_attributes']) && $config['product'][$type]['mota_cke_attributes'] == true)?'form-control-ckeditor':''?>"
                                                name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5"
                                                placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                        </div>
                                        <?php } ?>
                                        <?php if(isset($config['product'][$type]['noidung_attributes']) && $config['product'][$type]['noidung_attributes'] == true) { ?>
                                        <div class="form-group">
                                            <label for="noidung<?=$k?>">Nội dung (<?=$k?>):</label>
                                            <textarea
                                                class="form-control for-seo <?=(isset($config['product'][$type]['noidung_cke_attributes']) && $config['product'][$type]['noidung_cke_attributes'] == true)?'form-control-ckeditor':''?>"
                                                name="data[noidung<?=$k?>]" id="noidung<?=$k?>" rows="5"
                                                placeholder="Nội dung (<?=$k?>)"><?=htmlspecialchars_decode(@$item['noidung'.$k])?></textarea>
                                        </div>
                                        <?php } ?>
                                    </div>
                                    <?php } ?>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="stt">Số thứ tự:</label>
                                        <input type="number" class="form-control for-seo" name="data[stt]" id="stt"
                                            min="0" placeholder="Số thứ tự"
                                            value="<?=isset($item['stt']) ? $item['stt'] : 1?>" required>
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
                </div>
            </div>
            <div class="<?=$colRight?>">

                <?php if(isset($config['product'][$type]['category_attributes']) && $config['product'][$type]['category_attributes'] == true) { ?>
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Danh mục <?=$config['product'][$type]['title_main_attr']?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <?php 
                            /* Lấy danh mục thuộc tính */
                            $thuoctinh = $d->rawQuery("select * from #_product_attr where hienthi > 0 order by stt, id desc");
                        ?>
                    <div class="card-body">
                        <div class="form-group-category row">
                            <div class="form-group col-md-12">
                                <label for="id_attr">Danh mục:</label>
                                <select id="id_attr" name="data[id_attr]" class="form-control text-sm select2" required>
                                    <option value="" disabled selected hidden>Chọn danh mục</option>
                                    <?php foreach ($thuoctinh as $value) { ?>
                                    <option value="<?= $value['id'] ?>" class="options_id_attr"
                                        <?= isset($item) && @$item['id_attr'] == $value['id'] ? "selected" : '' ?>>
                                        <?= $value['ten'.$config['website']['lang-default']] ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12 category-mau">
                                <label for="type_hienthi">Kiểu hiện thị:</label>
                                <select id="type_hienthi" name="data[type_hienthi]" class="form-control text-sm select2"
                                    required>
                                    <option value="0"
                                        <?= isset($item) && @$item['type_hienthi'] == 0 ? "selected" : '' ?>>Tên
                                    </option>
                                    <option value="1"
                                        <?= isset($item) && @$item['type_hienthi'] == 1 ? "selected" : '' ?>>Màu sắc
                                    </option>
                                    <option value="2"
                                        <?= isset($item) && @$item['type_hienthi'] == 2 ? "selected" : '' ?>>Hình ảnh
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                $(document).ready(function() {
                    $("#type_hienthi").change(function() {
                        const value = $(this).val();
                        if (value == 0) {
                            $('.box-hinhanh').hide();
                            $('.box-mau').hide();
                        } else if (value == 1) {
                            $('.box-hinhanh').hide();
                            $('.box-mau').show();
                        } else {
                            $('.box-hinhanh').show();
                            $('.box-mau').hide();
                        }
                    });
                });
                </script>
                <?php } ?>

                <?php if(isset($config['product'][$type]['images_attributes']) && $config['product'][$type]['images_attributes'] == true) { ?>
                <div class="card card-primary card-outline text-sm box-hinhanh"
                    <?= isset($item) && @$item['type_hienthi'] == 2 ? '' : "style='display:none'" ?>>
                    <div class="card-header">
                        <h3 class="card-title"><?=$config['product'][$type]['title_images_attributes']?></h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                            $photoDetail = UPLOAD_ATTR.@$item['photo'];
                            $dimension = "Width: ".$config['product'][$type]['width_attributes']." px - Height: ".$config['product'][$type]['height_attributes']." px (".$config['product'][$type]['img_type_attributes'].")";
                            include TEMPLATE.LAYOUT."image.php";
                            ?>
                    </div>
                </div>

                <div class="card card-primary card-outline text-sm box-mau"
                    <?= isset($item) && @$item['type_hienthi'] == 1 ? '' : "style='display:none'" ?>>
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết màu sắc </h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="form-group col-md-12">
                                <label class="d-block" for="mau">Màu sắc:</label>
                                <input type="text" class="form-control jscolor" name="data[mau]" id="mau" maxlength="7"
                                    value="<?=(@$item['mau'])?$item['mau']:'#fff'?>">
                            </div>
                        </div>
                    </div>
                </div>
                <?php } ?>

            </div>
        </div>
        <?php if(isset($flagGallery) && $flagGallery == true) { ?>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Bộ sưu tập <?=$config['product'][$type]['title_main_attributes']?></h3>
                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                            class="fas fa-minus"></i></button>
                </div>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label for="filer-gallery" class="label-filer-gallery mb-3">Album hình:
                        (<?=$config['product'][$type]['gallery_attributes'][$key]['img_type_photo']?>)</label>
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