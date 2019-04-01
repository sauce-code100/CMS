<?php
if(isset($_POST['checkBoxArray'])){
    foreach ($_POST['checkBoxArray'] as $checkBoxPostValueId) {
      $bulk_options = $_POST['bulk_options'];
      switch($bulk_options){
        case 'published':
            $query = "UPDATE poststb SET post_status= '{$bulk_options}' WHERE post_id = $checkBoxPostValueId ";
            $update_to_published_status = mysqli_query($connection, $query);
        break;

        case 'draft':
            $query = "UPDATE poststb SET post_status= '{$bulk_options}' WHERE post_id = $checkBoxPostValueId ";
            $update_draft_status = mysqli_query($connection, $query);
        break;

        case 'delete':
            $query = "DELETE FROM poststb WHERE post_id = $checkBoxPostValueId ";
            $delete_post = mysqli_query($connection, $query);
        break;

        case 'clone':
            $query = "SELECT * FROM poststb WHERE post_id = $checkBoxPostValueId";
            $clone_query = mysqli_query($connection, $query);

            if(!$clone_query){
                die("QUERY FAILED" . mysqli_error($connection));

            }
            while($row = mysqli_fetch_assoc($clone_query)){
                $post_category_id = $row['post_category_id'];
                $post_author = $row['post_author'];
                $post_title = $row['post_title'];
                $post_date = $row['post_date'];
                $post_image = $row['post_image'];
                $post_content = $row['post_content'];
                $post_tags = $row['post_tags'];
                $post_comment_count = $row['post_comment_count'];
                $post_status = $row['post_status'];


                $query = "INSERT INTO poststb (post_category_id, post_author, post_title, ";
                $query .= "post_date, post_image, post_content, post_tags, post_comment_count, post_status) ";
                $query .= "VALUES ({$post_category_id}, '{$post_author}', '{$post_title}', '{$post_date}', ";
                $query .= " '{$post_image}', '{$post_content}', '{$post_tags}', {$post_comment_count}, '{$post_status}')";
                $clone_insert_query = mysqli_query($connection, $query);
                if(!$clone_insert_query){
                    die("Query Failed" . mysqli_error($connection));
    
                }


            }

        break;
      }

    }
}

?>

<form action="" method="post">
<table class = "table table-bordered table-hover">


<div id="bulkOptionContainer" style= "padding-left:0px" class="col-xs-4">
    <select name="bulk_options" id="" class="form-control" style= "margin-bottom: 10px">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
    </select>
</div>

<div class="col-xs-4">
<input type="submit" class="btn btn-success" name="submit" value="Apply">
<a href="posts.php?source=add_posts" class="btn btn-primary">Add New</a>

</div>
    <thead>
        <tr>
            <th><input type="checkbox" name="" id="selectAllBoxes"></th>
            <th>Id</th>
            <th>Author</th>
            <th>Title</th>
            <th>Category</th>
            <th>Status</th>
            <th>Image</th>
            <th>Tags</th>
            <th>Comments</th>
            <th>Date</th>
            <th>View Post</th>
            <th>Edit</th>
            <th>View Count</th>
            <th>Delete</th>
        </tr>
    </thead>
    <tbody>

<?php

$query = "SELECT * FROM poststb ORDER BY post_id DESC "; 
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
        $post_views_count = $row['post_views_count'];

        echo "<tr>"; ?>
        <td><input type='checkbox' value='<?php echo $id;  ?>' name='checkBoxArray[]' class='checkBoxes'>

        <?php 
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
        echo "<td><a href='../post.php?post_id={$id}'>View Post</a></td>";
        echo "<td><a href='posts.php?source=edit_posts&edit={$id}'>Edit</a></td>";
        echo "<td><a href='posts.php?post_id={$id}&reset={$id}'>$post_views_count</a></td>";
        echo "<td><a onClick=\"javascript: return confirm('Are You Sure You want to DELETE?');\" href='posts.php?delete={$id}'>Delete</a></td>";

   echo "</tr> ";
    }
?>                
        </tbody>
        </table>
</form>

<?php
    if(isset($_GET['delete'])){
        $delete_id = $_GET['delete'];
        $query = "DELETE FROM poststb WHERE post_id = {$delete_id}";
        $delete_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }else{
        $delete_id = "";
    }
    if(isset($_GET['reset'])){
        $reset_id = $_GET['reset'];
        $query = "UPDATE poststb SET post_views_count=0 WHERE post_id = {$reset_id}";
        $reset_query = mysqli_query($connection, $query);
        header("Location: posts.php");
    }else{
        $reset_id = "";
    }



?>