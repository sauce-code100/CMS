<?php 
    function AddCategory(){
        global $connection;
        if(isset($_POST['submit'])){
            $new_category = $_POST['cat_title'];

            if($new_category== "" || empty($new_category) ){
                echo "This field can't be left blank";
            }else {

                echo "Category Added"; //continue working here
            $query = "INSERT INTO categoriestb(cat_title) VALUE('{$new_category}') ";
            $result = mysqli_query($connection, $query);
            if(!$result){
                die("QUERY FAILED" . mysqli_error($connection));
            }
            }
            } 
    

    }

    function usersOnline(){
        global $connection;


        $session = session_id();
        $time = time();
        $time_out_in_seconds = 30;
        $time_out = $time - $time_out_in_seconds;
        
        $query = "SELECT * FROM users_online WHERE session = '$session'";
        $send_query = mysqli_query($connection, $query);
        $count = mysqli_num_rows($send_query);
        
        if($count == NULL){   //num_rows ==NULL means a new user just logged in, that is, the user wasnt initially online
            mysqli_query($connection, "INSERT INTO users_online(session, time) VALUES ('$session', $time)");// add him into the users online
        }else{// that means his id was found among those online, then simply update his time
          
        mysqli_query($connection, "UPDATE users_online SET time = {$time} WHERE session ='{$session}' ");  
        }
        
        $users_online_query = mysqli_query($connection, "SELECT * FROM users_online WHERE time> $time_out");
        return $count_users = mysqli_num_rows($users_online_query);





    }
    


?>