/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    var base_url = $('#base_url').val();
//////// Cart
    $("#confirm").click(function () {
        var obj = $(this);
        bootbox.confirm("Are you sure?", function (result) {
            if (result) {
                window.location.href = $(obj).attr('data-href');
            }
            else {

            }
        });
    })

    $('#addcart').click(function () {

        var id = $('#quantity').attr('data-id');
        var name = $('#quantity').attr('data-name');
        var price = $('#quantity').attr('data-price');
        var qua = $('#quantity').attr('data-qua');
        var qua_val = $('#quantity').val();
        if ($.isNumeric(qua_val))
        {

            if (parseInt(qua_val) <= 0) {

                $('.error_quantity').html('Please enter a valid quantiy minimum is 1.');
            }
            else {
                if (parseInt(qua_val) > parseInt(qua))
                {
                    $('.error_quantity').html('This quantity is out of stock');
                }
                else {
                    var add = $('#cart_' + id + ' h5').html();

                    if (typeof add === 'undefined') {
                        $.ajax({
                            url: base_url + "index.php/shopping/addtocart/",
                            data: {'id': id, 'name': name, 'quantity': qua_val, 'price': price},
                            type: "POST"
                        }).done(function (msg) {
                            var clone = $('.clone-message').clone().removeAttr('style').removeClass().attr('id', 'cart_' + id);

                            $(clone).find('h4').html(name + '<small><a href="#" data-id="' + id + '" class="removecart"><i class="glyphicon glyphicon-remove"></i>Remove</small></a>')
                            $(clone).find('h5').html(qua_val);
                            $(clone).find('p').html(price);
                            $('.cart-li').append(clone);

                            $('.messages-menu .header').html('You have ' + $('.cart-li li').length + ' items in cart.');
                            $('.number-cart').html($('.cart-li li').length);
                            noty({
                                text: "Item added to cart Successfully",
                                layout: 'topCenter',
                                type: "success",
                                theme: 'relax',
                                timeout: 1000,
                                animation: {
                                    open: 'flipInX', // jQuery animate function property object
                                    close: 'flipOutX', // jQuery animate function property object
                                    speed: 500 // opening & closing animation speed
                                }
                            });
                        });
                        $('#quantity').val(1);
                        $('#quantitymodal').modal('hide');
                    }
                    else {

                        if (+qua_val + +add >= parseInt(qua))
                        {
                            $('.error_quantity').html('This quantity is out of stock and item all ready in cart.');
                        }
                        else {
                            $.ajax({
                                url: base_url + "index.php/shopping/addtocart/",
                                data: {'id': id, 'name': name, 'quantity': +qua_val + +add, 'price': price},
                                type: "POST"
                            }).done(function (msg) {
                                $('#cart_' + id + ' h5').html(+qua_val + +add);

                                noty({
                                    text: "Item updated to cart Successfully",
                                    layout: 'topCenter',
                                    type: "success",
                                    theme: 'relax',
                                    timeout: 1000,
                                    animation: {
                                        open: 'flipInX', // jQuery animate function property object
                                        close: 'flipOutX', // jQuery animate function property object
                                        speed: 500 // opening & closing animation speed
                                    }
                                });
                                $('#quantity').val(1);
                                $('#quantitymodal').modal('hide');
                            });
                        }
                    }


                }
            }
        }
        else {
            $('.error_quantity').html('Please enter a number value');
        }


    });

    $('body').on('click', '.addtocart', function () {

        var id = $(this).attr('data-id');
        var name = $(this).attr('data-name');

        $('#quantitymodal').modal('show');
        $('#quantity').attr('data-id', id);
        $('#quantity').attr('data-name', name);
        $('#quantity').attr('data-price', $(this).attr('data-price'));
        $('#quantity').attr('data-qua', $(this).attr('data-qua'));

    });

    $('body').on('click', '.removecart', function () {
        var id = $(this).attr('data-id');
        var obj = $(this);
        $.ajax({
            url: base_url + "index.php/shopping/removecart/",
            data: {'id': id},
            type: "POST"
        }).done(function (msg) {
            $(obj).parentsUntil('li').remove();

            $('body').find('.messages-menu .header').attr('html', 'You have ' + $('.cart-li li').length + ' items in cart.');
            $('body').find('.number-cart').attr('html', $('.cart-li li').length);

            noty({
                text: "Item remove from cart Successfully",
                layout: 'topCenter',
                type: "success",
                theme: 'relax',
                timeout: 1000,
                animation: {
                    open: 'flipInX', // jQuery animate function property object
                    close: 'flipOutX', // jQuery animate function property object
                    speed: 500 // opening & closing animation speed
                }
            });
        });
    });
