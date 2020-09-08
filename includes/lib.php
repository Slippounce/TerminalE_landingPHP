<?php

function clearStr($data){
    global $link;
    $data = trim(strip_tags($data));
    return mysqli_real_escape_string($link, $data);
}	
function clearInt($data){
    return abs((int)$data);
}

function send404(){
    header("Location: 404.php");
    exit();
}

function isPhoneAlreadyUsed($phone){
	global $link;
	$sql = "select phone from clients where phone = '$phone'";
	if(!$result = mysqli_query($link, $sql)){
        return false;
    }
    $items = mysqli_fetch_all($result, MYSQLI_ASSOC);
	If(empty($items)){
		return false;
	}else{
		return true;
	}
}

function putClientInfoIntoDB($name, $phone, $promotype){
	global $link;
	if($promotype){
		$sql = "INSERT INTO clients (name, phone, promotype)  
		VALUES ('$name', '$phone','$promotype');";
	}else{
		$sql = "INSERT INTO `clients` (`name`, `phone`, `promotype`) VALUES ('$name', '$phone', NULL)";
	}
	return mysqli_query($link, $sql);
}