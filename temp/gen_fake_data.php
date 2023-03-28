<?php
    // require_once('./src/');

function gen_usrs(){

    $curl = curl_init();
    curl_setopt($curl, CURLOPT_URL, 'https://api.unsplash.com/photos/random?count=30');
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
        'Authorization: Client-ID <your_access_key>',
    ));
    $response = curl_exec($curl);
    $images = json_decode($response);

    $temp_dir = 'imgFaker';
    foreach ($images as $image) {
        $filename = uniqid() . '.jpg';
        $image_data = file_get_contents($image->urls->regular);
        file_put_contents($temp_dir . $filename, $image_data);

    }
    require_once 'vendor/autoload.php';
    $faker = Faker\Factory::create();

    $main_dir = './img/User_imges/';

    for($i = 0 ; $i< 30 ; $i++){
        
    }
}

?>
