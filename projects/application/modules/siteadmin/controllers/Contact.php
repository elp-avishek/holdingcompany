<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Contact extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('contact_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {
        $data['title'] = 'Contact list';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        
        $this->load->view('header', $data);
        $data['contact_list'] = $this->contact_model->contact_list();
        $this->load->view('contact/contact',$data);
        $this->load->view('footer');
    }
 
    public function Contact_info($id){
        $data['title'] = 'Contact Info';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header',$data);
        $data['contact_info']=$this->contact_model->info($id);
        $this->load->view('contact/contact_detail',$data);
        $this->load->view('footer');
        
    }
}
