<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- MDB -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/mdb.min.css">
    <link rel="stylesheet" href="node_modules/mdbootstrap/css/style.css">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/login.css">
    <link rel="stylesheet" href="../src/css/reg.css">
    <link rel="stylesheet" href="../src/css/popover.css">
</head>
<style>
    body{
        overflow:visible;
    }
</style>
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
                        <h2>Register..</h2>
                        <form  id="reg_form">
                            <!-- First name -->
                            <div class="input__box">
                                <label class="form-check-label text-white " for="flexRadioDefault2">
                                    First Name : 
                                </label>
                                <input type="text" class="mt-1 fname" placeholder="First Name" name="FirstName" required/>
                            </div>
                            <!-- Last name -->
                            <div class="input__box">
                                <label class="form-check-label text-white " for="flexRadioDefault2">
                                    Last Name : 
                                </label>
                                <input type="text" class="mt-1 lname" placeholder="Last Name" name="LastName" required/>
                            </div>
                            <!-- Gen buttons -->
                            <div class="container gen-buttons mt-3 p-0">
                                <label class="form-check-label text-white " for="flexRadioDefault2" >
                                    Gender :&nbsp;
                                </label>
                                <div class="form-check">
                                    <input class="form-check-input transp-button" type="radio"  id="flexRadioDefault1" name="gender" value="Male" checked >
                                    <label class="form-check-label text-white" for="flexRadioDefault1" style="margin-right:16px">
                                      Male
                                    </label>
                                  </div>
                                  <div class="form-check">
                                    <input class="form-check-input transp-button" type="radio"  id="flexRadioDefault2" name="gender" value="Female">
                                    <label class="form-check-label text-white" for="flexRadioDefault2">
                                      Female
                                    </label>
                                </div>
                            </div>
                            <!-- Dob  -->
                            <div class="container mt-3 p-0" >
                                <label class="form-check-label text-white " for="flexRadioDefault2">
                                    Date of birth :&nbsp;
                                </label>
                                <input type="date" name="Dob" id="" class="date" required>
                            </div>
                            <!-- Email  -->
                            <div class="input__box">
                                <label class="form-check-label text-white " for="flexRadioDefault2">
                                    Email :&nbsp;
                                </label>
                                <!-- <input type="Email" placeholder="Email" name="Email" class="Email my-textbox" required/>  <div class="popover-content"> <p>Popover content goes here</p> </div> -->
                                <div class="popover-container">
                                    <input type="email" placeholder="Email" name="Email" class="my-textbox Email input-container" required>
                                    <div class="popover-content">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <!-- password -->
                            <div class="input__box">
                                <label class="form-check-label text-white " for="flexRadioDefault2">
                                    Password :&nbsp;
                                </label>
                                <!-- <input type="Password" placeholder="Password" name="Password" class="pass" data-bs-toggle="popover" data-bs-content="Password Should Conain A,a,#?!@$%^&*-,1-9" required/> -->
                                <div class="popover-container">
                                    <input type="password" placeholder="Password" name="Password" class="my-textbox pass" required>
                                    <div class="popover-content">
                                        <p></p>
                                    </div>
                                </div>
                            </div>
                            <!-- Re-password -->
                            <div class="input__box">
                                <label class="form-check-label text-white " for="flexRadioDefault2">
                                    Re-enter Password :&nbsp;
                                </label>
                                <!-- <input type="Password" placeholder="Password"  class="re_pass" data-bs-toggle="popover"  data-bs-content= "Password didn't match" required disabled/> -->
                                <div class="popover-container">
                                    <input type="password" placeholder="password" name="email" class="my-textbox re_pass"  required disabled> 
                                    <div class="popover-content">
                                        <p></p>
                                    </div>
                                </div>
                            </div>

                            <div class="input__box" >
                                <input type="submit" value="Register" id="reg_user" />
                            </div>
                            
                        </form>
                    </div>
            </div>
            
        </div>
        
    </section>
    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Custom js -->
    <script src="../src/js/Alert.js"></script>
    <script src="../src/js/popover.js"></script>
    <script src="../src/js/input_validation_user_data.js"></script>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
    
    


<!-- Bootstrap js -->
    <!-- MDB -->
    <script type="text/javascript" src="node_modules/mdbootstrap/js/jquery.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/popper.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/bootstrap.min.js"></script>
    <script type="text/javascript" src="node_modules/mdbootstrap/js/mdb.min.js"></script>


</body>
</html>