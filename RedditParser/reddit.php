<?php
namespace RedditParser;
include(realpath('RedditParser/api.php'));

class Reddit extends Api
{
	public function __construct($url){
		$this->fetchContents($url);
		$this->parseContents();
	}

	public function topStories($maxStories = 5){
		$ranking = array();

		if(empty($this->jsonObj->data->children)){
			throw new \Exception("Not dealing with reddit info", 1);			
		}

		//Stories section
		$stories = $this->jsonObj->data->children;

		//Walk through stories, KISS, trusting 3rd party here
		foreach ($stories as $index => $value) {
			$story = $value->data;

			$ranking[$story->title] = $story->ups;
		}									

		//Desc sorting
		arsort($ranking);

		//slicing for maxStories
		$ranking = array_slice($ranking, 0, $maxStories);
		return $ranking;
	}

	public function displayTopStories($maxStories = 5){
		$stories = $this->topStories($maxStories);

		foreach($stories as $title => $ups){
			echo "Title:&nbsp;".$title."<br/>Votes:&nbsp;". $ups ."<br/><br/>";
		}
	}
}