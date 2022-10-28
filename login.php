<?php 
session_start();
require_once('./config.php');
if (!empty($_SESSION['login'])) {
    echo "<script>history.back()</script>";
}
$email = $password = $errEmail = $errPassword = '';
if (isset($_POST['login'])) {
    empty($_POST['email'])? $errEmail = 'This email field is required.' : $email = $_POST['email'];
    empty($_POST['password'])? $errPassword = 'This password field is required.' : $password = $_POST['password'];
    if($email<>''&&$password<>''){
        $data = $userClass->findEmail($email);
        if (password_verify($password,$data['password'])) {
            $_SESSION['login']='logined';
            header('location:index.php');   
        } else {
            $errPassword = 'Please enter a valid password';
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
    <title>Login</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
            <div class="row">
                <div class="col-8 offset-2">
                    <div class="card">
                        <div class="card-body">
                            <form action="login.php" method="POST"> 
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
                                    <a class=" text-decoration-none mt-2" href="./register.php">If you don't have acc please register now</a>
                                <button type="submit" name='login' class="btn btn-primary">Login</button>
                                </div>
                            </form>
                            
                        </div>
                    </div>
                </div>
            </div>
    </div>
</body>
</html>