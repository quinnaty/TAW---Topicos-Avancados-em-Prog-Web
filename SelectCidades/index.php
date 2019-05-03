<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Selecionando Cidade</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	
	<script>
		$(document).ready(function(){
			$('#estado').click(function(){
				
			});
		});
	</script>

</head>
<body>
	<?php include('conexao.php') ?>

	Selecione um estado
	<select id="estado">
	</select>
	
	Selecione uma cidade
	<select id="cidade">
	</select>

</body>
</html>