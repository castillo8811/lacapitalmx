<?php

class ImxAdsServerConfig{
	//Definicion abstracta de los datos de un servicio de ads
	protected $user;
	protected $password;
	protected $base_url;
	protected $site_id;
	protected $account;

	public function __construct($config){
		$this->user=$config["user"];
		$this->password=$config["password"];
		$this->base_url=$config["base_url"];
		$this->site_id=$config["site_id"];
		$this->account=($config["account"])?$config["account"]:null;
	}


	public function curl_request($url){
		// create cURL resource
		$ch = curl_init();
		// set options
		curl_setopt($ch, CURLOPT_URL,$url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
		curl_setopt($ch, CURLOPT_USERPWD,$this->user.":".$this->password);
		// grab URL and pass it to the browser
		$result=curl_exec($ch);
		// close cURL resource, and free up system resources
		curl_close($ch);

		if($result){
			return $result;
		}else{
			$result=array("error"=>"Hubo un error en la peticion");

			return $result;
		}
	}

}