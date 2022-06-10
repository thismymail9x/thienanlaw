//Some js
//Get the button
$(document).ready(function() {
    (function (a) {
        //start - keep active status - tuannt
        if(a.includes('page/bang-gia') || a.includes('page/price')) {
            $(".navbar-collapse li a[href*='page/bang-gia']").addClass('active-menu-item');
            $(".navbar-collapse li a[href*='page/price']").addClass('active-menu-item');
        } else if (a.includes('/blogs')) {
            $(".navbar-collapse li a[href*='/blogs']").addClass('active-menu-item');
        } else if (a.includes('page/ve-chung-toi') || a.includes('page/our-story')) {
            $(".navbar-collapse li a[href*='page/ve-chung-toi']").addClass('active-menu-item');
            $(".navbar-collapse li a[href*='page/our-story']").addClass('active-menu-item');
        } else if (a.includes('page/ve-vpn') || a.includes('page/our-vpn')) {
            $(".navbar-collapse li a[href*='page/ve-vpn']").addClass('active-menu-item');
            $(".navbar-collapse li a[href*='page/our-vpn']").addClass('active-menu-item');
        } else if (a.includes('page/tinh-nang') || a.includes('page/features')) {
            $(".navbar-collapse li a[href*='page/tinh-nang']").addClass('active-menu-item');
            $(".navbar-collapse li a[href*='page/features']").addClass('active-menu-item');
        } else if (a.includes('/support')) {
            $(".navbar-collapse li a[href*='/support']").addClass('active-menu-item');
        }
        //end - keep active status - tuannt

        $('a[href="' + a + '"]').addClass('active-menu-item');
        //
        var base_url = $('base').attr('href') || '';
        if (base_url != '') {
            a = a.replace(base_url, '../..');
            $('a[href$="' + a + '"], a[href="./' + a + '"]').addClass('active__nav-link');
        }
    })(window.location.href);

// tạo active cho li con
    $('.sub-menu a.active__nav-link').addClass('active').parent('li').addClass('current-menu-item');

// tạo active cho li cha
    $('ul li.current-menu-item').addClass('active').parent('ul').parent('li').addClass('current-menu-parent');

// tạo active cho li ông
    $('ul li.current-menu-parent').addClass('active').parent('ul').parent('li').addClass('current-menu-grand').addClass('active');

    // thêm mũi tên cho menu
    $('.header__navbar li').each(function () {
        if ($('.sub-menu', this).length > 0) {
            $('a', this).append(' <i class="fas fa-angle-down ml-1"></i>');
        }
    });
    $('.header__navbar .sub-menu i.fas.fa-angle-down').remove();

// thêm mũi tên cho sub-menu menu
    $('.header__navbar .sub-menu li').each(function () {
        if ($('.sub-menu', this).length > 0) {
            $('a', this).append(' <i class="fas fa-angle-right ml-1"></i>');
        }
    });
    $('.header__navbar .sub-menu li .sub-menu i.fas.fa-angle-right').remove();


    $(".cf li a").mouseover(function() {
          $(".cf li a").next('.sub-menu').removeClass('d-block');
         // $(".cf li .sub-menu .sub-menu").removeClass('d-block');
       $(this).next('.sub-menu').addClass('d-block');

    });

    $(".cf li .sub-menu li a").mouseover(function() {
         $(this).parent().parent().addClass('d-block');
        $(this).next('.sub-menu').addClass('d-block');
    });
    $(".cf li .sub-menu li .sub-menu li a").mouseover(function() {
        $(this).parent().parent().addClass('d-block');
        $(this).parent().parent().parent().parent().addClass('d-block');
    });

    $(document).ready(function() {
        $('.cf li a .fa-angle-down').on('touchstart touchend', function(e) {
            e.preventDefault();
            $(".cf li a").next('.sub-menu').removeClass('d-block');
            // $(".cf li .sub-menu .sub-menu").removeClass('d-block');
            $(this).parent().next('.sub-menu').addClass('d-block');
        });

        $('.cf li .sub-menu li a .fa-angle-right').on('touchstart touchend', function(e) {
            e.preventDefault();
            $(this).parent().parent().parent().addClass('d-block');
            $(this).parent().next('.sub-menu').addClass('d-block');
        });
    });




});

function topFunction() {
    document.body.scrollTop = 0;
    document.documentElement.scrollTop = 0;
}

