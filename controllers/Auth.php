<?php

defined('BASEPATH') OR exit('No direct script access allowed');


class Auth extends CI_Controller {

	public function __construct(){
		
		parent::__construct();

		$this->load->model('Auth_Model');
	}

	public function home(){

		// print_r($_GET);
		if(isset($_GET['Action'])){
		if($_GET['Action'] == "edit"){


			$dataArr = $this->Auth_Model->getData($_GET);

			// print_r($dataArr);die;
			 
			$this->load->view('home',['data'=>$dataArr]);			
			}
		}
		else{ 
			$this->load->view('home');	
		}
		
		 
	}

	public function delete(){
		$delete = $this->Auth_Model->delete($_GET['id']);
		if($delete > 0){
			redirect('auth/home');
		}

	}

	public function login(){ 
 		
 		// print_r(_POST);
		if(isset($_GET['Action']) == 'logout'){

			session_unset();
			session_destroy();
		}
		 // print_r($_POST);die;
		 if(isset($_POST['login'])){ 

			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required');

			if($this->form_validation->run() == TRUE){
					$login = $this->Auth_Model->doLogin($_POST);

					if($login > 0){ 
						redirect('auth/home');
						
					}else{
						redirect("auth/login");
					}
			}
		}

		$this->load->view('login');
	}
	public function register(){
		// print_r($_POST);die;
		if(isset($_POST['register'])){
			$this->form_validation->set_rules('username','Username','required');
			$this->form_validation->set_rules('email','Email','required');
			$this->form_validation->set_rules('password','Password','required|min_length[6]');
			

			// $this->form_validation->set_rules('password2','Confirm password','required|min_length[6]|matches[password]');

			if($this->form_validation->run() == TRUE){

				$insert = $this->Auth_Model->insertUser($_POST);
				if($insert > 0){
					redirect("auth/register");
				}
			}
		}
		$this->load->view('register');
	}

	public function profile(){
		// print_r($_POST);die;

		$this->form_validation->set_rules('name','Name','required');
		$this->form_validation->set_rules('email','Email','required');


		if($this->form_validation->run() == TRUE){

			$data = [
				 	'name' => $_POST['name'],
				 	'email' => $_POST['email'],
				 	'phone' => $_POST['phone'], 
				 ];

				 	if($_POST['submit'] == "update"){
				 			$up = $this->Auth_Model->doUpdate($_POST);

				 			 if($up > 0){
				 	redirect('auth/profile');
				 }
				 	}
				 	else{
				 		$ins = $this->Auth_Model->do_insert($data);

				 if($ins > 0){
				 	redirect('auth/profile');
				 }
				 	}
				 
		}
		else{
			redirect('auth/home');
		}
		// if(!empty($_FILES['picture']['name']))
		// {
				// $config['upload_path'] = './upload';
				// $config['allowed_type'] = 'jpg|jpeg|png|gif';
				// $config['file_name'] = $_FILES['picture']['name'];

				// $this->load->library('upload',$config);
				// $this->upload->initialize($config);

				// $this->upload->do_upload('picture');

				// $uploadData = $this->upload->data();

				// $picture = $uploadData['file_name']; 

				//  $data = [
				//  	'name' => $_POST['name'],
				//  	'email' => $_POST['email'],
				//  	'phone' => $_POST['phone'],
				//  	'picture' => $picture,
				//  ];
				//  $ins = "";
				
		// }
		// else{

		// 	echo 'image not uploaded..';


		// 	// $this->session->set_flashdata('image_error','image not uploaded..');
		// 	// $this->load->view('home');
		// }
	}

	// public function edit(){
	// 	print_r('ok');die;
	// }
	
}
