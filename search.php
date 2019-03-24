<?php include "includes/dbConnection.php" ?>
<?php include "includes/header.php" ?>

    <!-- Navigation -->
<?php include "includes/navigation.php" ?>

    <!-- Page Content -->
    <div class="container">

        <div class="row">

            <!-- Blog Entries Column -->
            <div class="col-md-8">

                <h1 class="page-header">
                    CONTENT MANAGEMENT SYSTEM
                    <small>Using PHP</small>
                </h1>

              
                <?php
                    if(isset($_POST['submit'])){
                        $search = $_POST['search'];

                        $query = "SELECT * FROM poststb WHERE post_tags LIKE '%$search%' ";
                        $result = mysqli_query($connection, $query);
                        if(!$result){
                            die("QUERY FAILED" . mysqli_error($connection));
                        }


                        $count = mysqli_num_rows($result);
                        if($count == 0){
                            echo "<h1>NO RESULT</h1>";
                        }else{

                            while($row = mysqli_fetch_assoc($result)){
                                $post_title = $row['post_title'];
                                $post_author = $row['post_author'];
                                $post_date = $row['post_date'];
                                $post_content = $row['post_content'];
                                $post_image = $row['post_image'];
                            ?>
              <h2>
                                <a href="#"><?php echo $post_title ?></a>
                            </h2>
                            <p class="lead">
                                by <a href="index.php"><?php echo $post_author ?></a>
                            </p>
                            <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                            <hr>
                            <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                            <hr>
                            <p><?php echo $post_content ?></p>
                            <a class="btn btn-primary" href="#">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
            
                            <hr>
            
                        <?php    } 
                        }
                    }
                    ?>


               

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>