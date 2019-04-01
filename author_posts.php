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

                <!-- First Blog Post -->
<?php 
                if(isset($_GET['post_id'])){
                    $the_post_id = $_GET['post_id'];
                    $the_post_author = $_GET['author'];


                }
            
                $query = "SELECT * FROM poststb WHERE post_author='{$the_post_author}'";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_content = $row['post_content'];
                    $post_image = $row['post_image'];
                ?>
                <h2><a href="#"><?php echo $post_title ?></a></h2>
                <p class="lead">
                    by <?php echo $post_author ?>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <img class="img-responsive" src="images/<?php echo $post_image;?>" alt="">
                <hr>
                <p><?php echo $post_content ?></p>
                <hr>

            <?php    } ?>


                <!-- Pager -->
                <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul>



            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>