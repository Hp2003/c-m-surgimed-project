<?php 
    if($_SERVER['REQUEST_METHOD'] === 'GET'){
        
        include('./views/cart.php');

    }
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        require_once('./src/manage_cart.php');
        if(isset($_POST['process']) ){
            if($_POST['process'] == 'increase_decrease'){
                increase_qty();
            }
            if($_POST['process'] == 'remove'){
                remove_pro_from_cart();
            }
        }
        
    }   
?>