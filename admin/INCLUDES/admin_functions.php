<?php 
    function AddCategory(){
        global $connection;
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
    

    }


    


    function UpdateCategory(){

        //Didn't Work. Got Issues with the $update_category variable
        // global $connection;
        // if(isset($_GET['edit'])){
        //     $edit_id = $_GET['edit'];
        //     $query = "SELECT * FROM categoriestb WHERE cat_id = {$edit_id}";
        //     $result = mysqli_query($connection, $query);
            
        //     while($row = mysqli_fetch_assoc($result)){
        //         $update_category = $row['cat_title'];
        //         global $update_category;
               
        //     }
        // }  
            
            
        //     if(isset($_POST['update'])){
        //         $update_category = $_POST['edit'];

        //         if($update_category== "" || empty($update_category) ){
        //             echo "This field can't be left blank";
        //         }else {

        //             echo "Category Updated"; //continue working here
        //         $query = "UPDATE categoriestb SET cat_title = '{$update_category}' WHERE cat_id = '{$edit_id}' ";
        //         $result = mysqli_query($connection, $query);
        //         if(!$result){
        //             die("QUERY FAILED" . mysqli_error($connection));
        //         }
        //         }
        //        } 

    }

?>