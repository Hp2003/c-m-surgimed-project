<?php 
require_once('connection.php');
header('cache-control: no-cache');
    function get_add_pro(){
        // $html = "./views/admin_views/add_product.php"; // Replace with your HTML string
        // $js = 'src/js/add_product_ui.js'; // Replace with your JS file path

        // if (file_exists($file_path)) {
        // // Set the content type to HTML
        // header('Content-Type: text/*');

        // // Set the content length
        // header('Content-Length: ' . filesize($file_path));

        // // Send the file contents to the client
        // readfile($file_path);
        // return;
        // Set the content type header to HTML
        header('Content-Type: application/json');
        // Read the contents of the HTML file
        $data = get_categorys();
        $html = file_get_contents('./views/admin_views/add_product.php');

        $resData = array(
            'html' => $html,
            'js' => 'src/js/add_product_ui.js',
            'categorys' => $data
        );
        echo json_encode($resData);
        return;
        // Include the JavaScript file
        // echo '<script src=""></script>';


        // } else {
        // File not found error
        //     header('HTTP/1.0 404 Not Found');
        //     echo 'File not found';
        // }
    }
    function get_categorys(){
        $connection = connect_to_db();

        $query = "SELECT CategoryName FROM category ";

        $result = mysqli_query($connection, $query);

        $data = array();
        while($row = $result->fetch_assoc()){
            array_push($data, $row['CategoryName']);
        };
        $connection->close();
        return $data;
    }
?>