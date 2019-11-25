<?php

    function importarClientes(){
		$url = "localhost:2323/importacao/importar-clientes";

		//http://br2.php.net/manual/pt_BR/function.curl-setopt.php
		$curl = curl_init($url);
		curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/x-www-form-urlencoded; charset=UTF-8"));
		curl_setopt($curl, CURLOPT_HTTPGET, 1);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$retorno = curl_exec($curl);
		curl_close($curl);
	}
	
?>