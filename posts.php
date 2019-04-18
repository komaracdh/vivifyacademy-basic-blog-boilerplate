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

<div class="col-sm-8 blog-main">

<div class="blog-post">



<?php

             
                $sql = "SELECT Id, title, body, author, created_at FROM posts ORDER BY created_at DESC LIMIT 3";
                $statement = $connection->prepare($sql);
                $statement->execute();
                $statement->setFetchMode(PDO::FETCH_ASSOC);
                $posts = $statement->fetchAll();

            

            ?>

            <?php
                foreach ($posts as $post) {
            ?>

                    <article class="blog-post">
                        <header>
                        <h1 class="blog-post-title"><a href="single-posts.php?post_id=<?php echo($post['id']) ?>"><?php echo($post['title']) ?></a></h1>

                            
                            <div class="blog-post-meta"><?php echo($post['created_at'])?> <?php echo($post['author']) ?></div>
                        </header>

                        <div>
                            
                            <p class="blog-post"><?php echo($post['body']) ?></p>
                        </div>
                    </article>

            <?php
                }
            ?>
<nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
</nav> 
</div>
</div><!-- /.blog-main -->