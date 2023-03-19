<?php 
    require_once('./handlers/homepage_handler.php');
    // echo modify_page();
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Untitled</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Bitter:400,700">
    <link rel="stylesheet" href="../src/css/header.css">
    <link rel="stylesheet" href="../src/css/card.css">
    <link rel="stylesheet" href="../src/css/footer.css">

</head>
<style>
    @import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap");
    body,html{

        height: 100vh;
        background-color: rgba(255, 255, 255, 0.099);
        font-family: "Baloo 2", cursive;

    }
</style>
<body>
<div class="header-dark py-2 ">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search d-flex justify-content-between">
                <div class="container-fluid"><a class="navbar-brand" href="#">C M Surgimed</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse"
                        id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item " role="presentation"><a class="nav-link " href="#">home</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#contactUs">Contact</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#">About</a></li>
                            <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Category </a>
                                <div class="dropdown-menu" role="menu"><a class="dropdown-item" role="presentation" href="#">First Item</a><a class="dropdown-item" role="presentation" href="#">Second Item</a><a class="dropdown-item" role="presentation" href="#">Third Item</a></div>
                            </li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
                        </form><span class="navbar-text"><?php $log_link = give_user_name() === 'signUp'?  "<a href='/login' class='login'>Log In</a>":  ' '; echo $log_link  ?></span><?php $name =  give_user_name() === 'signUp'? "<a class='btn btn-light action-button' role='button' href='/reg'>signUp</a></div>":"<a class='btn btn-light action-button' role='button' href='/".'profile'."'>". give_user_name() ."</a></div>"; echo $name ?>
                </div>
            </nav>
        </div>
