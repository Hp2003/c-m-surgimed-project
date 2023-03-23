<?php 
    function get_edit_pro(){
        $file_path = './views/admin_views/edit_product.php';

        if (file_exists($file_path)) {
        // Set the content type to HTML
        header('Content-Type: text/html');

        // Set the content length
        header('Content-Length: ' . filesize($file_path));

        // Send the file contents to the client
        readfile($file_path);
        } else {
        // File not found error
            header('HTTP/1.0 404 Not Found');
            echo 'File not found';
        }
    }
?>