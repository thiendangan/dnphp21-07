// function changeImg(input)
// {
//     //Nếu như tồn thuộc tính file, đồng nghĩa người dùng đã chọn file mới
//     if ( input.files.length > 0)
//     {
//         var reader = new FileReader();
//         //Sự kiện file đã được load vào website
//         reader.onload = function (e)
//         {
//             //Thay đổi đường dẫn ảnh
//             $('.avatar').attr('src', e.target.result);
//         }
//         reader.readAsDataURL(input.files[0]);
//     }
// }


$(document).ready(function ()
{
    $('.toggle_btn').click(function ()
    {
        $('.sidebar').slideToggle('slow');
    });
    $('#avatar').click(function ()
    {
        $('#img').click();
    });

    $('#img').change(function ()
    {
        $("#all_images").html('');
        if ($(this)[0].files.length <= 4)
        {
            for (var i = 0; i < $(this)[0].files.length; i++)
            {
                $("#all_images").append('<img  classs="avatar thumbnail" src="' + window.URL.createObjectURL(this.files[i]) + '" width="150px"  style="display:inline-block; margin-right: 1rem; margin-bottom: 1rem"/>');
            }
        }
        else{
            $("#all_images").html(`<p style="color:red;margin-bottom:1rem">Vui lòng nhập ít hơn 4 ảnh </p>`);
        }
    });
    $('#form_reset').click(function ()
    {
        $('#addProduct_form').trigger("reset");
        $("#addCategory").val("");
        $("#addCategory").html(`<option disabled selected>Chọn Danh mục sản phẩm</option>`);
        $("#img").val("");
        $("#all_images").html("");
    });

});

