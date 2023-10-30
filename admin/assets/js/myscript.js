/* Validation form */
function ValidationFormSelf(ele) {
    window.addEventListener('load', function() {
        var forms = document.getElementsByClassName(ele);
        var validation = Array.prototype.filter.call(forms, function(form) {
            form.addEventListener('submit', function(event) {
                
                if (form.checkValidity() === false) {
                    event.preventDefault();
                    event.stopPropagation();
                };
                form.classList.add('was-validated');
            }, false);
        });
        $("." + ele).find("input[type=submit],button[type=submit]").removeAttr("disabled");
    }, false);
};
/* Validation form chung */
ValidationFormSelf("validation-form");
/* onChange Category */
function filter_category(url) {
    if ($(".filer-category").length > 0 && url != '') {
        var id = '';
        var value = 0;
       
        $(".filer-category").each(function() {
            id = $(this).attr("id");
            if (id) {
                value = parseInt($("#" + id).val());
                if (value) {
                    url += "&" + id + "=" + value;
                };
            };
        });
    };
    return url;
};


function onchange_category(obj, url) {
    var name = '';
    var keyword = $("#keyword").val();
    obj.parents(".form-group").nextAll().each(function() {
        name = $(this).find(".filer-category").attr("name");
        if ($(this) != obj) {
            $(this).find(".filer-category").val(0);
        }
    });
    url = filter_category(url);
    if (keyword) {
        url += "&keyword=" + encodeURI(keyword);
    }
    return window.location = url;
};
/* Search */
function doEnter(evt, obj, url) {
    if (url == '') {
        notifyDialog("Đường dẫn không hợp lệ");
        return false;
    };
    if (evt.keyCode == 13 || evt.which == 13) onSearch(obj, url);
};

function onSearch(obj, url) {
    if (url == '') {
        notifyDialog("Đường dẫn không hợp lệ");
        return false;
    } else {
        var keyword = $("#" + obj).val();
        url = filter_category(url);
        if (keyword) {
            url += "&keyword=" + encodeURI(keyword);
        };
        window.location = filter_category(url);
    };
};
/* Action order (Search - Export excel - Export word) */
function actionOrder(url) {
    var listid = "";
    var tinhtrang = parseInt($("#tinhtrang").val());
    var httt = parseInt($("#httt").val());
    var ngaydat = $("#ngaydat").val();
    var khoanggia = $("#khoanggia").val();
    var city = parseInt($("#id_city").val());
    var district = parseInt($("#id_district").val());
    var wards = parseInt($("#id_wards").val());
    var keyword = $("#keyword").val();
    $("input.select-checkbox").each(function() {
        if (this.checked) listid = listid + "," + this.value;
    });
    listid = listid.substr(1);
    if (listid) url += "&listid=" + listid;
    if (tinhtrang) url += "&tinhtrang=" + tinhtrang;
    if (httt) url += "&httt=" + httt;
    if (ngaydat) url += "&ngaydat=" + ngaydat;
    if (khoanggia) url += "&khoanggia=" + khoanggia;
    if (city) url += "&id_city=" + city;
    if (district) url += "&id_district=" + district;
    if (wards) url += "&id_wards=" + wards;
    if (keyword) url += "&keyword=" + encodeURI(keyword);
    window.location = url;
};
/* Send email */
function sendEmail() {
    var listemail = "";
    $("input.select-checkbox").each(function() {
        if (this.checked) listemail = listemail + "," + this.value;
    });
    listemail = listemail.substr(1);
    if (listemail == "") {
        notifyDialog("Bạn hãy chọn ít nhất 1 mục để gửi");
        return false;
    };
    $("#listemail").val(listemail);
    document.frmsendemail.submit();
};
/* change tab */
function getparam(params) {
    const currentUrl = window.location.href;
    const indexOfQuestionMark = currentUrl.indexOf("?");
    if (indexOfQuestionMark !== -1) {
        const queryString = currentUrl.substring(indexOfQuestionMark + 1);
        const queryParams = {};
        queryString.split("&").forEach(function(pair) {
            const parts = pair.split("=");
            queryParams[parts[0]] = parts[1];
        });
        const paramsvalue = queryParams[params];
        return paramsvalue;
    };
};
function changeTab(tab, param) {
    const currentUrl = window.location.href;
    const active = getparam(param);
    if (currentUrl.includes(param+"="+tab)) {
        return;
    } else {
        const updatedUrl = currentUrl.replace("&"+param+"="+active, "");
        window.history.replaceState({}, document.title, updatedUrl+"&active="+tab);
    };
};
/* Delete item */
function deleteItem(url) {
    document.location = url;
};
/* Delete all */
function deleteAll(url) {
    var listid = "";
    $("input.select-checkbox").each(function() {
        if (this.checked) listid = listid + "," + this.value;
    });
    listid = listid.substr(1);
    if (listid == "") {
        notifyDialog("Bạn hãy chọn ít nhất 1 mục để xóa");
        return false;
    };
    document.location = url + "&listid=" + listid;
};

