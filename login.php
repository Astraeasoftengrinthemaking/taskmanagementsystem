<!DOCTYPE html>
<html lang="en">
<?php 
session_start();
include('./db_connect.php');
ob_start();

$system = $conn->query("SELECT * FROM system_settings")->fetch_array();
foreach($system as $k => $v){
  $_SESSION['system'][$k] = $v;
}

ob_end_flush();
?>
<?php 
if(isset($_SESSION['login_id']))
  header("location:index.php?page=home");
?>
<?php include 'header.php' ?>
<style>
  body {
    background: linear-gradient(45deg, #ff6b6b, #3b82f6);
  }

  .login-box {
    background: rgba(255, 255, 255, 0.1);
    border: 1px solid rgba(255, 255, 255, 0.2);
    border-radius: 10px;
  }

  .login-card-body {
    background: rgba(255, 255, 255, 0.8);
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .login-logo a {
    color: #f87979; /* Pink color */
  }

  .btn-primary {
    background-color: #93c5fd; /* Blue color */
    border-color: #93c5fd;
  }

  .btn-primary:hover {
    background-color: #60a5fa; /* Lighter blue on hover */
    border-color: #60a5fa;
  }
</style>
<body class="hold-transition login-page bg-black">
  <div class="login-box">
    <div class="login-logo">
      <a href="#" class="text-white"><b><?php echo $_SESSION['system']['name'] ?></b></a>
    </div>
    <!-- /.login-logo -->
    <div class="card">
      <div class="card-body login-card-body">
        <form action="" id="login-form">
          <div class="input-group mb-3">
            <input type="email" class="form-control" name="email" required placeholder="Email">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-envelope"></span>
              </div>
            </div>
          </div>
          <div class="input-group mb-3">
            <input type="password" class="form-control" name="password" required placeholder="Password">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-lock"></span>
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-8">
              <div class="icheck-primary">
                <input type="checkbox" id="remember">
                <label for="remember">
                  Remember Me
                </label>
              </div>
            </div>
            <div class="col-4">
              <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
          </div>
        </form>
      </div>
      <!-- /.login-card-body -->
    </div>
  </div>
  <!-- /.login-box -->
  <script>
    $(document).ready(function(){
      $('#login-form').submit(function(e){
        e.preventDefault()
        start_load()
        if($(this).find('.alert-danger').length > 0 )
          $(this).find('.alert-danger').remove();
        $.ajax({
          url:'ajax.php?action=login',
          method:'POST',
          data:$(this).serialize(),
          error:err=>{
            console.log(err)
            end_load();
          },
          success:function(resp){
            if(resp == 1){
              location.href ='index.php?page=home';
            }else{
              $('#login-form').prepend('<div class="alert alert-danger">Username or password is incorrect.</div>')
              end_load();
            }
          }
        })
      })
    })
  </script>
  <?php include 'footer.php' ?>
</body>
</html>
