<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="/css/login.css">
        <link rel="stylesheet" href="/css/header.css">
        <link rel="stylesheet" href="/css/manageItem.css">

        <!-- Leaflet -->
		<!-- <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
		integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
		crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
		integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
		crossorigin="">
		</script> -->

		<!-- Images -->
		<!-- <script src="/node_modules/lodash/lodash.js" type="text/javascript"></script>
		<script src="/node_modules/cloudinary-core/cloudinary-core.js" type="text/javascript"></script>
		<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript">></script> -->
    </head>
  	<body class= "loginContainer" id="formbody">
  		<h1>Manage Your Items</h1>

  		<div id="items"></div>
		<div id="info">You don't have any items right now, why not <a href="/index.php/Item/index">add one</a>?</div>

	<script src="/js/jquery-3.3.1.min.js"></script>
    <script type='text/javascript' src="/js/manageItem.js"></script>
    <script type='text/javascript' src="/js/header.js"></script>
	</body>

</html>