/* Push OneSignal */
function pushOneSignal(url) {
    document.location = url;
};
/* HoldOn */
function holdonOpen(theme = "sk-rect", text = "Text here", backgroundColor = "rgba(0,0,0,0.8)", textColor = "white") {
    var options = {
        theme: theme,
        message: text,
        backgroundColor: backgroundColor,
        textColor: textColor
    };
    HoldOn.open(options);
};

function holdonClose() {
    HoldOn.close();
};
/* Sweet Alert - Notify */
function notifyDialog(text) {
    const swalconst = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-sm bg-gradient-primary text-sm',
        },
        buttonsStyling: false
    });
    swalconst.fire({
        text: text,
        icon: "info",
        confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
        showClass: {
            popup: 'animated fadeIn faster'
        },
        hideClass: {
            popup: 'animated fadeOut faster'
        }
    });
};
/* Sweet Alert - Confirm */
function confirmDialog(action, text, value) {
    const swalconst = Swal.mixin({
        customClass: {
            confirmButton: 'btn btn-sm bg-gradient-primary text-sm mr-2',
            cancelButton: 'btn btn-sm bg-gradient-danger text-sm'
        },
        buttonsStyling: false
    });
    swalconst.fire({
        text: text,
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: '<i class="fas fa-check mr-2"></i>Đồng ý',
        cancelButtonText: '<i class="fas fa-times mr-2"></i>Hủy',
        showClass: {
            popup: 'animated zoomIn faster'
        },
        hideClass: {
            popup: 'animated fadeOut faster'
        }
    }).then((result) => {
        if (result.value) {
            if (action == "create-seo") seoCreate();
            if (action == "push-onesignal") pushOneSignal(value);
            if (action == "send-email") sendEmail();
            if (action == "delete-filer") deleteFiler(value);
            if (action == "delete-all-filer") deleteAllFiler(value);
            if (action == "delete-item") deleteItem(value);
            if (action == "delete-all") deleteAll(value);
        };
    });
};
/* Youtube preview */
function youtubePreview(url, element) {
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    url = (match && match[7].length == 11) ? match[7] : false;
    $(element).attr("src", "//www.youtube.com/embed/" + url).css({
        // "width": "100%",
        // "height": "250"
    });
};
/* SEO */
function seoExist() {
    var inputs = $('.card-seo input.check-seo');
    var textareas = $('.card-seo textarea.check-seo');
    var flag = false;
    if (!flag) {
        inputs.each(function(index) {
            var input = $(this).attr('id');
            value = $("#" + input).val();
            if (value) {
                flag = true;
                return false;
            };
        });
    };
    if (!flag) {
        textareas.each(function(index) {
            var textarea = $(this).attr('id');
            value = $("#" + textarea).val();
            if (value) {
                flag = true;
                return false;
            };
        });
    };
    return flag;
};

