<?php
include_once("config.php");
session_start();
if(!empty($_POST['rating']) && !empty($_POST['itemId'])){
	$itemId = $_POST['itemId'];
	$userID = $_SESSION["id"];	
	$comment = htmlspecialchars($_POST["comment"]);
	date_default_timezone_set('UTC');
	date_default_timezone_set('America/Los_Angeles');
	$insertRating = "INSERT INTO restaurant_rating (itemId, userId, ratingNumber, username, comments, created, modified) VALUES ('".$itemId."', '".$userID."', '".$_POST['rating']."', '".$_SESSION['username']."', '".$comment."', '".date("Y-m-d H:i:s")."', '".date("Y-m-d H:i:s")."')";
	mysqli_query($link, $insertRating) or die("database error: ". mysqli_error($link));
	$updateScore = "UPDATE markers SET reviews = reviews + 1, score = score + '".$_POST['rating']."' WHERE id = '".$itemId."' ";
	mysqli_query($link, $updateScore) or die("database error: ". mysqli_error($link));
	echo "rating saved!";
}
?>