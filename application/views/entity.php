<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>


</head>
<body>

<div id="container">
	
	<div id="body">
	<?php 
			foreach($record as $row)
			{				
				echo mb_convert_encoding($row->n_name,'HTML-ENTITIES','utf-8').'<br />';
			}
	?>
	</div>

	
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>

</div>

</body>
</html>