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
    <div class="title">Reset Password</div>
    <div class="content">
      @if (session('message'))
      <span style="color: red; font-size: 20px">
          {{ session('message') }}
      </span>
      @endif
      <form action="{{ route('changepassword') }}" method="POST">
        @csrf
        @if ($token != '')
        <input type="text" placeholder="Enter your username" value="{{ $token }}" name="token" style="display: none">
        @endif

        <input type="text" placeholder="Enter your username" value="1" name="role" style="display: none">
        <input type="text" placeholder="Enter your username" value="1" name="status" style="display: none">
        <div class="user-details">
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
        <div class="button">
          <input type="submit" value="ResetPassWord">
        </div>
      </form>
    </div>
    <div class="" style="font-size: 20px">
      <a class="btn" href="{{ route('user.login') }}">Login</a>
    </div>
  </div>

</body>
</html>
