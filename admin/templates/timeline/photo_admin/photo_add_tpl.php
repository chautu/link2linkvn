<?php
    $linkSave = "index.php?com=user&act=save-photo-timeline-admin&id-timeline=".$_GET['id-timeline']."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active"><a href="javascript:void(0);" onclick="history.back();" title="Thêm giao dịch">Thêm hình ảnh mô tả</a></li>
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
        <div class="row">
            <div class="col-xl-8">
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Thêm hình ảnh mô tả</h3>
                    </div>
                    <div class="card-body row">
                        <div class="form-group col-12">
                            <label for="mota">Mô tả:</label>
                            <textarea class="form-control" name="data[mota]" id="mota" rows="5" placeholder="Mô tả"><?=@$item['mota']?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="stt">Số thứ tự:</label>
                            <input type="number" class="form-control for-seo" name="data[stt]" id="stt" min="0"
                                placeholder="Số thứ tự" value="<?=isset($item['stt']) ? $item['stt'] : 1?>"
                                required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="hienthi" class="d-inline-block align-middle mb-0 mr-2">Hiển thị:</label>
                            <div class="custom-control custom-checkbox d-inline-block align-middle">
                                <input type="checkbox" class="custom-control-input hienthi-checkbox"
                                    name="data[hienthi]" id="hienthi-checkbox"
                                    <?=(!isset($item['hienthi']) || $item['hienthi']==1)?'checked':''?>>
                                <label for="hienthi-checkbox" class="custom-control-label"></label>
                            </div>
                        </div>                        
                    </div>
                </div>
            </div>
            <div class="col-xl-4"> 
                <div class="card card-primary card-outline text-sm">
                    <div class="card-header">
                        <h3 class="card-title">Loại hiển thị</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group-category row">
                            <div class="form-group col-md-12 category-mau">
                                <label for="type_hienthi">Chọn loại:</label>
                                <select id="type_hienthi" name="data[type]" class="form-control text-sm select2"
                                    required>
                                    <option value="0"
                                        <?= isset($item) && @$item['type'] == 0 ? "selected" : '' ?>>Hình ảnh
                                    </option>
                                    <option value="1"
                                        <?= isset($item) && @$item['type'] == 1 ? "selected" : '' ?>>Video
                                        youtube
                                    </option>
                                    <option value="2"
                                        <?= isset($item) && @$item['type'] == 2 ? "selected" : '' ?>>File video
                                    </option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                $(document).ready(function() {
                    if ($('#type_hienthi option').filter(':selected').val() == 0) {
                        $(".box-picture").show();
                        $(".box-mp4").hide();
                        $(".box-video").hide();
                    } else if ($('#type_hienthi option').filter(':selected').val() == 1) {
                        $(".box-picture").hide();
                        $(".box-mp4").hide();
                        $(".box-video").show();
                    } else {
                        $(".box-picture").show();
                        $(".box-mp4").show();
                        $(".box-video").hide();
                    }
                    $("#type_hienthi").change(function() {
                        const box = $(this).val();
                        if (box == 0) {
                            $(".box-picture").show();
                            $(".box-mp4").hide();
                            $(".box-video").hide();
                        } else if (box == 1) {
                            $(".box-picture").hide();
                            $(".box-mp4").hide();
                            $(".box-video").show();
                        } else {
                            $(".box-picture").show();
                            $(".box-mp4").show();
                            $(".box-video").hide();
                        }
                    });
                });
                </script>
                <div class="card card-primary card-outline text-sm box-picture">
                    <div class="card-header">
                        <h3 class="card-title">Hình ảnh mô tả</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
							$photoDetail = "../upload/".$com."/".@$item['photo'];
							$dimension = "Width: 540px - Height: 540px (.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF)";
							include TEMPLATE.LAYOUT."image.php";
							?>
                    </div>
                </div>
                <div class="card card-primary card-outline text-sm card_upload upload_video_mp4 box-mp4">
                    <div class="card-header">
                        <h3 class="card-title">Upload file</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label class="change-photo w-100" for="video-file">
                                <p>Upload video:</p>
                                <div class="rounded">
                                    <video id="myVideo" controls loop data-autoplay style="width:100%;">
                                        <!-- muted -->
                                        <source src="<?= "../upload/user/" . @$item['taptin'] ?>" type="video/mp4">
                                    </video>
                                    <strong>
                                        <b class="text-sm text-split"></b>
                                        <span class="btn btn-sm bg-gradient-success"><i
                                                class="fas fa-camera mr-2"></i>Chọn video</span>
                                    </strong>
                                </div>
                            </label>
                            <strong
                                class="d-block mt-2 mb-2 text-sm"><?php echo "File type: (.mp4|.MP4)" ?></strong>
                            <div class="custom-file my-custom-file d-none">
                                <input type="file" class="custom-file-input" name="video-file" id="video-file">
                                <label class="custom-file-label" for="video-file">Chọn file</label>
                            </div>
                        </div>
                    </div>
                </div>
                <script>
                $('#video-file').change(function() {
                    var $source = $('#myVideo');
                    $source[0].src = URL.createObjectURL(this.files[0]);
                    $source.parent()[0].load();
                });
                </script>
                <div class="card card-primary card-outline text-sm box-video">
                    <div class="card-header">
                        <h3 class="card-title">Upload file</h3>
                        <div class="card-tools">
                            <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                    class="fas fa-minus"></i></button>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label for="link_video">Video:</label>
                            <input type="text" class="form-control" name="data[link_video]" id="link_video"
                                onchange="youtubePreview(this.value,'#loadVideo');" placeholder="Video">
                        </div>
                        <div class="form-group">
                            <label for="link_video">Video preview:</label>
                            <div>
                                <iframe style="background: #4b4949;"
                                    src="//www.youtube.com/embed/<?=$func->getYoutube($item['link_video'])?>"
                                    id="loadVideo" width="100%" height="250px" frameborder="0" allowfullscreen></iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="card-footer text-sm">
            <button type="submit" class="btn btn-sm bg-gradient-primary" disabled><i class="far fa-save mr-2"></i>Lưu</button>
            <button type="reset" class="btn btn-sm bg-gradient-secondary"><i class="fas fa-redo mr-2"></i>Làm lại</button>
            <a class="btn btn-sm bg-gradient-danger" href="javascript:void(0);" onclick="history.back();" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
            <input type="hidden" name="id" value="<?=(isset($item['id']) && $item['id'] > 0) ? $item['id'] : ''?>">
            <input type="hidden" name="data[id_timeline]" value="<?= $_GET['id-timeline'] ?>">
        </div>
    </form>
</section>