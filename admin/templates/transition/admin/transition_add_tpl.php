<?php
    $linkSave = "index.php?com=user&act=save-transition-admin";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);" onclick="history.back();" title="Thêm giao dịch">Thêm giao dịch</a></li>
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
            <a class="btn btn-sm bg-gradient-danger" href="javascript:void(0);" onclick="history.back();" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
        </div>
        <div class="card card-primary card-outline text-sm">
            <div class="card-header">
                <h3 class="card-title">Thêm giao dịch</h3>
            </div>
            <?php $member = $func->get_profile($_SESSION[$login_admin]['id'], "user"); ?>
            <div class="card-body row">
                <div class="form-group col-md-4">
                    <label for="first_money">Trước giao dịch:</label>
                    <input type="text" readonly class="form-control format-price" id="first_money" value="<?= number_format($member['money']) ?>" placeholder="Số dư trước giao dịch" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="money">Số dư giao dịch:</label>
                    <input type="text" data-max="<?= $member['money'] ?>" class="form-control format-price transition_money" name="data[money]" id="money" value="<?= 0 ?>" placeholder="Số dư giao dịch" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="last_money">Sau giao dịch:</label>
                    <input type="text" readonly class="form-control format-price transition_last_money" id="last_money" value="<?= number_format($member['money']) ?>" placeholder="Số dư sau giao dịch" required>
                </div>
                <div class="form-group col-md-12">
                    <label class="d-block" for="type">Kiểu biến động:</label>
                    <select name="data[type]" id="type" class="form-control select2 transition_type" required>
                        <option value="0" selectd>Cộng</option>
                        <option value="1">Trừ</option>
                    </select>
                </div>
                
                <div class="form-group col-md-12 banknap">
                    <label class="d-block" for="id_banknap">Chọn ngân hàng nạp:</label>
                    <?= $func->get_banknap($config['website']['lang-default'], false); ?>
                    <div class="mt-4 content-transition-bank"> 
                        
                    </div>
                </div>
                
                <div class="form-group col-md-12 bankrut">
                    <label class="d-block" for="nganhangrut">Chọn ngân hàng rút:</label>
                    <?= $func->get_bankrut($member['id'],$config['website']['lang-default'], false); ?>
                </div>

                <script>
                    $(document).ready(function() {
                        if ($('#type option').filter(':selected').val() == 0) {
                            $(".banknap").show();
                            $('#id_banknap').prop('required', true);
                            $(".bankrut").hide();
                            $('#id_bankrut').prop('required', false);
                        } else {
                            $(".banknap").hide();
                            $('#id_banknap').prop('required', false);
                            $(".bankrut").show();
                            $('#id_bankrut').prop('required', true);
                        };
                        $("#type").change(function() {
                            const box = $(this).val();
                            if (box == 0) {
                                $(".banknap").show();
                                $('#id_banknap').prop('required', true);
                                $(".bankrut").hide();
                                $('#id_bankrut').prop('required', false);
                            } else {
                                $(".banknap").hide();
                                $('#id_banknap').prop('required', false);
                                $(".bankrut").show();
                                $('#id_bankrut').prop('required', true);
                            }
                        });
                        $("#id_banknap").change(function() {
                            const id = $(this).val();
                            let money = $(".transition_money").val();
                            money = money.replaceAll(",", ".");
                            if(money != 0) {
                                $.ajax({
                                    url: 'ajax/ajax_getbank.php',
                                    type: 'POST',
                                    data: {
                                        id: id,
                                        money: money
                                    },
                                    success: function(result) {
                                        $('.content-transition-bank').html(result);
                                    }
                                });
                            }
                        });
                        $(document).on("click",".copyButton", function() {
                            var text = $(this).data("text");
                            var dummy = document.createElement("input");

                            document.body.appendChild(dummy);
                            dummy.value = text;
                            dummy.select();
                            document.execCommand("copy");
                            document.body.removeChild(dummy);

                            if(!$(this).hasClass("active"))
                            {
                                $(".copyButton").removeClass("active");
                                $(this).addClass("active");
                                notifyDialog("Đã copied");
                            }
                        });
                    })
                </script>

                <div class="form-group col-12">
					<label for="ghichu">Ghi chú:</label>
					<textarea class="form-control" name="data[ghichu]" id="ghichu" rows="5" placeholder="Ghi chú"><?=@$item['ghichu']?></textarea>
				</div>
            </div>
        </div>
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="javascript:void(0);" onclick="history.back();" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
            <input type="hidden" name="data[id_user]" value="<?= $_SESSION[$login_admin]['id'] ?>">
        </div>
    </form>
</section>