<?php
/* Sản phẩm */
$nametype = "san-pham";
$config['product'][$nametype]['title_main'] = "Sản Phẩm";
$config['product'][$nametype]['dropdown'] = true;
$config['product'][$nametype]['item'] = false;
$config['product'][$nametype]['sub'] = false;
$config['product'][$nametype]['tags'] = false;
$config['product'][$nametype]['view'] = true;
$config['product'][$nametype]['copy'] = false;
$config['product'][$nametype]['copy_image'] = false;
$config['product'][$nametype]['slug'] = true;
$config['product'][$nametype]['seo'] = true;
$config['product'][$nametype]['check'] = array("noibat" => "Nổi bật");
$config['product'][$nametype]['images'] = true;
$config['product'][$nametype]['images2'] = false;
$config['product'][$nametype]['show_images'] = true;
$config['product'][$nametype]['gallery'] = array
(
    $nametype => array
    (
        "title_main_photo" => "Hình ảnh sản phẩm",
        "title_sub_photo" => "Hình ảnh",
        "craft_photo" => true,
        "gia_photo" => false,
        "images_photo" => true,
        "avatar_photo" => true,
        "tieude_photo" => true,
        "video_photo" => true,
        "file_photo" => true,
        "quantity_photo" => false,
        "width_photo" => 540,
        "height_photo" => 540,
        "thumb_photo" => '75x52x1',
        "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP',
        "file_type_photo" => '.mp4|.MP4',
    ),
    'gia-'.$nametype => array
    (
        "title_main_photo" => "Giá sản phẩm",
        "title_sub_photo" => "Giá chi tiết",
        "craft_photo" => false,
        "radio_photo" => true,
        "gia_photo" => true,
        "images_photo" => false,
        "avatar_photo" => true,
        "tieude_photo" => false,
        "video_photo" => false,
        "file_photo" => false,
        "quantity_photo" => true,
        "width_photo" => 540,
        "height_photo" => 540,
        "thumb_photo" => '540x540x1',
        "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP',
        "file_type_photo" => '.mp4|.MP4',
    ),
);
$config['product'][$nametype]['import'] = false;
$config['product'][$nametype]['export'] = false;
$config['product'][$nametype]['type'] = 2; // 1 là giá đăng trong sản phẩm, 2 là giá đăng trong detail
$config['product'][$nametype]['ma'] = true;
$config['product'][$nametype]['gia'] = true;
$config['product'][$nametype]['giamoi'] = true;
$config['product'][$nametype]['giakm'] = true;
$config['product'][$nametype]['quantity'] = false;
$config['product'][$nametype]['giatext'] = false;
$config['product'][$nametype]['iframe'] = true;
$config['product'][$nametype]['diachi'] = true;
$config['product'][$nametype]['mota'] = true;
$config['product'][$nametype]['mota_cke'] = false;
$config['product'][$nametype]['noidung'] = true;
$config['product'][$nametype]['noidung_cke'] = true;
$config['product'][$nametype]['width'] = 540;
$config['product'][$nametype]['height'] = 540;
$config['product'][$nametype]['width2'] = 540;
$config['product'][$nametype]['height2'] = 540;
$config['product'][$nametype]['thumb'] = '540x540x1';
$config['product'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP';

/* Sản phẩm (brand) */
$config['product'][$nametype]['brand'] = true;
$config['product'][$nametype]['title_main_brand'] = "Hãng";
$config['product'][$nametype]['images_brand'] = true;
$config['product'][$nametype]['show_images_brand'] = true;
$config['product'][$nametype]['width_brand'] = 157;
$config['product'][$nametype]['height_brand'] = 213;
$config['product'][$nametype]['thumb_brand'] = '540x540x1';
$config['product'][$nametype]['img_type_brand'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP';

/* Sản phẩm (Attr) */
$config['product'][$nametype]['attr'] = true;
$config['product'][$nametype]['title_main_attr'] = "Thuộc tính";
$config['product'][$nametype]['images_attr'] = true;
$config['product'][$nametype]['title_images_attr'] = "Ảnh mô tả";
$config['product'][$nametype]['show_images_attr'] = true;
$config['product'][$nametype]['check_attr'] = array();
$config['product'][$nametype]['gallery_attr'] = array();
$config['product'][$nametype]['mota_attr'] = false;
$config['product'][$nametype]['mota_cke_attr'] = false;
$config['product'][$nametype]['noidung_attr'] = false;
$config['product'][$nametype]['noidung_cke_attr'] = false;
$config['product'][$nametype]['width_attr'] = 50;
$config['product'][$nametype]['height_attr'] = 50;
$config['product'][$nametype]['thumb_attr'] = '100x100x1';
$config['product'][$nametype]['img_type_attr'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP';

/* Sản phẩm (Attr detail) */
$config['product'][$nametype]['attributes'] = true;
$config['product'][$nametype]['title_main_attributes'] = "Thuộc tính chi tiết";
$config['product'][$nametype]['category_attributes'] = true;
$config['product'][$nametype]['images_attributes'] = true;
$config['product'][$nametype]['title_images_attributes'] = "Ảnh mô tả";
$config['product'][$nametype]['show_images_attributes'] = false;
$config['product'][$nametype]['check_attributes'] = array();
$config['product'][$nametype]['gallery_attributes'] = array();
$config['product'][$nametype]['mota_attributes'] = false;
$config['product'][$nametype]['mota_cke_attributes'] = false;
$config['product'][$nametype]['noidung_attributes'] = false;
$config['product'][$nametype]['noidung_cke_attributes'] = false;
$config['product'][$nametype]['width_attributes'] = 80;
$config['product'][$nametype]['height_attributes'] = 30;
$config['product'][$nametype]['thumb_attributes'] = '80x30x1';
$config['product'][$nametype]['img_type_attributes'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP';

/* Sản phẩm (List) */
$config['product'][$nametype]['list'] = true;
$config['product'][$nametype]['title_main_list'] = "Danh mục cấp 1";
$config['product'][$nametype]['images_list'] = true;
$config['product'][$nametype]['images_list2'] = false;
$config['product'][$nametype]['show_images_list'] = true;
$config['product'][$nametype]['slug_list'] = true;
$config['product'][$nametype]['check_list'] = array("noibat" => "Nổi bật");
$config['product'][$nametype]['gallery_list'] = array();
$config['product'][$nametype]['mota_list'] = false;
$config['product'][$nametype]['seo_list'] = true;
$config['product'][$nametype]['width_list'] = 300;
$config['product'][$nametype]['height_list'] = 200;
$config['product'][$nametype]['width_list2'] = 1366;
$config['product'][$nametype]['height_list2'] = 300;
$config['product'][$nametype]['thumb_list'] = '300x200x1';
$config['product'][$nametype]['img_type_list'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP';

/* Sản phẩm (Cat) */
$config['product'][$nametype]['cat'] = true;
$config['product'][$nametype]['title_main_cat'] = "Danh mục cấp 2";
$config['product'][$nametype]['images_cat'] = true;
$config['product'][$nametype]['show_images_cat'] = true;
$config['product'][$nametype]['slug_cat'] = true;
$config['product'][$nametype]['check_cat'] = array();
$config['product'][$nametype]['mota_cat'] = false;
$config['product'][$nametype]['seo_cat'] = true;
$config['product'][$nametype]['width_cat'] = 300;
$config['product'][$nametype]['height_cat'] = 200;
$config['product'][$nametype]['thumb_cat'] = '300x200x1';
$config['product'][$nametype]['img_type_cat'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP';

/* Website */
$nametype = "thiet-ke-website";
$config['product'][$nametype]['title_main'] = "Thiết kế website";
$config['product'][$nametype]['dropdown'] = false;
$config['product'][$nametype]['item'] = false;
$config['product'][$nametype]['sub'] = false;
$config['product'][$nametype]['tags'] = false;
$config['product'][$nametype]['view'] = true;
$config['product'][$nametype]['copy'] = false;
$config['product'][$nametype]['copy_image'] = false;
$config['product'][$nametype]['slug'] = true;
$config['product'][$nametype]['seo'] = true;
$config['product'][$nametype]['check'] = array("noibat" => "Nổi bật");
$config['product'][$nametype]['images'] = true;
$config['product'][$nametype]['images2'] = false;
$config['product'][$nametype]['show_images'] = true;
$config['product'][$nametype]['gallery'] = array
(
    $nametype => array
    (
        "title_main_photo" => "Hình ảnh mô tả",
        "title_sub_photo" => "Hình ảnh",
        "craft_photo" => true,
        "gia_photo" => false,
        "images_photo" => true,
        "avatar_photo" => true,
        "tieude_photo" => true,
        "video_photo" => true,
        "file_photo" => true,
        "quantity_photo" => false,
        "width_photo" => 540,
        "height_photo" => 540,
        "thumb_photo" => '75x52x1',
        "img_type_photo" => '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP',
        "file_type_photo" => '.mp4|.MP4',
    ),
);
$config['product'][$nametype]['import'] = false;
$config['product'][$nametype]['export'] = false;
$config['product'][$nametype]['type'] = 1; // 1 là giá đăng trong sản phẩm, 2 là giá đăng trong detail
$config['product'][$nametype]['ma'] = true;
$config['product'][$nametype]['gia'] = true;
$config['product'][$nametype]['giamoi'] = true;
$config['product'][$nametype]['giakm'] = true;
$config['product'][$nametype]['quantity'] = false;
$config['product'][$nametype]['giatext'] = false;
$config['product'][$nametype]['iframe'] = false;
$config['product'][$nametype]['diachi'] = false;
$config['product'][$nametype]['mota'] = true;
$config['product'][$nametype]['mota_cke'] = false;
$config['product'][$nametype]['noidung'] = true;
$config['product'][$nametype]['noidung_cke'] = true;
$config['product'][$nametype]['width'] = 540;
$config['product'][$nametype]['height'] = 540;
$config['product'][$nametype]['width2'] = 540;
$config['product'][$nametype]['height2'] = 540;
$config['product'][$nametype]['thumb'] = '540x540x1';
$config['product'][$nametype]['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF|.svg|.SVG|.webp|.WEBP';



?>