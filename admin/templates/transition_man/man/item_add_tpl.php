<?php
    $linkSave = "index.php?com=transition&act=save_mem";
    $linkMan = "index.php?com=transition&act=man_mem";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="<?= $linkMan  ?>" title="Thêm giao dịch">Thêm giao dịch</a></li>
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
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan  ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thêm giao dịch</h3>
            </div>
            <div class="card-body row">
                <div class="form-group col-md-12">
                    <label class="d-block" for="id_member">Chọn member:</label>
                    <select name="data[id_member]" id="id_member" class="form-control select2 add_transition_member" required>
                        <option value="" disabled="" selected="" hidden="">Chọn member</option>
                        <?php foreach($items as $it) { ?> 
                            <option data-money="<?= $it['money'] ?>" value="<?= $it['id'] ?>"><?= $it['username'] ?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="first_money">Trước giao dịch:</label>
                    <input type="text" readonly class="form-control format-price" id="first_money" value="0" placeholder="Số dư trước giao dịch" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="money">Số dư giao dịch:</label>
                    <input type="text" data-max="0" class="form-control format-price transition_money" name="data[money]" id="money" value="0" placeholder="Số dư giao dịch" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="last_money">Sau giao dịch:</label>
                    <input type="text" readonly class="form-control format-price transition_last_money" id="last_money" value="<?= 0 ?>" placeholder="Số dư sau giao dịch" required>
                </div>
                <div class="form-group col-md-12">
                    <label class="d-block" for="type">Kiểu biến động:</label>
                    <select name="data[type]" id="type" class="form-control select2 transition_type" required>
                        <option value="0">Cộng</option>
                        <option value="1">Trừ</option>
                    </select>
                </div>
                <div class="form-group col-12">
					<label for="ghichu">Ghi chú:</label>
					<textarea class="form-control" name="data[ghichu]" id="ghichu" rows="5" placeholder="Ghi chú"><?=@$item['ghichu']?></textarea>
				</div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="<?= $linkMan  ?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
        </div>
    </form>
</section>

<script>
$(".add_transition_member").change(function() {
    const id_member = $(this).val();
    const option = $(this).find('option:selected');
    const money = option.attr("data-money");
    $("#first_money").val(money);
    $("#money").attr("data-max", money);
    $(".format-price").priceFormat({
        limit: 13,
        prefix: '',
        centsLimit: 0
    });
});
</script>
