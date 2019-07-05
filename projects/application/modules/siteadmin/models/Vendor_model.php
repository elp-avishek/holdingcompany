<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class vendor_model extends CI_Model {
	
	 public function __construct() {
        parent::__construct();
		$this->load->database();
    }
	public function vendorlist() {
        $this->db->order_by('vendor_date_added DESC');
        $query = $this->db->get('rw_vendor');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $i=0;
            foreach ($query->result_array() as $vendor) {
            $list[$i]['vendor_id'] = $vendor['vendor_id'];
            $list[$i]['vendor_name'] = $vendor['vendor_name'];
            $list[$i]['vendor_type'] = $vendor['vendor_type'];
            $list[$i]['vendor_email'] = $vendor['vendor_email'];
            $list[$i]['vendor_company_name'] = $vendor['vendor_company_name'];
            $list[$i]['vendor_phone'] = $vendor['vendor_phone'];
            $list[$i]['vendor_city'] = $vendor['vendor_city'];
            $list[$i]['vendor_state'] = $vendor['vendor_state'];
            $list[$i]['vendor_country'] = $vendor['vendor_country'];
            $list[$i]['vendor_zip'] = $vendor['vendor_zip'];
            $events = (array)json_decode($vendor['vendor_event_id']);
            foreach($events as $event){
                
             $event_url[] = $this->eventdetails($event) ;  
            }
            $list[$i]['vendor_event_id'] = $event_url;
            $list[$i]['vendor_date_added'] = $vendor['vendor_date_added'];
            $i++;
            }
        }
        return $list;
    }
    
    public function eventdetails($eventid) {
          
       
        $this->db->where('event_id',$eventid);
         $query = $this->db->get('rw_event');
        $i = 0;
        $list = array();
        $data ='';
        if ($query->num_rows() > 0) {
            $list = $query->row_array();
            $data = $list['event_url'];
        }
        return $data;
   
        
    }
}