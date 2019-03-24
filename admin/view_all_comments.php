<table class = "table table-bordered">
                    <thead>
                        
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Comment</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>In Response to</th>
                            <th>Date</th>
                            <th>Approve</th>
                            <th>Unapprove</th>
                            <th>Delete</th>
                        </tr>
                    </thead>

                        <tbody>


<?php

$query = "SELECT * FROM commentstb ORDER BY comment_id DESC"; 
$result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){ 
        $comment_id = $row['comment_id'];
        $comment_post_id = $row['comment_post_id'];
        $author = $row['comment_author'];
        $comment = $row['comment_content'];
        $email = $row['comment_email'];
        $status = $row['comment_status'];
        $date = $row['comment_date'];

        

        echo "<tr>";
        echo "<td>$comment_id</td>";
        echo "<td>$author</td>";
        echo "<td>$comment</td>";


        // $queryCat = "SELECT * FROM categoriestb WHERE cat_id = {$category}";
        // $resultCat = mysqli_query($connection, $queryCat);
        
        // while($row = mysqli_fetch_assoc($resultCat)){
        //     $cat_title = $row['cat_title'];
           
        // }
      

        echo "<td>$email</td>";
        echo "<td>$status</td>";


            $querytoGetTitle = "SELECT * FROM poststb WHERE post_id = $comment_post_id";
            $resulttoGetTitle = mysqli_query($connection, $querytoGetTitle);
            while($row=mysqli_fetch_assoc($resulttoGetTitle)){
                $post_id = $row['post_id'];
                $post_title = $row['post_title'];



        echo "<td><a href='../post.php?post_id=$comment_post_id'>$post_title</a></td>";

    }


        echo "<td>$date</td>";
        echo "<td><a href='comments.php?approve=$comment_id'>Approve</a></td>";
        echo "<td><a href='comments.php?unapprove=$comment_id'>Unapprove</a></td>";
        echo "<td><a href='comments.php?delete=$comment_id'>Delete</a></td>";

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