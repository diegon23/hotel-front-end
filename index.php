<!DOCTYPE html>
<html lang="en">
<?php
	require_once __DIR__."/operacoes/Reservas.php";
	require_once __DIR__."/operacoes/Quartos.php";
	require_once __DIR__."/operacoes/Clientes.php";
?>

<head>
  <title>Hotel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<style>
.navbar-header{
      margin-left:5px;
      width:100%;
    }

	.productbox {
			background-color:#ffffff;
		padding:10px;
		margin-bottom:10px;
		-webkit-box-shadow: 0 8px 6px -6px  #999;
			-moz-box-shadow: 0 8px 6px -6px  #999;
						box-shadow: 0 8px 6px -6px #999;
	}

	.producttitle {
			font-weight:bold;
		padding:5px 0 5px 0;
	}

	.productprice {
		border-top:1px solid #dadada;
		padding-top:5px;
	}

	.pricetext {
		font-weight:bold;
		font-size:1.4em;
	}

	.navbar-brand {
		padding: 0px; /* firefox bug fix */
	}
</style>
<script>
	function finalizarReserva($this){
		var id = $this.id;
		window.location.href = "telas/DadosPagamento.php?idReserva="+id;
	}
	function estornarReserva($this){
		var id = $this.id;
		window.location.href = "operacoes/EstornarReserva.php?idTransacao="+id;
	}
</script>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
		<ul class="nav navbar-nav">
		<li><a href="index.php" class="active">Reservas</a></li>
		<li><a href="telas/RealizarReserva.php">Realizar Reservas</a></li>
		<li><a href="telas/ClientesCadastrados.php">Clientes Cadastrados</a></li>
		<li><a href="telas/ImportacaoClientes.php">Importar Clientes</a></li>
		<li><a href="telas/QuartosLimpezaExibir.php">Quartos Para Limpeza</a></li>
		</ul>
    </div>
  </div>
</nav>
  
<div class="container">
  <h2>Reservas</h2>
<?php
	$reservas = consultarReservas();
	if(!empty($reservas)){
		foreach($reservas as $reserva){
				//buscar quarto
				$reserva['quarto'] = consultarQuartosPeloId($reserva['id_quarto']);
				//buscar cliente
				$reserva['cliente'] = consultarClientesPeloCpf($reserva['id_cliente']);
				
				$dataFim = new DateTime($reserva['data_fim']);
				$dataFim = $dataFim->format('d/m/Y');

				$dataInicio = new DateTime($reserva['data_inicio']);
				$dtInicio = $dataInicio->format('d/m/Y');

				echo '
				<div class="col-md-3 column productbox">
					<img src="'.$reserva['quarto']['modelo'].'.jpg" class="img-responsive">';
					$dataInicio = new DateTime($reserva['data_inicio']);
					$now = new DateTime('today');
					if(!$reserva['pagamento_realizado'] && $dataInicio <= $now){
						echo '<div class="producttitle" id="'.$reserva['id'].'" style="color:red" onclick="finalizarReserva(this)">FINALIZAR RESERVA
						</div>';
					} else if($reserva['pagamento_realizado'] && !$reserva['pagamento_estornado']){
						echo '<div class="producttitle" id="'.$reserva['transacao'].'" style="color:red" onclick="estornarReserva(this)">CANCELAR PAGAMENTO
						</div>';
					}

				echo '<div class="producttitle">'.$reserva['quarto']['modelo'].'
					</div>
					<div class="productprice">';
					if($reserva['pagamento_estornado']){
						echo '<div class="pull-right">PAGAMENTO DEVOLVIDO
							</div>';
					} else {
						echo '<div class="pull-right">'.$reserva['status'].'
							</div>';
					}			

				echo		'<div class="pricetext" id="valor_total">R$'.$reserva['valor_total'].'
						</div>
					</div>
					
					<div class="productprice">
						<div class="pricetext pull-right">'.$dataFim.'
						</div>				
						<div class="pricetext">'.$dtInicio.'
						</div>
					</div>
				</div>';
				
		}
	}
?>

</div>

</body>
</html>