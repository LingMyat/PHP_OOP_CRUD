<?php
require_once('./config.php');
require_once('./createClass.php');
session_start();
if (empty($_SESSION['login'])) {
    echo "<script>window.location.href='./login.php'</script>";
}
if (isset($_POST['logout'])) {
    session_destroy();
    echo "<script>window.location.href='./login.php'</script>";
}
    $posts = $postClass->allDesc();
if (isset($_GET['deleteId'])) {
    $postClass->delete();
    echo "<script>window.location.href='./index.php'</script>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>index</title>
    <!-- CSS only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
</head>
<body>
    <div class="container">
    
    <div class="row">
        <div class="col-10 offset-1">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-item-center">
                        <h4>Posts</h4>
                        <a href="./create.php" class="btn btn-success">Add+</a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                            <th>Title</th>
                            <th>Content</th>
                            <th>Created_at</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php 
                            if ($posts) {
                                foreach ($posts as  $post) {
                                ?>
                                <tr>
                                    <td><?php echo $post['title'] ?></td>
                                    <td><?php echo substr($post['content'],0,50) ?></td>
                                    <td><?php echo date('d/M/Y h:i A',strtotime($post['created_at'])) ?></td>
                                    <td>
                                        <a href="./edit.php?id=<?php echo $post['id'] ?>">Edit</a>
                                        <a href="index.php?deleteId=<?php echo $post['id'] ?>">Delete</a>
                                    </td>
                                </tr>
                                <?php
                                }
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
                <div class="card-footer">
                <form action="index.php" method="POST">
                    <button class="btn btn-danger float-end" name="logout" type="submit">Logout</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
