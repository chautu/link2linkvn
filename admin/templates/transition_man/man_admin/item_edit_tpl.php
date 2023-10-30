<?php
    $linkSave = "index.php?com=transition&act=save_admin";
    $linkMan = "index.php?com=transition&act=man_admin";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="<?= $linkMan ?>" title="Thêm giao dịch">Cập nhật giao dịch</a></li>
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
                <h3 class="card-title">Cập nhật giao dịch</h3>
            </div>
            <?php $member = $func->get_profile($item['id_user'], "user"); ?>
            <div class="card-body row">
                <div class="form-group col-md-12">
                    <label for="username">Username:</label>
                    <input type="text" readonly class="form-control" id="username" value="<?= $member['username'] ?>" placeholder="Username" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="first_money">Trước giao dịch:</label>
                    <input type="text" readonly class="form-control" id="first_money" value="<?= number_format($item['first_money']) ?>" placeholder="Số dư trước giao dịch" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="money">Số dư giao dịch:</label>
                    <input type="text" readonly class="form-control <?= $item['type'] ? 'text-danger' : 'text-success' ?>" id="money" value="<?= number_format($item['money']) ?>" placeholder="Số dư giao dịch" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="last_money">Sau giao dịch:</label>
                    <input type="text" readonly class="form-control" id="last_money" value="<?= number_format($item['last_money']) ?>" placeholder="Số dư sau giao dịch" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="type">Kiểu biến động:</label>
                    <input type="text" readonly class="form-control <?= $item['type'] ? 'text-danger' : 'text-success' ?>" id="type" value="<?= $item['type'] == 0 ? "Cộng tiền" : "Trừ tiền" ?>" placeholder="Kiểu biến động" required>
                </div>
                <div class="form-group col-md-12">
                    <label for="bank">Loại giao dịch:</label>
                    <input type="text" readonly class="form-control" id="bank" value="<?= $item['bank'] ?>" placeholder="Loại giao dịch" required>
                </div>
                <div class="form-group col-12">
					<label for="ghichu">Ghi chú:</label>
					<textarea class="form-control" name="data[ghichu]" id="ghichu" rows="5" placeholder="Ghi chú"><?=@$item['ghichu']?></textarea>
				</div>
                <div class="form-group col-md-12">
                    <label class="d-block" for="id_status">Trạng thái:</label>
                    <?= $func->get_select_status("status", "transition", $config['website']['lang-default'], true, "Chọn trạng thái") ?>
                </div>
                <div class="form-group col-md-12">
                    <label class="d-block" for="action">Thay đổi số dư:</label>
                    <select name="action" id="action" class="form-control select2" required>
                        <option value="" disabled="" selected="" hidden="">Chọn hành động</option>
                        <option value="0">Giữ nguyên</option>
                        <option value="1">Trừ tiền</option>
                        <option value="2">Cộng tiền</option>
                    </select>
                </div>
                <div class="form-group col-md-12">
                    <label for="ngaytao">Ngày thực hiện:</label>
                    <input type="text" readonly class="form-control" id="ngaytao" value="<?= date("H:i / d-m-Y", $item['ngaytao'])  ?>" placeholder="Loại giao dịch" required>
                </div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
        <div class="card card-primary card-outline text-sm mb-0">
            <div class="card-header">
                <h3 class="card-title">Lịch sử cập nhật</h3>
            </div>
            <div class="card-body table-responsive p-0">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="align-middle"></th>
                            <th class="align-middle">Nội dung</th>
                            <th class="align-middle text-right">Ngày tạo</th>
                        </tr>
                    </thead>
                    <?php $transitions_log = $func->get_rows("user_transition_log", "id_transition",$item['id']); if(empty($transitions_log)) { ?>
                        <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                    <?php } else { ?>
                        <tbody>
                            <?php foreach($transitions_log as $trl) { ?> 
                                <tr>
                                    <td class="align-middle"><?= $trl['id'] ?></td>
                                    <td class="align-middle">
                                        <?= $trl['noidung'] ?>
                                    </td>
                                    <td class="align-middle text-right">
                                        <?= date("H:i / d-m-Y", $trl['ngaytao'])  ?>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
       
    </form>
</section>