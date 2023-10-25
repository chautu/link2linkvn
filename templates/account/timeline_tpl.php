<div class="center">
    <div class="container-user">
        <?php require_once("top-user.php") ?>
        <?php require_once("nav-user.php") ?>
        <div class="content-tab-user my-3">
            <div class="timeline-user">
                <div>
                    <div class="sticky-pv">
                        <div class="pd-20 nomal-info-user bg-user">
                            <div class="title-u">
                                <h4><?= introduce ?></h4>
                            </div>
                            <div class="mt-3">
                                <?= htmlspecialchars_decode($row_detail['gioithieu']) ?>
                                <hr>

                            </div>
                        </div>
                        <div class="pd-20 nomal-info-user bg-user mt-3">
                            <div class="title-u">
                                <h4><?= picture ?></h4>
                                <a href="account/photo"><?= allpicture ?></a>
                            </div>
                            <?php if(count($photos)) { ?> 
                                <div class="main-photo-user mt-3 lightgallery">
                                    <?php foreach($photos as $p) { ?> 
                                        <a href="<?=UPLOAD_USER_L.$p['photo']?>">
                                            <img src="<?= THUMBS ?>/200x200x1/<?=UPLOAD_USER_L.$p['photo']?>" alt="<?= $p['mota'] ?>">
                                        </a>
                                    <?php } ?>
                                </div>
                            <?php } else { ?> 
                                <div class="mt-3">
                                    <p><?= nopicture ?></p>
                                </div>    
                            <?php } ?>
                        </div>
                        <div class="pd-20 nomal-info-user bg-user mt-3">
                            <div class="title-u">
                                <h4><?= video ?></h4>
                                <a href="account/video"><?= allvideo ?></a>
                            </div>
                            <?php if(count($videos)) { ?> 
                                <div class="main-photo-user mt-3">
                                    <?php foreach($videos as $v) { ?> 
                                        <video id="myVideo" controls loop data-autoplay style="width:100%; height:100%; background-color: #000">
                                            <source src="<?= UPLOAD_USER_L.$v['taptin'] ?>" type="video/mp4">
                                        </video>
                                    <?php } ?>
                                </div>
                            <?php } else { ?> 
                                <div class="mt-3">
                                    <p><?= novideo ?></p>
                                </div>    
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="pd-20 nomal-info-user bg-user">
                        <div class="group-input-timeline">
                            <img class="img-avatar-user" onerror="src='assets/images/noimage.png'"
                                src="<?=THUMBS?>/40x40x1/<?=UPLOAD_USER_L.$row_detail['avatar']?>">
                            <p class="open-popup-user" data-act="member_timeline" data-id="0"><?= whatareyouthink ?></p>
                        </div>
                    </div>
                    
                    <?php foreach($timeline as $tl) { ?> 
                        <div class="timeline-realtime nomal-info-user bg-user no-overflow" id="timeline-<?= $tl['id'] ?>">
                            <div class="title-timeline">
                                <div class="time-create">
                                    <img class="img-avatar-user" onerror="src='assets/images/noimage.png'" src="<?=THUMBS?>/40x40x1/<?=UPLOAD_USER_L.$row_detail['avatar']?>">
                                    <div>
                                        <h2><?= $row_detail['ten'] ?></h2>
                                        <p><?= date("d \\t\\h\\g m, Y", $tl['ngaytao']) ?></p>
                                    </div>
                                </div>
                                <div class="dropdown no-select">
                                    <input type="checkbox" id="dropdown-<?= $tl['id'] ?>">
                                    <label for="dropdown-<?= $tl['id'] ?>"><i class="fas fa-ellipsis-h"></i></label>
                                    <div class="dropdown-container nomal-info-user  bg-user">
                                        <li>
                                            <a class="open-popup-user" data-act="member_timeline" data-id="<?= $tl['id'] ?>"><i class="fas fa-pen mr-2"></i> <?= editpost ?></a>
                                        </li>
                                        <li>
                                            <a class="delete-timeline" data-id="<?= $tl['id'] ?>"><i class="far fa-trash-alt mr-2"></i> <?= deletepost ?></a>
                                        </li>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="content-post">
                                <div class="content-<?= $tl['id'] ?> content-overload" data-id="<?= $tl['id'] ?>">
                                    <?= htmlspecialchars_decode($tl['noidung']) ?>
                                </div>
                                <span data-id="<?= $tl['id'] ?>" class="view-all-post readmore-<?= $tl['id'] ?> hidden"><?= viewmore ?></span>
                                <?php $photo_tl = $func->getPhotoTimeline($tl['id']); ?>
                                <div class="img-post lightgallery <?= count($photo_tl) == 1 ? "layout-g1" : (count($photo_tl) >= 2 && count($photo_tl) <= 4 ? "layout-g2" : "layout-g3") ?>">
                                    <?php foreach($photo_tl as $key => $ptl) { ?> 
                                        <?php if($ptl['type'] == 0) { ?> 
                                        <a href="<?= UPLOAD_USER_L.$ptl['photo'] ?>" class="items-photo-post <?= count($photo_tl) == 3 ? "g2-for" : "" ?> <?= $key == 4 ? 'more' : '' ?>" <?= $key == 4 ? "data-more='+ ".(count($photo_tl)-4)."'" : "" ?> <?= $key > 4 ? "id='hidden'" : '' ?>>
                                            <img src="<?= THUMBS ?>/680x620x1/<?= UPLOAD_USER_L.$ptl['photo'] ?>" alt="<?= $ptl['mota'] ?>">
                                        </a>
                                        <?php } else { ?> 
                                        <div class="items-photo-post <?= $key == 4 ? 'more' : '' ?>" <?= $key == 4 ? "data-more='+ ".(count($photo_tl)-4)."'" : "" ?> <?= $key > 4 ? "id='hidden'" : '' ?>>
                                            <video id="myVideo" controls loop data-autoplay style="width:100%; height:100%; background-color: #000">
                                                <source src="<?= UPLOAD_USER_L.$ptl['taptin'] ?>" type="video/mp4">
                                            </video>
                                        </div>
                                        <?php } ?>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>

