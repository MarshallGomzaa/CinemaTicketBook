<?php 
    require_once 'config.php';
    if($_POST){
        $seat_name = $_REQUEST['seat_name'];
        $movie_id = $_REQUEST['movie_id'];
        $user_id = $_REQUEST['user_id'];
        $q_select_seat = "select * from seat where name = '".$seat_name."'";
        $result = mysqli_query($con,$q_select_seat);
        if(mysqli_num_rows($result)==0){
            echo "Invalid seat name";
            die();
        }
        $seat = mysqli_fetch_assoc($result);
        $seat_id = $seat['id'];
        $q_check_reserved_seat = "SELECT * FROM reserved_seat where movie_id= ".$movie_id." and seat_id = ".$seat_id;
        $result = mysqli_query($con,$q_check_reserved_seat);
        // echo $q_check_reserved_seat;
        // echo $con->error;
        if(mysqli_num_rows($result)==0){
            $q_insert_reserve = "INSERT INTO reserved_seat values(".$user_id.", ".$movie_id.", ".$seat_id.")";
            echo $q_insert_reserve;
            if(mysqli_query($con,$q_insert_reserve)){
                echo "Seat reserved";
                header("location:seat.php?movie_id=".$movie_id);
            }else{
                echo "fail to reserved";
                header("location:seat.php?movie_id=".$movie_id);
            }
        }else{
            echo "Seat has been already reserved please try other seat.";
            die();
        }

    }
