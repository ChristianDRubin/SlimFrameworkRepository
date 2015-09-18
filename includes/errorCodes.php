<?php
	
	class errorCode {
    	//error codes
    	public static $userExists = "El usuario ya existe";
    	public static $userExistsCode = "ERROR_1";

		public static $email_not_registered = "This email is not registered";
		public static $email_not_registered_code = "ERROR_11";

    	//generic parameters missing codes
    	public static $generic_param_missing = 'Los siguientes parametros son obligatorios: ';
    	public static $generic_param_missing_code = 'ERROR_MISSING_PARAMS';
			
	}

?>