<?php
    $linkSave = "index.php?com=user&act=save-address-man-admin&user=".$_GET['user']."&p=".$curPage;
    $linkMan = "index.php?com=user&act=edit_admin&id=".$_GET['user']."&p=".$curPage."&active=diachi";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="<?= $linkMan ?>" title="Thêm địa chỉ">Thêm địa chỉ</a></li>
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
                <h3 class="card-title">Thêm địa chỉ</h3>
            </div>
            <div class="card-body row">
                <div class="form-group col-md-4">
                    <label for="ten">Tên người nhận:</label>
                    <input type="text" class="form-control" name="data[ten]" id="ten" value="<?= @$item['ten'] ?>" placeholder="Tên">
                </div>
                <div class="form-group col-md-4">
                    <label for="dienthoai">Số điện thoại:</label>
                    <input type="text" class="form-control" name="data[dienthoai]" id="dienthoai" value="<?= @$item['dienthoai'] ?>" placeholder="Số điện thoại">
                </div>
                <div class="form-group col-md-4">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" name="data[email]" id="email" value="<?= @$item['email'] ?>" placeholder="Email">
                </div>
                <div class="form-group col-md-4">
                    <label class="d-block" for="id_city">Danh sách tỉnh thành:</label>
                    <?=$func->get_ajax_place("city", $config['website']['lang-default'], true, "Chọn tỉnh thành")?>
                </div>
                <div class="form-group col-md-4">
                    <label class="d-block" for="id_district">Danh sách quận huyện:</label>
                    <?=$func->get_ajax_place("district", $config['website']['lang-default'], false, "Chọn quận huyện")?>
                </div>
                <div class="form-group col-md-4">
                    <label class="d-block" for="id_wards">Danh sách phường xã:</label>
                    <?=$func->get_ajax_place("wards", $config['website']['lang-default'], false, "Chọn phường xã")?>
                </div>
                <div class="form-group col-md-4">
                    <label class="d-block" for="id_street">Danh sách đường phố:</label>
                    <?=$func->get_ajax_place("street", $config['website']['lang-default'], false, "Chọn đường phố")?>
                </div>
                <div class="form-group col-md-4">
                    <label for="diachi">Địa chỉ (không bắt buộc):</label>
                    <input type="text" class="form-control" name="data[diachi]" id="diachi" value="<?= @$item['diachi'] ?>" placeholder="Địa chỉ">
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
            <input type="hidden" name="data[id_user]" value="<?= $_GET['user'] ?>">
        </div>
    </form>
</section>