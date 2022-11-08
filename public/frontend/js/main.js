/*  ---------------------------------------------------
Template Name: Ashion
Description: Ashion ecommerce template
Author: Colorib
Author URI: https://colorlib.com/
Version: 1.0
Created: Colorib
---------------------------------------------------------  */

'use strict';

(function ($) {
    
    $(window).on('load', function () {
        /*------------------
        Preloader
        --------------------*/
        // $.ajaxSetup({
        //     headers: {
        //       'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });

        $(".loader").fadeOut();
        $("#preloder").delay(200).fadeOut("slow");

        /*------------------
            Product filter
        --------------------*/
        $('.filter__controls li').on('click', function () {
            $('.filter__controls li').removeClass('active');
            $(this).addClass('active');
        });
        if ($('.property__gallery').length > 0) {
            var containerEl = document.querySelector('.property__gallery');
            // console.log(containerEl);
            var mixer = mixitup(containerEl);
            // console.log(mixer);
        }
    });

    /*------------------
        Background Set
    --------------------*/
    $('.set-bg').each(function () {
        var bg = $(this).data('setbg');
        $(this).css('background-image', 'url(' + bg + ')');
    });

    /*------------------
        Navigation
    --------------------*/
    $(".header__menu").slicknav({
        prependTo: '#mobile-menu-wrap',
        allowParentLinks: true
    });

    /*------------------
        Accordin Active
    --------------------*/
    $('.collapse').on('shown.bs.collapse', function () {
        $(this).prev().addClass('active');
    });

    $('.collapse').on('hidden.bs.collapse', function () {
        $(this).prev().removeClass('active');
    });

    /*--------------------------
        Banner Slider
    ----------------------------*/
    $(".banner__slider").owlCarousel({
        loop: true,
        margin: 0,
        items: 1,
        dots: true,
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: true
    });

    /*-------------------
        Range Slider
    --------------------- */
    var rangeSlider = $(".price-range"),
        minamount = $("#minamount"),
        maxamount = $("#maxamount"),
        minPrice = rangeSlider.data('min'),
        maxPrice = rangeSlider.data('max');
    rangeSlider.slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        values: [minPrice, maxPrice],
        slide: function (event, ui) {
            minamount.val('$' + ui.values[0]);
            maxamount.val('$' + ui.values[1]);
        }
    });
    minamount.val('$' + rangeSlider.slider("values", 0));
    maxamount.val('$' + rangeSlider.slider("values", 1));

    /*--------------------------
        Product Details Slider
    ----------------------------*/
    $(".product__details__pic__slider").owlCarousel({
        loop: false,
        margin: 0,
        items: 1,
        dots: false,
        nav: true,
        navText: ["<i class='arrow_carrot-left'></i>", "<i class='arrow_carrot-right'></i>"],
        smartSpeed: 1200,
        autoHeight: false,
        autoplay: false,
        mouseDrag: false,
        startPosition: 'URLHash'
    }).on('changed.owl.carousel', function (event) {
        var indexNum = event.item.index + 1;
        product_thumbs(indexNum);
    });

    function product_thumbs(num) {
        var thumbs = document.querySelectorAll('.product__thumb a');
        thumbs.forEach(function (e) {
            e.classList.remove("active");
            if (e.hash.split("-")[1] == num) {
                e.classList.add("active");
            }
        })
    }

    /*------------------
        Single Product
    --------------------*/
    $('.product__thumb .pt').on('click', function () {
        var imgurl = $(this).data('imgbigurl');
        var bigImg = $('.product__big__img').attr('src');
        if (imgurl != bigImg) {
            $('.product__big__img').attr({ src: imgurl });
        }
    });

    /*-------------------
        Quantity change
    --------------------- */
    //Canvas Menu
    
    
    // var proQty = $('.pro-qty');
    // // proQty.prepend('<span class="dec qtybtn">-</span>');
    // // proQty.append('<span class="inc qtybtn">+</span>');
    // proQty.on('click', '.qtybtn', function () {
    //     var $button = $(this);
    //     var oldValue = $button.parent().find('input').val();
    //     if ($button.hasClass('inc')) {
    //         var newVal = parseFloat(oldValue) + 1;
    //     } else {
    //         // Don't allow decrementing below zero
    //         if (oldValue > 0) {
    //             var newVal = parseFloat(oldValue) - 1;
    //         } else {
    //             newVal = 0;
    //         }
    //     }
    //     $button.parent().find('input').val(newVal);
    // });

        $(".canvas__open").on('click', function () {
        $(".offcanvas-menu-wrapper").addClass("active");
        $(".offcanvas-menu-overlay").addClass("active");
    });

    $(".offcanvas-menu-overlay, .offcanvas__close").on('click', function () {
        $(".offcanvas-menu-wrapper").removeClass("active");
        $(".offcanvas-menu-overlay").removeClass("active");
    });

    // dropdowm scrollbar
    const selectedBranch = document.querySelector(".selected-branch");
    const optionsContainerBranch = document.querySelector(".options-container-branch");

    const optionsListBranch = document.querySelectorAll(".option-branch");
    
    if(selectedBranch) {
        selectedBranch.addEventListener("click", () => {
                optionsContainerBranch.classList.toggle("active");
        });

    }

    optionsListBranch.forEach(o => {
        o.addEventListener("click", () => {
            selectedBranch.innerHTML = o.querySelector("a").innerHTML;
            optionsContainerBranch.classList.remove("active");
        });
    });

    const selectedPrice = document.querySelector(".selected-price");
    const optionsContainerPrice = document.querySelector(".options-container-price");

    const optionsListPrice = document.querySelectorAll(".option-price");
    
    if(selectedPrice) {
        selectedPrice.addEventListener("click", () => {
            optionsContainerPrice.classList.toggle("active");
        });
    }

    optionsListPrice.forEach(o => {
        o.addEventListener("click", () => {
            selectedPrice.innerHTML = o.querySelector("label").innerHTML;
            optionsContainerPrice.classList.remove("active");
        });
    });

    const selected = document.querySelector(".selected");
    const optionsContainer = document.querySelector(".options-container");

    const optionsList = document.querySelectorAll(".option");
    
    if(selected) {
        selected.addEventListener("click", () => {
        optionsContainer.classList.toggle("active");
        });
    }
    
    // optionsList.forEach(o => {
    //     o.addEventListener("click", () => {
    //     // selected.innerHTML = o.querySelector("label").innerHTML;
    //     // optionsContainer.classList.remove("active");
    //     });
    // });
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $('.menu_item').on('click',function() {
       const checkindex = $(this).attr('data-index');
       const selected = $(this);
    //    console.log($(this).navText);
       var tag = 1;
       if(checkindex == 1) {
        $('.order').removeClass('active');
        $('.changepassword').removeClass('active');
        $('.form').addClass('active');
        $("[data-index=1]").addClass('active');
        $("[data-index=2]").removeClass('active');
        $("[data-index=3]").removeClass('active');

            } else if(checkindex == 2) {
                $('.order').addClass('active');
                $('.changepassword').removeClass('active');
                $('.form').removeClass('active');
                $("[data-index=2]").addClass('active');
                $("[data-index=1]").removeClass('active');
                $("[data-index=3]").removeClass('active');

            } else if(checkindex == 3) {
                $('.changepassword').addClass('active');
                $('.order').removeClass('active');
                $('.form').removeClass('active');
                $("[data-index=2]").removeClass('active');
                $("[data-index=1]").removeClass('active');
                $("[data-index=3]").addClass('active');

            }
        });
    

        $(".btn-cart").on('click',function(e){
            //etc
            e.preventDefault(); 
            console.log(1);
            var quantity = 1;
            const getquantity = $('input[name=quantity]');
            console.log(getquantity);
            if(getquantity.length != 0 || typeof quantity === "undefined") {
                if($('input[name=quantity]').val() !== 1) {
                    quantity = $('input[name=quantity]').val();
                    console.log(quantity, 'interface');
                }
            }
            var idProduct = $(this).attr('idproduct');
            var url = $(this).attr('data-url');
            console.log(idProduct, url);
            // console.log('success');
            // console.log(url);
            // console.log(idProduct);
            // swal({
            //     title: "Added",
            //     text: "Please check you cart",
            //     icon: "success",
            //     button: "Close!",
            // });   
            jQuery.ajax({
                url: url,
                type: "POST",
                data: {
                    // '_token' : '{{ csrf_token() }}',
                    "quantity": quantity,
                    "idProduct": idProduct
                },
                dataType: "json",
                success: function(data) {
                    console.log(data);
                    if(data['text'] != '') {
                        swal({
                           title: "Added",
                           text: data['text'],
                           icon: data['icon'],
                           button: "Close!",
                       });  
                       fetch_data();
                       fetch_data_cart_in_cart();   
                    }
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    window.location.assign('http://127.0.0.1:8000/login');
                }
            });
        });
    
        function number_format (number, decimals, dec_point, thousands_sep) {
            // Strip all characters but numerical ones.
            number = (number + '').replace(/[^0-9+\-Ee.]/g, '');
            var n = !isFinite(+number) ? 0 : +number,
                prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
                sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
                dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
                s = '',
                toFixedFix = function (n, prec) {
                    var k = Math.pow(10, prec);
                    return '' + Math.round(n * k) / k;
                };
            // Fix for IE parseFloat(0.55).toFixed(0) = 0;
            s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
            if (s[0].length > 3) {
                s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
            }
            if ((s[1] || '').length < prec) {
                s[1] = s[1] || '';
                s[1] += new Array(prec - s[1].length + 1).join('0');
            }
            return s.join(dec);
        }
        
        // $('.delete').on('click', function(e){
        //    e.preventDefault();
        //    console.log('vao dc r');
        //    var idproduct = $(this).attr('idproduct');
        //    var idcart = $(this).attr('idcart');
        //    deletecart(idproduct, idcart);
        //    fetch_data_cart_in_cart();
        //    fetch_data();
        // });
        
        fetch_data_cart_in_cart();
        fetch_data();

        function fetch_data_cart_in_cart() {
           $.ajax({
             type: 'POST',
             url: 'http://127.0.0.1:8000/cart/check_cart',
             dataType: 'json',
             success: function(data) {
                console.log(data);
                const checkdata = $.isEmptyObject(data);
                if(checkdata != true) {
                    var itemproduct = ``;
                    for (let index = 0; index < data.length; index++) {
                        itemproduct += `
                        <tr>
                        <td class="cart__product__item">
                            <img src="http://127.0.0.1:8000/frontend/img/product/${data[index].image}" alt="" style="width: 50px; height: 50px;">
                            <div class="cart__product__item__title">
                                <h6> ${data[index].nameProduct}</h6>
                                <div class="rating">
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                    <i class="fa fa-star"></i>
                                </div>
                            </div>
                        </td>
                        <td class="cart__price">${number_format(data[index].price, 0, '.', '.')}</td>
                        <td class="cart__quantity">
                            <div class="pro-qty">
                                <span class="dec qtybtn">-</span>
                                <input name="quantity" type="text" value="${data[index].quantity}" min="1" idProduct="${data[index].idProduct}" idCart="${data[index].idCart}">
                                <span class="inc qtybtn">+</span>
                            </div>
                        </td>
                        <td class="cart__total">${number_format(data[index].price * data[index].quantity, 0, '.', '.')}</td>
                        <td class="cart__close"><span class="icon_close delete" idProduct="${data[index].idProduct}" idCart="${data[index].idCart}"></span></td>
                    </tr>
                        `; 
                    }
                    $('.table-body').html(itemproduct);
                    $('.tip').text(data.length);
                    // const paremeter = document.createRange().createContextualFragment(itemproduct);
                    // document.getElementsByClassName('table-body')[0].appendChild(paremeter);
                    // $("#someparentelement").on("mousedown", "div.window", function() {
                    //     // your code here
                    // });
                    // proQty = $('.pro-qty');
                    // deleteproduct = $('.delete');
                    // proQty = $('.pro-qty');
                    // deleteproduct = $('.delete');
                    // registerEvents(proQty, deleteproduct);
                } else if(checkdata == true){
                    $('.table-body').html('');
                    $('.tip').text('0');
                }
             }
           });
        }
        
        function fetch_data() {
            $.ajax({
                type: 'POST',
                url: "http://127.0.0.1:8000/cart/check_cart",
                dataType: "json",
                success:function(data) {
                    console.log(data);
                    const check = $.isEmptyObject(data);
                    if(check != true) {
                        var sum = ``;
                        for (let index = 0; index < data.length; index++) {
                            sum += `
                            <li class="header__cart-item">
                                <img src="http://127.0.0.1:8000/frontend/img/product/${data[index].image}" alt="" class="header__cart-img">
                                <div class="header__cart-item-info">
                                    <div class="header__cart-item-head">
                                    <h5 class="header__cart-item-name">
                                    ${data[index].nameProduct}
                                    </h5>
                                    <div class="header__cart-item-price-wrap">
                                    <span class="header__cart-item-price">${number_format(data[index].price, 0, '.', '.')}</span>
                                            <span class="header__cart-item-multiply">x</span>
                                            <span class="header__cart-item-qnt">${data[index].quantity}</span>
                                            </div>
                                            </div>
                                            <div class="header__cart-item-body">
                                            <span class="header__cart-item-description">
                                            Branch: ${data[index].nameTrademark}
                                            </span>
                                            <span class="header__cart-item-remove btn-delete delete" idProduct=${data[index].idProduct} idCart=${data[index].idCart}>
                                            Xóa
                                            </span>
                                            </div>
                                            </div>
                                            </li>`;
                                        }
                                    //    const para = document.createRange().createContextualFragment(sum);
                                    //    document.getElementsByClassName('header_list')[0].appendChild(para);
                                       $('.header__cart-list-item').html(sum);
                                       $('.tip').text(data.length);

                    } else {
                        $('.header__cart-list-item').html('');
                        $('.tip').text('0');
                        console.log(data);
                    }
                                    // deleteproduct = $('.delete');
                                    // registerEventsHeader(deleteproduct);
                                    // proQty = $('.pro-qty');
                                    // deleteproduct = $('.delete');
                }
            })
        }
         
        // setInterval(function(){
        //     proQty = $('.pro-qty');
        //     deleteproduct = $('.delete');
        // }, 500);

        // registerEvents(proQty, deleteproduct);
        // registerEventsHeader(deleteproduct);
        
        // function registerEventsHeader(deleteproduct) {
            // proQty.prepend('<span class="dec qtybtn">-</span>');
            // proQty.append('<span class="inc qtybtn">+</span>');
            // deleteproduct.on('click', function(e){
            //     e.preventDefault();
            //     console.log('header')
            //     var idproduct = $(this).attr('idproduct');
            //     var idcart = $(this).attr('idcart');
            //     deletecart(idproduct, idcart);
            //  });
        // }

        // function registerEvents(proQty, deleteproduct) {
            // proQty.prepend('<span class="dec qtybtn">-</span>');
            // proQty.append('<span class="inc qtybtn">+</span>');
            // var arr = [];

            // const proQty = $('.pro-qty');
            // const deleteproduct = $('.header__cart-item-body');

            $('body').on('click', '.delete' ,function(){
                // e.preventDefault();
                console.log('deleteproduct');
                var idproduct = $(this).attr('idproduct');
                console.log(idproduct);
                var idcart = $(this).attr('idcart');
                deletecart(idproduct, idcart);
             });

             $('body').on('click', '.qtybtn', function() {
                // e.preventDefault();
                var $button = $(this);
                var oldValue = $button.parent().find('input').val();
                if ($button.hasClass('inc')) {
                    var newVal = parseFloat(oldValue) + 1;
                } else {
                    // Don't allow decrementing below zero
                    if (oldValue > 0) {
                        var newVal = parseFloat(oldValue) - 1;
                    } else {
                        newVal = 0;
                    }
                }
                $button.parent().find('input').val(newVal);
                const quantity = $button.parent().find('input').val();
                const idProduct = $button.parent().find('input').attr('idProduct');
                const idCart = $button.parent().find('input').attr('idCart');
                console.log(quantity, idProduct, idCart);
                if(typeof idProduct !== "undefined" &&typeof idCart !== "undefined") {
                    // console.log('da o trong');
                    // arr = [quantity, idProduct, idCart];
                    // if($.isEmptyObject(arr) != true) {
                        updatecart(quantity, idProduct, idCart);
                    // }
                }
            });
        // }

        function updatecart(quantity, idProduct, idCart) {
            $.ajax({
                type: 'POST',
                url: 'http://127.0.0.1:8000/cart/update_cart',
                data: {
                    'quantity': quantity,
                    'idProduct': idProduct,
                    'idCart': idCart
                },
                dataType: 'json',
                success: function(data) {
                    if(data != '') {
                        console.log('success');
                        fetch_data_cart_in_cart()
                        fetch_data();
                    } else {
                        console.log('fail');
                    }
                }
            })
        }

        function deletecart(idproduct, idcart) {
            $.ajax({
                type: 'POST',
                url: 'http://127.0.0.1:8000/cart/delete_cart',
                data: {
                    'idProduct': idproduct,
                    'idCart': idcart
                },
                dataType: 'json',
                success: function(data) {
                    if(data != '') {
                        console.log('success');
                        fetch_data_cart_in_cart()
                        fetch_data();
                    } else {
                        console.log('fail');
                    }
                } 
            })
        }
})(jQuery);