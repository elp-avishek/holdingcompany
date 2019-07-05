<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Client extends CI_Controller{
    public function __construct() {
        parent::__construct();
        $this->load->database();
          $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        $this->load->model('client_model');
        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }
    public function client_list(){
         $data['stylesheets'][] = 'admin/stylishalert/alert/css/alert.min.css';
         $data['stylesheets'][] = 'admin/stylishalert/alert/themes/dark/theme.min.css';
         $data['javascripts'][] = 'admin/stylishalert/alert/js/alert.min.js';
        $data['title'] = 'Client List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['client_list']=$this->client_model->list_client();
//        print_r($data['client_list']);die;
        $this->load->view('client/client_list',$data);
         $this->load->view('footer');
    }
    function changestatus($id){
      
        $this->client_model->changestat($id);
    }
}