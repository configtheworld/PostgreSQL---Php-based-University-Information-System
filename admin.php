<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['role'] != "admin") {
    header("location:index.php");
}


?>


<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>

    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
    <!-- JavaScript Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous">
    </script>
</head>

<body class="bg-dark">
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col bg-light mt-5 " style="border-radius:5%;">
                <h3 class="text-center text-primary p-3">University System</h3>
                <div class="jumbotron row" style="margin-bottom: 10px;">
                    <div class="col-4">
                        <img src="https://cdn.business2community.com/wp-content/uploads/2017/08/blank-profile-picture-973460_640.png" style="width: 150px;height:150px;border-radius:10%">
                        <a href="logout.php" target="_blank" class="btn btn-sm btn-danger" style="margin-top:5px;">Logout</a>
                    </div>

                    <div class="col-8">
                        <h3>Admin Informations</h3>
                        <ul class="list-group">
                            <li class="list-group-item">Admin info : <?= $_SESSION['username'] ?></li>
                            <li class="list-group-item">Status :<?= $_SESSION['role'] ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>