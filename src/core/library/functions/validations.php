<?php

$errors= array();
//* presence

function field_as_text($fieldname) {
	$fieldname =str_replace("_", " ", $fieldname);
	$fieldname = ucfirst($fieldname);
	return $fieldname;
}

function has_presence($value){
	return isset($value) && $value!== "";
}

function validate_presences($required_fields){
	$errors = array();
	foreach ($required_fields as $field) {
		$value = trim($_POST[$field]);
		if(!has_presence($value)) {
			$errors[$field] = field_as_text($field) . " can not be blank";
		}
	}
	return $errors;
}
//*string length
//*max len

function has_max_length($value,$max) {
	return strlen($value)<=$max;
}

function validate_max_length($fields_with_max_lengths) {
	$errors = array();
	//$fields_with_max_length =array("username"=>30,"password"=>8);
	foreach ($fields_with_max_lengths as $field => $max) {
		$value = trim($_POST[$field]);
		if (!has_max_length($value,$max)) {
			$errors[$field] = field_as_text($field). " need to be  less than" . $max . " characters";
		}
	}
	return $errors;
}

function has_min_length($value,$min) {
	return strlen($value)>=$min;
}

function validate_min_length($fields_with_min_lengths) {
	$errors = array();
	//$fields_with_max_length =array("username"=>30,"password"=>8);
	foreach ($fields_with_min_lengths as $field => $min) {
		$value = trim($_POST[$field]);
		if (!has_min_length($value,$min)) {
			$errors[$field] = field_as_text($field). " need to be " . $min . " characters or longer";
		}
	}
	return $errors;
}

//* inclusion in a set
function has_inclusion_in($value,$set){
	return in_array($value,$set);
}

function validate($address){
	$decoded = decodeBase58($address);

	$d1 = hash("sha256", substr($decoded,0,21), true);
	$d2 = hash("sha256", $d1, true);

	if(substr_compare($decoded, $d2, 21, 4)){
		// throw new \Exception("bad digest");
		$ret = FALSE;
	}else{
		$ret = TRUE;
	}

	return $ret;
}

function is_valid_username($username){
  // accepted username length between 5 and 20
  if (preg_match('/^\w{5,20}$/', $username)){
    return true;
  } else{
    return false;
  }
}

function is_valid_password($pwd){
  // accepted password length between 5 and 20, start with character.
  if (preg_match("/^[a-zA-Z][0-9a-zA-Z_!$@#^&]{7,255}$/", $pwd)){
    return true;
  } else {
    return false;
  }
}

function is_valid_date($date){
  //============ date format dd-mm-yyyy
  if(preg_match("/^(\d{2})-(\d{2})-(\d{4})$/", $date, $sdate)){
    if(checkdate($sdate[2], $sdate[1], $sdate[3])) {
      return true;
    }
  }else {
    return false;
  }
}

function decodeBase58($input) {
	$alphabet = ALP_NUMERICAL;

	$out = array_fill(0, 25, 0);
	for($i=0;$i<strlen($input);$i++){
		if(($p=strpos($alphabet, $input[$i]))===false){
			throw new \Exception("invalid character found");
		}
		$c = $p;
		for ($j = 25; $j--; ) {
			$c += (int)(58 * $out[$j]);
			$out[$j] = (int)($c % 256);
			$c /= 256;
			$c = (int)$c;
		}
		if($c != 0){
			throw new \Exception("address too long");
		}
	}

	$result = "";
	foreach($out as $val){
		$result .= chr($val);
	}

	return $result;
}


?>
