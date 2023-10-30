<?php
    $linkSave = "index.php?com=user&act=save-timeline-man-admin&user=".$_GET['user']."&p=".$curPage;
    $linkMan = "index.php?com=user&act=edit_admin&id=".$_GET['user']."&p=".$curPage."&active=trangcanhan";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="<?= $linkMan ?>" title="Thêm giao dịch">Thêm bài viết</a></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkSave?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thêm bài viết</h3>
            </div>
            <?php $member = $func->get_profile($_GET['user'], "user"); ?>
            <div class="card-body row">
                <div class="form-group col-md-12">
                    <label for="noidung">Nội dung:</label>
                    <textarea class="form-control for-seo form-control-ckeditor short"
                        name="data[noidung]" id="noidung" rows="5"
                        placeholder="Nội dung"><?=htmlspecialchars_decode(@$item['noidung'])?></textarea>
                </div>
                <div class="form-group mt-5 col-md-12">
                    <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Kích hoạt:</label>
                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                        <input type="checkbox" class="custom-control-input hienthi-checkbox"
                            name="data[hienthi]" id="hienthi-checkbox"
                            <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                        <label for="hienthi-checkbox" class="custom-control-label"></label>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
            <input type="hidden" name="data[id_user]" value="<?= $_GET['user'] ?>">
        </div>
    </form>
</section>