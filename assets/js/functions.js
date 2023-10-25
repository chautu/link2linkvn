function modalNotify(text)
{
    $("#popup-notify").find(".modal-body").html(text);
    $('#popup-notify').modal('show');
}

function ValidationFormSelf(ele='')
{
    if(ele)
    {
        $("."+ele).find("input[type=submit]").removeAttr("disabled");
        var forms = document.getElementsByClassName(ele);
        var validation = Array.prototype.filter.call(forms,function(form){
            form.addEventListener('submit', function(event){
                if(form.checkValidity() === false)
                {
                    event.preventDefault();
                    event.stopPropagation();
                }
                form.classList.add('was-validated');
            }, false);
        });
    }
}

function loadPagingAjax(url='',eShow='')
{
    if($(eShow).length && url)
    {
        $.ajax({
            url: url,
            type: "GET",
            async: true,
            data: {
                eShow: eShow
            },
            success: function(result){
                $(eShow).html(result);
            }
        });
    }
}


function doEnter(event,obj)
{
    if(event.keyCode == 13 || event.which == 13) onSearch(obj);
}

function onSearch(obj) 
{           
    var keyword = $("#"+obj).val();
    
    if(keyword=='')
    {
        modalNotify(LANG['no_keywords']);
        return false;
    }
    else
    {
        location.href = "san-pham?keyword="+encodeURI(keyword);
        loadPage(document.location);            
    }
}

function goToByScroll(id)
{
    var offsetMenu = 0;
    id = id.replace("#", "");
    if($("#menu").length) offsetMenu = $("#menu").height();
    $('html,body').animate({
        scrollTop: $("#" + id).offset().top - (offsetMenu * 2)
    }, 'slow');
}


function load_district(id=0)
{
    $.ajax({
        type: 'post',
        async: true,
        url: 'ajax/ajax_district.php',
        data: {id_city:id},
        success: function(result){
            $(".select-district").html(result);
            $(".select-wards").html('<option value="">'+LANG['wards']+'</option>');
            $('.select2').each(function () {
                const id = $(this).attr("id");
                $("#"+id).select2();
            });
        }
    });
}

function load_wards(id=0)
{
    $.ajax({
        type: 'post',
        async: true,
        url: 'ajax/ajax_wards.php',
        data: {id_district:id},
        success: function(result){
            $(".select-wards").html(result);
            $('.select2').each(function () {
                const id = $(this).attr("id");
                $("#"+id).select2();
            });
        }
    });
}

function hasClass(ele, cls) {
    return !!ele.className.match(new RegExp('(\\s|^)' + cls + '(\\s|$)'));
}
function addClass(ele, cls) {
    if (!hasClass(ele, cls)) ele.className += " " + cls;
}
function removeClass(ele, cls) {
    if (hasClass(ele, cls)) {
        var reg = new RegExp('(\\s|^)' + cls + '(\\s|$)');
        ele.className = ele.className.replace(reg, ' ');
    }
}

function toggle_loadding()
{
    if($('.loadding-page').exists()) {
        var ele = document.getElementsByClassName("loadding-page")[0];
        if (!hasClass(ele, "d-none")) {
            addClass(ele, "d-none");
            removeClass(ele, "d-flex");
        } else {
            removeClass(ele, "d-none");
            addClass(ele, "d-flex");
        }
    }
}

async function removeAct(type,title,message,extra,button,table,id, box) 
{
    MSalert.principal({
        // 'gear', 'error', 'warning', 'success'
        icon:type, 
        // dialog title
        title: title,
        // dialog content
        description: message,
        // footer content
        extra: extra,
        // enable confirm/cancel buttons
        button: button, 
    }).then(result => {
        if(result == true) {
            $.ajax({
                url: 'ajax/ajax_removeRows.php',
                type: "POST",
                async: true,
                data: { 
                    id: id,
                    table: table
                },
                success: function (result) {
                    $("#"+box).remove();
                    alertSuccess(LANG['tingting'], LANG['updatesuccess']);
                }
            });
        };
    });
};

function alertSuccess(title,message) 
{
    $.notify({
        title: '<strong>'+title+'</strong>',
        message: "</br>"+message,
        icon: 'far fa-thumbs-up',
    },{
        element: 'body',
        type: "success",
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 3300,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated fadeInDown',
            exit: 'animated fadeOutRight'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
    });
} 

function alertInfo(title, message)
{
    $.notify({
        title: '<strong>'+title+'</strong>',
        message: "<br>" + message,
        icon: 'fas fa-info-circle',
    },{
        element: 'body',
        position: null,
        type: "info",
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 3300,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated bounceInDown',
            exit: 'animated bounceOutUp'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
    });
}
function alertWarning(title, message)
{
    $.notify({
        title: '<strong>'+title+'</strong>',
        message: "<br>" + message,
        icon: 'fas fa-exclamation-triangle',
    },{
        // settings
        element: 'body',
        position: null,
        type: "warning",
        allow_dismiss: true,
        newest_on_top: true,
        showProgressbar: false,
        placement: {
            from: "top",
            align: "right"
        },
        offset: 20,
        spacing: 10,
        z_index: 1031,
        delay: 3300,
        timer: 1000,
        url_target: '_blank',
        mouse_over: null,
        animate: {
            enter: 'animated bounceIn',
            exit: 'animated bounceOut'
        },
        onShow: null,
        onShown: null,
        onClose: null,
        onClosed: null,
        icon_type: 'class',
    });
}

