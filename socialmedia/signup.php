<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Signup</title>
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

#signup{
    width: 60%;
    border-radius: 30px;
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
    <h3 style="text-align:center;"><strong>Join Laspo Connect</strong></h3><hr>
    </div>
    <div class="l-part">
    <form action="" method="post">
    <div class="input-group">
    <span class="input-group-addon"><i class="glypicon glypicon-pencil"></i></span>
    <input type="text" class="form-control" name="first_name" placeholder="First Name" required="required"><br>
    </div>
    <div class="input-group">
    <span class="input-group-addon"><i class="glypicon glypicon-pencil"></i></span>
    <input type="text" class="form-control" name="last_name" placeholder="Last Name" required="required"><br>
    </div>
    <div class="input-group">
    <span class="input-group-addon"><i class="glypicon glypicon-lock"></i></span>
    <input id="password" type="password" class="form-control" name="u_pass" placeholder="Password" required="required"><br>
    </div>
    <div class="input-group">
    <span class="input-group-addon"><i class="glypicon glypicon-user"></i></span>
    <input id="email" type="email" class="form-control" name="u_email" placeholder="Email" required="required"><br>
    </div>
    <div class="input-group">
    <span class="input-group-addon"><i class="glypicon glypicon-chevron-down"></i></span>
    <select class="form-control" name="u_country" required="required">
    <option disabled>Select your Country</option>
    <option>Nigeria</option>
    <option>Benin</option>
    <option>Togo</option>
    <option>Ghana</option>
    <option>Ivory Coast</option>
    <option>United States of America</option>
    <option>South Africa</option>
    </select>
    </div><br>
    <div class="input-group">
    <span class="input-group-addon"><i class="glypicon glypicon-chevron-down"></i></span>
    <select class="form-control input-md" name="u_gender" required="required">
    <option disabled>Select your Gender</option>
    <option>Male</option>
    <option>Female</option>
    <option>Others</option>
    </select>
    </div><br>
    <div class="input-group">
    <span class="input-group-addon"><i class="glypicon glypicon-calendar"></i></span>
    <input type="date" class="form-control input-md" name="u_birthday" placeholder="Birthday" required="required"><br>
    </div><br>
    <a style="text-decoration:none;float:right;color:#187FAB;" data-toggle="tooltip" title="signin" href="signin.php">Already have an account?</a><br><br>
    <center><button id="signup" class="btn btn-info btn-lg" name="sign_up">Sign Up</button></center>
    <?php include('insert_user.php'); ?>
    </form>
    </div>
    </div>
    </div>
    </div>
</body>
</html>