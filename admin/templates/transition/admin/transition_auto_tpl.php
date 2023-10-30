<?php
    $linkSave = "index.php?com=user&act=save-auto-transition-admin";
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);" onclick="history.back();" title="Thêm giao dịch">Nạp số dư tự động</a></li>
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
                <h3 class="card-title">Nạp số dư tự động</h3>
            </div>
            <?php $member = $func->get_profile($_SESSION[$login_admin]['id'], "user"); ?>
            <div class="card-body row">
                <div class="form-group col-md-4">
                    <label for="first_money">Trước giao dịch:</label>
                    <input type="text" readonly class="form-control format-price" id="first_money" value="<?= number_format($member['money']) ?>" placeholder="Số dư trước giao dịch" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="money">Số dư nạp:</label>
                    <input type="text" data-max="<?= $member['money'] ?>" class="form-control format-price transition_money" name="data[money]" id="money" value="<?= 0 ?>" placeholder="Số dư giao dịch" required>
                </div>
                <div class="form-group col-md-4">
                    <label for="last_money">Sau giao dịch:</label>
                    <input type="text" readonly class="form-control format-price transition_last_money" id="last_money" value="<?= number_format($member['money']) ?>" placeholder="Số dư sau giao dịch" required>
                </div>
                <div class="form-group col-md-12 mt-3">
                    <div class="debit-card mb-3">
                        <label class="d-flex flex-column h-100 p-3">
                            <div class="d-block">
                                <div class="d-flex position-relative">
                                    <div>
                                        <img src="../assets/images/images/vnpay.png" class="visa"
                                            alt="visa">
                                        <p class="mt-2 text-white">Thanh toán bằng ứng dụng hỗ trợ VNPAY QR</p>
                                    </div>
                                    <div class="input-debit-card">
                                        <input type="radio" name="bankCode" id="bankCode" value="VNPAYQR" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto adcarddebit text-white card-title d-flex align-items-center justify-content-between">
                                <p>Quét mã QR : giúp quá trình thanh toán online được thực hiện tức thì mà không cần nhập thông tin về tài khoản.</p>
                                <p>24/24</p>
                            </div>
                        </label>
                    </div>
                    <div class="debit-card card-2 mb-4">
                        <label class="d-flex flex-column h-100 p-3">
                            <div class="d-block">
                                <div class="d-flex position-relative">
                                    <div>
                                        <img src="../assets/images/images/noidia.png"
                                            alt="master" class="master">
                                        <p class="mt-2 text-white">Thanh toán qua thẻ ATM/Tài khoản nội địa</p>
                                    </div>
                                    <div class="input-debit-card">
                                        <input type="radio" name="bankCode" id="bankCode" value="VNBANK" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto adcarddebit text-white card-title d-flex align-items-center justify-content-between">
                                <p>Thanh toán bằng thẻ ATM nội địa : nếu ứng dụng ngân hàng của bạn chưa hỗ trợ quét mã QR.</p>
                                <p>24/24</p>
                            </div>
                        </label>
                    </div>
                    <div class="debit-card mb-4">
                        <label class="d-flex flex-column h-100 p-3">
                            <div class="d-block">
                                <div class="d-flex position-relative">
                                    <div>
                                        <img src="../assets/images/images/payment.png"
                                            alt="master" class="master">
                                        <p class="mt-2 text-white fw-bold">Thanh toán bằng thẻ quốc tế</p>
                                    </div>
                                    <div class="input-debit-card">
                                        <input type="radio" name="bankCode" id="bankCode" value="INTCARD" required>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-auto adcarddebit text-white card-title d-flex align-items-center justify-content-between">
                                <p>Thanh toán trên phạm vi toàn cầu, thẻ thanh toán quốc tế mang lại cho người sử dụng nhiều lợi ích thiết thực.</p>
                                <p>24/24</p>
                            </div>
                        </label>
                    </div>
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