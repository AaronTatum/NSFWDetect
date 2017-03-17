<?php

require 'NSFWDetect.php';

$imageData = file_get_contents($_FILES["pic"]["tmp_name"]); 
$nsfwDetector = new NSFWDetect("** API KEY **");
$detected = $nsfwDetector->imageContainsNudity($imageData);

highlight_string("" . var_export($detected, true));

if($detected->isAdultContent && $detected->isAdultContentConfidence > 0.8) {
	echo "<h1 style='color:red'>Error! This image contains nudity</h1>";
}
else {
	echo "<h1>Success! Image accepted</h1>";
}