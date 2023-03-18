<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Bootstrap demo</title>
  <!-- Font awsome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <!-- Cusom css -->
  <link rel="stylesheet" href="../src/css/login.css">
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

          <div class="container-fluid upload-outer file-upload-main">
            <label for="profile-image" class=" custom-upload custom-file-upload"></label>
            <input id="profile-image" type="file" />
            <img id="preview-image" style="display: none;z-index:-1;width:100%;">
          </div>

        </div>
      </div>
      <!-- User details part -->

      <div class="container-fluid user-details text-center">
        <h3 class="mt-3"><input type="text" name="" id="" class="main-text" value="User Name" disabled><i
            class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></h3>
        <hr class="mt-0 mb-2">

        <div class="container-fluid user-details-main form p-0" style="padding-top:0;">
          <div class="container user-data"><input type="text" name="" id="" class="main-text" value="Hiren" placeholder="FirstName"
              disabled><i class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data"><input type="text" name="" id="" class="main-text" value="Panchal"placeholder="LastName"
              disabled><i class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data"><input type="text" name="" id="" class="main-text" value="panchalhirenm123@gmail.com" placeholder="Email"disabled><i
              class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data"><input type="text" name="" id="" class="main-text" value="8200465772"placeholder="Phone Number"
              disabled><i class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data ">
            <div class="container gen-buttons mt-3 p-0 d-flex items-center align-self-center justify-content-center">
              <label class="form-check-label text-white " for="flexRadioDefault2" >
                  Gender :&nbsp;
              </label>
              <div class="form-check">
                  <input class="form-check-input transp-button" type="radio" name="flexRadioDefault" id="Male" value="Female" checked>
                  <label class="form-check-label text-white" for="flexRadioDefault1" style="margin-right:16px">
                    Male
                  </label>
                </div>
                <div class="form-check">
                  <input class="form-check-input transp-button" type="radio" name="flexRadioDefault" id="Female" value="Female" >
                  <label class="form-check-label text-white" for="flexRadioDefault2">
                    Female
                  </label>
              </div>
          </div>
          </div>
          <div class="container user-data"><input type="text" name="" id="" class="main-text" value="Address"placeholder="Address"
              disabled><i class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data"><input type="date" name="" id="" class="main-text" value=""  disabled> <i
              class="fa fa-pencil-square-o enable_me" aria-hidden="true"></i></div>
          <div class="container user-data p-0">
            <div class="input__box m-0">
              <input type="submit" value="Password" />
            </div>
          </div>
          <div class="container user-data p-0">
            <div class="input__box m-0">
              <input type="submit" value="Save"  />
            </div>
          </div>

        </div>
      </div>
    </div>
  </section>
  <!-- Custom js -->
  <script src="../src/js/profile_ui.js"></script>
  <script src="../src/js//complete_profile.js"></script>
  <script src="../src/js/Alert.js"></script>

  <!-- Bootstrap js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN"
    crossorigin="anonymous"></script>
</body>

</html>