function alertDancer(title, message)
{
    $.notify({
        title: '<strong>'+title+'</strong>',
        message: "<br>" + message,
        icon: 'fas fa-times-circle',
    },{
        	// settings
            element: 'body',
            position: null,
            type: "danger",
            allow_dismiss: true,
            newest_on_top: true,
            showProgressbar: false,
            placement: {
                from: "top",
                align: "right"
            },
            offset: 20,
            spacing: 10,
            z_index: 1031,
            delay: 3300,
            timer: 1000,
            url_target: '_blank',
            mouse_over: null,
            animate: {
                enter: 'animated flipInY',
                exit: 'animated flipOutX'
            },
            onShow: null,
            onShown: null,
            onClose: null,
            onClosed: null,
            icon_type: 'class',
    });
}

function getCart()
{
    $.ajax({
        url: 'ajax/ajax_cart.php',
        type: "POST",
        dataType: 'html',
        async: true,
        data: { cmd: 'popup-cart' },
        success: function (result) {
            $(".content-cart").html(result);
        }
    });
}
function getOrder()
{
    $(".top-cart").addClass("loadding");
    $.ajax({
        url: 'ajax/ajax_cart.php',
        type: "POST",
        dataType: 'html',
        async: true,
        data: { cmd: 'order' },
        success: function (result) {
            $(".top-cart").html(result);  
            $(".top-cart").removeClass("loadding");
        }
    });
}
function updateQtyCart(code, quantity, code)
{
    $.ajax({
        url: 'ajax/ajax_cart.php',
        type: "POST",
        async: true,
        data: { 
            cmd: 'update-cart',
            code: code,
            quantity: quantity
        },
        success: function (result) {
           $(".price-procart."+code).html(result);
           if($(".form-cart").exists()) {
            $(".form-cart").removeClass("loadding");
        }
           getTotalCart();
        }
    });
}
function getTotalCart()
{
    $.ajax({
        url: 'ajax/ajax_cart.php',
        type: "POST",
        dataType: 'json',
        async: true,
        data: { cmd: 'total-cart' },
        success: function (result) {
           $('.total_cart').html(result.sum);
           const giamgia = $(".load-price-coupons").attr("data-coupons");
           $(".total_sum_cart").html((result.value - giamgia).toLocaleString('en-US'));
           $("#cart").removeClass("loaddding");
        }
    });
}
function checkCoupons(code)
{
    $.ajax({
        url: 'ajax/ajax_cart.php',
        type: "POST",
        dataType: 'json',
        async: true,
        data: { cmd: 'check-coupons', code: code },
        success: function (result) {
            console.log(result);
            if(result.status == false) {
                alertDancer("Lỗi", result.message);
            } else {
                $(".load-price-coupons").attr("data-coupons", result.giam);
                $(".load-price-coupons").html(result.giamformat);
                $(".total_sum_cart").html(result.tongformat);
                alertSuccess(LANG['tingting'], result.message);
            }
        }
    });
}

//The actual fuction
function toggleCart() {
    getCart();
    getTotalCart();
    var ele = document.getElementsByTagName('body')[0];
    if (!hasClass(ele, "open-cart")) {
        addClass(ele, "open-cart");
    } else {
        removeClass(ele, "open-cart");
    }
}

function toggleMenu() {
    var ele = document.getElementsByTagName('body')[0];
    if (!hasClass(ele, "open-menu")) {
        addClass(ele, "open-menu");
    } else {
        removeClass(ele, "open-menu");
    }
}

function setCookie(key, value, expiry) {
    var expires = new Date();
    expires.setTime(expires.getTime() + (expiry * 24 * 60 * 60 * 1000));
    document.cookie = key + '=' + value + ';expires=' + expires.toUTCString();
}

function getCookie(key) {
    var keyValue = document.cookie.match('(^|;) ?' + key + '=([^;]*)(;|$)');
    return keyValue ? keyValue[2] : null;
}

function eraseCookie(key) {
    var keyValue = getCookie(key);
    setCookie(key, keyValue, '-1');
}

function nguyennhieMCE() {
    tinymce.init({
        selector: 'textarea.nguyennhieucme',
        height: 200,
        menubar: false,
        plugins: [
            'advlist autolink lists link image charmap print preview anchor',
            'searchreplace visualblocks code fullscreen',
            'insertdatetime media table paste code help wordcount emoticons'
        ],
        toolbar:
        'bold italic backcolor forecolor | alignleft aligncenter ' +
        'alignright | ' +
        'removeformat | emoticons',
        content_css: CONFIG_BASE+'assets/css/skin.css?v=' + new Date().getTime(),
    });
}
function previewFiles(input, box) {
    if (input.files && input.files[0]) {
        const file = input.files[0];
        const objURL = window.URL.createObjectURL(file);
        $(box).attr("src", objURL);
    }
    MSalert.principal({
        // 'gear', 'error', 'warning', 'success'
        icon: "gear", 
        // dialog title
        title: "Are you sure ?",
        // dialog content
        description: "Bạn có muốn lưu cập nhật hiện tại không",
        // footer content
        extra: "Chọn yes để lưu thay đổi",
        // enable confirm/cancel buttons
        button: true, 
    }).then(result => {
        if(result == true) {
            $("#form-avatar").submit();
        };
    });
}

