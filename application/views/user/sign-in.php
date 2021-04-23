<?php
/* Check if Variable is Empty. To Remove HTML Entities in Form Placeholder, twitter bootstrap 2 problem*/
/* Owner: Christian Earle C. Peralta */
if(empty($email)){ $email = ""; }
if(empty($password)){ $password = ""; }
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
    <link rel="stylesheet" href="/assets/css/user/sign-in.css">
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
                    <li><a href="#">Sign In</a></li>
                </ul>
            </div>
        </div>
    </div>
    <form action="/users/signin_validate" method="post">
        <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash()?>">
        <h2>Sign in</h2>
        <label>
            <h4>Email Address:</h4> 
            <input type="text" class="input-small" name="email" placeholder='<?= strip_tags($email) ?>'>
        </label>
        <label>
            <h4>Password:</h4>  
            <input type="password" class="input-small" name="password" placeholder='<?= strip_tags($password) ?>'>
        </label>
        <a href="/register">Don't have an account? Register</a>
        <input type="submit" class="btn btn-success btn-large block emphasize" value="Sign in">
    </form>
</body>
</html>