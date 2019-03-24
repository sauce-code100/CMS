<?php include "../includes/functions.php" ?>


<?php if(isset($_POST['create_user'])){
    echo "<strong>USER ADDED SUCCESSFULLY</strong><br><br>";
}
 ?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" class="form-control">
    </div>

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" class="form-control">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" class="form-control">
    </div>

     <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" class="form-control">
    </div>

    <!-- <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="image" class="form-control">
    </div> -->

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="">
<?php
// $query = "SELECT * FROM categoriestb";
// $result = mysqli_query($connection, $query);

// while($row = mysqli_fetch_assoc($result)){
//     $cat_id = $row['cat_id'];
//     $cat_title = $row['cat_title'];
    echo "<option  value='subscriber'>subscriber</option>";
    echo "<option  value='admin'>admin</option>";
    
//watch out for what Nonso added for you on these 2  lines below. I went back to my old code above
//     $selected = ($cat_id == $post_category_id)?'selected' :'';
//    echo "<option  {$selected} value='{$cat_id}'>{$cat_title}</option>";

// }

?> 
  
    </select><br><br>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="create_user" value="Add User">
    </div>

</form>


<?php 
if(isset($_POST['create_user'])){
    
    $username = $_POST['username'];
    $user_password = $_POST['password'];
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];


    // $user_image = $_FILES['image']['name'];
    // $user_image_temp = $_FILES['image']['tmp_name'];


    $user_email = $_POST['email'];
    $user_role = $_POST['user_role'];


 //   move_uploaded_file($post_image_temp, "../images/$post_image");

$query = "INSERT INTO userstb (username, user_password, user_firstname, ";
$query .= "user_lastname, user_email, user_role) ";
$query .= "VALUES ('{$username}', '{$user_password}', '{$user_firstname}','{$user_lastname}', '{$user_email}', '{$user_role}')";

$result = mysqli_query($connection, $query);

confirmQuery($result);




}




?>