<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_controller {

	/**
	 * Index Page for this controller.
	 *	 
	 */
	
	function __construct()
	{
		parent::__construct();
		
				
		
		$this->load->library('grocery_CRUD');
		$this->load->model('feeds_model');
		$this->load->library('form_validation');
		$this->load->library('rssparser');
		$this->load->helper('form');
		
		
		
		
		
	}
	
	
	public function index()
	{
		
		$data['title']="Welcome";
		
		 
		 $data['favourite']= $this->feeds_model->get_favourite_sources();
		/**
		 *@todo load feeds by id
		*/
		
		
		$this->load->view('header',$data);
		$this->load->view('nav');
		$this->load->view('main_page',$data);
		$this->load->view('footer');
	}
	
	function add_feed(){
			
		
		$this->form_validation->set_rules('url', "Url", 'required|xss_clean|min_length[10]|trim');
		
		if ($this->form_validation->run() == TRUE){
			
			$feed['link'] =  $_POST['url'];
			$feed['thumbnail'] = NULL;
			$feed['description'] = NULL;
			$feed['favourite'] = 0;
			
			
			$url = $feed['link'];	
			
			try {
		$rss = @$this->rssparser->set_feed_url($url)->set_cache_life(30)->getFeed(50);
				} catch (Exception $e) {
					
				//some error occured;
				}
		
		$this->feeds_model->insert_feed($feed,$rss);
		redirect('user');
		}else{
			$data['message'] = validation_errors();
			$data['title'] = 'Add feed';
			$this->load->view('header',$data);
			$this->load->view('nav');
			$this->load->view('add_feed',$data);
			$this->load->view('footer');
			}
	}
		
		
		
	public function edit_feeds($id=null)
	{
		if (!$this->ion_auth->logged_in() || (!$this->ion_auth->is_admin() && !($this->ion_auth->user()->row()->id == $id)))
		{
			show_404();
		}		
		if(!isset($id)){
			show_404();
		}
		
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			
			$crud->where('users_id',$id);	
			$crud->set_table('feeds');
			$crud->columns('link','description','favourite');
			$crud->fields('link','description','users_id','favourite');
			$crud->change_field_type('users_id', 'hidden', $id);			
			
			

			$output = $crud->render();
			$this->_example_output($output);

		}catch(Exception $e){
			show_error($e->getMessage().' --- '.$e->getTraceAsString());
		}
	}
	
	
	
	/**
	*@todo function to handle url address is valid rss or NO
	*
	*/    
	
	
	/**
	 *@var string  valid url adress
	 *
	 *@todo check for sql/xss injections
	 */
       
        function single_feed($feed_id = null,$page=null){
		$user = $this->session->userdata('user_id');
		
		if (!$this->ion_auth->logged_in() || !($this->ion_auth->user()->row()->id == $user))
		{
			show_404();
		}		
		if(!isset($feed_id)) {
			show_404();
		}
		
		
	
	$data['title'] = "Single";	
	$data['rss'] = $this->feeds_model->rss_posts($feed_id);
	
	$this->load->model('page_view_model');
	$this->page_view_model->fetch_increment($feed_id);		
			
			
	$this->load->library('pagination'); 
	$config = array(); 
	$config["base_url"] = base_url()."user/single_feed/{$feed_id}/";
	 $config['total_rows'] = count($data['rss']);	
	 $config["per_page"] = 10; 
	 $config["uri_segment"] = 4; 
	 // twitter bootstrap markup 
	 $config['full_tag_open'] = '<ul class="pagination pagination-sm">';
	 $config['full_tag_close'] = '</ul>';
	 $config['num_tag_open'] = '<li>';
	 $config['num_tag_close'] = '</li>';
	 $config['cur_tag_open'] = '<li class="active"><span>';
	 $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
	 $config['prev_tag_open'] = '<li>'; 
	 $config['prev_tag_close'] = '</li>';
	 $config['next_tag_open'] = '<li>';
	 $config['next_tag_close'] = '</li>';
	 $config['first_link'] = '&laquo;';
	 $config['prev_link'] = '&lsaquo;'; 
	 $config['last_link'] = '&raquo;'; 
	 $config['next_link'] = '&rsaquo;'; 
	 $config['first_tag_open'] = '<li>'; 
	 $config['first_tag_close'] = '</li>'; 
	 $config['last_tag_open'] = '<li>'; 
	 $config['last_tag_close'] = '</li>';
	 $this->pagination->initialize($config);
	 // pass the parameters for per_page, page number, order by, sort, etc here
	 // generate links 
	 $data['links'] = $this->pagination->create_links(); 
	 // pass the data to the view  
 		
			
			
			
	$this->load->view('templates/header',$data);
	$this->load->view('templates/nav');
	$this->load->view('single',$data);
	$this->load->view('templates/footer');
	    
        }	
	
	
	
	function all_feeds(){
		
		
		
		$data['title'] = "My feeds";
		$user = $this->session->userdata('user_id');
		if (!$this->ion_auth->logged_in() ||  !($this->ion_auth->user()->row()->id == $user))
		{
			show_404();
		}
	
	$data['feeds'] = $this->feeds_model->get_all_feeds($user);
	
	$this->load->view('templates/header',$data);
	$this->load->view('templates/nav');
	$this->load->view('all_feeds',$data);
	$this->load->view('templates/footer');
		
	}
	
	
	function refresh_posts($feed_id=null){
		
		if (!isset($feed_id)) {
			show_404();
		}		
	$url = $this->feeds_model->link_by_id($feed_id);	
	$url = (string)$url['link'];	
		
	$rss = $this->rssparser->set_feed_url($url)->set_cache_life(30)->getFeed(1);
	$old = $this->feeds_model->old_record($feed_id);
	
		if ( $new = $rss[0]['link'] === $old['link']) {
			
			$this->session->set_flashdata('message', "All up to date");
			redirect('user/single_feed/'.$feed_id);
			
		}else { //delete, then  insert new posts
			
		$rss = $this->rssparser->set_feed_url($url)->set_cache_life(30)->getFeed(50);		
		$this->feeds_model->reinsert_rss_posts($rss,$feed_id);
		redirect('user/single_feed/'.$feed_id);
			
		}
	
	
	}
	
	
	function _get_csrf_nonce()
	{
		$this->load->helper('string');
		$key   = random_string('alnum', 8);
		$value = random_string('alnum', 20);
		$this->session->set_flashdata('csrfkey', $key);
		$this->session->set_flashdata('csrfvalue', $value);

		return array($key => $value);
	}

	function _valid_csrf_nonce()
	{
		if ($this->input->post($this->session->flashdata('csrfkey')) !== FALSE &&
			$this->input->post($this->session->flashdata('csrfkey')) == $this->session->flashdata('csrfvalue'))
		{
			return TRUE;
		}
		else
		{
			return FALSE;
		}
	}

	function _render_page($view, $data=null, $render=false)
	{

		$this->viewdata = (empty($data)) ? $this->data: $data;
			
		$this->load->view('templates/header',$data);
		$this->load->view('templates/nav',$data);
		$view_html = $this->load->view($view, $this->viewdata, $render);
		$this->load->view('templates/footer'); 

		if (!$render) return $view_html;
	}
	
	public function _example_output($output = null)	
	{
		
		$this->load->view('edit_feeds',$output);
		
	}
		
	
	
}

/* End of file main.php */
/* Location: ./application/modules/main/controllers/main.php */