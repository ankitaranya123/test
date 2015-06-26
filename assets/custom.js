/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$('document').ready(function () {
       $(".datepicker").datepicker();
    $('#example2').dataTable();
    $('#example3').dataTable({
    });


    // confirmation for delete the category...

    $(".deleteCat").click(function () {
        var base_url = $("#base_url").val();
        var cat_id = $(this).attr('data-id');
        bootbox.confirm("Are you sure?", function (result) {
            if (result) {

                $.ajax({
                    'type': 'POST',
                    'url': base_url + '/index.php/category/deleteCat/' + cat_id,
                    success: function (res) {
                        if (res == '1') {
                            window.location = base_url + '/index.php/category/categoryList';
                        }
                    }
                })

            } else {

            }
        });
    })
    // confirmation for delete the product...

    $(".deleteProduct").click(function () {
        var base_url = $("#base_url").val();
        var product_id = $(this).attr('data-id');
        bootbox.confirm("Are you sure?", function (result) {
            if (result) {

                $.ajax({
                    'type': 'POST',
                    'data':{product_id:product_id},
                    'url': base_url + '/index.php/category/deleteProduct/',
                    success: function (res) {
                        if (res == '1') {
                            window.location = base_url + '/index.php/category/productList';
                        }
                    }
                })

            } else {

            }
        });
    })
    // add fields for product ...

    $('body').on('click', '#saveFields', function () {

        var fieldsVal = $("body").find('#fieldsName').val();
        var cateid = $("body").find('#categoryId').val();
        var baseurl = $("body").find('#base_url').val();

        if (fieldsVal != '') {
            $.ajax({
                "type": "Post",
                "data": {category_id: cateid, fields_name: fieldsVal},
                "url": baseurl + "index.php/category/addFields",
                success: function (res) {
                    if (res != "0") {

                        var clone = $('body').find(".fieldsClone").clone().removeAttr('hidden');

                        clone.removeClass('fieldsClone');
                        clone.find('label').html(fieldsVal + "<a href='#' style='color:red;' title='Remove Fields' class='removeFields' data-field='" + res + "'>&nbsp;&nbsp;Remove</a>");
                        clone.find('input').attr('name', parseInt(res));

                        $(".addProduct").prepend(clone);
                        $("body").find('#fieldsName').val('');
                        $("body").find("#closeModal").trigger('click');
                        $("body").find("#modalError").addClass('hide');
                    } else {
                        $("body").find('#fieldsName').val('');
                        $("body").find("#closeModal").trigger('click');
                        $("body").find("#modalError").addClass('hide');
                    }


                }

            });
        } else {
            $("body").find("#modalError").removeClass('hide');
        }
    });

    // remove fields
    $('body').on('click', '.removeFields', function () {
        var baseurl = $("body").find('#base_url').val();
        var fieldsId = $(this).attr('data-field');
        $.ajax({
            "type": "Post",
            "data": {fields_id: fieldsId},
            "url": baseurl + "index.php/category/deleteFields",
            success: function (res) {
                if (res != "0") {
                    $("body").find('.removeFields').parent().parent().remove();
                }
            }
        })
    })
// filter product by cateory..

    $("#filterProduct").change(function () {
        var cateid = $(this).val();
        var baseurl = $("#base_url").val();
        if (cateid != '') {
            $("#cat_id").val(cateid);
            $("#categoryFilterForm").submit();

        }

    })
})

