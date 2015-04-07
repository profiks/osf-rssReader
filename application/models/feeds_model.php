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

        function get_latest_2_feeds(){
            $this->db->select('link');
            $this->db->from('feeds');
            $query = $this->db->get();
            $data['first'] = $query->last_row();
            $data['second'] = $query->previous_row();
             

            
            return $data;
            
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
    
    
    
	       function insert_feed($data){
               
                $this->db->insert('feeds', $data); 
		    
	       }
            
    
            function update_feed($id,$data){
                
                $this->db->where('id', $id);
                $this->db->update('feeds', $data); 
                
            }
    
	   
	      
	      function del_feed($id){
            $this->db->delete('feeds', array('id' => $id)); 
          } 
    
    
    
	       
}
/* End of file feeds.php */
/* Location: ./application/models/ */