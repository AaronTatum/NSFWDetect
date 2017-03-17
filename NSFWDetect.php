<?php

class AdultContent {

	public $isAdultContent = false;
	public $isAdultContentConfidence = 0;
	public $adultContentType = "";
	public $adultContentTypeConfidence = 0;

	public function __construct($responseObj) {
		$this->isAdultContent = $responseObj["isAdultContent"];
		$this->isAdultContentConfidence = $responseObj["isAdultContentConfidence"];
		$this->adultContentType = $responseObj["adultContentType"];
		$this->adultContentTypeConfidence = $responseObj["adultContentTypeConfidence"];
	}

}

class NSFWDetect { 

	private $apiKey = "";

	public function __construct($key) {
		$this->apiKey = $key;
	}

	public function imageContainsNudity($imageData) {
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $this->getRequestUrl());
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $imageData);  

		$rawResponse = curl_exec($ch);
		$response = json_decode($rawResponse, true);

		if($response["result"] === "success")
			return new AdultContent($response["adultContent"]);
		else 
			return null;
	}

	private function getRequestUrl() {
		$format = "http://api.haystack.ai/api/image/analyzeadult?output=json&apikey=%s";

		return sprintf($format, $this->apiKey);
	}

}
