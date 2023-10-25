/* Validation form */
ValidationFormSelf("validation-newsletter");
ValidationFormSelf("validation-cart");
ValidationFormSelf("validation-user");
ValidationFormSelf("validation-contact");
ValidationFormSelf("validation-form");

/* Exists */
$.fn.exists = function () {
    return this.length;
};

/* Alt images */
NGUYENNHIEU.AltImages = function () {
    $('img').each(function (index, element) {
        if (!$(this).attr('alt') || $(this).attr('alt') == '') {
            $(this).attr('alt', WEBSITE_NAME);
        };
    });
};

/* Fix menu */
NGUYENNHIEU.FixMenu = function () {
    $(window).scroll(function () {
        if ($(window).scrollTop() > ($("#header").height() + $("#banner").height()))
            $("#menu").addClass('fixing');
        else
            $("#menu").removeClass('fixing');
    });
};

/* Popup */
NGUYENNHIEU.Popup = function () {
    if ($("#popup").exists()) {
        $('#popup').modal('show');
    };
    $('.open-modals-auth').click(function() {
        const modal = $(this).attr("data-class");
        $(".form-auth").removeClass("active");
        $(".form-auth."+modal).addClass("active");
        $(".toggle-auth").modal("show");
    });
    $(".toogle-form-auth").click(function() {
        const action = $(this).attr("data-action");
        $(".form-auth").removeClass("active");
        $(".form-auth."+action).addClass("active");
    });
    if ($(".open-popup-user").exists()) {
        $(".open-popup-user").click(function() {
            const id = $(this).attr("data-id");
            const act = $(this).attr("data-act");
            $.ajax({
                url: 'ajax/ajax_user.php',
                type: "POST",
                async: true,
                data: { 
                    id: id,
                    act: act
                },
                success: function (result) {
                    $(".container-modals-user").html(result);
                    $('.select2').each(function () {
                        const id = $(this).attr("id");
                        $("#"+id).select2();
                    });
                    if($(".multiselect").exists()) {
                        $(".multiselect").SumoSelect();
                    };
                    nguyennhieMCE();
                    ValidationFormSelf("validation-user");
                }
            });
            $("#popup-user").modal('show');
        });
    };
    
};

/* Mmenu */
NGUYENNHIEU.Mmenu = function () {
    $(".background-mmenu").click(function () {
        toggleMenu();
    });
    $(".menu-toggle").click(function() {
        toggleMenu();
    });
    const navExpand = [].slice.call(document.querySelectorAll('.nav-expand'));
    const backLink = `<li class="nav-item">
        <p class="nav-link nav-back-link">
            ${LANG['back']}
        </p>
    </li>`;
    navExpand.forEach(item => {
        item.querySelector('.nav-expand-content').insertAdjacentHTML('afterbegin', backLink);
        item.querySelector('.nav-link').addEventListener('click', () => item.classList.add('active'));
        item.querySelector('.nav-back-link').addEventListener('click', () => item.classList.remove('active'));
    });
};

/* toogle cart */
NGUYENNHIEU.ToogleCart = function () {
    $(".background-cart").click(function () {
        toggleCart();
    });
    $(".cart-toggle").click(function() {
        toggleCart();
    });
};

/* Toc */
NGUYENNHIEU.Toc = function () {
    if ($(".mce-toc").exists()) {
        $('.mce-toc').find('a').click(function (e) {
            e.preventDefault();
            var x = $(this).attr('href');
            goToByScroll(x);
        });
    };
};

/* Tabs */
NGUYENNHIEU.Tabs = function () {
    if ($(".ul-tabs-content").exists()) {
        $(".ul-tabs-content li").click(function () {
            var tabs = $(this).data("tabs");
            $(".content-tabs-content, .ul-tabs-content li").removeClass("active");
            $(this).addClass("active");
            $("." + tabs).addClass("active");
        });
    };
};

/* Photobox */
NGUYENNHIEU.Photobox = function () {
    if ($(".album-gallery").exists()) {
        $('.album-gallery').photobox('a', { thumbs: true, loop: false });
    };
};

/* Datetime picker */
NGUYENNHIEU.DatetimePicker = function () {
    if ($('#ngaysinh').exists()) {
        $('#ngaysinh').datetimepicker({
            timepicker: false,
            format: 'd/m/Y',
            formatDate: 'd/m/Y',
            minDate: '01/01/1950',
            maxDate: TIMENOW
        });
    };
};