function seoCreate() {
    var flag = true;
    var seolang = $("#seo-create").val();
    var seolangArray = seolang.split(",");
    var seolangCount = seolangArray.length;
    var inputArticle = $('.card-article input.for-seo');
    var textareaArticle = $('.card-article textarea.for-seo');
    var textareaArticleCount = textareaArticle.length;
    var count = 0;
    var inputSeo = $('.card-seo input.check-seo');
    var textareaSeo = $('.card-seo textarea.check-seo');
    /* SEO Create - Input */
    inputArticle.each(function(index) {
        var input = $(this).attr('id');
        var lang = input.substr(input.length - 2);
        if (seolang.indexOf(lang) >= 0) {
            ten = $("#" + input).val();
            ten = ten.substr(0, 70);
            ten = ten.trim();
            $("#title" + lang + ", #keywords" + lang).val(ten);
            seoCount($("#title" + lang));
            seoCount($("#keywords" + lang));
        };
    });
    /* SEO Create - Textarea */
    textareaArticle.each(function(index) {
        var textarea = $(this).attr('id');
        var lang = textarea.substr(textarea.length - 2);
        if (seolang.indexOf(lang) >= 0) {
            if (flag) {
                var content = $("#" + textarea).val();
                if (!content && CKEDITOR.instances[textarea]) {
                    content = CKEDITOR.instances[textarea].getData();
                };
                if (content) {
                    content = content.replace(/(<([^>]+)>)/ig, "");
                    content = content.substr(0, 160);
                    content = content.trim();
                    content = content.replace(/[\r\n]+/gm, " ");
                    $("#description" + lang).val(content);
                    seoCount($("#description" + lang));
                    flag = false;
                } else {
                    flag = true;
                };
            };
            count++;
            if (count == (textareaArticleCount / seolangCount)) {
                flag = true;
                count = 0;
            };
        };
    });
    /* SEO Preview */
    for (var i = 0; i < seolangArray.length; i++)
        if (seolangArray[i]) seoPreview(seolangArray[i]);
};

function seoPreview(lang) {
    var titlePreview = "#title-seo-preview" + lang;
    var descriptionPreview = "#description-seo-preview" + lang;
    var title = $("#title" + lang).val();
    var description = $("#description" + lang).val();
    if ($(titlePreview).length) {
        if (title) $(titlePreview).html(title);
        else $(titlePreview).html("Title");
    };
    if ($(descriptionPreview).length) {
        if (description) $(descriptionPreview).html(description);
        else $(descriptionPreview).html("Description");
    };
};

function seoCount(obj) {
    if (obj.length) {
        var countseo = parseInt(obj.val().toString().length);
        countseo = (countseo) ? countseo++ : 0;
        obj.parents("div.form-group").children("div.label-seo").find(".count-seo span").html(countseo);
    };
};

function seoChange() {
    var seolang = "vi,en";
    var elementSeo = $('.card-seo .check-seo');
    elementSeo.each(function(index) {
        var element = $(this).attr('id');
        var lang = element.substr(element.length - 2);
        if (seolang.indexOf(lang) >= 0) {
            if ($("#" + element).length) {
                $('body').on("keyup", "#" + element, function() {
                    seoPreview(lang);
                });
            };
        };
    });
};
/* Slug */
function slugConvert(slug, focus = false) {
    slug = slug.toLowerCase();
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
    slug = slug.replace(/đ/gi, 'd');
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.replace(/ /gi, "-");
    slug = slug.replace(/\-\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-\-/gi, '-');
    slug = slug.replace(/\-\-\-/gi, '-');
    slug = slug.replace(/\-\-/gi, '-');
    if (!focus) {
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
    };
    return slug;
};

function slugPreview(title, lang, focus = false) {
    var slug = slugConvert(title, focus);
    $("#slug" + lang).val(slug);
    $("#slugurlpreview" + lang + " strong").html(slug);
    $("#seourlpreview" + lang + " strong").html(slug);
};

function slugPreviewTitleSeo(title, lang) {
    if ($("#title" + lang).length) {
        var titleSeo = $("#title" + lang).val();
        if (!titleSeo) {
            if (title) $("#title-seo-preview" + lang).html(title);
            else $("#title-seo-preview" + lang).html("Title");
        };
    };
};

function slugPress() {
    var sluglang = "vi,en";
    var inputArticle = $('.card-article input.for-seo');
    var id = $('.slug-id').val();
    var seourlstatic = true;
    //var seourlstatic = $(".slug-seo-preview").data("seourlstatic");
    inputArticle.each(function(index) {
        var ten = $(this).attr('id');
        var lang = ten.substr(ten.length - 2);
        if (sluglang.indexOf(lang) >= 0) {
            if ($("#" + ten).length) {
                $('body').on("keyup", "#" + ten, function() {
                    var title = $("#" + ten).val();
                    if ((!id || $("#slugchange").prop("checked")) && seourlstatic) {
                        /* Slug preivew */
                        slugPreview(title, lang);
                    }
                    /* Slug preivew title seo */
                    slugPreviewTitleSeo(title, lang);
                    /* slug Alert */
                    slugAlert(2, lang);
                });
            };
            if ($("#slug" + lang).length) {
                $('body').on("keyup", "#slug" + lang, function() {
                    var title = $("#slug" + lang).val();
                    /* Slug preivew */
                    slugPreview(title, lang, true);
                    /* slug Alert */
                    slugAlert(2, lang);
                });
            };
        };
    });
};

