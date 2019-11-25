<?php
	$idTransacao = $_GET["idTransacao"];
	
	$url = "http://localhost:2323/hotel/estornar-transacao/".$idTransacao;
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8"));
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$retorno = curl_exec($curl);
	curl_close($curl);

	header("Location: ../index.php");
	die;
	
?>