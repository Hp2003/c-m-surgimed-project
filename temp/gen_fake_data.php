<?php
    // require_once('./src/');

function gen_usrs(){
    require_once('../src/connection.php');
    require_once '../vendor/autoload.php'; // include the Faker library

    // create a new instance of the Faker generator
    $faker = Faker\Factory::create();

    // define the number of users you want to generate
    $numUsers = 100;
    $con = connect_to_db();
    // loop through and generate fake user data
    $gender = array('male', 'female');
    for ($i = 0; $i < $numUsers; $i++) {
        $firstname = $faker->firstName;
        $lastname = $faker->lastName;
        $email = $faker->email;
        $uname = $faker->userName;
        $phone;;
        $address = $faker->address;
        $password = $faker->password;
        $date = $faker->date;
        $gen = $faker->randomElement($gender);
        do {
            $phone = $faker->numerify('##########');
        } while (strlen($phone) != 10);
        $img;
        if($gen == 'male'){
            $img = 'img/defaultIMG/Default_male.jpg';
        }else{
            $img = 'img/defaultIMG/Default_female.jpg';
        }
        $uname = mysqli_real_escape_string($con, $faker->userName);
        $firstname = mysqli_real_escape_string($con, $faker->firstName);
        $lastname = mysqli_real_escape_string($con, $faker->lastName);
        $phone = mysqli_real_escape_string($con, $faker->numerify('##########'));
        $email = mysqli_real_escape_string($con, $faker->email);
        $password = mysqli_real_escape_string($con, $faker->password);
        $address = mysqli_real_escape_string($con, $faker->address);
        // $img = mysqli_real_escape_string($con, $faker->imageUrl());
        $date = mysqli_real_escape_string($con, $faker->date('Y-m-d'));
        // $gen = mysqli_real_escape_string($con, $faker->randomElement($genders));
        // inserting into user table
        $sql = "INSERT INTO users (UserName, FirstName, LastName, MobileNumber, Email, AccountPassword, UserAddress, ProfilePicture, Dob, Gender)
                                VALUES('$uname', '$firstname', '$lastname', '$phone', '$email', '$password', '$address', '$img', '$date', '$gen')";
        $res = mysqli_query($con, $sql);

        if(!$res){
            die('Error: ' . mysqli_error($con)); 
        }
        // echo "firstName: $firstname\n";
        // echo "uname: $uname\n";
        // echo "lastName: $lastname\n";
        // echo "Email: $email\n";
        // echo "Phone: $phone\n";
        // echo "date: $date\n";
        // echo "Address: $address\n";
        // echo "gender: $gen\n";
        // echo "password: $password\n";
        // echo "img: $img\n\n";
    }

}
gen_usrs();

?>
