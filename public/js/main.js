$(document).ready(function () {
//  SLIDER
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

//  ZOOM PRODUCT DETAIL
    // $("#zoom").elevateZoom({gallery: 'list-thumb', cursor: 'pointer', galleryActiveClass: 'active', imageCrossfade: true, loadingIcon: 'http://www.elevateweb.co.uk/spinner.gif'});
    $('#main-img').imagezoomsl({
        zoomrange:[2, 2],
        scrollspeedanimate: 5 ,
        zoomspeedanimate: 7,
        loopspeedanimate: 2.5,  
        magnifierspeedanimate: 350
    
    });
//  LIST THUMB
    var list_thumb = $('#list-thumb');
    list_thumb.owlCarousel({
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 5], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 5], // betweem 900px and 601px
        itemsTablet: [768, 5], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });

//  FEATURE PRODUCT
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

//  SAME CATEGORY
    var same_category = $('#same-category-wp .list-item');
    same_category.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });

//  SCROLL TOP
    $(window).scroll(function () {
        if ($(this).scrollTop() != 0) {
            $('#btn-top').stop().fadeIn(150);
        } else {
            $('#btn-top').stop().fadeOut(150);
        }
    });
    $('#btn-top').click(function () {
        $('body,html').stop().animate({scrollTop: 0}, 800);
    });

// CHOOSE NUMBER ORDER
    var value = parseInt($('#num-order').attr('value'));
    $('#plus').click(function () {
        value++;
        $('#num-order').attr('value', value);
        update_href(value);
    });
    $('#minus').click(function () {
        if (value > 1) {
            value--;
            $('#num-order').attr('value', value);
        }
        update_href(value);
    });

//  MAIN MENU
    $('#category-product-wp .list-item > li').find('.sub-menu').after('<i class="fa fa-angle-right arrow" aria-hidden="true"></i>');

//  TAB
    tab();

    //  EVEN MENU RESPON
    $('html').on('click', function (event) {
        var target = $(event.target);
        var site = $('#site');

        if (target.is('#btn-respon i')) {
            if (!site.hasClass('show-respon-menu')) {
                site.addClass('show-respon-menu');
            } else {
                site.removeClass('show-respon-menu');
            }
        } else {
            $('#container').click(function () {
                if (site.hasClass('show-respon-menu')) {
                    site.removeClass('show-respon-menu');
                    return false;
                }
            });
        }
    });

//  MENU RESPON
    $('#main-menu-respon li .sub-menu').after('<span class="fa fa-angle-right arrow"></span>');
    $('#main-menu-respon li .arrow').click(function () {
        if ($(this).parent('li').hasClass('open')) {
            $(this).parent('li').removeClass('open');
        } else {

//            $('.sub-menu').slideUp();
//            $('#main-menu-respon li').removeClass('open');
            $(this).parent('li').addClass('open');
//            $(this).parent('li').find('.sub-menu').slideDown();
        }
    });

    
//Xử lý ajax hiển thị quận huyện theo tỉnh thành phố
    $('#province').change(function() {
        var province_id = $('#province').val();
        // alert(province_id);

        $.ajax({
            url: "update_ajax_public.php",
            medthod: "GET",
            data: {province_id: province_id},
            dataType: 'text',
            success: function (data) {
                // console.log(data);
                // console.log(data.total);  xuất dữ liệu dạng json
                $("#district").html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    $('#district').change(function() {
        var district_id = $('#district').val();
        // alert(district_id); 

        $.ajax({
            url: "update_ajax_public.php",
            medthod: "GET",
            data: {district_id: district_id},
            dataType: 'text',
            success: function (data) {
                // console.log(data);
                // console.log(data.total);  xuất dữ liệu dạng json
                $("#wards").html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });

    //Xử lý ajax giỏ hàng
    $('.num-order').change(function() {
        var id = $(this).attr('data-id');
        var qty = $(this).val();
        // alert(id);

        $.ajax({
            url: "?mod=cart&action=updateAjax",
            medthod: "GET",
            data: {id: id, qty: qty},
            dataType: 'json',
            success: function (data) {
                // console.log(data);
                // console.log(data.total);  xuất dữ liệu dạng json
                $("#sub-total-"+id).text(data.sub_total);
                $("#total-price span").text(data.total);
                console.log(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    //Xử lý ajax thêm sản phẩm vào giỏ hàng
    $('.add-cart').click(function() {
        var id = $(this).attr('data-id');
        console.log(id);
        // alert(id);
        $.ajax({
            url: "?mod=cart&action=addAjax",
            medthod: "GET",
            data: {id: id},
            dataType: 'text',
            success: function (data) {
                // console.log(data);
                // console.log(data.total);  xuất dữ liệu dạng json
                $("#cart-wp").html(data);
                console.log(data); 
                    
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

  
    // Xử lý phần hiển thị xem thêm trong chi tiết sản phẩm
    $("#view-more").click(function() {
        $(this).parent().toggleClass('show-full');
        $(this).parent().slideDown();
        
        if($(this).parent().hasClass('show-full')) {
            $(this).text("Rút gọn");
            $(this).css('top', '100%');
            $('.bg-article').css('display', 'none');
        }else {
            $(this).text("Xem thêm");
            $(this).css('top', '94%');
            $('.bg-article').css('display', 'block');
        }

    })


    //Xử lý lọc sản phẩm theo giá

    $('.filter-price').click(function() {
        let queryString = window.location.search;
        let urlParam = new URLSearchParams(queryString);
        // console.log(urlParam);
        // let slug = urlParam.get('dien-thoai'); 
        // console.log(slug);
        var price = $(this).val();
        var slug = $('#name-slug').val();
        console.log(slug);
        console.log(price);
        $.ajax({
                    url: "?mod=product&action=filterAjax",
                    medthod: "GET",
                    data: {price: price, slug: slug},
                    dataType: 'json',
                    success: function (data) {
                        // console.log(data);
                        // console.log(data.total);  xuất dữ liệu dạng json
                        $('.list-filter').html(data.output);
                        console.log(data);
                        $('#paging-wp').html(data.op_paging);
                            
                    },
                    error: function(xhr, ajaxOptions, thrownError) {
                        alert(xhr.status);
                        alert(thrownError);
                    }
                });
    });
    
   
    //Xử lý ajax search sản phẩm
    $("#s").keyup(function() {
        var keyword = $(this).val();
        // alert(keyword); 
    
        $.ajax({
            url: "?mod=product&action=searchAjax",
            medthod: "GET",
            data: {keyword: keyword},
            dataType: 'text',
            success: function (data) {
                // console.log(data);
                // console.log(data.total);  xuất dữ liệu dạng json
                $('.search-result').html(data);
                console.log(data);
                    
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });

    });


// end document ready
});




function tab() {
    var tab_menu = $('#tab-menu li');
    tab_menu.stop().click(function () {
        $('#tab-menu li').removeClass('show');
        $(this).addClass('show');
        var id = $(this).find('a').attr('href');
        $('.tabItem').hide();
        $(id).show();
        return false;
    });
    $('#tab-menu li:first-child').addClass('show');
    $('.tabItem:first-child').show();
}


  
