 <?php
	session_start();
	require_once("../../conexao.php");
	$nivel_usuario = @$_SESSION['nivel_usuario'];

?>
<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<meta charset="utf-8">
		<title>Candidatos</title>
	<head>
	<body> 
		<?php
		
		$arquivo = 'Candidatos.xls';

	echo <<<HTML
<small>
HTML;

if($nivel_usuario == 'Candidato'){
	$query = $pdo->query("SELECT * FROM candidatos where id = '$id_candidato' ORDER BY id desc");
}else{
	$query = $pdo->query("SELECT * FROM candidatos ORDER BY id desc");
}
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
echo <<<HTML
	<table border="1" class="table table-hover" id="tabela">
	<tr>
		 <td colspan="5" style="text-align: center; font-size:medium; background: #696969;"><b>Candidatos</b></tr>
		 </tr>
	<thead> 
	<tr>
	
	<th style="background: #ff6900;">Nome</th> 
	<th style="background: #ff6900;">Telefone</th>
	<th class="esc" style="background: #ff6900;">BI</th>  
	<th class="esc" style="background: #ff6900;">Email</th>
	<th class="esc" style="background: #ff6900;">Instituição</th>		
	</tr> 
	</thead> 
	<tbody> 
HTML;
	for($i=0; $i < $total_reg; $i++){
		foreach ($res[$i] as $key => $value){}
		$id = $res[$i]['id'];
		$nome = $res[$i]['nome'];
		$telefone = $res[$i]['telefone'];
		$cpf = $res[$i]['cpf'];
		$email = $res[$i]['email'];
		$endereco = $res[$i]['endereco'];
		$nivel_academico = $res[$i]['nivel_academico'];
		$data_nasc = $res[$i]['data_nasc'];
		$data_cadastro = $res[$i]['data_cadastro'];
		$genero= $res[$i]['genero']; 
		$cidade = $res[$i]['cidade'];
		$bairro = $res[$i]['bairro'];
		$foto = $res[$i]['foto'];
		$instituicoes = $res[$i]['instituicoes'];
		$curso = $res[$i]['curso'];
		$cargo = $res[$i]['cargo'];
		$ativo = $res[$i]['ativo'];
		$estado_civil = $res[$i]['estado_civil'];
		$nacionalidade = $res[$i]['nacionalidade'];
		

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



	


		$data_nascF = implode('/', array_reverse(explode('-', $data_nasc)));
		$data_cadF = implode('/', array_reverse(explode('-', $data_cadastro)));

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

		$query2 = $pdo->query("SELECT * FROM cursos where id = '$curso'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_curso = $res2[0]['nome'];
		}else{
			$nome_curso = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM nivel_academico where id = '$nivel_academico'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_nivel_academico = $res2[0]['nome'];
		}else{
			$nome_nivel_academico = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM instituicoes where id = '$instituicoes'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_instituicoes = $res2[0]['nome'];
		}else{
			$nome_instituicoes = 'Sem Registro';
		}

		$query2 = $pdo->query("SELECT * FROM cargos where id = '$cargo'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_cargo = $res2[0]['nome'];
		}else{
			$nome_cargo = 'Sem Cargo';
		}


echo <<<HTML
		<tr>
		<td>
		{$nome}
		</td> 
		<td class="esc">{$telefone}</td>
		<td class="esc">{$cpf}</td>
		<td class="esc">{$email}</td>
		<td class="esc">{$nome_instituicoes}</td>
		</tr>

		


		

 
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