<?php
/* Config type - Group */
$config['group'] = array(
//     "Group Sản Phẩm" => array(
//         "product" => array("san-pham"),
//         // "tags" => array("san-pham"),
//         // "static" => array("gioi-thieu-san-pham"),
//         // "photo" => array("slide-product"),
//         // "photo_static" => array("watermark"),
//         // "newsletter" => array("dangkybaogia")
//     ),
//     "Group Tin Tức" => array(
//         "news" => array("tin-tuc"),
//         // "tags" => array("tin-tuc"),
//         // "photo_static" => array("watermark-news"),
//         // "newsletter" => array("dangkytuyendung")
//     ),
// "Header" => array(
//     "photo_static" => array("background", "logo", "favicon", "loadding"),
//     "photo" => array('mxh1', 'mangxahoi'),
// ),
// "Footer" => array(
//     "static" => array("footer"),
//     "photo" => array("footer-1", "footer-2", "footer-3", "footer-4", 'mxh'),
// ),
// "Liên hệ" => array(
//     "static" => array("whyus", "lien-he"),
// ),
// "Login" => array(
//     "photo_static" => array("banner-auth"),
//     "static" => array("auth"),
// ),
);

/* Config type - Product */
require_once LIBRARIES.'type/config-type-product.php';

/* Config type - Tags */
require_once LIBRARIES.'type/config-type-tags.php';

/* Config type - Newsletter */
require_once LIBRARIES.'type/config-type-newsletter.php';

/* Config type - News */
require_once LIBRARIES.'type/config-type-news.php';

/* Config type - Static */
require_once LIBRARIES.'type/config-type-static.php';

/* Config type - Photo */
require_once LIBRARIES.'type/config-type-photo.php';

/* Seo page */
$config['seopage']['page'] = array(
    "san-pham" => "Sản phẩm",
    "tin-tuc" => "Tin tức",
    "thu-vien-anh" => "Thư viện ảnh",
    "video" => "Video",
    "lien-he" => "Liên hệ"
);
$config['seopage']['width'] = 300;
$config['seopage']['height'] = 200;
$config['seopage']['thumb'] = '300x200x1';
$config['seopage']['img_type'] = '.jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF';

/* Setting */
$config['setting']['diachi'] = true;
$config['setting']['dienthoai'] = true;
$config['setting']['hotline'] = true;
$config['setting']['zalo'] = true;
$config['setting']['oaidzalo'] = false;
$config['setting']['email'] = true;
$config['setting']['website'] = true;
$config['setting']['fanpage'] = true;
$config['setting']['toado'] = true;
$config['setting']['toado_iframe'] = true;

/* Quản lý import */
$config['import']['images'] = false;
$config['import']['thumb'] = '100x100x1';
$config['import']['img_type'] = ".jpg|.gif|.png|.jpeg|.gif|.JPG|.PNG|.JPEG|.Png|.GIF";

/* Quản lý export */
$config['export']['category'] = true;

/* Quản lý tài khoản */
$config['user']['active'] = true;
$config['user']['admin'] = true;
$config['user']['visitor'] = true;

/* Quản lý phân quyền */
$config['permission'] = true;

/* Quản lý địa điểm */
$config['places']['active'] = true;

/* Quản lý thay đổi số dư */
$config['transition']['active'] = true;
$config['transition']['admin'] = true;
$config['transition']['member'] = true;

/* Quản lý bài viết dư */
$config['timeline']['active'] = true;
$config['timeline']['admin'] = true;
$config['timeline']['member'] = true;

/* Quản lý coupons */
$config['coupons']['active'] = true;

/* Quản lý comments */
$config['comments']['active'] = true;

/* Quản lý giỏ hàng */
$config['order']['active'] = true;
$config['order']['search'] = true;
$config['order']['excel'] = false;
$config['order']['word'] = false;
$config['order']['excelall'] = false;
$config['order']['wordall'] = false;
$config['order']['thumb'] = '100x100x1';

/* Quản lý thông báo đẩy */
$config['onesignal'] = false;

/* Quản lý mục (Không cấp) */
if(isset($config['news']))
{
    foreach($config['news'] as $key => $value)
    {
        if(!isset($value['dropdown']) || (isset($value['dropdown']) && $value['dropdown'] == false))
        { 
            $config['shownews'] = 1;
            break;
        }
    }
}
?>