/* Search */
NGUYENNHIEU.Search = function () {
    if ($("#search-hidden").exists()) {
        $(".open-search").click(function() {
            if($("#search-hidden").hasClass("active")) {
                $("#search-hidden").removeClass("active");
            } else {
                $("#search-hidden").addClass("active");
            }
        });
    }
};

/* Videos */
NGUYENNHIEU.Videos = function () {
    $('[data-fancybox="something"]').fancybox({
        // transitionEffect: "fade",
        // transitionEffect: "slide",
        // transitionEffect: "circular",
        // transitionEffect: "tube",
        // transitionEffect: "zoom-in-out",
        // transitionEffect: "rotate",
        transitionEffect: "fade",
        transitionDuration: 800,
        animationEffect: "fade",
        animationDuration: 800,
        slideShow: {
            autoStart: true,
            speed: 3000
        },
        arrows: true,
        infobar: false,
        toolbar: false,
        hash: false
    });
    if ($(".video").exists()) {
        $('[data-fancybox="video"]').fancybox({
            transitionEffect: "fade",
            transitionDuration: 800,
            animationEffect: "fade",
            animationDuration: 800,
            arrows: true,
            infobar: false,
            toolbar: true,
            hash: false
        });
    };
};

/* Slick page */
NGUYENNHIEU.SlickPage = function () {
    $(window).on('load', function() {
        if ($(".multiple-items").exists()) {
            $('.multiple-items').slick({
                infinite:true, // Vòng lăp vô tận
                vertical: false,//Chay dọc
                slidesToShow: 1,    //Số item hiển thị
                slidesToScroll: 1, //Số item cuộn khi chạy
                autoplay: true,  //Tự động chạy
                autoplaySpeed: 3000,  //Tốc độ chạy
                speed: 500,//Tốc độ chuyển slider
                arrows: false, //Hiển thị mũi tên
                dots: false,  //Hiển thị dấu chấm
                cssEase: 'linear' ,  //animation
                fade: true, //Mờ dần khi chuyển slide
                focusOnSelect: false, //Khi click vào slide con bên dưới thì slide chính được show
                easing: 'linear', //( or swing,_default )
                pauseOnHover: true, //Tạm dừng auto slide đang chạy khi hover vào item show
                touchMove: true, // Bật tắt chế độ cảm ứng
                Swipe: true, //Cho phép vuốt slide
            });
        };
    });
};

