<?PHP
class ConnectionType
{
	const	SOAP	=	1;
	const	RESTFUL	=	2;
}

class Security
{
	const	SSL	=	443;
	const	STANDARD	=	80;
}

class	SMSOTP
{
	private $ConnectionType;
	private	$Security;

	private	$url_soap		=	"http://otp.smsmkt.com/webservice/Services.php?wsdl";
	private	$url_restful	=	"http://otp.smsmkt.com/webservice/Services.php";

	private	$url_soap_ssl		=	"https://otp.smsmkt.com/webservice/Services.php?wsdl";
	private	$url_restful_ssl		=	"https://otp.smsmkt.com/webservice/Services.php";

	public $Error;

	public function __construct($ConnectionType = ConnectionType::SOAP, $Security = Security::SSL)
	{
		$this->ConnectionType	=	$ConnectionType;
		$this->Security	=	$Security;
	}

	public function setConnectionType($ConnectionType)
	{
		$this->ConnectionType	=	$ConnectionType;
	}

	public function setSecurity($Security)
	{
		$this->Security	=	$Security;
	}

	public function viewStructure($json_result)
	{
		echo "<pre>";
		print_r($json_result);
		echo "</pre>";
	}

	public function requestOTP($project_key, $phone, $ref_code = "")
	{
		$result	=	"";

		if ($this->ConnectionType === ConnectionType::SOAP) {
			if ($this->isSoapReady() === TRUE) {
				$result	=	$this->requestOTPSoap($project_key, $phone, $ref_code);
			}
		} else {
			$result	=	$this->requestOTPRestful($project_key, $phone, $ref_code);
		}

		return ($result);
	}

	public function validateOTP($token, $otp_password, $ref_code = "")
	{
		$result	=	"";

		if ($this->ConnectionType === ConnectionType::SOAP) {
			if ($this->isSoapReady() === TRUE) {
				$result	=	$this->validateOTPSoap($token, $otp_password, $ref_code);
			}
		} else {
			$result	=	$this->validateOTPRestful($token, $otp_password, $ref_code);
		}

		return ($result);
	}

	private function requestOTPSoap($project_key, $phone, $ref_code)
	{
		$function	=	"requestOTP";
		$arguments	=	array("project_key" => $project_key, "phone" => $phone, "ref_code" => $ref_code);
		$url_wsdl		=	($this->Security === Security::SSL) ? $this->url_soap_ssl : $this->url_soap;

		$soap_client	=	new SoapClient($url_wsdl, array('cache_wsdl' => WSDL_CACHE_NONE));
		$result			=	$soap_client->__call($function, $arguments);

		return ($result);
	}

	private function validateOTPSoap($token, $otp_password, $ref_code)
	{
		$function	=	"validateOTP";
		$arguments	=	array("token" => $token, "otp_password" => $otp_password, "ref_code" => $ref_code);
		$url_wsdl		=	($this->Security === Security::SSL) ? $this->url_soap_ssl : $this->url_soap;

		$soap_client	=	new SoapClient($url_wsdl, array('cache_wsdl' => WSDL_CACHE_NONE));
		$result			=	$soap_client->__call($function, $arguments);

		return ($result);
	}

	private function requestOTPRestful($project_key, $phone, $ref_code)
	{
		$array_param	=	array("method" => "requestOTP", "project_key" => $project_key, "phone" => $phone, "ref_code" => $ref_code);
		return ($this->httpProtocol($array_param));
	}

	private function validateOTPRestful($token, $otp_password, $ref_code)
	{
		$array_param	=	array("method" => "validateOTP", "token" => $token, "otp_password" => $otp_password, "ref_code" => $ref_code);
		return ($this->httpProtocol($array_param));
	}

	private function httpProtocol($array_param)
	{
		$url_restful	=	($this->Security == Security::SSL) ? $this->url_restful_ssl : $this->url_restful;
		$port_restful	=	($this->Security == Security::SSL) ? Security::SSL : Security::STD;
		$param			=	http_build_query($array_param);

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url_restful);
		curl_setopt($ch, CURLOPT_PORT, $port_restful);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $param);

		$Response 	= curl_exec($ch);
		$httpcode 	= curl_getinfo($ch, CURLINFO_HTTP_CODE);
		$Result			=	"";

		if ($httpcode == 200) {
			$Result	=	$Response;
		} else {
			$this->Error	=	"Http error " . $httpcode;
			throw new Exception($this->Error, $httpcode);
		}
		curl_close($ch);

		return ($Result);
	}

	private function isSoapReady()
	{
		if (class_exists("SoapServer") === TRUE and class_exists("SoapClient") === TRUE) {
			return (true);
		} else {
			$this->Error	=	"Error!!! Please check soap extension php.";
			throw new Exception($this->Error);
			return (false);
		}
	}

	public function __destruct()
	{
	}
}
