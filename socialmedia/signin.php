<?php
include('includes/connection.php');
?>
 <!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Signin</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<style>
body{
    overflow: hidden;
}

.main-content{
    width: 50%;
    height: 40%;
    margin: 10px auto;
    background-color: #fff;
    border: 2px solid #e6e6e6;
    padding: 40px 50px;
}

.header{
   border: 0px solid #000;
   margin-bottom: 5px; 
}

.well{
    background-color: #187FAB;
}

#signin{
    width: 60%;
    border-radius: 30px;
}

.overlap-text{
    position: relative;
}

.overlap-text a{
    position: absolute;
    top: 8px;
    right: 10px;
    font-size: 14px;
    text-decoration: none;
    font-family: 'Overpass Mono', monospace;
    letter-spacing: -1px;
}
</style>
<body>
<div class="row">
    <div class="col-sm-12">
    <div class="well">
    <center> <h1 style="color:white;">Laspo Connect</h1></center>
    </div>
    </div>
    </div>

    <div class="row">
    <div class="col-sm-12">
    <div class="main-content">
    <div class="header">
    <h3 style="text-align:center;"><strong>Login to Laspo Connect</strong></h3><hr>
    </div>
    <div class="l-part">
    <form action="" method="post">
    <input type="email" name="email" placeholder="Email" required="required" class="form-control input-md"><br>
    <div class="overlap-text">
    <input type="password" name="pass" placeholder="Password" required="required" class="form-control input-md"><br>
    <a style="text-decoration:none;float: right;color:#187FAB;" data-toggle="tooltip" title="create account" href="forgot_password.php">Forgot?</a>
    </div>
    <a style="text-decoration:none;float:right;color:#187FAB;" data-toggle="tooltip" title="signin" href="signup.php">Don't have an Account?</a><br><br>
    <center><button id="signin" class="btn btn-info btn-lg" name="login">Login</button></center>
    <?php include('login.php'); ?>
    </form>
    </div>
    </div>
    </div>
    </div>
</body>
</html>