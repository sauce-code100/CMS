<?php include "../includes/functions.php" ?>

<?php
$edit_user_id = $_GET['edit'];

$query = "SELECT * FROM userstb WHERE user_id= {$edit_user_id} ";
$resultSelectAll = mysqli_query($connection, $query);
while($row=mysqli_fetch_assoc($resultSelectAll)){
    $username = $row['username'];
    $password = $row['user_password'];
    $user_firstname = $row['user_firstname'];
    $user_lastname = $row['user_lastname'];
    $user_email = $row['user_email'];
    $user_role = $row['user_role'];
}
?>


<?php 
if(isset($_POST['edit_user'])){
    
    echo "<strong> USER EDITED SUCCESSFULLY </strong><br><br>";

    $username = $_POST['username'];
    $user_password = $_POST['password'];
    $user_firstname = $_POST['firstname'];
    $user_lastname = $_POST['lastname'];

    // $user_image = $_FILES['image']['name'];
    // $user_image_temp = $_FILES['image']['tmp_name'];

    $user_email = $_POST['email'];
    $user_role = $_POST['user_role'];

 //   move_uploaded_file($post_image_temp, "../images/$post_image");
$query = "SELECT randSalt FROM userstb";
$select_randsalt_query = mysqli_query($connection, $query);

if(!$select_randsalt_query){
die("Query Failed". mysqli_error($connection));
}
$row = mysqli_fetch_array($select_randsalt_query);
$salt = $row['randSalt'];
$hashed_password = crypt($user_password, $salt);



$query = "UPDATE userstb SET username = '{$username}', user_password = '{$hashed_password}', ";
$query .= "user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', ";
$query .= "user_email = '{$user_email}', user_role = '{$user_role}' WHERE user_id = {$edit_user_id}";


$result = mysqli_query($connection, $query);

confirmQuery($result);

}

?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
        <label for="username">Username</label>
        <input type="text" name="username" value="<?php echo $username; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="password">Password</label>
        <input type="password" name="password" value="<?php echo $password; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="firstname">Firstname</label>
        <input type="text" name="firstname" value="<?php echo $user_firstname; ?>" class="form-control">
    </div>

    <div class="form-group">
        <label for="lastname">Lastname</label>
        <input type="text" name="lastname" value="<?php echo $user_lastname; ?>" class="form-control">
    </div>

     <div class="form-group">
        <label for="email">Email</label>
        <input type="text" name="email" value="<?php echo $user_email; ?>" class="form-control">
    </div>

    <!-- <div class="form-group">
        <label for="image">User Image</label>
        <input type="file" name="image" class="form-control">
    </div> -->

    <div class="form-group">
        <label for="user_role">User Role</label>
        <select name="user_role" id="">
        <option  value='<?php echo $user_role; ?>'><?php echo $user_role; ?></option>
<?php

    if($user_role == 'admin'){
        echo "<option  value='subscriber'>subscriber</option>";
    }else{
        echo "<option  value='admin'>admin</option>";
    }

    
    

?> 
  
    </select><br><br>

    <div class="form-group">
        <input class="btn btn-primary" type="submit" name="edit_user" value="Edit User">
    </div>

</form>