///////
    $('.mydate').datepicker();

    $('body').on('click', '#userlist_tabel .delete', function () {
        var user_id = $(this).parents('tr').attr('id');
        var obj = $(this).parents('tr');
        bootbox.confirm("Are you sure?", function (result) {
            if (result) {
                $.ajax({
                    url: base_url + "index.php/user/delete_user/" + user_id,
                    type: "POST"
                }).done(function (msg) {
//            alert(msg);
                    if (msg == 'yes') {
                        noty({
                            text: "Deleted Successfully",
                            layout: 'topCenter',
                            type: "success",
                            theme: 'relax',
                            timeout: 3000,
                            animation: {
                                open: 'flipInX', // jQuery animate function property object
                                close: 'flipOutX', // jQuery animate function property object
                                speed: 500 // opening & closing animation speed
                            }
                        });

                        $(obj).remove();
                    }
                }).fail(function (jqXHR, textStatus) {
                    noty({
                        text: "Please try again",
                        layout: 'topCenter',
                        type: "error",
                        theme: 'relax',
                        timeout: 3000,
                        animation: {
                            open: 'flipInX', // jQuery animate function property object
                            close: 'flipOutX', // jQuery animate function property object
                            speed: 500 // opening & closing animation speed
                        }
                    });
                });

            }
            else {

            }
        });

    })

    $('#userlist_tabel').dataTable({
        "oLanguage": {
            "sProcessing": "<img src='" + base_url + "assets/img/ajax-loader.gif'>"},
        "ordering": false,
        "bProcessing": true,
        "bServerSide": true,
        "sAjaxSource": base_url + "index.php/user/user_list", "bDeferRender": true,
        "aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, $("#sAll").val()]],
        "sPaginationType": "full_numbers",
        "iDisplayLength": 10,
        "bDestroy": true, //!!!--- for remove data table warning.
        "aoColumnDefs": [
            {"aTargets": [0]},
            {"bSortable": true, "sClass": "aligncenter", "aTargets": [1]},
            {"sClass": "name aligncenter", "aTargets": [2]},
            {"sClass": "Email", "aTargets": [3]},
            {"sClass": "Dob", "aTargets": [4]},
            {"sClass": "Dob", "aTargets": [5]}
        ]}
    );

    $('.quantity').change(function () {
        var obj = $(this);
        var qua_val = $(this).val();
        var qua = $(this).attr('data-max');
        var def = $(this).attr('default-val');
        //alert(qua);
        if ($.isNumeric(qua_val))
        {
            if (qua_val < 0) {
                noty({
                    text: "Please enter a valid quantiy minimum is 1.",
                    layout: 'topCenter',
                    type: "error",
                    theme: 'relax',
                    timeout: 3000,
                    animation: {
                        open: 'flipInX', // jQuery animate function property object
                        close: 'flipOutX', // jQuery animate function property object
                        speed: 500 // opening & closing animation speed
                    }
                });
                $(obj).val(def);
                $(obj).trigger('change');
            }
            else {

                if (+qua_val > +qua)
                {
                    noty({
                        text: "This quantity is out of stock.",
                        layout: 'topCenter',
                        type: "error",
                        theme: 'relax',
                        timeout: 3000,
                        animation: {
                            open: 'flipInX', // jQuery animate function property object
                            close: 'flipOutX', // jQuery animate function property object
                            speed: 500 // opening & closing animation speed
                        }
                    });

                    $(obj).val(def);
                    $(obj).trigger('change');
                }
                else {

                    var total = ($(obj).parent().next().html().replace(',', '')) * ($(obj).val());

                    $(obj).parent().next().next().html($.number(total, 2));

                    var total = 0;
                    $('.midtotal').each(function () {
                        total += +$(this).html().replace(',', '');
                    });

                    $('.total').html($.number(total, 2));
                }
            }
        }
        else {
            noty({
                text: 'Please enter a number value',
                layout: 'topCenter',
                type: "error",
                theme: 'relax',
                timeout: 3000,
                animation: {
                    open: 'flipInX', // jQuery animate function property object
                    close: 'flipOutX', // jQuery animate function property object
                    speed: 500 // opening & closing animation speed
                }
            });
            $(obj).val(def);
            $(obj).trigger('change');
        }

    });

    $('body').on('change','.tax',function(){
       var tax = $(this).val();
       if(tax >= 0){

       }
        else{

       }

    });

    $('#sale_tabel').dataTable({
            "oLanguage": {
                "sProcessing": "<img src='" + base_url + "assets/img/ajax-loader.gif'>"},
            "ordering": false,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": base_url + "index.php/dashboard/sale_list", "bDeferRender": true,
            "aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, $("#sAll").val()]],
            "sPaginationType": "full_numbers",
            "iDisplayLength": 10,
            "bDestroy": true, //!!!--- for remove data table warning.
            "aoColumnDefs": [
                {"aTargets": [0]},
                {"bSortable": true, "sClass": "aligncenter", "aTargets": [0]},
                {"bSortable": true, "sClass": "aligncenter", "aTargets": [1]},
                {"sClass": "name aligncenter", "aTargets": [2]},
                {"sClass": "Email", "aTargets": [3]},
                {"sClass": "Dob", "aTargets": [4]},
                {"sClass": "Dob", "aTargets": [5]}
            ]}
    );
    $('#due_tabel').dataTable({
            "oLanguage": {
                "sProcessing": "<img src='" + base_url + "assets/img/ajax-loader.gif'>"},
            "ordering": false,
            "bProcessing": true,
            "bServerSide": true,
            "sAjaxSource": base_url + "index.php/dashboard/due_list", "bDeferRender": true,
            "aLengthMenu": [[10, 30, 50, 100, -1], [10, 30, 50, 100, $("#sAll").val()]],
            "sPaginationType": "full_numbers",
            "iDisplayLength": 10,
            "bDestroy": true, //!!!--- for remove data table warning.
            "aoColumnDefs": [
                {"aTargets": [0]},
                {"bSortable": true, "sClass": "aligncenter", "aTargets": [0]},
                {"bSortable": true, "sClass": "aligncenter", "aTargets": [1]},
                {"sClass": "name aligncenter", "aTargets": [2]},
                {"sClass": "Email", "aTargets": [3]},
                {"sClass": "Dob", "aTargets": [4]},
                {"sClass": "Dob", "aTargets": [5]}
            ]}
    );

    $('body').on('click','.pay',function(){


        $('#duemodal').modal('show');
        var id = $(this).attr('data-id');
        var pay = $(this).attr('data-pay');

        $('#duemodal').find("#invoice_no").val(id);
        $('#duemodal').find("#due").val(pay);
        $('#duemodal').find("#due").attr('final-amount',pay);



    });

    $('body').on('click','#addcart',function(){

        var pay =  $('#duemodal').find("#due").val().replace(",","");
        var finalpay =  $('#duemodal').find("#due").attr("final-amount");

        if($.isNumeric(pay)){

            if(pay <= finalpay){
                $('body').find("#duesub").trigger('click');
            }
            else{
                $('.error_due').text('Amount must less that or equal to '+finalpay);
            }

        }
        else{
            $('.error_due').html('Please enter valid amount.');
        }

    });
});

function printDiv() {
   $("#print_btn").trigger('click');
   //$("#sub").trigger('click');
    //var printContents = document.getElementById('print').innerHTML;
    //var divContents = $("#print").html();
    //var printWindow = window.open('', '', 'height=400,width=800');
    //printWindow.document.write('<html><head><title>Print</title>');
    //printWindow.document.write('</head><body >');
    //printWindow.document.write(divContents);
    //printWindow.document.write('</body></html>');
    //printWindow.document.close();
    //printWindow.print();
}