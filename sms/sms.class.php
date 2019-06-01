<?php
	require_once('nusoap.class.php');
	
	$uname = 'shamim'; // Your panel username
	$pass  = '1390mosa'; // Your panel password

	$gate = new SMSService($uname, $pass);
	
class SMSService
{
    private $Username = "";
    private $Password = "";
	private $client   = null;

	function SMSService($user, $pass)
	{
		$this->Username = $user;
		$this->Password = $pass;

        $this->client = new nusoap_client("http://www.payamosh.com/class/sms/wssimple/server.php?wsdl");

        $this->client->soap_defencoding = 'UTF-8';
        $this->client->decode_utf8 = true;
	}
	
    public function SendSMS($Message, $SenderNumber, $Receptors, $type = 'normal')
	{
		if(is_array($Receptors))
		{
			$i = sizeOf($Receptors);
			
			while($i--)
			{
				$Receptors[$i] =  self::CorrectNumber($Receptors[$i]);
			}
		}
		else
		{
			$Receptors = array(self::CorrectNumber($Receptors));
		}

		$params = array(
			'Username' => $this->Username,
			'Password' => $this->Password,
			'RecipientNumbers' => $Receptors,
			'SenderNumber'=> $SenderNumber,
			'Message' => $Message,
			'Type' => $Type
		);

        $response = $this->call("SendSMS", $params);

		return $response;
    }
	
    public function GetStatus($BatchID, $UniqueIDs)
	{
		$params = array(
			'Username' => $this->Username,
			'Password' => $this->Password,
			'BatchID' => $BatchID,
			'UniqueIDs'=> $UniqueIDs
		);

        $response = $this->call("GetStatus", $params);

		return $response;
    }
	
    public function GetMaxReceptors()
	{
		$response = $this->call("GetMaxReceptors", array());
			
		return $response;
    }
	
    public function GetUserBalance()
	{
		$response = $this->call("GetCredit", array('Username' => $this->Username, 'Password' => $this->Password));
			
		return $response;
    }

    private function call($method, $params)
	{
        $result = $this->client->call($method, $params);

			if($this->client->fault || ((bool)$this->client->getError()))
			{
				return array('error' => true, 'fault' => true, 'message' => $this->client->getError());
			}

        return $result;
    }

	public static function CorrectNumber(&$uNumber)
	{
		$uNumber = Trim($uNumber);
		$ret = &$uNumber;
		
		if (substr($uNumber,0, 3) == '%2B')
		{ 
			$ret = substr($uNumber, 3);
			$uNumber = $ret;
		}
		
		if (substr($uNumber,0, 3) == '%2b')
		{ 
			$ret = substr($uNumber, 3);
			$uNumber = $ret;
		}
		
		if (substr($uNumber,0, 4) == '0098')
		{ 
			$ret = substr($uNumber, 4);
			$uNumber = $ret;
		}
		
		if (substr($uNumber,0, 3) == '098')
		{ 
			$ret = substr($uNumber, 3);
			$uNumber = $ret;
		}
		
		
		if (substr($uNumber,0, 3) == '+98')
		{ 
			$ret = substr($uNumber, 3);
			$uNumber = $ret;
		}
		
		if (substr($uNumber,0, 2) == '98')
		{ 
			$ret = substr($uNumber, 2);
			$uNumber = $ret;
		}
		
		if(substr($uNumber,0, 1) == '0')
		{ 
			$ret = substr($uNumber, 1);
			$uNumber = $ret;
		}  
		   
		return '+98' . $ret;
	}
}

?>