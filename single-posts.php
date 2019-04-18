<?php
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "blog";

  try {
      $connection = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
      // set the PDO error mode to exception
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
  }
  catch(PDOException $e)
  {
      echo $e->getMessage();
  }
?>

<!doctype html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <link rel="icon" href="../../../../favicon.ico">

  <title>Vivify Blog</title>

  <!-- Bootstrap core CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">

  <!-- Custom styles for this template -->
  <link href="styles/blog.css" rel="stylesheet">
  <link href="styles/styles.css" rel="stylesheet">
</head>
<?php include 'header.php'?>
<body>
<main role="main" class="container">

  <div class="row">
  <?php
              if (isset($_GET['post_id'])) {

                  $sql = "SELECT id, title, body, author, created_at FROM posts WHERE posts.id = {$_GET['post_id']}";
                  $statement = $connection->prepare($sql);

                  $statement->execute();

                  $statement->setFetchMode(PDO::FETCH_ASSOC);

                  $singlePost = $statement->fetch();
              }



  ?>
  <div class="blog-post">
      <h2 class="blog-post-title"><a href="single-posts.php?post_id=<?php echo($singlePost['id']) ?>"><?php echo($singlePost['title']) ?></a></h2>
      <p class="blog-post-meta"><?php echo($singlePost['created_at']) ?> by <?php echo($singlePost['author']) ?></p>
      <p><?php echo($singlePost['body']) ?></p>
<div class="form">
<form method="POST" action="create-comment.php" class="form">
<input type="text" placeholder="Author">
<input type="text" placeholder="Comment" style="display:block; margin-bottom:1rem" class="input-comment">
<input type="hidden" value="<?php echo $_GET['post_id']; ?>" name="id"/>
<input class="btn btn-default" type="submit" value="Submit">
</form>
</div>




      <button onclick ="hide()"  id="button">Hide comments</button>
   
        <script type="text/javascript">
        function hide() {
    var y = document.getElementById("button");
  var x = document.getElementById("comments");
  if (x.style.display === "none") {
   x.style.display = "block";
   y.innerHTML = "Hide comments";
  } else {
    x.style.display = "none";
    y.innerHTML = "Show comments";
  }
}
      </script>
      <div class="comments" id="comments">
          
          <h3>Comments</h3>
          <?php
          $sqlComments =
              "SELECT * FROM comments WHERE comments.post_id = {$_GET['post_id']}";
              "SELECT * FROM comments JOIN users ON comments.user_id = users.id WHERE comments.post_id = {$_GET['post_id']}";

              $statement = $connection->prepare($sqlComments);
              $statement->execute();

              $statement->setFetchMode(PDO::FETCH_ASSOC);

              $comments = $statement->fetchAll();
              foreach ($comments as $comment) {
          ?>

          <ul>
          <li class="single-comment">
               <div>posted by: <?php echo $comment['author'] ?></div>
              <div> <?php echo $comment['text'] ?> </div>
          </li>
          <?php } ?>
          </ul>
      </div>
  </div>
      <?php include 'sidebar.php'?>

  </div>

</main>

<footer class="blog-footer">
 <?php include "footer.php" ?>
</footer>
</body>
</html>

