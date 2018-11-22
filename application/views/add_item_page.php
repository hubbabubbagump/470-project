<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="/css/login.css">
        <link rel="stylesheet" href="/css/header.css">
        <link rel="stylesheet" href="/css/popup.css">

        <!-- Leaflet -->
		<link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.4/dist/leaflet.css"
		integrity="sha512-puBpdR0798OZvTTbP4A8Ix/l+A4dHDD0DGqYW6RQ+9jxkRFclaxxQb/SJAWZfWAkuyeQUytO7+7N4QKrDh+drA=="
		crossorigin=""/>
		<script src="https://unpkg.com/leaflet@1.3.4/dist/leaflet.js"
		integrity="sha512-nMMmRyTVoLYqjP9hrbed9S+FzjZHW5gY1TWCHA5ckwXZBadntCNs8kEqAWdrb9O7rxbCaA4lKTIWjDXZxflOcA=="
		crossorigin="">
		
		</script>
		<script src="/node_modules/lodash/lodash.js" type="text/javascript"></script>
		<script src="/node_modules/cloudinary-core/cloudinary-core.js" type="text/javascript"></script>
		<script src="https://widget.cloudinary.com/v2.0/global/all.js" type="text/javascript">></script>
    </head>
  	<body class= "loginContainer" id="formbody">
  		<h1>Post New Item</h1>
  		<div class="additem">
		<?php echo validation_errors(); ?>
		<form onsubmit="event.preventDefault(); return addItem()" name="addItemForm">
			<fieldset>
			<label class="required"><b>Title</b></label><br/>
			<input type="text" name="title" placeholder="Title" value="<?php echo set_value('title'); ?>"/><br/>

			<label class="required"><b>Price</b></label><br/>
			<input type="number" name="price" min="0" step="any" placeholder="20.00" value="<?php echo set_value('price'); ?>"/><br/> <!--how to display CAD or $ before entry? -->
			
			<label class="required"><b>Faculty</b></label><br/> <!-- 2+ alphabets / or from a drop down list-->
			<input type="text" name="faculty" pattern="[A-Za-z]{2,}" placeholder="CMPT" value="<?php echo set_value('faculty'); ?>"/><br/>

			<label class="required"><b>Course Number</b></label><br/>
			<input type="text" name="courseNum" pattern = "[0-9]{3}" placeholder="100" value="<?php echo set_value('courseNum'); ?>"/><br/>
			
			<label><b>Description</b></label><br/>
			<input type="textbox" name="desc" placeholder="Description" value="<?php echo set_value('desc'); ?>"/><br/>

			<div id="imageWidget">Upload image</div>

			<div id="addItemMap"></div>

			<input class="button" type="submit" value="Post Item"/><br/>

			<p id="error"></p>
			</fieldset>
		</form>
	</div>
	<script src="/js/jquery-3.3.1.min.js"></script>
    <script type='text/javascript' src="/js/addItem.js"></script>
    <script type='text/javascript' src="/js/header.js"></script>
    <script type='text/javascript' src="/js/popup.js"></script>
	</body>

</html>









