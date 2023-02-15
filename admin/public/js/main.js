$(document).ready(function () {

    var height = $(window).height() - $('#footer-wp').outerHeight(true) - $('#header-wp').outerHeight(true);
    $('#content').css('min-height', height);

//  CHECK ALL
    $('input[name="checkAll"]').click(function () {
        var status = $(this).prop('checked');
        $('.list-table-wp tbody tr td input[type="checkbox"]').prop("checked", status);
    });

// EVENT SIDEBAR MENU
    $('#sidebar-menu .nav-item .nav-link .title').after('<span class="fa fa-angle-right arrow"></span>');
    var sidebar_menu = $('#sidebar-menu > .nav-item > .nav-link');
    sidebar_menu.on('click', function () {
        if (!$(this).parent('li').hasClass('active')) {
            $('.sub-menu').slideUp();
            $(this).parent('li').find('.sub-menu').slideDown();
            $('#sidebar-menu > .nav-item').removeClass('active');
            $(this).parent('li').addClass('active');
            return false;
        }else {
            $('.sub-menu').slideUp();
            $('#sidebar-menu > .nav-item').removeClass('active');
            return false;
        }
        
        
    });

    
    // Xử lý ajax phần hiển thị danh mục cha, danh mục con
    $('#list-parent').change(function() {
        var parent_id = $('#list-parent').val();
        // alert(parent_id);

        $.ajax({
            url: "update_ajax.php",
            medthod: "GET",
            data: {parent_id: parent_id},
            dataType: 'text',
            success: function (data) {
                // console.log(data);
                // console.log(data.total);  xuất dữ liệu dạng json
                $("#list-child").html(data);
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(xhr.status);
                alert(thrownError);
            }
        });
    });

    //Xử lý ajax hiển thị hình ảnh khi thêm mới slider
    // $(document).on('change', '#file_slider', function() {
    //     var property = document.getElementById('file_slider').files[0];
    //     // console.log(property);
    //     var image_name = property.name;
    //     console.log(image_name);
    //     var image_extension = image_name.split('.').pop().toLowerCase();
    //     // console.log(image_extension);
    //     var form_data = new FormData();
    //     form_data.append("file_slider", property);
    //     // console.log(form_data);

    //     $.ajax({
    //         url: "?mod=slider&action=imageAjax",
    //         medthod: "GET",
    //         data: {form_data: form_data, image_name: image_name},
    //         dataType: 'text',
    //         contentType: false,
    //         cache: false,
    //         processData: false,
    //         success: function (data) {
    //             // console.log(data);
    //             // console.log(data.total);  xuất dữ liệu dạng json
    //             $(".upload-image").html(data);
    //         },
    //         error: function(xhr, ajaxOptions, thrownError) {
    //             alert(xhr.status);
    //             alert(thrownError);
    //         }
    //     });
    // });

// end function
});



