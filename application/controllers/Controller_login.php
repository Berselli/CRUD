<?php
	defined('BASEPATH') OR exit('No direct script access allowed');
	
	class Controller_login extends CI_Controller {

		#region contruct
		public function __construct()
		{
            parent::__construct();            
            
		}
		#endregion

		#region user login
		public function user_login(){

			$this->load->model('data_base');

			$objDataBase = new Data_base();

			$objDataBase -> open();

			$user_name = $this->input->post('user_name');
			$user_password = $this->input->post('user_password');

			$valueReturn = $objDataBase -> checkPassword($user_name, $user_password);

			$objDataBase -> close();
			
			if($valueReturn[0]){

				if($valueReturn[1]){

					$this->session->set_userdata('user', $user_name);
					$this->session->set_userdata('admin', true);

					//echo "eh admin!!!!";

					//INCLUDE_ONCE("../connection_close.php");
					//header("location:/dark/index.php");
				}
				else{
					$this->session->set_userdata('user', $user_name);

					//echo "não é admin!!!!";

					//INCLUDE_ONCE("../connection_close.php");
					//header("location:/dark/index.php");	
				}
					
			}

			//echo "index voltou !!!!";

			$this -> index();
		}
		#endregion

		#region user singup
		public function user_singup(){

			$this->load->model('data_base');

			$user_name = $this->input->post('user_name');
			$user_password = $this->input->post('user_password');
			$user_email = $this->input->post('user_email');

			$objDataBase = new Data_base();

			$objDataBase -> open();

			$valueReturn = $objDataBase -> createNewUser($user_name, $user_password, $user_email);
			$objDataBase -> close();
			if($valueReturn == 1){
				$this -> user_login();
			} else {
				$this -> index();
			}			
		}
		#endregion

		#region index
		public function index()	{
			if(!empty($this->session->userdata('user')))
			{ 
				$this -> home();								
			}else{
				$data['page_title'] = 'Log in';				
				$this->load->view('form_login',$data);
			}		
			
		}
		#endregion

		#region home
		public function home(){
			
			if(!empty($this->session->userdata('user'))){
				$data['page_title'] = 'Home';
				$this->load->view('form_header', $data);
				$this->load->view('form_home');
			} else{
				$this->index();
			}
			
		}
		#endregion

		#region car table
		public function car_table(){

			if(!empty($this->session->userdata('user'))){
				$this->load->model('data_base');

				$objDataBase = new Data_base();

				$objDataBase -> open();

				$valueReturn = $objDataBase -> getCars();

				$data['page_title'] = 'Car Table';
				$data['car_array'] = $valueReturn;
				$this->load->view('form_header', $data);
				$this->load->view('form_car_table');

			} else{
				$this->index();
			}			
		}
		#endregion

		#region user logout
		public function user_logout(){
			$this->session->unset_userdata('user');
			$this->session->sess_destroy();
			$this->index();
		}
		#endregion

		#region register car
		public function register_car(){

			$this->load->model('data_base');

			$objDataBase = new Data_base();

			$objDataBase -> open();

			$car_model = $this->input->post('car_model');
			$car_year = $this->input->post('car_year');
			$car_plate = $this->input->post('car_plate');
			$car_color = $this->input->post('car_color');

			if(is_null($car_model) || is_null($car_year) || is_null($car_plate) || is_null($car_color ) 
			|| $car_model === '' || $car_year === '' || $car_plate === '' || $car_color === ''){
				$this->index();
			}else{
				$valueReturn = $objDataBase -> createNewCar($car_model, $car_year, $car_plate, $car_color);
				$objDataBase -> close();
				if(!(is_null($valueReturn))){
					$this -> car_table();					
				} else {
					$this->home();
				}	
			}
		}
		#endregion

		#region delete car
		public function delete_car(){

			$car_id = $this->input->post('column_1');

			$this->load->model('data_base');

			$objDataBase = new Data_base();

			$objDataBase -> open();

			$valueReturn = $objDataBase -> deleteCar($car_id);

			$this->car_table();
		}
		#endregion

		#region update car form
		public function update_car_form(){

			$car_id = $this->input->post('column_1');
			$car_model = $this->input->post('column_2');
			$car_year = $this->input->post('column_3');
			$car_plate = $this->input->post('column_4');
			$car_color = $this->input->post('column_5');

			if(is_null($car_model) || is_null($car_year) || is_null($car_plate) || is_null($car_color ) || is_null($car_id) 
			|| $car_model === '' || $car_year === '' || $car_plate === '' || $car_color === '' || $car_id === ''){
				$this->index();
			}else{
				$carData = array();
				$carData[] = $car_id;
				$carData[] = $car_model;
				$carData[] = $car_year;
				$carData[] = $car_plate;
				$carData[] = $car_color;

				$data['page_title'] = 'Car Table';
				$data['car_data'] = $carData;
				$this->load->view('form_header', $data);
				$this->load->view('form_update');
			}
		}
		#endregion

		#region update car
		public function update_car(){

			$car_id = $this->input->post('car_id');
			$car_model = $this->input->post('car_model');
			$car_year = $this->input->post('car_year');
			$car_plate = $this->input->post('car_plate');
			$car_color = $this->input->post('car_color');

			if(is_null($car_model) || is_null($car_year) || is_null($car_plate) || is_null($car_color ) || is_null($car_id) 
			|| $car_model === '' || $car_year === '' || $car_plate === '' || $car_color === '' || $car_id === ''){
				$this->index();
			}else{
				$this->load->model('data_base');

				$objDataBase = new Data_base();

				$objDataBase -> open();

				$valueReturn = $objDataBase -> updateCar($car_id, $car_model, $car_year, $car_plate, $car_color);

				$this->car_table();
			}
		}
		#endregion
	}
	
	
?>