/* Cart */
NGUYENNHIEU.Cart = function () {
    $(document).ready(function() {
        var wait = false;
        if($('.top-cart').exists()){
            getOrder();
        };
        if($(".mySwiper").exists()) {
            var swiper = new Swiper(".mySwiper.product-detail", {
                loop: true,
                grabCursor: false,
                mousewheel: false,
                keyboard: {
                    enabled: true,
                },
                spaceBetween: 10,
                slidesPerView: 4,
                freeMode: true,
                watchSlidesProgress: true,
            });
            var swiper2 = new Swiper(".mySwiper2.product-detail", {
                loop: true,
                spaceBetween: 0,
                keyboard: {
                    enabled: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                },
                thumbs: {
                    swiper: swiper,
                },
            });
        } else {
            var swiper2 = new Swiper(".mySwiper2.product-detail", {
                loop: true,
                spaceBetween: 10,
                keyboard: {
                    enabled: true,
                },
                navigation: {
                    nextEl: ".swiper-button-next",
                    prevEl: ".swiper-button-prev",
                }
            });
        };
        $('.checkbox_attribute').change(function() {
            var groupName = $(this).attr('name');
            if ($(this).prop('checked')) {
                $('input[type="checkbox"].checkbox_attribute[name="' + groupName + '"]').not(this).prop('checked', false);
            };
        });
        $('.picker').change(function() {
            var groupName = $(this).attr('name');
            if ($(this).prop('checked')) {
                $('input[type="checkbox"].picker[name="' + groupName + '"]').not(this).prop('checked', false);
            };
            const checkedOption = $('input.picker:checked');
            const id = $(this).attr("data-photo");
            let data = {
                cmd: 'update-detail',
                groupName: groupName,
                id: id,
                option: {}
            };
            checkedOption.each(function() {
                const value = $(this).val();
                const name_options = $(this).attr("data-options");
                data.option = { ...data.option , [name_options] : value};
            });
            if(Object.keys(data.option).length > 0) {
                $.ajax({
                    url: 'ajax/ajax_cart.php',
                    type: "POST",
                    async: true,
                    data: data,
                    success:function(result) {
                        const response = JSON.parse(result, true);
                        const slides = swiper2.slides;
                        for (let i = 0; i < slides.length; i++) {
                            if (slides[i].getAttribute('data-url') === response.photo) {
                                swiper2.slideTo(i);
                                break;
                            }
                        }
                        if(response.type == 2) {
                            $.each(response.active, (key, value) => { 
                                $("."+key).each(function() {
                                    if(value.includes($(this).val())) {
                                        $(this).prop("disabled", false);
                                    } else {
                                        $(this).prop("disabled", true);
                                    }
                                });
                            });
                            $(".add-cart-now").addClass("disable");
                        } else {
                            $.each(response.active, (key, value) => { 
                                $("."+key).each(function() {
                                    if(value.includes($(this).val())) {
                                        $(this).prop("disabled", false);
                                    } else {
                                        $(this).prop("disabled", true);
                                    }
                                });
                            });
                            $("#change-gia").text(response.gia);
                            $("#change-giamoi").text(response.giamoi);
                            $("#change-giakm").text(response.giakm + "% giảm");
                            $("#change-quantity").text(response.quantity);
                            $("#add-cart").attr("max",response.quantity);
                            $(".add-cart-now").removeClass("disable");
                        }
                    }
                });
            } else {
                $(".picker").each(function() {
                    $(this).prop("disabled", false); 
                });
                $("#change-gia").text($("#change-gia").attr("data-default"));
                $("#change-giamoi").text($("#change-giamoi").attr("data-default"));
                $("#change-giakm").text($("#change-giakm").attr("data-default"));
                $("#change-quantity").text($("#change-quantity").attr("data-default"));
                $(".add-cart-now").addClass("disable");
            };
        });
        $("body").on("change", ".p-cart", function() {
            if($(this).val() < 1) {
                $(this).val(1);
            };
            if(Number($(this).val()) > Number($(this).attr("max"))) {
                $(this).val($(this).attr("max"));
                alertDancer(LANG['productsolderror'], LANG['noquantitypctd']);
            };
        });
        $("body").on("change", ".quantity-change-event", function() { 
            const code = $(this).attr("data-code");
            const qty = $(this).val();
            $("#cart").addClass("loaddding");
            if($(".form-cart").exists()) {
                $(".form-cart").addClass("loadding");
            };
            if (wait) {
                clearTimeout(wait);
                wait = setTimeout(() => {
                    updateQtyCart(code, qty, code);
                    wait = false;
                }, 1000);
            } else {
                wait = setTimeout(() => {
                    updateQtyCart(code, qty, code);
                    wait = false;
                }, 1000);
            };
        });
        $("body").on("click", ".minus-input", function(e) {
            e.preventDefault();
            const element = $(this).attr("data-for");
            $("."+element).val(Number($('.'+element).val()) - 1);
            $("." + element).trigger('change'); 
        });
        $("body").on("click", ".plus-input", function(e) {
            e.preventDefault();
            const element = $(this).attr("data-for");
            $("."+element).val(Number($('.'+element).val()) + 1);
            $("." + element).trigger('change');
        });
    });
    $("body").on("click", ".delete-item-cart_", function() {
        const code = $(this).attr("data-code");
        MSalert.principal({
            // 'gear', 'error', 'warning', 'success'
            icon: 'warning', 
            // dialog title
            title: LANG['warning'],
            // dialog content
            description: LANG['areyouwanttodelete'],
            // footer content
            extra: LANG['yesiscontinue'],
            // enable confirm/cancel buttons
            button: true, 
        }).then(result => {
            if(result == true) {
                $.ajax({
                    url: 'ajax/ajax_cart.php',
                    type: "POST",
                    async: true,
                    data: {
                        code: code,
                        cmd: 'delete-cart'
                    },
                    success: function (result) {
                        getCart();
                        getTotalCart();
                        if($(".top-cart").exists()) {
                            getOrder();
                        };
                    }
                });
            };
        });
       
    });
    $("body").on("click", ".add-cart-now", function () {
        var id = $(this).data("id");
        var action = $(this).data("action");
        if($("input.picker").exists() || $("input.checkbox_attribute").exists()) {
            if($(this).hasClass("disable")) {
                alertWarning(LANG['warning'],LANG['checkallattributes']);
                return;
            };
        }
        if($("input.checkbox_attribute").exists()) {
            if($(this).hasClass("warning")) {
                if(!$("input.checkbox_attribute:checked").exists()) {
                    alertWarning(LANG['warning'],LANG['checkallattributes']);
                    return;
                };
            };
        };
        var quantity = ($(".add-cart").val()) ? $(".add-cart").val() : 1;
        let data = {
            cmd: 'add-cart',
            id: id,
            quantity: quantity,
            option: {}
        };
        const checkedOption1 = $('input.picker:checked');
        checkedOption1.each(function() {
            const value = $(this).val();
            const name_options = $(this).attr("data-options");
            data.option = { ...data.option , [name_options] : value};
        });
        const checkedOption2 = $('input.checkbox_attribute:checked');
        checkedOption2.each(function() {
            const value = $(this).val();
            const name_options = $(this).attr("data-options");
            data.option = { ...data.option , [name_options] : value};
        });

        if (id) {
            $.ajax({
                url: 'ajax/ajax_cart.php',
                type: "POST",
                dataType: 'html',
                async: true,
                data: data,
                success: function (result) {
                    if (action == 'add') {
                        toggleCart();
                    }
                    else if (action == 'payment') {
                        window.location = CONFIG_BASE + "gio-hang";
                    }
                }
            });
        }
    }); 
    
    $(".open-address").click(function() {
        $(".choose-address").toggle();
    });
    $("#tangqua").change(function() {
        $(".tangquabox").toggle();
        if($(this).prop('checked')) {
            $("#tennguoinhan").attr("required", true);
            $("#tennguoigui").attr("required", true);
            $("#thongdiep").attr("required", true);
        } else {
            $("#tennguoinhan").attr("required", false);
            $("#tennguoigui").attr("required", false);
            $("#thongdiep").attr("required", false);
        };
    });

    $("body").on("change", ".select-city-cart", function () {
        var id = $(this).val();
        load_district(id);
    });

    $("body").on("change", ".select-district-cart", function () {
        var id = $(this).val();
        load_wards(id);
    });

    if ($(".change-address-no").exists()) {
        $(".change-address-no").click(function() {
            const id = $(this).attr("data-id");
            $('.address-load').addClass("loadding");
            $.ajax({
                type: 'post',
                url: 'ajax/ajax_address_private.php',
                async: true,
                data: {id:id},
                success: function(result){
                    $(".address-load").html(result);
                    $('.select2').select2();
                    $('.address-load').removeClass("loadding");
                    $(".open-address").click();
                }
            });
        });
    };

    if ($(".payments-label").exists()) {
        $(".payments-label").click(function () {
            var payments = $(this).data("payments");
            $(".payments-cart .payments-label, .payments-info").removeClass("active");
            $(this).addClass("active");
            $(".payments-info-" + payments).addClass("active");
        });
    };

    $("body").on("click", "#apply-code", function (e) {
        e.preventDefault();
        const code = $('.code_coupons').val();
        if(code) {
            checkCoupons(code);
        } else {
            alertWarning(LANG['warning'], LANG['couponsisrequired']);
        };
    });

    $("#form-order").on('submit', function(e) {
        const form = document.getElementById("form-order");
        if(form.checkValidity()) {
            toggle_loadding();
            return;
        } else {
            return;
        }
    });
};


