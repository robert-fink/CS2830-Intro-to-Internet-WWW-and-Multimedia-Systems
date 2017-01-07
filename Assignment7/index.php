<!-- Robert Fink
	 rwfwcb
     CMP_SC 2830
-->
<!DOCTYPE html>
<html>

<head>
	<title> rwfwcb A7	</title>
</head>

<body>

<?php

echo "<h1>Animal Photos</h1>";

$dir = "/Assignment7";

if (is_dir($dir)){
  if ($dh = opendir($dir)){
    while (($file = readdir($dh)) !== false){
			$info = new SplFileInfo($file);
			if ($info->getExtention() == 'jpg'){
				echo '<img src="/Assignmen7/".$file>';
			}
    }
    closedir($dh);
  }
}

?>
</body>

</html>
