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
    <style>
        input[type=number]::-webkit-outer-spin-button,
    input[type=number]::-webkit-inner-spin-button {
      -webkit-appearance: none;
      margin: 0;
    }
    
     input[type=number] {
      -moz-appearance: textfield;
    } 
    </style>
</head>
<body>
    <noscript>Please enable javascript</noscript>
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
                        <h2>Enter Email </h2>
                        <form id="changePasswordForm"> 
                            <div class="input__box">
                                <input type="password" placeholder="Old Password" class='Old-Password' name='oldpass'  required />                                  
                            </div>
                            <div class="input__box">
                                <input type="password" placeholder="New Password" class='New-password'  name="newpass" required />                                  
                            </div>
                            <div class="input__box">
                                <input type="password" placeholder="Re-enter Password" class='re-New_password' name='re-newpass'   required />                                  
                            </div>
                            <div class="input__box">
                                <input type="submit" value="Submit"  class="change_password" />
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
    <script src="../src/js/input_validation_user_data.js"></script>

    <script>
        document.querySelector('.change_password').addEventListener('click', (e)=>{
            e.preventDefault();
            const form = document.querySelector('#changePasswordForm');
            let oldPass = document.querySelector('.Old-Password').value;
            let newPass = document.querySelector('.New-password').value;
            let rePass = document.querySelector('.re-New_password').value;

            if(!checkPassword(newPass)){
                createAlert('warning','Password should contain "@$%^& , A,a,[1-9],8-20 characters "',"");
                return 0;
            }else if(newPass !== rePass){
                createAlert('warning','Passwords did not match',"");
                return 0;
            }
            let formdData = new FormData(form);
            // formdData.append()
            axios.post('',formdData).then(Response =>{
                console.log(Response);
                if(Response.data.text == 'changed'){
                    createAlert('success', 'Password has been changed', '');
                    setTimeout(() => {
                        window.location.href = '/home'
                    }, 2000);
                    return 1;
                }if(Response.data.text == 'notmatch'){
                    createAlert('danger', 'Old password is wrong', '');
                    return 0;
                }if(Response.data.text == 'bothnotmatch'){
                    createAlert('danger', 'Both passwords not matching', '');
                    return 0;
                }
                if(Response.data.text == 'samepass'){
                    createAlert('danger', 'new password can not be same as  old password', '');
                    return 0;
                }if(Response.data.text == 'wronginput'){
                    createAlert('danger','Password should contain "@$%^& , A,a,[1-9],8-20 characters "',"");
                    return 0;
                }
            })
        })
    </script>


    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>