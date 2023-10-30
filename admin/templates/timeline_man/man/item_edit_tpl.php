<?php
    $linkSave = "index.php?com=timeline&act=save_mem";
    $linkMan = "index.php?com=timeline&act=man_mem";

?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="<?= $linkMan ?>" title="Thêm giao dịch">Cập nhật bài viết</a></li>
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
                <h3 class="card-title">Cập nhật bài viết</h3>
            </div>
          
            <div class="card-body row">
                <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
                <div class="form-group col-md-12">
                    <label for="noidung">Nội dung:</label>
                    <textarea class="form-control for-seo form-control-ckeditor short"
                        name="data[noidung]" id="noidung" rows="5"
                        placeholder="Nội dung"><?=htmlspecialchars_decode(@$item['noidung'])?></textarea>
                </div>
                <div class="form-group col-md-12">
                    <label class="d-block" for="id_status">Trạng thái:</label>
                    <?= $func->get_select_status("status", "timeline", $config['website']['lang-default'], true, "Chọn trạng thái") ?>
                </div>
            </div>
        </div>
       
        <div class="card card-primary card-outline text-sm mt-4 mb-4">
            <div class="card-header">
                <h3 class="card-title">Hình ảnh video</h3>
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
                            <th class="align-middle text-center" width="10%">STT</th>
                            <th class="align-middle">Hình</th>
                            <th class="align-middle">Mô tả</th>
                            <th class="align-middle">Loại</th>
                            <th class="align-middle text-right">Hiển thị</th>
                         
                        </tr>
                    </thead>
                    <?php $timeline_file = $func->get_rows("member_photo", "id_timeline",$item['id']); if(empty($timeline_file)) { ?>
                        <tbody><tr><td colspan="100" class="text-center">Không có dữ liệu</td></tr></tbody>
                    <?php } else { ?>
                        <tbody>
                            <?php foreach($timeline_file as $tl_file) { ?> 
                                <tr>
                                    <td class="align-middle">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="custom-control-input select-checkbox" id="select-checkbox-<?=$tl_file['id']?>" value="<?=$tl_file['id']?>">
                                            <label for="select-checkbox-<?=$tl_file['id']?>" class="custom-control-label"></label>
                                        </div>
                                    </td>
                                    <td class="align-middle">
                                        <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$tl_file['stt']?>" data-id="<?=$tl_file['id']?>" data-table="member_photo">
                                    </td>
                                    <td class="align-middle">
                                        <a href="<?=$linkEditPhoto?>&id=<?=$tl_file['id']?>&id-timeline=<?= $item['id'] ?>" title="<?=$tl_file['mota']?>">
                                            <?php if($tl_file['type'] == 0) { ?> 
                                                <img class="rounded img-preview" onerror="src='assets/images/noimage.png'" src="<?=THUMBS?>/100x100x1/<?=UPLOAD_USER_L.$tl_file['photo']?>" alt="<?=$tl_file['mota']?>">
                                            <?php } else if($tl_file['type'] == 1) { ?> 
                                                <img class="rounded img-preview" onerror="src='assets/images/noimage.png'" style="width: 55px; height: 55px; object-fit: cover" src="https://img.youtube.com/vi/<?=$func->getYoutube($tl_file['link_video'])?>/0.jpg" alt="<?=$tl_file['mota']?>">
                                            <?php } else { ?> 
                                                <img class="rounded img-preview" onerror="src='assets/images/noimage.png'" src="<?=THUMBS?>/100x100x1/<?=UPLOAD_USER_L.$items[$i]['photo']?>" alt="<?=$tl_file['mota']?>"> 
                                            <?php } ?>
                                        </a>
                                    </td>
                                    <td class="align-middle">
                                        <?= $tl_file['mota'] ?>
                                    </td>
                                    <td class="align-middle">
                                        <?= $tl_file['type'] == 0 ? "Hình" : ($tl_file['type'] == 1 ? "Video Youtube" : "video mp4") ?>
                                    </td>
                                    <td class="align-middle text-right">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$tl_file['id']?>" data-table="member_photo" data-id="<?=$tl_file['id']?>" data-loai="hienthi" <?=($tl_file['hienthi'])?'checked':''?>>
                                            <label for="show-checkbox-<?=$tl_file['id']?>" class="custom-control-label"></label>
                                        </div>
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