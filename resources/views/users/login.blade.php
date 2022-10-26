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
<body> 
  <div class="container">
    <div class="title">Login</div>
    <div class="content">
      @if (session('message'))
        <span style="color: red; font-size: 20px">
            {{ session('message') }}
        </span>
        @endif
      <form action="{{ route('user.checklogin') }}" method="POST">
        @csrf
        <div class="user-details">
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="nameUser">
              @if ($errors->has('name'))
              <span class="alert alert-danger" style="color: red;">
                {{ $errors->first('name') }}
              </span>
              @endif
          </div>
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="password">
            @if ($errors->has('password'))
            <span class="alert alert-danger" style="color: red;">
                {{ $errors->first('password') }}

              </span>
              @endif
          </div>
          <div>
            <a href="{{ route('forgotpassword') }}" style="font-size: 16px; color: red;">Forgot Password?</a>
        </div>
        </div>
        <div class="button">
          <input type="submit" value="Login">
        </div>
        <div>
            <a href="{{ route('register') }}" style="font-size: 20px">Register</a>
        </div>
      </form>
    </div>
  </div>

</body>
</html>
