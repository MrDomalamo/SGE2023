<?php 
require_once("../../conexao.php");

$dataInicial = $_GET['dataInicial'];
$dataFinal = $_GET['dataFinal'];
$genero = $_GET['genero'];
$idade = $_GET['idade'];
@session_start();
$id_usuario = @$_SESSION['id_usuario'];
$nivel_usuario = @$_SESSION['nivel_usuario'];
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
	$genero = $res[0]['genero'];
	$id_candidato = $res[0]['id_candidato'];
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
	<title>Relatório Candidaturas</title>

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
				background-color: #092D82;
				padding:5px;
				position:absolute;
				bottom:0;
			}

		<?php }else{ ?>
			.footer {
				margin-top:20px;
				width:100%;
				background-color:#092D82;
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
	<div class="edm" ><B>Relatório Candidaturas</B></div>
	<br>
	<div class="cabecalho" style="border-bottom: solid 1px #092D82">
	</div>	

	<div class="data_img"><?php echo mb_strtoupper($data_hoje) ?></div>

	

	
	<div class="cabecalho" style="border-bottom: solid 1px #092D82">
	</div>
	<div class="cabecalho" style="border-bottom: solid 1px #092D82">
	</div>

	<div class="mx-2" style="padding-top:10px; ">

		<section class="area-cab" hidden="">
			
			



		</section>

		<br>

		<?php 
		if(($genero == "") && ($idade == "")){
			$query = $pdo->query("SELECT * FROM candidaturas where (data_cad >= '$dataInicial' and data_cad <= '$dataFinal')  ORDER BY id desc");
		}elseif(($genero == "Masculino" || $genero == "Feminino") && ($idade == "")){
			$query = $pdo->query("SELECT * FROM candidaturas where (data_cad >= '$dataInicial' and data_cad <= '$dataFinal') and genero LIKE '$genero'  ORDER BY id desc");
		}elseif(($genero == "") && ($idade >= 18)){
			$query = $pdo->query("SELECT * FROM candidaturas where (data_cad >= '$dataInicial' and data_cad <= '$dataFinal') and idade LIKE '$idade'  ORDER BY id desc");
		}elseif(($genero == "Masculino" || $genero == "Feminino") && ($idade >= 18)){
			$query = $pdo->query("SELECT * FROM candidaturas where (data_cad >= '$dataInicial' and data_cad <= '$dataFinal') and idade LIKE '$idade' and genero LIKE '$genero'  ORDER BY id desc");
		}
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		$total_reg = @count($res);
		if($total_reg > 0){
			?>



			<small><small>
				<section class="area-tab" style="background-color: #092D82;">
					
					<div class="linha-cab" style="padding-top: 5px; color: #000;">
						<div class="coluna" style="width:15%; margin-left: 5px"><b>Nome</b></div>
						<div class="coluna" style="width:14%; "><b>Gênero</b></div>
						<div class="coluna" style="width:12%; margin-left: -15px"><b>Idade</b></div>
						<div class="coluna" style="width:12%; margin-left: -20px"><b>Telefone</b></div>
						<div class="coluna" style="width:15%; margin-left: 20px" ><b>Curso</b></div>
						<div class="coluna" style="width:15%; margin-left: 30px" ><b>Instituição</b></div>
						<div class="coluna" style="width:12%; margin-left: -20px" ><b>Cidade</b></div>
						<div class="coluna" style="width:10%; margin-left: -10px" ><b>Estado</b></div>
						


					</div>

					
				</section><small></small>

				<div class="cabecalho mb-1" style="border-bottom: solid 1px #e3e3e3;">
				</div>

				<?php

				for($i=0; $i < $total_reg; $i++){
					foreach ($res[$i] as $key => $value){}
					$id = $res[$i]['id'];
					$candidato = $res[$i]['candidato'];
					$recrutador = $res[$i]['recrutador'];
					$finalidade = $res[$i]['finalidade'];
					$cidade = $res[$i]['cidade'];
					$bairro = $res[$i]['bairro'];
					$direcoes = $res[$i]['direcoes'];
					$pelouro = $res[$i]['pelouro'];
					$data_cad = $res[$i]['data_cad'];                                     
					$data_inicio = $res[$i]['data_inicio'];
					$data_final = $res[$i]['data_final'];
					$estado = $res[$i]['estado'];
					$descricao = $res[$i]['descricao'];
					$arquivo = $res[$i]['arquivo'];
					$ativo = $res[$i]['ativo'];
		
		
//retirar quebra de texto do obs		
		
		
$query2 = $pdo->query("SELECT * FROM usuarios where id = '$candidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$idcandidato = $res2[0]['id_candidato'];
		}else{
		
			// $nome_candidato = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM candidatos where id = '$idcandidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			 $nome_candidato = $res2[0]['nome'];
			 $genero_candidato = $res2[0]['genero'];
			 $curso_candidato = $res2[0]['curso'];
			 $instituicoes_candidato = $res2[0]['instituicoes'];
			 $telefone_candidato = $res2[0]['telefone'];
			 $email_candidato = $res2[0]['email'];
			 $idade_candidato = $res2[0]['idade'];
			 $nivel_academico = $res2[0]['nivel_academico'];
		}else{
			$telefone_candidato = 'Sem Registro';
			$nome_candidato = 'Sem Registro';
			$genero_candidato = 'Sem Registro';
			$email_candidato = 'Sem Registro';
			$idade_candidato = 'Sem Registro'; 
			$telefone_candidato = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM nivel_academico where id = '$nivel_academico'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_nivel_academico = $res2[0]['nome'];
		}else{
			$nome_nivel_academico = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM cursos where id = '$curso_candidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_curso = $res2[0]['nome'];
		}else{
			$nome_curso = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM instituicoes where id = '$instituicoes_candidato'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_instituicoes = $res2[0]['nome'];
		}else{
			$nome_instituicoes = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM usuarios where id = '$recrutador'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$idrecrutador = $res2[0]['id_func'];
		}else{
		
			// $nome_candidato = 'Sem Registro';
		}

		// $query2 = $pdo->query("SELECT * FROM funcionarios where id = '$idrecrutador'");
		// $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		// if(@count($res2) > 0){
		// 	 $nome_recrutador = $res2[0]['nome'];
		// 	 $genero_recrutador = $res2[0]['genero'];
		// 	 $telefone_recrutador = $res2[0]['telefone'];
		// 	 $email_recrutador = $res2[0]['email'];
		// 	 $idbairro_recrutador= $res2[0]['bairro'];
		// 	 $idcidade_recrutador = $res2[0]['cidade'];
		// 	 $idcargo_recrutador = $res2[0]['cargo'];
		// }else{
		// 	$telefone_recrutador = 'Sem Registro';
		// 	$nome_recrutador = 'Sem Registro';
		// 	$genero_recrutador = 'Sem Registro';
		// }


		// $query2 = $pdo->query("SELECT * FROM cidades where id = '$idcidade_recrutador'");
		// $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		// if(@count($res2) > 0){
		// 	$cidade_recrutador = $res2[0]['nome'];
		// }else{
		// 	$cidade_recrutador = 'Sem Registro';
		// }

		// $query2 = $pdo->query("SELECT * FROM bairros where id = '$idbairro_recrutador '");
		// $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		// if(@count($res2) > 0){
		// 	$bairro_recrutador  = $res2[0]['nome'];
		// }else{
		// 	$bairro_recrutador  = 'Sem Registro';
		// }

		// $query2 = $pdo->query("SELECT * FROM cargos where id = '$idcargo_recrutador'");
		// $res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		// if(@count($res2) > 0){
		// 	$cargo_recrutador = $res2[0]['nome'];
		// }else{
		// 	$cargo_recrutador = 'Sem Registro';
		// }



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

		$query2 = $pdo->query("SELECT * FROM direcoes where id = '$direcoes'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_direcoes = $res2[0]['nome'];
		}else{
			$nome_direcoes = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM pelouros where id = '$pelouro'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_pelouro = $res2[0]['nome'];
		}else{
			$nome_pelouro = 'Sem Registro';
		}

		$data_inicioF = implode('/', array_reverse(explode('-', $data_inicio)));
		$data_finalF = implode('/', array_reverse(explode('-', $data_final)));
		$data_cadF = implode('/', array_reverse(explode('-', $data_cad)));


					
					?>

					<section class="area-tab" style="padding-top:10px; padding-bottom: 10px;">					
						<div class="linha-cab">
							<div class="coluna" style="width:20%; margin-left: 10px"><?php echo $nome_candidato ?></div>				
							<div class="coluna " style="width:14%; margin-left: -40px"><?php echo $genero_candidato ?></div>


							<div class="coluna" style="width:12%; margin-left: -10px"><?php echo $idade_candidato?></div>


							<div class="coluna" style="width:15%; margin-left: -50px"><?php echo $telefone_candidato?></div>

							<div class="coluna" style="width:20%" ><?php echo $nome_curso ?></div>

							<div class="coluna" style="width:15%; margin-left: 17px" ><?php echo $nome_instituicoes ?></div>

							<div class="coluna" style="width:15%; margin-left: -30px" ><?php echo $nome_cidade  ?></div>

							<div class="coluna" style="width:12%; margin-left: -40px; " ><?php echo $estado  ?></div>

							

						

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