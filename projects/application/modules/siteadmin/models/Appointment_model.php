<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class appointment_model extends CI_Model {

    public function __construct() {
        parent::__construct();
        $this->load->database();
    }

    public function a_list() {
        $this->db->select('a.*,s.name as service,sty.name as stylist');
        $this->db->from('sbs_appointment as a');
        $this->db->join('sbs_service as s', 'a.service_id=s.id');
        $this->db->join('sbs_stylist as sty', 'a.assigned_by=sty.id', 'left');
        $query = $this->db->get();
        $i = 0;
        $list = array();
        foreach ($query->result_array() as $var) {
            $list[$i]['id'] = $var['id'];
            $list[$i]['client_id'] = $var['client_id'];
            $list[$i]['client_email'] = $var['client_email'];
            $list[$i]['client_phone'] = $var['client_phone'];
            $list[$i]['service'] = $var['service'];
            $list[$i]['service_id'] = $var['service_id'];
            $list[$i]['time'] = $var['time'];
            $list[$i]['stylist'] = $var['stylist'];
            $list[$i]['status'] = $var['status'];
            $list[$i]['paymode'] = $var['paymode'];
            $list[$i]['date_added'] = $var['date_added'];
            $i++;
        }
        return $list;
    }

    function update_data($id) {
        $this->db->select('a.*,c.name as client_name,s.name as service_name,s.price,sty.name as stylist');
        $this->db->from('sbs_appointment as a');
        $this->db->join('sbs_client as c', 'a.client_id=c.id', 'left');
        $this->db->join('sbs_service as s', 'a.service_id=s.id', 'left');
        $this->db->join('sbs_stylist as sty', 'a.assigned_by=sty.id', 'left');
        $this->db->where('a.id', $id);
        $query = $this->db->get();
        $result = $query->row_array();
//        echo $this->db->last_query();die;
//        print_r($result);die;
        return $result;
    }

    function get_stylist($s_id,$id,$t) {
    
       $time = date("Y-m-d H:i:s", strtotime('+30 minutes', strtotime($t)));
       $time_less = date("Y-m-d H:i:s", strtotime('-30 minutes', strtotime($t)));
       $this->db->select('sty.name,sty.id');
       $this->db->from('sbs_stylist as sty');
       $this->db->join('sbs_stylist_tag_service as sty_tag','sty_tag.stylist_id=sty.id');
//       $this->db->join('sbs_service as ser','ser.id=sty_tag.service_id');
       $this->db->where('sty_tag.service_id',$s_id);
       $this->db->where('sty_tag.status','active');
       $query=$this->db->get();
//echo $this->db->last_query();die;
      $list=$query->result_array();
//      print_r($list);die;
       $i=0;
       $result=array();
//       echo $t;die;
    
       foreach($list as $val) {
//           $date=date('d/m/y',  strtotime($t));
//           $date_comp=explode(',',$val['close_date']);
//           print_r($date_comp);die;
           $query=$this->db->query(" SELECT `assigned_by`, `time` FROM `sbs_appointment` WHERE `assigned_by` = '".$val['id']."' AND `status` = 'active' AND `time` BETWEEN '".$time_less."' AND '".$time."'");
//         echo $this->db->last_query();
           $res=$query->result_array();
           
            if($query->num_rows()==0)
             {
            
           $result[$i]['name']=$val['name'];
           $result[$i]['id']=$val['id'];
      
           }
            $i++;
       }
//       print_r($result);die;
        return $result;
    }
    function fix_appointment($data, $sty) {
        $this->db->where('id', $data);
        $this->db->set('assigned_by', $sty);
        $this->db->set('status', 'active');
        $this->db->update('sbs_appointment');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function cancel_appointment($id) {
      
        $this->db->where('id', $id);
        $this->db->set('assigned_by', '');
        $this->db->set('status', 'inactive');
       $this->db->update('sbs_appointment');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function payment_list(){
    
      $this->db->select('p.*,s.	name');
      $this->db->from('sbs_stylist_transaction_option as p');
      $this->db->join('sbs_stylist as s','p.stylist_id=s.id');
       $query=$this->db->get();
       $i=0;
       foreach($query->result_array() as $val){
           $list[$i]['name']=$val['name'];
           $list[$i]['payment_option']=$val['payment_option'];
           $list[$i]['pay_mode']=$val['pay_mode'];
           $list[$i]['date']=$val['date'];
           $list[$i]['trn_id']=$val['trn_id'];
           $list[$i]['amount']=$val['amount'];
           $i++;
       }
           return $list;   
    }

}
