<?php
    session_start();
    require_once('./config.php');
    if (!empty($_SESSION['login'])) {
        echo "<script>history.back()</script>";
    }
    $name = $email = $password = $errName = $errEmail = $errPassword = '';
    if (isset($_POST['register'])) {
        empty($_POST['name'])? $errName = 'This name field is required.' : $name = $_POST['name'];
        empty($_POST['email'])? $errEmail = 'This email field is required.' : $email = $_POST['email'];
        empty($_POST['password'])? $errPassword = 'This password field is required.' : $password = $_POST['password'];
        if ($name<>''&&$email&&$password<>'') {
            $row = $userClass->findEmail($email);
            if (empty($row)) {
                $hashPassword = password_hash($password,PASSWORD_BCRYPT);
                $result = $userClass->create($name,$email,$hashPassword);
                if ($result) {
                    $_SESSION['login'] = 'logined';
                    header('location:index.php');
                }

            } else {
                $errEmail = 'This email is already registered.';
            }
            
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-8 offset-2">
                <div class="card">
                    <div class="card-body">
                        <form action="register.php" method="POST">
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Name</label>
                                <input type="text" name="name" value="<?php echo $name; ?>" class="form-control" id="exampleInputPassword1">
                                <div class="text-danger"><?php echo $errName ?></div>
                            </div>   
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Email address</label>
                                <input type="email" name="email" value="<?php echo $email; ?>" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                                <div class="text-danger"><?php echo $errEmail ?></div>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPassword1" class="form-label">Password</label>
                                <input type="password" name="password" class="form-control" id="exampleInputPassword1">
                                <div class="text-danger"><?php echo $errPassword ?></div>
                            </div>
                            <div class="d-flex justify-content-between align-items-center px-3">
                                    <a class=" text-decoration-none mt-2" href="./login.php">Already registered?login now</a>
                                    <button type="submit" name='register' class="btn btn-primary">Register</button>
                            </div> 
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>