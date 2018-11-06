<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<link rel="stylesheet" href="/css/header.css">
	<link rel="stylesheet" href="/css/welcome.css">
	<script type='text/javascript' src="/js/header.js"></script>
</head>
<body>

	<div id="container" style="background-color:#FFF">
		<div class="searchWrapper">
			<div class="search">
				<div class="searchButton" onclick="getItems()">
					<div class="loaderDiv"></div>
					<!-- <input type="submit" class="searchButton" value="Search" onclick="getItems()"> -->
					<p id="searchText" class="searchText">Search</p>
				</div>
				<span class="sTerm"><input id="searchBox" type="text" class="searchTerm" placeHolder="Search..."/></span>
			</div>
		</div>

		<div>
			<p>This is the welcome page for the CMPT 470 Project</p>
			<p>This project will become a market place for students to trade items</p>
		</div>

		<div id="itemContainer"></div>
	</div>
	<script src="/js/jquery-3.3.1.min.js"></script>
    <script type='text/javascript' src="/js/welcome.js"></script>

</body>
</html>
