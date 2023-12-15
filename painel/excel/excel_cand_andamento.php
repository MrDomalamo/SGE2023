 <?php
	session_start();
	require_once("../../conexao.php");
	$nivel_usuario = @$_SESSION['nivel_usuario'];

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Candidaturas Em Curso</title>s
	<head>
	<body> 
		<?php
		
		$arquivo = 'Candidaturas Em Curso.xls';

	echo <<<HTML
<small>
HTML;

if($nivel_usuario == 'Recrutador'){
	$query = $pdo->query("SELECT * FROM candidaturas where estado = 'EM Curso' and recrutador = '$id_usuario' and bairro = '$provincia_usu' ORDER BY id desc");
}else{
	$query = $pdo->query("SELECT * FROM candidaturas where estado = 'EM Curso' ORDER BY id desc");
}


$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo <<<HTML
	<table border="1" class="table table-hover" id="tabela">
	<tr>
		 <td colspan="9" style="text-align: center; font-size:medium; background: #696969;"><b>Candidaturas Em Curso</b></tr>
		 </tr>
	<thead> 
	<tr> 
		<th style="background: #ff6900;">Nome</th>
	<th class="esc" style="background: #ff6900;">Gênero</th> 
	<th class="esc" style="background: #ff6900;">Idade</th> 
	<th class="esc" style="background: #ff6900;">Telefone</th>
	<th class="esc" style="background: #ff6900;">Curso</th>	  
	<th class="esc" style="background: #ff6900;">Instituição</th>
	<th class="esc" style="background: #ff6900;">Cidade</th>
	<th class="esc" style="background: #ff6900;">Estado</th>
	<th class="esc" style="background: #ff6900;">Obs</th>	</tr> 
	</thead> 
	<tbody> 
HTML;
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
		$ativo = $res[$i]['ativo'];
		// $curso_candidato = $res[$i]['candidato'];
		// $instituicoes_candidato = $res[$i]['candidato'];
		// $idcandidato = $res[$i]['candidato'];
		

		if($ativo == 'Sim'){
			$icone = 'fa-check-square';
			$titulo_link = 'Desativar Item';
			$acao = 'Não';
			$classe_linha = '';
		}else{
			$icone = 'fa-square-o';
			$titulo_link = 'Ativar Item';
			$acao = 'Sim';
			$classe_linha = 'text-muted';
		}



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


		//extensão do arquivo

	
	
		

		echo <<<HTML
		<tr> 
		 <td>
		{$nome_candidato}
		</td>
		<td class="esc">{$genero_candidato}</td>
		<td class="esc">{$idade_candidato}</td>
		<td class="esc">{$telefone_candidato}</td>
		<td class="esc">{$nome_curso}</td> 
		<td class="esc">{$nome_instituicoes}</td>
		<td class="esc">{$nome_cidade}</td>                                 
		<td class="esc">{$estado}</td>
		<td class="esc">{$descricao}</td>		</tr>

													

HTML;
	}
	echo <<<HTML
	</tbody> 
	<small><div align="center" id="mensagem-excluir"></div></small>
	</table>
	</small>
HTML;
}else{
	echo 'Não possui nenhum registro cadastrado!';
}



		// Configurações header para forçar o download
		header ("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header ("Last-Modified: " . gmdate("D,d M YH:i:s") . " GMT");
		header ("Cache-Control: no-cache, must-revalidate");
		header ("Pragma: no-cache");
		header ("Content-type: application/x-msexcel");
		header ("Content-Disposition: attachment; filename=\"{$arquivo}\"" );
		header ("Content-Description: PHP Generated Data" );
		// Envia o conteúdo do arquivo
		exit; ?>
	</body>
</html>