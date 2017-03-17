# NSFWDetect

NSFWDetect uses the Haystack API using the AnalyzeAdult endpoint (https://www.haystack.ai/docs#analyzeadult). This can be used to scan a user's image uploads to ensure they do not contain nudity before saving the image to the server. 

## Usage
```php
$imageData = file_get_contents($_FILES["picture"]["tmp_name"]); 
$nsfwDetector = new NSFWDetect("** API KEY **");
$detected = $nsfwDetector->imageContainsNudity($imageData);
```

### Installation
Copy `NSFWDetect.php` to your project file 

### Output
```php
array(
   'isAdultContent' => true,
   'isAdultContentConfidence' => 0.9012000000000000010658141036401502788066864013671875,
   'adultContentType' => 'other',
   'adultContentTypeConfidence' => 0.93165576500000002457824166413047350943088531494140625,
)
```
