<?php
require_once('./config.php');
require_once('./createClass.php');
session_start();
if (empty($_SESSION['login'])) {
    echo "<script>window.location.href='./login.php'</script>";
}
$currentPost = $postClass->find();
$errorTitle = $image = $errorContent = $title = $content = "";
if (isset($_POST['update'])) {
    empty($_POST['title'])? $errorTitle = 'This title field is required' : $title = $_POST['title'];
    empty($_POST['content'])? $errorContent = 'This content field is required' : $content = $_POST['content'];
    if ($title<>'' && $content<>'') {
        if (empty($_FILES['image']['name'])) {
            $image = $currentPost['image'];
            $postClass->update($title,$content,$image);
        } else {
            $image = rand().$_FILES['image']['name'];
            $postClass->update($title,$content,$image);
            Image::store($image);
        }
       
       header('location:index.php');
    }
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
                    <div class="d-flex align-item-center justify-content-between">
                        <h4>Edit Post</h4>
                        <a href="./index.php" class=" btn btn-light">Back</a>
                    </div>
                </div>
                <div class="card-body">
                <form action="" method="POST" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Title</label>
                        <input type="text" name="title" value="<?php if (isset($_POST['update'])) { echo $title; }else{echo $currentPost['title'];} ?>" class="form-control" id="exampleInputEmail1">
                        <div class="text-danger"><?php echo $errorTitle ?></div>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Content</label>
                        <textarea name="content" id="" class="form-control" cols="30" rows="8"><?php if (isset($_POST['update'])) { echo $content; }else{echo $currentPost['content'];}?></textarea>
                        <div class="text-danger"><?php echo $errorContent ?></div>
                    </div>
                    <img style="width:200px ;height:130px;" src="./image/<?= $currentPost['image']; ?>" alt="" class="mb-3">
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Image</label>
                        <input type="file" name="image" id="" class="form-control">
                    </div>
                    <button type="submit" name="update" class="btn btn-primary">Update</button>
                </form>
                </div>
            </div>
        </div>
    </div>
    </div>
</body>
</html>