/*Ajax bản đồ*/
NGUYENNHIEU.AjaxBando = function () {
    if ($(".click-map.active").exists()) {
        $(".click-map.active").each(function () {
            var id = $(this).data("id");
            loadPagingAjax("ajax/ajax_bando.php?id=" + id, '.load-map');
        });
        $('.click-map').click(function () {
            $(this).parents('.title-map').find('.click-map').removeClass('active');
            $(this).addClass('active');
            var id = $(this).data("id");
            loadPagingAjax("ajax/ajax_bando.php?id=" + id, '.load-map');
        });
    };
};

/*Hiệu ứng Logo*/
NGUYENNHIEU.LogoLoad = function () {
    $(document).ready(function () {
        if($(".sss").exists()) {
            const api = $(".sss").peShiner({ api: true, paused: true, reverse: true, repeat: 1, color: 'monoHL' }); //mã màu đặc biệt: monoHL, oceanHL, fireHL
            api.resume();
        };
        if($(".sss1").exists()) {
            const api1 = $(".sss1").peShiner({ api: true, paused: true, reverse: true, repeat: 1, color: 'monoHL' }); //mã màu đặc biệt: monoHL, oceanHL, fireHL
            api1.resume();
        };
        if($(".sss2").exists()) {
            const api2 = $(".sss2").peShiner({ api: true, paused: true, reverse: true, repeat: 1, color: 'monoHL' }); //mã màu đặc biệt: monoHL, oceanHL, fireHL
            api2.resume();
        };
    });
};

