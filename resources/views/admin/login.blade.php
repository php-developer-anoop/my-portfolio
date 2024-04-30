<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{$meta_title}}</title>
    <link rel="stylesheet" href="{{asset('assets/plugins/fontawesome-free/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/dist/css/adminlte.min.css')}}">
    <style> 
      .swal2-popup.swal2-toast .swal2-title {
      font-size: 15px;
      margin: 10px;
      color: #6c757d;
      }
    </style>
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="card card-outline card-primary">
        <div class="card-header text-center">
          <a href="{{url(ADMINPATH.'login')}}" class="h1"><b>Admin</b>LTE</a>
        </div>
        <div class="card-body">
          <p class="login-box-msg">Sign in to start your session</p>
          <form>
            <div class="input-group mb-3">
              <input type="email" class="form-control" id="email" placeholder="Email">
              <div class="input-group-append">
                <div class="input-group-text">
                  <span class="fas fa-envelope"></span>
                </div>
              </div>
            </div>
            <div class="input-group mb-3">
              <input type="password" class="form-control" id="password" placeholder="Password">
              <div class="input-group-append ">
                <div class="input-group-text" style="cursor:pointer">
                  <span class="fas fa-eye" id="showPassword" onclick="return showPassword()"></span>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-4"></div>
              <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block" id="submit" onclick="return validateLogin()">Sign In</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
    <script src="{{asset('assets/plugins/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('assets/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
    <script src="{{asset('assets/plugins/sweetalert2/sweetalert2.min.js')}}"></script>
    <script src="{{asset('assets/dist/js/adminlte.min.js')}}"></script>
    <script>
         var Toast = Swal.mixin({
      toast: true,
      position: 'top-end',
      showConfirmButton: false,
      timer: 3000
    });

    function validateLogin() {
      var email = $("#email").val().trim();
      var password = $("#password").val();
      if (email == "") {
        Toast.fire({
          icon: 'error',
          title: 'Enter Email'
        });
        return false;
      } else if (password == "") {
        Toast.fire({
          icon: 'error',
          title: 'Enter Password'
        });
        return false;
      } else {
        $.ajax({
          type: 'POST',
          url: '<?=url(ADMINPATH.'checkLogin')?>',
          headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          data: {
            'email': email,
            'password': password,
          },
          dataType: 'json',
          beforeSend: () => {
            $('#submit').text('Please Wait...');
            $('#submit').prop("disabled", true);
          },
          success: (res) => {
            //  alert(res.goto);
            if (res.status==true) {
              Toast.fire({
                icon: 'success',
                title: res.message
              })
              setTimeout(function() {
                window.location.href = '' + res.goto;
              }, 1000);
              $('#submit').text('Sign In');
              $('#submit').prop("disabled", false);
            } else {
              $('#submit').text('Sign In');
              $('#submit').prop("disabled", false);
              Toast.fire({
                icon: 'error',
                title: res.message
              })
            }
          }
        });
      }
    }

    function showPassword() {
    var passwordField = $('#password');
    var passwordFieldType = passwordField.attr('type');
    
    if (passwordFieldType == 'password') {
        passwordField.attr('type', 'text');
        $('#showPassword').removeClass('fa fa-eye-slash').addClass('fas fa-eye');
        
    } else {
        passwordField.attr('type', 'password');
        $('#showPassword').removeClass('fas fa-eye').addClass('fa fa-eye-slash');
    }
}

    </script>
  </body>
</html>