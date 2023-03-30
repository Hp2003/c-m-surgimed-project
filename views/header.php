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
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"> -->
    <link rel="stylesheet" href="../src/css/header.css">
    <!-- <link rel="stylesheet" href="../src/css/card.css"> -->
    <link rel="stylesheet" href="../src/css/footer.css">
    <link rel="stylesheet" href="../src/css/popup.css">
    <link rel="stylesheet" href="../src/css/review.css">
    <link rel="stylesheet" href="../src/css/confirmbox.css">
    <!-- <link rel="stylesheet" href="../src/css/styleD.css"> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-aFq/bzH65dt+w6FI2ooMVUpc+21e0SRygnTpmBvdBgSdnuTN7QbdgL+OapgHtvPp" crossorigin="anonymous">
	<link rel="stylesheet" type="text/css" href="../src/css/homepageD.css">
	<!-- <link rel="stylesheet" type="text/css" href="../src/css/toggle.css"> -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
	<link rel="stylesheet" type="text/css" href="../src/css/style1.css">

</head>
<style>
    /* @import url("https://fonts.googleapis.com/css2?family=Baloo+2&display=swap"); */
     body,html{
        overflow:visible;
        /* height: 100%; */
 
        color:white;
        
    }
    
	.side-bar{
		
		z-index: 10;
	}
	.side-bar:active{
		height:100vh;

	}
    .change{
        position:relative;
    }
    .title{
        cursor:pointer;
    }
    .back-to-top{
        font-size: 2em;
        width: 2em;
        /* position: absolute; */
        right: 23px;
        position: fixed;
        z-index: 200000;
        /* top: 0; */
        bottom: 10vh;
    }
</style>
<body class="change" id="top">

<div class="header-dark py-2 ">
            <nav class="navbar navbar-dark navbar-expand-md navigation-clean-search d-flex justify-content-between">
                <div class="container-fluid"><a class="navbar-brand" href="#">C M Surgimed</a><button class="navbar-toggler" data-toggle="collapse" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
                    <div class="collapse navbar-collapse"
                        id="navcol-1">
                        <ul class="nav navbar-nav">
                            <li class="nav-item " role="presentation"><a class="nav-link " href="/">home</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#">Contact</a></li>
                            <li class="nav-item" role="presentation"><a class="nav-link" href="#" onclick="showOrderPage(event, this)">Orders</a></li>
                            <li class="dropdown"><a class="dropdown-toggle nav-link dropdown-toggle" data-toggle="dropdown" aria-expanded="false" href="#">Category </a>
                                <div class="dropdown-menu" role="menu"></div>
                            </li>
                        </ul>
                        <form class="form-inline mr-auto" target="_self">
                            <div class="form-group"><label for="search-field"><i class="fa fa-search"></i></label><input class="form-control search-field" type="search" name="search" id="search-field"></div>
                        </form>
                        <?php
                            $cnt=0;
                            if(isset($_SESSION['cart'])){
                                $cnt=count($_SESSION['cart']);
                            }
                        ?>
                        <?php if(isset($_SESSION['loggedIn'])){if($_SESSION['loggedIn'] == true){ echo '<span class="navbar-text">  <a href="/" class="logout">Log Out</a> </span>'; }}?>
                        <div class="d-flex">
                            <a href="/cart">
                                <button class="btn btn-outline-success mx-4">Cart(<?php echo $cnt; ?>)</button>
                            </a>
                        </div>
                        <span class="navbar-text"><?php $log_link = give_user_name() === 'signUp'?  "<a href='/login' class='login'>Log In</a>":  ' '; echo $log_link  ?></span><?php $name =  give_user_name() === 'signUp'? "<a class='btn btn-light action-button' role='button' href='/reg'>signUp</a></div>":"<a class='btn btn-light action-button' role='button' href='/".'profile'."'>". give_user_name() ."</a></div>"; echo $name ?>
                </div>
            </nav>
        </div>
        <!-- <div class="container-fluid toggle-main d-flex justify-content-end">
        <ul class="tg-list">

  
<li class="tg-list-item">
  <h4>Admin</h4>
  <input class="tgl tgl-skewed " id="cb3" type="checkbox"/>
  <label class="tgl-btn" data-tg-off="OFF" data-tg-on="ON" for="cb3"></label>
</li>


</ul>
        </div> -->

        <div id="content">

