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
                $per_page = 5;
                if(isset($_GET['page'])){

                    $page = $_GET['page'];
                }else{
                    $page = "";
                }

                    if($page== "" || $page == 1){
                        $page_1 = 0;
                    }else{
                        $page_1 = ($page*$per_page) - $per_page;
                    }



                $post_query_count = "SELECT * FROM poststb";
                $find_count = mysqli_query($connection, $post_query_count);
                $count = mysqli_num_rows($find_count);
                $count = ceil($count/$per_page);




                $query = "SELECT * FROM poststb LIMIT $page_1,$per_page";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $post_id = $row['post_id'];
                    $post_title = $row['post_title'];
                    $post_author = $row['post_author'];
                    $post_date = $row['post_date'];
                    $post_content = substr($row['post_content'], 0, 100);
                    $post_image = $row['post_image'];
                    $post_status = $row['post_status'];




                    if($post_status !== 'published'){

                        echo "";

                    }else{

                ?>
                <h2><a href="post.php?post_id=<?php echo $post_id ?>"><?php echo $post_title ?></a></h2>
                <p class="lead">
                    by <a href="author_posts.php?post_id=<?php echo $post_id; ?>&author=<?php echo $post_author; ?>"><?php echo $post_author ?></a>
                </p>
                <p><span class="glyphicon glyphicon-time"></span><?php echo $post_date ?></p>
                <hr>
                <a href="post.php?post_id=<?php echo $post_id ?>"><img class="img-responsive" src="images/<?php echo $post_image;?>" alt=""></a>
                <hr>
                <p><?php echo $post_content; ?></p>
                <a class="btn btn-primary" <a href="post.php?post_id=<?php echo $post_id ?>">Read More <span class="glyphicon glyphicon-chevron-right"></span></a>
                    
                <hr>

            <?php    } 
        
        }
        
        ?>
                <!-- Pager -->
                <!-- <ul class="pager">
                    <li class="previous">
                        <a href="#">&larr; Older</a>
                    </li>
                    <li class="next">
                        <a href="#">Newer &rarr;</a>
                    </li>
                </ul> -->

            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        <hr>

        <ul class="pager">

        <?php
        for($i = 1; $i <= $count; $i++){

            if($i ==$page){
                echo "<li><a class='active_link' href='index.php?page={$i}'>{$i}</a></li>";

            }else{

                echo "<li><a href='index.php?page={$i}'>{$i}</a></li>";

            }

        }
        
        
        ?>
        </ul>



        <!-- Footer -->
        <?php include "includes/footer.php" ?>