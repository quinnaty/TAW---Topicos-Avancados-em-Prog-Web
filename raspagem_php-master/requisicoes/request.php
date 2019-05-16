<?php


isset($_POST['idMunicipio']) ? $municipioId = $_POST['idMunicipio'] : die("Município não passado por parâmetro");
isset($_POST['idLocal']) ? $idLocal = $_POST['idLocal'] : die("Município não passado por parâmetro");
isset($_POST['ano']) ? $ano = $_POST['ano'] : die("Município não passado por parâmetro");
	
	
$pesquisa = curl_init();
curl_setopt($pesquisa, CURLOPT_URL,"https://balneabilidade.ima.sc.gov.br/relatorio/historico");
curl_setopt($pesquisa, CURLOPT_POST, 1);
curl_setopt($pesquisa, CURLOPT_POSTFIELDS,"municipioID=".$municipioId."&localID=".$idLocal."&ano=".$ano."&redirect=true");
curl_setopt($pesquisa, CURLOPT_RETURNTRANSFER, true);

$server_output = curl_exec($pesquisa);
curl_close ($pesquisa);

//mostra o html carregado
//echo $server_output;

//Cria um documento DOM para trabalhar nele
$documento = new DOMDocument();

//Carrega o HTML no DOM
$documento->loadHTML($server_output);

//print_r($documento) ;
//var_dump($documento);

$todasTabelas = $documento->getElementsbytagName('table');
//echo $tabelas->count();
echo "<pre>";

//var_dump($tabelas[0]);
//var_dump($tabelas[1]);
//var_dump($tabelas[2]);

foreach ($todasTabelas as $tabela){
//	cria um array com todas as tabelas
	$tabelas[] = $tabela;
}

//print_r($tabelas);

//separa em pontos de coleta (titulo) e dados da coleta (tabela)
//pula o primeiro elemento (banner)
$pontosDeColeta =[];
$dadosDaColeta =[];
for ($i = 1; $i < count($tabelas); $i++){
	if ( ($i%2)){
		$pontosDeColeta []= $tabelas[$i];
	} else {
		$dadosDaColeta []= $tabelas[$i];
	}
}

$labelsPontodeColeta =[];
foreach ($pontosDeColeta as $pontoDeColeta){

}
//$coleta = new DOMDocument();
//$coleta->loadHTML($pontosDeColeta[0]->saveHTML());
//echo $coleta;

print_r($pontosDeColeta);
//print_r($dadosDaColeta);