window.onscroll = function() {scrollFunction()};

function scrollFunction() {
    if (document.body.scrollTop > 20 || document.documentElement.scrollTop > 20) {
        document.getElementById("myBtn").style.display = "block";
        document.getElementById("navbar").style.top = "0";
        document.getElementById("navbar").style.position = "fixed";
    } else {
        document.getElementById("myBtn").style.display = "none";
        document.getElementById("navbar").style.top = "0";
        document.getElementById("navbar").style.position = "relative";
    }
}

// function validate_pro(textbox, text) {
//
//     if (textbox.value == '') {
//         textbox.setCustomValidity(text);
//     } else if (textbox.validity.typeMismatch) {
//         textbox.setCustomValidity('Vui lòng nhập đúng định dạng');
//     } else {
//         textbox.setCustomValidity('');
//     }
//     return true;
// }


$(document).ready(function () {
    //tab on blogs custom
    $('.blogs-tabs .nav-link').click(function () {
        number = 1;
        var id_show = $(this).attr('href');
        $('.blogs-tabs .tab-pane.fade').removeClass('show active');
        $(id_show).addClass('show active');
    })
    // navbar custom
    $('.navbar-toggler').click(function () {
        $('#navbarText').toggle('show');
    })
    // change input upload file
    $('#input__file').change(function () {
        var i = $(this).prev('label').clone();
        var file = $('#input__file')[0].files[0].name;
        $(this).prev('label').text(file);
        $('.icon-file').css('max-width', '100%');
    });

    $('#owl-carousel').owlCarousel({
        dots: true,
        items: 3,
        // loop: true,
        margin: 24,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 2
            },
            768: {
                items: 2
            },
            992: {
                items: 3
            },
            1200: {
                items: 3
            }
        }
    })
    // add active center từ ban đầu
    $('.content__slider .owl-item.active:first').next().addClass('active__center');
    // khi change slide thì add active center để hiển thị div dài ở giữa
    $('#owl-carousel').on('changed.owl.carousel', function (event) {
        $('.content__slider .owl-item').removeClass('active__center');
        setTimeout(function () {
            $('.content__slider .owl-item.active:first').next().addClass('active__center');
        }, 1)
    });
    // carousel của bảng giá
    $('#price__owl-carousel').owlCarousel({
        dots: true,
        items: 1,
        loop: false,
        nav:true,
        navText: ["<i class='prev fa fa-angle-left'></i>", "<i class='next fa fa-angle-right'></i>"],
        margin: 0,
        responsive: {
            0: {
                items: 1
            },
            576: {
                items: 1
            },
            768: {
                items: 2
            },
            992: {
                items: 2
            },
            1200: {
                items: 3
            }
        }
    })


    $('.click-more').click(function () {
        $('.third ul li').removeClass('d-none');
        $('.third').addClass('fix-height');
        $('.click-more').hide();
    })
    $('.reload').click(function () {
        refreshCaptcha();
      // $('.js_captcha').attr("src", reload_captcha);
    })

    // change language
    $('.language__select').on('change', function () {
        var lang = $(this).val();
        // console.log(lang,'abcd');
       // console.log(url_load_lang_en,'2abcd');

       if (lang == 'en') {
           window.location.href = url_load_lang_en;
       } else {
           window.location.href = url_load_lang_vn
       }
    })
    // search support
    $('.submit-form').click(function (){
        var data_search = $('.input').val();
        //console.log(data_search);
        $('.search-row').load(url_support_search+'/'+data_search);
    })
    $(document).on('keypress',function(e) {
        if(e.which == 13) {
            var data_search = $('.input').val();
            //console.log(data_search);
            $('.search-row').load(url_support_search+'/'+data_search);
        }
    });

    // load more blog
    var number = 1;
    $('.js__load-blog').click(function (){
        var category_id = $(this).attr('data-category-id');
        var lang = $(this).attr('data-lang');
        var button_load = $(this);
        $.ajax({
            url: url_load_more_blog+category_id+'/'+ lang +'/'+number,
            dataType: 'JSON',
            contentType: 'application/json; charset=utf-8',
            method: "GET",
            success: function (data) {
                button_load.parent().parent().children().children().children().children().last().after(data);
                number ++;
                },
            error: function () {
                toastr.error('Lỗi xin vui lòng thử lại sau!');
            }
        });
    })

})


