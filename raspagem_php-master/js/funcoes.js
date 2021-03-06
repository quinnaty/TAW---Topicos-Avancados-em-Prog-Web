$(document).ready(function () {
	//Carrega a lista de municípios
	getMunicipios();

	//Carrega a lista de anos
	anosAnalisados();

	//Ao mudar, carrega a lista de balneários
	$("#campoMunicipiosHistorico").change(function () {
		//Carrega a lista de balneários baseando-se na cidade escolhida
		getLocaisByMunicipio(
			$("#campoMunicipiosHistorico option:selected").val()
		)
	});


	$("#pesquisar").click(function () {
		//Recupera dados dos campos
		let idMunicipio = $("#campoMunicipiosHistorico option:selected").val();
		let idBalneario = $("#campoLocaisHistorico option:selected").val();
		let ano = $("#campoAnoHistorico option:selected").val();
		let resultadoPesquisa = $("#resultadoPesquisa");

		//Esconde o campo da pesquisa
		resultadoPesquisa.hide("slow");
		$.ajax(
			{
				// url: "requisicoes/request.php",
				url: "requisicoes/request2.php",
				type: "POST",
				//Adiciona os dados ao POST
				data: { idMunicipio : idMunicipio, idBalneario : idBalneario, ano : ano},
				//Define o tipo de dados como HTML
				dataType: 'json',
				async: true,
				success: function(dados) {
					//Esvazia o html, adiciona os dados e mostra o conteúdo
					resultadoPesquisa.empty();

					let tabelaDados = geraTabela(dados); //chamar a funcao que gera a tabela

					resultadoPesquisa.append(tabelaDados);
					resultadoPesquisa.toggle("slow");
				},
				error: function (erro) {
					alert("Oops deu algum erro na requisição <br>"+erro);
				}
			}
		);
	});

	$("#pesquisar-graph").click(function () {
		//Recupera dados dos campos
		let idMunicipio = $("#campoMunicipiosHistorico option:selected").val();
		let idBalneario = $("#campoLocaisHistorico option:selected").val();
		let ano = $("#campoAnoHistorico option:selected").val();
		let resultadoPesquisa = $("#resultadoPesquisa");

		//Esconde o campo da pesquisa
		resultadoPesquisa.hide("slow");
		$.ajax(
			{
				// url: "requisicoes/request.php",
				url: "requisicoes/request2.php",
				type: "POST",
				//Adiciona os dados ao POST
				data: { idMunicipio : idMunicipio, idBalneario : idBalneario, ano : ano},
				//Define o tipo de dados como HTML
				dataType: 'json',
				async: true,
				success: function(dados) {
					//Esvazia o html, adiciona os dados e mostra o conteúdo
					resultadoPesquisa.empty();

					criarChart(dados);
					// console.log(dados);
					resultadoPesquisa.toggle("slow");
				},
				error: function (erro) {
					alert("Oops deu algum erro na requisição <br>"+erro);
				}
			}
		);
	});

	//function geraTabela - recebe os dados json e cria uma tabela HTML
	function geraTabela(dados){
		let tabela = document.createElement('table');
		$(tabela).addClass('table');
		$.each(dados, function(key, pontoColeta){
			console.log(pontoColeta);
			let linha = document.createElement('tr');
			let celula = document.createElement('td');
			let texto = document.createTextNode(key);

			celula.appendChild(texto);
			linha.appendChild(celula);
			tabela.appendChild(linha);
		});

		return tabela;
	}





	//Recupera a lista de municípios e adiciona ao campo de seleção
	function getMunicipios(){
		$.ajax(
			{
				url: "requisicoes/getMunicipios.php",
				type: "POST",
				data: "",
				dataType: 'json',
				async: true,
				success: function(municipios) {
					//Adiciona cada município a uma <option>
					$.each(municipios, function(id, municipio){
						$("#campoMunicipiosHistorico").append(
							$("<option></option>").val(municipio.CODIGO).text(municipio.DESCRICAO)
						)
					});
				},
				error: function (erro) {
					alert("Oops deu algum erro na requisição <br>"+erro);
				}
			}
		);
	}

	//Recupera os balnearios do município selecionado
	function getLocaisByMunicipio(idmunicipio) {
		$.ajax(
			{
				url: "requisicoes/getLocaisByMunicipio.php",
				type: "POST",
				// data: "idMunicipio="+idmunicipio,
				data: {'idMunicipio' : idmunicipio},
				dataType: 'json',
				async: true,
				success: function(locais) {
					$("#campoLocaisHistorico").empty();
					$("#campoLocaisHistorico").append(
						$("<option></option>").val("0").text("Todos")
					);
					$.each(locais, function(id, locais){
						$("#campoLocaisHistorico").append(
							$("<option></option>").val(locais.CODIGO).text(locais.BALNEARIO)
						)
					});
				},
				error: function (erro) {
					alert("Oops deu algum erro na requisição <br>"+erro);				}
			}
		);
	}

	function anosAnalisados() {
		$.ajax(
			{
				url: "requisicoes/anosAnalisados.php",
				type: "POST",
				data: "",
				dataType: 'json',
				async: true,
				success: function(anos) {
					$.each(anos, function(id, ano){
						$("#campoAnoHistorico").append(
							$("<option></option>").val(ano.ANO).text(ano.ANO)
						)
					});
				},
				error: function (erro) {
					alert("Oops deu algum erro na requisição <br>"+erro);				}
			}
		);
	}

	function criarChart(dados) {
		$(dados).each(function (pontoDeColeta) {
			console.log(dados[pontoDeColeta]);
			let canvas = document.createElement('canvas');
			// $("#resultadoPesquisa").text(dados) ;

			let config = {
				// The type of chart we want to create
				type: 'line',

				// The data for our dataset
				data: {
					labels: ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
					datasets: [{
						label: 'My First dataset',
						backgroundColor: 'rgb(255, 99, 132)',
						borderColor: 'rgb(99, 99, 99)',
						data: [0, 10, 5, 2, 20, 30, 45]
					}]
				},

				// Configuration options go here
				options: {
					responsive: true,
					title: {
						display : true,
						text : dados[pontoDeColeta].titulos.Balneário + " - "
							+ dados[pontoDeColeta].titulos.Localização +" - "
							+dados[pontoDeColeta].titulos.Município +" - "
							+ dados[pontoDeColeta].titulos.Ponto_de_Coleta
					}
				}
			};

			new Chart(canvas, config);
			$("#resultadoPesquisa").append(canvas);
		});
	}


});
