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
    function check_mobile($mobile){
        if(preg_match('/^(?:\+\d{1,3}[- ]?)?\d{10}$/', $mobile)){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    function check_dob($dob){
        $year = intval(substr($dob , 0 , 4));
        $current_year = intval(date('Y'));
        if($year < $current_year ){
            if(preg_match('/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/', $dob)){
                // Checking is user 18 or above
                if(($current_year - $year >= 18)){
                    return TRUE;
                }
            }
        }
        return false;
    }
?>

