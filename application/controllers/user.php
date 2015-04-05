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
        $data['latest'] = $this->feeds_model->get_latest_news();
		$this->load->view('header',$data);
		$this->load->view('nav');
		$this->load->view('main_page',$data);
		$this->load->view('footer');
	}
	
	function add_feed(){			
		
		$this->form_validation->set_rules('url', "Url", 'required|min_length[5]|max_length[120]|trim');
		if ($this->form_validation->run() == TRUE){
			
            $feed['link'] =  $_POST['url'];
			$feed['thumbnail'] = NULL;
			$feed['favourite'] = 0;	
			$url = $feed['link'];	
            
            $xml = new XMLReader();            
            @$xml->open($url);
            @$xml->setParserProperty(XMLReader::VALIDATE, true);

        if($xml->isValid()){            
                    try {
                        $rss = @$this->rssparser->set_feed_url($url)->set_cache_life(30)->getFeed(50);
                    } catch (Exception $e) {
                        //some error occured
                        $this->session->set_flashdata('message', "Invalid URL");
                        redirect('user/add_feed');
                    }
		
		
            try {
                @$this->feeds_model->insert_feed($feed,$rss);
				} catch (Exception $e) {
					
                //some error occured
				$this->session->set_flashdata('message', "Invalid URL");
				redirect('user/add_feed');
				}
            
		redirect('user');
        } else{
            $this->session->set_flashdata('message', "Invalid URL");
				redirect('user/add_feed');
        
        }
			
			
		}else{
            
			$data['message'] = validation_errors();
			$data['title'] = 'Add feed';
			$this->load->view('header',$data);
			$this->load->view('nav');
			$this->load->view('add_feed',$data);
			$this->load->view('footer');
			}
	}
		
		
		
	public function edit_feeds()
	{
		
		try{
			$crud = new grocery_CRUD();

			$crud->set_theme('twitter-bootstrap');
			$crud->set_table('feeds');
			$crud->columns('link','title','favourite');
			$crud->fields('link','title','favourite');
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
       
        function single_feed($feed_id = null){		
				
		if(!isset($feed_id)) {
			show_404();
		}

       
	    $config = array(); 
        $config["per_page"] = 20;
        $config['num_links'] = 20;
         
        $data['page']= (int)$feed_id;
        $data['rss'] = $this->feeds_model->rss_posts($feed_id,$config["per_page"],$this->uri->segment(4));
        $data['parent_link'] = $this->feeds_model->get_feed_link_by_id($feed_id);
		$data['title'] = "Single";	
				  
           
     
			
	$this->load->library('pagination');
	$config["base_url"] = base_url()."index.php/user/single_feed/{$feed_id}/";
	 $config['total_rows'] =count($data['rss']);
    
    $this->pagination->initialize($config);
	 // pass the parameters for per_page, page number, order by, sort, etc here
	 // generate links 
	 $data['links'] = $this->pagination->create_links(); 
	 // pass the data to the view  
 		
			
			
	$this->load->view('header',$data);
	$this->load->view('nav');
	$this->load->view('single',$data);
	$this->load->view('footer');
	    
        }	
	
	
	
	function all_feeds(){
		$data['title'] = "My feeds";
		$data['feeds'] = $this->feeds_model->get_all_feeds();
        $this->load->view('header',$data);
        $this->load->view('nav');
        $this->load->view('all_feeds',$data);
        $this->load->view('footer');
        
	}
	
    	
	function refresh_posts($feed_id=null){
		
		if (!isset($feed_id)) {
			show_404();
		}		
	$url = $this->feeds_model->get_feed_link_by_id($feed_id);	
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
	
	public function _example_output($output = null)	
	{
		
$data['title'] = "Edit feeds";
       

        $this->load->view('edit_feeds',$output);
    $this->load->view('edit-footer');
		
	}
	
    
    /* ||||||||||||||||||||||||||||||||||||||||||||||||||||||||| kohana |||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    
    public function manage_feeds(){
        
            $data['title'] = "Edit feeds";
            $data['feeds'] = $this->feeds_model->get_all_feeds();        
            $this->load->view('header',$data);
            $this->load->view('nav');
            $this->load->view('manage_feeds',$data);
            $this->load->view('manage-footer');
        
    }
    
    public function my_feeds(){
        $feeds= $this->feeds_model->get_all_feeds();     
         print json_encode($feeds);	
    }
    
    
    public function get_one_feed(){
    if ($this->input->is_ajax_request()) {
        $id = $this->input->post('id'); 
        
        
            $feeds= $this->feeds_model->get_feed_settings($id);     
         print json_encode($feeds);	
           
    }else {
            exit('No direct script access allowed');
        
    }
    }

    
    public function action_allClients(){
	$clients = Model::factory('clients');	
	
	$all_clients = $clients->get_all_clients();
	
	print json_encode($all_clients);
	
	}
	
	
	private function _valid($post){
		
		$clients = Model::factory('clients');
		$object = Validation::factory($post);	
		$object->rules(		
		   'number',array(
			array('not_empty'),
		        array('max_length', array(':value', 10)),
			array('numeric')			
			//array(array($clients,'unique_number'))
			
		   ));
		
		 $object->rules(  
		   'name',array(
			array('not_empty'),
		        array('max_length', array(':value', 100)),
			array('regex', array(':value', '/^[a-z_.]++$/iD')) 
		   ));
		  $object->rules( 
		   'last_name',array(
			array('not_empty'),
		        array('max_length', array(':value', 100)),
			array('regex', array(':value', '/^[a-z_.]++$/iD')) 	
		   ));
		  $object->rules(
		   'email', array(
		      array('not_empty'),
		      array('max_length', array(':value', 100)),
		      array('email')
		   ));
		   
		   $object->rules(
		   'adress',array(
			array('not_empty'),
		        array('max_length', array(':value', 100))    
		   ));
		   $object->rules(
		   'city',array(
			array('not_empty'),
		        array('max_length', array(':value', 100)),
			array('regex', array(':value', '/^[a-z_.]++$/iD')) 
		   ));
		   $object->rules(
		   'country',array(
			array('not_empty'),
		        array('max_length', array(':value', 100)),
			array('regex', array(':value', '/^[a-z_.]++$/iD'))
		   ));
		   
		return $object;
		
	}
	
	
	public function action_add(){
		$clients = Model::factory('clients');
		if ($this->request->is_ajax()){
			$post = $this->request->post();
				foreach ($post as $value => $key){
				$post[$value] = trim(htmlentities($key)); 
				}
			$object = $this->_valid($post);
			
			
			if ($object->check())
			{
				try {
				if (!$clients->add_client($post)) {
				    throw new Exception("Somethink was wrong!!");
					}
				}
				catch (Exception $e) {
				    echo $e->getMessage();}	
					
			
			}else
			{			
			return false;
			}		
		}else {
			echo "Direct access not alowed";
		}//endif;
	}
	
	
	
	
	public function action_get_one_client(){
		if ($this->request->is_ajax()){
		
		$id = $this->request->post('id');
		if (!isset($id) || !is_numeric($id)){
			 exit();
		}
		$clients = Model::factory('clients');
		
		try {
			if (!$single = $clients->one_client($id)) {
			    throw new Exception("Somethink was wrong!!");
				}
			}
			catch (Exception $e) {
			    echo $e->getMessage();}
		
		
		print json_encode($single);
		}
		else{echo "Direct access not alowed";}
		
	}
	
	public function action_edit(){
				
		if ($this->request->is_ajax()){
		$client = Model::factory('clients');	
		$id = $this->request->post('id');	
			$post = $this->request->post();
		foreach ($post as $value => $key){
			$post['id']= $id;
			$post[$value] = trim(htmlentities($key)); 
			}
		
		$object = $this->_valid($post);
		
		if ($object->check())
			{
				
			try {
			if (! $client->edit_client($post)) {
			    throw new Exception("Somethink was wrong!!");
				}
			}
			catch (Exception $e) {
			    echo $e->getMessage();}
			}
			else {
		
		return false;
		  
		}
		
		
			
			
		}//endif;
		
		
		
	}

	public function action_del(){
		
		if ($this->request->is_ajax()){
		$id = $this->request->post('id');
		if (!isset($id) || !is_numeric($id)){
			 exit();
		}elseif (isset($id) && !empty($id)) {
		
		$clients = Model::factory('clients');
		$clients->del_client($id);
		
		}
		}else {
			echo"Direct acces not alowed";
		}
	}
    
    /* ||||||||||||||||||||||||||||||||||||||||||||||||||||||||| kohana |||||||||||||||||||||||||||||||||||||||||||||||||||||*/
    
    
	
}

/* End of file main.php */
/* Location: ./application/modules/main/controllers/main.php */