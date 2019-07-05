<?php (defined('BASEPATH')) OR exit('No direct script access allowed');

/** load the CI class for Modular Extensions **/
require dirname(__FILE__).'/Base.php';

/**
 * Modular Extensions - HMVC
 *
 * Adapted from the CodeIgniter Core Classes
 * @link	http://codeigniter.com
 *
 * Description:
 * This library replaces the CodeIgniter Controller class
 * and adds features allowing use of modules and the HMVC design pattern.
 *
 * Install this file as application/third_party/MX/Controller.php
 *
 * @copyright	Copyright (c) 2015 Wiredesignz
 * @version 	5.5
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 **/
class MX_Controller 
{
	public $autoload = array();
	public $orderstatus=array('success'=>'New','info'=>'Processing','active'=>'Delivered',
	                          'danger'=>'Canceled','success '=>'Paid','warning'=>'Awaiting payment');
							  
	public $admin_menu=array("cms"=>"cms","ingredients"=>"ingredients","type"=>"menutype","product"=>"menu","menu"=>"instant","diets"=>"diets",
	              "onlinestore"=>"onlinestore","location"=>"location","slot"=>"slot","customer"=>"customer","coupon"=>"coupon","minimumorder"=>"minimumorder","order"=>"order","point"=>"point","notification"=>"notification","onlinecategory"=>"onlinecategory");						  
	
	public function __construct() 
	{
		
		
		$class = str_replace(CI::$APP->config->item('controller_suffix'), '', get_class($this));
		log_message('debug', $class." MX_Controller Initialized");
		Modules::$registry[strtolower($class)] = $this;	
		
		/* copy a loader instance and initialize */
		$this->load = clone load_class('Loader');
		$this->load->initialize($this);	
		
		/* autoload module items */
		$this->load->_autoloader($this->autoload);
		//for limitation admin access
		$this->load->library('session');
		if($this->session->userdata('admin_permission')){
		$remove_menu=explode(",",($this->session->userdata('admin_permission')));
		in_array(strtolower(get_class($this)),$remove_menu)?show_404():"";
		}
		
	}
	
	public function __get($class) 
	{
		 
		return CI::$APP->$class;
	}
}