<?php
/* Check if Variable is Empty. To Remove HTML Entities in Form Placeholder, twitter bootstrap 2 problem*/
/* Owner: Christian Earle C. Peralta */
if(empty($emailp)){ $emailp = ""; }
if(empty($first_namep)){ $first_namep = ""; }
if(empty($last_namep)){ $last_namep = ""; }
if(empty($email)){ $email = ""; }
if(empty($first_name)){ $first_name = ""; }
if(empty($last_name)){ $last_name = ""; }
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
    <link rel="stylesheet" href="/assets/css/admin/edit_user.css">
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
        <h3>Edit User # <?= $id ?></h3>
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
            <label>
                <h4>User Level:</h4>  
                <select name="user_level" id="user_level">
                    <option value="<?= $user_level ?>" default><?= ucfirst($user_level) ?></option>
<?php               if($user_level == "admin"){ ?>
                        <option value="normal">Normal</option>
<?php               }
                    else{ ?>
                        <option value="admin">Admin</option>
<?php               } ?>
                </select>
            </label>
            <input type="hidden" name="user_id" value="<?= $id ?>">
            <input type="submit" class="btn btn-success btn-large emphasize" value="Save">
        </form>
    </div>
</body>
</html>