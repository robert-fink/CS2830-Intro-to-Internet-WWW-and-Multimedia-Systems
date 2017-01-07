<!-- Robert Fink
     rwfwcb
     CMP_SC 2830 FINAL PROJECT
     Bryan Island Stables
-->
<!DOCTYPE html>
<html>
<head>
	<title>Logout</title>
</head>
<body>
	<?php
		session_start();
		session_unset();
		session_destroy();
		header("Location: login.php");
	?>
</body>
</html>
