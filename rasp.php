<?php
// RASPAGEM DE DADOS COM CURL
// A very simple PHP example that sends a HTTP POST to a remote site
//

$ch = curl_init();

curl_setopt($ch, CURLOPT_URL,"https://balneabilidade.ima.sc.gov.br/relatorio/historico");
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS,"municipioID=23&localID=39&ano=2018&redirect=true");

// In real life you should use something like:
// curl_setopt($ch, CURLOPT_POSTFIELDS, 
//          http_build_query(array('postvar1' => 'value1')));

// Receive server response ...
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$html = curl_exec($ch);

// echo $html

$doc = new DOMDocument();
$doc->loadHTML($html);

//curl_close ($ch);

// Further processing ...
//if ($server_output == "OK") { ... } else { ... }
$tables = $doc->getElementsByTagName('table');
echo '<pre>';
	$todos = [];
	foreach ($tables as $table) {
		$pontos = [];
		$labels = $table->getElementsByTagName('label');
		foreach ($labels as $label) {
			$pontocoleta = [];
			$partes = explode(': ', $label->nodeValue) ;
			$pontocoleta[$partes[0]] = $partes[1];
			array_push($pontos, $pontocoleta);
				
		}
		array_push($todos, $pontos);

echo "<pre>";
		$trs = $table->getElementsByTagName('tr');
		foreach ($trs as $tr) {
			$tds = $tr->getElementsByTagName('td');
			foreach ($tds as $td) {
				echo $td->nodeValue. ' | ';
			}
		}
	}

echo json_encode($todos);



