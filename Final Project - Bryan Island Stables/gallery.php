<!-- Robert Fink
     rwfwcb
     CMP_SC 2830 FINAL PROJECT
     Bryan Island Stables
-->

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
</head>

  <body>
  <?php include "navbar.html"; ?>
  <img id="head" src="images/head2.jpg">
    <div class="container">
      <div class="starter-template">
        <h2>Bryan Island Stables Gallery</h2><hr>
        <?php
          foreach (glob("images/*.jpg") as $filename) {
            //echo "$filename size " . filesize($filename) . "<br>";

            // Get new dimensions
            list($width, $height) = getimagesize($filename);
            if ($width > 2000 || $height > 3000){
              $percent = .1;
              $new_width = $width * $percent;
              $new_height = $height * $percent;
              // Resample
              $image_p = imagecreatetruecolor($new_width, $new_height);
              $image = imagecreatefromjpeg($filename);
              imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
              // Output
              imagejpeg($image_p, $filename);
            }

            echo "<img class='gallery' src='$filename'>";

            // Free up memory
            imagedestroy($image_p);
          }
        ?>
      </div>

    </div><!-- /.container -->

<!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="bootstrap/dist/js/bootstrap.min.js"></script>

  </body>
</html>
