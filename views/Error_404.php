<?php 
  if(session_status() != PHP_SESSION_ACTIVE){
    session_start();
  }
  if(isset($_SESSION['SpamOTP'])){
    unset($_SESSION['SpamOTP']);
    echo "<div class='alert alert-warning alert-dismissible fade show' role='alert' data-bs-delay='5000'>
    <strong>Oops! : </strong>  Sorry, Too frequest Request 
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
  }
?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/error_404.css">
    <link rel="stylesheet" href="../src/css/login.css">
  </head>
  <body>
    <div class=" container error-outer">
        <div class="container error-main text-center">
            <h1>404 error, Sorry page not found!</h1>
                <h1 class="sad-face mt-5 ">:-(</h1>
            <h3>Go back to : <a href="/">Home</a></h3>
        </div>
    </div>
    <!-- Custom js -->
    <script src="../src/js/Alert.js"></script>

    <!-- Bootstrap js -->

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  </body>
</html>

