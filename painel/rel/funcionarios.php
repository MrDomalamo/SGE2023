<?php 
require_once("../../conexao.php");
$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
@session_start();
$id_usuario = @$_SESSION['id_usuario'];
$nivel_usuario = @$_SESSION['nivel_usuario'];
$id_func = @$_SESSION['id_func'];
$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nome_user = $res[0]['nome']; 
	$foto_usu = $res[0]['foto'];
	$nivel_usu = $res[0]['nivel'];
	$cpf_usu = $res[0]['cpf'];
	$cpf_user = $res[0]['cpf'];
	$senha_usu = $res[0]['senha'];
	$email_usu = $res[0]['email'];
	$id_usu = $res[0]['id'];
	$id_func = $res[0]['id_func'];
	$id_candidato = $res[0]['id_candidato'];
}

$query = $pdo->query("SELECT * FROM funcionarios WHERE id = '$id_func'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$nome_user = $res[0]['nome'];
	$provincia_usu = $res[0]['bairro'];
	
}



$dataInicialF = implode('/', array_reverse(explode('-', $dataInicial)));
$dataFinalF = implode('/', array_reverse(explode('-', $dataFinal)));

if($dataInicial == $dataFinal){
	$texto_apuracao = 'APURADO EM '.$dataInicialF;
}else if($dataInicial == '1980-01-01'){
	$texto_apuracao = 'APURADO EM TODO O PERÍODO';
}else{
	$texto_apuracao = 'APURAÇÃO DE '.$dataInicialF. ' ATÉ '.$dataFinalF;
}







	

setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
$data_hoje = utf8_encode(strftime('%A, %d de %B de %Y', strtotime('today')));

?>




<!DOCTYPE html>
<html>
<head>
	<title>Relatório</title>

	<?php 
	if($relatorio_pdf != 'pdf'){
		?>
		<link rel="icon" href="<?php echo $url_sistema ?>/img/<?php echo $favicon ?>" type="imagens/x-icon">

	<?php } ?>

	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-wEmeIV1mKuiNpC+IOBjI7aAzPcEZeedi5yW5f2yOq55WWLwNGmvvx4Um1vskeMj0" crossorigin="anonymous">


	<style>

		@page {
			margin: 0px;

		}

		body{
			margin-top:0px;
			font-family:Times, "Times New Roman", Georgia, serif;

		}


		<?php if($relatorio_pdf == 'pdf'){ ?>

			.footer {
				margin-top:20px;
				width:100%;
				background-color: #D2691E;
				padding:5px;
				position:absolute;
				bottom:0;
			}

		<?php }else{ ?>
			.footer {
				margin-top:20px;
				width:100%;
				background-color:#D2691E;
				padding:5px;

			}

		<?php } ?>

		.cabecalho {    
			padding:10px;
			margin-bottom:30px;
			width:100%;
			font-family:Times, "Times New Roman", Georgia, serif;


		}

		.titulo_cab{
			color:#0340a3;
			font-size:17px;
			
		}

		
		
		.titulo{
			margin:0;
			font-size:28px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;

		}

		.subtitulo{
			margin:0;
			font-size:12px;
			font-family:Arial, Helvetica, sans-serif;
			color:#6e6d6d;
		}



		hr{
			margin:8px;
			padding:0px;
		}


		
		.area-cab{
			
			
			width:100%;
			height:10px;

		}

		
		.coluna{
			margin: 0px;
			float:left;
			height:30px;
			;
		}

		.area-tab{
			
			display:block;
			width:100%;
			height:30px;

		}


		.imagem {
			width: 100%;
			height: 265px;
			margin-top: -30px;
			margin-bottom: 20px;
			right:10px;
			

		}

		.titulo_img {
			
			margin-top: 10px;
			margin-left: 10px;
			text-align: center;
			color: #000;

		}

		.data_img {
			
			margin-top: 40px;
			margin-left: 10px;
			font-size: 10px;
			text-align: center;
		}

		.endereco {
			position: absolute;
			margin-top: 50px;
			margin-left: 10px;
			border-bottom:1px solid #000;
			font-size: 10px;
		}

		.verde{
			color:green;
		}

		.align{
			text-align: center;
			margin-top: 30px;

		}
		.edm{
			color: #000;
			text-align: center;
			margin-top: -15px;

		}
		.texto{
			color: #fff;
		}

		

	</style>


