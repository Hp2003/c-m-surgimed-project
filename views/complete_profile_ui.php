<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="shortcut icon" type="image/png" href="../favicon-16x16.png" sizes="16x16">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/login.css">
    <link rel="stylesheet" href="../src/css/create_profile.css">
    <link rel="stylesheet" href="../src/css/alert_box.css">
</head>
<body>


    <section>
        <!-- <div class="colour"></div>
        <div class="colour"></div>
        <div class="colour"></div> -->
        <div class="box">
            <div class="square" style="--i: 0"></div>
            <div class="square" style="--i: 1"></div>
            <div class="square" style="--i: 2"></div>
            <div class="square" style="--i: 3"></div>
            <div class="square" style="--i: 4"></div>
                <div class="card-main">
                    <div class="form">
                        <h2>Complete Profile </h2>
                        <form  id="completeProfile">
                            <!-- Profile image -->
                            <div class="container-fluid upload-outer file-upload-main" >
                                <label for="profile-image" class=" custom-upload custom-file-upload"  >
                                     Click or drag image here
                                </label>
                                  <input id="profile-image" type="file" />  
                                  <img id="preview-image" style="display: none;z-index:-1;">                                
                            </div>
                            <!-- User name -->
                            <div class="input__box">
                                <input type="text" placeholder="User Name" name="userName" class="Uname"/>
                            </div>
                            <!-- Mobile -->
                            <div class="input__box">
                                <input type="text" placeholder="Mobile Number" name="mobile" class="mobile"/>
                            </div>
                            <!-- Default  button -->
                            <!-- <div class="container">
                                <div class="form-check mt-2">
                                    <input class="form-check-input transp" type="checkbox" value="default" id="flexCheckDefault" name="UseDefault" class="default">
                                    <label class="form-check-label" for="flexCheckDefault">
                                      Use real name
                                    </label>
                                </div>
                            </div> -->
                            <!-- Address box -->
                            <div class="input__box">
                                <textarea type="text" placeholder="Address" name="Address"></textarea>
                            </div>
                            <!-- Buttons -->
                            <div class="container-fluid d-flex ">
                                <!-- <div class="input__box">
                                    <input type="submit" value="Skip" class="skip_profile"/>
                                </div> -->
                                <div class="input__box">
                                    <input type="submit" value="Create" class="create_profile_btn"/>
                                </div>
                            </div>

                        </form>
                    </div>
            </div>
            
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/json3/3.3.2/json3.min.js"></script>
    
    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Custom Js -->
    <script src="../src/js/Alert.js"></script>
    <script src="../src/js/complete_profile.js"></script>
    <!-- <script src="../src/js/input_validation_user_data.js"></script> -->
    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>