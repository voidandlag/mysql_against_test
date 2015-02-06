<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class test extends CI_Controller {

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
		
		$this->load->helper('form');
		$this->load->view('test');

	}
	
	function search_entities()
	{
		$this->load->helper('form');
		$this->load->view('search_entities');		
	}
	
	function search_entities_result()
	{
		$this->load->helper('url');
		$search_text = $this->input->post('search');
		$text_entities = mb_convert_encoding($search_text,'HTML-ENTITIES','utf-8');
		$query = $this->db->query("select * from n_test where MATCH ( name_entity , detail_entity ) AGAINST ('$text_entities')");
		echo $this->db->last_query();
		$data['n_name'] = $query->result();
		$data['back'] = 'search_entities';
		$this->load->view('result',$data);
		
	}
	
	function entity()
	{
			
		$query = $this->db->from('n_test')->get();
		$result = $query->result();
		foreach($result as $row)
		{
				$entity_name = mb_convert_encoding($row->n_name,'HTML-ENTITIES','utf-8');
				$entity_detail = mb_convert_encoding($row->n_detail,'HTML-ENTITIES','utf-8');
				$data = array('name_entity' => $entity_name,'detail_entity' => $entity_detail);
				$this->db->where('n_id', $row->n_id);
				$this->db->update('n_test', $data);				

		}

	}
	

	function search_old_form()
	{
		$this->load->helper('form');
		$this->load->view('test_old');		
	}

	function search_old()
	{
		/*
		$search_text = $this->input->post('search');
		$this->load->model('search_model','search');
		$search_table = $this->db->from('news')->like(array('search'=>$search_text))->get();
		$data['n_name'] = $search_table->result();
		$this->load->view('result',$data);			
		*/
		$this->load->helper('url');

		$search_text = $this->input->post('search');
		$this->load->model('search_model','search');
		//$search_table = $this->db->from('news')->like(array('search'=>$search_text))->get();
		$news_data = $this->db->or_like(array('n_name'=>$search_text,'n_detail'=>$search_text))->get('news');
		//echo $this->db->last_query();
		$data['n_name'] = $news_data->result();
		//echo $news_data->num_rows();
		$data['back'] = 'search_old_form';
		$this->load->view('result',$data);			
	}
	
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */