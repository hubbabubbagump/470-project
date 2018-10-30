<?php
defined('BASEPATH') OR exit('No direct script access allowed');?><!DOCTYPE html>
<html>
    <head>
        <title>Post Item</title>
        <meta charset="UTF-8" />
        <link rel="stylesheet" href="/css/login.css">
        <link rel="stylesheet" href="/css/header.css">
    </head>
  	<body>
	<h1><?php echo $title; ?></h1>
	<?php 
	echo validation_errors();
	echo form_open('add_item'); //uri will show index/add_item- ADD TO ROUTES
	?>
		<label><b>Title</b></label>
		<input type="text" name="title" placeholder="Title" value="<?php echo set_value('title'); ?>"/><br />

		<label><b>Price</b></label>
		<input type="number" name="price" min="0" step="any" value="<?php echo set_value('price'); ?>"/><br /> <!--how to display CAD or $ before entry? -->

		<label><b>Faculty</b></label> <!-- four alphabets / or from a drop down list-->
		<input type="text" name="faculty" pattern="[a-z][a-z][a-z][a-z]" placeholder="CMPT" value="<?php echo set_value('faculty'); ?>"/><br/>

		<label><b>Course Number</b></label>
		<input type='text' name="courseNum" pattern = [0-9][0-9][0-9] placeholder="123" value="<?php echo set_value('courseNum'); ?>"/><br/>

		<label><b>Description</b></label>
		<input type="textbox" name="desc" value="<?php echo set_value('desc'); ?>"/><br/>

		<input class="button" type="submit" value="Post Item"/>
	</form>

	<!-- HOW to get seller id??? -->
	</body>

</html>









