<!DOCTYPE html>
<?php 
session_start();

include('includes/header.php');

if (!isset($_SESSION['user_email'])){
    header("location: index.php");
}
?>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>See Results</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="style/home_style.css">
</head>

<body>
<div class="row">
<center><h2>See Your Results Here!</h2></center>
<?php results(); ?>
</div>
</body>
</html>
