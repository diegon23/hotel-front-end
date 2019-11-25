<!DOCTYPE html>
<html lang="en">
<?php
	require_once __DIR__."/../operacoes/QuartosLimpeza.php";
	require_once __DIR__."/../operacoes/Quartos.php";
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

	.navbar-brand>img {
		height: 100%;
	}
</style>

<script>
	function finalizarLimpeza($this){
		window.location.href = "../operacoes/FinalizarLimpeza.php?idQuartoLimpeza="+$this.id;
	}
</script>

<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
		<ul class="nav navbar-nav">
		<li><a href="../index.php" class="active">Reservas</a></li>
		<li><a href="RealizarReserva.php">Realizar Reservas</a></li>
		<li><a href="ClientesCadastrados.php">Clientes Cadastrados</a></li>
		<li><a href="ImportacaoClientes.php">Importar Clientes</a></li>
		<li><a href="QuartosLimpezaExibir.php">Quartos Para Limpeza</a></li>
		</ul>
    </div>
  </div>
</nav>
  
<div class="container">
<?php
	$quartosLimpeza = consultarQuartosLimpeza();
	
	echo '<h2>Quartos Aguardando Limpeza:</h2>';
	
	if(!empty($quartosLimpeza)){
		echo '<ul class="list-group row">';
		foreach($quartosLimpeza as $quartoLimpeza){
			if($quartoLimpeza["ativo"]){
				$quarto = consultarQuartosPeloId($quartoLimpeza["id_quarto"]);
				echo'<li class="list-group-item col-xs-4">'.$quarto['numero'].'</li>';
				echo'<li class="list-group-item col-xs-4">'.$quarto['modelo'].'</li>';
				echo'<li class="list-group-item col-xs-4" onClick="finalizarLimpeza(this)" id='.$quartoLimpeza["id"].'>FINALIZAR</li>';
			}
		}	
		echo'</ul>';
	}
?>
</div>

</body>
</html>