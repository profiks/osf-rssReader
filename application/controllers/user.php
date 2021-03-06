<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class User extends CI_controller {

    
    
    
    
    
    
    
    
    
    
    
	
	function __construct()
	{
		parent::__construct();
		$this->load->model('feeds_model');
		$this->load->library('form_validation');
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
	
    
    
    
    public function export_data(){
        
        // Load the DB utility class
        $this->load->dbutil();

        // Backup your entire database and assign it to a variable
        $backup = $this->db->query("SELECT * FROM feeds");
        $delimiter = ",";
        $newline = "\r\n";

        $backup = $this->dbutil->csv_from_result($backup, $delimiter, $newline);

        // Load the file helper and write the file to your server
        $this->load->helper('file');
        write_file('feeds.csv', $backup); 

        // Load the download helper and send the file to your desktop
        $this->load->helper('download');
        force_download('feeds.csv', $backup); 
        
    
    }
    
    function do_upload(){
                $config['upload_path'] = './uploads/';
                $config['allowed_types'] = 'csv';
                $config['max_size']  = '5000';
                $with = ' ';
                $replace = '"';

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload())
                {
                    redirect('user/manage_feeds/');
                }
                else
                {
            //Insert file info into database
            $data = array('upload_data' => $this->upload->data());
            $userfile = $data['upload_data']['file_name'];
                    
                        $filePath1 = './uploads/';
            $filePath2 = $data['upload_data']['file_name'];
            $filePath = $filePath1 . $filePath2;
                         
               $result_array = $this->csv_to_array($filePath); 
                    
                    foreach ($result_array as $row) {
                    $insert_data = array(
                        'title'=>$row['title'],
                        'link'=>$row['link'],
                        'favourite'=>$row['favourite'],
                    );
                      
                      
                     $this->feeds_model->insert_feed($insert_data);
                            
                     
                         
                        
                    
                } 
                    
                   
                  redirect('user/manage_feeds/');  
                    
             }
    }
    
    function csv_to_array($file_name) {
        $data =  $header = array();
        $i = 0;
        $file = fopen($file_name, 'r');
        while (($line = fgetcsv($file)) !== FALSE) {
            if( $i==0 ) {
                $header = $line;
            } else {
                $data[] = $line;        
            }
            $i++;
        }
        fclose($file);
        foreach ($data as $key => $_value) {
            $new_item = array();
            foreach ($_value as $key => $value) {
                $new_item[ $header[$key] ] =$value;
            }
            $_data[] = $new_item;
        }
        return $_data;
    }
    
    
    
    /**
    *
    * @access public
    * @return boolean
    */
	function add_feed(){	
        if ($this->input->is_ajax_request()) {
        
			$data['title'] =  $this->input->post('title');
            $data['categorie'] = $this->input->post('categorie');            
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
    
    
	function all_categories($cat = null){ 
        if(!isset($cat) || !is_numeric($cat)){
            $cat = 1;
        }
		$data['title'] = "My feeds";
		$data['categories'] = $this->feeds_model->get_categories();
        $data['feeds'] = $this->feeds_model->_get_feeds($cat);
        
        $count = '';
        for($i=1;$i<=13; $i++){
            
             $count .= count($this->feeds_model->_get_feeds($i)).";";
        }
        
        $data['count'] = $count;
        $this->load->view('header',$data);
        $this->load->view('nav');
        $this->load->view('all_categories',$data);
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

/* End of file User.php */
/* Location: ./application/controllers/User.php */