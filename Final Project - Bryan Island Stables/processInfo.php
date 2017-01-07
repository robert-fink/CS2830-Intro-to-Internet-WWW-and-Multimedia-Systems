<!-- Robert Fink
     rwfwcb
     CMP_SC 2830 FINAL PROJECT
     Bryan Island Stables
-->

<?php
$infoId = empty($_GET['infoId']) ? 'barnA' : $_GET['infoId'];

switch($infoId) {
	case 'barnA':
		$info = '<h1>Barn A Information</h1><p>This is the original barn for Bryan Island Stables. The monthly rate is $250 for a regular stall (3 available), or treat your horse companion to an <strong><em>Extra Large</em></strong> stall for $275 (5 available). This facility features a dry lot turnout. Horses are grained in the morning and are turned out for the day. All lots have round bales for the horses during the day turnout. When they are brought in for the day horses have their night grain (or feed) and hay in their stalls. Horse owners are responsible for cleaning their own stall.</p><img src= "images/a.jpg">';
		break;

	case 'barnC':
		$info = '<h1>Barn C Information</h1><p>This facility features 37 regular stalls and 3 <strong><em>Extra Large</em></strong> stalls. Regular stalls (10ft x 10ft) are $250 per month, <strong><em>Extra Large</em></strong> stalls are $275 per month. Horses are grained in the morning and are turned out for the day. Horses are turned out to a large pasture, which also has some round bales. When they are brought in for the day horses have their night grain (or feed) and hay in their stalls. Horse owners are responsible for cleaning their own stall.</p><img src= "images/c.jpg">';
		break;

	case 'barnD':
		$info = '<h1>Barn D Information</h1><p>This facility features an indoor arena. Mares and Geldings are on seperate sides of this barn. There are 16 stalls on the mares side, and 10 stalls on the geldings side. Mares and Geldings have seperate dry lot turnout areas. The monthly rate is $275. Horses are grained in the morning and are turned out for the day. All lots have round bales for the horses during the day turnout. When they are brought in for the day horses have their night grain (or feed) and hay in their stalls. Horse owners are responsible for cleaning their own stall.</p><img src= "images/d.jpg">';
		break;
}

print $info;
?>