function slugChange(obj) {
    if (obj.is(':checked')) {
        /* Load slug theo tiêu đề mới */
        slugStatus(1);
        $(".slug-input").attr("readonly", true);
    } else {
        /* Load slug theo tiêu đề cũ */
        slugStatus(0);
        $(".slug-input").attr("readonly", false);
    };
};

function slugStatus(status) {
    var sluglang = "vi,en";
    var inputArticle = $('.card-article input.for-seo');
    inputArticle.each(function(index) {
        var ten = $(this).attr('id');
        var lang = ten.substr(ten.length - 2);
        if (sluglang.indexOf(lang) >= 0) {
            var title = "";
            if (status == 1) {
                if ($("#" + ten).length) {
                    title = $("#" + ten).val();
                    /* Slug preivew */
                    slugPreview(title, lang);
                    /* Slug preivew title seo */
                    slugPreviewTitleSeo(title, lang);
                };
            } else if (status == 0) {
                if ($("#slug-default" + lang).length) {
                    title = $("#slug-default" + lang).val();
                    /* Slug preivew */
                    slugPreview(title, lang);
                    /* Slug preivew title seo */
                    slugPreviewTitleSeo(title, lang);
                };
            };
        };
    });
};

function slugAlert(result, lang) {
    if (result == 1) {
        $("#alert-slug-danger" + lang).addClass("d-none");
        $("#alert-slug-success" + lang).removeClass("d-none");
    } else if (result == 0) {
        $("#alert-slug-danger" + lang).removeClass("d-none");
        $("#alert-slug-success" + lang).addClass("d-none");
    } else if (result == 2) {
        $("#alert-slug-danger" + lang).addClass("d-none");
        $("#alert-slug-success" + lang).addClass("d-none");
    };
};

function slugCheck() {
    var slugInput = $('.slug-input');
    var id = $('.slug-id').val();
    var copy = $('.slug-copy').val();
    slugInput.each(function(index) {
        var slugId = $(this).attr('id');
        var slug = $(this).val();
        var lang = slugId.substr(slugId.length - 2);
        if (slug) {
            $.ajax({
                url: 'ajax/ajax_slug.php',
                type: 'POST',
                dataType: 'html',
                async: false,
                data: {
                    slug: slug,
                    id: id,
                    copy: copy,
                    lang: lang
                },
                success: function(result) {
                    slugAlert(result, lang);
                }
            });
        };
    });
};

/* Upload avatar */
function upload_image(element) {
    $("#"+element).click();
};

/* Transition */
$(".transition_money").change(function() {
    let value = $(this).val();
    const max = $(this).attr("data-max");
    const transition_type = $(".transition_type").val();
    value = value.replaceAll(",", "");
    value = Number(value);
    if(transition_type == 1) {
        let result = 0;
        if(value > max) {
            result = max;
            $(this).val(max);
        } else {
            result = value;
        };
        
        $(".transition_last_money").val(Number(max) - Number(result));
    } else {
        $(".transition_last_money").val(Number(max) + Number(value));
    };
    $(".format-price").priceFormat({
        limit: 13,
        prefix: '',
        centsLimit: 0
    });
});

$('.transition_type').change(function() {
    const value = $(this).val();
    if(value == 1) {
        let money = $('.transition_money').val();
        money = money.replaceAll(",", "");
        money = Number(money);
        const max = $('.transition_money').attr("data-max");
        let result = 0;
        if(money > max) {
            result = max;
            $('.transition_money').val(result);
        } else {
            result = money;
        };
       
        $(".transition_last_money").val(Number(max) - Number(result));
    };
    $(".format-price").priceFormat({
        limit: 13,
        prefix: '',
        centsLimit: 0
    });
});


