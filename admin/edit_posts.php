<?php
$edit_id = $_GET['edit'];

$query = "SELECT * FROM poststb WHERE post_id={$edit_id}";
$result = mysqli_query($connection, $query);
while($row = mysqli_fetch_assoc($result)){

    $post_title = $row['post_title'];
    $post_category_id = $row['post_category_id'];
    $post_author = $row['post_author'];
    $post_status = $row['post_status'];
    $post_image = $row['post_image'];
    $post_tags = $row['post_tags'];
    $post_content = $row['post_content'];

}
?>



<form action="" method="post" enctype="multipart/form-data">

<div class="form-group">
    <label for="title">Post Title</label>
    <input type="text" name="title" class="form-control" value="<?php echo $post_title ?>">
    </div>

<div class="form-group">
    <label for="post_category_id">Post Category Id</label>
    <select name="post_category" id="">
<?php
$query = "SELECT * FROM categoriestb";
$result = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($result)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];

    $selected = ($cat_id == $post_category_id)?'selected' :'';
   echo "<option  {$selected} value='{$cat_id}'>{$cat_title}</option>";

}

?> 
  
    </select>
</div>

<div class="form-group">
    <label for="author">Post Author</label>
    <input type="text" name="author" class="form-control" value="<?php echo $post_author ?>">
</div>

<div class="form-group">
    <label for="status">Post Status</label>
    <input type="text" name="status" class="form-control" value="<?php echo $post_status ?>">
</div>

<div class="form-group">
    <label for="image">Post Image</label>
    <input type="file" name="image" id="">
    <img src="../images/<?php echo $post_image; ?>" width=100 height=50 alt="">
</div>

<div class="form-group">
    <label for="tags">Post Tags</label>
    <input type="text" name="tags" class="form-control" value="<?php echo $post_tags ?>">
</div>

<div class="form-group">
    <label for="content">Post Content</label>
    <textarea name="content" class="form-control" cols="30" rows="10">
    <?php echo $post_content ?>
    </textarea>
</div>

<div class="form-group">
    <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
</div>

</form>



<?php
if(isset($_POST['create_post'])){

$edit_id = $_GET['edit'];

$post_title = $_POST['title'];
$post_category_id = $_POST['post_category'];
$post_author = $_POST['author'];
$post_status = $_POST['status'];

$post_image = $_FILES['image']['name'];
$post_image_temp = $_FILES['image']['tmp_name'];

$post_tags = $_POST['tags'];
$post_content = $_POST['content'];

move_uploaded_file($post_image_temp, "../images/$post_image");


//ensuring we always have an image even after updating
if(empty($post_image)){

$query = "SELECT * FROM poststb WHERE post_id = {$edit_id}";
$query_image = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($query_image)){
    $post_image = $row['post_image'];
}
}



$query = "UPDATE poststb SET ";
$query .= "post_category_id = '{$post_category_id}', ";
$query .= "post_title = '{$post_title}', ";
$query .= "post_author = '{$post_author}', ";
$query .= "post_date = now(), ";
$query .= "post_image = '{$post_image}', ";
$query .= "post_content = '{$post_content}', ";
$query .= "post_tags = '{$post_tags}', ";
$query .= "post_status = '{$post_status}' ";
$query .= "WHERE post_id = {$edit_id}";



$update_query = mysqli_query($connection, $query);
if(!$update_query){
    die("query failed" . mysqli_error($connection));
}
header("Location: posts.php?source=edit_posts&edit=$edit_id");
}
?>