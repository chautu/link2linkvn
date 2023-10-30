<?php
$linkMan = "index.php?com=user&act=admin_edit";

$linkDeleteAddress = "index.php?com=user&act=delete-address-admin";
$linkAddAddress = "index.php?com=user&act=add-address-admin";
$linkEditAddress = "index.php?com=user&act=edit-address-admin";

$linkDeleteBank = "index.php?com=user&act=delete-bank-admin";
$linkAddBank = "index.php?com=user&act=add-bank-admin";
$linkEditBank = "index.php?com=user&act=edit-bank-admin";

$linkAddTransition = "index.php?com=user&act=add-transition-admin";
$linkEditTransition = "index.php?com=user&act=edit-transition-admin";
$linkAutoTransition = "index.php?com=user&act=auto-transition-admin";

$linkDeleteTimeline = "index.php?com=user&act=delete-timeline-admin";
$linkAddTimeline = "index.php?com=user&act=add-timeline-admin";
$linkEditTimeline = "index.php?com=user&act=edit-timeline-admin";

?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Thông tin admin</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <form class="validation-form" novalidate method="post" action="<?=$linkMan?>" enctype="multipart/form-data">
        <div class="card-footer text-sm sticky-top">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i
                    class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title"><?=($act=="edit")?"Cập nhật":"Thêm mới";?> tài khoản</h3>
            </div>
            <div class="card-body">
				<div class="box-member form-group col-md-12 callout callout-warning mb-4">
					<div class="avatar-user">
						<img class="rounded img-avatar-user" onerror="src='assets/images/noimage.png'"
							src="<?=THUMBS?>/200x200x1/<?=UPLOAD_USER_L.$item['avatar']?>">
						<span class="change-avatar" onclick="upload_image('file_avatar')"><i class="fas fa-camera-retro"></i></span>
						<input type="file" onchange="document.querySelector('.img-avatar-user').src = window.URL.createObjectURL(this.files[0])" name="file" id="file_avatar" style="display:none">
					</div>
					<div class="nomarl-info">
						<h2>
							<span>
								<span class="<?= @$item['ten'] ? "" : "text-info" ?>">
									<?= @$item['ten'] ? $item['ten'] : "Chưa cập nhật" ?>
								</span>
								&emsp; &emsp;
								<span class="link_member <?= @$item['username'] ? "" : "text-info" ?> ">
									<?= @$item['username'] ? "@".$item['username']."" : "" ?>
								</span>
							</span>
							<a class="btn btn-sm bg-gradient-primary text-white" href="javascript:void(0);" title="Số dư"><i class="fas fa-money-check-alt mr-2"></i><?= number_format($item['money']) ?>đ</a>
						</h2>
						<h3>
							<span>Email</span>
							<span>:</span>
							<span class="<?= @$item['email'] ? "" : "text-info" ?>">
								<?= @$item['email'] ? $item['email'] : "Chưa cập nhật" ?>
							</span>
						</h3>
						<h3>
							<span>Số điện thoại</span>
							<span>:</span>
							<span class="<?= @$item['dienthoai'] ? "" : "text-info" ?>">
								<?= @$item['dienthoai'] ? $item['dienthoai'] : "Chưa cập nhật" ?>
							</span>
						</h3>
						<h4>
							<span>Trạng thái</span>
							<span>:</span>
							<span
								class="<?= @$item['hienthi'] > 0 ? "active" : "inactive" ?>"><?= @$item['hienthi'] > 0 ? "active" : "inactive" ?></span>
						</h4>
					</div>
				</div>
                <div class="card card-primary card-outline card-outline-tabs">
                    <div class="card-header p-0 border-bottom-0">
                        <ul class="nav nav-tabs" id="custom-tabs-three-tab-lang" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link <?= $_GET['active'] == "gioithieu" ? "active" : "" ?>" id="tabs-lang" data-toggle="pill" href="#tabs-gioithieu" role="tab" aria-controls="tabs-gioithieu" onclick="changeTab('gioithieu','active')" aria-selected="true">Giới thiệu</a>
                            </li>
							<li class="nav-item">
                                <a class="nav-link <?= $_GET['active'] == "trangcanhan" ? "active" : "" ?>" id="tabs-lang" data-toggle="pill" href="#tabs-trangcanhan" role="tab" aria-controls="tabs-trangcanhan" onclick="changeTab('trangcanhan','active')" aria-selected="true">Trang cá nhân</a>
                            </li>
							<li class="nav-item">
								<a class="nav-link <?= $_GET['active'] == "doimatkhau" ? "active" : "" ?>" id="tabs-lang" data-toggle="pill" href="#tabs-doimatkhau" role="tab" aria-controls="tabs-doimatkhau" onclick="changeTab('doimatkhau','active')"  aria-selected="true">Đổi mật khẩu</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?= $_GET['active'] == "diachi" ? "active" : "" ?>" id="tabs-lang" data-toggle="pill" href="#tabs-diachi" role="tab" aria-controls="tabs-diachi" onclick="changeTab('diachi','active')" aria-selected="true">Địa chỉ</a>
							</li>
							<li class="nav-item">
								<a class="nav-link <?= $_GET['active'] == "nganhang" ? "active" : "" ?>" id="tabs-lang" data-toggle="pill" href="#tabs-nganhang" role="tab" aria-controls="tabs-nganhang" onclick="changeTab('nganhang','active')" aria-selected="true">Ngân hàng</a>
							</li>
							<?php if(isset($config['transition']['active']) && $config['transition']['active'] == true) { ?>
							<li class="nav-item">
								<a class="nav-link <?= $_GET['active'] == "transition" ? "active" : "" ?>" id="tabs-lang" data-toggle="pill" href="#tabs-transition" role="tab" aria-controls="tabs-transition" onclick="changeTab('transition','active')" aria-selected="true">Biến động số dư</a>
							</li>
							<?php } ?>
                        </ul>
                    </div>
                    <div class="card-body card-article">
                        <div class="tab-content" id="custom-tabs-three-tabContent-lang">
                            <div class="tab-pane fade <?= $_GET['active'] == "gioithieu" ? "show active" : "" ?>" id="tabs-gioithieu" role="tabpanel" aria-labelledby="tabs-lang">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="ten">Họ tên: <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="data[ten]" id="ten" placeholder="Họ tên"
											value="<?=@$item['ten']?>" required>
									</div>
									<div class="form-group col-md-4">
										<label for="username">Tài khoản: <span class="text-danger">*</span></label>
										<input type="text" class="form-control" name="data[username]" id="username"
											placeholder="Tài khoản" value="<?=@$item['username']?>" <?=($act=="admin_edit")?'readonly':'';?>
											required>
									</div>
									<div class="form-group col-md-4">
										<label for="email">Email:</label>
										<input type="email" class="form-control" name="data[email]" id="email" placeholder="Email"
											value="<?=@$item['email']?>">
									</div>
									<div class="form-group col-md-4">
										<label for="dienthoai">Điện thoại:</label>
										<input type="text" class="form-control" name="data[dienthoai]" id="dienthoai"
											placeholder="Điện thoại" value="<?=@$item['dienthoai']?>">
									</div>
									<div class="form-group col-md-4">
										<label for="gioitinh">Giới tính:</label>
										<select class="form-control select2" name="data[gioitinh]" id="gioitinh">
											<option <?=(@$item['gioitinh']==0)?"selected":""?>>Nam</option>
											<option <?=(@$item['gioitinh']==1)?"selected":""?> value="1">Nữ</option>
											<option <?=(@$item['gioitinh']==2)?"selected":""?> value="2">Khác</option>
										</select>
									</div>
									<div class="form-group col-md-4">
										<label for="ngaysinh">Ngày sinh:</label>
										<input type="text" class="form-control" name="data[ngaysinh]" id="ngaysinh"
											placeholder="Ngày sinh"
											value="<?=(@$item['ngaysinh'])?date('d/m/Y',@$item['ngaysinh']):"";?>" readonly>
									</div>
									<div class="form-group col-md-4">
										<label class="d-block" for="id_tags">Danh mục tags:</label>
										<?=$func->get_tags(@$item['id'], 'tags_group', 'user', 'member', $config['website']['lang-default'])?>
									</div>
								</div>
                                <div class="form-group">
                                    <label for="gioithieu">Giới thiệu:</label>
                                    <textarea class="form-control for-seo form-control-ckeditor short"
                                        name="data[gioithieu]" id="gioithieu" rows="5"
                                        placeholder="Giới thiệu"><?=htmlspecialchars_decode(@$item['gioithieu'])?></textarea>
                                </div>
								<div class="form-group mt-5">
									<label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Kích hoạt:</label>
									<div class="custom-control custom-checkbox d-inline-block align-middle">
										<input type="checkbox" class="custom-control-input hienthi-checkbox"
											name="data[hienthi]" id="hienthi-checkbox"
											<?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
										<label for="hienthi-checkbox" class="custom-control-label"></label>
									</div>
								</div>
								<div class="form-group">
									<label for="stt" class="d-inline-block align-middle mb-0 mr-2">Số thứ tự:</label>
									<input type="number" class="form-control form-control-mini d-inline-block align-middle"
										min="0" name="data[stt]" id="stt" placeholder="Số thứ tự"
										value="<?=isset($item['stt']) ? $item['stt'] : 1?>">
								</div>
                            </div>
							<div class="tab-pane fade <?= $_GET['active'] == "trangcanhan" ? "show active" : "" ?>" id="tabs-trangcanhan" role="tabpanel" aria-labelledby="tabs-lang">
								<div class="d-flex justify-content-end">
										<a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddTimeline?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
										<a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDeleteTimeline?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
								</div>
								<div class="mt-4">
									<div class="card card-primary card-outline text-sm mb-0 table-responsive p-0">
										<table class="table table-hover">
											<thead>
												<tr>
													<th class="align-middle" width="5%">
														<div class="custom-control custom-checkbox my-checkbox">
															<input type="checkbox" class="custom-control-input" id="selectall-checkbox">
															<label for="selectall-checkbox" class="custom-control-label"></label>
														</div>
													</th>
													<th class="align-middle text-center" width="10%">STT</th>
													<th class="align-middle" width="30%">Nội dung</th>
													<th class="align-middle text-center">Ngày tạo</th>
													<th class="align-middle text-center">Trạng thái</th>
													<th class="align-middle text-center">Hiển thị</th>
													<th class="align-middle text-center">Thao tác</th>
												</tr>
											</thead>
											<?php $timelines = $func->get_rows("user_timeline", "id_user", @$item['id']); if(empty($timelines)) { ?>
												<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
											<?php } else { ?>
												<tbody>
													<?php foreach($timelines as $tl) { ?>
														<tr>
															<td class="align-middle">
																<div class="custom-control custom-checkbox my-checkbox">
																	<input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$tl['id']?>" value="<?=$tl['id']?>">
																	<label for="select-checkbox-<?=$tl['id']?>" class="custom-control-label"></label>
																</div>
															</td>
															<td class="align-middle">
																<input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$tl['stt']?>" data-id="<?=$tl['id']?>" data-table="user_timeline">
															</td>
															<td class="align-middle">
																<?= htmlspecialchars_decode($tl['noidung']) ?>
															</td>
															<td class="align-middle text-center">
																<?= date("H:i / d-m-Y", $tl['ngaytao']) ?>
															</td>
															<td class="align-middle">
																<?= $func->get_status("status", $tl['id_status'])?>	
															</td>
															<td class="align-middle text-center">
																<div class="custom-control custom-checkbox my-checkbox">
																	<input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$tl['id']?>" data-table="user_timeline" data-id="<?=$tl['id']?>" data-loai="hienthi" <?=($tl['hienthi'])?'checked':''?>>
																	<label for="show-checkbox-<?=$tl['id']?>" class="custom-control-label"></label>
																</div>
															</td>
															<td class="align-middle text-center text-md text-nowrap">
																<a class="text-primary mr-2" href="<?=$linkEditTimeline?>&id=<?=$tl['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
																<a class="text-danger" id="delete-item" data-url="<?=$linkDeleteTimeline?>&id=<?=$tl['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											<?php } ?>
										</table>
									</div>
								</div>
								<div class="d-flex justify-content-end mt-4">
										<a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddTimeline?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
										<a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDeleteTimeline?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
								</div>
							</div>
							<div class="tab-pane fade <?= $_GET['active'] == "doimatkhau" ? "show active" : "" ?>" id="tabs-doimatkhau" role="tabpanel" aria-labelledby="tabs-lang">
								<div class="row">
									<div class="form-group col-md-4">
										<label for="password">Mật khẩu:</label>
										<input type="password" class="form-control" name="data[password]" id="password"
											placeholder="Mật khẩu" <?=($act=="add")?'required':'';?>>
									</div>
									<div class="form-group col-md-4">
										<label for="confirm_password">Nhập lại mật khẩu:</label>
										<input type="password" class="form-control" name="confirm_password" id="confirm_password"
											placeholder="Nhập lại mật khẩu" <?=($act=="add")?'required':'';?>>
									</div>
								</div>
							</div>
							<div class="tab-pane fade <?= $_GET['active'] == "diachi" ? "show active" : "" ?>" id="tabs-diachi" role="tabpanel" aria-labelledby="tabs-lang">
								<div class="d-flex justify-content-end">
										<a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddAddress?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
										<a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDeleteAddress?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
								</div>
								<div class="mt-4">
									<div class="card card-primary card-outline text-sm mb-0 table-responsive p-0">
										<table class="table table-hover">
											<thead>
												<tr>
													<th class="align-middle" width="5%">
														<div class="custom-control custom-checkbox my-checkbox">
															<input type="checkbox" class="custom-control-input" id="selectall-checkbox">
															<label for="selectall-checkbox" class="custom-control-label"></label>
														</div>
													</th>
													<th class="align-middle text-center" width="10%">STT</th>
													<th class="align-middle">Địa chỉ</th>
													<th class="align-middle text-center">Mặc định</th>
													<th class="align-middle text-center">Hiển thị</th>
													<th class="align-middle text-center">Thao tác</th>
												</tr>
											</thead>
											<?php $address = $func->get_rows('user_address','id_user',$item['id']); if(empty($address)) { ?>
												<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
											<?php } else { ?>
												<tbody>
													<?php foreach($address as $ad) { ?>
														<?php 
															$linkID = "";
															if($ad['id_city']) $linkID .= "&id_city=".$ad['id_city'];
															if($ad['id_district']) $linkID .= "&id_district=".$ad['id_district'];
															if($ad['id_wards']) $linkID .= "&id_wards=".$ad['id_wards'];
															if($ad['id_street']) $linkID .= "&id_street=".$ad['id_street'];
														?>
														<tr>
															<td class="align-middle">
																<div class="custom-control custom-checkbox my-checkbox">
																	<input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$ad['id']?>" value="<?=$ad['id']?>">
																	<label for="select-checkbox-<?=$ad['id']?>" class="custom-control-label"></label>
																</div>
															</td>
															<td class="align-middle">
																<input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$ad['stt']?>" data-id="<?=$ad['id']?>" data-table="user_address">
															</td>
															<td class="align-middle">
																<?= $ad['ten'] ? $ad['ten'].', ': "" ?>
																<?= $ad['diachi'] ? $ad['diachi'].', ': "" ?>
																<?= $func->get_places("street",$ad['id_street'],$config['website']['lang-default']) ? $func->get_places("street",$ad['id_street']).', ': "" ?>
																<?= $func->get_places("wards",$ad['id_wards'],$config['website']['lang-default']) ? $func->get_places("wards",$ad['id_wards'],$config['website']['lang-default']).', ': "" ?>
																<?= $func->get_places("district",$ad['id_district'],$config['website']['lang-default']) ? $func->get_places("district",$ad['id_district'],$config['website']['lang-default']).', ': "" ?>
																<?= $func->get_places("city",$ad['id_city'],$config['website']['lang-default']) ?>
															</td>
															<td class="align-middle text-center">
																<div class="custom-control custom-checkbox my-checkbox">
																	<input type="checkbox" class="custom-control-input show-checkbox" id="show-macdinh-<?=$ad['id']?>" data-table="user_address" data-id="<?=$ad['id']?>" data-loai="macdinh" <?=($ad['macdinh'])?'checked':''?>>
																	<label for="show-macdinh-<?=$ad['id']?>" class="custom-control-label"></label>
																</div>
															</td>
															<td class="align-middle text-center">
																<div class="custom-control custom-checkbox my-checkbox">
																	<input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$ad['id']?>" data-table="user_address" data-id="<?=$ad['id']?>" data-loai="hienthi" <?=($ad['hienthi'])?'checked':''?>>
																	<label for="show-checkbox-<?=$ad['id']?>" class="custom-control-label"></label>
																</div>
															</td>
															<td class="align-middle text-center text-md text-nowrap">
																<a class="text-primary mr-2" href="<?=$linkEditAddress?><?=$linkID?>&id=<?=$ad['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
																<a class="text-danger" id="delete-item" data-url="<?=$linkDeleteAddress?>&id=<?=$ad['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											<?php } ?>
										</table>
									</div>
								</div>
								<div class="d-flex justify-content-end mt-4">
										<a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddAddress?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
										<a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDeleteAddress?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
								</div>
							</div>
							<div class="tab-pane fade <?= $_GET['active'] == "nganhang" ? "show active" : "" ?>" id="tabs-nganhang" role="tabpanel" aria-labelledby="tabs-lang">
								<div class="d-flex justify-content-end">
										<a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddBank?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
										<a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDeleteBank?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
								</div>
								<div class="mt-4">
									<div class="card card-primary card-outline text-sm mb-0 table-responsive p-0">
										<table class="table table-hover">
											<thead>
												<tr>
													<th class="align-middle" width="5%">
														<div class="custom-control custom-checkbox my-checkbox">
															<input type="checkbox" class="custom-control-input" id="selectall-checkbox">
															<label for="selectall-checkbox" class="custom-control-label"></label>
														</div>
													</th>
													<th class="align-middle text-center" width="10%">STT</th>
													<th class="align-middle">Ngân hàng</th>
													<th class="align-middle">Số tài khoản</th>
													<th class="align-middle">Chủ tài khoản</th>
													<th class="align-middle text-center">Mặc định</th>
													<th class="align-middle text-center">Hiển thị</th>
													<th class="align-middle text-center">Thao tác</th>
												</tr>
											</thead>
											<?php $banks = $func->get_rows("user_bank","id_user",$item['id']); if(empty($banks)) { ?>
												<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
											<?php } else { ?>
												<tbody>
													<?php foreach($banks as $ba) { ?>
														<?php 
															$linkID = "";
															if($ba['id_bank']) $linkID .= "&id_bank=".$ba['id_bank'];
														?>
														<tr>
															<td class="align-middle">
																<div class="custom-control custom-checkbox my-checkbox">
																	<input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$ba['id']?>" value="<?=$ba['id']?>">
																	<label for="select-checkbox-<?=$ba['id']?>" class="custom-control-label"></label>
																</div>
															</td>
															<td class="align-middle">
																<input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$ba['stt']?>" data-id="<?=$ba['id']?>" data-table="user_bank">
															</td>
															<td class="align-middle">
																<?= $func->get_places("news_list", $ba['id_bank']) ?>
															</td>
															<td class="align-middle">
																<?= $ba['stk'] ?>
															</td>
															<td class="align-middle">
																<?= $ba['chutk'] ?>
															</td>
															<td class="align-middle text-center">
																<div class="custom-control custom-checkbox my-checkbox">
																	<input type="checkbox" class="custom-control-input show-checkbox" id="show-macdinh-<?=$ba['id']?>" data-table="user_bank" data-id="<?=$ba['id']?>" data-loai="macdinh" <?=($ba['macdinh'])?'checked':''?>>
																	<label for="show-macdinh-<?=$ba['id']?>" class="custom-control-label"></label>
																</div>
															</td>
															<td class="align-middle text-center">
																<div class="custom-control custom-checkbox my-checkbox">
																	<input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$ba['id']?>" data-table="user_bank" data-id="<?=$ba['id']?>" data-loai="hienthi" <?=($ba['hienthi'])?'checked':''?>>
																	<label for="show-checkbox-<?=$ba['id']?>" class="custom-control-label"></label>
																</div>
															</td>
															<td class="align-middle text-center text-md text-nowrap">
																<a class="text-primary mr-2" href="<?=$linkEditBank?><?=$linkID?>&id=<?=$ba['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
																<a class="text-danger" id="delete-item" data-url="<?=$linkDeleteBank?>&id=<?=$ba['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											<?php } ?>
										</table>
									</div>
								</div>
								<div class="d-flex justify-content-end mt-4">
										<a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddBank?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
										<a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDeleteBank?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
								</div>
							</div>
							<?php if(isset($config['transition']['active']) && $config['transition']['active'] == true) { ?>
							<div class="tab-pane fade <?= $_GET['active'] == "transition" ? "show active" : "" ?>" id="tabs-transition" role="tabpanel" aria-labelledby="tabs-lang">
								<div class="d-flex justify-content-end">
										<a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddTransition?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Nạp thủ công</a>
										<a class="btn btn-sm bg-gradient-info text-white" href="<?=$linkAutoTransition?>" title="Nạp tự động"><i class="fas fa-robot mr-2"></i>Nạp tự động</a>
								</div>
								<div class="mt-4">
									<div class="card card-primary card-outline text-sm mb-0 table-responsive p-0">
										<table class="table table-hover">
											<thead>
												<tr>
													<th class="align-middle">Trước giao dịch</th>
													<th class="align-middle">Số tiền</th>
													<th class="align-middle">Sau giao dịch</th>
													<th class="align-middle">Loại giao dịch</th>
													<th class="align-middle">Ghi chú</th>
													<th class="align-middle">Trạng thái</th>
													<th class="align-middle">Ngày tạo</th>
													<th class="align-middle text-center">Thao tác</th>
												</tr>
											</thead>
											<?php $transitions = $func->get_rows("user_transition", "id_user",$item['id']); if(empty($transitions)) { ?>
												<tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
											<?php } else { ?>
												<tbody>
													<?php foreach($transitions as $tr) { ?>
														<?php 
															$linkID = "";
															$linkID .= "&id_status=".$tr['id_status'];
														?>
														<tr>
															<td class="align-middle">
																<?= number_format($tr['first_money']) ?>
															</td>
															<td class="align-middle <?= $tr['type'] ? 'text-danger' : 'text-success' ?>">
																<?= $tr['type'] ? '-' : '+' ?> <?= number_format($tr['money']) ?>
															</td>
															<td class="align-middle">
																<?= number_format($tr['last_money']) ?>
															</td>
															<td class="align-middle">
																<?= $tr['bank'] ?>
															</td>
															<td class="align-middle">
																<?= $tr['ghichu'] ?>
															</td>
															<td class="align-middle">
																<?= $func->get_status("status", $tr['id_status']) ?>
															</td>
															<td class="align-middle">
																<?= date("H:i / d-m-Y", $tr['ngaytao'])  ?>
															</td>
															<td class="align-middle text-center text-md text-nowrap">
																<a class="text-info mr-2" href="<?=$linkEditTransition?>&id=<?=$tr['id']?>" title="Xem chi tiết"><i class="fas fa-eye"></i></a>
															</td>
														</tr>
													<?php } ?>
												</tbody>
											<?php } ?>
										</table>
									</div>
								</div>
								<div class="d-flex justify-content-end mt-4">
										<a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddTransition?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Nạp thủ công</a>
										<a class="btn btn-sm bg-gradient-info text-white" href="<?=$linkAutoTransition?>" title="Nạp tự động"><i class="fas fa-robot mr-2"></i>Nạp tự động</a>
								</div>
							</div>
							<?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i
                    class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm
                lại</button>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>

<!-- User js -->
<script type="text/javascript">
function randomPassword()
{
	var chuoi = "";
	for(i=0;i<9;i++)
	{
		chuoi += "!@#$%^&*()?abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890".charAt(Math.floor(Math.random()*62));
	}
	jQuery('#new-password').val(chuoi);
	jQuery('#renew-password').val(chuoi);
	jQuery('#show-password').html(chuoi);
}
$(document).ready(function() {
    $('#ngaysinh').datetimepicker({
        timepicker: false,
        format: 'd/m/Y',
        formatDate: 'd/m/Y',
        // minDate: '1950/01/01',
        maxDate: '<?=date("Y/m/d",time())?>'
    });
});
</script>