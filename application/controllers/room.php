<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class room extends CI_Controller {

	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{
		
		//$this->load->model('post_model','post');
		
		//$data['post'] = $this->post->get_all();
		//$data['post'] = $this->post->get_by('level2_id', '101');
		
		//$data['post'] = $this->db->from('news')->like('n_detail','中央社')->get();
		//$data['post'] = $this->post->like('n')->get(1);
		//echo $this->db->last_query();
		//$this->load->view('test',$data);
	}
	public function room_update()
	{
		$this->load->model('product_model');
		$this->load->model('roomcount_model');
		
		$day = 1;
		$data = $this->product_model->as_array()->get_all();
		foreach($data as $row)
		{
			$date = new DateTime(date('Y-m-d'));
			for($day = 1 ;$day <= 30;$day++)
			{
				$date->add(date_interval_create_from_date_string(" 1 days"));
				
				$add_date = date_format($date,'Y-m-d');

				$this->roomcount_model->insert(array('product_id'=>$row['product_id'],'date'=>$add_date,'count'=>$row['day_count']));
				
			}
		}

	}
	
	function get_data()
	{
			$this->load->library('crawler');
			$this->crawler->get_html('https://www.google.com.tw/?gws_rd=ssl#q=agoda');
		
	}
	

}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */