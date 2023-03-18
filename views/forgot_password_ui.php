<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
                        <form>
                            <div class="input__box">
                                <input type="Email" placeholder="Email" class='Enter_email'   required />                                  
                            </div>
                            <div class="input__box">
                                <input type="submit" value="Submit" />
                            </div>
                        </form>
                    </div>
            </div>
            
        </div>
    </section>
    <!-- Custom js -->
    <script src="../src/js/Alert.js"></script>

    <script>
        document.querySelector('.Enter_email').focus();
        </script>
    <!-- Bootstrap js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>