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
				foreach($news_data as $row)
				{
					echo $row->n_name.'<br />'
					
				}
		?>
	</div>

	
	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds</p>
</div>

</body>
</html>