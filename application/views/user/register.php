<?php
/* Check if Variable is Empty. To Remove HTML Entities in Form Placeholder, twitter bootstrap 2 problem*/
/* Owner: Christian Earle C. Peralta */
if(empty($email)){ $email = ""; }
if(empty($first_name)){ $first_name = ""; }
if(empty($last_name)){ $last_name = ""; }
if(empty($password)){ $password = ""; }
if(empty($password_confirmation)){ $password_confirmation = ""; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="/assets/css/user/register.css">
    <script src="/assets/js/bootstrap.js"></script>
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li class="active">
                        <a href="#" class="brand">Test App</a>
                    </li>
                    <li><a href="/users">Home</a></li>
                    <li class="divider-vertical"></li>
                </ul>
                <ul class="nav pull-right">
                    <li><a href="/sign-in">Sign In</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form action="/users/register_validate" method="post">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash()?>">
        <h2>Register</h2>
        <label>
            <h4>Email Address:</h4> 
            <input type="text" name="email" placeholder='<?= strip_tags($email) ?>'>
        </label>
        <label>
            <h4>First Name:</h4> 
            <input type="text" name="first_name" placeholder='<?= strip_tags($first_name) ?>'>
        </label>
        <label>
            <h4>Last Name:</h4> 
            <input type="text" name="last_name" placeholder='<?= strip_tags($last_name) ?>'>
        </label>
        <label>
            <h4>Password:</h4>  
            <input type="password" name="password" placeholder='<?= strip_tags($password) ?>'>
        </label>
        <label>
            <h4>Password Confirmation:</h4>  
            <input type="password" name="password_confirmation" placeholder='<?= strip_tags($password_confirmation) ?>'>
        </label>
        <input type="submit" class="btn btn-success btn-large block emphasize" value="Register">
        <a href="/sign-in">Already have an account? Login</a>
    </form>
</body>
</html>