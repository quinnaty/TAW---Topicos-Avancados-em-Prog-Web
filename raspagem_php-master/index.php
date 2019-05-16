
<html>
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Requisição de dados</title>

	<script src="js/jquery-3.3.1.min.js"></script>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="lib/chartjs/Chart.min.css">
	
	<script src="js/funcoes.js"></script>
	
	<script src="lib/chartjs/Chart.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<div class="row">
			<div class="col-6 rounded mx-auto my-5">
				<div class="border border-dark rounded">
					<div class="modal-header modal-info" id="modal-header">
						<h5 class="modal-title" id="modalHistoricoLabel">Histórico de Balneabilidade</h5>
					</div>
					<div class="modal-body">
						<label style="font-size: 12px">
							Selecione o município, o balneário, o ano e clique no botão "Verificar balenabilidade" para verificar a condição de balneabilidade do balneário.
						</label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="campoMunicipiosHistorico">Município</label>
							</div>
							<select class="custom-select" id="campoMunicipiosHistorico">
								<option value="0">Todos</option>
							</select>
						</div>
	
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="campoLocaisHistorico">Balneário</label>
							</div>
							<select class="custom-select" id="campoLocaisHistorico">
								<option value="0">Todos</option>
							</select>
						</div>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<label class="input-group-text" for="campoAnoHistorico">Ano</label>
							</div>
							<select class="custom-select" id="campoAnoHistorico">
							</select>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-primary active" id="pesquisar">Verificar balenabilidade - Tabela</button>
						<button type="button" class="btn btn-primary active" id="pesquisar-graph">Verificar balenabilidade - Gráfico</button>
					</div>
				</div>
			</div>
		</div>
		<div class="row my-1" >
			<div class="col" id="resultadoPesquisa" style="display: none">
			</div>
		</div>
		<footer class="my-5"></footer>
	</div>
</body>
</html>