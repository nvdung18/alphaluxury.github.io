{{-- Header Section Begin --}}
<header class="header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-3 col-lg-2">
                <div class="header__logo">
                    <a href="{{ route('home') }}"><img src="{{ asset('frontend/img/AlphaLogo.png') }}" alt=""></a>
                </div>
            </div>
            <div class="col-xl-6 col-lg-7">
                <nav class="header__menu">
                    <ul>
                        <li class="active"><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="#">Women's</a></li>
                        <li><a href="#">Men's</a></li>
                        <li><a href="#">Blog</a></li>
                        <li><a href="#">Contact</a></li>
                        <li class="dropdown">
                            <a href="#" id="branch">Branch</a>
                            <div class="dropdown-content">
                                <div class="row_content">
                                    <div class="column_content">
                                    <a href="#" class="column_a">Link 1</a>
                                    <a href="#" class="column_a">Link 2</a>
                                    <a href="#" class="column_a">Link 3</a>
                                    <a href="#" class="column_a">Link 1</a>
                                    <a href="#" class="column_a">Link 2</a>
                                    <a href="#" class="column_a">Link 3</a>
                                    </div>
                                    <div class="column_content">
                                    <a href="#" class="column_a">Link 1</a>
                                    <a href="#" class="column_a">mink 2</a>
                                    <a href="#" class="column_a">Link 3</a>
                                    <a href="#" class="column_a">Link 1</a>
                                    <a href="#" class="column_a">Link 2</a>
                                    <a href="#" class="column_a">Link 3</a>
                                    </div>
                                    <div class="column_content">
                                    <a href="#" class="column_a">Link 1</a>
                                    <a href="#" class="column_a">Link 2</a>
                                    <a href="#" class="column_a">Link 3</a>
                                    <a href="#" class="column_a">Link 1</a>
                                    <a href="#" class="column_a">Link 2</a>
                                    <a href="#" class="column_a">Link 3</a>
                                    </div>
                                    <div class="column_content">
                                    <a href="#" class="column_a">Link 1</a>
                                    <a href="#" class="column_a">Link 2</a>
                                    <a href="#" class="column_a">Link 3</a>
                                    <a href="#" class="column_a">Link 1</a>
                                    <a href="#" class="column_a">Link 2</a>
                                    <a href="#" class="column_a">Link 3</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </nav>
            </div>
            {{-- <div class="dropdown-content" id="dropdownid">
                <div class="row_content">
                    <div class="column_content">
                    <a href="#" class="column_a">Link 1</a>
                    <a href="#" class="column_a">Link 2</a>
                    <a href="#" class="column_a">Link 3</a>
                    <a href="#" class="column_a">Link 1</a>
                    <a href="#" class="column_a">Link 2</a>
                    <a href="#" class="column_a">Link 3</a>
                    </div>
                    <div class="column_content">
                    <a href="#" class="column_a">Link 1</a>
                    <a href="#" class="column_a">mink 2</a>
                    <a href="#" class="column_a">Link 3</a>
                    <a href="#" class="column_a">Link 1</a>
                    <a href="#" class="column_a">Link 2</a>
                    <a href="#" class="column_a">Link 3</a>
                    </div>
                    <div class="column_content">
                    <a href="#" class="column_a">Link 1</a>
                    <a href="#" class="column_a">Link 2</a>
                    <a href="#" class="column_a">Link 3</a>
                    <a href="#" class="column_a">Link 1</a>
                    <a href="#" class="column_a">Link 2</a>
                    <a href="#" class="column_a">Link 3</a>
                    </div>
                    <div class="column_content">
                    <a href="#" class="column_a">Link 1</a>
                    <a href="#" class="column_a">Link 2</a>
                    <a href="#" class="column_a">Link 3</a>
                    <a href="#" class="column_a">Link 1</a>
                    <a href="#" class="column_a">Link 2</a>
                    <a href="#" class="column_a">Link 3</a>
                    </div>
                </div>
            </div> --}}
            <div class="col-lg-3">
                <div class="header__right">
                    <div class="header__right__auth">
                        <a href="#">Login</a>
                        <a href="#">Register</a>
                    </div>
                    <ul class="header__right__widget">
                        <li><span class="icon_search search-switch"></span></li>
                        <li><a href="#"><span class="icon_bag_alt"></span>
                                <div class="tip">2</div>
                            </a></li>
                        <li><a href="#"><span class="icon_bag_alt"></span>
                                <div class="tip">2</div>
                            </a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="canvas__open">
            <i class="fa fa-bars"></i>
        </div>
    </div>
    <script>
        // function addMenu() {
        //     var menu = document.querySelector('.dropdown-content');
        //     console.log("add Menu");
        //     menu.style.display = 'block';
        // } 
        // function removeMenu() {
        //     var menu = document.getElementById('dropdownid');
        //     var menuitem = document.getElementByC
        //     console.log("remove menu");
        //     // menu.style.display = 'none';
        // }
        // document.getElementById("branch").onmouseover = function() {addMenu()};
        // document.getElementById("dropdownid").onmouseout = function() {removeMenu()};
    </script>
</header>
{{-- Header Section End --}}