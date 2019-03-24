<table class = "table table-bordered">
                    <thead>
                        
                        <tr>
                            <th>Id</th>
                            <th>Username</th>
                            <th>Firstname</th>
                            <th>Lastname</th>
                            <th>Email</th>
                            <th>Role</th>
                        </tr>
                    </thead>

                        <tbody>


<?php

$query = "SELECT * FROM userstb"; 
$result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){ 
        $user_id = $row['user_id'];
        $username = $row['username'];
        $user_firstname = $row['user_firstname'];
        $user_lastname = $row['user_lastname'];
        $user_email = $row['user_email'];
        $user_role = $row['user_role'];


        

        echo "<tr>";
        echo "<td>$user_id</td>";
        echo "<td>$username</td>";
        echo "<td>$user_firstname</td>";
        echo "<td>$user_lastname</td>";
        echo "<td>$user_email</td>";
        echo "<td>$user_role</td>";


//             $querytoGetTitle = "SELECT * FROM poststb WHERE post_id = $comment_post_id";
//             $resulttoGetTitle = mysqli_query($connection, $querytoGetTitle);
//             while($row=mysqli_fetch_assoc($resulttoGetTitle)){
//                 $post_id = $row['post_id'];
//                 $post_title = $row['post_title'];



//         echo "<td><a href='../post.php?post_id=$comment_post_id'>$post_title</a></td>";

    // }


        echo "<td><a href='comments.php?approve='>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove='>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete='>Delete</a></td>";

   echo "</tr> ";


    }

?>
                       
        </tbody>
        </table>



<?php
    if(isset($_GET['approve'])){
        $approve_id = $_GET['approve'];
        $queryApprove = "UPDATE commentstb SET comment_status= 'approved' WHERE comment_id = {$approve_id}";
        $approve_query = mysqli_query($connection, $queryApprove);
        header("Location: comments.php");
    }else{
        $approve_id = "";
    }



    if(isset($_GET['unapprove'])){
        $unapprove_id = $_GET['unapprove'];
        $queryUnapprove = "UPDATE commentstb SET comment_status= 'unapproved' WHERE comment_id = {$unapprove_id}";
        $unapprove_query = mysqli_query($connection, $queryUnapprove);
        header("Location: comments.php");
    }else{
        $unapprove_id = "";
    }




?>




<?php
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $queryDelete = "DELETE FROM commentstb WHERE comment_id = {$delete_id}";
        $delete_query = mysqli_query($connection, $queryDelete);
        header("Location: comments.php");
    }else{
        $delete_id = "";
    }

?>