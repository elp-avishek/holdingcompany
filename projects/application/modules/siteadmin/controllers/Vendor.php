<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Vendor extends MX_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('vendor_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('redwomenadminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {

      $data['title'] = 'Veddor List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage'] = $this->vendor_model->vendorlist();
        $this->load->view('vendor/vendor_list', $data);
        $this->load->view('footer');
    }

   

}
