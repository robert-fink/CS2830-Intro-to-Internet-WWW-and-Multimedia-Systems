<!-- Robert Fink
     rwfwcb
     CMP_SC 2830 FINAL PROJECT
     Bryan Island Stables
-->

<?php
	session_start();
	if(!empty($_SESSION['user'])){
		if($_SESSION['user_type'] == 'admin'){
			header('Location: admin.php');
		}
		else{
			header('Location: page1.php');
		}
	}

  if(isset($_POST['submit'])) { // Was the form submitted?
    if ($_POST['inputPassword'] != $_POST['checkPassword']){
      echo "<script type='text/javascript'>alert('Password entries do not match.')</script>";
    }
    require "db.conf";
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ("Connection Error " . mysqli_error($link));
    $sql = "INSERT INTO barn_user (email, salt, hashed_password, user_type) VALUES (?,?,?,?)";
    if ($stmt = mysqli_prepare($link, $sql)) {
      $email = $_POST['inputEmail'];
      $pass = $_POST['inputPassword'];
			$check_pass = $_POST['checkPassword'];
			$user_type = $_POST['user_type'];
      $salt = mt_rand();
      $hpass = hash('sha256', $salt.$pass);
      mysqli_stmt_bind_param($stmt, "ssss", $email, $salt, $hpass, $user_type) or die("bind param");
			if ($pass == $check_pass){
				if(mysqli_stmt_execute($stmt)) {
					echo "<script type='text/javascript'>alert('Succesfully registered!')</script>";
				} else {
					echo "<script type='text/javascript'>alert('Username already exists')</script>";
				}
			}
    } else {
      die("prepare failed");
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
	<title>Bryan Island Stables</title>
	<!-- link in jQuery -->
	<script src="jslibs/jquery-2.1.4.min.js"></script>
	<!-- Bootstrap core CSS -->
	<link href="bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
	<link href="bootstrap/assets/css/ie10-viewport-bug-workaround.css" rel="stylesheet">
	<!-- Custom styles for this template -->
	<link href="css/style.css" rel="stylesheet">
	<script src="bootstrap/assets/js/ie-emulation-modes-warning.js"></script>

	<script>
		$(function() {
			$("form").css("margin-top", "-130px");
			$("h2").css("font-weight", "bold");
			$("input")
				.css("margin-top", "-5px")
				.css("border-radius", "5px");

		});
	</script>
  </head>

  <body>
		<?php include "navbar.html"; ?>
    <div class="container">
			<br><br><br>
      <form class="form-signin" action="register.php" method="POST">
        <h2 class="form-signin-heading">Please Register</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus><br>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required><br>
        <label for="checkPassword" class="sr-only">Re-type Password</label>
        <input type="password" id="checkPassword" name="checkPassword" class="form-control" placeholder="Re-type Password" required>
        <input type="hidden" name="user_type" value="user">
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Register</button>
				<a href="index.php"><button type="button" class="btn btn-default">Back to Home</button></a>
				<a href="login.php"><button type="button" class="btn btn-default">Go to Login</button></a>

      </form>
    </div> <!-- /container -->
		<!-- Bootstrap core JavaScript
	================================================== -->
	<!-- Placed at the end of the document so the pages load faster -->
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script>window.jQuery || document.write('<script src="bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
	<script src="bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
