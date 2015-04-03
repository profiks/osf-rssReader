<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Page_view_model extends CI_Model{
    
    
    
    function fetch_increment($feed_id){
		
		$this->db->where('id',$feed_id)
			 ->set('views','views+1',FALSE)
			 ->update('feeds');
		
	       }
    
    
    
        function daily_view(){   
              
              $result = $this->db->query(
    "INSERT INTO views (day,views) VALUES (CURDATE(),1) ON DUPLICATE KEY UPDATE views=views+1;");
              
	    
        }



}