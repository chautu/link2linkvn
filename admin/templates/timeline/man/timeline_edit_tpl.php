<?php
    $linkSave = "index.php?com=user&act=save-timeline&user=".$_GET['user']."&p=".$curPage;
    $linkMan = "index.php?com=user&act=edit&id=".$_GET['user']."&p=".$curPage."&active=trangcanhan";

    $linkDeletePhoto = "index.php?com=user&act=delete-photo-timeline&p=".$curPage;
    $linkAddPhoto = "index.php?com=user&act=add-photo-timeline&p=".$curPage;
    $linkEditPhoto = "index.php?com=user&act=edit-photo-timeline&p=".$curPage;
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
                <div class="form-group col-md-12">
                    <label for="noidung">Nội dung:</label>
                    <textarea class="form-control for-seo form-control-ckeditor short"
                        name="data[noidung]" id="noidung" rows="5"
                        placeholder="Nội dung"><?=htmlspecialchars_decode(@$item['noidung'])?></textarea>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-end">
                <a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddPhoto?>&id-timeline=<?= $item['id'] ?>&user=<?= $_GET['user'] ?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
                <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDeletePhoto?>&id-timeline=<?= $item['id'] ?>&user=<?= $_GET['user'] ?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
                <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
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
                            <th class="align-middle text-center">Hiển thị</th>
                            <th class="align-middle text-center">Thao tác</th>
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
                                    <td class="align-middle text-center">
                                        <div class="custom-control custom-checkbox my-checkbox">
                                            <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$tl_file['id']?>" data-table="member_photo" data-id="<?=$tl_file['id']?>" data-loai="hienthi" <?=($tl_file['hienthi'])?'checked':''?>>
                                            <label for="show-checkbox-<?=$tl_file['id']?>" class="custom-control-label"></label>
                                        </div>
                                    </td>
                                    <td class="align-middle text-center text-md text-nowrap">
                                        <a class="text-primary mr-2" href="<?=$linkEditPhoto?>&id=<?=$tl_file['id']?>&id-timeline=<?= $item['id'] ?>&user=<?= $_GET['user'] ?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                        <a class="text-danger" id="delete-item" data-url="<?=$linkDeletePhoto?>&id=<?=$tl_file['id']?>&id-timeline=<?= $item['id'] ?>&user=<?= $_GET['user'] ?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    <?php } ?>
                </table>
            </div>
        </div>
        <div class="d-flex justify-content-end pb-4">
                <a class="btn btn-sm bg-gradient-primary text-white mr-3" href="<?=$linkAddPhoto?>&id-timeline=<?= $item['id'] ?>&user=<?= $_GET['user'] ?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
                <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDeletePhoto?>&id-timeline=<?= $item['id'] ?>&user=<?= $_GET['user'] ?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        </div>
    </form>
</section>