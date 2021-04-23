<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="/assets/css/bootstrap.css">
    <link rel="stylesheet" href="/assets/css/bootstrap-responsive.css">
    <link rel="stylesheet" href="/assets/css/user/dashboard.css">
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
                    <li><a href="#">Dashboard</a></li>
                    <li><a href="/edit/<?= $this->session->userdata('user_id') ?>">Profile</a></li>
                </ul>
                <ul class="nav pull-right">
                    <li><a href="/users/logoff">Log off</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="container margin">
        <h3>All Users</h3>
        <table class="table table-striped table-bordered">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>created_at</th>
                    <th>user_level</th>
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
                </tr>
<?php       } ?>
            </tbody>
        </table>
    </div>
</body>
</html>