/* Reader image */
function readImage(inputFile, elementPhoto) {
    if (inputFile[0].files[0]) {
        if (inputFile[0].files[0].name.match(/.(jpg|jpeg|png|gif|svg|webp)$/i)) {
            var size = parseInt(inputFile[0].files[0].size) / 1024;
            if (size <= 4096) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $(elementPhoto).attr('src', e.target.result);
                }
                reader.readAsDataURL(inputFile[0].files[0]);
            } else {
                notifyDialog("Dung lượng hình ảnh lớn. Dung lượng cho phép <= 4MB ~ 4096KB");
                return false;
            }
        } else {
            notifyDialog("Hình ảnh không hợp lệ");
            return false;
        }
    } else {
        notifyDialog("Dữ liệu không hợp lệ");
        return false;
    }
};
/* Photo zone */
function photoZone(eDrag, iDrag, eLoad) {
    if ($(eDrag).length) {
        /* Drag over */
        $(eDrag).on("dragover", function() {
            $(this).addClass("drag-over");
            return false;
        });
        /* Drag leave */
        $(eDrag).on("dragleave", function() {
            $(this).removeClass("drag-over");
            return false;
        });
        /* Drop */
        $(eDrag).on("drop", function(e) {
            e.preventDefault();
            $(this).removeClass("drag-over");
            var lengthZone = e.originalEvent.dataTransfer.files.length;
            if (lengthZone == 1) {
                $(iDrag).prop("files", e.originalEvent.dataTransfer.files);
                readImage($(iDrag), eLoad);
            } else if (lengthZone > 1) {
                notifyDialog("Bạn chỉ được chọn 1 hình ảnh để upload");
                return false;
            } else {
                notifyDialog("Dữ liệu không hợp lệ");
                return false;
            }
        });
        /* File zone */
        $(iDrag).change(function() {
            readImage($(this), eLoad);
        });
    }
};
/* Watermark */
function toDataURL(url, callback) {
    var xhr = new XMLHttpRequest();
    xhr.onload = function() {
        var reader = new FileReader();
        reader.onloadend = function() {
            callback(reader.result);
        }
        reader.readAsDataURL(xhr.response);
    };
    xhr.open('GET', url);
    xhr.responseType = 'blob';
    xhr.send();
};

$(document).ready(function() {
    /* Select 2 */
    $('.select2').select2();
    var selecicon = $('.iconSelect').select2({
        data: icon,
        escapeMarkup: function(markup) {
        return markup;
        },
        templateResult: function(data) {
        return data.text;
        },
        templateSelection: function(data) {
        return data.text;
        }
    });

    const defaultValue = $(".iconSelect").attr("data-default");
    selecicon.val(defaultValue).trigger('change');

    /* Format price */
    $(".format-price").priceFormat({
        limit: 13,
        prefix: '',
        centsLimit: 0
    });
    /* PhotoZone */
    photoZone("#photo-zone", "#file-zone", "#photoUpload-preview img");
    /* PhotoZone2 */
    photoZone("#photo-zone2", "#file-zone2", "#photoUpload-preview2 img");
    /* Sumoselect */
    window.asd = $('.multiselect').SumoSelect({
        selectAll: true,
        search: true,
        searchText: 'Tìm kiếm'
    });
});

/* Ckeditor */
const useDarkMode = window.matchMedia('(prefers-color-scheme: dark)').matches;
const isSmallScreen = window.matchMedia('(max-width: 1023.5px)').matches;

tinymce.PluginManager.add('deleteimage', function(editor) {
    editor.addCommand('deleteImage', function(ui, value) {
        const selectedNode = editor.selection.getNode();
        if (selectedNode.nodeName === 'IMG') {
            const src = selectedNode.getAttribute('data-mce-src');
            $.ajax({
                url: 'ajax/ajax_delete_file.php',
                method: 'POST',
                data: { src: src },
                success: function(response) {
                    editor.dom.remove(selectedNode);
                },
            });
        }; 
        if (selectedNode.nodeName === 'FIGURE') {
            const imgElement = selectedNode.querySelector('img');
            let src = imgElement.getAttribute('src');
            src = src.replace("<?= $config_base ?>", "");
            $.ajax({
                url: 'ajax/ajax_delete_file.php',
                method: 'POST',
                data: { src: src },
                success: function(response) {
                    editor.dom.remove(selectedNode); 
                },
            });
        };
    });
    editor.ui.registry.addButton('deleteimage', {
        icon: 'remove',
        tooltip: 'Xóa hình ảnh',
        onAction: function() {
            editor.execCommand('deleteImage');
        },
    });
});

