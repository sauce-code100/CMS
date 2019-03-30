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
        echo "<td><a href='posts.php?delete={$id}'>Delete</a></td>";

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

?>