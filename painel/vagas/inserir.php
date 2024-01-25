<?php 
$tabela = 'vagas';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$descricao = $_POST['descricao'];
$id = $_POST['id'];
$direcao = $_POST['direcao']; 
$pelouro = $_POST['pelouro'];

$descricao = str_replace("'"," ",$descricao);
$descricao = str_replace('"',' ',$descricao);
$descricao = str_replace(array("\n","\r","'"),' ', $descricao);
// echo $descricao; 
// exit();

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, descricao = :descricao, direcao = '$direcao', pelouro = '$pelouro' ");

$query->bindValue(":nome", "$nome");
$query->bindValue(":descricao", "$descricao");
$query->execute();



	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, descricao = :descricao, direcao = '$direcao', pelouro = '$pelouro' WHERE id = '$id'");

$query->bindValue(":nome", "$nome");
$query->bindValue(":descricao", "$descricao");
$query->execute();

}



echo 'Salvo com Sucesso'; 

?>