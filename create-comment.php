<?php
$servername = "127.0.0.1";
   $username = "root";
   $password = "root";
   $dbname = "blog";
   $password = "";
   $dbname = "blog";

   try {
    $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $e)
{
    echo $e->getMessage();
}
?>
<?php include "header.php" ?>

<?php
$id = $_POST['id'];
if(!empty($_POST['author']) && !empty($_POST['comment'])) {
       $author = $_POST['author'];
       $comment = $_POST['comment'];
       $sqlInsert = "INSERT INTO comments (author, text, post_id) VALUES ('{$author}', '{$comment}', {$id});";
       $statementInsert = $connection->prepare($sqlInsert);
       $statementInsert->execute();
       $statementInsert->setFetchMode(PDO::FETCH_ASSOC);
       
       header("Location: http://localhost:8080/vivifyacademy-basic-blog-boilerplate/single-posts.php?post_id=$id");
} else{
    header("Location: http://localhost:8080/vivifyacademy-basic-blog-boilerplate/single-posts.php?post_id=$id&error=1");
}
   


?>

<?php include "footer.php" ?>