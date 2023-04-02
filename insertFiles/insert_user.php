<?php 
    include '../vendor/autoload.php';
    use Faker\Factory;

    $faker = Factory::create();
    
    function random_user_gen(){
        // Database connection details
        $dsn = 'mysql:host=localhost;dbname=mydatabase';
        $username = 'myusername';
        $password = 'mypassword';
        $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        
        $genArray = array("MALE", "FEMALE");
        
        for ($i = 0; $i < 10; $i++) {
            $username = $faker->userName;
            $fname = $faker->firstName;
            $lname = $faker->lastName;
            $password = $faker->password;
            $email = $faker->email;
            $phoneNumber = $faker->numberBetween(1000000000, 9999999999);
            // $
            $registration_time = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
            echo $username . "\n";
            echo $fname . "\n";
            echo $lname . "\n";
            echo $email . "\n";
            echo $password . "\n";
            echo $phoneNumber . "\n";
            echo $gender . "\n";
            echo $registration_time . "\n\n";
            
        }
        echo "Fake users added to database successfully!";
    }
    
    function time_stamp_generator(){
        $faker = Factory::create();
        $month_start = strtotime('2020-02-01');
        $month_end = strtotime('2020-03-31');

        $registered_users_count = 0;

        while ($registered_users_count < 20) {
            $registration_time = $faker->dateTimeBetween(date('Y-m-d', $month_start), date('Y-m-d', $month_end))->format('Y-m-d H:i:s');
            
            // Insert the registration time into the database here
            
            // Count the number of registered users in the month
            echo $registration_time . "\n\n";
            $registered_users_count ++;
        }

        echo "At least 20 users registered in the month of January 2020.";
    }
    function gen_timestamp_in_sequence(){
        $faker = Factory::create();

        $countOfTime = 0;
        // while ($date <= $month_end ) {
        //     if(rand(0,1) == 0){
        //         $date += rand(86400, 86400); // skip a random number of days
        //         continue;
        //     }
        //     $registration_time = date('Y-m-d H:i:s', $date);
        //     echo $registration_time . "\n";
        //     // $count ++;
        //     $date += rand(60, 360); // increment time by a random number of seconds
        //     $count ++;
        // }

        $month_start = strtotime('2022-02-01');
        $month_end = strtotime('2022-02-31');

        // Generate between 300 and 500 timestamps
        $count = rand(100, 300);

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
        print_r($timestamps);

        echo "Total $countOfTime";


    }
    gen_timestamp_in_sequence();
?>