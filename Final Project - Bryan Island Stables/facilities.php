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
  <div class="container">
    <div class="starter-template">
      <nav class="navbar navbar-default" role="navigation">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header navbar-left" >
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
        <span class="sr-only">Facilities</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Facilities</a>
  </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse navbar-ex1-collapse">
    <ul class="nav navbar-nav navbar-left">
      <li><a onclick="getInfo('barnA')" href="#">Barn A</a></li>
      <li><a onclick="getInfo('barnC')" href="#">Barn C</a></li>
      <li><a onclick="getInfo('barnD')" href="#">Barn D</a></li>
    </ul>
    </div>
    </nav>
    <hr>
    <div id="display"></div>
    </div>
  </div><!-- /.container -->

<script>
    function getInfo(clickID) {
        // Loading feedback
        document.getElementById("display").innerHTML = "Loading...";

        var xmlHttp = new XMLHttpRequest();
        xmlHttp.onload = function() {
            if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
                document.getElementById("display").innerHTML = xmlHttp.responseText;
              }
        }
        var reqURL = "http://cs2830-rwfwcb.azurewebsites.net/final/processInfo.php?infoId=" + clickID;
        xmlHttp.open("GET", reqURL, true);
        xmlHttp.send();
    }
</script>

    <!-- Bootstrap core JavaScript
  ================================================== -->
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script>window.jQuery || document.write('<script src="bootstrap/assets/js/vendor/jquery.min.js"><\/script>')</script>
  <script src="bootstrap/dist/js/bootstrap.min.js"></script>
  </body>
</html>
