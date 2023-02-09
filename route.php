<?php
$url = $_SERVER['REQUEST_URI'];
if($url === '/'){
    return 'reg.php';
}
?>