tinymce.init({
    selector: 'textarea.form-control-ckeditor',
    plugins: 'deleteimage advlist anchor charmap code codesample colorpicker contextmenu directionality emoticons  fullscreen help hr image imagetools importcss insertdatetime legacyoutput link lists media nonbreaking noneditable pagebreak paste preview print quickbars save searchreplace spellchecker tabfocus table template textcolor textpattern toc visualblocks visualchars wordcount',
    menubar: 'file edit view insert format tools table help',
    toolbar: 'undo redo | bold italic underline strikethrough | lineheight | styleselect fontselect fontsizeselect  |  forecolor backcolor  | alignleft aligncenter alignright alignjustify | removeformat outdent indent |  numlist bullist | numlist bullist checklist | pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image deleteimage media pageembed template link anchor codesample | ltr rtl',
    toolbar_mode: 'sliding',
    toolbar_sticky: false,
    toolbar_sticky_offset: isSmallScreen ? 102 : 108,
    max_height: 800,
    highlight_on_focus: false,
    document_base_url: base_url,

    // file
    images_file_types: 'png,jpg,svg,webp,gif,jpge',
    file_picker_types: 'file image media',
    image_caption: true,
    automatic_uploads: true,
    image_uploadtab: true,
    image_advtab: true,
    image_title: true,
    image_class_list: [
        { title: 'Full màng hình', value: 'img-full',  },
        { title: '90% màng hình', value: 'img-90',  },
        { title: '80% màng hình', value: 'img-80',  },
        { title: '70% màng hình', value: 'img-70',  },
        { title: '60% màng hình', value: 'img-60',  },
        { title: '50% màng hình', value: 'img-50',  },
        { title: '40% màng hình', value: 'img-40',  },
        { title: '20% màng hình', value: 'img-20',  },
        { title: '10% màng hình', value: 'img-10',  },
    ],
    quickbars_image_toolbar: 'alignleft aligncenter alignright | deleteimage',
    images_upload_handler: function (blobInfo, success, failure) {
        const xhr = new XMLHttpRequest();
        xhr.withCredentials = false;
        xhr.open('POST', 'ajax/ajax_upload_textarea.php');
        xhr.upload.onprogress = (e) => {
            progress(e.loaded / e.total * 100);
        };
        xhr.onload = () => {
            if (xhr.status === 403) {
                failure({ message: 'HTTP Error: ' + xhr.status, remove: true });return;
            }
            if (xhr.status < 200 || xhr.status >= 300) {
                failure('HTTP Error: ' + xhr.status);return;
            }
            const json = JSON.parse(xhr.responseText);
            if (!json || typeof json.location != 'string') {
                failure('Invalid JSON: ' + xhr.responseText);return;
            }
            success(json.location);
        };
        xhr.onerror = () => {
            failure('Image upload failed due to a XHR Transport error. Code: ' + xhr.status);
        };
        const formData = new FormData();
        formData.append('file', blobInfo.blob(), blobInfo.filename());
        xhr.send(formData);
    },

    // format
    formats: {
        alignleft: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,audio,video', classes: 'left' },
        aligncenter: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,audio,video', classes: 'center' },
        alignright: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,audio,video', classes: 'right' },
        alignfull: { selector: 'p,h1,h2,h3,h4,h5,h6,td,th,div,ul,ol,li,table,img,audio,video', classes: 'full' },
        bold: { inline: 'span', classes: 'bold' },
        italic: { inline: 'span', classes: 'italic' },
        underline: { inline: 'span', classes: 'underline', exact: true },
        strikethrough: { inline: 'del' },
        customformat: { inline: 'span', styles: { color: '#00ff00', fontSize: '20px' }, attributes: { title: 'My custom format'} , classes: 'example1'}
    },
    indentation : '20pt',
    indent_use_margin: true,
    visualblocks_default_state: true,
    end_container_on_empty_block: true,

    // skin
    skin: useDarkMode ? 'oxide-dark' : 'oxide-dark',
    
    codesample_languages: [
        { text: 'Macbook dark', value: 'cpp code-mac-dark highlight-code' },
        { text: 'Macbook light', value: 'cpp code-mac-light code-light highlight-code' },
        { text: 'Normal dark', value: 'cpp code-normal-dark highlight-code' },
        { text: 'Normal light', value: 'cpp ccode-normal-light code-light highlight-code' },
    ],
    codesample_global_prismjs: false,
   
    templates : tem,

    height: 700,
    quickbars_selection_toolbar: 'bold italic | quicklink h2 h3 blockquote quickimage quicktable',
    
    // contextmenu
    contextmenu: 'link image table toc',
    noneditable_class: 'mceNonEditable',
    importcss_append: true,
    content_css: base_url+'admin/assets/css/ckeditor.css?v=' + new Date().getTime(),
    setup: function(editor) {
        editor.on('keydown', function(e) {
            if (e.keyCode === 46 || e.keyCode === 8) {
                editor.execCommand('deleteImage');
            };
        });
    }
});

