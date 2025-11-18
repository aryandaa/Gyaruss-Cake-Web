<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="../Asset/fonts/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-...isi hash-nya..." crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../Asset/css/style.css">
    <link rel="stylesheet" href="../Asset/fonts/font.css">
    <style>
      h3 {
      color: #2B143B !important; 
      background: none !important;
      /* text-shadow: 3px 3px 2px rgba(0, 0, 0, 0.5); */
      }
      .plc::-webkit-input-placeholder{
      color: white;
      }
    </style>
    <title>Login Admin</title>
  </head>
  <body>
  
  <div class="content">
    <div class="container">
      <div class="row">
        
        <div class="col-md-6 contents">
          <div class="row justify-content-center">

            <div class="col-md-5 mb-5 ">
          <img src="../Asset/images/logo gyarus.png" alt="Image" class="img-fluid">
            </div>
            
            <div class="col-md-8 border p-4" style="box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2); border-radius: 25px;">

              <div class="mb-4 text-center text-dark ">
              <h3>Login Admin</h3>
              </div>

            <form action="login.php" method="post">
              <?php
              session_start();
              $_SESSION['token'] = bin2hex(random_bytes(32));
              ?>

              <div class="form-group first mb-2 border border-2 rounded-pill" style="background-color: #D1C9D7; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);" >
                <label for="username"></label>
                <input type="text" class="form-control plc bg-transparent" id="username" name="username" placeholder="Masukan Username">
              </div>

              <div class="mb-3">
              <div class="form-group mb-3 m last border border-2 rounded-pill" style="background-color: #D1C9D7; box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);">
                <label for="password"></label>
                <input type="password" class="form-control plc bg-transparent" id="password" name="password" placeholder="Masukan Password">
              </div>

              <div class="mb-4 ms-3">
                <input type="checkbox" onclick="showHide()"> Tampilkan Password
              </div>
              </div>

              <div class="text-center md-4">
              <input type="submit" value="Login" class="btn btn-block rounded-pill text-white" style="background-color: #2B143B;">
              </div>
            </form>
            </div>

          </div>
        </div>

        <div class="col-md-6 d-none d-lg-block">
          <img src="../Asset/images/icon2.png" alt="Image" class="img-fluid ">
        </div>

      </div>
    </div>
  </div>
<script src="../Asset/js/script.js"></script>
  </body>
</html>