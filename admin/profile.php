<?php include "includes/admin_header.php" ?>

    <div id="wrapper">

        <!-- Navigation -->
        <?php include "includes/admin_navigation.php" ?>

        <div id="page-wrapper">

            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">
                            Welcome to Admin
                            <small><?php echo $_SESSION['username']; ?></small>
                            <!-- <small>Author</small> -->
                        </h1>
                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

<?php include "../includes/functions.php" ?>

<?php

$query = "SELECT * FROM userstb WHERE username = '{$_SESSION['username']}' ";
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


 //   move_uploaded_file($post_image_temp, "../images/$post_image");

$query = "UPDATE userstb SET username = '{$username}', user_password = '{$user_password}', ";
$query .= "user_firstname = '{$user_firstname}', user_lastname = '{$user_lastname}', ";
$query .= "user_email = '{$user_email}' WHERE username = '{$_SESSION['username']}'";


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
        <input type="password" autocomplete="off" name="password" value="" class="form-control">
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
        <input class="btn btn-primary" type="submit" name="edit_user" value="Update Profile">
    </div>

</form>




        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php" ?>