<?php
	
	function validate($input,$rules){
		$Validator = Validator::make($input,$rules);

		if($Validator->fails()){
			throw new SimpleValidationException($Validator->messages()->all());
		}
	}
?>