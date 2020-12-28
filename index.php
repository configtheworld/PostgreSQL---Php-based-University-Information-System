<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "university";

    

    //database connection
    $conn = new mysqli($servername,$username,$password,$dbname);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    session_start();
    $msg="";

    if(isset($_POST['login'])){
        $username = $_POST ['username'];
        $password = $_POST ['password'];
        $password = sha1($password);
        $userType = $_POST ['userType'];

        $sql = "SELECT * FROM users WHERE username=? AND password=? AND user_type=?";
        $stmt=$conn->prepare($sql);
        $stmt->bind_param("sss",$username,$password,$userType);
        $stmt->execute();
        $result = $stmt->get_result();
        $row=$result->fetch_assoc();
        

        session_regenerate_id();
        $_SESSION['username']=$row['username'];
        $_SESSION['role']=$row['user_type'];
        session_write_close();

        if($result->num_rows==1 && $_SESSION['role']=="student"){
            header("location:student.php");
        }else if ($result->num_rows==1 && $_SESSION['role']=="teacher"){
            header("location:teacher.php");
        }else if ($result->num_rows==1 && $_SESSION['role']=="admin"){
            header("location:admin.php");
        }else{
            $msg = "Oops username or password is incorrect!";
        }

    }
?>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>University</title>

    <!-- CSS only -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
<!-- JavaScript Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>
</head>
<body class="bg-dark">
    <div class="container d-flex justify-content-center">
        <div class="row">
            <div class="col bg-light mt-5 "style="border-radius:5%;">
                <h3 class="text-center text-primary p-3">University System</h3>
                <form action="<?= $_SERVER['PHP_SELF'] ?>" method="POST" class="p-4">

                    <h5 class="text-center text-secondary"> <?= $msg; ?></h5>

                    <div class="form-group">
                      <label for="">Name or Number</label>
                      <input type="text" name="username" id="" class="form-control" placeholder="username" aria-describedby="helpId"required>
                    </div>
                    <div class="form-group">
                      <label for="">Password</label>
                      <input type="password" name="password" id="" class="form-control" placeholder="password" aria-describedby="helpId"required>
                    </div>
                    <div class="form-group">
                        <label for="userType">You are a:</label>
                        <input type="radio" name="userType" value="student" class="custom-radio" required>&nbsp;Student|
                        <input type="radio" name="userType" value="teacher" class="custom-radio" required>&nbsp;Teacher|
                        <input type="radio" name="userType" value="admin" class="custom-radio" required>&nbsp;Admin
                    </div>
                    <div class="form-group d-flex justify-content-center" style="margin-top: 10px;">
                      <input type="submit" name="login" class="btn btn-lg btn-primary btn-block">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
</body>
</html>