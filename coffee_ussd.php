<?php
				
	include('connect.php');
	include('AfricasTalkingGateway.php');
	$sessionId   =   $_REQUEST["sessionId"];
	$serviceCode =   $_REQUEST["serviceCode"];
	$phoneNumber =   $_REQUEST["phoneNumber"];
	$text        =   $_REQUEST["text"];
	

	
	//EXPLODE TEXT STRINGS 
	if(!empty($text)){
		$exploded_text = explode("*", $text);
		$level = count($exploded_text);
	}else{
		$level = 0;
	}

	
	//SWITCH MENU LISTS
	switch (trim(strtolower($level))) {
	case 0:
		$response = getHomeMenu();
	break;
	case 1:
		$response = firstMenuSwitch(end($exploded_text));
	break;
	case 2:
		$response = secondMenuSwitch($exploded_text);
	break;
	case 3:
		$response = ThirdMenuSwitch($phoneNumber,$exploded_text);
		//sendSMS($phoneNumber,$response);
		echo "END ".$response;
		exit;
	break;
	case 4:
		$response = FourthMenuSwitch($phoneNumber,$exploded_text);
		sendSMS($phoneNumber,$response);
		echo "END ".$response;
		exit;
	break;
	default:
		$response = "Invalid entry";
	break;
	}
	
	
	header('Content-type: text/plain');
	echo "CON ".$response;
	exit;
	

	
	//HOME MENU FUNCTION
	function getHomeMenu(){
	$response = "\n*Welcome to Cafe House*".PHP_EOL."1.Verify registration".PHP_EOL."2.Cafe Menu List".PHP_EOL."3.Reedem Loyalty Point".PHP_EOL."4.Check Outlets";
	return $response;
	}
	
	
	//FIRST MENU SWITCH FUNCTION 
	function firstMenuSwitch($choice){
		switch (trim(strtolower($choice))) {
		case 1:
			$response = "Enter ID Number";
		break;
		case 2:
			$response = "\n-Menu List-\n1.Coffee" . PHP_EOL . "2.Organic Tea".  PHP_EOL . "3.Cakes list";
		break;
		case 3:
			$response = "Using our this service will earn your points and rewards send you full name*id to 45245 and you will automatically get started\nN.B This will charge you ksh.3 only\nThank you.";
		break;
		case 4:
			$response="Our Cafe Outlets \n1.Nakumatt Lifestyle Cafe shop\n2.Thika Tuskies Mall Cafe shop\n3.TRM Mall Cafe shop\nMobile: 254723401197\nOffice: 0625446789";
		break;
	
		default:
			$response = getHomeMenu();
		break;
		}
		return $response;
	}
	
	//SECOND MENU SWITCH FUNCTION 	
	function secondMenuSwitch($exploded_text){
		switch (trim(strtolower($exploded_text[0]))) {
		case 1:
			$response = "Enter first name";
		break;
		case 2:
			if($exploded_text[1] == 1){
			$response = "\n-Coffee List-\n1.Cafe Mocha" . PHP_EOL . "2.Caffe Latte". PHP_EOL . "3.Coffee milk". PHP_EOL . "4.Americano";
			}else if($exploded_text[1] == 2){
			$response = "\n-Coffee List-\n5.Black Tea" . PHP_EOL . "6.White Tea". PHP_EOL . "7.Green Tea";
			}else if($exploded_text[1] == 3){
			$response = "\n-Coffee List-\n8.Rice Cake" . PHP_EOL . "9.White Cakes";
			}else{
			$response = "Invalid entry";
			}
		break;
		case 3:
			$response = "Thanks for your feedback";
		break;
		default:
			$response = "Invalid Entry2.". PHP_EOL . getHomeMenu();
		break;
		}
		return $response;
	}
	
	//THIRD MENU SWITCH FUNCTION 	
	function ThirdMenuSwitch($phoneNumber,$exploded_text){
		switch (trim(strtolower($exploded_text[0]))) {
		case 1:
			$response = "Enter last name";
		break;
		case 2:
			if($exploded_text[2] == 1){
				$response = "Thank you for selecting Cafe Mocha\nPrice is ksh.150.00\nPay the amount through Pay Bill No. 122000 A/c No. is 11";
			}else if($exploded_text[2] == 2){
				$response = "Thank you for selecting Caffe Latte\nPrice is ksh.180.00\nPay the amount through Pay Bill No. 122000 A/c No. is 22";
			}else if($exploded_text[2] == 3){
				$response = "Thank you for selecting Coffee Milk\nPrice is ksh.230.00\nPay the amount through Pay Bill No. 122000 A/c No. is 33";
			}else if($exploded_text[2] == 4){
				$response = "Thank you for selecting Americano\nPrice is ksh.150.00\nPay the amount through Pay Bill No. 122000 A/c No. is 44";
			}else if($exploded_text[2] == 5){
				$response = "Thank you for selecting Black Tea\nPrice is ksh.210.00\nPay the amount through Pay Bill No. 122000 A/c No. is 55";
			}else if($exploded_text[2] == 6){
				$response = "Thank you for selecting White Tea\nPrice is ksh.110.00\nPay the amount through Pay Bill No. 122000 A/c No. is 66";
			}else if($exploded_text[2] == 7){
				$response = "Thank you for selecting Green Tea\nPrice is ksh.100.00\nPay the amount through Pay Bill No. 122000 A/c No. is 77";
			}else if($exploded_text[2] == 8){
				$response = "Thank you for selecting Rice Cake \nPrice is ksh.100.00 1/4 piece\nPay the amount through Pay Bill No. 122000 A/c No. is 77";
			}else if($exploded_text[2] == 9){
				$response = "Thank you for selecting White Cake \nPrice is ksh.100.00 1/4 piece\nPay the amount through Pay Bill No. 122000 A/c No. is 77";
			}else{
				$response = "\nInvalid Entry." . PHP_EOL . getHomeMenu();
			}
			
			break;
			case 3:
				$response = "END Thanks for your feedback";
			break;
			default:
				$response = "\nInvalid Entry default." . PHP_EOL . getHomeMenu();
			break;
			}
			return $response;
		}
		
		//FOURTH MENU SWITCH FUNCTION 	
		function FourthMenuSwitch($phoneNumber,$exploded_text){
			switch (trim(strtolower($exploded_text[0]))) {
			case 1:
				$response = registerUser($phoneNumber,$exploded_text);
				sendSMS($phoneNumber,$response);
			break;
			case 2:
				//validate whether it is 1 or 2
			break;
			case 3:
				$response = "Thanks for your feedback";
			break;
			default:
				$response = "\nInvalid Entry default." . PHP_EOL . getHomeMenu();
			break;
			}
			return $response;
		}
	
		
		
		//lOG REQUEST USSD_LOG FUNCTION
		logRequest($phoneNumber,$text);
		function logRequest($phone,$text){
		if(!empty($text)){
		$result = mysql_query("INSERT INTO ussd_logs (phone,text) VALUES ('$phone','$text')");
		return $result;
		}
		}
		
		//REGISTER NEW USER
		function registerUser($phone,$exploded_text){
		$national_id = $exploded[1];
		$first_name = $exploded[2];
		$last_name = $exploded[3];
		//check if the user exists
		$query = mysql_query("SELECT * FROM users WHERE phone='$phone'");
		if(mysql_num_rows($query)> 0){
		return "You are already registered";
		}else{
		//create the user
		$result = mysql_query("INSERT INTO users (phone,national_id,first_name,last_name,) VALUES ('$phone','$national_id','$first_name','$last_name')");
		if($result){
		$reply = "You are registered successfully.";
		return $reply;
		}
		// return $query;
		}
		}
		
		//SEND SMS FUNCTION USING AFRICA'S TALKING API
		function sendSMS($recipients,$msg){
		//require_once('AfricasTalkingGateway.php');
		$username = "stevebab";
		$apikey = "c8933dc169561310819188ca7d69db1a7a967a05bd3c952bad081ea3f71a5ce8";
		//$recipients = "0723401197";
		$message = $msg;
		// Create a new instance of our awesome gateway class
		$gateway = new AfricasTalkingGateway($username, $apikey);
		try{
		// Thats it, hit send and we'll take care of the rest.
		$results = $gateway->sendMessage($recipients, $message,$from);
		foreach($results as $result) {
		}
		}
		catch ( AfricasTalkingGatewayException $e )
		{
		echo "Encountered an error while sending: ".$e->getMessage();
		}
		}



?>
