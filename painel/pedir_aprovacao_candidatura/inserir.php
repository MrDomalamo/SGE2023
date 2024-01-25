<?php 
$tabela = 'aprovar_candidatura';
require_once("../../conexao.php");

@session_start();
$id_usuario = $_SESSION['id_usuario'];
$nivel_usuario = $_SESSION['nivel_usuario'];
   
$candidato = $_POST['candidato'];
$id_vaga = $_POST['departamento'];
$id = $_POST['id'];


$query = $pdo->query("SELECT * FROM usuarios WHERE id = '$id_usuario'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$recrutador = $res[0]['id_func'];
	
}

$query = $pdo->query("SELECT * FROM candidaturas WHERE  vagas = '$id_vaga'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);

if($total_reg > 0){
$departamento = $res[0]['direcoes'];
}else{
	$departamento ='';
}


$query = $pdo->query("SELECT * FROM arquivos where registro = 'Candidaturas' and id_reg = '$id' order by id desc");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	$arquivo = $res[0]['arquivo'];
	$nome_arquivo = $res[0]['nome'];
}else{
	$arquivo = 'sem-perfil.jpg';
	$nome_arquivo = 'Nenhum Arquivo Selecionado';
}

$query = $pdo->query("SELECT * FROM $tabela WHERE candidato = '$candidato' AND departamento='$departamento'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0){
	echo "Já solicitou um pedido para este candidato neste departamento, aguarde a resposta!";
	exit();
}

	if($id == ""){
		$query = $pdo->prepare("INSERT INTO $tabela SET candidato = '$candidato', recrutador = '$recrutador', departamento = '$departamento', data_cad = curDate() , ativo = 'Sim', status = 'espera' ");
		
	}else{
		$query = $pdo->prepare("UPDATE $tabela SET candidato = '$candidato', recrutador = '$recrutador', departamento = '$departamento', ativo = 'Sim', status = 'espera' WHERE id = '$id'");
	    
	}

		$query->execute();
		$id_aprovar = $pdo->lastInsertId();

		
		echo 'Salvo com Sucesso';


			$query = $pdo->query("SELECT * FROM aprovar_candidatura where id = '$id_aprovar'");
			$res = $query->fetchAll(PDO::FETCH_ASSOC);
			if(@count($res) > 0){
			$data_cad = $res[0]['data_cad'];
		
			} 



$query = $pdo->query("SELECT * FROM usuarios where id_candidato = '$candidato'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_candidato = $res[0]['nome'];
	$email_candidato = $res[0]['email'];
	
} 

$query = $pdo->query("SELECT * FROM usuarios where id_func = '$recrutador'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	$nome_recrutador = $res[0]['nome'];
	$email_recrutador = $res[0]['email'];
	
} 

		
			
			?>