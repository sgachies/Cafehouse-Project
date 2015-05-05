
<?php

	//my number ->0726371675 
	//sendSMS($phoneNumber,$response);
	//Issues
	//Sending message of invalid entry in the if else statement when user selects wrong entry.
	//functions parameter phone number not accessible therefore improvise echo $phoneNumber="0723401197";
	//register user
				
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
		//end — Set the internal pointer of an array to its last element
		$response = firstMenuSwitch(end($exploded_text));
	break;
	case 2:
		$response = secondMenuSwitch($phoneNumber,$exploded_text);
	break;
	case 3:
		$response = ThirdMenuSwitch($phoneNumber,$exploded_text);
		//sendSMS($phoneNumber,$response);
		echo "END ".$response;
		exit;
	break;
	case 4:
		$response = FourthMenuSwitch($exploded_text);
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
			$response = "Enter ID Number to verify your activation";
		break;
		case 2:
			$response = "\n-Menu List-\n1.Coffee" . PHP_EOL . "2.Organic Tea".  PHP_EOL . "3.Cakes list";
		break;
		case 3:
			$response = "\n-Loyalty Points-\n1.View my Points" . PHP_EOL . "2.Get instruction to get started";
		
		break;
		case 4:
			$response="\n-Our Cafe Outlets-\n1.Nakumatt Lifestyle Cafe shop\n2.Thika Tuskies Mall Cafe shop\n3.TRM Mall Cafe shop\n-Conacts us-\nMobile: 254723401197\nOffice: 0625446789";
			//echo $phoneNumber="0723401197";
			//sendSMS($phoneNumber,$response);
			echo "END ".$response;
			exit;
		break;
		default:
			$response = getHomeMenu();
		break;
		}
		return $response;
	}
	
	//SECOND MENU SWITCH FUNCTION 	
	function secondMenuSwitch($phoneNumber,$exploded_text){
		switch (trim(strtolower($exploded_text[0]))) {
		case 1:
	    
			$response = verifyUser($phoneNumber,$exploded_text);
			echo "END ".$response;
			exit;
			
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
			if($exploded_text[1] == 1){
			//Check your points
			$response = checkPoints($phoneNumber);
			echo "END ".$response;
			exit;
			
			}else if($exploded_text[1] == 2){
			$response = "-Loyalty Points-\nUsing this service will earn you points.Register by sending FULL_NAME*ID to 1234.\nN.B you will be charged ksh.3.00 only.Thank you.";
			//sendSMS($phoneNumber,$response);
			echo "END ".$response;
			exit;
			}else{
			$response = "Invalid entry select 1 to view points or 2 to get instructions";
			
			}
			
		
			
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
			
		break;
		case 2:
			if($exploded_text[2] == 1){
				$response = "\nThank you for selecting Cafe Mocha.\nPrice is ksh.150.00\nPay the amount through Pay Bill No. 122000 A/c No. is 11";
			}else if($exploded_text[2] == 2){
				$response = "\nThank you for selecting Caffe Latte.\nPrice is ksh.180.00\nPay the amount through Pay Bill No. 122000 A/c No. is 22";
			}else if($exploded_text[2] == 3){
				$response = "\nThank you for selecting Coffee Milk.\nPrice is ksh.230.00\nPay the amount through Pay Bill No. 122000 A/c No. is 33";
			}else if($exploded_text[2] == 4){
				$response = "\nThank you for selecting Americano.\nPrice is ksh.150.00\nPay the amount through Pay Bill No. 122000 A/c No. is 44";
			}else if($exploded_text[2] == 5){
				$response = "\nThank you for selecting Black Tea.\nPrice is ksh.210.00\nPay the amount through Pay Bill No. 122000 A/c No. is 55";
			}else if($exploded_text[2] == 6){
				$response = "\nThank you for selecting White Tea.\nPrice is ksh.110.00\nPay the amount through Pay Bill No. 122000 A/c No. is 66";
			}else if($exploded_text[2] == 7){
				$response = "\nThank you for selecting Green Tea.\nPrice is ksh.100.00\nPay the amount through Pay Bill No. 122000 A/c No. is 77";
			}else if($exploded_text[2] == 8){
				$response = "\nThank you for selecting Rice Cake.\nPrice is ksh.100.00 (1/4) piece\nPay the amount through Pay Bill No. 122000 A/c No. is 77";
			}else if($exploded_text[2] == 9){
				$response = "\nThank you for selecting White Cake.\nPrice is ksh.100.00 (1/4) piece\nPay the amount through Pay Bill No. 122000 A/c No. is 77";
			}else{
				$response = "\nInvalid Entry." . PHP_EOL . getHomeMenu();
			}
		
			break;
			case 3:
				
			break;
			default:
			
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
		//CHECK FOR POINTS
		function checkPoints($phoneNumber){
				  $query = mysql_query("SELECT points FROM user_points WHERE phone_number='$phoneNumber' ");
					while($rows = mysql_fetch_array($query)){;	
					$points_array = array($rows['points']);
					$points=array_sum($points_array);
					 $count+=$points;	
				}
					//1 Point = ksh 3 each transaction will earn a user ksh.3.00 for any product bought using Mpesa
				   $amount= $count*2;
					return $response = "You have $count points in your account worth ksh.$amount.00\nYou can reedem them at our outlets to get free beverages and meals";
				  
		}
		   
		//VERIFY NEW USER
		function verifyUser($phoneNumber,$exploded_text){
	        $national_id = $exploded_text[1];
		    $query = mysql_query("SELECT * FROM users WHERE phone_number='$phoneNumber' AND national_id='$national_id'");			
				$rows = mysql_fetch_array($query);
				$name = $rows['full_name'];
				if(mysql_num_rows($query)> 0){
				return $response= $name. " You are already registered to this service";
				}else{
			    //If doesnot exist send an sms
				return $response = "This service is not activated on your phone.You shall recieve a text message on how to register";
				}
		   }
			
			
		
		  
		//SEND SMS FUNCTION USING AFRICA'S TALKING API
		function sendSMS($recipients,$msg){
		//require_once('AfricasTalkingGateway.php');
		$username = "";
		$apikey = "";
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