</head>
<body>	

	<?php 
	if($logo_rel != ''){
		?>
		<div class="align">
		<img class="imagem" src="<?php echo $url_sistema ?>/imagens/<?php echo $logo_rel ?>"  >
		</div>
	<?php } ?>
	<div class="edm" ><B>Relatório dos Funcionarios</B></div>
	<br>
	<div class="cabecalho" style="border-bottom: solid 1px #D2691E">
	</div>	

	<div class="data_img"><?php echo mb_strtoupper($data_hoje) ?></div>

	

	
	<div class="cabecalho" style="border-bottom: solid 1px #D2691E">
	</div>
	<div class="cabecalho" style="border-bottom: solid 1px #D2691E">
	</div>

	<div class="mx-2" style="padding-top:10px; ">

		<section class="area-cab" hidden="">
			
			



		</section>

		<br>

		<?php 
			
			if($nivel_usuario == 'Recrutador'){
				$query = $pdo->query("SELECT * FROM funcionarios where id = '$id_func' ORDER BY id desc");
			}else{
				$query = $pdo->query("SELECT * FROM funcionarios ORDER BY id desc");
			}
			

			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			$total_reg = @count($res);
			if($total_reg > 0){
			?>



			<small><small>
				<section class="area-tab" style="background-color: #D2691E;">
					
					<div class="linha-cab" style="padding-top: 5px; color: #000;">
						<div class="coluna" style="width:20%; margin-left: 10px"><b>Nome</b></div>
						<div class="coluna" style="width:14%; "><b>Telefone</b></div>
						<div class="coluna" style="width:20%"><b>Documento</b></div>
						<div class="coluna" style="width:10%"><b>Género</b></div>
						<div class="coluna" style="width:15%" ><b>Provincia</b></div>
						<div class="coluna" style="width:15%" ><b>Cargo</b></div>
					

						
						
						


					</div>

					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>

				<?php

for($i=0; $i < $total_reg; $i++){
	foreach ($res[$i] as $key => $value){}
		$id = $res[$i]['id'];
	$nome = $res[$i]['nome'];
	$telefone = $res[$i]['telefone'];
	$cpf = $res[$i]['cpf'];
	$email = $res[$i]['email'];
	$endereco = $res[$i]['endereco'];
	$cargo = $res[$i]['cargo'];
	$data_admissao = $res[$i]['data_admissao'];
	$creci = $res[$i]['creci']; 
	$foto = $res[$i]['foto'];
	$ativo = $res[$i]['ativo'];
	$genero = $res[$i]['genero'];
	$cidade = $res[$i]['cidade'];
	$bairro = $res[$i]['bairro'];
		
		
//retirar quebra de texto do obs		
		
		
	

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$id'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$idrecrutador = $res2[0]['id_func'];
		}else{
		
			// $nome_candidato = 'Sem Registro';
		}

		


		$query2 = $pdo->query("SELECT * FROM cidades where id = '$cidade'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cidade = $res2[0]['nome'];
		}else{
			$nome_cidade = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM bairros where id = '$bairro'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_bairro = $res2[0]['nome'];
		}else{
			$nome_bairro = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cargo = $res2[0]['nome'];
		}else{
			$nome_cargo = 'Sem Registro';
		}

		$data_admissaoF = implode('/', array_reverse(explode('-', $data_admissao)));


					
					?>
						
					<section class="area-tab" style="padding-top:5px">					
						<div class="linha-cab">
							<div class="coluna" style="width:20%; margin-left: 10px"><?php echo $nome ?></div>				
							<div class="coluna" style="width:15%" ><?php echo $telefone?></div>
							<div class="coluna" style="width:20%" ><?php echo $cpf?></div>
							<div class="coluna" style="width:10%"><?php echo $genero ?></div>
							<div class="coluna" style="width:15%" ><?php echo $nome_bairro ?></div>
							<div class="coluna" style="width:15%" ><?php echo $nome_cargo ?></div>
						

						</div>
					</section>
					<div class="cabecalho" style="border-bottom: solid 1px #e3e3e3;">
					</div>

				<?php } ?>

			</small>



		</div>


		<div class="cabecalho mt-3" style="border-bottom: solid 1px #0340a3" hidden="">
		</div>


	<?php }else{
		echo '<div style="margin:8px"><small><small>Sem Registros no banco de dados!</small></small></div>';
	} ?>



	<div class="col-md-12 p-2" hidden="">
		<div class="" align="right">
			

			
		</div>
	</div>
	<div class="cabecalho" style="border-bottom: solid 1px #ff6900" hidden="">
	</div>




	<div class="footer"  align="center">
		<span class="texto" style="font-size:10px;"><?php echo $end_sistema ?> Tel: <?php echo $tel_sistema ?></span> 
	</div>



</body>
</html>