<table class = "table table-bordered">
                        <thead>
                        
                        <tr>
                            <th>Id</th>
                            <th>Author</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Image</th>
                            <th>Tags</th>
                            <th>Comments</th>
                            <th>Date</th>
                            <th>Edit</th>
                            <th>Delete</th>
    </tr>
                        </thead>

                        <tbody>


<?php

$query = "SELECT * FROM poststb "; 
$result = mysqli_query($connection, $query);
    while($row = mysqli_fetch_assoc($result)){ 
        $id = $row['post_id'];
        $author = $row['post_author'];
        $title = $row['post_title'];
        $category = $row['post_category_id'];
        $status = $row['post_status'];
        $image = $row['post_image'];
        $tags = $row['post_tags'];
        $comment_count = $row['post_comment_count'];
        $date = $row['post_date'];

        

        echo "<tr>";
        echo "<td>$id</td>";
        echo "<td>$author</td>";
        echo "<td>$title</td>";


        $queryCat = "SELECT * FROM categoriestb WHERE cat_id = {$category}";
        $resultCat = mysqli_query($connection, $queryCat);
        
        while($row = mysqli_fetch_assoc($resultCat)){
            $cat_title = $row['cat_title'];
           
        }
      

        echo "<td>$cat_title</td>";
        echo "<td>$status</td>";
        echo "<td><img src='../images/$image' width=100 height=50 ></td>";
        echo "<td>$tags</td>";
        echo "<td>$comment_count</td>";
        echo "<td>$date</td>";
        echo "<td><a href='posts.php?source=edit_posts&edit={$id}'>Edit</a></td>";
        echo "<td><a href='posts.php?delete={$id}'>Delete</a></td>";

   echo "</tr> ";


    }



?>
                       
        </tbody>
        </table>


<?php
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $query = "DELETE FROM poststb WHERE post_id = {$delete_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }else{
        $delete_id = "";
    }

?>