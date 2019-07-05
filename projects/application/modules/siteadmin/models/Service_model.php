<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class service_model extends CI_Model {

    function __construct() {
        parent::__construct();
        $this->load->database();
    }

    function add_service($data) {
        $this->db->insert('sbs_service', $data['service_add']);
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('service');
            return true;
        } else {
            return false;
        }
    }

    function service_list() {
        $query = $this->db->get('sbs_service');
        $i = 0;
        $list = array();
        foreach ($query->result_array() as $var) {
            $list[$i]['name'] = $var['name'];
            $list[$i]['id'] = $var['id'];
            $list[$i]['url'] = $var['url'];
            $list[$i]['status'] = $var['status'];
            $list[$i]['price'] = $var['price'];
            $list[$i]['image'] = $var['image'];
            $i++;
        }

        return $list;
    }

    function service_edit($id) {
        $this->db->where('id', $id);
        $query = $this->db->get('sbs_service');
        $result = $query->row_array();
        return $result;
    }

    function update_service($data, $id) {
        $this->db->where('id', $id);
        $this->db->update('sbs_service', $data['service_edit']);
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function get_stylist() {
        $this->db->where('status', 'active');
        $query = $this->db->get('sbs_stylist');
        $i = 0;
        $sty = array();
        foreach ($query->result_array() as $var) {
            $sty[$i]['name'] = $var['name'];
            $sty[$i]['image'] = $var['image'];
            $sty[$i]['id'] = $var['id'];
            $i++;
        }
//        print_r($sty);
        return $sty;
    }

    function service_tag($data, $id) {
        $this->db->Where('service_id', $id);
        $this->db->set('status', 'inactive');
        $this->db->update('sbs_stylist_tag_service');


        foreach ($data as $var) {
//             $this->db->set('status','inactive');
//              $this->db->Where('service_id',$id);
//             $q=$this->db->update('sbs_stylist_tag_service');


            $this->db->Where('service_id', $id);
            $this->db->where('stylist_id', $var);
            $query = $this->db->get('sbs_stylist_tag_service');
            if ($query->num_rows() == 0) {
                $this->db->set('service_id', $id);
                $this->db->set('stylist_id', $var);
                $this->db->set('status', 'active');
                $this->db->insert('sbs_stylist_tag_service');
            } else {
//             if(empty($var)){
//               $this->db->set('status','inactive');
//             }else{
                $this->db->Where('stylist_id', $var);
                $this->db->set('status', 'active');
//             }
                $this->db->update('sbs_stylist_tag_service');
            }
        }
        if ($this->db->affected_rows() > 0) {

            return true;
        } else {
            return false;
        }
    }

    function check_stylist($id) {
//         $this->db->select('stylist_id','status');
        $this->db->where('service_id', $id);
        $this->db->where('status', 'active');
        $query = $this->db->get('sbs_stylist_tag_service');
        $i = 0;
        $list = array();
        foreach ($query->result_array() as $var) {
            $list['id'][$i] = $var['stylist_id'];

            $i++;
        }
//         print_r($list);die;
        return $list;
    }

    function update_close_date($data, $id) {
        $this->db->where('id', $id);
        $this->db->set('close_date', $data);
        $this->db->update('sbs_service');
        if ($this->db->affected_rows() > 0) {
            return true;
        } else {
            return false;
        }
    }

    function close_info($id) {
        $this->db->select('close_date');
        $this->db->where('id', $id);
        $query = $this->db->get('sbs_service');

        $result = $query->row_array();
        $result1 = "";
        if (!empty($result['close_date'])) {
            $result1 = explode(',', $result['close_date']);
        }
//        echo json_encode($result1);die;
        return $result1;
    }

    function upload_shedule($id, $data) {
        $this->db->select('id');
        $this->db->where('service_id', $id);
        $query = $this->db->get('sbs_service_period');
        if (!$query->num_rows() > 0) {
            foreach ($data as $index => $val) {
                if (!empty($val['fromtime']) || !empty($val['totime'])) {
                    $from = implode(',', $val['fromtime']);
                    $to = implode(',', $val['totime']);
                    $this->db->set('service_id', $id);
                    $this->db->set('day', $index);
                    $this->db->set('from_time', $from);
                    $this->db->set('to_time', $to);
                    $this->db->insert('sbs_service_period');
                }
            }
        } else {

            foreach ($query->result_array() as $en) {

                foreach ($data as $index => $val) {

                    if (!empty($val['fromtime']) || !empty($val['totime'])) {
                        $from = implode(',', $val['fromtime']);
                        $to = implode(',', $val['totime']);
//           $this->db->set('service_id',$id);
//           $this->db->set('day',$index);
                        $this->db->set('from_time', $from);
                        $this->db->set('to_time', $to);
                        $this->db->where('id', $en);
                        $this->db->update('sbs_service_period');
                    }
                }
            }
        }
    }

    function get_service_time($s_id, $day) {

        $this->db->where('service_id', $s_id);
        $this->db->where('day', $day);
        $query = $this->db->get('sbs_service_period');
        $result = $query->row_array();
        return $result;
    }

    function service_period_add($s_id, $day, $f, $t) {

        $this->db->select('service_id,day,from_time,to_time');
        $this->db->from('sbs_service_period');
        $this->db->where('service_id', $s_id);
        $this->db->where('day', $day);
        $query = $this->db->get();
        $result = $query->row_array();
        if (!empty($result['service_id'] && $result['day'])) {
            $fromtime = array();
            $to_time = array();
            if (!empty($result['from_time'] && $result['to_time'])) {
                $fromtime = explode(',', $result['from_time']);
                $to_time = explode(',', $result['to_time']);
            }
//        print_r($to_time);die;
            if (!empty($f && $t)) {
                array_push($fromtime, $f);
                array_push($to_time, $t);
//            print_r($fromtime);
//            print_r($to_time);
//           die;
                $fr = implode(',', $fromtime);
                $to = implode(',', $to_time);
                $this->db->set('to_time', $to);
                $this->db->set('from_time', $fr);
                $this->db->where('service_id', $s_id);
                $this->db->where('day', $day);
                $this->db->update('sbs_service_period');
            }
        } else {
            $this->db->set('service_id', $s_id);
            $this->db->set('day', $day);
            $this->db->set('from_time', $f);
            $this->db->set('to_time', $t);
            $this->db->insert('sbs_service_period');
        }
    }

    function service_period_remove($s_id, $day, $a) {
        $this->db->select('from_time,to_time');
        $this->db->from('sbs_service_period');
        $this->db->where('service_id', $s_id);
        $this->db->where('day', $day);
        $query = $this->db->get();
        $result = $query->row_array();
        $from_time = explode(',', $result['from_time']);
        $to_time = explode(',', $result['to_time']);
        unset($from_time[$a]);
        unset($to_time[$a]);
//        print_r($to_time);die;
        $fr = implode(',', $from_time);
        $to = implode(',', $to_time);
////        print_r($to);die;
        $this->db->set('from_time', $fr);
        $this->db->set('to_time', $to);
        $this->db->where('service_id', $s_id);
        $this->db->where('day', $day);
        $this->db->update('sbs_service_period');
    }

}
