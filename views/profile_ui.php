<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <link rel="shortcut icon" type="image/png" href="../favicon-16x16.png" sizes="16x16">
  <!-- Font awsome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Cusom css -->
  <link rel="stylesheet" href="../src/css/login.css">
  <link rel="stylesheet" href="../src/css/confirmbox.css">
  <link rel="stylesheet" href="../src/css/reg.css">
  <link rel="stylesheet" href="../src/css/create_profile.css">
  <link rel="stylesheet" href="../src/css/profile.css">
</head>
<style>
.custom-upload{
  position: absolute;
  width: 100%;
  height: 100%;
  background-color: transparent;
}
body{
  overflow: visible;
  height: 100vh;
}
</style>

<body>
  <form id="profile_form">
  <section>


    <div class="box">
      <div class="square" style="--i: 0"></div>
            <div class="square" style="--i: 1"></div>
            <div class="square" style="--i: 2"></div>
            <div class="square" style="--i: 3"></div>
            <div class="square" style="--i: 4"></div>
    </div>
    <!-- Profile picture part -->
    <div class="card-main pro-card ">
      
      <div class="container-fluid img-outer">
        <div class="circle">

          <div class="container-fluid upload-outer file-upload-main "style="z-index:9999999;">
            <label for="profile-image" class=" custom-upload custom-file-upload" ></label>
            <input id="profile-image" type="file"  value="img" name="img"/>
            <img id="preview-image" style="z-index:-1;width:100%;" src="blob:http://localhost:8080/7869afb9-788c-4407-b54e-ff9de6819be2">
          </div>

        </div>
      </div>
      <!-- User details part -->

      <div class="container-fluid user-details text-center">
        <h3 class="mt-3"><input type="text" name="UserName" id="" class="main-text " value="UserName" disabled><i
            class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></h3>
        <hr class="mt-0 mb-2">

        <div class="container-fluid user-details-main form p-0" style="padding-top:0;">
          <div class="container user-data"><input type="text" name="FirstName" id="" class="main-text " value="FirstName" placeholder=""
              disabled><i class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data"><input type="text" name="LastName" id="" class="main-text " value="LastName"placeholder=""
              disabled><i class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data"><input type="text" name="Email" id="" class="main-text disabled" value="Email" placeholder=""disabled></div>
          <div class="container user-data"><input type="text" name="MobileNumber" id="" class="main-text " value="MobileNumber"placeholder=""
              disabled><i class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data ">
            <div class="container gen-buttons mt-3 p-0 d-flex items-center align-self-center justify-content-center">
              <label class="form-check-label text-white " for="flexRadioDefault2" >
                  Gender :&nbsp;
              </label>
              <div class="form-check">
                  <input class="form-check-input transp-button" type="radio" name="flexRadioDefault" id="Male" value="MALE" >
                  <label class="form-check-label text-white" for="flexRadioDefault1" style="margin-right:16px">
                    Male
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input transp-button" type="radio" name="flexRadioDefault" id="Female" value="FEMALE" >
                  <label class="form-check-label text-white" for="flexRadioDefault2">
                    Female
                  </label>
              </div>
          </div>
          </div>
          <div class="container user-data"><input type="text" name="UserAddress" id="" class="main-text " value="UserAddress"placeholder="UserAddress"
              disabled><i class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data"><input type="date" name="Dob" id="pdob" class="main-text " value="Dob"  disabled> <i
              class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data p-0">
            <div class="input__box m-0">
              <input type="submit"class="homebtn" value="Home" />
            </div>
          </div>
          <div class="container user-data p-0">
            <div class="input__box m-0">
              <input type="submit" value="Save" id="psb" />
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
</form>
<script>
  document.querySelector('.homebtn').addEventListener('click', (e)=>{
    e.preventDefault();

    window.location.href = '/';
  })
</script>
  <!-- Moment -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>

  <!-- Jquery -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

  <!-- Axios -->
  <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
  <!-- Custom js -->
  <script src="../src/js/Alert.js"></script>
  <script src="../src/js/confirmbox.js"></script>
  <script src="../src/js/profile_ui.js"></script>
  <script src="../src/js/input_validation_user_data.js"></script>
  <script src="../src/js/complete_profile.js"></script>   
  <script src="../src/js/profile_update.js"></script>   

  <!-- Bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>