NGUYENNHIEU.photoSwiper = function () {
    $(document).ready(function () {
        if($("#lightgallery").exists()) {
            $("#lightgallery").lightGallery({
                selector: 'a',
            });
        };
        if($(".lightgallery").exists()) {
            $(".lightgallery").lightGallery({
                selector: 'a',
            });
        };
    });
};

NGUYENNHIEU.swiper = function () {
    $(document).ready(function () {
        if($(".swiper-slideshow").exists()) {
            const slideshow = new Swiper(".swiper-slideshow", {
                loop: true,
                mousewheel: false,
                grabCursor: false,
                spaceBetween: 0,
                slidesPerView: 1,
                effect: "fade",
                // effect: "cube",
                autoplay: {
                    delay: 10000,
                    disableOnInteraction: false,
                },
                navigation: {
                    hide: true,
                    nextEl: ".swiper-slideshow-button-next",
                    prevEl: ".swiper-slideshow-button-prev",
                },
                breakpoints: {
                    // 320: {
                    //   slidesPerView: 2,
                    //   spaceBetween: 20
                    // },
                    // 550: {
                    //   slidesPerView: 2,
                    //   spaceBetween: 30
                    // },
                    // 640: {
                    //   slidesPerView: 3,
                    //   spaceBetween: 30
                    // },
                    // 900: {
                    //     slidesPerView: 4,
                    //     spaceBetween: 30
                    //   },
                    // 1100: {
                    //     slidesPerView: 5,
                    //   spaceBetween: 30
                    // }
                }
            });
        };
    });
};

NGUYENNHIEU.scrollelement = function() {
    $(document).ready(function() {
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry) => {
                if(entry.isIntersecting) {
                    entry.target.classList.add('nguyennhieu-show');
                } else {
                    entry.target.classList.remove('nguyennhieu-show');
                };
            });
        });
        const hiddenElements = document.querySelectorAll(".nguyennhieu-hidden");
        hiddenElements.forEach((el) => observer.observe(el));
    });
};

NGUYENNHIEU.loaddingSite = function() {
    $(window).load(function() {
        toggle_loadding();
    });
};

NGUYENNHIEU.Select = function() {
    if($(".multiselect").exists()) {
        $('.multiselect').each(function () {
            var placeholderClass = $(this).data('class');
            $(this).SumoSelect({
                selectAll: true,
                search: true,
                searchText: LANG['placeseach'],
                csvDispCount: 2,
                captionFormat: '{0} ' + LANG['select'],
                floatWidth: 500,
                outputAsCSV: true,
                placeholder: placeholderClass,
            });
        });
    };
   
    if($(".select2").exists()) {
        $('.select2').each(function () {
            const id = $(this).attr("id");
            $("#"+id).select2();
        });
    };
    if($(".select2-nos").exists()) {
        $('.select2-nos').each(function () {
            const id = $(this).attr("id");
            $("#"+id).select2({
                minimumResultsForSearch: Infinity,
            });
        });
    };
};

