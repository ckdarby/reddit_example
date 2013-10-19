<?php
namespace RedditParser;

class Api 
{

	//Covers all our undefined casting
	protected $contents = '';
	protected $jsonObj;

	//Fetches web page content
	public function fetchContents($url){
		
		$options = array(
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_HEADER         => false,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_AUTOREFERER    => true,
			CURLOPT_CONNECTTIMEOUT => 60,
			CURLOPT_TIMEOUT        => 60,
			CURLOPT_MAXREDIRS      => 5,
		);

		$ch = curl_init($url);
		curl_setopt_array($ch, $options);
		$contents = curl_exec($ch);

		if(empty($contents)){
			throw new \Exception("Cannot get content");
		}
		
		$this->contents = $contents;
		curl_close($ch);
	}

	//Attempts to parse out content as json
	public function parseContents(){
		
		$json = json_decode($this->contents);

		//Covers NULL & False of json_decode
		if(empty($json)){
			throw new \Exception("Cannot json decode");
		}
		$this->setJsonObj($json);

	}

	//Sets the json decode object
	protected function setJsonObj($jsonObj){
		$this->jsonObj = $jsonObj;
	}

	//Allows us to grab json obj
	public function getJsonObj(){
		return $this->jsonObj;
	}

}
