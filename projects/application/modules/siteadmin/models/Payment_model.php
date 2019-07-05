<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class payment_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function payment_list($id) {
        $this->db->select('cj.*,c.title,c.price,s.name');
//        $this->db->select_sum('st.amount');
        $this->db->from('sbs_course_join_application as cj');
        $this->db->join('sbs_course as c', 'cj.course_id=c.id');
        $this->db->join('sbs_stylist as s', 'cj.stylish_id=s.id');
//        $this->db->join('sbs_stylist_transaction_option as st', 'cj.stylish_id=st.stylist_id');
        $this->db->where('cj.stylish_id', $id);
//        $this->db->where('st.stylist_id', $id);
//        $this->db->where('st.payment_option', 'received');
        $query = $this->db->get();
      
//       echo  $this->db->last_query();die;
        $i = 0;
        $pay = array();
         $pay['count']=$query->num_rows();
        $res = $query->result_array();
        $pay['sum'] = 0;
        foreach ($res as $val) {
            $pay['stylish_id'] = $id;
            $pay['name'] = $val['name'];
            $pay['course_id'][$i] = $val['course_id'];
            $pay['title'][$i] = $val['title'];
            $pay['price'][$i] = $val['price'];
            $pay['sum'] = $pay['sum'] + $val['price'];
          
            $i++;
        }
        return $pay;
    }

    function service_list($id) {
        $this->db->select('a.*,s.name,s.price');
      
        $this->db->from('sbs_appointment as a');
        $this->db->join('sbs_service as s', 'a.service_id=s.id');
       
        $this->db->where('a.assigned_by', $id);
       
        $query=$this->db->get();
        
//        echo $this->db->last_query();die;
        $i=0;
        $list=array();
//        $list['sum']=0;
        foreach($query->result_array() as $val){
            $list['name'][$i]=$val['name'];
            $list['price'][$i]=$val['price'];
            $list['client_id']=$val['client_id'];
            $list['service_id'][$i]=$val['service_id'];
            $list['time'][$i]=$val['time'];
            
        
//            $list['sum']=$list['sum']+$val['price'];
            $i++;
        }
//        print_r($list);die;
        return $list;
    }
 function trancsation($id){
     $this->db->select('amount,date,trn_id');
     $this->db->where('stylist_id',$id);
     $this->db->where('payment_option','received');
  
    $query=$this->db->get('sbs_stylist_transaction_option');
   $result=array();
    $i=0;
   foreach($query->result_array()  as $trans){
       $result[$i]['amount']=$trans['amount'];
       $result[$i]['date']=$trans['date'];
       $result[$i]['trn_id']=$trans['trn_id'];
       $i++;
   }
    
    return $result;
 }
 function paid_transaction($id){
     $this->db->select('amount,date,trn_id');
     $this->db->where('stylist_id',$id);
     $this->db->where('payment_option','given');
  
    $query=$this->db->get('sbs_stylist_transaction_option');
   
    $i=0;
     $result=array();
   foreach($query->result_array()  as $trans){
       $result[$i]['amount']=$trans['amount'];
       $result[$i]['date']=$trans['date'];
       $result[$i]['trn_id']=$trans['trn_id'];
       $i++;
   }
    
    return $result;
 }
 
 
 function payout($data){
    $query=$this->db->insert('sbs_stylist_transaction_option',$data);
     if($this->db->affected_rows()>0){
         return true;
     }else{
         return false;
     }
 }
}
