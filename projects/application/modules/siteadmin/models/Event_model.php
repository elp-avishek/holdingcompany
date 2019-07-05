<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class event_model extends CI_Model {

    public function __construct() {
        parent::__construct();
    }

    public function addevent($data) {

        $this->db->insert('rw_event', $data);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('event');
            return true;
        } else {
            return false;
        }
    }

    public function eventlist() {


        $this->db->order_by('event_start_date DESC');
        $query = $this->db->get('rw_event');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->result_array();
        }
        return $list;
    }

    public function details($eventid) {


        $this->db->where('event_id', $eventid);
        $this->db->order_by('event_start_date DESC');
        $query = $this->db->get('rw_event');
        $i = 0;
        $list = array();
        if ($query->num_rows() > 0) {
            $list = $query->row_array();
        }
        return $list;
    }

    public function editevent($data, $id) {
        $this->db->where('event_id', $id);
        $this->db->update('rw_event', $data);
        $item_id = $this->db->insert_id();
        if ($this->db->affected_rows() > 0) {
            $this->session->unset_userdata('event');
            return true;
        } else {
            return false;
        }
    }

}
