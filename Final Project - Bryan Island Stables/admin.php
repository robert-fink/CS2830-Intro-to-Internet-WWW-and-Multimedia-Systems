<!-- Robert Fink
     rwfwcb
     CMP_SC 2830 FINAL PROJECT
     Bryan Island Stables
-->

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
	/* has the form been submitted? */
	if(isset($_POST['submit'])){
		/* create a prepared statement */
		if ($stmt = mysqli_prepare($link, "INSERT INTO message (sender, reciever, subject, content) VALUES (?, ?, ?, ?)")){
		/* assign variables */
		$sender = $_SESSION['user'];
		$reciever = $_POST['inputTo'];
		$subject = $_POST['inputSubject'];
		$content = $_POST['inputContent'];
		/* bind variables to marker */
		mysqli_stmt_bind_param($stmt, 'ssss', $sender, $reciever, $subject, $content);
		/* execute the prepared statement */
		mysqli_stmt_execute($stmt);
		/* close statement */
		mysqli_stmt_close($stmt);
		} else {
			echo "prepare failed";
		}
	}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="Bryan Island Stables">
    <meta name="author" content="Robert Fink">
    <link rel="icon" href="horse.ico">
    <title>Admin Page</title>
		<!-- link in jQuery -->
    <script src="jslibs/jquery-2.1.4.min.js"></script>
    <!-- Bootstrap core CSS -->
    <link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <link href="bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet">
    <script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>
  </head>

<body>
<div>
<?php
	include "navbar.html";
  if ($_SESSION['user_type'] == 'admin'){
		echo "<br><br><br><hr>";
    echo "<h1 class='text-center'>Welcome ".$_SESSION['user']."</h1>";
  }
 ?>

  <div>
    <h4 class="text-center">Compose Message</h4>
  </div>
  <div>
    <form action="admin.php" method="POST" role="form" id="form1" class="form-horizontal">
        <div class="form-group">
          <label class="col-sm-2" for="inputTo">To</label>
          <div class="col-sm-6"><input type="text" form="form1" class="form-control" name="inputTo" id="inputTo" placeholder="Email address"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2" for="inputSubject">Subject</label>
          <div class="col-sm-6"><input type="text" form="form1" class="form-control" name="inputSubject" id="inputSubject" placeholder="Subject"></div>
        </div>
        <div class="form-group">
          <label class="col-sm-2" for="inputBody">Message</label>
          <div class="col-sm-6"><textarea form="form1" class="form-control" name="inputContent" id="inputBody" rows="10" placeholder="Enter message here..."></textarea></div>
        </div>
				<div>
          <button type="submit" name="submit" value="submit" form="form1" class="btn btn-primary btn-block">Send <i class="fa fa-arrow-circle-right fa-lg"></i></button>
        </div>
				</form>
  </div>
	</div>
	<div>
	<br><br><h1 class='text-center'>Message Inbox</h1><br>
	<?php
	/* run prepared queries to see if any data is already present in market tables */
		/* create a prepared statement */
			if($stmt = mysqli_prepare($link, "SELECT id, sender, subject, content FROM message WHERE reciever=?")){
			/* bind variables to marker */
			mysqli_stmt_bind_param($stmt, 's', $_SESSION['user']);
			/* execute query */
			mysqli_stmt_execute($stmt);
			/* store result */
			mysqli_stmt_store_result($stmt);
			printf("%d message(s)<br>", mysqli_stmt_num_rows($stmt));
			/* bind result variables */
			mysqli_stmt_bind_result($stmt, $id, $sender, $subject, $content);
			/* print table headers */
			echo "<div class='table-responsive'><table class='table table-hover'><thead><tr><th></th><th>Sender</th><th>Subject</th><th>Message</th></tr></thead>";
			while (mysqli_stmt_fetch($stmt)){ /* print output */
				?>
				<form action="deleteMsg.php" method="POST">
					<input type='hidden' name='id' value='<?=$id?>'>
					<tr><td><input type='submit' name='delete' value='Delete'></td>
				</form>

				<?php
				echo "<td><textarea rows='5' cols'100' maxlength='250' readonly>".$sender."</textarea></td>";
				echo "<td><textarea rows='5' cols'100' maxlength='100' readonly>".$subject."</textarea></td>";
				echo "<td><textarea rows='5' cols'100' maxlength='256' readonly>".$content."</textarea></td></tr>";
			}
			echo "</div></table>";
			echo '<a class="text-right" href="logout.php"><button type="button" class="btn btn-warning btn-block">Log Out</button></a>';

			/* close statement */
			mysqli_stmt_close($stmt);
	}	?>

</div>

	<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
	<script src="bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>
