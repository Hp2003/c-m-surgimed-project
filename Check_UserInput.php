<?php 
    // Validating email
    function check_email($email){
        if (preg_match('/^[a-zA-Z0-9.!#$%&\'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/', $email)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
    // password
    function Check_password($password){
        if(!preg_match( '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$/' , $password)){
            return false;
        }else{
            return true;
        }
    }
    //  hash Password
    function check_mobile($mobile){
        if(preg_match('/^\d{3}-\d{3}-\d{4}$/', $mobile)){
            return FALSE;
        }else{
            return true;
        }
    }
    echo var_dump(check_mobile('8200465772'));
    // Checking dob
    function check_dob($dob){
        $year = intval(substr($dob , 6 , strlen($dob)));
        $current_year = intval(date('Y'));
        if($year >= $current_year ){
            return false;
        }
        elseif(preg_match('/^(0[1-9]|[12][0-9]|3[01])\/(0[1-9]|1[0-2])\/\d{4}$/', $dob)){
            return false;
        }
        // Checking is user 18 or above
        if(!($current_year - $year >= 18)){
            return false;
        }
        return true;
    }

?>

