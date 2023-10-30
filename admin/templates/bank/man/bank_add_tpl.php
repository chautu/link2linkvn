<?php
    $linkSave = "index.php?com=user&act=save-bank&user=".$_GET['user']."&p=".$curPage;
    $linkMan = "index.php?com=user&act=edit&id=".$_GET['user']."&p=".$curPage."&active=nganhang";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="<?= $linkMan ?>" title="Thêm địa chỉ">Thêm ngân hàng</a></li>
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
                <h3 class="card-title">Thêm ngân hàng</h3>
            </div>
            <div class="card-body row">
                <div class="form-group col-md-4">
                    <label class="d-block" for="id_bank">Danh sách ngân hàng:</label>
                    <?=$func->get_bank("news_list", "bank", $config['website']['lang-default'], true)?>
                </div>
                <div class="form-group col-md-4">
                    <label for="stk">Số tài khoản:</label>
                    <input type="text" class="form-control" name="data[stk]" id="stk" value="<?= @$item['stk'] ?>" placeholder="Số tài khoản" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="chutk">Chủ tài khoản:</label>
                    <input type="text" class="form-control" name="data[chutk]" id="chutk" value="<?= @$item['chutk'] ?>" placeholder="Chủ tài khoản" required>
                </div>
                <div class="form-group col-md-12 mt-3">
                    <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                    <div class="custom-control custom-checkbox d-inline-block align-middle">
                        <input type="checkbox" class="custom-control-input hienthi-checkbox"
                            name="data[hienthi]" id="hienthi-checkbox"
                            <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                        <label for="hienthi-checkbox" class="custom-control-label"></label>
                    </div>
                </div>
                <div class="form-group col-md-12 mt-3">
                    <label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
                    <input type="number" class="form-control form-control-mini d-inline-block align-middle" min="0" name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
                </div>
            </div>
        </div>
      
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
            <input type="hidden" name="data[id_member]" value="<?= $_GET['user'] ?>">
        </div>
    </form>
</section>