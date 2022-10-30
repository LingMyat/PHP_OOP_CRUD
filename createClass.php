<?php 
class Post{
    protected $pdo ;
    public function create($title,$content,$image){
        $addPostQuery = "INSERT INTO posts (title,content,image) VALUE (:title,:content,:image)";
        $stmt = $this->pdo->prepare($addPostQuery);
        $stmt->execute([':title'=>$title,':content'=>$content,':image'=>$image]);
    }
    public function all(){
        $getPostQuery = 'SELECT * FROM posts';
        return $this->get($getPostQuery);
    }
    public function allDesc(){
        $getPostQueryDesc = 'SELECT * FROM posts ORDER BY id DESC';
        return $this->get($getPostQueryDesc);
    }
    public function delete(){
        $deletePostQuery = "DELETE FROM posts WHERE id = :id";
        $stmt = $this->pdo->prepare($deletePostQuery);
        $stmt->bindValue(':id',$_GET['deleteId']);
        $stmt->execute();
    }
    public function find(){
        $getCurrentPostQuery = "SELECT * FROM posts WHERE id = :currentPostId";
        $stmt = $this->pdo->prepare($getCurrentPostQuery);
        $stmt->bindValue(':currentPostId',$_GET['id']);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    public function update($title,$content,$image){
        $updateCurrentPostQuery = "UPDATE posts SET title=:title,content=:content,image=:image WHERE id = :currentPostId";
        $stmt = $this->pdo->prepare($updateCurrentPostQuery);
        $stmt->execute(array(':title'=>$title,':content'=>$content,':currentPostId'=>$_GET['id'],':image'=>$image));
    }
    private function get($query){
        $stmt = $this->pdo->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll();
    }
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
}
Class Image{
    static function store($image){
        $tmpName = $_FILES['image']['tmp_name'];
        $patch = 'image/'.$image;
        move_uploaded_file($tmpName,$patch);
    }
}
Class User{
    protected $pdo;
    public function create($name,$email,$hashPassword){
        $registerQuery = 'INSERT INTO users (name,email,password) value (:name,:email,:password)';
        $stmt = $this->pdo->prepare($registerQuery);
        return $stmt->execute(array(':name'=>$name,':email'=>$email,':password'=>$hashPassword));
    }
    public function findEmail($email){
        $getEmailQuery = "SELECT * FROM users WHERE email = :email";
            $stmt = $this->pdo->prepare($getEmailQuery);
            $stmt->bindValue(':email',$email);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
    }
    function __construct($pdo)
    {
        $this->pdo = $pdo;
    }
}