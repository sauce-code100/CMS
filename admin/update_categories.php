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
                            <small>Author</small>
                        </h1>

            <div class="col-xs-6">
            <form action="" method="post">
                <div class="form-group">
                    <label for="cat_title">Add Category</label>
                    <input class = 'form-control' type="text" name='cat_title'>
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name='submit' value="Add Category">
                </div>

            </form>

        <?php    
        
        if(isset($_GET['edit'])){
            $edit_id = $_GET['edit'];
            $query = "SELECT * FROM categoriestb WHERE cat_id = {$edit_id}";
            $result = mysqli_query($connection, $query);
            
            while($row = mysqli_fetch_assoc($result)){
                $update_category = $row['cat_title'];
               
            }
        }  
            
            
            if(isset($_POST['update'])){
                $update_category = $_POST['edit'];

                if($update_category== "" || empty($update_category) ){
                    echo "This field can't be left blank";
                }else {

                    echo "Category Updated"; //continue working here
                $query = "UPDATE categoriestb SET cat_title = '{$update_category}' WHERE cat_id = '{$edit_id}' ";
                $result = mysqli_query($connection, $query);
                if(!$result){
                    die("QUERY FAILED" . mysqli_error($connection));
                }
                }
               } 

        ?>

         <form action="" method="post">
                <div class="form-group">
                    <label for="edit">Edit Category</label>
                    <input class = 'form-control' type="text" name='edit' value= "<?php echo $update_category; ?>">
                </div>
                <div class="form-group">
                    <input class="btn btn-primary" type="submit" name='update' value="UPDATE">
                </div>

            </form>

        
        
        <?php 
            
                if(isset($_POST['submit'])){
                    $new_category = $_POST['cat_title'];

                    if($new_category== "" || empty($new_category) ){
                        echo "This field can't be left blank";
                    }else {

                        echo "Category Added"; //continue working here
                    $query = "INSERT INTO categoriestb(cat_title) VALUE('{$new_category}') ";
                    $result = mysqli_query($connection, $query);
                    if(!$result){
                        die("QUERY FAILED" . mysqli_error($connection));
                    }
                    }

                } 

            ?>


            </div><!-- Add Category Form -->
            <div class="col-xs-6">
            <table class="table table-bordered table-hover">
                <tbody>
                    <thead>
                    <tr>
                        <td>Id</td>
                        <td>Category Title</td>
                        <td>Delete</td>
                        <td>Edit</td>
                    </tr>

                     <?php 
                $query = "SELECT * FROM categoriestb";
                $result = mysqli_query($connection, $query);
                while($row = mysqli_fetch_assoc($result)){
                    $cat_id = $row['cat_id'];
                    $cat_title = $row['cat_title'];

                echo    "<tr>
                        <td>$cat_id</td>
                        <td>$cat_title</td>
                        <td><a href='categories.php?delete={$cat_id}'>Delete</a></td>
                        <td><a href='update_categories.php?edit={$cat_id}'>Edit</a></td>
                    </tr>";
                }
        
                
                    if(isset($_GET['delete'])){
                        $id_delete = $_GET['delete'];
                        $query = "DELETE FROM categoriestb WHERE cat_id = {$id_delete} " ;
                        $result = mysqli_query($connection, $query);
                        header("Location: categories.php");
                   
                    }
                    
                    ?>

                  </thead>
                </tbody>
            </table>

                        
                    </div>
                </div>
                <!-- /.row -->

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <?php include "includes/admin_footer.php" ?>