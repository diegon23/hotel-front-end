<!DOCTYPE html>
<html lang="en">
<?php
	require_once __DIR__."/../operacoes/Clientes.php";
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
	function inativar($this){
		window.location.href = "../operacoes/InativarCliente.php?cpf="+$this.id;
	}

	
	function ativar($this){
		window.location.href = "../operacoes/AtivarCliente.php?cpf="+$this.id;
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
	$clientes = consultarClientes();
	
	echo '<h2>Clientes na base:</h2>';
	
	if(!empty($clientes)){
		echo '<ul class="list-group row">';
		echo'<li class="list-group-item col-xs-4" style="font-weight:bold">NOME</li>';
		echo'<li class="list-group-item col-xs-4" style="font-weight:bold">CPF</li>';
		echo'<li class="list-group-item col-xs-4" style="font-weight:bold">AÇÃO</li>';
		foreach($clientes as $cliente){
			echo'<li class="list-group-item col-xs-4">'.$cliente['nome'].'</li>';
			echo'<li class="list-group-item col-xs-4">'.$cliente['cpf'].'</li>';
			if($cliente["ativo"]){
				echo'<li class="list-group-item col-xs-4" onClick="inativar(this)" style="color:red" id='.$cliente["cpf"].'>INATIVAR</li>';
			} else {
				echo'<li class="list-group-item col-xs-4" onClick="ativar(this)" style="color:blue" id='.$cliente["cpf"].'>ATIVAR</li>';
			}
		}	
		echo'</ul>';
	}
?>
</div>

</body>
</html>