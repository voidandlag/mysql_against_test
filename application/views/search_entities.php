<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


</head>
<body>

<div id="container">
	
	<div id="body">
		<?php echo form_open('test/search_entities_result'); ?>
			<input type="text" name="search" id="search" />
			<input type="submit" name="submit" id="submit" value="送出" />
		<?php echo form_close(); ?>
	</div>

	
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

</div>

</body>
</html>