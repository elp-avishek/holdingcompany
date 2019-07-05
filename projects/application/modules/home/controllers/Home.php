<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends MX_Controller {

    public function __construct() {

	parent::__construct();

	$this->load->model('home_model');

	$this->load->helper('url');

	$this->load->helper('form');

	$this->load->library('form_validation');

	$this->load->helper('date');

	$this->load->library('upload');

	$data = array();
    }

    public function index() {
	$data['menu'] = $this->home_model->get_menu();
	$data['cms_details'] = $this->home_model->get_cms_details(1);
	$this->load->view('header', $data);
	$this->load->view('index', $data);
	$this->load->view('footer');
    }

    public function details($id = "") {
	$data['menu'] = $this->home_model->get_menu();
	$data['cms_details'] = $this->home_model->get_cms_details($id);
	$this->load->view('header', $data);
	$this->load->view('details', $data);
	$this->load->view('footer');
    }

//    public function valuation($id="") {
//	$this->load->view('header');
//	$this->load->view('valuation');
//	$this->load->view('footer');
//    }
//    public function fundraising() {
//	$this->load->view('header');
//	$this->load->view('fundraising');
//	$this->load->view('footer');
//    }
//    public function investing() {
//	$this->load->view('header');
//	$this->load->view('investing');
//	$this->load->view('footer');
//    }
//    public function ma() {
//	$this->load->view('header');
//	$this->load->view('ma');
//	$this->load->view('footer');
//    }
//    public function advisory() {
//	$this->load->view('header');
//	$this->load->view('advisory');
//	$this->load->view('footer');
//    }
//    public function research() {
//	$this->load->view('header');
//	$this->load->view('research');
//	$this->load->view('footer');
//    }
//    public function partners() {
//	$this->load->view('header');
//	$this->load->view('partners');
//	$this->load->view('footer');
//    }
//    public function csr() {
//	$this->load->view('header');
//	$this->load->view('csr');
//	$this->load->view('footer');
//    }
//     public function aboutus() {
//	$this->load->view('header');
//	$this->load->view('aboutus');
//	$this->load->view('footer');
//    }
    public function contactus() {
	$data['menu'] = $this->home_model->get_menu();
	$this->load->view('header', $data);
	$this->load->view('contactus');
	$this->load->view('footer');
    }

    public function payment() {
	$data['menu'] = $this->home_model->get_menu();
	$data['cms_details'] = $this->home_model->get_cms_details(8);
	$this->load->view('header', $data);
	$this->load->view('secure_payment', $data);
	$this->load->view('footer');
    }

}
