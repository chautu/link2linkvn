<?php
	$linkMan = "index.php?com=coupons&act=man&p=".$curPage;
    $linkSave = "index.php?com=coupons&act=save&p=".$curPage;
	$colLeft = "col-xl-8";
	$colRight = "col-xl-4";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item"><a href="<?=$linkMan?>" title="Quản lý mã giảm giá">Quản lý mã giảm giá</a></li>
                <li class="breadcrumb-item active"><?= $act=="edit"? "Thông tin mã giảm giá <span class='text-primary'>#".$item['code']."</span></li>" : "Thêm mã giảm giá" ?> 
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
                        <h3 class="card-title">Thông tin mã giảm giá
                        </h3>
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
                            <div class="card-body">
                                <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                                    <?php foreach($config['website']['lang'] as $k => $v) { ?>
                                    <div class="tab-pane fade show <?=($k==$config['website']['lang-default'])?'active':''?>"
                                        id="tabs-lang-<?=$k?>" role="tabpanel" aria-labelledby="tabs-lang">
                                        
                                        <div class="form-group">
                                            <label for="ten<?=$k?>">Tiêu đề (<?=$k?>):</label>
                                            <input type="text" class="form-control"
                                                name="data[ten<?=$k?>]" id="ten<?=$k?>"
                                                placeholder="Tiêu đề (<?=$k?>)" value="<?=@$item['ten'.$k]?>">
                                        </div>
                                       
                                        <div class="form-group">
                                            <label for="mota<?=$k?>">Mô tả (<?=$k?>):</label>
                                            <textarea
                                                class="form-control short <?=((isset($config['photo']['man_photo'][$type]['mota_cke_photo']) && $config['photo']['man_photo'][$type]['mota_cke_photo'] == true))?'form-control-ckeditor':''?>"
                                                name="data[mota<?=$k?>]" id="mota<?=$k?>" rows="5"
                                                placeholder="Mô tả (<?=$k?>)"><?=htmlspecialchars_decode(@$item['mota'.$k])?></textarea>
                                        </div>
                                    </div>
                                    <?php } ?>
                                </div>
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
							name="data[status]" id="hienthi-checkbox" <?=(!isset($item['status']) || $item['status']==1)?'checked':''?>>
						<label for="hienthi-checkbox" class="custom-control-label"></label>
					</div>
				</div>

                <div class="row">
					<div class="form-group col-md-4">
						<label for="stt" class="d-inline-block align-middle mr-2">Số thứ tự:</label>
						<input type="number" class="form-control d-inline-block align-middle" min="0"
							name="data[stt]" id="stt" placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
					</div>
                    
                    <div class="form-group col-md-4">
                        <label class="d-block" for="code">Mã giảm giá:</label>
                        <input type="text" class="form-control" name="data[code]" id="code" placeholder="Mã sản phẩm"
                            value="<?= @$item['code'] ? @$item['code'] : $func->generate_string('0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ',6) ?>">
                    </div>
					<?php /*
					<div class="form-group col-md-4">
                        <label class="d-block" for="type">Loại:</label>
						<select id="type" name="data[type]" class="form-control text-sm select2"
							required>
							<option value="0"
								<?= isset($item) && @$item['type'] == 0 ? "selected" : '' ?>>Public
							</option>
							<option value="1"
								<?= isset($item) && @$item['type'] == 1 ? "selected" : '' ?>>Private
							</option>
						</select>
                    </div> */ ?>
					<div class="form-group col-md-4">
                        <label class="d-block" for="id_member">Áp dụng với:</label>
						<select id="id_member" name="id_member[]" class="select multiselect" multiple="multiple"
							required>
							<?php foreach($members as $mem) { ?> 
								<option value="<?= $mem['id'] ?>"
									<?= isset($item) && in_array($mem['id'],explode(',', $item['id_member'])) ? "selected" : '' ?>><?= $mem['email'] ?>
								</option>
							<?php } ?>
						</select>
                    </div>
					<div class="form-group col-md-4">
                        <label class="d-block" for="val_type">Kiểu giảm:</label>
						<select id="val_type" name="data[val_type]" class="form-control text-sm select2"
							required>
							<option value="0"
								<?= isset($item) && @$item['val_type'] == 0 ? "selected" : '' ?>>Giảm tiền
							</option>
							<option value="1"
								<?= isset($item) && @$item['val_type'] == 1 ? "selected" : '' ?>>Giảm %
							</option>
						</select>
                    </div>
					<div class="form-group col-md-4">
                        <label class="d-block" for="val">Giá trị:</label>
						<input type="text" class="form-control format-price" name="data[val]" id="val"
                                placeholder="Giá trị" value="<?=@$item['val']?>" required>
                    </div>
					<div class="form-group col-md-4">
                        <label class="d-block" for="max">Tối đa:</label>
						<input type="text" class="form-control format-price" name="data[max]" id="max"
                                placeholder="Tối đa" value="<?=@$item['val']?>" required>
                    </div>
                   
                    <div class="form-group col-md-4">
                        <label for="quantity">Số lượng:</label>
                        <input type="number" class="form-control" name="data[quantity]" id="quantity"
                            placeholder="Số lượng:" value="<?=@$item['quantity']?>" required>
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