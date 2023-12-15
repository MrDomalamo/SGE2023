<?php 
$tabela = 'cursos';
require_once("../../conexao.php");

$id = $_POST['id'];

$query = $pdo->query("SELECT * FROM instituicoes where curso = '$id'");
$res = $query->fetchAll(PDO::FETCH_ASSOC);
if(@count($res) > 0){
	echo 'Esta curso não pode ser excluída, primeiro exclua as Instituicoes relacionadas a ela para depois excluir este registro!';
	exit();
}

$pdo->query("DELETE FROM $tabela where id = '$id'");

echo 'Excluído com Sucesso';


?>