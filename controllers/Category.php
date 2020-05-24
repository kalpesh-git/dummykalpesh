<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Category extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		$this->load->model('Category_Model');
	}

	public function index(){
		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// die;
		if(isset($_POST)){
				if(@$_POST['submit'] == 'category' ){
				$data = [];
				$data['parent_category_id'] = $_POST['parent_category_id'];
				$data['Category_name'] = $_POST['Category_name'];

				if(!empty($_POST['Category_name'])){	
					$ins = $this->Category_Model->insert($data);
				}

		}
		

		$rows = $this->Category_Model->getCategory();

		// echo "<pre>";
		// print_r($rows);
		// echo "</pre>";
		// die;

		// 	$rows = [
		// 		[
		// 		'category_id'=>1,
		// 		'Category_name' => 'cat1',
		// 		'parent_category_id'=>0,	
		// 	],
		// 	[
		// 		'category_id'=>2,
		// 		'Category_name' => 'cat2',
		// 		'parent_category_id'=>0,
		// 	],
		// 	[
		// 		'category_id'=>3,
		// 		'Category_name' => 'cat3',
		// 		'parent_category_id'=>1,
		// 	],
		// 	[
		// 		'category_id'=>4,
		// 		'Category_name' => 'cat4',
		// 		'parent_category_id'=>3,
		// 	],
		// 	[
		// 		'category_id'=>5,
		// 		'Category_name' => 'cat5',
		// 		'parent_category_id'=>4,
		// 	],
		// 	[
		// 		'category_id'=>6,
		// 		'Category_name' => 'cat6',
		// 		'parent_category_id'=>1,
		// 	],

		// ];
		
	// echo "<pre>";
	// 	print_r($rows);
	// 	echo "</pre>";
	// 	die;
		if(!empty($rows)){
		$data = $this->Category_Model->builtTree($rows);
	}
	
 		
 		$categoryArr = [];
 		if(!empty($data)){
 			$categoryArr = $data;
 		}

		$arr = [
			'categoryArr'=>$categoryArr
		];
	

		$this->load->view('category',$arr);
	
		
		}
	}
}
