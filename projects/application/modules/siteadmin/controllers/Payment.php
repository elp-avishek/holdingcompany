<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Payment extends CI_Controller {

    function __construct() {

        parent::__construct();
        $this->load->database();
        $this->load->model('payment_model');
        $this->load->helper('url');
        $this->load->helper('form');
        $this->load->library('form_validation');
        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    function index() {
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $data['title'] = 'Payment';
        $this->load->view('header', $data);
        $this->load->model('Appointment_model');
        $data['payment'] = $this->Appointment_model->payment_list();
        $this->load->view('payment/payment', $data);
        $this->load->view('footer');
    }

    function payment_detail($id) {
        $data['title'] = 'Payment Detail';
        $this->load->view('header', $data);
        $data['pay'] = $this->payment_model->payment_list($id);
        $data['trancsation'] = $this->payment_model->trancsation($id);
        $data['service'] = $this->payment_model->service_list($id);
        $data['paid_transaction'] = $this->payment_model->paid_transaction($id);
//     echo "<pre>";
//     print_r($data['paid_transaction']);die;
        $this->load->view('payment/payment_detail', $data);
        $this->load->view('footer');
    }

    function payout($id) {
        $this->form_validation->set_rules('amount','amount','required');
        $this->form_validation->set_rules('note','note','required');
        if($this->form_validation->run()==false){
            
        }
        $data=array(
            'trn_id'=>'',
            'stylist_id'=>$id,
            'payment_option'=>'given',
            'date'=>  date('Y-m-d H:i:s'),
            'pay_mode'=>'admin',
            'amount'=>$this->input->post('amount'),
            'note'=>$this->input->post('note')
        );
        $result=$this->payment_model->payout($data);
        if($result){
            redirect(base_url().'siteadmin/payment/payment_detail/'.$id);
        }else{
             redirect(base_url().'siteadmin/payment/payment_detail/'.$id);
        }
    }

}
