<?php  include "includes/dbConnection.php"; ?>
<?php  include "includes/header.php"; ?>


    <!-- Navigation -->
<?php  include "includes/navigation.php"; ?>

<?php
if(isset($_POST['submit'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];


    if(!empty($username) && !empty($password) && !empty($email)){

        $username = mysqli_real_escape_string($connection, $username);
        $password = mysqli_real_escape_string($connection, $password);
        $email = mysqli_real_escape_string($connection, $email);
    
        $query = "SELECT randSalt FROM userstb";
        $randSaltResult = mysqli_query($connection, $query);
    
        if(!$randSaltResult){
            die("Query Failed". mysqli_error($connection));
        }
    
        $row = mysqli_fetch_array($randSaltResult);
        $salt = $row['randSalt'];   
    
        $password =crypt($password, $salt);
    
        $query = "INSERT INTO userstb(username, user_password, user_email, user_role) VALUES ('{$username}','{$password}','{$email}', 'subscriber')";
        $register_user_result = mysqli_query($connection, $query);
        if(!$register_user_result){
            die("Query Failed" . mysqli_error($connection));
        }

        $message = "User registered Successfully";

    }else{
        $message = "Fields cannot be Empty";
    }

}else{
    $message = "";
}
?>

    
 
    <!-- Page Content -->
<div class="container">
    
<section id="login">
    <div class="container">
        <div class="row">
            <div class="col-xs-6 col-xs-offset-3">
                <div class="form-wrap">
                <h1>Register</h1>
                <h4 class="text-center"><?php echo $message; ?></h4>
                    <form role="form" action="registration.php" method="post" id="login-form" autocomplete="off">
                        <div class="form-group">
                            <label for="username" class="sr-only">username</label>
                            <input type="text" name="username" id="username" class="form-control" placeholder="Enter Desired Username">
                        </div>
                         <div class="form-group">
                            <label for="email" class="sr-only">Email</label>
                            <input type="email" name="email" id="email" class="form-control" placeholder="somebody@example.com">
                        </div>
                         <div class="form-group">
                            <label for="password" class="sr-only">Password</label>
                            <input type="password" name="password" id="key" class="form-control" placeholder="Password">
                        </div>
                
                        <input type="submit" name="submit" id="btn-login" class="btn btn-custom btn-lg btn-block" value="Register">
                    </form>
                 
                </div>
            </div> <!-- /.col-xs-12 -->
        </div> <!-- /.row -->
    </div> <!-- /.container -->
</section>


        <hr>



<?php include "includes/footer.php";?>
