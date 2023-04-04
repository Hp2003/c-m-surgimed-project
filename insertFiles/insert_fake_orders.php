<?php 
    include '../vendor/autoload.php';
    include '../src/connection.php';
    use Faker\Factory;
    $faker = Factory::create();
    
    // function random_user_gen(){
    //     // Database connection details
    //     $faker = \Faker\Factory::create();
    //     $dsn = 'mysql:host=localhost;dbname=mydatabase';
    //     $username = 'myusername';
    //     $password = 'mypassword';
    //     $options = [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION];
        
    //     $genArray = array("MALE", "FEMALE");
        
        
    //     $dates = gen_timestamp_in_sequence();

    //     $con = connect_to_db();
    //     for ($i = 0; $i < count($dates); $i++) {
    //         $username = $faker->userName;
    //         $fname = $faker->firstName;
    //         $lname = $faker->lastName;
    //         $password = $faker->password;
    //         $email = $faker->email;
    //         $address = $faker->address;
    //         $phoneNumber = $faker->numberBetween(1000000000, 9999999999);
    //         $gender = $faker->randomElement(['MALE', 'FEMALE']);
    //         // $
    //         // $registration_time = $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d H:i:s');
    //         $profile;
    //         if($gender == 'MALE'){
    //             $profile = './img/defaultIMG/Default_male.jpg';
    //         }else{
    //             $profile = './img/defaultIMG/Default_fmale.jpg';
    //         }
    //         $dob = $faker->dateTimeBetween('-90 years', '-18 years');
    //         $dobreal = $dob->format('Y-m-d');
    //         $sql = $con->prepare("INSERT INTO users (UserName, FirstName, LastName, MobileNumber, Email, AccountPassword, UserAddress, ProfilePicture, Dob, Gender, JoinedAt)
    //         VALUES(?,?,?,?,?,?,?,?,?,?,?)");

    //         $sql->bind_param('sssssssssss', $username, $fname, $lname, $phoneNumber, $email, $password, $address, $profile,  $dobreal, $gender, $dates[$i]);
            
    //         $sql->execute();
            
    //     }
    //     echo "Fake users added to database successfully!";
    // }
    
    function gen_time_stamp_in_sequence($month_start, $month_end){

        $faker = Factory::create();

        $countOfTime = 0;  

        $dates = array();
        $month_start = strtotime($month_start);
        $month_end = strtotime($month_end);
        // $month_start = strtotime('2022-03-01');
        // $month_end = strtotime('2022-03-31');
        
        // Generate between 50 and 130 timestamps (the number of sales per month)
        $count = rand(50, 130);

        // Generate timestamps
        $timestamps = array();
        while ($count > 0) {
            // Generate a random timestamp within the month
            $date = rand($month_start, $month_end);
            $registration_time = date('Y-m-d H:i:s', $date);
            $timestamps[] = $registration_time;

            // Generate a random time increment between 1 minute and 1 day
            $increment = rand(100, 84000);
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
    function get_all_users($numberofrows){
        $result = array();
        while( count($result) < $numberofrows ){
            $con = connect_to_db();

            $query = "SELECT * from users ORDER BY RAND() LIMIT $numberofrows";
    
            $res = mysqli_query($con, $query);
    
            while($row = mysqli_fetch_assoc($res)){
                array_push($result, $row);
            }
        }
        $con->close();
        return $result;

    }
    function get_product_ids($numberofrows){
        $result = array();
        // this will keep pushing element untill get required products
        while( count($result) < $numberofrows ){
            $con = connect_to_db();

            $query = "SELECT ProductId, ProductPrice from product ORDER BY RAND() LIMIT $numberofrows";
    
            $res = mysqli_query($con, $query);
    
            while($row = mysqli_fetch_assoc($res)){
                array_push($result, $row);
            }
        }
        $con->close();
        return array_slice($result, 0, $numberofrows);
    }
    
    function decide_how_many_product_buy(&$productarray,  $userId){

        $productsToBuy = array();
        
        // Deciding how many products to buy
        
        $howManyProductToBuy = rand(1, 20);
        // getting more products if array not have enough
            $productarray = array();


            while (count($productarray) < $howManyProductToBuy) {
                $remainingProducts = $howManyProductToBuy - count($productarray);
                $newProducts = get_product_ids($remainingProducts);
                $productarray = array_merge($productarray, $newProducts);
            }


        // getting products
        
        $elements = array_splice($productarray, 0, $howManyProductToBuy);
        for($i = 0 ; $i < count($elements) ; $i++){
            // getting quantity which user will buy
            $quantity = rand(2,30);

            $orderStatus ;

            $toalPrice = $quantity * $elements[$i]['ProductPrice'];

            // deciding fail order or not
            $random_number = rand(0, 99);
            if ($random_number <= 29) {
                // condition to cancel order is true
                $orderStatus = 'Cancelled';
            } else {
                // condition to place order is true
                $orderStatus = 'Placed';
            }
            
            array_push($productsToBuy, array(
                'quantity' => $quantity,
                'status' => $orderStatus,
                'totalprice' => $toalPrice,
                'itemid' => $elements[$i]['ProductId'],
                'Price' => $elements[$i]['ProductPrice']
            ));
        }
        return $productsToBuy;
    }
    function make_order($start, $end){
        $finalOrder = array();
        // $timearray  = gen_time_stamp_in_sequence($start, $end);

        $timearray = gen_time_stamp_in_sequence($start, $end);
        $users = get_all_users(count($timearray));
        $products = get_product_ids(count($users) * 3);

        for($i = 0 ; $i< count($timearray) ; $i++){
            $product = decide_how_many_product_buy($products, $users[$i]);
            // $finalOrder['PlacedOn'] = $timearray[$i];
            // $finalOrder['CustomerId'] = $users[$i]['UserId'];

            for($j = 0 ; $j<count($product) ; $j++){
                $product[$j]['PlacedOn'] = $timearray[$i];
                $product[$j]['CustomerId'] = $users[$i]['UserId'];
                $product[$j]['UserAddress'] = $users[$i]['UserAddress'];
                $product[$j]['PhoneNumber'] = $users[$i]['MobileNumber'];
            }
            array_push($finalOrder, $product);
        }   
        return $finalOrder;

    }
    $res ;
    
    $start= strtotime('2022-03-01');
    $end= strtotime('2023-03-01');

    while ($start < $end) {
        $month_start = date('Y-m-d', $start);
        $month_end = date('Y-m-d', strtotime('+1 month', $start) - 1);
        $start = strtotime('+1 month', $start);
        // echo $month_start . ' to ' . $month_end . "\n";
        $res[] = make_order($month_start, $month_end);
    }

    $newArray = [];
    foreach($res as $val){
        foreach($val as $val1){
            foreach($val1 as $val2){
                $newArray[] = $val2;
            }
        }
    }
    print_r($newArray);

?>