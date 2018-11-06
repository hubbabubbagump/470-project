<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel="stylesheet" href="/css/header.css">
	<link rel="stylesheet" href="/css/welcome.css">
	<link rel="stylesheet" href="/css/loading.css">
	<script type='text/javascript' src="/js/header.js"></script>
</head>
<body onload="getNewItems()">
	<div id="container">
		<div class="searchWrapper">
			<div class="search">
				<div class="searchButton" onclick="getItems()">
					<div class="loaderDiv"></div>
					<p id="searchText" class="searchText">Search</p>
				</div>
				<span class="sTerm"><input id="searchBox" type="text" class="searchTerm" placeHolder="Search..."/></span>
			</div>
		</div>
		<div id="loader">
			<div id="loaderContainer">
				<div class="bigLoading"></div>
			</div>
		</div>
		<div id="itemWrapper">
			<div id="itemContainer">
				<h1 id="noItems" style="display:none">No Items Found</h1>
				<div id="itemList"></div>
				<div  id="getMore" class="getMore" value="Show More" onclick="getMore()">
					<div class="loaderDivMore"></div>
					<p id="moreText">Show More</p>
				</div>
				<!-- <input type="submit" id="getMore" class="getMore" value="Show More" onclick="getMore()"></input> -->
			</div>
		</div>
	</div>
	<script src="/js/jquery-3.3.1.min.js"></script>
    <script type='text/javascript' src="/js/welcome.js"></script>

</body>
</html>
