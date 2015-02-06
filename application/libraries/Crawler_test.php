<?php
require_once(APPPATH . 'libraries/Simple_html_dom.php');

class Crawler_test
{
	public $url; //URL to load DOM from
	public $url_data; //Parsed loaded URL
	public $dom; //DOM structure of loaded URL
	const USER_AGENT = "bot";
	
	function __construct()
	{
		$this->set_user_agent(self::USER_AGENT);
		$this->dom = new simple_html_dom();
	}
	public function set_url($url)
	{
		$this->url = $url;
		
		if((strpos($url, 'http')) === false) $url = 'http://' . $url;
		
		if($this->check_url($url) === false){
			return false;
		}
		
		if($this->dom->load_file($url) === false){
			return false;
		}

		$this->url_data = parse_url($url);
		if(empty($this->url_data['scheme'])){
			$this->data['scheme'] == 'http';
		}
		$this->url_data['domain'] = implode(".", array_slice(explode(".", $this->url_data['host']), -2));
		
		if(empty($this->url_data['path']) || $this->url_data['path'] != '/robots.txt'){
			$this->get_robots();
		}
		$file = $this->dom->load_file($url);
		
		return true;
	}
	public function set_user_agent($user_agent)
	{
		ini_set('user_agent', $user_agent);
	}
	private function check_url($url)
	{
		$headers = @get_headers($url, 0);
		if(is_array($headers)){
			if(strpos($headers[0], '404')){
				return false;
			}
			
			foreach($headers as $header){
				if(strpos($header, '404 Not Found')){
					return false;
				}
			}
			
			return true;
		}
		else{
			return false;
		}
		
	}
	
	private function get_robots(){
		if(empty($this->url_data)) return false;
		
		$robots_url = 'http://' . $this->url_data['domain'] . '/robots.txt';
		
		if(!$this->check_url($robots_url)){
			return false;
		}
		
		$robots_text = @file($robots_url);
		
		if(empty($robots_text)){
			$this->robots_rules = false;
			return;
		}
		
		$user_agents = implode("|", array(preg_quote('*'),preg_quote(self::USER_AGENT)));
		
		$this->robots_rules = array();
		
		foreach($robots_text as $line){
			if(!$line = trim($line)) continue;
			
			if(preg_match('/^\s*User-agent: (.*)/i', $line, $match)) {
				$ruleApplies = preg_match("/($user_agents)/i", $match[1]);
			}
			if(!empty($ruleApplies) && preg_match('/^\s*Disallow:(.*)/i', $line, $regs)) {
				// an empty rule implies full access - no further tests required
				if(!$regs[1]) return true;
				// add rules that apply to array for testing
				$this->robots_rules[] = preg_quote(trim($regs[1]), '/');
			}
		}
		
		return $this->robots_rules;
	}
	public function get_html(){
		if(!empty($this->dom)){
			return $this->dom->save();
		}
		else{
			return false;
		}
	}
	public function get_links()
	{
				$anchor_tags = $this->dom->find('a[href]');
				var_dump( $this->$url);
				foreach($anchor_tags as $link)
				{
						/*
						if($this->check_url($this->$url) === false)
						{
							//return false;
							echo $this->$url.$link->href.'<br />';
						}
						*/
					echo $link->href.'<br />';
				}
				//print_r($anchor_tags);
	}
}
