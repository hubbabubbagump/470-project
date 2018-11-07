<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Messages</title>

	<script src="/js/jquery-3.3.1.min.js"></script>
	<script type='text/javascript' src="/js/header.js"></script>
	<script type='text/javascript' src="/js/messages.js"></script>
	<link rel="stylesheet" href="/css/header.css">

</head>
<body>

<div id="container">
	<h1>Personal Messages</h1>
	<h3>Enter any number of fields</h3>

	<form name="searchForm" onsubmit="event.preventDefault(); return getItems()">
		<!-- I'm not sure why int fields don't work... fix later
		Course Number: <br>
		<input type="number" name="courseNum"><br>-->
		Title: <br>
		<input type="text" name="title"><br>
		Faculty: <br>
		<input type="text" name="faculty"><br>
		<input type="submit">
	</form>

	<div id="body">
		<table id="resultsTable">
			<thead>
				<th>Title</th>
				<th>Faculty</th>
				<th>CourseNum</th>
				<th>Desc</th>
				<th>Date Posted</th>
				<th>Seller</th>
				<th>Price</th>
			</thead>
			<tbody>
			</tbody>
		</table>
	</div>

	<div><p id="info"></p></div>

</div>

</body>
</html>
