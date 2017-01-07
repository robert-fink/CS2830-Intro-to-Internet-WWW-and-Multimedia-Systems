<!-- Robert Fink
     rwfwcb
     CMP_SC 2830 FINAL PROJECT
     Bryan Island Stables
-->

<?php
	session_start();
	if(!empty($_SESSION['user'])){
		if($_SESSION['user_type'] == 'admin'){
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/final/admin.php');
		} else{
			header('Location: http://' . $_SERVER['HTTP_HOST'] . '/final/page1.php');
		}
	}

  if(isset($_POST['submit'])) { // Was the form submitted?
	require "db.conf";
    $link = mysqli_connect($dbhost, $dbuser, $dbpass, $dbname) or die ("Connection Error " . mysqli_error($link));
    $sql = "SELECT * FROM barn_user WHERE email = ?";
    if ($stmt = mysqli_prepare($link, $sql)) {
    	$user = $_POST['inputEmail'];
    	mysqli_stmt_bind_param($stmt, "s", $user) or die("bind param");
    	if (mysqli_stmt_execute($stmt)){
				mysqli_stmt_bind_result($stmt, $email, $salt, $hashed_password, $user_type);
	    	mysqli_stmt_fetch($stmt);
				$hpass = hash('sha256', $salt.$_POST['inputPassword']);
				if ($hpass == $hashed_password){
					$_SESSION['user'] = $email;
					if ($user_type == 'admin'){
						$_SESSION['user_type'] = $user_type;
						header("Location: admin.php");
					}
					if ($user_type == 'user'){
						$_SESSION['user_type'] = $user_type;
						header("Location: page1.php");
					}
				} else{
					echo "<script type='text/javascript'>alert('Incorrect email or password')</script>";
				}
			}else{
				echo "<script type='text/javascript'>alert('Incorrect email or password')</script>";
			}
      mysqli_stmt_close($stmt);
  }
	else{
		echo "prepare failed<br>";
	}
}
mysqli_close($link);
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
			$("form").css("margin-top", "-100px");
			$("h2").css("font-weight", "bold");
			$("input").css("border-radius", "5px");

		});
	</script>
  </head>

  <body>
		<?php include "navbar.html"; ?>
    <div class="container">
			<br><br>
      <form class="form-signin" action="login.php" method="POST">
        <h2 class="form-signin-heading">Please Sign In</h2>
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="text" id="inputEmail" name="inputEmail" class="form-control" placeholder="Email address" required autofocus>
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" name="inputPassword" class="form-control" placeholder="Password" required>
        <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">Sign in</button>
				<a href="index.php"><button type="button" class="btn btn-default">Back to Home</button></a>
				<a href="register.php"><button type="button" class="btn btn-default">Go Register</button></a>
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
