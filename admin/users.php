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
<?php

if(isset($_GET['source'])){
    $source = $_GET['source'];

}else{
    $source = '';
}

switch($source){
    case 'add_users':
    include "add_users.php";
    break;

    case 'edit_users':
    include "edit_users.php";
    break;

    default:
    include "view_all_users.php";
}


?>
        
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