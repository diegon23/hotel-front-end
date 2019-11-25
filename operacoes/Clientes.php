<?php

    function consultarClientes(){
		$url = "localhost:2323/hotel/consultar-clientes";

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
		curl_setopt($curl, CURLOPT_HTTPGET, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$retorno = curl_exec($curl);
		curl_close($curl);

		return json_decode($retorno, true);
	
	}
	
	function consultarClientesPeloCpf($cpf){
		$url = "localhost:2323/hotel/consultar-clientes/".$cpf;

		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
		curl_setopt($curl, CURLOPT_HTTPGET, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$retorno = curl_exec($curl);
		curl_close($curl);

		return json_decode($retorno, true);
	
	}
	
?>