<?php 
$tabela = 'acessos';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$chave = $_POST['chave'];
$id = $_POST['id'];

//validar nome
$query = $pdo->query("SELECT * FROM $tabela where nome = '$nome'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Nome já Cadastrado, escolha Outro!';
	exit();
}


//validar chave
$query = $pdo->query("SELECT * FROM $tabela where chave = '$chave'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Chave já Cadastrada, escolha Outra!';
	exit();
}

if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, chave = :chave");
	;

}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, chave = :chave WHERE id = '$id'");
	
}

$query->bindValue(":nome", "$nome");
$query->bindValue(":chave", "$chave");
$query->execute();

echo 'Salvo com Sucesso'; 

?>