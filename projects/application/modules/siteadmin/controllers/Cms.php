<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Cms extends CI_Controller {

    function __construct() {
	parent::__construct();
	$this->load->database();
	$this->load->helper('form');
	$this->load->model('cms_model');
	$this->load->library('form_validation');
	$this->load->helper('url');
	//$this->load->library('upload');
	if (!$this->session->userdata('sbs_adminlogin')) {
	    redirect(base_url() . 'siteadmin/');
	}
    }

    function index() {

	$data['title'] = "CMS";
	$data['cms'] = $this->cms_model->list_cms();
	$this->load->view('header', $data);
	$this->load->view('cms/cms_list', $data);
	$this->load->view('footer');
    }

    function edit_cms($id) {

	$data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
	$data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
	$data['title'] = 'CMS edit';
	$this->load->view('header', $data);
	$data['edit_detail'] = $this->cms_model->edit_detail($id);
//        print_r($data['edit_detail']);die;
	$this->load->view('cms/cms_edit', $data);
	$this->load->view('footer');
    }

    function edit_cms_pdf($id) {

	$data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
	$data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
	$data['title'] = 'CMS edit';
	$this->load->view('header', $data);
	$data['edit_detail'] = $this->cms_model->edit_detail($id);
//        print_r($data['edit_detail']);die;
	$this->load->view('cms/cms_edit_pdf', $data);
	$this->load->view('footer');
    }

    public function cms_pdf_edit_process($id) {
	$this->form_validation->set_rules('title', 'cms_title', 'required');
	$this->form_validation->set_rules('url', 'cms_url', 'required');
	$this->form_validation->set_rules('descr', 'cms_description', 'required');
	$this->form_validation->set_rules('menu', 'menu order', 'required');
	//$this->form_validation->set_rules('cms_file_title', 'File Title', 'required');
	//$this->form_validation->set_rules('cms_file_date', 'File Date', 'required');
	$this->form_validation->set_rules('cms_status', 'cms_status', 'required');
	$this->form_validation->set_rules('cms_menu', 'cms_menu', 'required');
	if ($this->form_validation->run() == FALSE) {
	    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
	    redirect(base_url() . 'siteadmin/cms/', 'refresh');
	} else {
	    if (!empty($_FILES['userFiles']['name'])) {
		$total = count($_FILES['userFiles']['name']);
		for ($i = 0; $i < $total; $i++) {
		    $uniqid = uniqid();
		    
		$_FILES['userFile']['name'] = $this->input->post('url') . "_" . $uniqid . "_" .  preg_replace('/[^A-Za-z0-9\.]/', '-', $_FILES['userFiles']['name'][$i]);    
		    //$_FILES['userFile']['name'] = $this->input->post('url') . "_" . $uniqid . "_" . $_FILES['userFiles']['name'][$i];
		    $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
		    $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
		    $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
		    $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
		    $data["db_file_name"][$i] = $this->input->post('url') . "_" . $uniqid . "_" .  preg_replace('/[^A-Za-z0-9\.]/', '-', $_FILES['userFiles']['name'][$i]);
		     $data["db_file_title"][$i] = $_FILES['userFiles']['name'][$i];
		    $uploadPath = './assets/pdf_details/';
		    $config['upload_path'] = $uploadPath;
		    $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|txt|pdf';

		    $this->load->library('upload', $config);
		    $this->upload->initialize($config);
		    if (!$this->upload->do_upload('userFile')) {

			$this->session->set_flashdata('add_cms_pdf_msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
 <small>' . $this->upload->display_errors() . '</small></div>');
			$this->session->set_userdata('pdf_msg', $_POST);
			redirect(base_url() . "siteadmin/cms/add_cms_pdf", 'refresh');
			die;
		    } else {
			$userfile = $this->upload->data();
		    }
		}//for loop end
	    }
	    if (!empty($this->input->post('existance_file')) && !empty($data['db_file_name']) && !empty($this->input->post('exist_cms_file_title')) && !empty($data['db_file_title'])) {
		$exist_file = $this->input->post('existance_file');
		$cms_file = implode(",", $data['db_file_name']);
		$cms_file = $exist_file . "," . $cms_file;
		
		$exist_file_title = $this->input->post('exist_cms_file_title');
		$cms_file_title = implode(",", $data['db_file_title']);
		$cms_file_title = $exist_file_title . "," . $cms_file_title;
		
	    } else if (!empty($this->input->post('existance_file')) && empty($data['db_file_name']) && !empty($this->input->post('exist_cms_file_title')) && empty($data['db_file_title'])) {
		$cms_file = $this->input->post('existance_file');
		$cms_file_title = $this->input->post('exist_cms_file_title');
	    } else if (empty($this->input->post('existance_file')) && !empty($data['db_file_name']) && empty($this->input->post('exist_cms_file_title')) && !empty($data['db_file_title'])) {
		$cms_file_title = implode(",", $data['db_file_title']);
	    }
	    $cms_data = array(
		'cms_title' => $this->input->post('title'),
		'cms_url' => $this->input->post('url'),
		'cms_description' => $this->input->post('descr'),
		'cms_file' => $cms_file,
		'cms_status' => $this->input->post('cms_status'),
		'cms_file_title' => $cms_file_title,
		'cms_menu' => $this->input->post('cms_menu'),
		'cms_menu_order' => $this->input->post('menu')
	    );
	    $result = $this->cms_model->cms_pdf_update_process($id, $cms_data);
	    if ($result) {

		$this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ' . $cms_data['cms_title'] . ' updated successfully </div>');
		redirect(base_url() . 'siteadmin/cms/list_cms_pdf', 'refresh');
	    } else {
		$this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Nothing Updated</div>');
		redirect(base_url() . 'siteadmin/cms/list_cms_pdf', 'refresh');
	    }
	}
    }

    function cms_edit_process($id) {
	$this->form_validation->set_rules('title', 'cms_title', 'required');
	$this->form_validation->set_rules('url', 'cms_url', 'required');
	$this->form_validation->set_rules('descr', 'cms_description', 'required');
	$this->form_validation->set_rules('menu', 'menu order', 'required');
	$this->form_validation->set_rules('cms_status', 'cms_status', 'required');
	$this->form_validation->set_rules('cms_menu', 'cms_menu', 'required');
	if ($this->form_validation->run() == FALSE) {
	    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
	    redirect(base_url() . 'siteadmin/cms/', 'refresh');
	} else {
	    $cms_data = array(
		'cms_title' => $this->input->post('title'),
		'cms_url' => $this->input->post('url'),
		'cms_description' => $this->input->post('descr'),
		'cms_status' => $this->input->post('cms_status'),
		'cms_menu' => $this->input->post('cms_menu'),
		'cms_menu_order' => $this->input->post('menu')
	    );
	    $result = $this->cms_model->update_cms($id, $cms_data);
	    if ($result) {

		$this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ' . $cms_data['cms_title'] . ' updated successfully </div>');
		redirect(base_url() . 'siteadmin/cms', 'refresh');
	    } else {
		$this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Nothing Updated</div>');
		redirect(base_url() . 'siteadmin/cms', 'refresh');
	    }
	}
    }

    public function add_cms() {
	$data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
	$data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
	$data['title'] = 'CMS ADD';
	$this->load->view('header', $data);
	$this->load->view('cms/cms_add', $data);
	$this->load->view('footer');
    }

    public function cms_add_process() {
	$this->form_validation->set_rules('title', 'cms_title', 'required');
	$this->form_validation->set_rules('url', 'cms_url', 'required');
	$this->form_validation->set_rules('descr', 'cms_description', 'required');
	$this->form_validation->set_rules('menu', 'menu order', 'required');
	$this->form_validation->set_rules('cms_status', 'cms_status', 'required');
	$this->form_validation->set_rules('cms_menu', 'cms_menu', 'required');
	if ($this->form_validation->run() == FALSE) {
	    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
	    redirect(base_url() . 'siteadmin/cms/', 'refresh');
	} else {
	    $cms_data = array(
		'cms_title' => $this->input->post('title'),
		'cms_url' => $this->input->post('url'),
		'cms_description' => $this->input->post('descr'),
		'cms_status' => $this->input->post('cms_status'),
		'cms_menu' => $this->input->post('cms_menu'),
		'cms_menu_order' => $this->input->post('menu')
	    );
	    $result = $this->cms_model->add_cms($cms_data);
	    if ($result) {

		$this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ' . $cms_data['cms_title'] . ' updated successfully </div>');
		redirect(base_url() . 'siteadmin/cms', 'refresh');
	    } else {
		$this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Nothing Updated</div>');
		redirect(base_url() . 'siteadmin/cms', 'refresh');
	    }
	}
    }

    public function cms_pdf_add_process() {
	$this->form_validation->set_rules('title', 'cms_title', 'required');
	$this->form_validation->set_rules('url', 'cms_url', 'required');
	$this->form_validation->set_rules('descr', 'cms_description', 'required');
	$this->form_validation->set_rules('menu', 'menu order', 'required');
	$this->form_validation->set_rules('cms_status', 'cms_status', 'required');
	$this->form_validation->set_rules('cms_menu', 'cms_menu', 'required');
//	$this->form_validation->set_rules('cms_file_title', 'File Title', 'required');
//	$this->form_validation->set_rules('cms_file_date', 'File Date', 'required');
	if ($this->form_validation->run() == FALSE) {
	    $this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button><small>' . validation_errors() . '</small></div>');
	    redirect(base_url() . 'siteadmin/cms/', 'refresh');
	} else {
	    if (!empty($_FILES['userFiles']['name'])) {
		$total = count($_FILES['userFiles']['name']);
		for ($i = 0; $i < $total; $i++) {
		    $uniqid = uniqid();
		    $_FILES['userFile']['name'] = $this->input->post('url') . "_" . $uniqid . "_" .  preg_replace('/[^A-Za-z0-9\.]/', '-', $_FILES['userFiles']['name'][$i]);
		   // $_FILES['userFile']['name'] = $this->input->post('url') . "_" . $uniqid . "_" . $_FILES['userFiles']['name'][$i];
		    $_FILES['userFile']['type'] = $_FILES['userFiles']['type'][$i];
		    $_FILES['userFile']['tmp_name'] = $_FILES['userFiles']['tmp_name'][$i];
		    $_FILES['userFile']['error'] = $_FILES['userFiles']['error'][$i];
		    $_FILES['userFile']['size'] = $_FILES['userFiles']['size'][$i];
		    $data["db_file_name"][$i] = $this->input->post('url') . "_" . $uniqid . "_" .  preg_replace('/[^A-Za-z0-9\.]/', '-', $_FILES['userFiles']['name'][$i]);
		    $data["db_file_title"][$i] = $_FILES['userFiles']['name'][$i];
		    $uploadPath = './assets/pdf_details/';
		    $config['upload_path'] = $uploadPath;
		    $config['allowed_types'] = 'jpg|jpeg|png|doc|docx|txt|pdf';

		    $this->load->library('upload', $config);
		    $this->upload->initialize($config);
		    if (!$this->upload->do_upload('userFile')) {

			$this->session->set_flashdata('add_cms_pdf_msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
 <small>' . $this->upload->display_errors() . '</small></div>');
			$this->session->set_userdata('pdf_msg', $_POST);
			redirect(base_url() . "siteadmin/cms/add_cms_pdf", 'refresh');
			die;
		    } else {
			$userfile = $this->upload->data();
		    }
		}//for loop end
	    }
	    $cms_file = implode(",", $data['db_file_name']);
	    $cms_file_title = implode(",", $data['db_file_title']);
	    $cms_data = array(
		'cms_title' => $this->input->post('title'),
		'cms_url' => $this->input->post('url'),
		'cms_description' => $this->input->post('descr'),
		'cms_file' => $cms_file,
		'cms_status' => $this->input->post('cms_status'),
		'cms_file_title' => $cms_file_title,
		'cms_menu' => $this->input->post('cms_menu'),
		'cms_menu_order' => $this->input->post('menu')
	    );
	    $result = $this->cms_model->cms_pdf_add_process($cms_data);
	    if ($result) {

		$this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-success"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button> ' . $cms_data['cms_title'] . ' updated successfully </div>');
		redirect(base_url() . 'siteadmin/cms/list_cms_pdf', 'refresh');
	    } else {
		$this->session->set_flashdata('msg', '<div class="alert alert-dismissable alert-danger"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>Nothing Updated</div>');
		redirect(base_url() . 'siteadmin/cms/list_cms_pdf', 'refresh');
	    }
	}
    }

    public function add_cms_pdf() {
	$data['stylesheets'][] = 'admin/CLEditor/jquery.cleditor.css';
	$data['javascripts'][] = 'admin/CLEditor/jquery.cleditor.min.js';
	$data['title'] = 'CMS ADD';
	$this->load->view('header', $data);
	$this->load->view('cms/addcms_pdf', $data);
	$this->load->view('footer');
    }

    public function list_cms_pdf() {
	$data['title'] = "CMS";
	$data['cms'] = $this->cms_model->list_cms_pdf();
	$this->load->view('header', $data);
	$this->load->view('cms/cms_list_pdf', $data);
	$this->load->view('footer');
    }

    public function delete_img($id) {
	if (!empty($_POST['img']) && !empty($id)) {

	    $del_stat = $this->cms_model->delete_img($id, $_POST['img']);
	    $path = './assets/pdf_details/' . $_POST['img'];
	    if ($del_stat) {
		unlink($path);
		echo "success";
	    } else {
		echo "failure";
	    }
	}
    }

}
