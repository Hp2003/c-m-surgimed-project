<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="../src/css/login.css">
    <link rel="stylesheet" href="../src/css/popover.css">
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
                        <h2>Login..</h2>
                        <form id="login_form">
                            <div class="input__box">
                            <div class="popover-container">
                                    <input type="email" placeholder="Email" name="Email" class="my-textbox Email" required>
                                    <div class="popover-content">
                                        <p>Popover content goes here</p>
                                    </div>
                                </div>
                            </div>
                            <div class="input__box">
                            <div class="popover-container">
                                    <input type="password" placeholder="password" name="password" class="my-textbox Email" required>
                                    <div class="popover-content">
                                        <p>Popover content goes here</p>
                                    </div>
                                </div>
                            </div>
                            <div class="input__box">
                                <input type="submit" value="Login" class="login_user"/>
                            </div>
                            <p class="forget">
                                Forgot Password? <a href="#" class="link">Click Here</a>
                            </p>
                            <p class="forget">
                                Don't have an account? <a href="#" class="link">Sign Up</a>
                            </p>
                        </form>
                    </div>
            </div>
            
        </div>
    </section>
    <!-- Axios -->
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

    <!-- Custom js -->
    <!-- <script src="../src/js/input_validation_user_data.js"></script> -->
    <script src="../src/js/Alert.js"></script>
    <script src="../src/js/login_page.js"></script>
    <script src="../src/js/popover.js"></script>

    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>