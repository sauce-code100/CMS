<?php session_start(); ?>
   <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <div class="container">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="index.php">HOME</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">

            <!-- DATABASE AREA -->
            <?php
            $query = "SELECT * FROM categoriestb";
            $result = mysqli_query($connection, $query);
            while($row = mysqli_fetch_assoc($result)){
                $cat_title = $row['cat_title'];
                echo  "<li> <a href='#'>{$cat_title}</a></li>";    
            } 
            ?>
            
                <li> <a href='admin/index.php'>ADMIN</a></li>
                <li> <a href='registration.php'>Register</a></li>
           <?php
           if(isset($_SESSION['user_role'])){
            if(isset($_GET['post_id'])){
               echo  $post_id = $_GET['post_id'];

               echo "<li><a href='/CMS_TEMPLATE/admin/posts.php?source=edit_posts&edit={$post_id}'>Edit Post</a></li>";
            

            }

           }
           
           

           ?>
            </ul>
                   
                
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>