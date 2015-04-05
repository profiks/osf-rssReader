<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Feeds_model extends CI_Model{
    
        
    
            
       /*
        * Stared sources
		* @return array posts in assoc array
		*/
	       function get_favourite_sources(){	
                    
                    $this->db->select('*');
                    $this->db->from('feeds'); 
		            $this->db->where("favourite",1);
		            $this->db->order_by('id','desc');
                    $query = $this->db->get();
                    if($query){
                            if(count($query) > 0){
                                return $query->result_array();
                            }else{
                               return null; 
                            }
                        }	       
	       }
	       
            function get_latest_news(){
                    $this->db->select('*');
                    $this->db->from('rss_posts'); 
		            $this->db->order_by('id','desc');
                    $this->db->limit(100);
                    $query = $this->db->get();
                    if($query){
                            if(count($query) > 0){
                                return $query->result_array();
                            }else{
                               return null; 
                            }
                        }
            }
    
         /*
         * All feeds sources
		 * @return array posts in assoc arraysing
		 */
	       function get_all_feeds(){
		            $this->db->select('*');
                    $this->db->from('feeds'); 
		            $this->db->order_by('id','desc');
                    $query = $this->db->get();
                    
                        if($query){
                            if(count($query) > 0){
                                return $query->result_array();
                            }else{
                               return null; 
                            }
                        }
               
	       }
            
    
    
    
            function get_feed_link_by_id($id){
                    $this->db->select('link');
                    $this->db->from('feeds'); 
		            $this->db->where("id",$id);
                    $query = $this->db->get();
                   return $query->first_row('array');
                
                
                
            }
            
        function get_feed_settings($id){
                    $this->db->select('*');
                    $this->db->from('feeds'); 
		            $this->db->where("id",$id);
                    $query = $this->db->get();
                   return $query->first_row('array');
        }
    
    
    
	       function insert_feed($feed,$rss){
		    try{
                $this->db->insert('feeds',$feed);
            }
             catch (Exception $e) {
				exit();
             }
		    $feeds_id =  $this->db->insert_id();
		   		    
		 foreach($rss as $post => $data){
			 $rss[$post]['feeds_id'] = $feeds_id;
			 unset($rss[$post]['pubDate']);
			 unset($rss[$post]['author']);
		 }	  
			
		   
		  try{
               @$this->db->insert_batch('rss_posts',$rss);
            }
             catch (Exception $e) {
				exit();
             }
		    
	       }
	       
	      function rss_posts($feed_id){
		    $this->db->select('*');
		    $this->db->from('rss_posts');
		    $this->db->where('feeds_id',$feed_id);
		    $this->db->limit(50);
		    $query = $this->db->get();
		    
		    return  $query->result_array();
	      }
	      
	      
	      
	      
	
	       
	      
	     
	       
	      function old_record($feed_id){
		    
		    $this->db->select('link');
		    $this->db->from('rss_posts');
		    $this->db->where('feeds_id',$feed_id);
		    $this->db->limit(1);
		    $query = $this->db->get();
		    
		    return $query->first_row('array');
	       
	      }
	      
	      
	      function reinsert_rss_posts($rss,$feed_id){
		    $this->db->delete('rss_posts', array('feeds_id' => $feed_id));
		    
		    foreach($rss as $post => $data){
			 $rss[$post]['feeds_id'] = $feed_id;
			 unset($rss[$post]['pubDate']);
			 unset($rss[$post]['author']);			 
		    }	  
			
		   $this->db->insert_batch('rss_posts',$rss);
		   
		    
		    
	      }
	      
	       
	       
}
/* End of file feeds.php */
/* Location: ./application/models/ */