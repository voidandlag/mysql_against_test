<?php 
		class roomcount_model extends MY_Model 
		{	 
			
			public $_table = 'roomcount';
			public $primary_key = 'id';
			public $belongs_to = array('product');
		}
?>