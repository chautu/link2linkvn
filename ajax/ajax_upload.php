<?php
	include "ajax_config.php";
	if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["images"])) {
        $target_dir = UPLOAD_USER; // Thay đổi đường dẫn lưu trữ ảnh trên máy chủ của bạn
        $uploadedFiles = $_FILES["images"];

        $hash = (isset($_POST['hash']) && $_POST['hash']) ? htmlspecialchars($_POST['hash']) : "";
        $id = (isset($_POST['id']) && $_POST['id'] > 0) ? htmlspecialchars($_POST['id']) : 0;
        if($id) {
            $hash = "null";
        }

        foreach ($uploadedFiles["name"] as $key => $filename) {
            $filename = time().'-'.$filename;
            $target_file = $target_dir . basename($filename);
            $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

            if ($imageFileType == "jpg" || $imageFileType == "png" || $imageFileType == "jpeg") {
                if (move_uploaded_file($uploadedFiles["tmp_name"][$key], $target_file)) {
                    $data = [
                        'hash' => $hash,
                        'id_timeline' => $id,
                        'photo' => $filename,
                        'type'  => 0,
                        'hienthi' => 1,
                        'ngaytao' => time()
                    ];
                    $d->insert("member_photo", $data);
                }
            } else if ($imageFileType == "mp4") {
                if (move_uploaded_file($uploadedFiles["tmp_name"][$key], $target_file)) {
                    $data = [
                        'hash' => $hash,
                        'id_timeline' => $id,
                        'taptin' => $filename,
                        'type'  => 2,
                        'hienthi' => 1,
                        'ngaytao' => time()
                    ];
                    $d->insert("member_photo", $data);
                }
            }
        }

        $list_file = $d->rawQuery("select * from #_member_photo where hash = ? and id_timeline = ?", array($hash, $id));
    }
?>

<?php if(isset($list_file) && count($list_file)) { ?> 
    <div class="container-photo-timeline grid<?= count($list_file) == 1 ? "1" : (count($list_file) == 2 ? "2" : (count($list_file) == 3 ? "3" : (count($list_file) == 4 ? "2" : "5"))) ?>">
        <?php foreach($list_file as $key => $file) { ?>
            <?php if($key < 5) { ?> 
                <?php if($file['type'] == 0) { ?> 
                    <div class="img-photo <?= $key == 4 && count($list_file) - 5 > 0 ? "active" : "" ?>" data-plus="+ <?= count($list_file) - 5 ?>">
                        <img src="<?= THUMBS ?>/680x620x1/<?= UPLOAD_USER_L.$file['photo'] ?>" alt="<?= $file['mota'] ?>">
                    </div>    
                <?php } else if($file['type'] == 2) { ?> 
                    <div class="img-photo <?= $key == 4 && count($list_file) - 5 > 0 ? "active" : "" ?>" data-plus="+ <?= count($list_file) - 5 ?>">
                        <video id="myVideo" controls loop data-autoplay>
                            <source src="<?= UPLOAD_USER_L.$file['taptin'] ?>" type="video/mp4">
                        </video>
                    </div> 
                <?php } ?>
            <?php } ?> 
        <?php } ?>
        <div class="edit-photo-timeline" data-id="<?= $id ?>" data-hash="<?= $hash ?>">
            <i class="fas fa-pen"></i>
            <p>Chỉnh sửa</p> 
        </div>
    </div>
<?php } ?>
