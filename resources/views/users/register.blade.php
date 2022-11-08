<!DOCTYPE html>
<!-- Created By CodingLab - www.codinglabweb.com -->
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <!---<title> Responsive Registration Form | CodingLab </title>--->
    <link rel="stylesheet" href="style.css">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="{{ asset('frontend/css/stylelogin.css') }}" type="text/css">

    </head>
<body> 
  <div class="container">
    <div class="title">Registration</div>
    <div class="content">
      @if (session('message'))
      <span style="color: red; font-size: 20px">
          {{ session('message') }}
      </span>
      @endif
      <form action="{{ route('addUser') }}" method="POST">
        @csrf
        <input type="text" placeholder="Enter your username" value="1" name="role" style="display: none">
        <input type="text" placeholder="Enter your username" value="1" name="status" style="display: none">
        <div class="user-details">
          <div class="input-box">
            <span class="details">Username</span>
            <input type="text" placeholder="Enter your username" name="name">
            <span class="alert alert-danger" style="color: red;">
              @if ($errors->has('name'))
                {{ $errors->first('name') }}
              @endif
            </span>
          </div>
          <div class="input-box">
            <span class="details">Email</span>
            <input type="email" placeholder="Enter your email" name="email">
            <span class="alert alert-danger" style="color: red;">
              @if ($errors->has('email'))
                {{ $errors->first('email') }}
              @endif
            </span>
          </div>
          {{-- <div class="input-box">
            <span class="details">Address</span>
            <input type="text" placeholder="Enter your address" name="address">
            <span class="alert alert-danger" style="color: red;">
              @if ($errors->has('address'))
                {{ $errors->first('address') }}
              @endif
            </span>
          </div> --}}
          {{-- <div class="input-box">
            <span class="details">Phone Number</span>
            <input type="password" placeholder="Enter your number" name="phone">
            <span class="alert alert-danger" style="color: red;">
              @if ($errors->has('phone'))
                {{ $errors->first('phone') }}
              @endif
            </span>
          </div> --}}
          <div class="input-box">
            <span class="details">Password</span>
            <input type="password" placeholder="Enter your password" name="password">
            <span class="alert alert-danger" style="color: red;">
              @if ($errors->has('password'))
                {{ $errors->first('password') }}
              @endif
            </span>
          </div>
          <div class="input-box">
            <span class="details">Confirm Password</span>
            <input type="password" placeholder="Confirm your password" name="password_confirmation">
          </div>
        </div>
        {{-- <div class="gender-details">
          <input type="radio" name="gender" id="dot-1" value="1">
          <input type="radio" name="gender" id="dot-2" value="2">
          <span class="gender-title">Gender</span>
          <div class="category">
            <label for="dot-1">
            <span class="dot one"></span>
            <span class="gender">Male</span>
          </label>
          <label for="dot-2">
            <span class="dot two"></span>
            <span class="gender">Female</span>
          </label>
          </div>
        </div> --}}
        <div class="button">
          <input type="submit" value="Register">
        </div>
      </form>
    </div>
    <div class="" style="font-size: 20px">
      <a class="btn" href="{{ route('user.login') }}">Login</a>
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
