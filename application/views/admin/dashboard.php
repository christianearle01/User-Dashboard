<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="/assets/css/admin/dashboard.css">
    <script src="/assets/js/bootstrap.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</head>
<body>
    <div class="navbar navbar-fixed-top">
        <div class="navbar-inner">
            <div class="container">
                <ul class="nav">
                    <li class="active">
                        <a href="#" class="brand">Test App</a>
                    </li>
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="/edit">Profile</a></li>
                </ul>
                <ul class="nav pull-right">
                    <li><a href="/users/logoff">Log off</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container margin">
        <p>
            <h3 class="link">Manage Users</h3>
            <a href="/users/new" class="btn btn-primary btn-large link pull-right emphasize">Add new</a>
        </p>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>created_at</th>
                    <th>user_level</th>
                    <th>actions</th>
                </tr>
            </thead>
            <tbody>
<?php       foreach ($records as $row) { ?>
                <tr>
                    <td><?= $row['id'] ?></td>
                    <td><a href='/walls/show/<?= $row['id'] ?>'><?= $row['name'] ?></a></td>
                    <td><?= $row['email'] ?></td>
                    <td><?= $row['created_at'] ?></td>
                    <td><?= $row['user_level'] ?></td>
                    <td>
                        <a href="/edit/<?= $row['id'] ?>" class='
<?php if($row['id'] == $this->session->userdata('user_id')){ echo "disable"; } ?> sibling btn btn-small btn-primary emphasize'>edit</a>
                        <a href="#" class='
<?php if($row['id'] == $this->session->userdata('user_id')){ echo "disable"; } ?> remove btn btn-small btn-danger emphasize'>remove</a>
                    </td>
                </tr>
<?php       } ?>
            </tbody>
        </table>
    </div>
    <script>
    $(document).ready(function() {
        $(".remove").click(function(){
            if(confirm('Are you sure to remove this record ?')) {
                var url = $(this).siblings(".sibling").attr("href");
                var remove_url = url.replace("edit", "delete");
                window.location = remove_url;
            }
        });
    });
    </script>
</body>
</html>