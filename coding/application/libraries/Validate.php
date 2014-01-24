<?php

	class Validate{

		public $CI;
		
		function Validate(){
			$this->CI =& get_instance();
		}
		
		function validateUsername($Username){
			if (!preg_match('/^[A-Za-z0-9_]{4,100}$/', $Username)) return 1;
			else return 0;
		}
		
		function validatePassword($Password){
			if (!preg_match('/^[A-Za-z0-9!@#$%^&*()_]{6,20}$/', $Password)) return 1;
			else return 0;
		}
			
		function validateName($Name){
			if (!preg_match('/^[A-Za-z0-9 ]{4,100}$/', $Name)) return 1;
			else return 0;
		}
		
		function validateEmail($Email){
			if (!preg_match('/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i', $Email)) return 1;
			else return 0;
		}
		
		function valid_url($str){

           $pattern = "/^(http|https|ftp):\/\/([A-Z0-9][A-Z0-9_-]*(?:\.[A-Z0-9][A-Z0-9_-]*)+):?(\d+)?\/?/i";
            if (!preg_match($pattern, $str))
            {
                return FALSE;
            }

            return TRUE;
	    }
		
	}

?>