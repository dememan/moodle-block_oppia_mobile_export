<?php 

class QuizHelper{
	private $connection;
	private $curl;
	
	function init($connection){
		$this->connection = $connection;
		$this->curl = curl_init();
		curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, 1 );
	}
	
	function exec($object, $data_array, $type='post'){
		$json = json_encode($data_array);
		$temp_url = $this->connection->url."/api/v1/".$object."/";
		$temp_url .= "?format=json";
		$temp_url .= "&username=".$this->connection->username;
		$temp_url .= "&api_key=".$this->connection->apikey;
		curl_setopt($this->curl, CURLOPT_URL, $temp_url );
		if($type == 'post'){
			curl_setopt($this->curl, CURLOPT_POSTFIELDS, $json);
			curl_setopt($this->curl, CURLOPT_POST,1);
			curl_setopt($this->curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json', 'Content-Length: ' . strlen($json) ));
		} else {
			curl_setopt($this->curl, CURLOPT_HTTPGET, 1 );
		}
		$data = curl_exec($this->curl);
		$json = json_decode($data);
		return $json;
			
	}
	
}

?>