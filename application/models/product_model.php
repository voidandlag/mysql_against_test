<?php 
		class product_model extends MY_Model 
		{	 
			
			public $_table = 'product';
			public $primary_key = 'product_id';
			public $has_many = array('room_count');
		}
?>