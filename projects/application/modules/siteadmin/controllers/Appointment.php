<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Appointment extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('appointment_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }
    function index(){
         $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $data['title']='Appointment';
       $this->load->view('header', $data);
        
        $data['appointment']=$this->appointment_model->a_list();
//        print_r($data['appointment']);die;
        $this->load->view('appointment/appointment',$data);
         $this->load->view('footer');
    }
    function appointment_edit($id,$s_id){
         $data['stylesheets'][] = 'admin/stylishalert/alert/css/alert.min.css';
         $data['stylesheets'][] = 'admin/stylishalert/alert/themes/dark/theme.min.css';
         $data['javascripts'][] = 'admin/stylishalert/alert/js/alert.min.js';
         
        $data['title']="Appointment Edit";
        $this->load->view('header', $data);
        $data['update_info']=$this->appointment_model->update_data($id);
        $data['stylist']=$this->appointment_model->get_stylist($s_id,$id,$data['update_info']['time']);
//        print_r($data['stylist']);die;
        $this->load->view('appointment/appointment_edit',$data);
        $this->load->view('footer');
    }
    function appointment_fix($id){
//         $config = array (
//                  'mailtype' => 'html',
//                  'charset'  => 'utf-8',
//                  'priority' => '1'
//                   );
//        $this->email->initialize($config);
//        $this->email->from('info@freshnfit.in', 'freshnfit');
//        $this->email->to(strtolower($m));
//        $this->email->subject('sbsSalon');
//        $message= modules::run('mailtemplate/appointment_mail');
//        $this->email->message($message);
//        $this->email->send();  
        $sty_id=$this->input->post('stylist');
        $data=$this->appointment_model->fix_appointment($id,$sty_id);
        if(data){
             $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>  Appointment Fix  </div>');
            redirect(base_url('siteadmin/appointment'));
        }
    }
    function appointment_cancel($id){
        $data=$this->appointment_model->cancel_appointment($id);
        if($data){
       
             $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Appointemnt cancel</div>');
                redirect(base_url('siteadmin/appointment'));
        }else{
             $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>Error</small></div>');
                redirect(base_url('siteadmin/appointment'));
        }
    }
    
}
