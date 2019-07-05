<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
class Team extends MX_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('team_model');
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->helper('url');

        if (!$this->session->userdata('sbs_adminlogin')) {
            redirect(base_url() . 'siteadmin/');
        }
    }
    
    public function index() {
        $data['title'] = 'Team';
       $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        $data['stylesheets'][] = 'admin/datepicker/css/bootstrap-datepicker3.min.css';

        $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
        $data['javascripts'][] = 'admin/datepicker/js/bootstrap-datepicker.min.js';
        $data['javascripts'][] = 'admin/datepicker/locales/bootstrap-datepicker.en-GB.min.js';
        $this->load->view('header', $data);
        $this->load->view('team/team',$data);
        $this->load->view('footer');
    }
    public function add_team(){
        $this->form_validation->set_rules('title', 'name', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('descr', 'description', 'required');
          if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('team', $_POST);
            redirect(base_url() . 'siteadmin/team', 'refresh');
        } else {
            $imgdata = '765-default-avatar.png';
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/team/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '2048';
                $config['max_height'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('msg', $this->upload->display_errors());
                    redirect(base_url() . 'siteadmin/team', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/team/' . $image['file_name'];
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

        }
       $data['team'] = array(
                'name' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'description' => $this->input->post('descr'),
                'image' => $imgdata,
                  'social' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram')
            );
//            $data['social'] = array(
////                'news_author_social_type' => 'facebook,twitter,google-plus,pinterest,linkedin,youtube,instagram',
//                'social' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram'),
//            );
            $return = $this->team_model->team_add($data);
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['team']['name'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/team/team_list', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>please try again. some error</div>');
                redirect(base_url() . 'siteadmin/team', 'refresh');
            }
        
    }
    function team_list(){
        $data['title'] = 'Team List';
        $data['stylesheets'][] = 'admin/js/datatables/jquery.dataTables.min.css';
        $data['javascripts'][] = 'admin/js/datatables/jquery.dataTables.min.js';
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
        $this->load->view('header', $data);
        $data['listpage']=$this->team_model->team_list();
        $this->load->view('team/team_list', $data);
        $this->load->view('footer');
        
      
    }
    function team_edit($id){
        $data['title']="Team Edit";
        $data['stylesheets'][] = 'admin/css/select_new/bootstrap-select.min.css';
        $data['javascripts'][] = 'admin/js/select_new/bootstrap-select.min.js';
         $data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
          $data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
        
        $data['javascripts'][] = 'admin/js/datatables/dataTables.bootstrap.js';
         $this->load->view('header', $data);
        $data['info']= $this->team_model->team_edit($id);
        
//        print_r($data['info']);die;
         $this->load->view('team/team_edit',$data);
         $this->load->view('footer');
    }
    function team_edit_process($id){
        $this->form_validation->set_rules('title', 'name', 'required');
        $this->form_validation->set_rules('url', 'url', 'required');
        $this->form_validation->set_rules('descr', 'description', 'required');
        
        
     
        
        
          if ($this->form_validation->run() == FALSE) {
            $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
            $this->session->set_userdata('team', $_POST);
            redirect(base_url() . 'siteadmin/team', 'refresh');
        } else {
            $imgdata = $this->input->post('img');
            if ($_FILES['image']['name'] != "") {
                $config['upload_path'] = './assets/team/';
                $config['allowed_types'] = 'gif|jpg|png';
                $config['max_size'] = '2048';
                $config['max_width'] = '2048';
                $config['max_height'] = '1024';
                $config['remove_spaces'] = true;
                $config['overwrite'] = false;
                $config['encrypt_name'] = true;
                $this->load->library('upload', $config);
                if (!$this->upload->do_upload('image')) {
                    $this->session->set_flashdata('msg', $this->upload->display_errors());
                    redirect(base_url() . 'siteadmin/team', 'refresh');
                    die;
                } else {
                    $image = $this->upload->data();
                    $config['image_library'] = 'gd2';
                    $config['source_image'] = './assets/team/' . $image['file_name'];
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

        }
       $data['team'] = array(
                'name' => $this->input->post('title'),
                'url' => $this->input->post('url'),
                'description' => $this->input->post('descr'),
                'image' => $imgdata,
           'status' => $this->input->post('status'),
                  'social' => $this->input->post('facebook') . "," . $this->input->post('twitter') . "," . $this->input->post('googleplus') . "," . $this->input->post('pinterest') . "," . $this->input->post('linkedin') . "," . $this->input->post('youtube') . "," . $this->input->post('instagram')
            );
       
   
     $return = $this->team_model->team_update($data,$id);
            if ($return) {

                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' . $data['team']['name'] . '  save successfully </div>');
                redirect(base_url() . 'siteadmin/team/team_list', 'refresh');
            } else {
                $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>No Change </div>');
                redirect(base_url() . 'siteadmin/team/team_list', 'refresh');
            }
             }
}