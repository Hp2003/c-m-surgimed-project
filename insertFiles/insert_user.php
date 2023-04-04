<?php 
    include '../vendor/autoload.php';
    include '../src/connection.php';
    use Faker\Factory;
    $faker = Factory::create();
    
    function random_user_gen(){
        // Database connection details
        $faker = \Faker\Factory::create();
        $dsn = 'mysql:host=localhost;dbname=mydatabase';
        $username = 'myusername';
        $password = 'mypassword';
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        
        $genArray = array("MALE", "FEMALE");
        
        
        $dates = gen_timestamp_in_sequence();

        $con = connect_to_db();
        for ($i = 0; $i < count($dates); $i++) {
            $username = $faker->userName;
            $fname = $faker->firstName;
            $lname = $faker->lastName;
            $password = $faker->password;
            $email = $faker->email;
            $address = $faker->address;
            $phoneNumber = $faker->numberBetween(1000000000, 9999999999);
            $gender = $faker->randomElement(['MALE', 'FEMALE']);
            // $
            // $registration_time = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
            $profile;
            if($gender == 'MALE'){
                $profile = './img/defaultIMG/Default_male.jpg';
            }else{
                $profile = './img/defaultIMG/Default_fmale.jpg';
            }
            $dob = $faker->dateTimeBetween('-90 years', '-18 years');
            $dobreal = $dob->format('Y-m-d');
            $sql = $con->prepare("INSERT INTO users (UserName, FirstName, LastName, MobileNumber, Email, AccountPassword, UserAddress, ProfilePicture, Dob, Gender, JoinedAt)
            VALUES(?,?,?,?,?,?,?,?,?,?,?)");

            $sql->bind_param('sssssssssss', $username, $fname, $lname, $phoneNumber, $email, $password, $address, $profile,  $dobreal, $gender, $dates[$i]);
            
            $sql->execute();
            
        }
        echo "Fake users added to database successfully!";
    }
    
    // function time_stamp_generator(){
    //     $faker = Factory::create();
    //     $month_start = strtotime('2020-02-01');
    //     $month_end = strtotime('2020-03-31');

    //     $registered_users_count = 0;

    //     while ($registered_users_count < 20) {
    //         $registration_time = $faker->dateTimeBetween(date('Y-m-d', $month_start), date('Y-m-d', $month_end))->format('Y-m-d H:i:s');
            
    //         // Insert the registration time into the database here
            
    //         // Count the number of registered users in the month
    //         echo $registration_time . "\n\n";
    //         $registered_users_count ++;
    //     }

    //     echo "At least 20 users registered in the month of January 2020.";
    // }
    function gen_timestamp_in_sequence(){
        $faker = Factory::create();

        $countOfTime = 0;

        $dates = array();
        $month_start = strtotime('2022-01-01');
        $month_end = strtotime('2023-02-31');

        // Generate between 300 and 500 timestamps
        $count = rand(500, 800);

        // Generate timestamps
        $timestamps = array();
        while ($count > 0) {
            // Generate a random timestamp within the month
            $date = rand($month_start, $month_end);
            $registration_time = date('Y-m-d H:i:s', $date);
            $timestamps[] = $registration_time;

            // Generate a random time increment between 1 minute and 1 day
            $increment = rand(60, 840);
            $date += $increment;

            // Check if the new date is still within the month
            if ($date > $month_end) {
                break;
            }

            $count--;
            $countOfTime ++;
        }
        sort($timestamps);
        
        return $timestamps;


    }
    random_user_gen();
?>