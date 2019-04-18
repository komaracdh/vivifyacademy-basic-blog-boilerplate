
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
<link href="styles/blog.css" rel="stylesheet">
<link href="styles/styles.css" rel="stylesheet">
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


            <?php

             
$sql = "SELECT Id, Title, Body, Author, Created_at FROM posts ORDER BY created_at DESC LIMIT 3";
$statement = $connection->prepare($sql);
$statement->execute();
$statement->setFetchMode(PDO::FETCH_ASSOC);
$posts = $statement->fetchAll();



?>


        

         


<aside class="col-sm-3 ml-sm-auto blog-sidebar">
            <div class="sidebar-module sidebar-module-inset">
                <h4>Latest posts</h4>
                <?php
                foreach ($posts as $post) {
            ?>
                  
        <a class="list-unstyled" href="single-posts.php?post_id=<?php echo($post['Id']) ?>"><?php echo($post['Title']) ?></a>    

            <?php
                }
            ?>

                </div>
            <div class="sidebar-module">
                <h4>Archives</h4>
                
            </div>
            <div class="sidebar-module">
                <h4>Elsewhere</h4>
                
            </div>
        </aside><!-- /.blog-sidebar -->