<?php 
		class room_count_model extends MY_Model 
		{	 
			
			public $_table = 'room_count';
			public $primary_key = 'id';
			public $belongs_to = array('product');
		}
?>