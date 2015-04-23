<?php
		//error_reporting(0);
		include('connect.php');
		include('AfricasTalkingGateway.php');
		
		$sessionId   = $_REQUEST["sessionId"];
		$serviceCode = $_REQUEST["serviceCode"];
		$phoneNumber = $_REQUEST["phoneNumber"];
		$text        = $_REQUEST["text"];
		
		//log request
		logRequest($phoneNumber,$text);

		if(!empty($text)){
			$exploded_text = explode("*", $text);
			$level = count($exploded_text);
		}else{
			$level = 0;
		}

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
				$response = ThirdMenuSwitch($exploded_text);
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
		
		function getHomeMenu(){
			$response = "*Welcome to Cafe House*".PHP_EOL."1.Register".PHP_EOL."2.Menu".PHP_EOL."3.Promo".PHP_EOL."4.Feedback".PHP_EOL."5.Outlets";
			return $response;
		}
		
		function firstMenuSwitch($choice){
			switch (trim(strtolower($choice))) {
				case 1:
					$response = "Enter ID Number";
					break;
				case 2:
					$response = "Coffee" . PHP_EOL . "Tea";
					break;
				case 3:
					$response = "We running a Promo Please send the Word Yes to get messages for next Promo";
					break;
				case 4:
					$response = "Enter Feedback";
				default:
					$response = PHP_EOL.getHomeMenu();
					break;
			}
			return $response;
		}
		
			function logRequest($phone,$text){
				$result = mysql_query("INSERT INTO ussd_logs (phone,text) VALUES ('$phone','$text')");
				return $result;
				
			}
					function secondMenuSwitch($exploded_text){
						switch (trim(strtolower($exploded_text[0]))) {
							case 1:
								$response = "Enter first name";
								break;
							case 2:
								//validate whether it is 1 or 2
								if($exploded_text[1] == A){
									$response = "Where are you";
								}elseif($exploded_text[1] == B){
									$response = "Where are they";
								}else{
									$response = "select 1 or 2";
								}
								break;
							case 3:
								$response = "Thanks for your feedback";
								break;
							default:
								$response = "Invalid Entry2.".PHP_EOL.getHomeMenu();
								break;
						}
						return $response;
					}
					
					
					function ThirdMenuSwitch($exploded_text){
						switch (trim(strtolower($exploded_text[0]))) {
							case 1:
								$response = "Enter last name";
								break;
							case 2:
								//validate whether it is 1 or 2
								if($exploded_text[1] == A){
									$response = "Where are you";
								}elseif($exploded_text[1] == B){
									$response = "Where are they";
								}else{
									$response = "select 1 or 2";
								}
								break;
							case 3:
								$response = "Thanks for your feedback";
								break;
							default:
								$response = "Invalid Entry2.".PHP_EOL.getHomeMenu();
								break;
						}
						return $response;
					}
					
						function FourthMenuSwitch($phoneNumber,$exploded_text){
						switch (trim(strtolower($exploded_text[0]))) {
							case 1:
								$response = registerUser($phoneNumber,$exploded_text);
								sendSMS($phoneNumber,$response);
								break;
							case 2:
								//validate whether it is 1 or 2
								if($exploded_text[1] == A){
									$response = "Where are you";
								}elseif($exploded_text[1] == B){
									$response = "Where are they";
								}else{
									$response = "select 1 or 2";
								}
								break;
							case 3:
								$response = "Thanks for your feedback";
								break;
							
							default:
								$response = registerUser($phoneNumber,$exploded_text);
						}
						return $response;
					}
					
					//register user function
					function registerUser($phone,$exploded_text)
	{
		
		$national_id = $exploded[1];
		$first_name = $exploded[2];
		$last_name = $exploded[3];
		
		//check if the user exists
		$query = mysql_query("SELECT phone FROM users WHERE phone='$phone'");
		if(mysql_num_rows($query)> 0){
			return "You are already registered";
		}else{
			//create the user
			$result = mysql_query("INSERT INTO users (phone,first_name,last_name,national_id) VALUES ('$phone','$first_name','$last_name','$national_id')");
			if($result){
				$reply = "You are registered successfully.";
				return $reply;
			}
		   // return $query;
		}
	}
	
		function sendSMS($recipients,$msg){
		require_once('AfricasTalkingGateway.php');

		$username   = "stevebab";
		$apikey     = "c8933dc169561310819188ca7d69db1a7a967a05bd3c952bad081ea3f71a5ce8";

		//$recipients = "0723401197";

		$message = $msg;
		// Create a new instance of our awesome gateway class
		$gateway    = new AfricasTalkingGateway($username, $apikey);

		try
		{
			// Thats it, hit send and we'll take care of the rest.
			$results = $gateway->sendMessage($recipients, $message,$from);
			foreach($results as $result) {
				// Note that only the Status "Success" means the message was sent
				/*
				echo " Number: " .$result->number;
				echo " Status: " .$result->status;
				echo " MessageId: " .$result->messageId;
				echo " Cost: "   .$result->cost."\n";
				*/
			}
		}
		catch ( AfricasTalkingGatewayException $e )
		{
			echo "Encountered an error while sending: ".$e->getMessage();
		}

	}
			
		
		?>