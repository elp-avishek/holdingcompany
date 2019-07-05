<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Siteadmin extends MX_Controller {
	
	 public function __construct() {
        parent::__construct();
		 $this->load->helper('url');
		 $this->load->helper('form');
		 $this->load->model('siteadmin_model');
		 $this->load->library('form_validation');
		 //for admin
		$this->load->helper('date');
			
		
    }
	
	public function index()
	{
		
		
		if($this->session->userdata('sbs_adminlogin')){
			 redirect(base_url().'siteadmin/cms');
		}else{
		$this->load->view('login/index');
		}
				
	}
	public function process(){
		 
		  $this->form_validation->set_rules('username', 'Username',  "trim|required");
          $this->form_validation->set_rules('password', 'Password', 'trim|required');

	    if($this->form_validation->run()==FALSE){
              $this->session->set_flashdata('msg',validation_errors());
				redirect(base_url().'siteadmin', 'refresh');
  		    }else{
		 
		  $data=array(  
				"username"=>$this->input->post('username'),
				"password"=>$this->input->post('password')
	         );
		
           $result=$this->siteadmin_model->process($data);
		
				if($result){
					redirect(base_url().'siteadmin/cms', 'refresh');
				  die;
				}else{
				
				   $this->session->set_flashdata('msg', '<div class="alert alert-danger text-center">Invalid username or password!</div>');
				  redirect(base_url().'siteadmin', 'refresh');
				}   
			}
    }
   public function logout(){
	   
	   $sess_array = array(
              'admin_id' => '',
			  'admin_username'=>'',
			  'admin_type'=>'',
			  'admin_permission'=>'',
			  'redwomenadminlogin'=>''
           );
			$this->session->unset_userdata($sess_array); 
            $this->session->sess_destroy();
			redirect(base_url().'siteadmin', 'refresh');
			}
	
}

