<?php 
$tabela = 'candidaturas';
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
$id = $_POST['id_concorrer'];




$query2 = $pdo->query("SELECT * FROM vagas WHERE id = '$id'");
		$res2 = $query2->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res2) > 0){
			$nome_vaga = $res2[0]['nome'];
			$nome_descricao = $res2[0]['descricao'];
			$codigo_direcao = $res2[0]['direcao'];
			$codigo_pelouro = $res2[0]['pelouro'];
		}else{
			$nome_vaga = ' ';
			$nome_descricao = ' ';
			$nome_direcao = ' ';
			$nome_pelouro = ' ';
		}
		$query1 = $pdo->query("SELECT * FROM candidaturas WHERE candidato = '$id_usuario' AND vagas = '$id'");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res1) > 0){
			echo 'Não pode submeter mais de uma vez';
			exit();
		}

		$query = $pdo->query("SELECT * FROM usuarios where id = '$id_usuario'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res) > 0){
			$id_candidato = $res[0]['id_candidato'];
			
		
		}

		$query = $pdo->query("SELECT * FROM candidatos where id = '$id_candidato'");
		$res = $query->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res) > 0){
			$idade = $res[0]['idade'];
			$telefone = $res[0]['telefone'];
			$cpf = $res[0]['cpf'];
			$endereco = $res[0]['endereco'];
			$nivel_academico = $res[0]['nivel_academico'];
			$genero = $res[0]['genero'];
			$cargo = $res[0]['cargo'];
			$cidade = $res[0]['cidade'];
			$bairro = $res[0]['bairro'];
			$instituicoes = $res[0]['instituicoes'];
			$estado_civil = $res[0]['estado_civil'];
			$nacionalidade = $res[0]['nacionalidade'];
			$curso= $res[0]['curso'];
		}else{
			$idade = '';
			$telefone = '';
			$cpf = '';
			$endereco = '';
			$nivel_academico = '';
			$genero = '';
			$cargo = '';
			$cidade = '';
			$bairro = '';
			$instituicoes = '';
			$estado_civil = '';
			$nacionalidade = '';
			$curso= '';
		}
		 if($idade == '' || $telefone == '' ||  $cpf == '' || $endereco == '' || $nivel_academico == '' || $genero = ' ' || $cargo == '' || $cidade == '' || $bairro = '' || $instituicoes == '' || $estado_civil = '' || $nacionalidade == '' || $curso == ''){
			echo "Por favor, certifique-se de que preencheu todos os campos!";
			exit();
			
		 }
	$query = $pdo->prepare("INSERT INTO $tabela SET candidato = '$id_usuario', recrutador = '0', direcoes = '$codigo_direcao', pelouro = '$codigo_pelouro', data_cad = curDate(), estado = 'Pendente' ,arquivo = 'sem-foto.png',ativo = 'Sim', vagas = $id");

$query->execute();
	



echo 'Salvo com Sucesso'; 

?>