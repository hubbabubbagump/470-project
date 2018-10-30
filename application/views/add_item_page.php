<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html>
    <head>
        <title>Post Item</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="/css/login.css">
        <link rel="stylesheet" href="/css/header.css">
        <script src="/js/jquery-3.3.1.min.js"></script>
        <script type='text/javascript' src="/js/addItem.js"></script>
        <script type='text/javascript' src="/js/header.js"></script>
    </head>
  	<body class= "loginContainer">
  		<h1>Add New Post</h1>
  		<div class="addpost">
		<?php 
		echo validation_errors();
		//echo form_open('add_item'); //uri will show index/add_item- ADD TO ROUTES
		?>
		<form name="addItemForm">
			<label><b>Title</b></label><br/>
			<input type="text" name="title" placeholder="Title" value="<?php echo set_value('title'); ?>"/><br/>

			<label><b>Price</b></label><br/>
			<input type="number" name="price" min="0" step="any" placeholder="20"> value="<?php echo set_value('price'); ?>"/><br/> <!--how to display CAD or $ before entry? -->
			<label><b>Faculty</b></label><br/> <!-- four alphabets / or from a drop down list-->
			<input type="text" name="faculty" pattern="[A-Za-z]{4}" placeholder="CMPT" value="<?php echo set_value('faculty'); ?>"/><br/>

			<label><b>Course Number</b></label><br/>
			<input type='text' name="courseNum" pattern = "[0-9]{3}" placeholder="123" value="<?php echo set_value('courseNum'); ?>"/><br/>
			<label><b>Description</b></label><br/>
			<input type="textbox" name="desc" placeholder="In good condition. pick up only."> value="<?php echo set_value('desc'); ?>"/><br/>

			<input class="button" type="submit" value="Post Item" /><br/>
		</form>
	</div>

	<!-- HOW to get seller id??? -->
	</body>

</html>