NGUYENNHIEU.User = function() {
    $("body").on("change", "#video-timeline", function() {
        var $source = $('#myVideo');
        $source[0].src = URL.createObjectURL(this.files[0]);
        $('#myVideo').removeClass("hidden");
    });
    $(".item-table").click(function() {
        $(".item-table").removeClass("active");
        $(this).addClass("active");
    });
    $(".radio-macdinh").change(function() {
        const table = $(this).attr("data-table");
        const id = $(this).val();
        $.ajax({
            url: 'ajax/ajax_macdinh.php',
            type: "POST",
            async: true,
            data: { 
                id: id,
                table: table
            },
            success: function (result) {
              alertSuccess(LANG['tingting'], LANG['updatesuccess']);
            }
        });
    });
    $(".remove-act").click(function() {
        const table = $(this).attr("data-table");
        const id = $(this).attr("data-id");
        const id_box = $(this).attr("data-box");
        removeAct("warning", LANG['warning'], LANG['areyousure'], LANG['norestore'], true, table, id, id_box);
    });
    $("#id_bank_naptc").change(function() {
        let money = $("#moneytc").val();
        money = money.replace(",", "");
        const min = $("#moneytc").attr("min");
        if(money < min) {
            return;
        }
        const id = $(this).val();
        if(money) {
            $.ajax({
                url: 'ajax/ajax_getbank.php',
                type: "POST",
                async: true,
                data: { 
                    id: id,
                    money: money
                },
                success: function (result) {
                    $('.container-info-bank').html(result);
                }
            });
        };
    });
    $("#moneytc").change(function() {
        let money = $(this).val();
        money = money.replace(",", "");
        const min = $(this).attr("min");
        if(Number(money) < Number(min)) {
            $(this).val(min);
        }
        const id = $("#id_bank_naptc").val();
        if(id) {
            $.ajax({
                url: 'ajax/ajax_getbank.php',
                type: "POST",
                async: true,
                data: { 
                    id: id,
                    money: money
                },
                success: function (result) {
                    $('.container-info-bank').html(result);
                }
            });
        };
    });
    if($(".input-money").exists()) {
        $(".input-money").change(function() {
            const min = $(this).attr("min");
            let value = $(this).val();
            value = value.replace(",", "");
            if(Number(min) > Number(value)) {
                $(this).val(min);
            }
        });
    };
    $(".format-price").priceFormat({
        limit: 13,
        prefix: '',
        centsLimit: 0
    });
    if($(".content-overload").exists()) {
        $(".content-overload").each(function() {
            const id = $(this).attr("data-id");
            if ($(this).height() > 125) {
                $(this).addClass("text-split text-split-5");
                $(".readmore-"+id).removeClass("hidden");
            }
        });
        $(".view-all-post").click(function() {
            const id = $(this).attr("data-id");
            $(this).addClass("hidden");
            $(".content-"+id).removeClass("text-split text-split-5");
        });
    };
    $("body").on("change", "#upload_file" ,function() {
        const hash = $(this).attr("data-hash");
        const id = $(this).attr("data-id");
        let formData = new FormData();
        let fileInputs = $('#upload_file')[0].files;
        formData.append("hash", hash);
        formData.append("id", id);
        if (fileInputs.length > 0) {
            for (var i = 0; i < fileInputs.length; i++) {
              formData.append('images[]', fileInputs[i]);
            }
            $.ajax({
                type: 'POST',
                url: 'ajax/ajax_upload.php',
                data: formData,
                contentType: false,
                processData: false,
                success: function (response) {
                    $(".container-upload-file").html(response);
                },
            });
        }
    });
    $("body").on("click", ".edit-photo-timeline", function() {
        const id = $(this).attr("data-id");
        const hash = $(this).attr("data-hash");
        $.ajax({
            type: 'POST',
            url: 'ajax/ajax_user.php',
            data: {
                id: id,
                hash: hash,
                act: "popup-photo",
            },
            async: true,
            success: function (response) {
                $("#modlas-photo").html(response);
                $("#popup-user").modal('hide');
                $('#popup-photo').modal('show');
            },
        });
    });
    $("body").on("change", ".change-noidungphoto", function() {
        const id = $(this).attr("data-id");
        const value = $(this).val();
        const act = $(this).attr("data-act");
        $.ajax({
            type: 'POST',
            url: 'ajax/ajax_user.php',
            data: {
                id: id,
                value: value,
                act: act,
            },
            async: true,
            success: function (response) {
                let result = JSON.parse(response);
            },
        });
    });
    $('#popup-photo').on('hidden.bs.modal', function () {
        const id = $("#modals-photo-active").attr("data-id");
        const hash = $("#modals-photo-active").attr("data-hash");
        $.ajax({
            url: 'ajax/ajax_user.php',
            type: "POST",
            async: true,
            data: { 
                id: id,
                act: "member_timeline"
            },
            success: function (result) {
                $(".container-modals-user").html(result);
                $('.select2').each(function () {
                    const id = $(this).attr("id");
                    $("#"+id).select2();
                });
                if($(".multiselect").exists()) {
                    $(".multiselect").SumoSelect();
                };
                nguyennhieMCE();
                ValidationFormSelf("validation-user");
            }
        });
        $("#popup-user").modal('show');
    });
    $("body").on("click", ".remove-photo", function() {
        const id = $(this).attr("data-id");
        const box = $(this).attr("data-box");
        MSalert.principal({
            icon: "warning", 
            title: LANG['warning'],
            description: LANG['areyousure'],
            extra: LANG['yesiscontinue'],
            button: true, 
        }).then(result => {
            if(result == true) {
                $.ajax({
                    url: 'ajax/ajax_user.php',
                    type: "POST",
                    async: true,
                    data: { 
                        id: id,
                        act: "delete-photo"
                    },
                    success: function (result) {
                        $("#"+box).remove();
                        alertSuccess(LANG['tingting'], LANG['updatesuccess']);
                    }
                });
            };
        });
    });
    $(".change-noibat-photo").change(function() {
        const id = $(this).attr("data-id");
        let value = 0;
        if ($(this).prop("checked")) {
            value = 1;
        }
        $.ajax({
            url: 'ajax/ajax_user.php',
            type: "POST",
            async: true,
            data: { 
                id: id,
                noibat: value,
                act: "update_noibat"
            },
            success: function (result) {
                alertSuccess(LANG['tingting'], LANG['updatesuccess']);
            }
        });
    });

    $(".delete-timeline").click(function() {
        const id = $(this).attr("data-id");
        $.ajax({
            url: 'ajax/ajax_user.php',
            type: "POST",
            async: true,
            data: { 
                id: id,
                act: "delete-timeline"
            },
            success: function (result) {
                $("#timeline-"+id).remove();
                alertSuccess(LANG['tingting'], LANG['updatesuccess']);
            }
        });
    }); 
};

