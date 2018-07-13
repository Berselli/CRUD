<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class Data_base extends CI_Model{


        #region create new user
        public function createNewUser($user_name, $user_password, $user_email){
            if(is_null($user_name) || is_null($user_password) || is_null($user_email) || $user_name === '' || $user_password === '' || $user_email === ''){
                return null;
            }
            try{
                $data = array('user_name' => $user_name, 'user_password' => $user_password, 'user_email' => $user_email);
                $str = $this->db->insert('user', $data);
                return $str;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion

        #region check Password
        public function checkPassword($user_name, $user_password){

            if(is_null($user_name) || is_null($user_password)){
                return null;
            }

            $query =  $this->db->select('user_password,user_admin')->from('user')->where('user_password', $user_password)->where('user_name', $user_name)->get();
            $row = $query->row();
            $valueReturn = array();

            if (isset($row))
            {
                $user_password_return = $row->user_password;
                $user_admin_return = $row->user_admin;
                
                if($user_password == $user_password_return)
                {
                    $valueReturn[] = true;
                    if($user_admin_return == 1)
                    {
                        $valueReturn[] = true;
                    }
                    else
                    {
                        $valueReturn[] = false;
                    }					
                }
                else
                {
                    $valueReturn[] = false;
                }
                return $valueReturn;
            }
        }
        #endregion

        #region open connection
        public function open(){
            $this->load->database();
        }
        #endregion

        #region close connection
        public function close(){
            $this->db->close();
        }
        #endregion
        
        #region create new car
        public function createNewCar($car_model, $car_year, $car_plate, $car_color){
            if(is_null($car_model) || is_null($car_year) || is_null($car_plate) || is_null($car_color)){
                return null;
            }
            try{
                $data = array('car_model' => $car_model, 'car_year' => $car_year, 'car_plate' => $car_plate, 'car_color' => $car_color);
                $str = $this->db->insert('car', $data);
                return $str;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion

        #region get all car
        public function getCars(){
            try{
                $query =  $this->db->select('*')->from('car')->get();
                $valueReturn = array();
                $carReturn = array();
                if ($query)
                {
                    foreach ($query->result() as $row)
                    {
                        $car_id = $row->car_id;
                        $car_model = $row->car_model;
                        $car_year = $row->car_year;
                        $car_plate = $row->car_plate;
                        $car_color = $row->car_color;

                        $carReturn['car_id'] = $car_id;
                        $carReturn['car_model'] = $car_model;
                        $carReturn['car_year'] = $car_year;
                        $carReturn['car_plate'] = $car_plate;
                        $carReturn['car_color'] = $car_color;

                        $valueReturn[] = $carReturn;
                    }                    

                    return $valueReturn;
                }
                return null;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion
        
        #region delete car
        public function deleteCar($car_id){
            try{
                $this->db->where('car_id', $car_id);
                $this->db->delete('car');
                return true;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion

        #region update car
        public function updateCar($car_id, $car_model, $car_year, $car_plate, $car_color){
            try{
                $data = array(
                    'car_model' => $car_model,
                    'car_year' => $car_year,
                    'car_plate' => $car_plate,
                    'car_color' => $car_color
                );
                
                $this->db->where('car_id', $car_id);
                $this->db->update('car', $data);
                return true;
            }catch(Exception $e){
                return null;
            }
        }
        #endregion
    }