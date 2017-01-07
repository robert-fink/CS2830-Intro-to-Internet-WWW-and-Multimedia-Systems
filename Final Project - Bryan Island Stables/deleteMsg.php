<?php
  session_start();
  if(empty($_SESSION['user'])){
    header("Location: login.php");
  }
  if($_SESSION['user_type'] == 'user'){
    header("Location: page1.php");
  }
  /* require credentials! */
  require "db.conf";

  /* connect to database */
  $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname);

  /* check connection */
  if (!$link){
      printf("Connect failed: %s\n", mysqli_connect_error());
  }
  /* create a prepared statement */
  if($stmt = mysqli_prepare($link, "DELETE FROM message WHERE id=?")){
  /* bind variables to marker */
  mysqli_stmt_bind_param($stmt, 's', $_POST['id']);
  /* execute query */
  mysqli_stmt_execute($stmt);

  /* close statement */
  mysqli_stmt_close($stmt);

  header("Location: login.php");
}	?>