NGUYENNHIEU.OwlPage = function () {
    if ($(".owl-doitac").exists()) {
        $('.owl-doitac').owlCarousel({
            items: 7,
            rewind: true,
            autoplay: true,
            loop: true,
            lazyLoad: false,
            mouseDrag: true,
            touchDrag: true,
            margin: 10,
            smartSpeed: 250,
            autoplaySpeed: 1000,
            nav: false,
            dots: false,
            responsiveClass: true,
            responsiveRefreshRate: 200,
            responsive: {
                0: {
                    items: 2,
                    margin: 10
                },
                400: {
                    items: 3,
                    margin: 10
                },
                600: {
                    items: 4,
                    margin: 10
                },
                768: {
                    items: 5,
                    margin: 10
                },
                992: {
                    items: 6,
                    margin: 10
                },
                1200: {
                    items: 7,
                    margin: 10
                }
            }
        });
        $('.prev-doitac').click(function () {
            $('.owl-doitac').trigger('prev.owl.carousel');
        });
        $('.next-doitac').click(function () {
            $('.owl-doitac').trigger('next.owl.carousel');
        });
    }
};

NGUYENNHIEU.customjs = function() {
    $(".viewcity-filter").click(function() {
        if($(".filter-city").hasClass("active")) {
            $(".filter-city").removeClass("active");
            $(this).html(LANG['viewmore']);
        } else {
            $(".filter-city").addClass("active");
            $(this).html(LANG['rutgon']);
        };
    });
    $(".viewbrand-filter").click(function() {
        if($(".filter-brand").hasClass("active")) {
            $(".filter-brand").removeClass("active");
            $(this).html(LANG['viewmore']);
        } else {
            $(".filter-brand").addClass("active");
            $(this).html(LANG['rutgon']);
        };
    });
    $(".view-grida").click(function() {
        const layout = $(this).attr("data-view");
        $(".container__tin-tuc").removeClass("grid1 grid2 grid3");
        $(".container__tin-tuc").addClass(layout);
        $(".view-grida").removeClass("active");
        $(this).addClass("active");
        setCookie("view-news", layout, 30);
    });
};

