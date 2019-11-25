<?php
	$dadosReserva = $_POST;

	$dataInicio = implode('-', array_reverse(explode('/', $dadosReserva['dataInicio'])));

	$dataFim = implode('-', array_reverse(explode('/', $dadosReserva['dataFim'])));

	$data = array("idQuarto" => $dadosReserva['idQuarto'], 
				"idCliente" => $dadosReserva['cpf'], 
				"dtInicio" => $dataInicio, 
				"dtFim" => $dataFim);                                                                    
	$data_string = json_encode($data);        
	$url = "http://localhost:2323/hotel/salvar-reserva";
	$curl = curl_init($url);
	curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: application/json; charset=UTF-8"));
	curl_setopt($curl, CURLOPT_POST, 1);
	curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);
	curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
	$retorno = curl_exec($curl);
	curl_close($curl);
	if(json_decode($retorno, true)['id'] != null){
		header("Location: ../telas/RealizarReserva.php?mensagem=Reserva realizada com sucesso!");
		die();
	} else {
		header("Location: ../telas/RealizarReserva.php?mensagem=".json_decode($retorno, true)['message']);
		die();
	}

	
?>