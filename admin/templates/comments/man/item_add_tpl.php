<?php
	$linkMan = "index.php?com=comments&act=man&p=".$curPage;
    $linkSave = "index.php?com=comments&act=save&p=".$curPage;
	$colLeft = "col-xl-8";
	$colRight = "col-xl-4";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý mã giảm giá">Quản lý đánh giá</a></li>
                <li class="breadcrumb-item active"><?= $act=="edit"? "Thông tin đánh giá <span class='text-primary'>#".$item['id']."</span></li>" : "Thêm đánh giá" ?> 
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
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
		<div class="row">
            <div class="<?=$colLeft?>">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Thông tin chi tiết</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Trạng thái:</label>
                            <div class="custom-control custom-checkbox d-inline-block align-middle">
                                <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                    name="data[hienthi]" id="hienthi-checkbox" <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                                <label for="hienthi-checkbox" class="custom-control-label"></label>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-12">
                                <label for="noidung">Nội dung:</label>
                                <textarea
                                    class="form-control short"
                                    name="data[noidung]" id="noidung" rows="5"
                                    placeholder="Nội dung" required><?=htmlspecialchars_decode(@$item['noidung'])?></textarea>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="d-block" for="rate">Số sao:</label>
                                <select id="rate" name="data[rate]" class="form-control text-sm select2" required>
                                    <option value="" disabled="" selected="" hidden="">Chọn số sao</option>
                                    <option value="1" <?= isset($item) && @$item['rate'] == 1 ? "selected" : '' ?>>1 sao</option>
                                    <option value="2" <?= isset($item) && @$item['rate'] == 2 ? "selected" : '' ?>>2 sao</option>
                                    <option value="3" <?= isset($item) && @$item['rate'] == 3 ? "selected" : '' ?>>3 sao</option>
                                    <option value="4" <?= isset($item) && @$item['rate'] == 4 ? "selected" : '' ?>>4 sao</option>
                                    <option value="5" <?= isset($item) && @$item['rate'] == 5 ? "selected" : '' ?>>5 sao</option>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="d-block" for="id_member">Người đánh giá:</label>
                                <select id="id_member" name="data[id_member]" class="form-control text-sm select2" required>
                                    <option value="" disabled="" selected="" hidden="">Chọn member</option>
                                    <?php foreach($members as $mem) { ?> 
                                        <option value="<?= $mem['id'] ?>"
                                            <?= isset($item) && @$item['id_member'] == $mem['id'] ? "selected" : '' ?>>
                                            <?= $mem['email'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                            <div class="form-group col-md-12">
                                <label class="d-block" for="id_product">Sản phẩm:</label>
                                <select id="id_product" name="data[id_product]" class="form-control text-sm select2" required>
                                    <option value="" disabled="" selected="" hidden="">Chọn sản phẩm</option>
                                    <?php foreach($products as $pro) { ?> 
                                        <option value="<?= $pro['id'] ?>"
                                            <?= isset($item) && @$item['id_product'] == $pro['id'] ? "selected" : '' ?>>
                                            <?= $pro['ten'] ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="<?=$colRight?>">
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
							$dimension = "Width: 400px - Height: 400px ('.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG')";
							include TEMPLATE.LAYOUT."image.php";
							?>
					</div>
				</div>
            </div>
        </div>
		
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?=$linkMan?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>