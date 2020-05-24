<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Product extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		$this->load->model('Product_Model');
		$this->load->model('Category_Model');
	}

	public function index(){
 
		$productArr = [];
		if(@$_GET['category_id'] != ""){
				$productArr = $this->Product_Model->getProduct($_GET['category_id']); 

		}

		$rows = $this->Category_Model->getCategory();

// $data = $this->Category_Model->builtTree($rows);

		if(isset($_POST)){
				if(@$_POST['submit'] == 'product' ){
				$data = [];
				$data['category_id'] = $_POST['category_id'];
				$data['product_name'] = $_POST['product_name'];

				$ins = $this->Product_Model->insert($data);

		}
		   

		$this->load->view('product',['categoryArr'=>$rows,'productArr'=>$productArr]);
	
		
		}
	}
}
