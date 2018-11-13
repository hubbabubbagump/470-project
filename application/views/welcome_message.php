<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>470 Project</title>

	<link rel="stylesheet" href="/css/header.css">
	<link rel="stylesheet" href="/css/welcome.css">
	<link rel="stylesheet" href="/css/loading.css">
	<script type='text/javascript' src="/js/header.js"></script>
	<!-- Leaflet -->
	<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
	integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
	crossorigin=""/>
	<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
	integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
	crossorigin="">
	</script>
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

		<div id="modal" class="modal">
			<div id="modalContent" class="modalContent">
				<div id="modalHeader" class="modalHeader"><p id="modalTitle"></p></div>
				<div id="modalBody" class="modalBody">
					<div id="modalSeller"></div>
					<div id="modalCourse"></div>
					<div id="modalPrice"></div>
					<div id="modalDesc"></div>
					<div id="images"></div>
					<div id="itemResultMap"></div>
				</div>
			</div>
		</div>

		<div id="msgModal" class="modal">
			<div id="msgModalContent" class="modalContent">
				<div id="modalHeader" class="modalHeader"><p id="msgTitle">Message Seller</p></div>
				<div id="msgBody" class="modalBody">
					<textarea id="textarea" rows="10" cols="60" name="message" autofocus required></textarea>
					<input id="msgButton" class="msgButton" type="submit" value="Send Message" onclick="sendMessage()"></input>
				</div>
			</div>
		</div>
	</div>
	<script src="/js/jquery-3.3.1.min.js"></script>
    <script type='text/javascript' src="/js/welcome.js"></script>

</body>
</html>
