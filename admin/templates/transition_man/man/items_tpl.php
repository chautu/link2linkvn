<?php
	$linkMan = "index.php?com=transition&act=man_mem";
    $linkAdd = "index.php?com=transition&act=add_mem";
	$linkEdit = "index.php?com=transition&act=edit_mem";
    $linkFilter = "index.php?com=transition&act=man_mem";

    $linkUser = "index.php?com=user&act=edit";
?>

<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý lịch sử thay đổi số dư</li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
        <a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <div class="form-inline form-search d-inline-block align-middle ml-3">
            <div class="input-group input-group-sm">
                <input class="form-control form-control-navbar text-sm" type="search" id="keyword" placeholder="Tìm kiếm" aria-label="Tìm kiếm" value="<?=(isset($_GET['keyword'])) ? $_GET['keyword'] : ''?>" onkeypress="doEnter(event,'keyword','<?=$linkMan?>')">
                <div class="input-group-append rounded-right">
                    <button class="btn  btn-navbar text-white bg-primary " type="button" onclick="onSearch('keyword','<?=$linkMan?>')">
                        <i class="fas fa-search"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="card-footer form-group-category text-sm bg-light row">
        <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2"><?=$func->get_link_status('status', 'transition', $config['website']['lang-default'], false, "Lọc trạng thái", "filer-category")?></div>
        <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2">
            <select id="type" name="type" onchange="onchange_category($(this), '<?= $linkFilter ?>')" class="form-control select2 filer-category">
				<option value="" selected="" hidden="">Lọc kiểu</option>
                <option <?= isset($_GET['type']) && $_GET['type'] == 1 ? "selected" : "" ?> value="1">Cộng tiền</option>
                <option <?= isset($_GET['type']) && $_GET['type'] == 2 ? "selected" : "" ?> value="2">Trừ tiền</option>
            </select>
        </div>
        <div class="form-group col-xl-2 col-lg-3 col-md-4 col-sm-4 mb-2">
            <select id="id_member" name="id_member" onchange="onchange_category($(this), '<?= $linkFilter ?>')" class="form-control select2 filer-category">
				<option value="" selected="" hidden="">Lọc username</option>
                <?php foreach($member as $mem) { ?> 
                    <option <?= isset($_GET['id_member']) && $_GET['id_member'] == $mem['id'] ? "selected" : "" ?> value="<?= $mem['id'] ?>"><?= $mem['username'] ?></option>
                <?php } ?>
            </select>
        </div>
    </div>
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Lịch sử thay đổi số dư</h3>
        </div>
        <div class="card-body table-responsive p-0">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th class="align-middle" width="5%">
                            <div class="custom-control custom-checkbox my-checkbox">
                                <input type="checkbox" class="custom-control-input" id="selectall-checkbox">
                                <label for="selectall-checkbox" class="custom-control-label"></label>
                            </div>
                        </th>
                        <th class="align-middle">Username</th>
                        <th class="align-middle">Trước giao dịch</th>
                        <th class="align-middle">Số tiền</th>
                        <th class="align-middle">Sau giao dịch</th>
                        <th class="align-middle">Kiểu giao dịch</th>
                        <th class="align-middle">Ghi chú</th>
                        <th class="align-middle">Ngày tạo</th>
                        <th class="align-middle text-center">Trạng thái</th>
                        <th class="align-middle text-center">Thao tác</th>
                    </tr>
                </thead>
                <?php if(empty($items)) { ?>
                    <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                <?php } else { ?>
                    <tbody>
                        <?php for($i=0;$i<count($items);$i++) { ?>
                            <tr>
                                <td class="align-middle">
                                    <div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$items[$i]['id']?>" value="<?=$items[$i]['id']?>">
                                        <label for="select-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark text-capitalize" href="<?=$linkUser?>&id=<?=$items[$i]['id_member']?>" title="<?= $func->get_profile($items[$i]['id_member'],'member')['username'] ?>"><?= $func->get_profile($items[$i]['id_member'],'member')['username'] ?></a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>&id_status=<?=$items[$i]['id_status']?>" title="<?=$items[$i]['money']?>"><?=number_format($items[$i]['first_money'])?></a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>&id_status=<?=$items[$i]['id_status']?>" title="<?=$items[$i]['money']?>"><?=number_format($items[$i]['money'])?></a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>&id_status=<?=$items[$i]['id_status']?>" title="<?=$items[$i]['last_money']?>"><?=number_format($items[$i]['last_money'])?></a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>&id_status=<?=$items[$i]['id_status']?>" title="<?=$items[$i]['bank']?>"><?=$items[$i]['bank']?></a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>&id_status=<?=$items[$i]['id_status']?>" title="<?=$items[$i]['ghichu']?>"><?=$items[$i]['ghichu']?></a>
                                </td>
                                <td class="align-middle">
                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>&id_status=<?=$items[$i]['id_status']?>" title="<?=$items[$i]['ngaytao']?>"><?= date("H:i d-m-Y", $items[$i]['ngaytao'])?></a>
                                </td>
                                <td class="align-middle text-center">
                                    <a class="text-dark text-capitalize" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>&id_status=<?=$items[$i]['id_status']?>" title="<?=$items[$i]['id_status']?>"><?= $func->get_status("status", $items[$i]['id_status'])?></a>
                                </td>
                                <td class="align-middle text-center text-md text-nowrap">
                                    <a class="text-primary mr-2" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>&id_status=<?=$items[$i]['id_status']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>
            </table>
        </div>
    </div>
    <?php if($paging) { ?>
        <div class="card-footer text-sm pb-0">
            <?=$paging?>
        </div>
    <?php } ?>
    <div class="card-footer text-sm">
        <a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
    </div>
</section>