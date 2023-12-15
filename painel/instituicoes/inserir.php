<?php 
$tabela = 'instituicoes';
require_once("../../conexao.php");

$nome = $_POST['nome'];
$curso = $_POST['curso'];
$id = $_POST['id'];

//validar cpf
$query = $pdo->query("SELECT * FROM $tabela where nome = '$nome' and curso = '$curso'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
$total_reg = @count($res);
if($total_reg > 0 and $res[0]['id'] != $id){
	echo 'Instituicao já Cadastrado para este curso, escolha Outra!';
	exit();
}



if($id == ""){
	$query = $pdo->prepare("INSERT INTO $tabela SET nome = :nome, curso = '$curso', ativo = 'Sim'");
	
}else{
	$query = $pdo->prepare("UPDATE $tabela SET nome = :nome, curso = '$curso' WHERE id = '$id'");

}
$query->bindValue(":nome", "$nome");
$query->execute();



echo 'Salvo com Sucesso'; 

?>