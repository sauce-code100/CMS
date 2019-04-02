<?php include "../includes/dbConnection.php" ?>
<?php include "admin_functions.php" ?>
<?php ob_start();?>
<?php session_start(); ?>
<?php

// this piece of code even goes ahead to lock you out from the admin button on the frontpage
// I think the way it works is that by placing it on the admin header immedaitely after session start
// once you click on an admin link, it starts reading the codes from top, once it gets to the header 
// location redirection, it quicly throws you out, all these happens in split seconds, but ...it happens, smiles.
//that's simply how you block out people from accessing a particular page or link



if(!isset($_SESSION['user_role'])){
        header("Location: ../index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin - Bootstrap Admin Template</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="css/sb-admin.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link href="/CMS_TEMPLATE/admin/css/admin_styles.css" rel="stylesheet">
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script src="https://cdn.ckeditor.com/ckeditor5/12.0.0/classic/ckeditor.js"></script>

   



</head>

<body>