/* Ajax category */
$('body').on('change', '.select-category', function() {
    var id = $(this).val();
    var child = $(this).data("child");
    var level = parseInt($(this).data('level'));
    var table = $(this).data('table');
    var type = $(this).data('type');
    if ($("#" + child).length) {
        $.ajax({
            url: 'ajax/ajax_category.php',
            type: 'POST',
            data: {
                level: level,
                id: id,
                table: table,
                type: type
            },
            success: function(result) {
                var op = "<option value='0'>Chọn danh mục</option>";
                if (level == 0) {
                    $("#id_cat").html(op);
                    $("#id_item").html(op);
                    $("#id_sub").html(op);
                } else if (level == 1) {
                    $("#id_item").html(op);
                    $("#id_sub").html(op);
                } else if (level == 2) {
                    $("#id_sub").html(op);
                }
                $("#" + child).html(result);
            }
        });
        return false;
    };
});
/* Ajax place */
$('body').on('change', '.select-place', function() {
    var id = $(this).val();
    var child = $(this).data("child");
    var level = parseInt($(this).data('level'));
    var table = $(this).data('table');
    if ($("#" + child).length) {
        $.ajax({
            url: 'ajax/ajax_place.php',
            type: 'POST',
            data: {
                level: level,
                id: id,
                table: table
            },
            success: function(result) {
                var op = "<option value='0'>Chọn danh mục</option>";
                if (level == 0) {
                    $("#id_district").html(op);
                    $("#id_wards").html(op);
                    $("#id_street").html(op);
                } else if (level == 1) {
                    $("#id_wards").html(op);
                    $("#id_street").html(op);
                } else if (level == 2) {
                    $("#id_street").html(op);
                }
                $("#" + child).html(result);
            }
        });
    };
    return false;
});
/* Check required form */
$('.submit-check').click(function(event) {
    var $this;
    /* Holdon */
    holdonOpen("sk-rect", "Vui lòng chờ...", "rgba(0,0,0,0.8)", "white");
    /* Check slug */
    slugCheck();
    /* Check slug danger */
    var elementSlug = $('.card-slug .text-danger:not(.d-none)');
    if (elementSlug.length) {
        elementSlug.each(function() {
            $this = $(this);
            var closest = elementSlug.closest('.tab-pane');
            var id = closest.attr('id');
            $('.nav-tabs a[href="#' + id + '"]').tab('show');
            return false;
        });
        setTimeout(function() {
            $('html,body').animate({
                scrollTop: $this.offset().top - 110
            }, 'medium');
        }, 500);
        holdonClose();
        return false;
    };
   
    /* Check input empty */
    var elementArticle = $('.card-article :required:invalid');
    if (elementArticle.length) {
        if ($('.card').hasClass('collapsed-card')) {
            $('.card.collapsed-card .card-body').show();
            $('.card.collapsed-card .btn-tool i').toggleClass('fas fa-plus fas fa-minus');
            $('.card.collapsed-card').removeClass('collapsed-card');
        };
        elementArticle.each(function() {
            $this = $(this);
            var closest = elementArticle.closest('.tab-pane');
            var id = closest.attr('id');
            $('.nav-tabs a[href="#' + id + '"]').tab('show');
            return false;
        });
        setTimeout(function() {
            $('html,body').animate({
                scrollTop: $this.offset().top - 90
            }, 'medium');
        }, 500);
        holdonClose();
    };
    holdonClose();
});
/* Push oneSignal */
$('body').on('click', '#push-onesignal', function() {
    var url = $(this).data("url");
    confirmDialog("push-onesignal", "Bạn muốn đẩy tin này ?", url);
});
/* Send email */
$('body').on('click', '#send-email', function() {
    confirmDialog("send-email", "Bạn muốn gửi thông tin cho các mục đã chọn ?", "");
});
/* Check item */
var lastChecked = null;
var $checkboxItem = $(".select-checkbox");
$checkboxItem.click(function(e) {
    if (!lastChecked) {
        lastChecked = this;
        return;
    };
    if (e.shiftKey) {
        var start = $checkboxItem.index(this);
        var end = $checkboxItem.index(lastChecked);
        $checkboxItem.slice(Math.min(start, end), Math.max(start, end) + 1).prop('checked', true);
    };
    lastChecked = this;
});
/* Check all */
$('body').on('click', '#selectall-checkbox', function() {
    var parentTable = $(this).parents('table');
    var input = parentTable.find('input.select-checkbox');
    if ($(this).is(':checked')) {
        input.each(function() {
            $(this).prop('checked', true);
        });
    } else {
        input.each(function() {
            $(this).prop('checked', false);
        });
    };
});
/* Delete item */
$('body').on('click', '#delete-item', function() {
    var url = $(this).data("url");
    confirmDialog("delete-item", "Bạn có chắc muốn xóa mục này ?", url);
});
/* Delete all */
$('body').on('click', '#delete-all', function() {
    var url = $(this).data("url");
    confirmDialog("delete-all", "Bạn có chắc muốn xóa những mục này ?", url);
});
/* Load name input file */
$('body').on('change', '.custom-file input[type=file]', function() {
    var fileName = $(this).val();
    fileName = fileName.substr(fileName.lastIndexOf('\\') + 1, fileName.length);
    $(this).siblings('label').html(fileName);
    $(this).parents("div.form-group").children(".change-photo").find("b.text-sm").html(fileName);
    $(this).parents("div.form-group").children(".change-file").find("b.text-sm").html(fileName);
});
/* Change status */
$('body').on('click', '.show-checkbox', function() {
    var id = $(this).attr('data-id');
    var table = $(this).attr('data-table');
    var loai = $(this).attr('data-loai');
    var $this = $(this);
    $.ajax({
        url: 'ajax/ajax_status.php',
        type: 'POST',
        dataType: 'html',
        data: {
            id: id,
            table: table,
            loai: loai
        },
        success: function() {
            if ($this.is(':checked')) $this.prop('checked', false);
            else $this.prop('checked', true);
        }
    });
    return false;
});
/* Change stt */
$('body').on("change", "input.update-stt", function() {
    var id = $(this).attr('data-id');
    var table = $(this).attr('data-table');
    var value = $(this).val();
    $.ajax({
        url: 'ajax/ajax_stt.php',
        type: 'POST',
        dataType: 'html',
        data: {
            id: id,
            table: table,
            value: value
        }
    });
    return false;
});
/* Watermark */
$(".watermark-position label").click(function() {
    if ($(".change-photo img").length) {
        var img = $(".change-photo img").attr("src");
        if (img) {
            $(".watermark-position label img").attr("src", "assets/images/noimage.png");
            $(this).find("img").attr("src", img);
            $(this).find("img").show();
        }
    } else {
        notifyDialog("Dữ liệu hình ảnh không hợp lệ");
        return false;
    };
});
/* Slug */
slugPress();
$('body').on("click", "#slugchange", function() {
    slugChange($(this));
});
/* SEO */
seoChange();
$('body').on("keyup", ".title-seo, .keywords-seo, .description-seo", function() {
    seoCount($(this));
});
$('body').on("click", ".create-seo", function() {
    if (seoExist()) confirmDialog("create-seo",
        "Nội dung SEO đã được thiết lập. Bạn muốn tạo lại nội dung SEO ?", "");
    else seoCreate();
});
/* Copy */
$('body').on("click", ".copy-now", function() {
    var id = $(this).attr('data-id');
    var table = $(this).attr('data-table');
    var copyimg = $(this).attr('data-copyimg');
    holdonOpen("sk-rect", "Vui lòng chờ...", "rgba(0,0,0,0.8)", "white");
    $.ajax({
        url: 'ajax/ajax_copy.php',
        type: 'POST',
        dataType: 'html',
        async: false,
        data: {
            id: id,
            table: table,
            copyimg: copyimg
        },
        success: function() {
            holdonClose();
        }
    });
    window.location.reload(true);
});

 