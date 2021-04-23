<!DOCTYPE html>
<html lang="en">
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="/assets/css/user/wall.css">
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
                        <li><a href="/users/dashboard">Dashboard</a></li>
                        <li><a href="/users/edit">Profile</a></li>
                    </ul>
                    <ul class="nav pull-right">
                        <li><a href="/users/logoff">Log off</a></li>
                    </ul>
                </div>
            </div>
        </div>       
        <div class="container margin">
            <div class="user_info">
                <h3><?= $records['user']['name'] ?></h3>
                <p><h4>Registered at: </h4><?= $records['user']['created_at'] ?></p>
                <p><h4>User ID: </h4><?= $records['user']['id'] ?></p>
                <p><h4>Email Address: </h4><?= $records['user']['email'] ?></p>
                <p><h4>Description: </h4><?= $records['user']['description'] ?></p>
            </div>
            <form action="/walls/message/<?= $records['user']['id'] ?>" method="post" class="textbox">
                <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash()?>">
                <h4>Leave a message for <?= $records['user']['first_name'] ?></h4>
                <input type="hidden" name="wall" value="<?= $records['user']['id'] ?>"/>
                <textarea name="message_input"></textarea>
                <input type="submit" class="btn btn-success btn-medium pull-right" value="Post"/>
            </form>
<?php       foreach ($records['messages'] as $message) { 
                if($message['wall'] == $records['user']['id']){ ?>
            <div class="msg_content">
                <p>
                    <h4><a href="/walls/show/<?= $message['id'] ?>" class='
                    <?php if($message['user_id'] == $this->session->userdata('user_id') || $message['user_id'] == $records['user']['id']){ echo "disable";}?>'>
                    <?= $message['name'] ?>
                    </a></h4>
                    <span class="pull-right"> <?= display_interval($message['created_at']); ?></span>
                </p>
                <textarea readonly><?= $message['message'] ?></textarea>
            </div>
<?php           foreach ($records['comments'] as $comment) { 
                    if( $message['message_id'] == $comment['message_id'] && $message['wall'] == $records['user']['id']){ ?>
                <div class="comment_content">
                    <p>
                        <h4><a href="/walls/show/<?= $comment['id'] ?>" class='
                        <?php if($comment['user_id'] == $this->session->userdata('user_id') || $comment['user_id'] == $records['user']['id']){ echo "disable";}?>'>
                        <?= $comment['name'] ?>
                        </a></h4>
                        <span class="pull-right"><?= display_interval($comment['created_at']); ?></span>
                    </p>
                    <textarea readonly><?= $comment['comment'] ?></textarea>
                </div>
<?php               }
                } ?>
                <form action="/walls/comment/<?= $records['user']['id'] ?>" method="post" class="comment">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name() ?>" value="<?= $this->security->get_csrf_hash()?>">
                    <input type="hidden" name="message_id" value="<?= $message['message_id'] ?>"/>
                    <textarea name="comment_input"></textarea>               
                    <input type="submit" class="btn btn-success btn-medium pull-right" value="Post"/>
                </form> 
<?php           }
            } ?>
        </div>
    </body>
</html>
<?php
/**Function to get Time Difference*/
function dateDifference($date_1 , $date_2 , $differenceFormat = '%a' ){
    $datetime1 = date_create($date_1);
    $datetime2 = date_create($date_2);
    $interval = date_diff($datetime1, $datetime2);
    return $interval->format($differenceFormat);
}
/**Function to get Time Invterval in convert in required Format*/
function display_interval($date){
    date_default_timezone_set('Asia/Manila');
    $dateNow = date('Y-m-j H:i:s', time());
    if(dateDifference($date, $dateNow, '%y') > 0){
        return date('F jS Y', $date);
    }
    else if(dateDifference($date, $dateNow, '%m') > 0){
        return date('F jS Y', $date);
    }
    else if(dateDifference($date, $dateNow, '%d') < 30 && dateDifference($date, $dateNow, '%d') > 0 ){
        $day = dateDifference($date, $dateNow, '%d');
        if ($day > 1){
            return  $day. " days ago";
        }
        else{
            return  $day. " day ago";
        }
    }
    else if(dateDifference($date, $dateNow, '%h') < 60 && dateDifference($date, $dateNow, '%h') > 0 ){
        $hour = dateDifference($date, $dateNow, '%h');
        if($hour > 1){
            return $hour . " hours ago";
        }
        else{
            return $hour . " hour ago";
        }
    }
    else if(dateDifference($date, $dateNow, '%i') < 60 && dateDifference($date, $dateNow, '%i') > 0){
        $minutes = dateDifference($date, $dateNow, '%i');
        if($minutes > 1){
            return $minutes . " minutes ago";
        }
        else{
            return $minutes . " minute ago";
        }
    }
    else if(dateDifference($date, $dateNow, '%s') < 60 ){
        return " just now";
    }
}
?>