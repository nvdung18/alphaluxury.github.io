<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="{{ asset('frontend/css/bootstrap.min.css') }}" type="text/css">
     <link rel="stylesheet" href="{{ asset('frontend/css/font-awesome.min.css') }}" type="text/css">
     <link rel="stylesheet" href="{{ asset('frontend/css/elegant-icons.css') }}" type="text/css">
     <link rel="stylesheet" href="{{ asset('frontend/css/jquery-ui.min.css') }}" type="text/css">
     <link rel="stylesheet" href="{{ asset('frontend/css/magnific-popup.css') }}" type="text/css">
     <link rel="stylesheet" href="{{ asset('frontend/css/owl.carousel.min.css') }}" type="text/css">
     <link rel="stylesheet" href="{{ asset('frontend/css/slicknav.min.css') }}" type="text/css">
     <link rel="stylesheet" href="{{ asset('frontend/css/stylelogin.css') }}" type="text/css">
   </head>
   <style type="text/css">
  form .user-details .input-box {
    width: 100% !important;
}
  </style>
<body> 
  <div class="container">
    <div class="title">Forgot Password</div>
    <div class="content">
      <form action="{{ route('recover_pass') }}" method="POST">
        @csrf
        @if (session('message'))
        <span style="color: red; font-size: 20px">
            {{ session('message') }}
        </span>
        @endif
        <div class="user-details">
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your password" name="email">
            @if ($errors->has('email'))
            <span class="alert alert-danger" style="color: red;">
            {{ $errors->first('email') }}
            </span>
              @endif
          </div>
        </div>
        <div class="button">
          <input type="submit" value="Enter">
        </div>
      </form>
    </div>
  </div>
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
</body>
</html>
