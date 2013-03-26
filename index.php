
<?php
include('RedditParser/reddit.php');
?>

<!DOCTYPE html>
<html>
<head>
	 <meta charset='utf-8'> 
	 <title>Reddit Top PHP Stories</title>
</head>
<body>


<?php
//Pardon my non-neat-MVC here
try {
$reddit = new RedditParser\Reddit('http://www.reddit.com/r/php.json');
$reddit->displayTopStories();
	
} catch (Exception $e) {
	echo $e->getMessage();
}

?>

</body>
</html>