$(".content-tabs-content table").wrap("<div class='responsive-item'></div>");

/* Ready */
$(document).ready(function () {
    NGUYENNHIEU.AltImages();
    NGUYENNHIEU.FixMenu();
    NGUYENNHIEU.Mmenu();
    NGUYENNHIEU.SlickPage();
    NGUYENNHIEU.Toc();
    NGUYENNHIEU.Cart();
    NGUYENNHIEU.User();
    NGUYENNHIEU.Tabs();
    NGUYENNHIEU.Select();
    NGUYENNHIEU.Videos();
    NGUYENNHIEU.Photobox();
    NGUYENNHIEU.Search();
    NGUYENNHIEU.DatetimePicker();
    NGUYENNHIEU.LogoLoad();
    NGUYENNHIEU.ToogleCart();
    NGUYENNHIEU.swiper();
    NGUYENNHIEU.photoSwiper();
    NGUYENNHIEU.OwlPage();
    // NGUYENNHIEU.scrollelement();
    NGUYENNHIEU.loaddingSite();
    NGUYENNHIEU.customjs();
    NGUYENNHIEU.Popup();
});

function zoom(e) {
    var zoom = e.currentTarget;
    e.offsetX ? offsetX = e.offsetX : offsetX = e.touches[0].pageX;
    e.offsetY ? offsetY = e.offsetY : offsetX = e.touches[0].pageX;
    x = (offsetX / zoom.offsetWidth) * 100;
    y = (offsetY / zoom.offsetHeight) * 100;
    zoom.style.backgroundPosition = x + "% " + y + "%";
};

$(document).ready(function () {
    nguyennhieMCE();
    document.querySelectorAll('pre[class*="language"] code').forEach((el) => {
        hljs.highlightElement(el);
    });
    setTimeout(function () {
        window.highlightJsBadge();
    }, 100);

    "use strict";
    var progressPath = document.querySelector('.progress-wrap path');
    var pathLength = progressPath.getTotalLength();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'none';
    progressPath.style.strokeDasharray = pathLength + ' ' + pathLength;
    progressPath.style.strokeDashoffset = pathLength;
    progressPath.getBoundingClientRect();
    progressPath.style.transition = progressPath.style.WebkitTransition = 'stroke-dashoffset 10ms linear';
    var updateProgress = function () {
        var scroll = $(window).scrollTop();
        var height = $(document).height() - $(window).height();
        var progress = pathLength - (scroll * pathLength / height);
        progressPath.style.strokeDashoffset = progress;
    };
    updateProgress();
    $(window).scroll(updateProgress);
    var offset = 150;
    var duration = 550;
    $(window).on('scroll', function () {
        if ($(this).scrollTop() > offset) {
            $('.progress-wrap').addClass('active-progress');
        } else {
            $('.progress-wrap').removeClass('active-progress');
        }
    });
    $('.progress-wrap').on('click', function (event) {
        event.preventDefault();
        $('html, body').animate({
            scrollTop: 0
        }, duration);
        return false;
    });
});

$(document).ready(function() {
    let items = document.querySelectorAll('.img-photo-user');
    let draggedItem = null;
    items.forEach(item => {
        item.addEventListener('dragstart', () => {
            draggedItem = item;
        });
        item.addEventListener('dragover', (e) => {
            e.preventDefault();
        });
        item.addEventListener('drop', () => {
            if (draggedItem !== null) {
                // Lấy vị trí hiện tại của phần tử được kéo và thả
                const currentIndex = Array.from(items).indexOf(item);
                // Lấy vị trí ban đầu của phần tử
                const initialIndex = Array.from(items).indexOf(draggedItem);
                // Swap positions of dragged item and dropped item
                items[currentIndex].parentNode.insertBefore(draggedItem, items[currentIndex]);
                items = document.querySelectorAll('.img-photo-user');
                draggedItem = null;
            }
        });
    });
    if($("#title-typed").exists()) {
        var typed = new Typed('#title-typed', {
            stringsElement: '#typed-strings',
            typeSpeed: 40,
            backSpeed: 40,
            backDelay: 1000,
            startDelay: 1000,
            loop: true,
            smartBackspace: true,
            showCursor: true,
            cursorChar: '|',
            autoInsertCss: true,
        });
    }
});