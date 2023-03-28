<?php 
    require_once('connection.php');
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }
    function show_review(){
        if(isset($_POST['process_for_review_page'])){
            if($_POST['process_for_review_page'] == 'displayPage'){
                header('Content-Type: application/json');
                // Read the contents of the HTML file

                $html = file_get_contents('./views/review.php');
                $data = array(
                    'html' => $html,
                    'data' => get_review(0)
                );
                echo json_encode($data);
                return;
            }
            if($_POST['process_for_review_page'] == 'addReview'){
                addReview();
            }
            if($_POST['process_for_review_page'] == 'loadMoreReview'){
                header("Content-Type: application/json");
                $data = array(
                    'data' => get_review($_POST['CurrentOffset'])
                );
                echo json_encode($data);
                return;
            }
        }

    }

    function addReview(){
        if(isset($_SESSION['loggedIn'])){
            if($_SESSION['loggedIn'] == true){
                // $date = CURDATE();
                $custId = $_SESSION['userId'];
                $ProId = $_POST['productId'];
                $review = $_POST['ReviewText'];
                $date = date("Y/m/d");
                if(strlen($review) < 1){
                    header('Content-Type: application/json');
                    // Read the contents of the HTML file
                    $text = "feildEmpty";
                    $data = array(
                        'text' => $text
                    );
                    echo json_encode($data);
                    return;
                }elseif(strlen($review) > 255){
                    header('Content-Type: application/json');
                    // Read the contents of the HTML file
                    $text = "bigvalue";
                    $data = array(
                        'text' => $text
                    );
                    echo json_encode($data);
                    return;
                }
                else{
                    $con = connect_to_db();
                    $sql = $con->prepare("INSERT INTO review (ReviewText, CustomerId, ProductId, DateAdded) 
                    VALUES (?, ?, ?, ?);");

                    $sql->bind_param('ssss', $review, $custId, $ProId, $date);

                    $res = $sql->execute();

                    $sql->close();
                    $con->close();
                    if($res){
                        header('Content-Type: application/json');
                        // Read the contents of the HTML file
                        $text = "added";
                        $data = array(
                            'text' => $text,
                            'UserName' => $_SESSION['userName']
                        );
                        echo json_encode($data);
                        return;
                    }else{
                        header('Content-Type: application/json');
                        // Read the contents of the HTML file
                        $text = "failedAddingReview";
                        $data = array(
                            'text' => $text
                        );
                        echo json_encode($data);
                        return;
                    }
                }


            }   
        }else{
            header('Content-Type: application/json');
                // Read the contents of the HTML file
                $text = "NotLoggedin";
                $data = array(
                    'text' => $text
                );
                echo json_encode($data);
                return;
        }

    }
    function get_review($offset){
        $con = connect_to_db();

        $sql =  $con->prepare("SELECT r.ReviewText, r.DateAdded, u.UserName FROM review r JOIN users u ON r.CustomerId = u.UserId WHERE r.ProductId = ? LIMIT 10 OFFSET ?; ");
        $id = 67;
        $sql->bind_param('ss',$id, $offset);

        $sql->execute();

        $res = $sql->get_result();

        $ans = array();

        $sql->close();
        $con->close();
        while($row = $res->fetch_assoc()){
            array_push($ans, $row);
        }
        return $ans;
    }
?>