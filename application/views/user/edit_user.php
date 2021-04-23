<?php
/* Check if Variable is Empty. To Remove HTML Entities in Form Placeholder, twitter bootstrap 2 problem*/
/* Owner: Christian Earle C. Peralta */
if(empty($emailp)){ $emailp = ""; }
if(empty($first_namep)){ $first_namep = ""; }
if(empty($last_namep)){ $last_namep = ""; }
if(empty($email)){ $email = ""; }
if(empty($first_name)){ $first_name = ""; }
if(empty($last_name)){ $last_name = ""; }
if(empty($description)){ $description = ""; }
if(empty($old_password)){ $old_password = ""; }
if(empty($new_password)){ $new_password = ""; }
if(empty($new_password_confirmation)){ $new_password_confirmation = ""; }
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
    <link rel="stylesheet" href="/assets/css/user/edit_user.css">
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
                    <li><a href="/dashboard">Dashboard</a></li>
                    <li><a href="#">Profile</a></li>
                </ul>
                <ul class="nav pull-right">
                    <li><a href="/users/logoff">Log off</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container margin">
        <h3>Edit Profile</h3>
        <form action="/users/edit_validation" method="post">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash()?>">
            <h3>Edit Information</h3>
            <label>
                <h4>Email Address:</h4> 
                <input type="text" name="email" value="<?= $email ?>" placeholder="<?= strip_tags($emailp) ?>">
            </label>
            <label>
                <h4>First Name:</h4> 
                <input type="text" name="first_name" value="<?= $first_name ?>" placeholder="<?= strip_tags($first_namep) ?>">
            </label>
            <label>
                <h4>Last Name:</h4> 
                <input type="text" name="last_name" value="<?= $last_name ?>" placeholder="<?= strip_tags($last_namep) ?>">
            </label>
            <input type="submit" class="btn btn-success btn-large emphasize" value="Save">
        </form>
        <form action="/users/changepass_validation" method="post" class="pull-right">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash()?>">
            <h3>Change Password</h3>
            <label>
                <h4>Current Password:</h4>  
                <input type="password" name="old_password" placeholder="<?= strip_tags($old_password) ?>">
            </label>
            <label>
                <h4>New Password:</h4>  
                <input type="password" name="new_password" placeholder="<?= strip_tags($new_password) ?>">
            </label>
            <label>
                <h4>New Password Confirmation:</h4>  
                <input type="password" name="new_password_confirmation" placeholder="<?= strip_tags($new_password_confirmation) ?>">
            </label>
            <input type="submit" class="btn btn-success btn-large emphasize" value="Update Password">
        </form>
        <form action="/users/update_profile_description" method="post" class="description">
            <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash()?>">
            <h3>Edit Description</h3>
            <textarea name="description"><?= $description ?></textarea>
            <input type="hidden" name="user_id" value="<?= $id ?>">
            <input type="submit" class="btn btn-success btn-large emphasize" value="Save">
        </form>
    </div>
</body>
</html>