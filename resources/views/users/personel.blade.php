<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="Ashion Template">
    <meta name="keywords" content="Ashion, unica, creative, html">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Personel Page</title>

    <!-- Google Font -->
    <link href="https://fonts.googleapis.com/css2?family=Cookie&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">

    <!-- Css Styles -->
    <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css') }}" type="text/css">

</head>

<body>

    @include('parts.pre_loader')

    @include('parts.off_canvas_menu')

    @include('parts.header')
    
    <div class="user_page">
        <div class="container">
            <div class="row">
                <ul class="menu col-lg-2">
                    <li class="menu_item" data-index="1">My Profile</li>
                    <li class="menu_item" data-index="2">My Order</li>
                    <li class="menu_item">Discount</li>
                </ul>
                <div class="form col-lg-10 active">
                    <label for="" class="label_form">
                        My Profile
                    </label>
                    <form>
                        <div class="form-group">
                            <label for="username">UserName</label>
                            <input type="text" class="form-control" id="username" placeholder="Enter User Name" name="username">
                          </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email" name="email">
                        </div>
                        <div class="form-group">
                            <label for="exampleAddress">Address</label>
                            <input type="text" class="form-control" id="exampleAddress" placeholder="Enter address" name="address">
                        </div>
                        <div class="form-group">
                          <label for="examplePhone">PhoneNumber</label>
                          <input type="text" class="form-control" id="examplePhone" placeholder="Enter Phone" name="phonenumber">
                        </div>
                        <div class="form-group">
                            <label for="gender">Gender</label>
                            <select class="form-control" name="gender" id="gender">
                                <option>Nam</option>
                                <option>Nữ</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary btn_form">Submit</button>
                      </form>
                </div>
                     <div class="order col-lg-10">
                        <div class="order-header">
                            <div class="order-header-items">
                                <div>
                                    <div class="uppercase font-bold">Order Placed</div>
                                    <div></div>
                                </div>
                                <div>
                                    <div class="uppercase font-bold">Order ID</div>
                                    <div></div>
                                </div><div>
                                    <div class="uppercase font-bold">Total</div>
                                    <div></div>
                                </div>
                            </div>
                            <div>
                                <div class="order-header-items">
                                    <div><a href="#">Order Details</a></div>
                                    <div>|</div>
                                    <div><a href="#">Invoice</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="order-products">
                                <div class="order-product-item">
                                    <div><img src="https://images.pexels.com/photos/19090/pexels-photo.jpg" alt="Product Image"></div>
                                    <div>   
                                        <div><a href="https://images.pexels.com/photos/19090/pexels-photo.jpg">Laptop1</a></div>
                                        <div>asdkajsdksad</div>
                                        <div>Quantity: </div>
                                    </div>
                                </div>    
                                <div class="order-product-item">
                                    <div><img src="https://images.pexels.com/photos/19090/pexels-photo.jpg" alt="Product Image"></div>
                                    <div>   
                                        <div><a href="https://images.pexels.com/photos/19090/pexels-photo.jpg">Laptop1</a></div>
                                        <div>asdkajsdksad</div>
                                        <div>Quantity: </div>
                                    </div>
                                </div>    
                                <div class="order-product-item">
                                    <div><img src="https://images.pexels.com/photos/19090/pexels-photo.jpg" alt="Product Image"></div>
                                    <div>   
                                        <div><a href="https://images.pexels.com/photos/19090/pexels-photo.jpg">Laptop1</a></div>
                                        <div>asdkajsdksad</div>
                                        <div>Quantity: </div>
                                    </div>
                                </div>    
                        </div>
                        <div class="order-header">
                            <div class="order-header-items">
                                <div>
                                    <div class="uppercase font-bold">Order Placed</div>
                                    <div></div>
                                </div>
                                <div>
                                    <div class="uppercase font-bold">Order ID</div>
                                    <div></div>
                                </div><div>
                                    <div class="uppercase font-bold">Total</div>
                                    <div></div>
                                </div>
                            </div>
                            <div>
                                <div class="order-header-items">
                                    <div><a href="#">Order Details</a></div>
                                    <div>|</div>
                                    <div><a href="#">Invoice</a></div>
                                </div>
                            </div>
                        </div>
                        <div class="order-products">
                                <div class="order-product-item">
                                    <div><img src="https://images.pexels.com/photos/19090/pexels-photo.jpg" alt="Product Image"></div>
                                    <div>   
                                        <div><a href="https://images.pexels.com/photos/19090/pexels-photo.jpg">Laptop1</a></div>
                                        <div>asdkajsdksad</div>
                                        <div>Quantity: </div>
                                    </div>
                                </div>    
                                <div class="order-product-item">
                                    <div><img src="https://images.pexels.com/photos/19090/pexels-photo.jpg" alt="Product Image"></div>
                                    <div>   
                                        <div><a href="https://images.pexels.com/photos/19090/pexels-photo.jpg">Laptop1</a></div>
                                        <div>asdkajsdksad</div>
                                        <div>Quantity: </div>
                                    </div>
                                </div>    
                                <div class="order-product-item">
                                    <div><img src="https://images.pexels.com/photos/19090/pexels-photo.jpg" alt="Product Image"></div>
                                    <div>   
                                        <div><a href="https://images.pexels.com/photos/19090/pexels-photo.jpg">Laptop1</a></div>
                                        <div>asdkajsdksad</div>
                                        <div>Quantity: </div>
                                    </div>
                                </div>    
                        </div>
                    </div>
            </div>
        </div>
    </div>

    @include('parts.footer')
    
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('frontend/js/mixitup.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/js/jquery.slicknav.js') }}"></script>
    <script src="{{ asset('frontend/js/owl.carousel.min.js ') }}"></script>
    <script src="{{ asset('frontend/js/jquery.nicescroll.min.js ') }}"></script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>
    <script type="text/javascript">     
        
        // const myform = document.querySelector('.form');
        // const myorder = document.querySelector('.order');
        
        // console.log(myform);
        // // console.log(myform,myorder);

        // function ReloadOrder() {
        //     myform.classList.remove('active');
        //     myorder.classList.add('active');
        //     console.log(1);
        // }
        // function ReloadProfile() {
        //     // myform.classList.add('active');
        //     myorder.classList.remove('active');
        //     console.log(2);
        // }

    </script>
</body>

</html>