<?php include "../includes/functions.php" ?>


<?php if(isset($_POST['create_post'])){
    echo "<strong>POST ADDED SUCCESSFULLY</strong><br><br>";
}
 ?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="title">Post Title</label>
        <input type="text" name="title" class="form-control">
    </div>

    <div class="form-group">
    <label for="post_category_id">Post Category Id</label>
    <select name="post_category_id" id="">
<?php
$query = "SELECT * FROM categoriestb";
$result = mysqli_query($connection, $query);

while($row = mysqli_fetch_assoc($result)){
    $cat_id = $row['cat_id'];
    $cat_title = $row['cat_title'];
    echo "<option  value='{$cat_id}'>{$cat_title}</option>";
    
//watch out for what Nonso added for you on these 2  lines below. I went back to my old code above
//     $selected = ($cat_id == $post_category_id)?'selected' :'';
//    echo "<option  {$selected} value='{$cat_id}'>{$cat_title}</option>";

}

?> 
  
    </select><br>

    <div class="form-group">
        <label for="author">Post Author</label>
        <input type="text" name="author" class="form-control">
    </div>

    <div class="form-group">
    <label for="status">Post Status</label>
    <select name="status">
    <option value='draft'>Select Option</option>"
    <option value='draft'>Draft</option>"
        <option value='published'>Published</option>
    </select>
</div>

    <div class="form-group">
        <label for="image">Post Image</label>
        <input type="file" name="image" class="form-control">
    </div>

    <div class="form-group">
        <label for="tags">Post Tags</label>
        <input type="text" name="tags" class="form-control">
    </div>

    <div class="form-group">
        <label for="content">Post Content</label>
        <textarea name="content" class="form-control" cols="30" rows="10" id="body"></textarea>
    </div>


    <script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
    

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_post" value="Publish Post">
    </div>

</form>


<?php 
if(isset($_POST['create_post'])){
    
    $title = $_POST['title'];
    $post_category_id = $_POST['post_category_id'];
    $author = $_POST['author'];
    $status = $_POST['status'];


    $post_image = $_FILES['image']['name'];
    $post_image_temp = $_FILES['image']['tmp_name'];


    $tags = $_POST['tags'];
    $content = $_POST['content'];
    $post_date = date('d-m-y');


    move_uploaded_file($post_image_temp, "../images/$post_image");

$query = "INSERT INTO poststb (post_category_id, post_title, post_author, ";
$query .= "post_date, post_image, post_content, post_tags, post_status) ";
$query .= "VALUES ({$post_category_id}, '{$title}', '{$author}', now(), '{$post_image}', '{$content}', '{$tags}', '{$status}')";

$result = mysqli_query($connection, $query);

confirmQuery($result);




}
?>