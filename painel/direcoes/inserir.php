<?php 
$tabela = 'direcoes';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$pelouro = $_POST['pelouro'];
$id = $_POST['id'];

//validar cpf
$query = $pdo->query("SELECT * FROM $tabela where nome = '$nome' and pelouro = '$pelouro'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Direcao já Cadastrado para este Pelouro, escolha Outra!';
	exit();
}



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, pelouro = '$pelouro', ativo = 'Sim'");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, pelouro = '$pelouro' WHERE id = '$id'");

}
$query->bindValue(":nome", "$nome");
$query->execute();



echo 'Salvo com Sucesso'; 

?>