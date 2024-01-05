<?php 
$tabela = 'candidaturas';
require_once("../../conexao.php");
@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
$id = $_POST['id_concorrer'];





$query1 = $pdo->query("SELECT * FROM vagas where id = '$id'");
		$res1 = $query1->fetchAll(PDO::FETCH_ASSOC);
		if(@count($res1) > 0){
			echo 'Não pode submeter mais de uma vez';
			exit();
		}


$query2 = $pdo->query("SELECT * FROM vagas where id = '$id'");
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


	$query = $pdo->prepare("INSERT INTO $tabela SET candidato = '$id_usuario', recrutador = '0', direcoes = '$codigo_direcao', pelouro = '$codigo_pelouro', data_cad = curDate(), estado = 'Pendente' ,arquivo = 'sem-foto.png',ativo = 'Sim', vagas = $id");

$query->execute();
	



echo 'Salvo com Sucesso'; 

?>