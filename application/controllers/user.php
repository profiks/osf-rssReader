<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_controller {

    
    
    
    
    
    
    
    
    
    
    
	
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
		$this->load->view('header',$data);
		$this->load->view('nav');
		$this->load->view('main_page',$data);
		$this->load->view('footer');
	}
	
    
    
    
    
    
    
    
    
	function add_feed(){	
        if ($this->input->is_ajax_request()) {
        
			$data['title'] =  $this->input->post('title');
            $data['link'] =  $this->input->post('link');
			$data['favourite'] = 0;		
            
         $this->feeds_model->insert_feed($data);
            
            
            
       }else {  //is ajax
                exit('No direct script access allowed');

        }  
	} //add
		
		
    
    
    
    
		
	public function edit_feed()
	{
		
       if ($this->input->is_ajax_request()) {
           
               $id = $this->input->post('id');
                $favourite = $this->input->post('favourite');
                if(!$favourite) {$favourite = 0;}
           
                $data = array(
               'link' =>  $this->input->post('link'),
               'title' => $this->input->post('title'),               
               'favourite' => $favourite
                );
           
           
           
        $this->feeds_model->update_feed($id,$data);
           
           
       }else {
                        exit('No direct script access allowed');

        } 
        
	}
	
	

    
    
    
	
	function all_feeds(){
		$data['title'] = "My feeds";
		$data['feeds'] = $this->feeds_model->get_all_feeds();
        $this->load->view('header',$data);
        $this->load->view('nav');
        $this->load->view('all_feeds',$data);
        $this->load->view('footer');
        
	}
	
    
    
    

    
    
    public function manage_feeds(){
        
            $data['title'] = "Edit feeds";       
            $this->load->view('header',$data);
            $this->load->view('nav');
            $this->load->view('manage_feeds');
            $this->load->view('footer');
        
    }
    
    
    
    
    
    
    public function my_feeds(){
         if ($this->input->is_ajax_request()) {
        $feeds= $this->feeds_model->get_all_feeds();     
         print json_encode($feeds);	
        }else {
                exit('No direct script access allowed');

        }
    }
    
    
    
      public function latest_aded_feeds(){
         if ($this->input->is_ajax_request()) {
             
         $feeds= $this->feeds_model->get_latest_2_feeds();     
         print json_encode($feeds);	
             
        }else {
                exit('No direct script access allowed');

        }
    }
    
    
    public function single_feed(){
           $data['title'] = "Single feed";       
            $this->load->view('header',$data);
            $this->load->view('nav');
            $this->load->view('single',$data);
            $this->load->view('footer');
        
    }
    
    
    public function get_one_feed(){
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id'); 


                $feeds= $this->feeds_model->get_feed_settings($id); 
                if($feeds['favourite'] == 1) {
                    $feeds['checked'] = "checked";
                } 
            
             print json_encode($feeds);	

        }else {
                exit('No direct script access allowed');

        }
    }
    
    
    
    
    
    
    public function del_feed(){
        if ($this->input->is_ajax_request()) {
            $id = $this->input->post('id'); 

            $this->feeds_model->del_feed($id);

        }else {
                exit('No direct script access allowed');

        }
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



    
    
	
}

/* End of file main.php */
/* Location: ./application/modules/main/controllers/main.php */