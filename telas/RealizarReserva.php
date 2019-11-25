<!DOCTYPE html>
<html lang="en">
<?php
	require_once __DIR__."/../operacoes/Quartos.php";
?>

<head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Hotel</title>
        <!-- Latest compiled and minified CSS -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" >
        <!-- Optional theme -->
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" >
        <link rel="stylesheet" href="form.css" >
		<script type="text/javascript" src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="form.js"></script>
		<meta charset="utf-8">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.0/jquery.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/js/bootstrap-datepicker.min.js"></script>
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.4.1/css/bootstrap-datepicker3.css"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
<script>
	
$(".imgAdd").click(function(){
  $(this).closest(".row").find('.imgAdd').before('<div class="col-sm-2 imgUp"><div class="imagePreview"></div><label class="btn btn-primary">Upload<input type="file" class="uploadFile img" value="Upload Photo" style="width:0px;height:0px;overflow:hidden;"></label><i class="fa fa-times del"></i></div>');
});
$(document).on("click", "i.del" , function() {
	$(this).parent().remove();
});
$(function() {
    $(document).on("change",".uploadFile", function()
    {
    		var uploadFile = $(this);
        var files = !!this.files ? this.files : [];
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
 
        if (/^image/.test( files[0].type)){ // only image file
			var reader = new FileReader(); // instance of the FileReader
			reader.readAsDataURL(files[0]); // read the local file
 
			reader.onloadend = function(){ // set image data as background of div
				//alert(uploadFile.closest(".upimage").find('.imagePreview').length);
			uploadFile.closest(".imgUp").find('.imagePreview').css("background-image", "url("+this.result+")");
			}
        }
      
    });
});
	
	</script>
	<script>
    $(document).ready(function(){
      $("#dataInicio").datepicker({
        todayBtn:  1,
        autoclose: true,
        todayHighlight: true,
        format: 'dd/mm/yyyy',
		startDate: new Date()
		
    }).on('changeDate', function (selected) {
        var minDate = new Date(selected.date.valueOf()+(1000 * 60 * 60 * 24));
        $('#dataFim').datepicker('setStartDate', minDate);
    });

    $("#dataFim").datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
	}).on('changeDate', function (selected) {
            var maxDate = new Date(selected.date.valueOf() - (1000 * 60 * 60 * 24));
            $('#dataInicio').datepicker('setEndDate', maxDate);
        });
	  });
	
  function mudarNome($a){
    $('#idQuarto').val($a.value);
    
    document.getElementById('textBotao').textContent = $a.textContent;      
  };
    

	function validarEndereco($endereco){
		var $enderecoCompleto = $endereco.value.split(',');
		if($enderecoCompleto.length != 3){
			alert("Endereço informado de forma incorreta, deve possuir os três dados solicitados!");
			document.getElementById('local').value = "";
			return false;
		}
		
		if(isNaN($enderecoCompleto[2])){
			alert("O número do endereço só pode conter números inteiros!");
			document.getElementById('local').value = "";
			return false;
		}
		
	}
</script>
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

	.dropdown-menu-center {
  left: 50% !important;
  right: auto !important;
  text-align: center !important;
  transform: translate(-50%, 0) !important;
}
</style>
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
			<div class="col-md-6 col-md-offset-3">
			<?php if(isset($_GET['mensagem'])){ 
				echo '<h4 style= "color: red" class="text-center">'.$_GET['mensagem'].'</h4>';
			}?>
				<h2 style="text-align:center">Salvar Reserva</h2>
				<form role="form" method="post" action="../operacoes/CriarReserva.php">
					<input type="hidden" name="idQuarto" id="idQuarto">
					<div class="row">
						<div class="dropdown" style="text-align: -webkit-center; padding: 2%">
							<button required class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown" id="botaoDropdown" ><p id="textBotao">Escolha o quarto</p>
							<span class="caret"></span></button>
							<ul id="listQuartos" class="dropdown-menu dropdown-menu-center">
								<?php
										$quartos = consultarQuartosDisponiveis();
										foreach($quartos as $quarto){
											echo '<li onclick="mudarNome(this)" class="'.$quarto["id"].'" value="'.$quarto["id"].'"><a>'.$quarto["modelo"]. ' - R$'.$quarto["valor_diaria"].'</a></li>';
										}
								?>
							</ul>
						</div>
					</div>
					<div class="row" style="margin-left:5%"> 
						<label for="cpf" class="control-label" style="margin-left:-4%">
							CPF do Cliente:
						</label>
						<input required style="margin-left:-5%; margin-bottom: 5%;" type="text" class="col-sm-4 form-control" id="cpf" name="cpf">
					</div>
					
					<div class="form-group">
						<label class="control-label" for="dataInicio">Data Início</label>
						<input autocomplete="off" class="form-control" id="dataInicio" name="dataInicio" placeholder="DD/MM/AAAA" type="text"/>
					</div>
					<div class="form-group">
						<label class="control-label" for="dataFim">Data Fim</label>
						<input autocomplete="off" class="form-control" id="dataFim" name="dataFim" placeholder="DD/MM/AAAA" type="text"/>
					</div>
			
								<div class="row">
										<div class="col-sm-12 form-group">
												<button type="submit" class="btn btn-lg btn-success btn-block" id="btnContactUs">Cadastrar</button>
										</div>
								</div>
						</form>
				</div>
</div>

</body>
</html>