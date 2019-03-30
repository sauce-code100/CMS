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


                }
            ?>



                <?php
                $query = "SELECT * FROM poststb WHERE post_id={$the_post_id}";
                $result = mysqli_query($connection, $query);
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
                    by <a href="#"><?php echo $post_author ?></a>
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

               <!-- Blog Comments -->



               <?php

if(isset($_POST['create_comment'])){

$comment_post_id = $_GET['post_id'];
$comment_author = $_POST['comment_author'];
$comment_email = $_POST['comment_email'];
$comment_content = $_POST['comment_content'];

if(!empty($comment_author) && !empty($comment_email) && !empty($comment_content)){
    $queryComment = "INSERT INTO commentstb (comment_post_id, comment_author, comment_email, comment_content, comment_status, comment_date)";
    $queryComment .= " VALUES ($comment_post_id, '{$comment_author}', '{$comment_email}', '{$comment_content}', 'Unapproved', now() )";
    
    $resultComment = mysqli_query($connection, $queryComment);
    
    if(!$resultComment){
        die("QUERY FAILED". mysqli_error($connection));
    
    }
    
    //look out for this code
    $query = "UPDATE poststb SET post_comment_count = post_comment_count+1 ";
    $query .= "WHERE post_id = $comment_post_id";
    $updateCommentCountResult = mysqli_query($connection, $query);
    $message = "Comment Submitted successfully";


}else{
    $message = "Fields cannot be empty";
}




} else{
    $message = "";
} 


?>



                <!-- Comments Form -->
                <div class="well">
                    <h4>Leave a Comment:</h4>
                    <?php echo "<h4 class='text-center'>{$message}</h4>"  ?>
                    <form action="" method="post" role="form">
                        <div class="form-group">
                        <label for="comment_author"><strong>Author:</strong></label>
                          <input class="form-control" type="text" name="comment_author">  
                        </div>

                        <div class="form-group">
                        <label for="comment_email"><strong>Email:</strong></label>
                          <input class="form-control" type="email" name="comment_email" >  
                        </div>


                        <div class="form-group">
                        <label for="comment_content"><strong>Your Comment:</strong></label>
                            <textarea name="comment_content" class="form-control" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary" name="create_comment">Submit</button>
                    </form>
                </div>

                <hr>




<?php 

$displayCommentQuery = "SELECT * FROM commentstb WHERE comment_post_id = $the_post_id AND comment_status = 'approved'";
$displayCommentQuery .= " ORDER BY comment_id DESC";
$displayCommentResult = mysqli_query($connection, $displayCommentQuery);
while($row=mysqli_fetch_assoc($displayCommentResult)){
    $comment_date = $row['comment_date'];
    $comment_author = $row['comment_author'];
    $comment_content = $row['comment_content'];


?>
    <!-- Posted Comments -->

    <!-- Comment -->
    <div class="media">
        <a class="pull-left" href="#">
            <img class="media-object" src="http://placehold.it/64x64" alt="">
        </a>
        <div class="media-body">
            <h4 class="media-heading"><?php echo $comment_author ?>
                <small><?php echo $comment_date ?></small>
            </h4>
            <?php echo $comment_content ?>
        </div>
    </div>

<?php   

}


?>


               








            </div>

            <!-- Blog Sidebar Widgets Column -->
            <?php include "includes/sidebar.php" ?>

        <hr>

        <!-- Footer -->
        <?php include "includes/footer.php" ?>