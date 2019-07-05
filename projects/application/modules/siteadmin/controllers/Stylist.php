<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Stylist extends CI_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('stylist_model');
        $this->load->database();
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');
        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }

    public function index() {
        $data['title'] = 'Stylist';
        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';
$data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';
        $this->load->view('header', $data);
        $data['stylist_list'] = $this->stylist_model->stylist_list();
        $this->load->view('stylist/stylist_list', $data);
        $this->load->view('footer');
        $this->session->unset_userdata('stylist');
    }

    public function stylist_add() {
      $data['title'] = 'Stylist';
//        $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
//        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';
//        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
//        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
//        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';
      
        $this->load->view('header', $data);
        $this->load->view('stylist/stylist_add', $data);
        $this->load->view('footer');
    }
public function stylist_add_process(){
     $this->form_validation->set_rules('title', 'name', 'required|max_length[50]');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        $this->form_validation->set_rules('password', 'password', 'required|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password', 'confirm_password', 'required');
        
        if ($this->form_validation->run() == FALSE) 
            
         {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
           $this->session->set_flashdata('color_add',"border-red");
            $this->session->set_userdata('stylist', $_POST);
            redirect(base_url() . 'siteadmin/stylist/stylist_add', 'refresh');
        }else{
            $imgdata='765-default-avatar.png';
            if($_FILES['image']['name']!='')
            {
                $config['upload_path'] = './assets/stylist/';
                $config['allowed_types'] = 'jpg|gif|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '2048';
                $config['max_height'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('msg', $this->upload->display_errors());
                    redirect(base_url() . 'siteadmin/stylist/stylist_add', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/stylist/' . $image['file_name'];
                    $config['create_thumb'] = FALSE;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 200;
                    $config['height'] = 200;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
              $imgdata = $image['file_name'];
            }
            $data['stylist'] = array(
                'name' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'email' => $this->input->post('email'),
                'password'=>md5($this->input->post('password')),
                'school_completed'=>$this->input->post('school_completed'),
                'license_number'=>$this->input->post('license_number'),
                'how_did_you_find_us'=>$this->input->post('find_us'),
                'image' => $imgdata,
                 'social' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
            'date_added'=>date('Y-m-d H:I:S')
                    );
            $return=$this->stylist_model->stylist_add($data);
            if($return){
$this->session->unset_userdata('stylist');
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['stylist']['name'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/stylist', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No Change </div>');
                redirect(base_url() . 'siteadmin/stylist/stylist_add', 'refresh');
            }
             }
}
public function stylist_edit($id){
   $data['stylesheets'][] = 'admin/css/select_new/bootstrap-select.min.css';
        $data['javascripts'][] = 'admin/js/select_new/bootstrap-select.min.js';
     $data['title'] = 'Stylist Edit';
    $this->load->view('header',$data);
    $data['edit']=$this->stylist_model->stylist_edit($id);
//    print_r($data['edit']);die;
     
    $this->load->view('stylist/stylist_edit',$data);
    $this->load->view('footer');
}        
public function stylist_edit_process(){
    $this->form_validation->set_rules('title','name','required');
    $this->form_validation->set_rules('url','url','required');
    $this->form_validation->set_rules('email','email','required');
//     $this->form_validation->set_rules('password', 'password','required|matches[confirm_password]');
//        $this->form_validation->set_rules('confirm_password','confirm_password','required');
         if ($this->form_validation->run() == FALSE) 
            
         {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
//            $this->session->set_userdata('stylist', $_POST);
//            $this->session->set_flashdata('color','border-red');
            redirect(base_url() . 'siteadmin/stylist/stylist_edit/'.$this->input->post('id'), 'refresh');
        }else{
            $ps=$this->stylist_model->stylist_edit($this->input->post('id'));
             $pass=$ps['password'];
            $imgdata=$this->input->post('img');
            if($_FILES['image']['name']!='')
            {
                $config['upload_path'] = './assets/stylist/';
                $config['allowed_types'] = 'jpg|gif|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '2048';
                $config['max_height'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('msg', $this->upload->display_errors());
                    redirect(base_url() . 'siteadmin/stylist/stylist_add', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/stylist/' . $image['file_name'];
                    $config['create_thumb'] = true;
                    $config['maintain_ratio'] = TRUE;
                    $config['width'] = 200;
                    $config['height'] = 200;

                    $this->load->library('image_lib', $config);
                    $this->image_lib->initialize($config);
                    $this->image_lib->resize();
                }
              $imgdata = $image['file_name'];
            }
            if(!empty(($this->input->post('password')))){
                if( ($this->input->post('password'))==($this->input->post('confirm_password'))){
                $pass=md5($this->input->post('password'));} 
                else {
                    $this->session->set_flashdata('color','border-red');
            redirect(base_url() . 'siteadmin/stylist/stylist_edit/'.$this->input->post('id'), 'refresh');
                }
           
                
            }
            $data['stylist'] = array(
                'name' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'email' => $this->input->post('email'),
                'password'=>$pass,
                'school_completed'=>$this->input->post('school_completed'),
                'license_number'=>$this->input->post('license_number'),
                'how_did_you_find_us'=>$this->input->post('find_us'),
                'image' => $imgdata,
                'id'=>$this->input->post('id'),
                 'social' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
            'date_added'=>date('Y-m-d H:I:S'),
                 'status' => $this->input->post('status')
                    );
            $return=$this->stylist_model->stylist_update($data);
            if($return){

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['stylist']['name'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/stylist', 'refresh');
            }else {
              $this->session->unset_userdata('stylist');
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No Change </div>');
                redirect(base_url() . 'siteadmin/stylist/stylist_edit/'.$this->input->post('id'), 'refresh');
            } 
        }
}

}