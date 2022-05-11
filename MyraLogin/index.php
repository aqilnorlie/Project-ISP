<!DOCTYPE html>
<?php
//ini_set('display_errors', 1);
//ini_set('display_startup_errors', 1);
//error_reporting(E_ALL);
include("connection.php");
include("function.php");

if(isset($_POST['submit']))
{
    $userid = trim($_POST['userid']);
    $password = trim($_POST['password']);
    
    // i-staff portal api
    $curl = curl_init();
    curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
    curl_setopt_array($curl, array(
      CURLOPT_PORT => "444",
      CURLOPT_URL => "https://integrasi.uitm.edu.my:444/stars/login/json/".$userid,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => "{\n\t\"password\": \"".$password."\"\n}",
      CURLOPT_HTTPHEADER => array(
        "cache-control: no-cache",
        "postman-token: a5f640ca-aedf-6572-f4ef-b6ae06cad9eb",
        "token: eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJ1c2VyIjoiY2xhc3Nib29raW5nIn0._dTe9KRNSHSBMybfC4Gs6Brv6vO2HxQ8CWp9lOtI0hk"
      ),
    ));

    $response = curl_exec($curl);
    $err = curl_error($curl);

    curl_close($curl);

    $json = json_decode($response, TRUE);
    
    if($json['status'] == "true")
    {  
        
        if(checkStaffLogin($dbh, $dbh3, $userid) == true) //look for this function in functions.php file

            header("Location: dashboard/index.php");
        else
           
            header("Location: login.php");
    }
    else if($json['status'] == "false")
    {
        header("Location: index.php?error");
    }
    // end i-staff portal api
}
?>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php browsertitle(); ?></title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link REL="SHORTCUT ICON" HREF="dist/img/sirs-icon-big.ico">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <style>
  body{
  padding:100px 0;
  background-color:#efefef
}
a, a:hover{
  color:#333
}
    </style>
    
    <script>
    function message()
        {
            alert("Student Involvement Report System (SIRS) will be temporarily closed on Wednesday, 7th July 2021 starts at 12:00 am until Wednesday, 7th July 2021 at 2:00 am for maintenance tasks. We are sorry for the inconvenience.");
        }
    </script>
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><b></b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        <p class="login-box-msg"><img src="dist/img/sirs-logo-big.png" width="250" height="130" align="center" />
            <br />Sign in using <b>UiTM i-Staff Portal</b> account to start your session</p>

      <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <div class="input-group mb-3">
          <input type="text" name="userid" class="form-control" placeholder="Staff No" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-key"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3" id="show_hide_password">
          <input type="password" name="password" class="form-control" placeholder="Password" required>
          <div class="input-group-append">
            <div class="input-group-text">
              <!--<span class="fas fa-lock"></span>-->
                <a href=""><i class="fas fa-eye" aria-hidden="true"></i></a>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <!--<input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>-->
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" name="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <div class="social-auth-links text-center mb-3">
        <p><a href="ptft/index.php">PTFT Login</a></p>  
        <!--<a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>-->
      </div>
      <!-- /.social-auth-links -->

      <p class="mb-1" align="center">
        SIRS Helpdesk
      </p>
      <p class="mb-0" align="center">
        sirsupport@uitm.edu.my
      </p>
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->
<!-- bootstrap alert modal -->
  <div class="modal fade" id="modal-error">
    <div class="modal-dialog">
      <div class="modal-content bg-warning">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Unable to log into the system. Please check your Staff No and Password.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <!-- /.bootstrap file alert modal -->
  <!-- bootstrap alert modal -->
  <div class="modal fade" id="modal-warning">
    <div class="modal-dialog">
      <div class="modal-content bg-warning">
        <div class="modal-header">
          <h4 class="modal-title">Warning</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Unable to log into the system. You are not authorized user.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>
  <div class="modal fade in" id="maintenance-modal">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Alert</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span></button>
        </div>
        <div class="modal-body">
          <p>Student Involvement Report (SIR) System will be temporarily closed on Friday, 27 August 2021 at 12:00 pm until 5:00 pm due to server maintenance. We will be back once the maintenance activities completely done. Sorry for the inconvenient.</p>
        </div>
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-light" data-dismiss="modal">Close</button>
        </div>
      </div>
      <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
  </div>  
  <!-- /.bootstrap upload alert modal -->
<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- page script -->
<?php if (isset($_GET['error'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-error").modal("show");
    });
    </script>
<?php } ?>
<?php if (isset($_GET['warning'])){ ?>
    <script type="text/javascript">
    $(document).ready(function(){
        $("#modal-warning").modal("show");
    });
    </script>
<?php } ?>
<script>
$(window).on('load', function() {
        $('#maintenance-modal').modal('show');
    });
$(document).ready(function() {
    $("#show_hide_password a").on('click', function(event) {
        event.preventDefault();
        if($('#show_hide_password input').attr("type") == "text"){
            $('#show_hide_password input').attr('type', 'password');
            $('#show_hide_password i').addClass( "fa-eye" );
            $('#show_hide_password i').removeClass( "fa-eye-slash" );
        }else if($('#show_hide_password input').attr("type") == "password"){
            $('#show_hide_password input').attr('type', 'text');
            $('#show_hide_password i').removeClass( "fa-eye" );
            $('#show_hide_password i').addClass( "fa-eye-slash" );
        }
    });
});    
</script>
</body>
</html>