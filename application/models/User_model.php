<?php
    defined('BASEPATH') OR exit('No direct script access allowed');

    class User_model extends CI_Model
    {
        private $user_name;
        private $user_id;
        private $user_password;
        private $user_admin;

        
        public function __construct($var_id, $var_name, $var_password, $var_admin){
            parent::__construct();
            $this -> user_id = $var_id;
            $this -> user_name = $var_name;
            $this -> user_password = $var_password;
            $this -> user_admin = $var_admin;
        }

        public function getUserName(){
            return $this -> user_name;
        }

        public function getUserPasswor(){
            return $this -> user_password;
        }

        public function getUserId(){
            return $this -> user_id;
        }

        public function isAdmin(){
            return $this -> user_admin;
        }
        

    }
?>