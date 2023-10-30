<?php
    $linkParent = "index.php?com=".$com."&act=".$kind."&type=".$type."&p=".$curPage;
    $linkMan = "index.php?com=".$com."&act=man_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage;
    $linkAdd = "index.php?com=".$com."&act=add_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage;
    $linkEdit = "index.php?com=".$com."&act=edit_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage;
    $linkDelete = "index.php?com=".$com."&act=delete_photo&idc=".$idc."&type=".$type."&kind=".$kind."&val=".$val."&p=".$curPage;
?>
<!-- Content Header -->
<section class="content-header text-sm">
    <div class="container-fluid">
        <div class="row">
            <ol class="breadcrumb float-sm-left">
                <li class="breadcrumb-item"><a href="index.php" title="Bảng điều khiển">Bảng điều khiển</a></li>
                <li class="breadcrumb-item active">Quản lý <?=$config[$com][$type][$dfgallery][$val]['title_main_photo']?></li>
            </ol>
        </div>
    </div>
</section>

<!-- Main content -->
<section class="content">
    <div class="card-footer text-sm sticky-top">
        <a class="btn btn-sm bg-gradient-primary text-white" href="<?=$linkAdd?>" title="Thêm mới"><i class="fas fa-plus mr-2"></i>Thêm mới</a>
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <a class="btn btn-sm bg-gradient-secondary" href="<?=$linkParent?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
    </div>
    <div class="card card-primary card-outline text-sm mb-0">
        <div class="card-header">
            <h3 class="card-title">Danh sách <?=$config[$com][$type][$dfgallery][$val]['title_main_photo']?></h3>
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
                        <?php if(isset($config[$com][$type][$dfgallery][$val]['avatar_photo']) && $config[$com][$type][$dfgallery][$val]['avatar_photo'] == true) { ?>
                        	<th class="align-middle text-center" width="8%">Hình</th>
				        <?php } ?>
                        <?php if(isset($config[$com][$type][$dfgallery][$val]['tieude_photo']) && $config[$com][$type][$dfgallery][$val]['tieude_photo'] == true) { ?>
				        	<th class="align-middle" style="width: 15%">Tiêu đề</th>
				        <?php } ?>
                        <?php if(isset($config[$com][$type]['type']) && $config[$com][$type]['type'] == 2 && isset($config[$com][$type][$dfgallery][$val]['gia_photo']) && $config[$com][$type][$dfgallery][$val]['gia_photo']) { ?>
                            <th class="align-middle text-center">Thuộc tính</th>
                            <th class="align-middle text-center">Giá</th>
                            <th class="align-middle text-center">Số lượng</th>
                            <th class="align-middle text-center">Đã bán</th>
                        <?php } ?>
                        <th class="align-middle text-center">Hiển thị</th>
                        <th class="align-middle text-right">Thao tác</th>
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
                                    <input type="number" class="form-control form-control-mini m-auto update-stt" min="0" value="<?=$items[$i]['stt']?>" data-id="<?=$items[$i]['id']?>" data-table="gallery">
                                </td>
                                <?php if(isset($config[$com][$type][$dfgallery][$val]['avatar_photo']) && $config[$com][$type][$dfgallery][$val]['avatar_photo'] == true) { ?>
	                                <td class="align-middle text-center">
	                                    <a href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['ten'.$config['website']['lang-default']]?>">
                                            <?php if($items[$i]['type_hienthi'] == 0) { ?> 
                                                <img class="rounded img-preview" onerror="src='assets/images/noimage.png'" src="<?=THUMBS?>/<?=$config[$com][$type][$dfgallery][$val]['thumb_photo']?>/<?="upload/".$com."/".$items[$i]['photo']?>" alt="<?=$items[$i]['ten'.$config['website']['lang-default']]?>">
                                            <?php } else if($items[$i]['type_hienthi'] == 1) { ?> 
                                                <img class="rounded img-preview" onerror="src='assets/images/noimage.png'" style="width: 70px; height: 52px; object-fit: cover" src="https://img.youtube.com/vi/<?=$func->getYoutube($items[$i]['link_video'])?>/0.jpg" alt="<?=$items[$i]['ten'.$config['website']['lang-default']]?>">
                                            <?php } else { ?> 
                                                <img class="rounded img-preview" onerror="src='assets/images/noimage.png'" src="<?=THUMBS?>/<?=$config[$com][$type][$dfgallery][$val]['thumb_photo']?>/<?="upload/".$com."/".$items[$i]['photo']?>" alt="<?=$items[$i]['ten'.$config['website']['lang-default']]?>"> 
                                            <?php } ?>
                                        </a>
	                                </td>
	                            <?php } ?>
                                <?php if(isset($config[$com][$type][$dfgallery][$val]['tieude_photo']) && $config[$com][$type][$dfgallery][$val]['tieude_photo'] == true) { ?>
	                                <td class="align-middle">
	                                    <a class="text-dark" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="<?=$items[$i]['ten'.$config['website']['lang-default']]?>"><?=$items[$i]['ten'.$config['website']['lang-default']]?></a>
	                                </td>
	                            <?php } ?>
                                <?php if(isset($config[$com][$type]['type']) && $config[$com][$type]['type'] == 2 && isset($config[$com][$type][$dfgallery][$val]['gia_photo']) && $config[$com][$type][$dfgallery][$val]['gia_photo']) { ?>
						        	<td class="align-middle text-center">
                                        <?php 
											$attr = $d->rawQueryOne("select id_attr from #_product where id = ? limit 0,1",array($items[$i]['id_photo'])); 
											if(isset($attr['id_attr']))
											{
												$listattr = explode(",",$attr['id_attr']);
												$cols = ['ten'.$config['website']['lang-default'],"id"];
												$d->where('id', $listattr, 'IN');
												$d->where('hienthi', 0, '>');
												$d->where('type_hienthi', 0, '=');
												$d->where('type', $type);
												$resAttr = $d->get("product_attr", null, $cols);
                                                foreach($resAttr as $att) {
                                                    echo $att['ten'.$config['website']['lang-default']].': ';
                                                    $ops = json_decode($items[$i]['options'], true);
                                                    $attribute = $d->rawQueryOne("select ten".$config['website']['lang-default']." from #_product_attributes where id = ?", array($ops['option_'.$att['id']]));
                                                    echo '<b>'. $attribute['ten'.$config['website']['lang-default']].'</b><br>';
                                                }
											}
										?>
						        	</td>
                                    <td class="align-middle text-center"><?= number_format($items[$i]['giamoi']) ?></td>
                                    <td class="align-middle text-center"><?= number_format($items[$i]['quantity']) ?></td>
                                    <td class="align-middle text-center"><?= number_format($items[$i]['sold']) ?></td>
						        <?php } ?>
						        
								<td class="align-middle text-center">
                                	<div class="custom-control custom-checkbox my-checkbox">
                                        <input type="checkbox" class="custom-control-input show-checkbox" id="show-checkbox-<?=$items[$i]['id']?>" data-table="gallery" data-id="<?=$items[$i]['id']?>" data-loai="hienthi" <?=($items[$i]['hienthi'])?'checked':''?>>
                                        <label for="show-checkbox-<?=$items[$i]['id']?>" class="custom-control-label"></label>
                                    </div>
                                </td>
                                <td class="align-middle text-right text-md text-nowrap">
                                    <a class="text-primary mr-2" href="<?=$linkEdit?>&id=<?=$items[$i]['id']?>" title="Chỉnh sửa"><i class="fas fa-edit"></i></a>
                                    <a class="text-danger" id="delete-item" data-url="<?=$linkDelete?>&id=<?=$items[$i]['id']?>" title="Xóa"><i class="fas fa-trash-alt"></i></a>
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
        <a class="btn btn-sm bg-gradient-danger text-white" id="delete-all" data-url="<?=$linkDelete?>" title="Xóa tất cả"><i class="far fa-trash-alt mr-2"></i>Xóa tất cả</a>
        <a class="btn btn-sm bg-gradient-secondary" href="<?=$linkParent?>" title="Thoát"><i class="fas fa-sign-out-alt mr-2"></i>Thoát</a>
    </div>
</section>